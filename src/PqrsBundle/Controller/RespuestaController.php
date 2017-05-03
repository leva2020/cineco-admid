<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PqrsBundle\Form\RespuestaPqrsType;
use PqrsBundle\Entity\Respuesta;
use PqrsBundle\Entity\Area;
use PqrsBundle\Entity\Pqrs;
use PqrsBundle\Entity\Adjunto;
use PqrsBundle\Entity\Estados;
use PqrsBundle\Entity\LogError;
use Symfony\Component\HttpFoundation\Request;
use Aws\S3\S3Client;
use League\Flysystem\Adapter\AwsS3 as Adapter;
use Symfony\Component\Filesystem\Filesystem;

class RespuestaController extends Controller {

    public function indexAction(Request $request, $id) {
        $session = $request->getSession();
        if ($session->get('name')):
            $tokens = $session->get('tokens');
            $nombre_usr = $tokens['nombre'];
            $permisos = $tokens['permisos_nombres'];
            $firma_correo = $tokens['firma'];
            $areas_usuario = $tokens['areas'];
            $nombres_areas_usuario = $tokens['nombresareas'];
            $firma_correo = str_replace('{', '<span style="font-weight: bold;">', $firma_correo);
            $firma_correo = str_replace('}', '</span>', $firma_correo);
            $firma_correo = nl2br($firma_correo);
            $area_usuario_act = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $areas_usuario[0]));
            $em = $this->getDoctrine()->getManager();
            $respuesta = new Respuesta();
            $nombres_causas = array();
            $respuestas_pqrs = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Respuesta')->findBy(array('pqrs' => $id), array('id' => 'desc'));
            if (is_array($respuestas_pqrs) && !empty($respuestas_pqrs)):
                foreach ($respuestas_pqrs[0]->getCausa() as $causas):
                    $nombres_causas[] = $causas->getCausa();
                endforeach;
            endif;
            $form = $this->createForm(new RespuestaPqrsType($em), $respuesta);
            $form->add('adjuntos', 'file', array('mapped' => false, 'multiple' => true, 'required' => false));

            $form->add('save', 'submit', array(
                'label' => 'Enviar',
                'attr' => array(
                    'class' => "btn btn-primary",
                )
            ));
            $form->add('cancel', 'button', array(
                'label' => 'Cancelar',
                'attr' => array(
                    'onClick' => "window.history.back()",
                    'class' => "btn btn-cancel",
                )
            ));

            $hoy = strtotime(date('Y-m-d h:i A'));
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form['adjuntos']->getData();
                $pqrs = $em->getRepository('PqrsBundle:Pqrs')->find($id);
                $area_ant = $pqrs->getArea();
                $respuesta_em = $this->getDoctrine()->getManager();
                $respuesta_em->persist($respuesta);
                $respuesta->setPqrs($pqrs);
                if (isset($_POST['respuesta_pqrs_type']['estado'])):
                    $estado = $_POST['respuesta_pqrs_type']['estado'];
                else:
                    $estado = $pqrs->getEstado();
                endif;
                $respuesta->setRespuesta(nl2br($_POST['respuesta_pqrs_type']['respuesta']));
                $respuesta->setFecha($hoy);
                $respuesta->setEstado($estado);
                $respuesta->setAreaResAnt($area_usuario_act);
                $respuesta->setUsuario($nombre_usr);
                if (!isset($_POST['respuesta_pqrs_type']['area'])):
                    $respuesta->setArea($area_usuario_act);
                endif;

                $comuni_prev = 0;
                $comunicado_final = 0;

                if (in_array('COMUNICAR', $permisos)):
                    if ($form['comunicacion_previa']->getData()):
                        $comuni_prev = $form['comunicacion_previa']->getData();
                    else:
                        $respuesta->setComunicacionPrevia($comuni_prev);
                        $comunicado_final = $form['comunicado']->getData();
                    endif;
                else:
                    $respuesta->setComunicacionPrevia($comuni_prev);
                endif;

                $pqrs->setEstado($estado);
                $pqrs->setFechaModificacion($hoy);
                $pqrs->setArea($respuesta->getArea());
                $pqrs->setAreaAnt($area_usuario_act);
                $usuarios_area = $respuesta->getArea()->getUsuarios();
                $respuesta_em->persist($respuesta);
                $respuesta_em->flush();
                if (is_array($data) && $data[0] != '') {
                    $client = S3Client::factory(array(
                                'key' => 'AKIAJ7KGUW6AND4B3UXA',
                                'secret' => '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',
                    ));
                    
                    foreach ($data as $file) {
                        $acl = 'public-read';
                        $filename = sprintf('%s/%s/%s/%s.%s', date('Y'), date('m'), date('d'), uniqid(), $file->getClientOriginalExtension());
                        $content = file_get_contents($file->getPathname());
                        $tipo = $file->getClientMimeType();
                        $client->upload('cineco-admin', $filename, $content, $acl);
                        $adjunto = new Adjunto();
                        $adjunto->setRespuesta($respuesta);
                        $adjunto->setUrl($filename);
                        $adjunto->setTipo($tipo);
                        $em->persist($adjunto);
                        $em->flush();
                    }
                }

                $id_estado = $pqrs->getEstado();
                $id_area_pqrs_rep = $pqrs->getArea();
                $area_asignada = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area_pqrs_rep))->getNombre();
                $estado = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Estados')->findOneBy(array('id_estado' => $id_estado))->getNombre();
                $id_comunicacion = $pqrs->getTipoComunicacion();
                $tipo_comunicacion = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:TipoComunicacion')->findOneBy(array('id_comunicacion' => $id_comunicacion))->getNombre();
                $fecha_registro = $pqrs->getFechaRegistro();
                $id_ciudad = $pqrs->getCiudad();
                $id_multiplex = $pqrs->getMultiplex();
                $ciudad = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Ciudad')->findOneBy(array('id_ciudad' => $id_ciudad))->getNombre();
                $multiplex = '-';

                /* if (!in_array(1, $areas_usuario)):
                  if (!in_array((int) $id_area_pqrs_rep->getId(), $areas_usuario)):
                  return $this->redirectToRoute('login');
                  endif;
                  endif; */

                if ($id_multiplex != 0 || $id_multiplex):
                    $multiplex = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Multiplex')->findOneBy(array('id_multiplex' => $id_multiplex))->getNombre();
                endif;

                $nombres_areas = '';
                $areas_referencia = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:AreaPqrs')->findBy(array('areas_pqrs' => $pqrs->getId()));
                if (isset($areas_referencia[0])):
                    foreach ($areas_referencia as $ar):
                        $id_area_ref = $ar->getIdArea();
                        if ($id_area_ref)
                            $nombres_areas[] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:InfoAreaPqrs')->findOneBy(array('id_area' => $id_area_ref))->getNombre();
                    endforeach;
                endif;

                $adjuntos_respuesta = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Adjunto')->findBy(array('respuesta' => $respuesta->getId()));
                $base_url = $this->container->getParameter('pqrs.amazon_s3.base_url');

                foreach ($adjuntos_respuesta as $adj) {
                    $log = new LogError();
                    $log->setFecha(date('Y-m-d h:i:s A'));
                    $log->setAdjunto($base_url . '/' . $adj->getUrl());
                    $log->setPqrs($pqrs->getId());
                    $log->setRespuesta($respuesta->getId());
                    $log_em = $this->getDoctrine()->getManager();
                    $log_em->persist($log);
                    $log_em->flush();
                }

                if ($tipo_comunicacion == 'Petición' || $tipo_comunicacion == 'Queja' || $tipo_comunicacion == 'Sugerencia'):
                    $texto_asunto_correo = 'la';
                    $texto_asunto_correo_1 = 'recibida';
                else:
                    $texto_asunto_correo = 'el';
                    $texto_asunto_correo_1 = 'recibido';
                endif;

                $hoy = date('Y-m-d');
                $fecha_min = strtotime('+2 day', strtotime($hoy));

                $fecha_reg = date('Y-m-d', $pqrs->getFechaRegistro());
                $fecha_max = strtotime('+10 day', strtotime($fecha_reg));

                $dias_reg_min = round($fecha_min / (60 * 60 * 24));
                $dias_reg_max = round($fecha_max / (60 * 60 * 24));
                if ($dias_reg_min > $dias_reg_max):
                    $contenido_correo = 'Por favor, se requiere una respuesta INMEDIATA ya que la Compañía tiene términos legales para dar respuesta a los clientes.
                    Por favor no responda a este correo electrónico. Este es un mensaje informativo';
                else:
                    if ($respuesta->getArea()->getId() != 1):
                        $contenido_correo = 'Por favor, enviarle una respuesta a Servicio al cliente antes de ' . date('d-m-Y', $fecha_min);
                    else:
                        $contenido_correo = 'Por favor, enviarle una respuesta al cliente antes de ' . date('d-m-Y', $fecha_min);
                    endif;
                endif;

                if ($id_estado != 4 && $comuni_prev != 1):
                    foreach ($usuarios_area as $correos):
                        $message = \Swift_Message::newInstance()
                                ->setSubject('[PQRS] Se requiere su respuesta a ' . $texto_asunto_correo . ' ' . $tipo_comunicacion . ' (' . $pqrs->getId() . ')')
                                ->setFrom('sugerencias@cinecolombia.com.co')
                                ->setTo($correos->getCorreo())
                                ->setBody(
                                $this->renderView(
                                        'PqrsBundle:Mails:progreso.html.twig', array(
                                    'id' => $pqrs->getId(),
                                    'tipo' => $tipo_comunicacion,
                                    'respuesta' => $respuesta->getRespuesta(),
                                    'fecha' => date('d-m-Y', $fecha_registro),
                                    'titulo' => 'Se requiere respuesta a esta PQRS',
                                    'autor' => $nombre_usr,
                                    'firma_correo' => $firma_correo,
                                    'areas' => $nombres_areas_usuario,
                                    'adjuntos' => $adjuntos_respuesta,
                                    'base_url' => $base_url,
                                    'contenido_correo' => $contenido_correo,
                                        )
                                )
                                )
                        ;
                        $message->setContentType("text/html");
                        $this->get('mailer')->send($message);
                    endforeach;

                elseif ($comuni_prev == 1 || ($comunicado_final == 1 && $id_estado == 4)):
                    if ($comuni_prev == 1):
                        $titulo_comunicacion = '[PQRS] ' . $tipo_comunicacion . ' (Id. ' . $pqrs->getId() . ')';
                        $texto_recomendacion = '<p>Para poder dar seguimiento a su comunicación, lo invitamos a comunicarse con nuestros números telefónicos, incluídos <a target="_blank" href="http://www.cinecolombia.com/telecineco">aquí</a></p>';
                    else:
                        $titulo_comunicacion = '[PQRS] Se está dando respuesta a ' . $texto_asunto_correo . ' ' . $tipo_comunicacion . ' (Id. ' . $pqrs->getId() . ')';
                        $texto_recomendacion = '';
                    endif;
                    //$titulo_comunicacion = 'Cine Colombia S.A. - '.$tipo_comunicacion.' '.$texto_asunto_correo_1.' en nuestro Portal Cineco (Id. '.$pqrs->getId().')';
                    $base_url = $this->container->getParameter('pqrs.amazon_s3.base_url');

                    $message = \Swift_Message::newInstance()
                            ->setSubject($titulo_comunicacion)
                            ->setFrom('sugerencias@cinecolombia.com.co')
                            ->setTo($pqrs->getCorreo())
                            ->setBody(
                            $this->renderView(
                                    'PqrsBundle:Mails:respuesta.html.twig', array(
                                'id' => $pqrs->getId(),
                                'nombre' => $pqrs->getNombreUsuario(),
                                'fecha' => date('d-m-Y', $fecha_registro),
                                'tipo' => $tipo_comunicacion,
                                'respuesta' => $respuesta->getRespuesta(),
                                'nombre_firma' => $firma_correo,
                                'base_url' => $base_url,
                                'adjuntos' => $adjuntos_respuesta,
                                'texto_recomendacion' => $texto_recomendacion,
                                    )
                            )
                            )
                    ;
                    $message->setContentType("text/html");
                    $this->get('mailer')->send($message);
                endif;

                $fecha_funcion = '';
                $hora_funcion = '';
                $fecha_hora_funcion = $pqrs->getFechaHora();
                $fecha_hora_funcion = explode(' ', $fecha_hora_funcion);
                if (isset($fecha_hora_funcion[0]))
                    $fecha_funcion = $fecha_hora_funcion[0];
                if (isset($fecha_hora_funcion[1]))
                    $hora_funcion = $fecha_hora_funcion[1];

                if ($form['copia']->getData()):
                    foreach ($form['copia']->getData() as $copias):
                        $message = \Swift_Message::newInstance()
                                ->setSubject('Trámite de Sugerencia ' . $pqrs->getId())
                                ->setFrom('sugerencias@cinecolombia.com.co')
                                ->setTo($copias->getCorreo())
                                ->setBody(
                                $this->renderView(
                                        'PqrsBundle:Mails:copia.html.twig', array(
                                    'id' => $pqrs->getId(),
                                    'tipo' => $tipo_comunicacion,
                                    'respuesta' => $respuesta->getRespuesta(),
                                    'fecha' => date('d-m-Y', $fecha_registro),
                                    'ciudad' => $ciudad,
                                    'nombre' => $pqrs->getNombreUsuario(),
                                    'documento' => $pqrs->getDocumentoUsuario(),
                                    'correo' => $pqrs->getCorreo(),
                                    'telefono' => $pqrs->getTelefono(),
                                    'pelicula' => $pqrs->getPelicula(),
                                    'fecha_funcion' => $fecha_funcion,
                                    'hora_funcion' => $hora_funcion,
                                    'multiplex' => $multiplex,
                                    'areas_referencia' => $nombres_areas,
                                    'comentario' => $pqrs->getMotivo(),
                                    'autor' => $nombre_usr,
                                    'asignado' => $area_asignada,
                                        )
                                )
                                )
                        ;
                        $message->setContentType("text/html");
                        $this->get('mailer')->send($message);
                    endforeach;
                endif;

                return $this->redirectToRoute('pqrs_detalle', array('id' => $id));
            }
            return $this->render('PqrsBundle:Respuesta:index.html.twig', array('form' => $form->createView(), 'id' => $id, 'causas' => $nombres_causas,));
        else:
            return $this->redirectToRoute('login');
        endif;
    }

    /**
     * @return Acme\StorageBundle\Uploader\PhotoUploader
     */
    protected function getPhotoUploader() {
        return $this->get('pqrs.file_uploader');
    }

}
