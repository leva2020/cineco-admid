<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PqrsBundle\Form\EditarRespuestaType;
use PqrsBundle\Form\RespuestaPqrsType;
use PqrsBundle\Entity\Respuesta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RespuestaDetalleController extends Controller {

    public function indexAction(Request $request, $id) {
        $session = $request->getSession();
        if ($session->get('name')):
            $tokens = $session->get('tokens');
            $permisos = $tokens['permisos_nombres'];
            if (in_array('COMUNICAR', $permisos)):
                $editar = true;
            else:
                $editar = false;
            endif;
            $respuesta = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Respuesta')->find($id);
            $id_area = $respuesta->getArea();
            $causas = $respuesta->getCausa();
            $base_url = $this->container->getParameter('pqrs.amazon_s3.base_url');
            $nombres_causas = array();
            foreach($causas as $causa):
                $nombres_causas[] = $causa->getCausa();
            endforeach;
            $area = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area))->getNombre();
            $adjuntos = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Adjunto')->findBy(array('respuesta' => $id));
            return $this->render('PqrsBundle:DetalleRespuesta:index.html.twig', array(
                        'respuesta' => $respuesta,
                        'adjuntos' => $adjuntos,
                        'area' => $area,
                        'id' => $id,
                        'editar' => $editar,
                        'causas' => $nombres_causas,
                        'base_url' => $base_url,
            ));
        else:
            return $this->redirectToRoute('login');
        endif;
    }

    public function editarAction(Request $request, $id) {
        $session = $request->getSession();
        if ($session->get('name')):
            $tokens = $session->get('tokens');
            $permisos = $tokens['permisos_nombres'];
            if (in_array('COMUNICAR', $permisos)):
                $em = $this->getDoctrine()->getManager();
                $estados = array(2 => 'Progreso', 3 => 'Solucionado', 4 => 'Comunicado');
                $respuesta = $em->getRepository('PqrsBundle:Respuesta')->find($id);
                $id_area = $respuesta->getArea();
                $comunicado = $respuesta->getComunicado();
                //var_dump($comunicado);
                $pqrs = $respuesta->getPqrs();
                $pqrs_id = $pqrs->getId();
                $fecha_registro = $pqrs->getFechaRegistro();

                $id_comunicacion = $pqrs->getTipoComunicacion();
                $tipo_comunicacion = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:TipoComunicacion')->findOneBy(array('id_comunicacion' => $id_comunicacion))->getNombre();

                $area = $em->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area))->getNombre();
                $adjuntos = $em->getRepository('PqrsBundle:Adjunto')->findBy(array('respuesta' => $id));
                $id_estado = $respuesta->getEstado();
                $estado = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Estados')->findOneBy(array('id_estado' => $id_estado))->getNombre();
                $form = $this->createFormBuilder()
                        ->add('respuesta', 'textarea', array(
                            'label' => 'Respuesta',
                            'attr' => array('placeholder' => $respuesta->getRespuesta(), 'readonly' => true),
                        ))
                        ->add('causa', 'textarea', array(
                            'label' => 'Causa',
                            'required' => false,
                            'attr' => array('placeholder' => $respuesta->getCausa(), 'readonly' => true),
                        ))
                        ->add('estado', 'text', array(
                            'label' => 'Estado',
                            'attr' => array('placeholder' => $estado, 'readonly' => true),
                        ))
                        ->add('area', 'text', array(
                            'label' => 'Área',
                            'attr' => array('placeholder' => $area, 'readonly' => true),
                        ))
                        ->add('comunicado', 'choice', array(
                            'label' => 'Comunicado',
                            'choices' => array(0 => 'Sin comunicar', 1 => 'Comunicado'),
                            //'preferred_choices' => array(),
                            'required' => true
                        ))
                        ->add('save', 'submit', array(
                            'label' => 'Enviar',
                            'attr' => array(
                                'class' => "btn btn-primary",
                            )
                        ))
                        ->add('cancel', 'button', array(
                            'label' => 'Cancelar',
                            'attr' => array(
                                'onClick' => "window.history.back()",
                                'class' => "btn btn-cancel",
                            )
                        ))
                        ->getForm();

                $form->handleRequest($request);
                if ($form->isValid()) {
                    $comunicado = $_POST['form']['comunicado'];
                    $respuesta->setComunicado($comunicado);
                    $em->flush();

                    if ($comunicado == 1 && $id_estado == 4):
                        $message = \Swift_Message::newInstance()
                                ->setSubject('Comunicacion PQRS' . $estado)
                                ->setFrom('sugerencias@cinecolombia.com.co')
                                ->setTo($pqrs->getCorreo())
                                ->setBody(
                                $this->renderView(
                                        'PqrsBundle:Mails:respuesta.html.twig', array(
                                    'id' => $pqrs_id,
                                    'nombre' => $pqrs->getNombreUsuario(),
                                    'fecha' => date('d-m-Y', $fecha_registro),
                                    'tipo' => $tipo_comunicacion,
                                    'respuesta' => $respuesta->getRespuesta(),
                                        )
                                )
                                )
                        ;
                        $message->setContentType("text/html");
                        $this->get('mailer')->send($message);
                    endif;

                    return $this->redirectToRoute('pqrs_detalle', array('id' => $pqrs_id));
                }

                return $this->render('PqrsBundle:DetalleRespuesta:editar.html.twig', array(
                            'form' => $form->createView(),
                            'id' => $id
                ));
            else:
                return $this->redirectToRoute('/');
            endif;
        else:
            return $this->redirectToRoute('login');
        endif;
    }

}
