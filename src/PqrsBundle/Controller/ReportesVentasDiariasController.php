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
use Doctrine\DBAL\DriverManager;

class ReportesVentasDiariasController extends Controller {

    public function indexAction(Request $request) {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $variables_globales = $em->getRepository('PqrsBundle:VariablesGlobales')->findAll();
        foreach ($variables_globales as $var):
            if ($var->getNombre() == 'bd_reportes') {
                $bd_reportes = $var->getValor();
            }
            if ($var->getNombre() == 'user_db_reportes') {
                $user_db_reportes = $var->getValor();
            }
            if ($var->getNombre() == 'password_db_reportes') {
                $password_db_reportes = $var->getValor();
            }
            if ($var->getNombre() == 'host_db_reportes') {
                $host_db_reportes = $var->getValor();
            }
        endforeach;
        if ($session->get('name')):
            $params = array(
                'driver' => 'pdo_mysql',
                'host' => $host_db_reportes,
                'port' => '3306',
                'dbname' => $bd_reportes,
                'user' => $user_db_reportes,
                'password' => $password_db_reportes,
            );
            $conn = DriverManager::getConnection($params);
            $tokens = $session->get('tokens');
            $multiplex = array();
            if (isset($tokens['multiplex']))
                $multiplex = $tokens['multiplex'];

            $areas = $tokens['areas'];
            $permisos = $tokens['permisos_nombres'];
            if (!in_array('CONSULTAR', $permisos)):
                $this->get('session')->getFlashBag()->add(
                        'error_ingreso', 'Pailas no tiene permisos!!!.'
                );
                return $this->redirectToRoute('login');
            endif;

            $pqrs = array();
            $form_pqrs = new Pqrs();
            $lista_multiplex = array();
            $listado_id_multiplex = '';
            $fecha_ini = '';
            $fecha_fin = '';
            $tipo_fecha = '';
            $hoy = strtotime(date('Y-m-d h:i A'));
            $lista_multiplex = $em->getRepository('PqrsBundle:Multiplex')->findAll();
            $listado_multiplex = array();
            foreach ($lista_multiplex as $mul):
                if (in_array('ADMIN_REPORTES', $tokens['roles'])):
                    $listado_multiplex[0] = 'TODOS';
                    $listado_multiplex[$mul->getIdMultiplex()] = $mul->getNombre();
                    $listado_id_multiplex .= $mul->getIdMultiplex() . ',';
                else:
                    if (in_array($mul->getId(), $multiplex)):
                        $listado_multiplex[0] = 'TODOS';
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
                        'required' => false,
                        'multiple' => true,
                        'empty_value' => 'false',
                        'attr' => array(
                            'class' => 'input-small'
                        )
                    ))
                    ->add('consolidado', 'checkbox', array(
                        'label' => 'Consolidado',
                        'mapped' => false,
                        'required' => false
                    ))
                    ->add('tipo_fecha', 'choice', array(
                        'choices' => array(0 => 'Fecha Transacción', 1 => 'Fecha de Cierre'),
                        //'empty_value' => 'Elija un tipo de fecha',
                        'preferred_choices' => array(0),
                        'label' => 'Tipo de fecha',
                        'mapped' => false,
                        'required' => true,
                        'attr' => array('class' => 'tipo-fecha')
                    ))
                    ->add('fecha_registro', 'text', array(
                        'label' => 'Rango de Fechas',
                        'required' => true,
                        'mapped' => false,
                        'attr' => array('class' => 'fecha-inicial')
                    ))
                    ->add('save', 'submit', array(
                        'label' => 'Buscar',
                        'attr' => array('class' => 'btn btn-primary', 'onclick' => 'validar_envio()',)))
                    ->getForm();
            $datos_filtro = '';
            $reporte = array();
            $consolidado = false;
            $listado_ids_entidades = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,);
            $listado_localidades = array('GN', 'PF');
            $listado_tipo_compra = array(1, 2);
            $condicion = array();
            $bandera = 0;
            $estado_consolidado = 'none';
            $form->handleRequest($request);
            if ($form->isValid()):
                //var_dump(strlen($listado_id_multiplex));
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
                        $fecha_fin_0 = strtotime($fecha_fin);
                        $fecha_ini = strtotime($fecha_ini);
                        $fecha_fin = strtotime('+1 day', strtotime($fecha_fin));
                    endif;
                    if (isset($_POST['form']['multiplex'])):
                        if (in_array(0, $_POST['form']['multiplex'])):
                            $datos_filtro = $listado_id_multiplex;
                        else:
                            foreach ($_POST['form']['multiplex'] as $ids):
                                $datos_filtro .= $ids . ',';
                            endforeach;
                        endif;
                    endif;

                    if (isset($_POST['form']['consolidado'])):
                        $consolidado = true;
                        $estado_consolidado = '';
                    endif;
                    if ($_POST['form']['tipo_fecha'] == 1):
                        $tipo_fecha = 'transaction_close_day_date';
                    else:
                        $tipo_fecha = 'created';
                    endif;
                    setcookie("fecha_ini", $fecha_ini, time() + 10);
                    setcookie("fecha_fin", $fecha_fin, time() + 10);
                    $datos_filtro = substr($datos_filtro, 0, -1);
                    $ids_teatros_buscar = explode(',', $datos_filtro);
                    /* pre filtro */
                    $bandera = 0;
                    $filtro_cierre = array();
                    if ($tipo_fecha == 'transaction_close_day_date') {
                        $bandera = 1;


                        foreach ($ids_teatros_buscar as $ids_te) {
                            $cierres_teatros = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Cierre')->findBy(array('id_multiplex' => $ids_te));
                            if (isset($cierres_teatros[0])) {
                                //if ($cierres_teatros) {
                                foreach ($cierres_teatros as $cr_te) {
                                    $fecha_cierre = $cr_te->getFechaCierre();
                                    //if ($fecha_ini <= $fecha_cierre && $fecha_cierre <= $fecha_fin) {
                                    //print $fecha_ini . ' ' . $fecha_cierre . '</br>';
                                    if ($fecha_ini == $fecha_cierre) {
                                        $fecha_apertura = $cr_te->getFechaCierreAnterior();
                                        $fecha_sistema = $cr_te->getFechaSistema();
                                        $id_teatro_cierre = $cr_te->getIdMultiplex();
                                        $filtro_cierre[$id_teatro_cierre] = array(
                                            'fecha_apertura' => $fecha_apertura,
                                            'fecha_sistema' => $fecha_sistema,
                                        );
                                    }
                                }
                            }
                        }
                        if ($fecha_ini != $fecha_fin_0) {
                            foreach ($ids_teatros_buscar as $ids_te) {
                                $cierres_teatros = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Cierre')->findBy(array('id_multiplex' => $ids_te));
                                if (isset($cierres_teatros[0])) {
                                    //if ($cierres_teatros) {
                                    foreach ($cierres_teatros as $cr_te) {
                                        $fecha_cierre = $cr_te->getFechaCierre();
                                        if ($fecha_fin_0 == $fecha_cierre) {
                                            $fecha_apertura = $cr_te->getFechaCierreAnterior();
                                            $fecha_sistema = $cr_te->getFechaSistema();
                                            $id_teatro_cierre = $cr_te->getIdMultiplex();
                                            $filtro_cierre[$id_teatro_cierre] = array(
                                                'fecha_sistema' => $fecha_sistema,
                                            );
                                        }
                                    }
                                }
                            }
                        }
                        $tipo_fecha = 'created';
                    }
                    $resultado = array();
                    /* fin prefiltro */
                    if ($bandera == 0) {
                        if ($datos_filtro) {
                            $sql = 'SELECT * FROM cc_transaction 
                            WHERE ' . $tipo_fecha . ' BETWEEN ' . $fecha_ini . ' AND ' . $fecha_fin . '
                            AND 
                            multiplex_ecall_id IN (' . $datos_filtro . ')
                            AND
                            transaction_state_id = 4
                            ORDER BY transaction_id DESC   
                            ';
                            $stmt = $conn->query($sql);
                            $resultado = $stmt->fetchAll();
                        }
                    } else {
                        if ($filtro_cierre) {
                            $i = 0;
                            $condicion = array();
                            foreach ($filtro_cierre as $key => $fc) {
                                $condicion[] = '(multiplex_ecall_id = ' . $key . ' AND (' . $tipo_fecha . ' BETWEEN ' . $fc['fecha_apertura'] . ' AND ' . $fc['fecha_sistema'] . '))';
                            }
                            $sql = 'SELECT * FROM cc_transaction 
                                WHERE (' . implode(' OR ', $condicion) . ')
                                AND
                                transaction_state_id = 4
                                ORDER BY transaction_id DESC
                                ';
                            $stmt = $conn->query($sql);
                            $resultado = $stmt->fetchAll();
                        }
                    }

                    if (count($resultado) > 0):
                        $i = 0;
                        foreach ($resultado as $row):
                            $sql_tran = 'select transaction_type_name from cc_transaction_type where transaction_type_id = ' . $row['transaction_type_id'];
                            $tipo_stmt = $conn->query($sql_tran);
                            $nombre_localidad = 'Preferencial';
                            if ($row['area_id'] == 'GN'):
                                $nombre_localidad = 'General';
                            endif;
                            $reporte[$row['multiplex_ecall_id']][$i]['id_entidad'] = $row['payment_method_id'];
                            $reporte[$row['multiplex_ecall_id']][$i]['id'] = $row['transaction_id'];
                            $reporte[$row['multiplex_ecall_id']][$i]['entidad'] = $row['payment_method_name'];
                            $reporte[$row['multiplex_ecall_id']][$i]['localidad'] = $row['area_id'];
                            $reporte[$row['multiplex_ecall_id']][$i]['localidad_nombre'] = $nombre_localidad;
                            $reporte[$row['multiplex_ecall_id']][$i]['tipo'] = $tipo_stmt->fetch()['transaction_type_name'];
                            $reporte[$row['multiplex_ecall_id']][$i]['id_tipo'] = $row['transaction_type_id'];
                            $reporte[$row['multiplex_ecall_id']][$i]['total_tran'] = 1;
                            $reporte[$row['multiplex_ecall_id']][$i]['no_boletas'] = $row['ticket_amount'];
                            $reporte[$row['multiplex_ecall_id']][$i]['ingresos_suple'] = $row['transaction_total_service'];
                            $reporte[$row['multiplex_ecall_id']][$i]['ingreso_boletas'] = $row['transaction_value'];
                            $reporte[$row['multiplex_ecall_id']][$i]['total_ingre'] = $row['transaction_total'];
                            $reporte[$row['multiplex_ecall_id']][$i]['id_multiplex'] = $row['multiplex_ecall_id'];
                            $reporte[$row['multiplex_ecall_id']][$i]['multiplex'] = utf8_encode($row['multiplex_name']);
                            $i++;
                        endforeach;
                    else:
                        $this->get('session')->getFlashBag()->add(
                                'error', 'No hay coincidencias para esta busqueda.'
                        );
                    endif;
                endif;
            else:
                if(!isset($_GET['page'])){
                    setcookie("sql_serializada", '', time() + 0);
                    setcookie("transaction_id", '', time() + 0);
                    setcookie("cedula", '', time() + 0);
                    setcookie("auditoria", '', time() + 0);
                    setcookie("autorizacion", '', time() + 0);
                    setcookie("estado", '', time() + 0);
                    setcookie("ids_teatros_buscar", '', time() + 0);
                    setcookie("fecha_ini", '', time() + 0);
                    setcookie("fecha_fin", '', time() + 0);
                }
            endif;
            $reportes_filtro = array();
            $listado_llaves = array();
            $reportes_filtro = array();
            $lista_mult = explode(',', $datos_filtro);
            $reporte = array_map('array_values', $reporte);
            foreach ($lista_mult as $lista):
                if (isset($reporte[$lista])):
                    $i = 0;
                    $total_transacciones = 0;
                    $total_boletas = 0;
                    $ingreso_boletas = 0;
                    $ingresos_suple = 0;
                    $total_ingre = 0;
                    $total_tran = 0;
                    foreach ($reporte[$lista] as $re):
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['id'] = $re['id'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['id_entidad'] = $re['id_entidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['entidad'] = $re['entidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['localidad'] = $re['localidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['localidad_nombre'] = $re['localidad_nombre'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['tipo'] = $re['tipo'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['id_tipo'] = $re['id_tipo'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['total_tran'] = $re['total_tran'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['no_boletas'] = $re['no_boletas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['ingresos_suple'] = number_format($re['ingresos_suple'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['ingreso_boletas'] = number_format($re['ingreso_boletas'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['total_ingre'] = number_format($re['total_ingre'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['ingresos_suple_sin'] = $re['ingresos_suple'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['ingreso_boletas_sin'] = $re['ingreso_boletas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['total_ingre_sin'] = $re['total_ingre'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['id_multiplex'] = $re['id_multiplex'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['multiplex'] = $re['multiplex'];

                        $reportes_filtro[$lista]['info']['multiplex'] = $re['multiplex'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['entidad'] = $re['entidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']]['localidad'] = $re['localidad_nombre'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['transaccion'] = $re['tipo'];

                        $total_boletas = $total_boletas + $re['no_boletas'];
                        $ingreso_boletas = $ingreso_boletas + $re['ingreso_boletas'];
                        $ingresos_suple = $ingresos_suple + $re['ingresos_suple'];
                        $total_tran = $total_tran + $re['total_tran'];
                        $total_ingre = $total_ingre + $re['total_ingre'];
                        $reportes_filtro[$lista]['info']['totales']['no_boletas'] = $total_boletas;
                        $reportes_filtro[$lista]['info']['totales']['total_ingreso_boletas'] = number_format($ingreso_boletas, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['ingresos_suple'] = number_format($ingresos_suple, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['total_ingre'] = number_format($total_ingre, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['total_tran'] = $total_tran;
                        $reportes_filtro[$lista]['info']['totales']['total_ingreso_boletas_sin'] = $ingreso_boletas;
                        $reportes_filtro[$lista]['info']['totales']['ingresos_suple_sin'] = $ingresos_suple;
                        $reportes_filtro[$lista]['info']['totales']['total_ingre_sin'] = $total_ingre;
                        if ($consolidado):
                            $j = 0;
                            foreach ($listado_ids_entidades as $list_enti):
                                $total_boletas_1 = 0;
                                $ingreso_boletas_1 = 0;
                                $ingresos_suple_1 = 0;
                                $total_ingre_1 = 0;
                                $total_tran_1 = 0;
                                if (isset($reportes_filtro[$lista]['det'][$list_enti])):
                                    foreach ($listado_localidades as $list_loc):
                                        if (isset($reportes_filtro[$lista]['det'][$list_enti][$list_loc])):
                                            foreach ($listado_tipo_compra as $list_com):
                                                if (isset($reportes_filtro[$lista]['det'][$list_enti][$list_loc][$list_com])):
                                                    foreach ($reportes_filtro[$lista]['det'][$list_enti][$list_loc][$list_com] as $dat):
                                                        $total_boletas_1 = $total_boletas_1 + $dat['detalle']['no_boletas'];
                                                        $ingreso_boletas_1 = $ingreso_boletas_1 + substr(filter_var($dat['detalle']['ingreso_boletas'], FILTER_SANITIZE_NUMBER_INT), 0, -2);
                                                        $ingresos_suple_1 = $ingresos_suple_1 + substr(filter_var($dat['detalle']['ingresos_suple'], FILTER_SANITIZE_NUMBER_INT), 0, -2);
                                                        $total_tran_1 = $total_tran_1 + $dat['detalle']['total_tran'];
                                                        $total_ingre_1 = $total_ingre_1 + substr(filter_var($dat['detalle']['total_ingre'], FILTER_SANITIZE_NUMBER_INT), 0, -2);
                                                        $j++;
                                                    endforeach;
                                                endif;
                                            endforeach;
                                        endif;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['no_boletas'] = $total_boletas_1;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_ingreso_boletas'] = number_format($ingreso_boletas_1, 2, ',', '.');
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['ingresos_suple'] = number_format($ingresos_suple_1, 2, ',', '.');
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_ingre'] = number_format($total_ingre_1, 2, ',', '.');
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_tran'] = $total_tran_1;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_ingreso_boletas_sin'] = $ingreso_boletas_1;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['ingresos_suple_sin'] = $ingresos_suple_1;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_ingre_sin'] = $total_ingre_1;
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                        $i++;
                    endforeach;
                endif;
            endforeach;
            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                    $reporte, $this->get('request')->query->get('page', 1), 20
            );
            $datos_pqrs = array();
            $i = 0;
            $datos_filtros = array('multiplex' => $datos_filtro, 'fecha_ini' => $fecha_ini, 'fecha_fin' => $fecha_fin, 'tipo_fecha' => $tipo_fecha, 'consolidado' => $consolidado,'condicion' => $condicion,'bandera' => $bandera,);
            $filtros = serialize($datos_filtros);
            $filtros = (string) $filtros;
            return $this->render('PqrsBundle:Reportes:ventas-diarias.html.twig', array(
                        'form' => $form->createView(),
                        'reporte' => $reportes_filtro,
                        'lista_mult' => $lista_mult,
                        'datos' => '',
                        'filtros' => $filtros,
                        'listado_ids_entidades' => $listado_ids_entidades,
                        'listado_localidades' => $listado_localidades,
                        'listado_tipo_compra' => $listado_tipo_compra,
                        'permisos' => $permisos,
                        'consolidado' => $consolidado,
                        'estado_consolidado' => $estado_consolidado,
            ));

        else:
            return $this->redirectToRoute('login');
        endif;
    }

    public function generarAction($filtros) {
        $em = $this->getDoctrine()->getManager();
        $variables_globales = $em->getRepository('PqrsBundle:VariablesGlobales')->findAll();
        foreach ($variables_globales as $var):
            if ($var->getNombre() == 'bd_reportes') {
                $bd_reportes = $var->getValor();
            }
            if ($var->getNombre() == 'user_db_reportes') {
                $user_db_reportes = $var->getValor();
            }
            if ($var->getNombre() == 'password_db_reportes') {
                $password_db_reportes = $var->getValor();
            }
            if ($var->getNombre() == 'host_db_reportes') {
                $host_db_reportes = $var->getValor();
            }
        endforeach;
        $datos_filtro = unserialize($filtros);
        $params = array(
            'driver' => 'pdo_mysql',
            'host' => $host_db_reportes,
            'port' => '3306',
            'dbname' => $bd_reportes,
            'user' => $user_db_reportes,
            'password' => $password_db_reportes,
        );
        $reporte = array();
        $listado_ids_entidades = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,);
        $listado_localidades = array('GN', 'PF');
        $listado_tipo_compra = array(1, 2);
        $consolidado = $datos_filtro['consolidado'];
        if ($datos_filtro['multiplex']):
            $conn = DriverManager::getConnection($params);
            $reporte = array();
            if ($datos_filtro['bandera'] == 0) {
                    $sql = 'SELECT * FROM cc_transaction 
                            WHERE ' . $datos_filtro['tipo_fecha'] . ' BETWEEN ' . $datos_filtro['fecha_ini'] . ' AND ' . $datos_filtro['fecha_fin'] . '
                            AND 
                            multiplex_ecall_id IN (' . $datos_filtro['multiplex'] . ')
                            AND
                            transaction_state_id = 4
                            ORDER BY transaction_id DESC   
                            ';
            }else {
                    $sql = 'SELECT * FROM cc_transaction 
                                WHERE (' . implode(' OR ', $datos_filtro['condicion'] ) . ')
                                AND
                                transaction_state_id = 4
                                ORDER BY transaction_id DESC   
                                ';
                
            }
            $stmt = $conn->query($sql);
            $resultado = $stmt->fetchAll();
            if (count($resultado) > 0):
                $i = 0;
                foreach ($resultado as $row):
                    $sql_tran = 'select transaction_type_name from cc_transaction_type where transaction_type_id = ' . $row['transaction_type_id'];
                    $tipo_stmt = $conn->query($sql_tran);
                    $nombre_localidad = 'Preferencial';
                    if ($row['area_id'] == 'GN'):
                        $nombre_localidad = 'General';
                    endif;
                    $reporte[$row['multiplex_ecall_id']][$i]['id_entidad'] = $row['payment_method_id'];
                    $reporte[$row['multiplex_ecall_id']][$i]['id'] = $row['transaction_id'];
                    $reporte[$row['multiplex_ecall_id']][$i]['entidad'] = $row['payment_method_name'];
                    $reporte[$row['multiplex_ecall_id']][$i]['localidad'] = $row['area_id'];
                    $reporte[$row['multiplex_ecall_id']][$i]['localidad_nombre'] = $nombre_localidad;
                    $reporte[$row['multiplex_ecall_id']][$i]['tipo'] = $tipo_stmt->fetch()['transaction_type_name'];
                    $reporte[$row['multiplex_ecall_id']][$i]['id_tipo'] = $row['transaction_type_id'];
                    $reporte[$row['multiplex_ecall_id']][$i]['total_tran'] = 1;
                    $reporte[$row['multiplex_ecall_id']][$i]['no_boletas'] = $row['ticket_amount'];
                    $reporte[$row['multiplex_ecall_id']][$i]['ingresos_suple'] = $row['transaction_total_service'];
                    $reporte[$row['multiplex_ecall_id']][$i]['ingreso_boletas'] = $row['transaction_value'];
                    $reporte[$row['multiplex_ecall_id']][$i]['total_ingre'] = $row['transaction_total'];
                    $reporte[$row['multiplex_ecall_id']][$i]['id_multiplex'] = $row['multiplex_ecall_id'];
                    $reporte[$row['multiplex_ecall_id']][$i]['multiplex'] = utf8_encode($row['multiplex_name']);
                    $i++;
                endforeach;
            else:
                $this->get('session')->getFlashBag()->add(
                        'error', 'No hay coincidencias para esta busqueda.'
                );
            endif;

            $reportes_filtro = array();
            $listado_llaves = array();
            $reportes_filtro = array();
            $lista_mult = explode(',', $datos_filtro['multiplex']);
            $reporte = array_map('array_values', $reporte);
            foreach ($lista_mult as $lista):
                if (isset($reporte[$lista])):
                    $i = 0;
                    $total_transacciones = 0;
                    $total_boletas = 0;
                    $ingreso_boletas = 0;
                    $ingresos_suple = 0;
                    $total_ingre = 0;
                    $total_tran = 0;
                    foreach ($reporte[$lista] as $re):
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['id'] = $re['id'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['id_entidad'] = $re['id_entidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['entidad'] = $re['entidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['localidad'] = $re['localidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['localidad_nombre'] = $re['localidad_nombre'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['tipo'] = $re['tipo'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['id_tipo'] = $re['id_tipo'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['total_tran'] = $re['total_tran'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['no_boletas'] = $re['no_boletas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['ingresos_suple'] = number_format($re['ingresos_suple'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['ingreso_boletas'] = number_format($re['ingreso_boletas'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['total_ingre'] = number_format($re['total_ingre'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['ingresos_suple_sin'] = $re['ingresos_suple'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['ingreso_boletas_sin'] = $re['ingreso_boletas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['total_ingre_sin'] = $re['total_ingre'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['id_multiplex'] = $re['id_multiplex'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['detalle']['multiplex'] = $re['multiplex'];

                        $reportes_filtro[$lista]['info']['multiplex'] = $re['multiplex'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['entidad'] = $re['entidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']]['localidad'] = $re['localidad_nombre'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']][$re['localidad']][$re['id_tipo']][$i]['transaccion'] = $re['tipo'];

                        $total_boletas = $total_boletas + $re['no_boletas'];
                        $ingreso_boletas = $ingreso_boletas + $re['ingreso_boletas'];
                        $ingresos_suple = $ingresos_suple + $re['ingresos_suple'];
                        $total_tran = $total_tran + $re['total_tran'];
                        $total_ingre = $total_ingre + $re['total_ingre'];
                        $reportes_filtro[$lista]['info']['totales']['no_boletas'] = $total_boletas;
                        $reportes_filtro[$lista]['info']['totales']['total_ingreso_boletas'] = number_format($ingreso_boletas, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['ingresos_suple'] = number_format($ingresos_suple, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['total_ingre'] = number_format($total_ingre, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['total_tran'] = $total_tran;
                        $reportes_filtro[$lista]['info']['totales']['total_ingreso_boletas_sin'] = $ingreso_boletas;
                        $reportes_filtro[$lista]['info']['totales']['ingresos_suple_sin'] = $ingresos_suple;
                        $reportes_filtro[$lista]['info']['totales']['total_ingre_sin'] = $total_ingre;
                        if ($consolidado):
                            $j = 0;
                            foreach ($listado_ids_entidades as $list_enti):
                                $total_boletas_1 = 0;
                                $ingreso_boletas_1 = 0;
                                $ingresos_suple_1 = 0;
                                $total_ingre_1 = 0;
                                $total_tran_1 = 0;
                                if (isset($reportes_filtro[$lista]['det'][$list_enti])):
                                    foreach ($listado_localidades as $list_loc):
                                        if (isset($reportes_filtro[$lista]['det'][$list_enti][$list_loc])):
                                            foreach ($listado_tipo_compra as $list_com):
                                                if (isset($reportes_filtro[$lista]['det'][$list_enti][$list_loc][$list_com])):
                                                    foreach ($reportes_filtro[$lista]['det'][$list_enti][$list_loc][$list_com] as $dat):
                                                        $total_boletas_1 = $total_boletas_1 + $dat['detalle']['no_boletas'];
                                                        $ingreso_boletas_1 = $ingreso_boletas_1 + substr(filter_var($dat['detalle']['ingreso_boletas'], FILTER_SANITIZE_NUMBER_INT), 0, -2);
                                                        $ingresos_suple_1 = $ingresos_suple_1 + substr(filter_var($dat['detalle']['ingresos_suple'], FILTER_SANITIZE_NUMBER_INT), 0, -2);
                                                        $total_tran_1 = $total_tran_1 + $dat['detalle']['total_tran'];
                                                        $total_ingre_1 = $total_ingre_1 + substr(filter_var($dat['detalle']['total_ingre'], FILTER_SANITIZE_NUMBER_INT), 0, -2);
                                                        $j++;
                                                    endforeach;

                                                endif;
                                            endforeach;
                                        endif;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['no_boletas'] = $total_boletas_1;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_ingreso_boletas'] = number_format($ingreso_boletas_1, 2, ',', '.');
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['ingresos_suple'] = number_format($ingresos_suple_1, 2, ',', '.');
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_ingre'] = number_format($total_ingre_1, 2, ',', '.');
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_ingreso_boletas_sin'] = $ingreso_boletas_1;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['ingresos_suple_sin'] = $ingresos_suple_1;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_ingre_sin'] = $total_ingre_1;
                                        $reportes_filtro[$lista][$list_enti]['info_consolidado']['totales']['total_tran'] = $total_tran_1;
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                        $i++;
                    endforeach;
                endif;
            endforeach;
            $hoy = strtotime(date('Y-m-d h:i A'));
            $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
            $phpExcelObject->getProperties()->setCreator("Reporte")
                    ->setLastModifiedBy("Reporte")
                    ->setTitle("Reporte")
                    ->setSubject("Reporte")
                    ->setDescription("Archivo con resusltados de reportes")
                    ->setKeywords("reporte xls")
                    ->setCategory("Reportes");

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
            $styleResultados_1 = array(
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
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C1', 'REPORTES PORTAL CINECO -  VENTAS DIARIAS');

            $phpExcelObject->getActiveSheet()->getStyle('C1:C2')->applyFromArray($styleEncabezados);
            $phpExcelObject->getActiveSheet()->getRowDimension(1)->setRowHeight(40);

            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('E3', 'Fecha Incio')
                    ->setCellValue('F3', 'Fecha Fin')
                    ->setCellValue('E4', date('d/m/Y', $datos_filtro['fecha_ini']))
                    ->setCellValue('F4', date('d/m/Y', $datos_filtro['fecha_fin']));

            if ($consolidado):
                $phpExcelObject->getActiveSheet()->getStyle('A7:H7')->applyFromArray($styleTitulos);
                $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue('A7', 'Entidad Financiera')
                        ->setCellValue('B7', 'Localidad')
                        ->setCellValue('C7', 'Tipo transacción')
                        ->setCellValue('D7', 'Total transacciones')
                        ->setCellValue('E7', 'Número de boletas')
                        ->setCellValue('F7', 'Total ingresos cargos suplementarios')
                        ->setCellValue('G7', 'Total ingreso boletas')
                        ->setCellValue('H7', 'Total ingreso exhibición');

                $i = 8;
                foreach ($lista_mult as $mult):
                    if (isset($reportes_filtro[$mult])):
                        $j = 0;
                        $k = 0;
                        $m = 0;
                        $n = 0;
                        $j = $i + 1;
                        foreach ($listado_ids_entidades as $list_entidades):
                            if (isset($reportes_filtro[$mult]['det'][$list_entidades])):
                                $phpExcelObject->setActiveSheetIndex(0)
                                        //->setCellValue('A' . $j, '')
                                        ->setCellValue('A' . $j, $reportes_filtro[$mult]['det'][$list_entidades]['entidad'])
                                        ->setCellValue('B' . $j, '')
                                        ->setCellValue('C' . $j, '')
                                        ->setCellValue('D' . $j, $reportes_filtro[$mult][$list_entidades]['info_consolidado']['totales']['total_tran'])
                                        ->setCellValue('E' . $j, $reportes_filtro[$mult][$list_entidades]['info_consolidado']['totales']['no_boletas'])
                                        ->setCellValue('F' . $j, $reportes_filtro[$mult][$list_entidades]['info_consolidado']['totales']['ingresos_suple'])
                                        ->setCellValue('G' . $j, $reportes_filtro[$mult][$list_entidades]['info_consolidado']['totales']['total_ingreso_boletas'])
                                        ->setCellValue('H' . $j, $reportes_filtro[$mult][$list_entidades]['info_consolidado']['totales']['total_ingre']);
                                $k = $j + 1;
                                $phpExcelObject->getActiveSheet()->getRowDimension($j)->setOutlineLevel(1);
                                $phpExcelObject->getActiveSheet()->getRowDimension($j)->setVisible(true);
                                foreach ($listado_localidades as $list_localidad):
                                    if (isset($reportes_filtro[$mult]['det'][$list_entidades][$list_localidad])):
                                        $phpExcelObject->setActiveSheetIndex(0)
                                                //->setCellValue('A' . $k, '')
                                                ->setCellValue('A' . $k, '')
                                                ->setCellValue('B' . $k, $reportes_filtro[$mult]['det'][$list_entidades][$list_localidad]['localidad'])
                                                ->setCellValue('C' . $k, '')
                                                ->setCellValue('D' . $k, '')
                                                ->setCellValue('E' . $k, '')
                                                ->setCellValue('F' . $k, '')
                                                ->setCellValue('G' . $k, '')
                                                ->setCellValue('H' . $k, '');
                                        $m = $k + 1;
                                        //$phpExcelObject->getActiveSheet()->getRowDimension($k)->setOutlineLevel(2);
                                        //$phpExcelObject->getActiveSheet()->getRowDimension($k)->setVisible(true);
                                        foreach ($listado_tipo_compra as $list_compra):
                                            if (isset($reportes_filtro[$mult]['det'][$list_entidades][$list_localidad][$list_compra])):
                                                if ($list_compra == 1):
                                                    $tipo_compra = 'Compra';
                                                elseif ($list_compra == 2):
                                                    $tipo_compra = 'Reserva';
                                                endif;
                                                $phpExcelObject->setActiveSheetIndex(0)
                                                        //->setCellValue('A' . $m, '')
                                                        ->setCellValue('A' . $m, '')
                                                        ->setCellValue('B' . $m, '')
                                                        ->setCellValue('C' . $m, $tipo_compra)
                                                        ->setCellValue('D' . $m, '')
                                                        ->setCellValue('E' . $m, '')
                                                        ->setCellValue('F' . $m, '')
                                                        ->setCellValue('G' . $m, '')
                                                        ->setCellValue('H' . $m, '');
                                                $n = $m + 1;
                                                //$phpExcelObject->getActiveSheet()->getRowDimension($m)->setOutlineLevel(3);
                                                //$phpExcelObject->getActiveSheet()->getRowDimension($m)->setVisible(true);
                                                foreach ($reportes_filtro[$mult]['det'][$list_entidades][$list_localidad][$list_compra] as $det):
                                                    $phpExcelObject->setActiveSheetIndex(0)
                                                            //->setCellValue('A' . $n, '')
                                                            ->setCellValue('A' . $n, '')
                                                            ->setCellValue('B' . $n, '')
                                                            ->setCellValue('C' . $n, '')
                                                            ->setCellValue('D' . $n, $det['detalle']['total_tran'])
                                                            ->setCellValue('E' . $n, $det['detalle']['no_boletas'])
                                                            ->setCellValue('F' . $n, $det['detalle']['ingresos_suple'])
                                                            ->setCellValue('G' . $n, $det['detalle']['ingreso_boletas'])
                                                            ->setCellValue('H' . $n, $det['detalle']['total_ingre']);
                                                    $phpExcelObject->getActiveSheet()->getStyle("A8:H$n")->applyFromArray($styleResultados);
                                                    $phpExcelObject->getActiveSheet()->getRowDimension($n)->setOutlineLevel(4);
                                                    $phpExcelObject->getActiveSheet()->getRowDimension($n)->setVisible(true);
                                                    $n++;
                                                endforeach;
                                                $aux_n = $n + 1;
                                                //$phpExcelObject->getActiveSheet()->getRowDimension($aux_n)->setCollapsed(true);
                                                $i = 1 + $n;
                                                $m++;
                                                $m = 4 + $n;
                                            endif;
                                        endforeach;
                                        $aux_m = $aux_n + 1;
                                        //$phpExcelObject->getActiveSheet()->getRowDimension($aux_m)->setCollapsed(true);
                                        $k++;
                                        $k = 3 + $n;
                                    endif;
                                endforeach;
                                $aux_k = $aux_m + 1;
                                //$phpExcelObject->getActiveSheet()->getRowDimension($aux_k)->setCollapsed(true);
                                $j++;
                                $j = 2 + $n;
                            endif;
                        endforeach;
                        $aux_j = $aux_k + 1;
                        //$phpExcelObject->getActiveSheet()->getRowDimension($aux_j)->setCollapsed(true);
                        $i++;
                        $i = $i + $n;
                    endif;
                endforeach;
            else:
                $phpExcelObject->getActiveSheet()->getStyle('A7:I7')->applyFromArray($styleTitulos);
                $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue('A7', 'Nombre del teatro')
                        ->setCellValue('B7', 'Entidad Financiera')
                        ->setCellValue('C7', 'Localidad')
                        ->setCellValue('D7', 'Tipo transacción')
                        ->setCellValue('E7', 'Total transacciones')
                        ->setCellValue('F7', 'Número de boletas')
                        ->setCellValue('G7', 'Total ingresos cargos suplementarios')
                        ->setCellValue('H7', 'Total ingreso boletas')
                        ->setCellValue('I7', 'Total ingreso exhibición');
                $n = 0;
                $i = 8;
                $j = 0;
                $k = 0;
                $m = 0;
                foreach ($lista_mult as $mult):
                    if (isset($reportes_filtro[$mult])):
                        $phpExcelObject->setActiveSheetIndex()
                                ->setCellValue('A' . $i, $reportes_filtro[$mult]['info']['multiplex'])
                                ->setCellValue('B' . $i, '')
                                ->setCellValue('C' . $i, '')
                                ->setCellValue('D' . $i, '')
                                ->setCellValue('E' . $i, $reportes_filtro[$mult]['info']['totales']['total_tran'])
                                ->setCellValue('F' . $i, $reportes_filtro[$mult]['info']['totales']['no_boletas'])
                                ->setCellValue('G' . $i, $reportes_filtro[$mult]['info']['totales']['ingresos_suple'])
                                ->setCellValue('H' . $i, $reportes_filtro[$mult]['info']['totales']['total_ingreso_boletas'])
                                ->setCellValue('I' . $i, $reportes_filtro[$mult]['info']['totales']['total_ingre']);
                        $j = $i + 1;
                        foreach ($listado_ids_entidades as $list_entidades):
                            if (isset($reportes_filtro[$mult]['det'][$list_entidades])):
                                $phpExcelObject->setActiveSheetIndex()
                                        ->setCellValue('A' . $j, '')
                                        ->setCellValue('B' . $j, $reportes_filtro[$mult]['det'][$list_entidades]['entidad'])
                                        ->setCellValue('C' . $j, '')
                                        ->setCellValue('D' . $j, '')
                                        ->setCellValue('E' . $j, '')
                                        ->setCellValue('F' . $j, '')
                                        ->setCellValue('G' . $j, '')
                                        ->setCellValue('H' . $j, '')
                                        ->setCellValue('I' . $j, '');
                                
                                $k = $j + 1;
                                foreach ($listado_localidades as $list_localidad):
                                    if (isset($reportes_filtro[$mult]['det'][$list_entidades][$list_localidad])):
                                        $phpExcelObject->setActiveSheetIndex()
                                                ->setCellValue('A' . $k, '')
                                                ->setCellValue('B' . $k, '')
                                                ->setCellValue('C' . $k, $reportes_filtro[$mult]['det'][$list_entidades][$list_localidad]['localidad'])
                                                ->setCellValue('D' . $k, '')
                                                ->setCellValue('E' . $k, '')
                                                ->setCellValue('F' . $k, '')
                                                ->setCellValue('G' . $k, '')
                                                ->setCellValue('H' . $k, '')
                                                ->setCellValue('I' . $k, '');
                                        $m = $k + 1;
                                        foreach ($listado_tipo_compra as $list_compra):
                                            if (isset($reportes_filtro[$mult]['det'][$list_entidades][$list_localidad][$list_compra])):
                                                if ($list_compra == 1):
                                                    $tipo_compra = 'Compra';
                                                elseif ($list_compra == 2):
                                                    $tipo_compra = 'Reserva';
                                                endif;
                                                $phpExcelObject->setActiveSheetIndex()
                                                        ->setCellValue('A' . $m, '')
                                                        ->setCellValue('B' . $m, '')
                                                        ->setCellValue('C' . $m, '')
                                                        ->setCellValue('D' . $m, $tipo_compra)
                                                        ->setCellValue('E' . $m, '')
                                                        ->setCellValue('F' . $m, '')
                                                        ->setCellValue('G' . $m, '')
                                                        ->setCellValue('H' . $m, '')
                                                        ->setCellValue('I' . $m, '');
                                                
                                                $n = $m + 1;
                                                foreach ($reportes_filtro[$mult]['det'][$list_entidades][$list_localidad][$list_compra] as $det):
                                                    $phpExcelObject->setActiveSheetIndex()
                                                            ->setCellValue('A' . $n, '')
                                                            ->setCellValue('B' . $n, '')
                                                            ->setCellValue('C' . $n, '')
                                                            ->setCellValue('D' . $n, '')
                                                            ->setCellValue('E' . $n, $det['detalle']['total_tran'])
                                                            ->setCellValue('F' . $n, $det['detalle']['no_boletas'])
                                                            ->setCellValue('G' . $n, $det['detalle']['ingresos_suple'])
                                                            ->setCellValue('H' . $n, $det['detalle']['ingreso_boletas'])
                                                            ->setCellValue('I' . $n, $det['detalle']['total_ingre']);
                                                    //$phpExcelObject->getActiveSheet()->getStyle("A8:I$n")->applyFromArray($styleResultados);
                                                    $phpExcelObject->getActiveSheet()->getRowDimension($n)->setOutlineLevel(4);
                                                    $phpExcelObject->getActiveSheet()->getRowDimension($n)->setVisible(false);
                                                    $n++;
                                                endforeach;
                                                $i = 1 + $n;
                                                $phpExcelObject->getActiveSheet()->getRowDimension($m)->setOutlineLevel(3);
                                                $phpExcelObject->getActiveSheet()->getRowDimension($m)->setVisible(false);
                                                $m++;
                                                $m = $n;
                                            endif;
                                            $aux_m = $n + 1;
                                            $phpExcelObject->getActiveSheet()->getRowDimension($aux_m)->setCollapsed(true);
                                        endforeach;                                        
                                        $phpExcelObject->getActiveSheet()->getRowDimension($k)->setOutlineLevel(2);
                                        $phpExcelObject->getActiveSheet()->getRowDimension($k)->setVisible(false);
                                        $k++;
                                        $k = $n;
                                        
                                    endif;
                                    
                                endforeach;                                
                                $phpExcelObject->getActiveSheet()->getRowDimension($j)->setOutlineLevel(1);
                                $phpExcelObject->getActiveSheet()->getRowDimension($j)->setVisible(false);
                                $j++;
                                $j = $n;
                                $aux_k = $aux_m + 1;
                                $phpExcelObject->getActiveSheet()->getRowDimension($aux_k)->setCollapsed(true);
                            endif;                            
                        endforeach;
                        $aux_j = $aux_k + 1;
                        $phpExcelObject->getActiveSheet()->getRowDimension($aux_j)->setCollapsed(true);
                        $i++;
                    endif;
                endforeach;                
            endif;
            
            $aux_c = $aux_j + 1;
            $phpExcelObject->getActiveSheet()->getRowDimension($aux_c)->setCollapsed(true);
            
            
            //print_r($phpExcelObject);
            //return;
            
            $phpExcelObject->setActiveSheetIndex()->setCellValue('L' . 3, $aux_c.' '.$aux_j.' '.$aux_k.' '.$aux_m);
            $phpExcelObject->setActiveSheetIndex()->setCellValue('L' . 4, $j.' '.$k.' '.$m.' '.$n);
            
            $phpExcelObject->getActiveSheet()->setTitle('Reporte Ventas Diarias');
            $phpExcelObject->setActiveSheetIndex(0);
            $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
            $response = $this->get('phpexcel')->createStreamedResponse($writer);
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Content-Disposition', 'attachment;filename=reporte-ventas-diarias.xls');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Cache-Control', 'maxage=1');
            return $response;
        else:
            return $this->redirectToRoute('reporte_ventas_diarias');
        endif;
    }

}
