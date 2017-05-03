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

class PqrsController extends Controller {

    public function indexAction(Request $request) {
        $session = $request->getSession();
        $datos_filtro = array();
        if ($session->get('name')) {
            $tokens = $session->get('tokens');
            $portales = $tokens['portales'];
            $areas = $tokens['areas'];
            $permisos = $tokens['permisos_nombres'];
            if (!in_array('LEER', $permisos) && in_array('CONSULTAR', $permisos)) {
                return $this->redirectToRoute('reporte_ventas_diarias');
            }
            
            $filtros = $session->get('filters');
            if (isset($filtros)) {
                $datos_filtro = $session->get('filters');
            } else {
                $datos_filtro['portal'] = $portales;
                $datos_filtro['area'] = $areas;
                if (in_array(1, $areas) || in_array('ADMIN', $tokens['roles'])) {
                    $datos_filtro['estado'] = 1;
                    //unset($datos_filtro['estado']);
                } else {
                    $datos_filtro['estado'] = 2;
                }
                $session->set('filters', $datos_filtro);
            }
            if (in_array(1, $areas) || in_array('ADMIN', $tokens['roles'])) {
                unset($datos_filtro['area']);
            }

            if (!isset($_GET['page'])) {
                if (in_array(1, $areas) || in_array('ADMIN', $tokens['roles'])) {
                    //unset($datos_filtro['estado']);
                    $datos_filtro['estado'] = 1;
                } else {
                    $datos_filtro['estado'] = 2;
                }
                $session->set('filters', $datos_filtro);
            }

            if (!empty($datos_filtro['estado'])) {
                setcookie("datos_filtro_estado", $datos_filtro['estado'], time() + 3600);
            }
            else{
                unset($datos_filtro['estado']);
            }            
            setcookie("datos_filtro_documento", '', time() - 3600);
            setcookie("datos_filtro_documento", '', time() - 3600);
            $pqrs = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Pqrs')->findBy($datos_filtro, array('id' => 'asc'));
            $em = $this->getDoctrine()->getManager();
            $form_pqrs = new Pqrs();
            $alerta_amarilla = '';
            $alerta_roja = '';
            $variables_globales = $em->getRepository('PqrsBundle:VariablesGlobales')->findAll();
            foreach ($variables_globales as $var):
                if ($var->getNombre() == 'registro_dias_amarillo') {
                    $alerta_amarilla = $var->getValor();
                }
                if ($var->getNombre() == 'registro_dias_rojo') {
                    $alerta_roja = $var->getValor();
                }
            endforeach;
            $listado_portales = array();
            $lista_portales = $em->getRepository('PqrsBundle:Portal')->findAll();
            foreach ($lista_portales as $por):
                if (in_array($por->getId(), $portales)) {
                    $listado_portales[$por->getId()] = $por->getNombre();
                }
            endforeach;
            $form = $this->createFormBuilder()
                    ->add('id', 'text', array(
                        'required' => false,
                        'label' => 'Id contacto'
                    ))
                    ->add('documento_usuario', 'text', array(
                        'required' => false,
                    ))
                    ->add('correo', 'text', array(
                        'required' => false,
                    ))
                    ->add('estado', 'choice', array(
                        'choices' => array(1 => 'Iniciado', 2 => 'Progreso', 3 => 'Solucionado', 4 => 'Comunicado'),
                        'label' => 'Estado',
                        'required' => false,
                        'empty_value' => 'Selecciona algún estado',
                        'attr' => array('class' => 'input-small')
                    ))
                    ->add('portal', 'choice', array(
                        'choices' => $listado_portales,
                        'empty_value' => 'Selecciona algún portal',
                        'required' => false,
                        'label' => 'Portal',
                        'attr' => array('class' => 'input-small')
                    ))
                    ->add('save', 'submit', array(
                        'label' => 'Buscar',
                        'attr' => array(
                            'class' => 'btn btn-primary',
                            'onclick' => "history.pushState({id: 'SOME ID'}, '', '/');",
                        )
                    ))
                    ->getForm();
            /* Filtros busqueda */
            $form->handleRequest($request);
            if ($form->isValid()) {
                $datos_filtro = array(
                    'id' => $_POST['form']['id'],
                    'documento_usuario' => $_POST['form']['documento_usuario'],
                    'correo' => $_POST['form']['correo'],
                    'estado' => $_POST['form']['estado'],
                    'area' => $areas,
                    'portal' => $portales,
                );
                if (!$_POST['form']['id']) {
                    unset($datos_filtro['id']);
                }
                if (!$_POST['form']['documento_usuario']) {
                    unset($datos_filtro['documento_usuario']);
                }
                if (!$_POST['form']['correo']) {
                    unset($datos_filtro['correo']);
                }
                if (!$_POST['form']['estado']) {
                    unset($datos_filtro['estado']);
                }
                if (in_array(1, $areas) || in_array('ADMIN', $tokens['roles'])) {
                    unset($datos_filtro['area']);
                }
                //endif;
                //$session->set('filters', $datos_filtro);

                if ($_POST['form']['correo']) {
                    setcookie("datos_filtro_correo", $datos_filtro['correo'], time() + 5);
                } else {
                    setcookie("datos_filtro_correo", '', time() - 5);
                }
                if ($_POST['form']['documento_usuario']) {
                    setcookie("datos_filtro_documento", $datos_filtro['documento_usuario'], time() + 5);
                } else {
                    unset($_COOKIE['documento_usuario']);
                    setcookie("datos_filtro_documento", '', time() - 5);
                }
                if ($_POST['form']['estado']) {
                    setcookie("datos_filtro_estado", (int) $_POST['form']['estado'], time() + 5);
                } else {
                    unset($_COOKIE['datos_filtro_estado']);
                    setcookie("datos_filtro_estado", '', time() - 5);
                }

                if ($_POST['form']['id']) {
                    setcookie("datos_filtro_estado", 0, time() - 5);
                    unset($datos_filtro['documento_usuario']);
                    unset($datos_filtro['correo']);
                    unset($datos_filtro['estado']);
                    unset($datos_filtro['area']);
                }

                $pqrs = $em->getRepository('PqrsBundle:Pqrs')->findBy(
                        $datos_filtro, array('id' => 'asc')
                );
                
                unset($datos_filtro['id']);
                $datos_filtro = array(
                    'estado' => $_POST['form']['estado'],
                    'area' => $areas,
                    'portal' => $portales,
                );
                $session->set('filters', $datos_filtro);
                
                if (empty($pqrs)) {
                    $this->get('session')->getFlashBag()->add(
                            'error', 'No hay coincidencias para esta busqueda.'
                    );
                }
            }
            else{
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
            }
            /* Fin filtros */            

            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                    $pqrs, $this->get('request')->query->get('page', 1), 25
            );
            $datos_pqrs = array();
            $i = 0;
            $hoy = strtotime(date('Y-m-d h:i A'));
            foreach ($pqrs as $pq):
                $fecha_hora = $pq->getFechaHora();
                $fecha = $pq->getFechaRegistro();
                $fecha_mod = $pq->getFechaModificacion();
                $dias_reg = $hoy - $fecha;
                $dias_reg = round($dias_reg / (60 * 60 * 24));
                $color_pqrs = 'verde';
                if ($dias_reg > $alerta_amarilla && $dias_reg < $alerta_roja):
                    $color_pqrs = 'amarillo';
                elseif ($dias_reg > $alerta_roja - 1):
                    $color_pqrs = 'rojo';
                endif;
                $fecha = date('d/m/Y h:i:s A', $fecha);
                $fecha_mod = date('d/m/Y h:i:s A', $fecha_mod);
                $id_comunicacion = $pq->getTipoComunicacion();
                $datos_pqrs[$pq->getId()]['tipo_comunicacion'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:TipoComunicacion')->findOneBy(array('id_comunicacion' => $id_comunicacion))->getNombre();
                $id_estado = $pq->getEstado();
                if($id_estado == 4){
                    $color_pqrs = '';
                }
                $estado = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Estados')->findOneBy(array('id_estado' => $id_estado))->getNombre();
                $portal = $pq->getPortal();
                $portal = $portal->getNombre();
                $datos_pqrs[$pq->getId()]['estado'] = $estado;
                $datos_pqrs[$pq->getId()]['portal'] = $portal;
                $datos_pqrs[$pq->getId()]['fechahora'] = $fecha_hora;
                $datos_pqrs[$pq->getId()]['fecha'] = $fecha;
                $datos_pqrs[$pq->getId()]['fecha_mod'] = $fecha_mod;
                $datos_pqrs[$pq->getId()]['diasreg'] = $dias_reg;
                $datos_pqrs[$pq->getId()]['color'] = $color_pqrs;
                $id_area = $pq->getArea();
                $datos_pqrs[$pq->getId()]['area'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Area')->findOneBy(array('id' => $id_area))->getNombre();
                $i++;
            endforeach;
            return $this->render('PqrsBundle:Pqrs:index.html.twig', array('form' => $form->createView(), 'pqrs' => $pagination, 'datos' => $datos_pqrs));
        }else {
            return $this->redirectToRoute('login');
        }
    }

}
