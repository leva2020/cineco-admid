<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use PqrsBundle\Entity\Pqrs;
use PqrsBundle\Form\FiltroPqrsType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use PqrsBundle\Entity\Portal;
use Liuggio\ExcelBundle;
use PHPExcel_Style_Fill;
use PHPExcel_Worksheet;
use PHPExcel_Worksheet_ColumnDimension;
use PHPExcel_Style_Border;
use Doctrine\ORM\QueryBuilder;

class ReportesPqrsController extends Controller {

    public function indexAction(Request $request) {
        $session = $request->getSession();
        if ($session->get('name')):
            $tokens = $session->get('tokens');
            $multiplex = array();
            if (isset($tokens['multiplex']))
                $multiplex = $tokens['multiplex'];
            $areas = $tokens['areas'];
            $permisos = $tokens['permisos_nombres'];
            //if (!in_array('CONSULTAR', $permisos)):
            if (in_array(1, $areas) || in_array('ADMIN', $tokens['roles'])):
                $pqrs = array();
                $em = $this->getDoctrine()->getManager();
                $form_pqrs = new Pqrs();
                $lista_multiplex = array();
                $listado_id_multiplex = '';
                $hoy = strtotime(date('Y-m-d h:i A'));
                $lista_multiplex = $em->getRepository('PqrsBundle:Multiplex')->findAll();
                $listado_multiplex = array();
                foreach ($lista_multiplex as $mul):
                    if (in_array(1, $areas) || in_array('ADMIN', $tokens['roles'])):
                        $listado_multiplex[0] = 'TODOS';
                        $listado_multiplex[1] = 'OTROS';
                        $listado_multiplex[$mul->getIdMultiplex()] = $mul->getNombre();
                        $listado_id_multiplex .= $mul->getIdMultiplex() . ',';
                    else:
                        if (in_array($mul->getId(), $multiplex)):
                            $listado_multiplex[0] = 'TODOS';
                            $listado_multiplex[1] = 'OTROS';
                            $listado_multiplex[$mul->getIdMultiplex()] = $mul->getNombre();
                            $listado_id_multiplex .= $mul->getIdMultiplex() . ',';
                        endif;
                    endif;
                endforeach;

                $form = $this->createFormBuilder()
                        ->add('multiplex', 'choice', array(
                            'choices' => $listado_multiplex,
                            'empty_value' => 'Todos',
                            'label' => 'Teatro',
                            'expanded' => true,
                            'required' => true,
                            'multiple' => true,
                            'attr' => array('class' => 'input-small')
                        ))
                        ->add('fecha_registro', 'text', array(
                            'label' => 'Rango de fechas',
                            'required' => true,
                            'mapped' => false,
                            'attr' => array('class' => 'fecha-inicial')
                        ))
                        ->add('save', 'submit', array(
                            'label' => 'Buscar',
                            'attr' => array('class' => 'btn btn-primary')))
                        ->getForm();
                $datos_filtro = '';
                $fecha_ini = '';
                $fecha_fin = '';
                $form->handleRequest($request);
                if ($form->isValid()):
                    if (strlen($listado_id_multiplex) == 0):
                        $this->get('session')->getFlashBag()->add(
                                'error', 'Debes tener al menos un teatro.'
                        );
                    else:
                        $fecha_ini = strtotime(date('2015-01-01'));
                        $fecha_fin = date('Y-m-d');
                        $fecha_fin = strtotime('+1 day', strtotime($fecha_fin));
                        if ($_POST['form']['fecha_registro']):
                            $fecha_inicial = $_POST['form']['fecha_registro'];
                            $fecha_inicial = explode('-', $fecha_inicial);
                            $fecha_ini = $fecha_inicial[0];
                            $fecha_ini = str_replace('/', '-', $fecha_ini);
                            $fecha_ini = date('Y-m-d', strtotime($fecha_ini));
                            $fecha_fin = $fecha_inicial[1];
                            $fecha_fin = str_replace('/', '-', $fecha_fin);
                            $fecha_fin = date('Y-m-d', strtotime($fecha_fin));
                            $fecha_ini = strtotime($fecha_ini);
                            /* if ($fecha_ini > $hoy):
                              print '<script>alert("La fecha inicial no puede ser superior al día de hoy.");</script>';
                              endif; */
                            $fecha_fin = strtotime('+1 day', strtotime($fecha_fin));
                        endif;
                        if (isset($_POST['form']['multiplex'])):
                            if (in_array(0, $_POST['form']['multiplex'])):
                                $datos_filtro = $listado_id_multiplex . '0,';
                            else:
                                foreach ($_POST['form']['multiplex'] as $ids):
                                    $datos_filtro .= $ids . ',';
                                endforeach;
                                $array_datos_filtro = explode(',', $datos_filtro);
                                $array_datos_filtro[0] = '0';
                                $datos_filtro = implode(',',$array_datos_filtro);
                            endif;
                        else:
                            $datos_filtro = $listado_id_multiplex . '0,';
                        endif;
                        setcookie("fecha_ini", $fecha_ini, time() + 10);
                        setcookie("fecha_fin", $fecha_fin, time() + 10);
                        $datos_filtro = substr($datos_filtro, 0, -1);
                        $em = $this->getDoctrine()->getManager();
                        $dql = "select p from PqrsBundle:Pqrs p
                            WHERE p.fecha_registro BETWEEN " . $fecha_ini . " AND " . $fecha_fin . "
                            AND 
                            p.multiplex IN (" . $datos_filtro . ")
                            ORDER BY p.id DESC
                        ";
                        //var_dump($datos_filtro);
                        $query = $em->createQuery($dql);
                        $pqrs = $query->getResult();
                        if (empty($pqrs)):
                            $this->get('session')->getFlashBag()->add(
                                    'error', 'No hay coincidencias para esta busqueda.'
                            );
                        endif;
                    endif;
                endif;

                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                        $pqrs, $this->get('request')->query->get('page', 1), 20
                );

                $datos_pqrs = array();
                $i = 0;

                foreach ($pqrs as $pq):
                    $fecha_hora = $pq->getFechaHora();
                    $fecha = $pq->getFechaRegistro();
                    $fecha = date('d/m/Y h:i:s A', $fecha);
                    $id_estado = $pq->getEstado();
                    $estado = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Estados')->findOneBy(array('id_estado' => $id_estado))->getNombre();
                    $portal = $pq->getPortal();
                    $portal = $portal->getNombre();
                    $datos_pqrs[$pq->getId()]['estado'] = $estado;
                    $datos_pqrs[$pq->getId()]['portal'] = $portal;
                    $datos_pqrs[$pq->getId()]['fechahora'] = $fecha_hora;
                    $datos_pqrs[$pq->getId()]['fecha'] = $fecha;
                    $id_area = $pq->getArea();
                    $datos_pqrs[$pq->getId()]['area'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area))->getNombre();

                    $id_ciudad = $pq->getCiudad();
                    $datos_pqrs[$pq->getId()]['ciudad'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Ciudad')->findOneBy(array('id_ciudad' => $id_ciudad))->getNombre();
                    $id_multiplex = $pq->getMultiplex();
                    if ($id_multiplex != 0 || $id_multiplex):
                        $datos_pqrs[$pq->getId()]['multiplex'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Multiplex')->findOneBy(array('id_multiplex' => $id_multiplex))->getNombre();
                    else:
                        $datos_pqrs[$pq->getId()]['multiplex'] = '';
                    endif;                
                    $id_comunicacion = $pq->getTipoComunicacion();
                    $datos_pqrs[$pq->getId()]['tipo_comunicacion'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:TipoComunicacion')->findOneBy(array('id_comunicacion' => $id_comunicacion))->getNombre();
                    $nombres_areas = array();
                    $areas_referencia = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:AreaPqrs')->findBy(array('areas_pqrs' => $pq->getId()));
                    if (isset($areas_referencia[0])):
                        foreach ($areas_referencia as $ar):
                            $id_area_ref = $ar->getIdArea();
                            if ($id_area_ref)
                                $nombres_areas[] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:InfoAreaPqrs')->findOneBy(array('id_area' => $id_area_ref))->getNombre();
                        endforeach;
                    endif;
                    $datos_pqrs[$pq->getId()]['nombres_areas'] = $nombres_areas;
                    $i++;
                endforeach;
                $datos_filtros = array('multiplex' => $datos_filtro, 'fecha_ini' => $fecha_ini, 'fecha_fin' => $fecha_fin,);
                $filtros = serialize($datos_filtros);
                $filtros = (string) $filtros;
                return $this->render('PqrsBundle:Reportes:pqrs.html.twig', array('form' => $form->createView(), 'pqrs' => $pqrs, 'datos' => $datos_pqrs, 'filtros' => $filtros, 'permisos' => $permisos, 'areas' => $areas, 'roles' => $tokens['roles'],));
            else:
                /*$this->get('session')->getFlashBag()->add(
                        'error_ingreso', 'Pailas no tiene permisos!!!.'
                );*/
                return $this->redirectToRoute('login');
            endif;
        else:
            return $this->redirectToRoute('login');
        endif;
    }

    public function generarAction($filtros) {
        $em = $this->getDoctrine()->getManager();
        $datos_filtro = unserialize($filtros);
        if ($datos_filtro['multiplex']):
            $em = $this->getDoctrine()->getManager();
            $dql = "select p from PqrsBundle:Pqrs p
                        WHERE p.fecha_registro BETWEEN " . $datos_filtro['fecha_ini'] . " AND " . $datos_filtro['fecha_fin'] . "
                        AND 
                        p.multiplex IN (" . $datos_filtro['multiplex'] . ")
                        ORDER BY p.id DESC
                    ";
            $query = $em->createQuery($dql);
            $pqrs = $query->getResult();
            if (empty($pqrs)):
                $this->get('session')->getFlashBag()->add(
                        'error', 'No hay coincidencias para esta busqueda.'
                );
            endif;


            $datos_pqrs = array();
            $i = 0;
            $hoy = strtotime(date('Y-m-d h:i A'));
            foreach ($pqrs as $pq):
                $fecha_hora = $pq->getFechaHora();
                $fecha = $pq->getFechaRegistro();
                $fecha = date('d/m/Y h:i:s A', $fecha);
                $id_estado = $pq->getEstado();
                $estado = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Estados')->findOneBy(array('id_estado' => $id_estado))->getNombre();
                $portal = $pq->getPortal();
                $portal = $portal->getNombre();
                $datos_pqrs[$pq->getId()]['estado'] = $estado;
                $datos_pqrs[$pq->getId()]['portal'] = $portal;
                $datos_pqrs[$pq->getId()]['fechahora'] = $fecha_hora;
                $datos_pqrs[$pq->getId()]['fecha'] = $fecha;
                $id_area = $pq->getArea();
                $datos_pqrs[$pq->getId()]['area'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area))->getNombre();
                $id_ciudad = $pq->getCiudad();
                $datos_pqrs[$pq->getId()]['ciudad'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Ciudad')->findOneBy(array('id_ciudad' => $id_ciudad))->getNombre();
                $id_multiplex = $pq->getMultiplex();
                if ($id_multiplex != 0 || $id_multiplex):
                    $datos_pqrs[$pq->getId()]['multiplex'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Multiplex')->findOneBy(array('id_multiplex' => $id_multiplex))->getNombre();
                else:
                    $datos_pqrs[$pq->getId()]['multiplex'] = '';
                endif;
                $id_comunicacion = $pq->getTipoComunicacion();
                $datos_pqrs[$pq->getId()]['tipo_comunicacion'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:TipoComunicacion')->findOneBy(array('id_comunicacion' => $id_comunicacion))->getNombre();
                $nombres_areas = array();
                $areas_referencia = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:AreaPqrs')->findBy(array('areas_pqrs' => $pq->getId()));
                if (isset($areas_referencia[0])):
                    foreach ($areas_referencia as $ar):
                        $id_area_ref = $ar->getIdArea();
                        if ($id_area_ref)
                            $nombres_areas[] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:InfoAreaPqrs')->findOneBy(array('id_area' => $id_area_ref))->getNombre();
                    endforeach;
                endif;
                $datos_pqrs[$pq->getId()]['nombres_areas'] = $nombres_areas;
                $i++;
            endforeach;

            $styleTitulos = array(
                'font' => array(
                    'bold' => true,
                    'color' => array('rgb' => 'FFFFFF'),
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '6495ed'),
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => 'FFFFFF'),
                    )
                ),
            );
            $styleResultados = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ADD8E6'),
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
            );
            $styleEncabezados = array(
                'font' => array(
                    'color' => array('rgb' => '6495ed'),
                    'bold' => true,
                    'size' => 20,
                    'name' => 'Thaoma'
                ),
            );

            $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
            $phpExcelObject->getProperties()->setCreator("PQRS")
                    ->setLastModifiedBy("PQRS")
                    ->setTitle("Reporte PQRS")
                    ->setSubject("Reporte PQRS")
                    ->setDescription("Archivo con resusltados de pqrs")
                    ->setKeywords("pqrs xls")
                    ->setCategory("Reportes");
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C1', 'REPORTES PORTAL CINECO -  PQRS');
            $phpExcelObject->getActiveSheet()->getStyle('C1:C2')->applyFromArray($styleEncabezados);
            $phpExcelObject->getActiveSheet()->getRowDimension(1)->setRowHeight(40);
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('E3', 'Fecha Incio')
                    ->setCellValue('F3', 'Fecha Fin')
                    ->setCellValue('E4', date('d/m/Y', $datos_filtro['fecha_ini']))
                    ->setCellValue('F4', date('d/m/Y', $datos_filtro['fecha_fin']));
            $phpExcelObject->getActiveSheet()->getStyle('A7:M7')->applyFromArray($styleTitulos);
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A7', 'Ciudad')
                    ->setCellValue('B7', 'Nombre Teatro')
                    ->setCellValue('C7', 'Tipo de Comentario')
                    ->setCellValue('D7', 'Temas')
                    ->setCellValue('E7', 'Numero de suegerencia')
                    ->setCellValue('F7', 'Sugerencia Id')
                    ->setCellValue('G7', 'Fecha de Sugerencia')
                    ->setCellValue('H7', 'Fecha de Función')
                    ->setCellValue('I7', 'Pelicula')
                    ->setCellValue('J7', 'Usuario')
                    ->setCellValue('K7', 'Email')
                    ->setCellValue('L7', 'Sugerencia Comentario')
                    ->setCellValue('M7', 'Teléfono');
            $i = 8;
            $j = 1;
            foreach ($pqrs as $pq):
                $nombres_areas = '';
                foreach ($datos_pqrs[$pq->getId()]['nombres_areas'] as $areas):
                    $nombres_areas .= $areas . ',';
                endforeach;
                $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $datos_pqrs[$pq->getId()]['ciudad'])
                        ->setCellValue('B' . $i, $datos_pqrs[$pq->getId()]['multiplex'])
                        ->setCellValue('C' . $i, $datos_pqrs[$pq->getId()]['tipo_comunicacion'])
                        ->setCellValue('D' . $i, $nombres_areas)
                        ->setCellValue('E' . $i, $j)
                        ->setCellValue('F' . $i, $pq->getId())
                        ->setCellValue('G' . $i, $datos_pqrs[$pq->getId()]['fecha'])
                        ->setCellValue('H' . $i, $datos_pqrs[$pq->getId()]['fechahora'])
                        ->setCellValue('I' . $i, $pq->getPelicula())
                        ->setCellValue('J' . $i, $pq->getNombreUsuario())
                        ->setCellValue('K' . $i, $pq->getCorreo())
                        ->setCellValue('L' . $i, $pq->getMotivo())
                        ->setCellValue('M' . $i, $pq->getTelefono());
                $phpExcelObject->getActiveSheet()->getStyle("A8:M$i")->applyFromArray($styleResultados);
                $i++;
                $j++;
            endforeach;
            $phpExcelObject->getActiveSheet()->setTitle('Reporte PQRS');
            $phpExcelObject->setActiveSheetIndex(0);
            $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
            $response = $this->get('phpexcel')->createStreamedResponse($writer);
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Content-Disposition', 'attachment;filename=reporte-pqrs.xls');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Cache-Control', 'maxage=1');
            return $response;
        else:
            return $this->redirectToRoute('reporte_pqrs');
        endif;
    }

}
