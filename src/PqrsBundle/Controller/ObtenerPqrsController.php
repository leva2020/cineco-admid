<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use PqrsBundle\Entity\Area;
use PqrsBundle\Entity\Pqrs;
use PqrsBundle\Entity\AreaPqrs;
use PqrsBundle\Entity\Ciudad;
use PqrsBundle\Entity\Portal;
use PqrsBundle\Entity\Adjunto;
use Symfony\Component\HttpFoundation\Request;

class ObtenerPqrsController extends Controller {

    public function indexAction(Request $request) {
        $datos = $request->getContent();
        $info = json_decode($datos);
        $fecha_registro = date('Y-m-d h:i A');
        $fecha_registro = strtotime($fecha_registro);
        $documento = '';
        if ($info->documento)
            $documento = (int) $info->documento;

        $multiplex = '-';
        $id_multiplex = 0;
        if ($info->multiplex):
            $multiplex = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Multiplex')->findOneBy(array('id_multiplex' => $info->multiplex))->getNombre();
            $id_multiplex = $info->multiplex;
        endif;
        //print $multiplex; exit();die();return;
        $ciudad = '-';
        $id_ciudad = 0;
        if ($info->ciudad):
            $id_ciudad = $info->ciudad;
            $ciudad = $ciudad = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Ciudad')->findOneBy(array('id_ciudad' => $info->ciudad))->getNombre();
        endif;

        $id_comunicacion = 3;
        if ($info->tipo_comunicacion)
            $id_comunicacion = (int) $info->tipo_comunicacion;

//        $telefono = '';
//        if ($info->telefono)
//            $telefono = (string) $info->telefono;
        
        /* Insercciones para tabla pqrs */
        $pqrs = new Pqrs();
        $area = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->find(1);
        $fecha = $info->fecha;
        $portal = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Portal')->findOneBy(array('dominio' => $info->portal));
        $fecha_hora_comunicacion = $fecha . ' ' . $info->hora;
        $fecha_hora_comunicacion = (string) $fecha_hora_comunicacion;
        $pqrs->setTipoComunicacion($id_comunicacion);
        $pqrs->setFechaHora($fecha_hora_comunicacion);
        $pqrs->setArea($area);
        $pqrs->setPortal($portal);
        $pqrs->setFechaModificacion($fecha_registro);
        $pqrs->setFechaRegistro($fecha_registro);
        $pqrs->setPelicula($info->pelicula);
        $pqrs->setNombreUsuario($info->nombre);
        $pqrs->setDocumentoUsuario($documento);
        $pqrs->setDireccionCorrespondencia($info->direccion);
        $pqrs->setCorreo($info->email);
        $pqrs->setTelefono($info->telefono);
        $pqrs->setMotivo($info->motivo);
        $pqrs->setEstado(1);
        $pqrs->setCiudad($id_ciudad);
        $pqrs->setMultiplex($id_multiplex);
        $pqrs_em = $this->getDoctrine()->getManager();
        $pqrs_em->persist($pqrs);
        $pqrs_em->flush();
        $id_pqrs = $pqrs->getId();

        if (count($info->area_referencia) > 0):
            foreach ($info->area_referencia as $area_ref):
                $area_pqrs = new AreaPqrs();
                $area_pqrs->setAreasPqrs($pqrs);
                $area_pqrs->setIdArea((int) $area_ref->area);
                $area_em = $this->getDoctrine()->getManager();
                $area_em->persist($area_pqrs);
                $area_em->flush();
            endforeach;
        endif;
        $url_adjuntos = array();
        if (isset($info->adjuntos)):
            foreach ($info->adjuntos as $adjunto):
                $url_adjuntos[] = $adjunto->adjunto;
                $adjunto_pqrs = new Adjunto();
                $adjunto_pqrs->setPqrs($pqrs);
                $adjunto_pqrs->setUrl($adjunto->adjunto);
                $adjunto_pqrs->setTipo('usr');
                $adjunto_em = $this->getDoctrine()->getManager();
                $adjunto_em->persist($adjunto_pqrs);
                $adjunto_em->flush();
            endforeach;
        endif;


        $nombres_areas = array();
        //$id_comunicacion = $info->tipo_comunicacion;
        $tipo_comunicacion = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:TipoComunicacion')->findOneBy(array('id_comunicacion' => $id_comunicacion))->getNombre();
        $areas_referencia = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:AreaPqrs')->findBy(array('areas_pqrs' => $id_pqrs));

        if (isset($areas_referencia[0])):
            foreach ($areas_referencia as $ar):
                $id_area_ref = $ar->getIdArea();
                if ($id_area_ref)
                    $nombres_areas[] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:InfoAreaPqrs')->findOneBy(array('id_area' => $id_area_ref))->getNombre();
            endforeach;
        endif;

        $base_url = $this->container->getParameter('pqrs.amazon_s3.base_url');
        $usuarios_correo = $area->getUsuarios();
        foreach ($usuarios_correo as $correos):
            $message = \Swift_Message::newInstance()
                    ->setSubject('Cine Colombia S.A. – ' . $tipo_comunicacion . ' ' . $id_pqrs)
                    ->setFrom('sugerencias@cinecolombia.com.co')
                    ->setTo($correos->getCorreo())
                    ->setBody(
                    $this->renderView(
                            'PqrsBundle:Mails:email.html.twig', array(
                        'id' => $id_pqrs,
                        'ciudad' => $ciudad,
                        'tipo_comunicacion' => $tipo_comunicacion,
                        'nombre' => $info->nombre,
                        'documento' => $documento,
                        'direccion' => $info->direccion,
                        'correo' => $info->email,
                        'telefono' => $info->telefono,
                        'pelicula' => $info->pelicula,
                        'fecha_funcion' => $info->fecha,
                        'hora_funcion' => $info->hora,
                        'multiplex' => $multiplex,
                        'areas_referencia' => $nombres_areas,
                        'comentario' => $info->motivo,
                        'adjuntos' => $url_adjuntos,
                        'base_url' => $base_url,
                            )
                    )
                    )
            ;
            $message->setContentType("text/html");
            $this->get('mailer')->send($message);
        endforeach;

        if ($tipo_comunicacion == 'Petición' || $tipo_comunicacion == 'Queja' || $tipo_comunicacion == 'Sugerencia'):
            $texto_asunto_correo = 'recibida en nuestro Portal Cineco';
        else:
            $texto_asunto_correo = 'recibido en nuestro Portal Cineco';
        endif;

        $message = \Swift_Message::newInstance()
                ->setSubject('Cine Colombia S.A. – ' . $tipo_comunicacion . ' ' . $texto_asunto_correo . ' (Id. '.$pqrs->getId().')')
                ->setFrom('sugerencias@cinecolombia.com.co')
                ->setTo($info->email)
                ->setBody(
                $this->renderView(
                        'PqrsBundle:Mails:mensaje-usuario.html.twig', array(
                    'id' => $id_pqrs,
                    'ciudad' => $ciudad,
                    'tipo_comunicacion' => $tipo_comunicacion,
                    'nombre' => $info->nombre,
                    'documento' => $documento,
                    'direccion' => $info->direccion,
                    'correo' => $info->email,
                    'telefono' => $info->telefono,
                    'pelicula' => $info->pelicula,
                    'fecha_funcion' => $info->fecha,
                    'hora_funcion' => $info->hora,
                    'multiplex' => $multiplex,
                    'areas_referencia' => $nombres_areas,
                    'comentario' => $info->motivo,
                    'adjuntos' => $url_adjuntos,
                    'base_url' => $base_url,
                        )
                )
                )
        ;
        $message->setContentType("text/html");
        $this->get('mailer')->send($message);

        return new Response($id_pqrs);
    }

    /**
     * @return Acme\StorageBundle\Uploader\PhotoUploader
     */
//    protected function getFileUploader()
//    {
//        return $this->get('pqrs.file_uploader');
//    }
}
