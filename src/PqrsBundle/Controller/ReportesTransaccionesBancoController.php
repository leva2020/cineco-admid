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

class ReportesTransaccionesBancoController extends Controller {

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
            $resultado = array();
            if (isset($_COOKIE['sql_serializada']) && isset($_GET['page'])) {
                $pagina = 0;
                if(isset($_GET['page'])){
                    $pagina = 10 * (int)$_GET['page'];
                }
                $consulta = unserialize($_COOKIE['sql_serializada']);
                
                $sql = $consulta;// . ' LIMIT '.$pagina.', 20';
                $stmt = $conn->query($sql);
                $resultado = $stmt->fetchAll();
            }


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
                        'choices' => array(0 => 'Fecha Transacción', 1 => 'Fecha de Cierre', 2 => 'Fecha Función', 3 => 'Fecha de Reembolso'),
                        //'empty_value' => 'Elija un tipo de fecha',
                        'label' => 'Tipo de fecha',
                        'mapped' => false,
                        'required' => true,
                        'preferred_choices' => array(0),
                        'attr' => array('class' => 'tipo-fecha')
                    ))
                    ->add('fecha_registro', 'text', array(
                        'label' => 'Rango de Fechas',
                        'required' => true,
                        'mapped' => false,
                        'attr' => array('class' => 'fecha-inicial')
                    ))
                    ->add('auditoria', 'text', array(
                        'label' => 'Número de auditoria',
                        'required' => false,
                        'mapped' => false,
                    ))
                    ->add('cedula', 'text', array(
                        'label' => 'Cédula cliente',
                        'required' => false,
                        'mapped' => false,
                    ))
                    ->add('autorizacion', 'text', array(
                        'label' => 'Autorización banco',
                        'required' => false,
                        'mapped' => false,
                    ))
                    ->add('factura', 'text', array(
                        'label' => 'Factura',
                        'required' => false,
                        'mapped' => false,
                    ))
                    ->add('estados', 'choice', array(
                        'choices' => array(4 => 'Aprobado - Confirmado', 3 => 'Aprobado sin confirmar', 1 => 'Incompleto', 5 => 'Fallido', 8 => 'Pendiente', 2 => 'Rechazado', 7 => 'Reembolsado', 6 => 'Reservado'),
                        //'empty_value' => 'Elija un estado',
                        'label' => 'Estados de la transacción',
                        'mapped' => false,
                        'expanded' => true,
                        'multiple' => true,
                        'required' => true,
                        'attr' => array('class' => 'estado')
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
            $fecha_ini = '';
            $fecha_fin = '';
            $tipo_fecha = '';
            $auditoria = '';
            $cedula = '';
            $autorizacion = '';
            $factura = '';
            $estado = '';
            $condicion = array();
            $bandera = 0;
            $form->handleRequest($request);
            if ($form->isValid()):
                if (strlen($listado_id_multiplex) == 0){
                    $this->get('session')->getFlashBag()->add(
                            'error', 'Debes tener al menos un teatro.'
                    );
                }else{
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
                    elseif ($_POST['form']['tipo_fecha'] == 0):
                        $tipo_fecha = 'created';
                    elseif ($_POST['form']['tipo_fecha'] == 2):
                        $tipo_fecha = 'performance_date';
                    elseif ($_POST['form']['tipo_fecha'] == 3):
                        $tipo_fecha = 'admin_modified_date';
                    endif;

                    $auditoria = '';
                    if ($_POST['form']['auditoria']):
                        $auditoria = 'AND ecall_booking_id = "' . $_POST['form']['auditoria'] . '"';
                        setcookie("ecall_booking_id", $_POST['form']['auditoria'], time() + 3600);
                        
                    endif;
                    $cedula = '';
                    if ($_POST['form']['cedula']):
                        $cedula = 'AND user_document_number = ' . $_POST['form']['cedula'];
                        setcookie("user_document_number", $_POST['form']['cedula'], time() + 3600);
                    endif;
                    $autorizacion = '';
                    if ($_POST['form']['autorizacion']):
                        //$autorizacion = 'AND bank_confirmation_code = ' . $_POST['form']['autorizacion'];                    
                        $autorizacion = 'AND CONVERT(bank_confirmation_code, CHAR) = "' . $_POST['form']['autorizacion'] . '"';
                        setcookie("bank_confirmation_code", $_POST['form']['autorizacion'], time() + 3600);
                    endif;
                    $factura = '';
                    if ($_POST['form']['factura']):
                        $factura = 'AND transaction_id = ' . $_POST['form']['factura'];
                        setcookie("transaction_id", $_POST['form']['factura'], time() + 3600);
                    endif;


                    foreach ($_POST['form']['estados'] as $est):
                        $estado .= $est . ',';
                    endforeach;
                    $estado = substr($estado, 0, -1);
                    setcookie("estado", str_replace(',','-',$estado), time() + 3600);
                    setcookie("fecha_ini", $fecha_ini, time() + 3600);
                    setcookie("fecha_fin", $fecha_fin_0, time() + 3600);
                    $datos_filtro = substr($datos_filtro, 0, -1);
                    setcookie("ids_teatros_buscar", str_replace(',','-',$datos_filtro), time() + 3600);
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
                    //$resultado = array();

                    /* fin prefiltro */

                    if ($bandera == 0) {
                        if ($datos_filtro) {
                            $sql = 'SELECT * FROM cc_transaction 
                                WHERE ' . $tipo_fecha . ' BETWEEN ' . $fecha_ini . ' AND ' . $fecha_fin . '
                                AND
                                transaction_state_id IN (' . $estado . ')
                                ' . $factura . '
                                ' . $cedula . '
                                ' . $autorizacion . '
                                ' . $auditoria . '
                                AND
                                multiplex_ecall_id IN (' . $datos_filtro . ')
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
                                transaction_state_id IN (' . $estado . ')
                                ' . $factura . '
                                ' . $cedula . '
                                ' . $autorizacion . '
                                ' . $auditoria . '
                                ';
                            $stmt = $conn->query($sql);
                            $resultado = $stmt->fetchAll();
                        }
                    }

                    $sql_serializada = serialize((string) $sql);
                    setcookie("sql_serializada", $sql_serializada, time() + 3600);

                    if (count($resultado) > 0){
                        $aaaaaa = '';
                    }else{
                        $this->get('session')->getFlashBag()->add(
                                'error', 'No hay coincidencias para esta busqueda.'
                        );
                    }
                }
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

            if (count($resultado) > 0) {
                $i = 0;
                foreach ($resultado as $row) {
                    $sql_tran = 'select transaction_type_name from cc_transaction_type where transaction_type_id = ' . $row['transaction_type_id'];
                    $sql_estado = 'select transaction_state_name from cc_transaction_state where transaction_state_id = ' . $row['transaction_state_id'];
                    $sql_pelicula = 'select name from cc_show where show_id = ' . $row['show_id'];
                    $tipo_stmt = $conn->query($sql_tran);
                    $estado_stmt = $conn->query($sql_estado);
                    $pelicula_stmt = $conn->query($sql_pelicula);
                    $origen = 'M';
                    if (utf8_encode($row['origin']) == 'desktop'):
                        $origen = 'W';
                    endif;
                    $nombre_localidad = 'Preferencial';
                    if ($row['area_id'] == 'GN'):
                        $nombre_localidad = 'General';
                    endif;
                    $reporte[$i]['multiplex'] = utf8_encode($row['multiplex_name']);
                    $reporte[$i]['entidad'] = utf8_encode($row['payment_method_name']);
                    $reporte[$i]['factura'] = ($row['transaction_id']);
                    $reporte[$i]['autorizacion'] = utf8_encode($row['bank_confirmation_code']);
                    $reporte[$i]['auditoria'] = utf8_encode($row['ecall_booking_id']);
                    $reporte[$i]['estado'] = utf8_encode($estado_stmt->fetch()['transaction_state_name']);
                    $reporte[$i]['tipo_transaccion'] = utf8_encode($tipo_stmt->fetch()['transaction_type_name']);
                    $reporte[$i]['cedula'] = utf8_encode($row['user_document_number']);
                    $reporte[$i]['nombre_cliente'] = utf8_encode($row['user_full_name']);
                    $reporte[$i]['fecha_transaccion'] = utf8_encode(date('d/m/Y h:i A', $row['created']));
                    $reporte[$i]['valor_boletas'] = number_format($row['transaction_value'], 2, ',', '.');
                    $reporte[$i]['valor_cargos'] = number_format($row['transaction_total_service'], 2, ',', '.');
                    $reporte[$i]['total'] = number_format($row['transaction_total'], 2, ',', '.');
                    $reporte[$i]['funcion_id'] = utf8_encode($row['performance_id']);
                    $reporte[$i]['pelicula'] = utf8_encode($pelicula_stmt->fetch()['name']);
                    $reporte[$i]['sala'] = utf8_encode($row['hall_name']);
                    $reporte[$i]['localidad'] = utf8_encode($row['area_id']);
                    $reporte[$i]['localidad_nombre'] = $nombre_localidad;
                    $reporte[$i]['sillas'] = utf8_encode($row['selected_seats']);
                    $reporte[$i]['fecha_funcion'] = utf8_encode(date('d/m/Y h:i A', $row['performance_date']));
                    $reporte[$i]['no_boletas'] = utf8_encode($row['ticket_amount']);
                    $reporte[$i]['respuesta'] = utf8_encode($row['remote_answer']);
                    $reporte[$i]['origen'] = $origen;
                    $reporte[$i]['fecha_cierre'] = ($row['transaction_close_day_date'] == 0 ) ? '' : utf8_encode(date('d/m/Y', $row['transaction_close_day_date']));
                    $reporte[$i]['fecha_modificacion'] = ($row['admin_modified_date'] == 0 ) ? '' : utf8_encode(date('d/m/Y', $row['admin_modified_date']));
                    $reporte[$i]['usuario_modificacion'] = ($row['admin_user_plus_id'] == 0) ? '' : $row['admin_user_plus_id'];
                    $i++;
                    //endwhile;
                }
            }


            $reportes_filtro = array();
            $listado_llaves = array();
            $lista_mult = explode(',', $datos_filtro);
            //$reporte = array_map('array_values', $reporte);

            $listado_ids_entidades = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,);
            $listado_localidades = array('GN', 'PF');
            $listado_tipo_compra = array(1, 2);

            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                    $reporte, $this->get('request')->query->get('page', 1), 20
            );
            $datos_filtros = array(
                'multiplex' => $datos_filtro,
                'fecha_ini' => $fecha_ini,
                'fecha_fin' => $fecha_fin,
                'tipo_fecha' => $tipo_fecha,
                'auditoria' => $auditoria,
                'cedula' => $cedula,
                'autorizacion' => $autorizacion,
                'factura' => $factura,
                'estado' => $estado,
                'condicion' => $condicion,
                'bandera' => $bandera,
            );

            $filtros = serialize($datos_filtros);
            $filtros = (string) $filtros;
            return $this->render('PqrsBundle:Reportes:transacciones-banco.html.twig', array(
                        'form' => $form->createView(),
                        'reporte' => $pagination,
                        'lista_mult' => $lista_mult,
                        'datos' => '',
                        'filtros' => $filtros,
                        'listado_ids_entidades' => $listado_ids_entidades,
                        'listado_localidades' => $listado_localidades,
                        'listado_tipo_compra' => $listado_tipo_compra,
                        'permisos' => $permisos,
                        //'paginados' => $pagination,
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
                            transaction_state_id IN (' . $datos_filtro['estado'] . ')
                            ' . $datos_filtro['auditoria'] . '
                            ' . $datos_filtro['cedula'] . '
                            ' . $datos_filtro['autorizacion'] . '
                            ' . $datos_filtro['factura'] . '
                            AND
                            multiplex_ecall_id IN (' . $datos_filtro['multiplex'] . ') ';
            } else {
                $sql = 'SELECT * FROM cc_transaction 
                                WHERE (' . implode(' OR ', $datos_filtro['condicion']) . ')
                                AND
                                transaction_state_id IN (' . $datos_filtro['estado'] . ')
                            ' . $datos_filtro['auditoria'] . '
                            ' . $datos_filtro['cedula'] . '
                            ' . $datos_filtro['autorizacion'] . '
                            ' . $datos_filtro['factura'] . '
                                ';
            }


            //print $sql;
            $stmt = $conn->query($sql);
            $resultado = $stmt->fetchAll();
            if (count($resultado) > 0):
                $i = 0;
                //while ($row = $stmt->fetch()):
                foreach ($resultado as $row):
                    $sql_tran = 'select transaction_type_name from cc_transaction_type where transaction_type_id = ' . $row['transaction_type_id'];
                    $sql_estado = 'select transaction_state_name from cc_transaction_state where transaction_state_id = ' . $row['transaction_state_id'];
                    $sql_pelicula = 'select name from cc_show where show_id = ' . $row['show_id'];
                    $tipo_stmt = $conn->query($sql_tran);
                    $estado_stmt = $conn->query($sql_estado);
                    $pelicula_stmt = $conn->query($sql_pelicula);
                    $origen = 'M';
                    if (utf8_encode($row['origin']) == 'desktop'):
                        $origen = 'W';
                    endif;
                    $nombre_localidad = 'Preferencial';
                    if ($row['area_id'] == 'GN'):
                        $nombre_localidad = 'General';
                    endif;
                    $reporte[$i]['multiplex'] = utf8_encode($row['multiplex_name']);
                    $reporte[$i]['entidad'] = utf8_encode($row['payment_method_name']);
                    $reporte[$i]['factura'] = ($row['transaction_id']);
                    $reporte[$i]['autorizacion'] = utf8_encode($row['bank_confirmation_code']);
                    $reporte[$i]['auditoria'] = utf8_encode($row['ecall_booking_id']);
                    $reporte[$i]['estado'] = utf8_encode($estado_stmt->fetch()['transaction_state_name']);
                    $reporte[$i]['tipo_transaccion'] = utf8_encode($tipo_stmt->fetch()['transaction_type_name']);
                    $reporte[$i]['cedula'] = utf8_encode($row['user_document_number']);
                    $reporte[$i]['nombre_cliente'] = utf8_encode($row['user_full_name']);
                    $reporte[$i]['fecha_transaccion'] = utf8_encode(date('d/m/Y h:i A', $row['created']));
                    $reporte[$i]['valor_boletas'] = number_format($row['transaction_value'], 2, ',', '.');
                    $reporte[$i]['valor_cargos'] = number_format($row['transaction_total_service'], 2, ',', '.');
                    $reporte[$i]['total'] = number_format($row['transaction_total'], 2, ',', '.');
                    $reporte[$i]['funcion_id'] = utf8_encode($row['performance_id']);
                    $reporte[$i]['pelicula'] = utf8_encode($pelicula_stmt->fetch()['name']);
                    $reporte[$i]['sala'] = utf8_encode($row['hall_name']);
                    //$reporte[$i]['localidad'] = utf8_encode($row['area_id']);
                    $reporte[$i]['localidad_nombre'] = $nombre_localidad;
                    $reporte[$i]['sillas'] = utf8_encode($row['selected_seats']);
                    $reporte[$i]['fecha_funcion'] = utf8_encode(date('d/m/Y h:i A', $row['performance_date']));
                    $reporte[$i]['no_boletas'] = utf8_encode($row['ticket_amount']);
                    $reporte[$i]['respuesta'] = utf8_encode($row['remote_answer']);
                    $reporte[$i]['origen'] = $origen;
                    $reporte[$i]['fecha_cierre'] = ($row['transaction_close_day_date'] == 0 ) ? '' : utf8_encode(date('d/m/Y', $row['transaction_close_day_date']));
                    $reporte[$i]['fecha_modificacion'] = ($row['admin_modified_date'] == 0 ) ? '' : utf8_encode(date('d/m/Y', $row['admin_modified_date']));
                    $reporte[$i]['usuario_modificacion'] = ($row['admin_user_plus_id'] == 0) ? '' : $row['admin_user_plus_id'];
                    $i++;
                    //endwhile;
                endforeach;
            else:
                $this->get('session')->getFlashBag()->add(
                        'error', 'No hay coincidencias para esta busqueda.'
                );
            endif;

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
            $phpExcelObject->getProperties()->setCreator("Reporte")
                    ->setLastModifiedBy("Reporte")
                    ->setTitle("Reporte")
                    ->setSubject("Reporte")
                    ->setDescription("Archivo con resusltados de reportes")
                    ->setKeywords("reporte xls")
                    ->setCategory("Reportes");
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C1', 'REPORTES PORTAL CINECO -  TRANSACCIONES BANCO');
            $phpExcelObject->getActiveSheet()->getStyle('C1:C2')->applyFromArray($styleEncabezados);
            $phpExcelObject->getActiveSheet()->getRowDimension(1)->setRowHeight(40);
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('E3', 'Fecha Incio')
                    ->setCellValue('F3', 'Fecha Fin')
                    ->setCellValue('E4', date('d/m/Y', $datos_filtro['fecha_ini']))
                    ->setCellValue('F4', date('d/m/Y', $datos_filtro['fecha_fin']));
            $phpExcelObject->getActiveSheet()->getStyle('A7:Y7')->applyFromArray($styleTitulos);
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A7', 'Nombre Teatro')
                    ->setCellValue('B7', 'Entidad Financiera')
                    ->setCellValue('C7', 'Factura')
                    ->setCellValue('D7', 'Autorización Banco')
                    ->setCellValue('E7', 'Número de Auditoria')
                    ->setCellValue('F7', 'Estado Transacción')
                    ->setCellValue('G7', 'Tipo de Transacción')
                    ->setCellValue('H7', 'Cédula del cliente')
                    ->setCellValue('I7', 'Nombre del Cliente')
                    ->setCellValue('J7', 'Fecha y hora de Transacción')
                    ->setCellValue('K7', 'Valor boletas')
                    ->setCellValue('L7', 'Valor cargos')
                    ->setCellValue('M7', 'Total transacción')
                    ->setCellValue('N7', 'Función ID')
                    ->setCellValue('O7', 'Pelicula Nombre')
                    ->setCellValue('P7', 'Sala')
                    ->setCellValue('Q7', 'Localidad')
                    ->setCellValue('R7', 'Sillas')
                    ->setCellValue('S7', 'Fecha y hora Función')
                    ->setCellValue('T7', 'Número de boletas')
                    ->setCellValue('U7', 'Respuesta del Banco')
                    ->setCellValue('V7', 'Origen')
                    ->setCellValue('W7', 'Fecha de cierre')
                    ->setCellValue('X7', 'Fecha Modificación')
                    ->setCellValue('Y7', 'Usuario Modificación');
            
            $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            //$phpExcelObject->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->fromArray($reporte, null, 'A8');
            
            $phpExcelObject->getActiveSheet()->getStyle('K8:L30000')->getNumberFormat()->setFormatCode('#,##0.00');
            $phpExcelObject->getActiveSheet()->getStyle('L8:L30000')->getNumberFormat()->setFormatCode('#,##0.00');
            $phpExcelObject->getActiveSheet()->getStyle('M8:L30000')->getNumberFormat()->setFormatCode('#,##0.00');
            /*$i = 8;
            foreach ($reporte as $re):
                $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $re['multiplex'])
                        ->setCellValue('B' . $i, $re['entidad'])
                        ->setCellValue('C' . $i, $re['factura'])
                        ->setCellValue('D' . $i, $re['autorizacion'])
                        ->setCellValue('E' . $i, $re['auditoria'])
                        ->setCellValue('F' . $i, $re['estado'])
                        ->setCellValue('G' . $i, $re['tipo_transaccion'])
                        ->setCellValue('H' . $i, $re['cedula'])
                        ->setCellValue('I' . $i, $re['nombre_cliente'])
                        ->setCellValue('J' . $i, $re['fecha_transaccion'])
                        ->setCellValue('K' . $i, $re['valor_boletas'])
                        ->setCellValue('L' . $i, $re['valor_cargos'])
                        ->setCellValue('M' . $i, $re['total'])
                        ->setCellValue('N' . $i, $re['funcion_id'])
                        ->setCellValue('O' . $i, $re['pelicula'])
                        ->setCellValue('P' . $i, $re['sala'])
                        ->setCellValue('Q' . $i, $re['localidad_nombre'])
                        ->setCellValue('R' . $i, $re['sillas'])
                        ->setCellValue('S' . $i, $re['fecha_funcion'])
                        ->setCellValue('T' . $i, $re['no_boletas'])
                        ->setCellValue('U' . $i, $re['respuesta'])
                        ->setCellValue('V' . $i, $re['origen'])
                        ->setCellValue('W' . $i, $re['fecha_cierre'])
                        ->setCellValue('X' . $i, $re['fecha_modificacion'])
                        ->setCellValue('Y' . $i, $re['usuario_modificacion']);
                $phpExcelObject->getActiveSheet()->getStyle("A8:Y$i")->applyFromArray($styleResultados);
                $i++;
            endforeach;
             * 
             */
            $phpExcelObject->getActiveSheet()->setTitle('Reporte Transacciones Banco');
            $phpExcelObject->setActiveSheetIndex(0);
            $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
            $response = $this->get('phpexcel')->createStreamedResponse($writer);
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Content-Disposition', 'attachment;filename=reporte-transacciones-banco.xls');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Cache-Control', 'maxage=1');
            return $response;
        else:
            return $this->redirectToRoute('reporte_transacciones_banco');
        endif;
    }

}
