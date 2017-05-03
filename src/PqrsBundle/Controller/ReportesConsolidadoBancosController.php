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
use PqrsBundle\Entity\Cierre;

class ReportesConsolidadoBancosController extends Controller {

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
            $fecha_ini = '';
            $fecha_fin = '';
            $tipo_fecha = '';
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
                        'attr' => array('class' => 'btn btn-primary')))
                    ->getForm();
            $datos_filtro = '';
            $reporte = array();
            $total_transacciones = 0;
            $total_boletas = 0;
            $ingreso_boletas = 0;
            $condicion = array();
            $bandera = 0;
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
                    if ($_POST['form']['tipo_fecha'] == 1):
                        $tipo_fecha = 'transaction_close_day_date';
                    else:
                        $tipo_fecha = 'created';
                    endif;
                    $datos_filtro = substr($datos_filtro, 0, -1);
                    $ids_teatros_buscar = explode(',', $datos_filtro);
                    setcookie("fecha_ini", $fecha_ini, time() + 10);
                    setcookie("fecha_fin", $fecha_fin, time() + 10);

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
                            transaction_state_id IN (7,4)
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
                                transaction_state_id IN (7,4)
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
                            $reporte[$row['multiplex_ecall_id']][$i]['multiplex'] = utf8_encode($row['multiplex_name']);
                            $reporte[$row['multiplex_ecall_id']][$i]['id_entidad'] = $row['payment_method_id'];
                            $reporte[$row['multiplex_ecall_id']][$i]['entidad'] = $row['payment_method_name'];
                            $reporte[$row['multiplex_ecall_id']][$i]['id_tipo'] = $row['transaction_type_id'];
                            $reporte[$row['multiplex_ecall_id']][$i]['total_ventas'] = $row['transaction_value'];
                            $reporte[$row['multiplex_ecall_id']][$i]['transaccion_reserva'] = ($row['transaction_type_id'] == 1) ? 1 : 0;
                            $reporte[$row['multiplex_ecall_id']][$i]['transaccion_ventas'] = ($row['transaction_type_id'] == 2) ? 1 : 0;
                            $reporte[$row['multiplex_ecall_id']][$i]['total_reservas'] = $row['transaction_total_service'];
                            $reporte[$row['multiplex_ecall_id']][$i]['total_tran'] = 1;
                            $reporte[$row['multiplex_ecall_id']][$i]['total_ingre'] = $row['transaction_total'];
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
            $lista_mult = explode(',', $datos_filtro);
            $reporte = array_map('array_values', $reporte);
            foreach ($lista_mult as $lista):
                if (isset($reporte[$lista])):
                    $i = 0;
                    $total_ingre = 0;
                    $total_tran = 0;
                    $transaccion_ventas = 0;
                    $total_ventas = 0;
                    $total_transaccion_reserva = 0;
                    $total_reservas = 0;
                    $total_ingre = 0;
                    foreach ($reporte[$lista] as $re):
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['multiplex'] = $re['multiplex'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['entidad'] = $re['entidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['id_tipo'] = $re['id_tipo'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_ventas'] = number_format($re['total_ventas'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_ventas_sin'] = $re['total_ventas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['transaccion_ventas'] = $re['transaccion_ventas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['transaccion_reserva'] = $re['transaccion_reserva'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_reservas'] = number_format($re['total_reservas'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_reservas_sin'] = $re['total_reservas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_ingre'] = number_format($re['total_ingre'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_ingre_sin'] = $re['total_ingre'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_tran'] = $re['total_tran'];

                        $reportes_filtro[$lista]['info']['multiplex'] = $re['multiplex'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['entidad'] = $re['entidad'];
                        $total_tran = $total_tran + $re['total_tran'];
                        $transaccion_ventas = $transaccion_ventas + $re['transaccion_ventas'];
                        $total_ventas = $total_ventas + $re['total_ventas'];
                        $total_transaccion_reserva = $total_transaccion_reserva + $re['transaccion_reserva'];
                        $total_reservas = $total_reservas + $re['total_reservas'];
                        $total_ingre = $total_ingre + $re['total_ingre'];
                        $reportes_filtro[$lista]['info']['totales']['total_ingre'] = number_format($total_ingre, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['total_ventas'] = number_format($total_ventas, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['transaccion_ventas'] = $transaccion_ventas;
                        $reportes_filtro[$lista]['info']['totales']['transaccion_reserva'] = $total_transaccion_reserva;
                        $reportes_filtro[$lista]['info']['totales']['total_tran'] = $total_tran;
                        $reportes_filtro[$lista]['info']['totales']['total_reservas'] = number_format($total_reservas, 2, ',', '.');
                        $i++;
                    endforeach;
                endif;
            endforeach;
            //$totales['totales']['total_transacciones'] = $total_transacciones;
            //$totales['totales']['total_boletas'] = $total_boletas;
            //$reportes_filtro = array_map('array_values', $reportes_filtro);
            //print'<pre>';var_dump($reportes_filtro);print '</pre>';
            $listado_ids_entidades = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,);

            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                    $reporte, $this->get('request')->query->get('page', 1), 20
            );
            $datos_pqrs = array();
            $i = 0;
            $datos_filtros = array('multiplex' => $datos_filtro, 'fecha_ini' => $fecha_ini, 'fecha_fin' => $fecha_fin, 'tipo_fecha' => $tipo_fecha, 'condicion' => $condicion, 'bandera' => $bandera,);
            $filtros = serialize($datos_filtros);
            $filtros = (string) $filtros;
            return $this->render('PqrsBundle:Reportes:consolidado-bancos.html.twig', array(
                        'form' => $form->createView(),
                        'reporte' => $reportes_filtro,
                        'lista_mult' => $lista_mult,
                        'datos' => '',
                        'filtros' => $filtros,
                        'listado_ids_entidades' => $listado_ids_entidades,
                        'permisos' => $permisos,
                            //'totales' => $totales,
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
        if ($datos_filtro['multiplex']):
            $conn = DriverManager::getConnection($params);
            $reporte = array();
            if ($datos_filtro['bandera'] == 0) {
                $sql = 'SELECT * FROM cc_transaction 
                            WHERE ' . $datos_filtro['tipo_fecha'] . ' BETWEEN ' . $datos_filtro['fecha_ini'] . ' AND ' . $datos_filtro['fecha_fin'] . '
                            AND 
                            multiplex_ecall_id IN (' . $datos_filtro['multiplex'] . ')
                            AND
                            transaction_state_id IN (7,4)
                            ORDER BY transaction_id DESC   
                            ';
            } else {
                $sql = 'SELECT * FROM cc_transaction 
                                WHERE (' . implode(' OR ', $datos_filtro['condicion']) . ')
                                AND
                                transaction_state_id IN (7,4)
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
                    $reporte[$row['multiplex_ecall_id']][$i]['multiplex'] = utf8_encode($row['multiplex_name']);
                    $reporte[$row['multiplex_ecall_id']][$i]['id_entidad'] = $row['payment_method_id'];
                    $reporte[$row['multiplex_ecall_id']][$i]['entidad'] = $row['payment_method_name'];
                    $reporte[$row['multiplex_ecall_id']][$i]['id_tipo'] = $row['transaction_type_id'];
                    $reporte[$row['multiplex_ecall_id']][$i]['total_ventas'] = $row['transaction_value'];
                    $reporte[$row['multiplex_ecall_id']][$i]['transaccion_reserva'] = ($row['transaction_type_id'] == 2) ? 1 : 0;
                    $reporte[$row['multiplex_ecall_id']][$i]['transaccion_ventas'] = ($row['transaction_type_id'] == 1) ? 1 : 0;
                    $reporte[$row['multiplex_ecall_id']][$i]['total_reservas'] = $row['transaction_total_service'];
                    $reporte[$row['multiplex_ecall_id']][$i]['total_tran'] = 1;
                    $reporte[$row['multiplex_ecall_id']][$i]['total_ingre'] = $row['transaction_total'];
                    $i++;
                endforeach;
            else:
                $this->get('session')->getFlashBag()->add(
                        'error', 'No hay coincidencias para esta busqueda.'
                );
            endif;

            $reportes_filtro = array();
            $listado_llaves = array();
            $lista_mult = explode(',', $datos_filtro['multiplex']);
            $reporte = array_map('array_values', $reporte);
            foreach ($lista_mult as $lista):
                if (isset($reporte[$lista])):
                    $i = 0;
                    $total_ingre = 0;
                    $total_tran = 0;
                    $transaccion_ventas = 0;
                    $total_ventas = 0;
                    $total_transaccion_reserva = 0;
                    $total_reservas = 0;
                    $total_ingre = 0;
                    foreach ($reporte[$lista] as $re):

                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['multiplex'] = $re['multiplex'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['entidad'] = $re['entidad'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['id_tipo'] = $re['id_tipo'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_ventas'] = number_format($re['total_ventas'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_ventas_sin'] = $re['total_ventas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['transaccion_ventas'] = $re['transaccion_ventas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['transaccion_reserva'] = $re['transaccion_reserva'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_reservas'] = number_format($re['total_reservas'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_reservas_sin'] = $re['total_reservas'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_ingre'] = number_format($re['total_ingre'], 2, ',', '.');
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_ingre_sin'] = $re['total_ingre'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['detalle'][$i]['detalle']['total_tran'] = $re['total_tran'];


                        $reportes_filtro[$lista]['info']['multiplex'] = $re['multiplex'];
                        $reportes_filtro[$lista]['det'][$re['id_entidad']]['entidad'] = $re['entidad'];
                        $total_tran = $total_tran + $re['total_tran'];
                        $transaccion_ventas = $transaccion_ventas + $re['transaccion_ventas'];
                        $total_ventas = $total_ventas + $re['total_ventas'];
                        $total_transaccion_reserva = $total_transaccion_reserva + $re['transaccion_reserva'];
                        $total_reservas = $total_reservas + $re['total_reservas'];
                        $total_ingre = $total_ingre + $re['total_ingre'];
                        $reportes_filtro[$lista]['info']['totales']['total_ingre'] = number_format($total_ingre, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['total_ventas'] = number_format($total_ventas, 2, ',', '.');
                        $reportes_filtro[$lista]['info']['totales']['transaccion_ventas'] = $transaccion_ventas;
                        $reportes_filtro[$lista]['info']['totales']['transaccion_reserva'] = $total_transaccion_reserva;
                        $reportes_filtro[$lista]['info']['totales']['total_tran'] = $total_tran;
                        $reportes_filtro[$lista]['info']['totales']['total_reservas'] = number_format($total_reservas, 2, ',', '.');
                        $i++;
                    endforeach;
                endif;
            endforeach;

            $listado_ids_entidades = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,);

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

            $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
            $phpExcelObject->getProperties()->setCreator("Reporte")
                    ->setLastModifiedBy("Reporte")
                    ->setTitle("Reporte")
                    ->setSubject("Reporte")
                    ->setDescription("Archivo con resusltados de reportes")
                    ->setKeywords("reporte xls")
                    ->setCategory("Reportes");
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C1', 'REPORTES PORTAL CINECO -  CONSOLIDADO BANCOS');
            $phpExcelObject->getActiveSheet()->getStyle('C1:C2')->applyFromArray($styleEncabezados);
            $phpExcelObject->getActiveSheet()->getRowDimension(1)->setRowHeight(40);
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('E3', 'Fecha Incio')
                    ->setCellValue('F3', 'Fecha Fin')
                    ->setCellValue('E4', date('d/m/Y', $datos_filtro['fecha_ini']))
                    ->setCellValue('F4', date('d/m/Y', $datos_filtro['fecha_fin']));
            $phpExcelObject->getActiveSheet()->getStyle('A7:H7')->applyFromArray($styleTitulos);
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A7', 'Nombre Teatro')
                    ->setCellValue('B7', 'Entidad Financiera')
                    ->setCellValue('C7', 'Transacciones Ventas')
                    ->setCellValue('D7', 'Total Ventas')
                    ->setCellValue('E7', 'Transacciones Reservas')
                    ->setCellValue('F7', 'Total Reservas')
                    ->setCellValue('G7', 'Transacción Exhibición')
                    ->setCellValue('H7', 'Total Exhibición');
            $i = 8;
            $j = 0;
            $k = 0;

            foreach ($lista_mult as $mult):
                if (isset($reportes_filtro[$mult])):
                    $phpExcelObject->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, $reportes_filtro[$mult]['info']['multiplex'])
                            ->setCellValue('B' . $i, '')
                            ->setCellValue('C' . $i, $reportes_filtro[$mult]['info']['totales']['transaccion_ventas'])
                            ->setCellValue('D' . $i, $reportes_filtro[$mult]['info']['totales']['total_ventas'])
                            ->setCellValue('E' . $i, $reportes_filtro[$mult]['info']['totales']['transaccion_reserva'])
                            ->setCellValue('F' . $i, $reportes_filtro[$mult]['info']['totales']['total_reservas'])
                            ->setCellValue('G' . $i, $reportes_filtro[$mult]['info']['totales']['total_tran'])
                            ->setCellValue('H' . $i, $reportes_filtro[$mult]['info']['totales']['total_ingre']);
                    $j = $i + 1;
                    $a_j = $i + 1;

                    foreach ($listado_ids_entidades as $list_entidades):
                        if (isset($reportes_filtro[$mult]['det'][$list_entidades])):

                            $sub_transaccion_ventas = 0;
                            $sub_total_ventas = 0;
                            $sub_transaccion_reserva = 0;
                            $sub_total_reservas = 0;
                            $sub_total_tran = 0;
                            $sub_total_ingre = 0;

                            foreach ($reportes_filtro[$mult]['det'][$list_entidades]['detalle'] as $det):
                                $sub_transaccion_ventas = $sub_transaccion_ventas + $det['detalle']['transaccion_ventas'];
                                $sub_total_ventas = $sub_total_ventas + $det['detalle']['total_ventas_sin'];
                                $sub_transaccion_reserva = $sub_transaccion_reserva + $det['detalle']['transaccion_reserva'];
                                $sub_total_reservas = $sub_total_reservas + $det['detalle']['total_reservas_sin'];
                                $sub_total_tran = $sub_total_tran + $det['detalle']['total_tran'];
                                $sub_total_ingre = $sub_total_ingre + $det['detalle']['total_ingre_sin'];
                            endforeach;

                            $phpExcelObject->setActiveSheetIndex()
                                    ->setCellValue('A' . $j, '')
                                    ->setCellValue('B' . $j, $reportes_filtro[$mult]['det'][$list_entidades]['entidad'])
                                    ->setCellValue('C' . $j, $sub_transaccion_ventas)
                                    ->setCellValue('D' . $j, number_format($sub_total_ventas, 2, ',', '.'))
                                    ->setCellValue('E' . $j, $sub_transaccion_reserva)
                                    ->setCellValue('F' . $j, number_format($sub_total_reservas, 2, ',', '.'))
                                    ->setCellValue('G' . $j, $sub_total_tran)
                                    ->setCellValue('H' . $j, number_format($sub_total_ingre, 2, ',', '.'));

                            $phpExcelObject->getActiveSheet()->getStyle("A$j:H$j")->applyFromArray($styleResultados_1);
                            $k = $j + 1;
                            foreach ($reportes_filtro[$mult]['det'][$list_entidades]['detalle'] as $det):
                                $phpExcelObject->setActiveSheetIndex()
                                        ->setCellValue('A' . $k, '')
                                        ->setCellValue('B' . $k, '')
                                        ->setCellValue('C' . $k, $det['detalle']['transaccion_ventas'])
                                        ->setCellValue('D' . $k, $det['detalle']['total_ventas'])
                                        ->setCellValue('E' . $k, $det['detalle']['transaccion_reserva'])
                                        ->setCellValue('F' . $k, $det['detalle']['total_reservas'])
                                        ->setCellValue('G' . $k, $det['detalle']['total_tran'])
                                        ->setCellValue('H' . $k, $det['detalle']['total_ingre']);


                                $phpExcelObject->getActiveSheet()->getRowDimension($k)->setOutlineLevel(2);
                                $phpExcelObject->getActiveSheet()->getRowDimension($k)->setVisible(false);
                                $k++;

                            endforeach;
                            $i = 1 + $k;
                            $j++;
                            $j = $k;

                        endif;
                        $phpExcelObject->getActiveSheet()->getRowDimension($j)->setOutlineLevel(1);
                        $phpExcelObject->getActiveSheet()->getRowDimension($j)->setVisible(false);
                    endforeach;
                    $aux_j = $k + 1;
                    $phpExcelObject->getActiveSheet()->getRowDimension($aux_j)->setCollapsed(true);

                    $i++;
                endif;
            endforeach;
            $aux_c = $aux_j + 1;
            $phpExcelObject->getActiveSheet()->getRowDimension($aux_c)->setCollapsed(true);
            //$phpExcelObject->getActiveSheet()->getRowDimension(14)->setCollapsed(true);

            $phpExcelObject->getActiveSheet()->setTitle('Reporte Consolidado');
            $phpExcelObject->setActiveSheetIndex(0);
            $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
            $response = $this->get('phpexcel')->createStreamedResponse($writer);
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Content-Disposition', 'attachment;filename=reporte-consolidado-bancos.xls');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Cache-Control', 'maxage=1');
            return $response;
        else:
            return $this->redirectToRoute('reporte_consolidado_banco');
        endif;
    }

}
