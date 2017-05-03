<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PqrsBundle\Entity\Pqrs;
use Symfony\Component\HttpFoundation\Response;

class AlertasPqrsController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $pqrs = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Pqrs')->findBy(array(), array('id' => 'desc'));
        $hoy = strtotime(date('Y-m-d'));
        $alerta_amarilla = '';
        $alerta_roja = '';
        $variables_globales = $em->getRepository('PqrsBundle:VariablesGlobales')->findAll();
        foreach ($variables_globales as $var):
            if ($var->getNombre() == 'dias_alertas_correos') {
                $dias_alertas_correos = $var->getValor();
            }
        endforeach;
        foreach ($pqrs as $pq):
            $fecha_hora = $pq->getFechaHora();
            $fecha = $pq->getFechaRegistro();
            $fecha_mod = $pq->getFechaModificacion();
            $dias_reg = $hoy - $fecha;
            $dias_reg = round($dias_reg / (60 * 60 * 24));
            $dias_plazo = $dias_reg + $alerta_amarilla;
            $fecha_plazo = date('Y-m-d', strtotime('+2 days'));

            $fecha = date('d-m-Y', $fecha);
            $id_estado = $pq->getEstado();
            
            if($id_estado != 4 && $dias_alertas_correos < $dias_reg) {
                
                $estado = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Estados')->findOneBy(array('id_estado' => $id_estado))->getNombre();
                $estado = $estado;
                $id_comunicacion = $pq->getTipoComunicacion();
                $tipo_comunicacion = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:TipoComunicacion')->findOneBy(array('id_comunicacion' => $id_comunicacion))->getNombre();
                $id_area = $pq->getArea();
                $usuarios_area = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area))->getUsuarios();
                $nombre_area = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area))->getNombre();
                $titulo = 'Tiene una respuesta pendiente a esta PQRS';
                $tipo = $tipo_comunicacion . ' (' . $pq->getId() . ')';
                $texto = 'Agradecemos su respuesta antes de ' . $fecha_plazo . '.';
                if ($dias_plazo > 10):
                    $texto = 'Se requiere una respuesta INMEDIATA ya que la Compañía tiene términos legales para dar respuesta a los clientes';
                endif;

                if ($tipo_comunicacion == 'Petición' || $tipo_comunicacion == 'Queja' || $tipo_comunicacion == 'Sugerencia'):
                    $texto_asunto_correo = 'la';
                else:
                    $texto_asunto_correo = 'el';
                endif;
                $respuestas_pqrs = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Respuesta')->findBy(array('pqrs' => $pq->getId()), array('id' => 'desc'));
                $texto_respuesta = '';
                $adjuntos_respuesta = '';
                $autor = '';
                if (is_array($respuestas_pqrs) && !empty($respuestas_pqrs)):
                    $adjuntos_respuesta = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Adjunto')->findBy(array('respuesta' => $respuestas_pqrs[0]->getId()));
                    $texto_respuesta = $respuestas_pqrs[0]->getRespuesta();
                    $autor = $respuestas_pqrs[0]->getUsuario();
                endif;

                $base_url = $this->container->getParameter('pqrs.amazon_s3.base_url');
                
                
                if ($id_estado != 4):
                    foreach ($usuarios_area as $correos):
                        $message = \Swift_Message::newInstance()
                                ->setSubject('[PQRS] Tiene una respuesta pendiente de ' . $texto_asunto_correo . ' ' . $tipo_comunicacion . ' (' . $pq->getId() . ')')
                                ->setFrom('sugerencias@cinecolombia.com.co')
                                ->setTo($correos->getCorreo())
                                ->setBody(
                                $this->renderView(
                                        'PqrsBundle:Mails:alerta.html.twig', array('area' => $nombre_area, 'id' => $pq->getId(), 'titulo' => $titulo, 'tipo' => $tipo, 'texto' => $texto, 'autor' => $autor, 'respuesta' => $texto_respuesta, 'adjuntos' => $adjuntos_respuesta, 'base_url' => $base_url)
                                )
                                )
                        ;
                        $message->setContentType("text/html");
                        $this->get('mailer')->send($message);
                    endforeach;
                endif;
            }
        endforeach;

        return new Response('Correos enviados. ');
    }

}
