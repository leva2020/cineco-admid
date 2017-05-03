<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use PqrsBundle\Entity\Cierre;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CierreFechaController extends Controller {

    public function cierreAction(Request $request) {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if ($session->get('name')):
            $variables_globales = $em->getRepository('PqrsBundle:VariablesGlobales')->findAll();
            foreach ($variables_globales as $var) {
                if ($var->getNombre() == 'incio_cierre_teatros') {
                    $incio_cierre_teatros = $var->getValor();
                }
            }
            $tokens = $session->get('tokens');
            $multiplex = array();
            if (isset($tokens['multiplex']))
                $multiplex = $tokens['multiplex'];
            $areas = $tokens['areas'];
            $permisos = $tokens['permisos_nombres'];
            if (!in_array('CONSULTAR', $permisos)):
                return $this->redirectToRoute('login');
            endif;

            $pqrs = array();
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
                    ->add('fecha_cierre', 'text', array(
                        'label' => 'Fecha Cierre',
                        'required' => true,
                        'mapped' => false,
                        'attr' => array('class' => 'fecha-inicial')
                    ))
                    ->add('save', 'submit', array(
                        'label' => 'Generar',
                        'attr' => array('class' => 'btn btn-primary')))
                    ->getForm();
            $teatros = '';
            $info_registro = array();
            $fecha_cierre = '';
            $form->handleRequest($request);
            if ($form->isValid()):
                if (strlen($listado_id_multiplex) == 0):
                    $this->get('session')->getFlashBag()->add(
                            'error', 'Debes tener al menos un teatro.'
                    );
                else:
                    $fecha_cierre = '';
                    $incio_cierre_teatros = strtotime(date($incio_cierre_teatros));
                    if ($_POST['form']['fecha_cierre']):
                        $fecha_cierre = $_POST['form']['fecha_cierre'];
                        $fecha_cierre = str_replace('/', '-', $fecha_cierre);
                        $fecha_cierre = date('Y-m-d', strtotime($fecha_cierre));
                        $fecha_cierre = strtotime($fecha_cierre);
                    endif;

                    if (isset($_POST['form']['multiplex'])):
                        if (in_array(0, $_POST['form']['multiplex'])):
                            $teatros = $listado_id_multiplex;
                        else:
                            foreach ($_POST['form']['multiplex'] as $ids):
                                $teatros .= $ids . ',';
                            endforeach;
                        endif;
                    endif;
                    $teatros = explode(',', $teatros);
                    $fecha_cierre_ant = $fecha_cierre;
                    $fecha_cierre_ant_real = $fecha_cierre;
                    $i = 0;
                    $info_registro = array();
                    foreach ($teatros as $te) {
                        if ($te != '') {
                            $cierres_teatros = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Cierre')->findBy(array('id_multiplex' => $te));
                            $cierres_teatros = ((array) $cierres_teatros);
                            $cierres_teatros = array_pop($cierres_teatros);
                            if ($cierres_teatros) {
                                $fecha_cierre_ant = $cierres_teatros->getFechaCierre();
                                $fecha_cierre_ant_real = $cierres_teatros->getFechaSistema();
                            } else {
                                $fecha_cierre_ant_real = $incio_cierre_teatros;
                                $fecha_cierre_ant = $incio_cierre_teatros;
                            }
                            $fecha_cierre_ant_com = strtotime(date('Y-m-d',$fecha_cierre_ant));
                            $fecha_cierre_com = strtotime(date('Y-m-d',$fecha_cierre));
                            //print $fecha_cierre_ant_com.'-'.$fecha_cierre_com;
                            //if ($fecha_cierre_ant_com >= $fecha_cierre_com) {
                            if ($fecha_cierre_ant >= $fecha_cierre_com) {
                                $info_registro[$i]['teatro_nombre'] = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Multiplex')->findOneBy(array('id_multiplex' => $te))->getNombre();
                                $info_registro[$i]['mensaje'] = 'Ya existe un cierre con un fecha superior a la ingresada para este teatro';
                            } else {
                                $cierre = new Cierre();
                                $cierre->setIdMultiplex($te);
                                $cierre->setFechaCierreAnterior($fecha_cierre_ant_real);
                                $cierre->setFechaCierre($fecha_cierre);
                                $cierre->setFechaSistema($hoy);
                                $cierre_em = $this->getDoctrine()->getManager();
                                $cierre_em->persist($cierre);
                                $cierre_em->flush();
                                $info_registro[$i]['teatro'] = $te;
                                $info_registro[$i]['teatro_nombre'] = $multiplex = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Multiplex')->findOneBy(array('id_multiplex' => $te))->getNombre();
                                $info_registro[$i]['cierre_ant'] = date('Y-m-d h:i A', $fecha_cierre_ant_real);
                                $info_registro[$i]['cierre'] = date('Y-m-d h:i A', $fecha_cierre);
                                $info_registro[$i]['fecha_sistema'] = date('Y-m-d h:i A', $hoy);
                                $info_registro[$i]['mensaje'] = '';
                            }
                            $i++;
                        }
                    }
                endif;
            endif;
            return $this->render('PqrsBundle:Reportes:cierre-fechas.html.twig', array(
                        'form' => $form->createView(),
                        'registro' => $info_registro,
            ));

        else:
            return $this->redirectToRoute('login');
        endif;
    }

}
