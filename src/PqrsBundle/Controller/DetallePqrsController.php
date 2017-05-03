<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DetallePqrsController extends Controller {

    public function indexAction(Request $request, $id) {
        $session = $request->getSession();
        if($session->get('name')):
            
            $tokens = $session->get('tokens');
            $permisos = $tokens['permisos_nombres'];
            if (!in_array('LEER', $permisos) && in_array('CONSULTAR', $permisos)):
                return $this->redirectToRoute('reporte_ventas_diarias');            
            endif;
            $areas_usuario = $tokens['areas'];
            $pqrs = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Pqrs')->find($id);
            $id_ciudad = $pqrs->getCiudad();
            $id_multiplex = $pqrs->getMultiplex();
            $multiplex = '-';
            if($id_multiplex != 0 || $id_multiplex):
                $multiplex = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Multiplex')->findOneBy(array('id_multiplex' => $id_multiplex))->getNombre();
            endif;
            $ciudad = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Ciudad')->findOneBy(array('id_ciudad' => $id_ciudad))->getNombre();
            $id_estado = $pqrs->getEstado();
            $id_area = $pqrs->getArea();
            $id_comunicacion = $pqrs->getTipoComunicacion();            
            
            /*if(!in_array(1, $areas_usuario)):
                if(!in_array((int)$id_area->getId(), $areas_usuario)):
                    return $this->redirectToRoute('login');
                endif;
            endif;*/
            
            $estado = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Estados')->findOneBy(array('id_estado' => $id_estado))->getNombre();
            $area = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area))->getNombre();
            $tipo_comunicacion = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:TipoComunicacion')->findOneBy(array('id_comunicacion' => $id_comunicacion))->getNombre();
            $fecha_registro = $pqrs->getFechaRegistro();
            $fecha_hora = $pqrs->getFechaHora();
            //$fecha_hora = date('Y - m - d',$fecha_hora);
            $fecha_registro = date('d/m/Y',$fecha_registro);
            $fecha_modificacion = $pqrs->getFechaModificacion();
            $fecha_modificacion = date('d/m/Y',$fecha_modificacion);
            $nombres_areas = array();
            
            $nombres_causas = '';
            $respuestas_pqrs = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Respuesta')->findBy(array('pqrs' => $id), array('id'=>'desc'));
            if(is_array($respuestas_pqrs) && !empty($respuestas_pqrs)):
                foreach($respuestas_pqrs[0]->getCausa() as $causas):
                    $nombres_causas .= $causas->getCausa().',';
                endforeach;
            endif;
            $nombres_causas = trim($nombres_causas, ',');
            
            $areas_referencia = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:AreaPqrs')->findBy(array('areas_pqrs' => $id));
            //var_dump($areas_referencia[0]->getIdArea());
            if(isset($areas_referencia[0])):
                foreach($areas_referencia as $ar):
                    $id_area_ref = $ar->getIdArea();
                    if($id_area_ref)
                        $nombres_areas[] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:InfoAreaPqrs')->findOneBy(array('id_area' => $id_area_ref))->getNombre();           
                endforeach;
            endif;
            $adjunto_url = array();
            $adjuntos = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Adjunto')->findBy(array('pqrs' => $id));
            foreach($adjuntos as $ad):
                //$url_adjunto = str_replace('http://www.cinecolombia.com/sites/','/sites/', $ad->getUrl());
                //$adjunto_url[] = $url_adjunto;  
                $adjunto_url[] = $ad->getUrl();
            endforeach;
            
            if(in_array('COMUNICAR', $permisos)):
                $opciones = array('pqrs' => $id);
            else:
                $opciones = array('pqrs' => $id, 'comunicacion_previa' => '');
            endif;
            $respuestas_pqrs = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Respuesta')->findBy($opciones, array('id'=>'desc'));
            $i=0;            
            $datos_res = array();
            foreach($respuestas_pqrs as $res):
                $id_estado_respuesta = $res->getEstado();
                $datos_res[$i]['estado'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Estados')->findOneBy(array('id_estado' => $id_estado_respuesta))->getNombre();
                $datos_res[$i]['area'] = $res->getArea()->getNombre();
                $datos_res[$i]['area_ant'] = $res->getAreaResAnt()->getNombre();
                $i++;
            endforeach;
            
            
            return $this->render('PqrsBundle:DetallePqrs:index.html.twig', array(
                'pqrs' => $pqrs,
                'area' => $area,
                'ciudad' => $ciudad,
                'multiplex' => $multiplex,
                'fecha_registro' => $fecha_registro,
                'fecha_modificacion' => $fecha_modificacion,
                'fecha_hora' => $fecha_hora,
                'estado' => $estado,
                'tipo_comunicacion' => $tipo_comunicacion,
                'respuestas' => $respuestas_pqrs,
                'info_res' => $datos_res,
                'areas_referencia' => $nombres_areas,
                'adjuntos' => $adjunto_url,
                'causas' => $nombres_causas,
            ));
        else:
            return $this->redirectToRoute('login');
        endif;
    }

}
