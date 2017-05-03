<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // pqrs_home
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'pqrs_home');
            }

            return array (  '_controller' => 'PqrsBundle\\Controller\\PqrsController::indexAction',  '_route' => 'pqrs_home',);
        }

        // pqrs_detalle
        if (0 === strpos($pathinfo, '/detalle-pqrs') && preg_match('#^/detalle\\-pqrs/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pqrs_detalle')), array (  '_controller' => 'PqrsBundle\\Controller\\DetallePqrsController::indexAction',));
        }

        // pqrs_respuesta
        if (0 === strpos($pathinfo, '/respuesta-pqrs') && preg_match('#^/respuesta\\-pqrs/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pqrs_respuesta')), array (  '_controller' => 'PqrsBundle\\Controller\\RespuestaController::indexAction',));
        }

        // pqrs_respuesta_detalle
        if (0 === strpos($pathinfo, '/detalle-respuesta-pqrs') && preg_match('#^/detalle\\-respuesta\\-pqrs/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pqrs_respuesta_detalle')), array (  '_controller' => 'PqrsBundle\\Controller\\RespuestaDetalleController::indexAction',));
        }

        // pqrs_respuesta_detalle_editar
        if (0 === strpos($pathinfo, '/editar-respuesta-pqrs') && preg_match('#^/editar\\-respuesta\\-pqrs/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pqrs_respuesta_detalle_editar')), array (  '_controller' => 'PqrsBundle\\Controller\\RespuestaDetalleController::editarAction',));
        }

        // obtenerpqrs
        if ($pathinfo === '/register/pqrs/datos.json') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_obtenerpqrs;
            }

            return array (  '_controller' => 'PqrsBundle\\Controller\\ObtenerPqrsController::indexAction',  '_format' => 'json',  '_locale' => 'en',  '_route' => 'obtenerpqrs',);
        }
        not_obtenerpqrs:

        // pqrs_alertas
        if ($pathinfo === '/alertas-pqrs') {
            return array (  '_controller' => 'PqrsBundle\\Controller\\AlertasPqrsController::indexAction',  '_route' => 'pqrs_alertas',);
        }

        // login
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'PqrsBundle\\Controller\\SesionController::loginAction',  '_route' => 'login',);
        }

        // cambio_clave
        if ($pathinfo === '/cambio-clave') {
            return array (  '_controller' => 'PqrsBundle\\Controller\\SesionController::passwordAction',  '_route' => 'cambio_clave',);
        }

        // logout_sesion
        if ($pathinfo === '/logout-sesion') {
            return array (  '_controller' => 'PqrsBundle\\Controller\\SesionController::logoutAction',  '_route' => 'logout_sesion',);
        }

        if (0 === strpos($pathinfo, '/reporte-')) {
            if (0 === strpos($pathinfo, '/reporte-pqrs')) {
                // reporte_pqrs
                if ($pathinfo === '/reporte-pqrs') {
                    return array (  '_controller' => 'PqrsBundle\\Controller\\ReportesPqrsController::indexAction',  '_route' => 'reporte_pqrs',);
                }

                if (0 === strpos($pathinfo, '/reporte-pqrs-')) {
                    // reporte_archivo_pqrs
                    if (0 === strpos($pathinfo, '/reporte-pqrs-archivo') && preg_match('#^/reporte\\-pqrs\\-archivo/(?P<filtros>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'reporte_archivo_pqrs')), array (  '_controller' => 'PqrsBundle\\Controller\\ReportesPqrsController::generarAction',));
                    }

                    // reporte_pqrs_fechas
                    if ($pathinfo === '/reporte-pqrs-respuestas') {
                        return array (  '_controller' => 'PqrsBundle\\Controller\\ReportesPqrsFechasController::indexAction',  '_route' => 'reporte_pqrs_fechas',);
                    }

                    // reporte_archivo_pqrs_fechas
                    if (0 === strpos($pathinfo, '/reporte-pqrs-archivo-fechas') && preg_match('#^/reporte\\-pqrs\\-archivo\\-fechas/(?P<filtros>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'reporte_archivo_pqrs_fechas')), array (  '_controller' => 'PqrsBundle\\Controller\\ReportesPqrsFechasController::generarAction',));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/reporte-ventas')) {
                // reporte_ventas_diarias
                if ($pathinfo === '/reporte-ventas-diarias') {
                    return array (  '_controller' => 'PqrsBundle\\Controller\\ReportesVentasDiariasController::indexAction',  '_route' => 'reporte_ventas_diarias',);
                }

                // reporte_archivo_ventas_diarias
                if (0 === strpos($pathinfo, '/reporte-ventas_diarias-archivo') && preg_match('#^/reporte\\-ventas_diarias\\-archivo/(?P<filtros>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'reporte_archivo_ventas_diarias')), array (  '_controller' => 'PqrsBundle\\Controller\\ReportesVentasDiariasController::generarAction',));
                }

            }

            if (0 === strpos($pathinfo, '/reporte-transacciones-banco')) {
                // reporte_transacciones_banco
                if ($pathinfo === '/reporte-transacciones-banco') {
                    return array (  '_controller' => 'PqrsBundle\\Controller\\ReportesTransaccionesBancoController::indexAction',  '_route' => 'reporte_transacciones_banco',);
                }

                // reporte_archivo_transacciones_banco
                if (0 === strpos($pathinfo, '/reporte-transacciones-banco-archivo') && preg_match('#^/reporte\\-transacciones\\-banco\\-archivo/(?P<filtros>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'reporte_archivo_transacciones_banco')), array (  '_controller' => 'PqrsBundle\\Controller\\ReportesTransaccionesBancoController::generarAction',));
                }

            }

            if (0 === strpos($pathinfo, '/reporte-consolidado-banco')) {
                // reporte_consolidado_banco
                if ($pathinfo === '/reporte-consolidado-banco') {
                    return array (  '_controller' => 'PqrsBundle\\Controller\\ReportesConsolidadoBancosController::indexAction',  '_route' => 'reporte_consolidado_banco',);
                }

                // reporte_archivo_consolidado_bancos
                if (0 === strpos($pathinfo, '/reporte-consolidado-bancos-archivo') && preg_match('#^/reporte\\-consolidado\\-bancos\\-archivo/(?P<filtros>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'reporte_archivo_consolidado_bancos')), array (  '_controller' => 'PqrsBundle\\Controller\\ReportesConsolidadoBancosController::generarAction',));
                }

            }

            if (0 === strpos($pathinfo, '/reporte-transacciones-devoluciones')) {
                // reporte_transacciones_devoluciones
                if ($pathinfo === '/reporte-transacciones-devoluciones') {
                    return array (  '_controller' => 'PqrsBundle\\Controller\\ReportesTransaccionesDevolucionesController::indexAction',  '_route' => 'reporte_transacciones_devoluciones',);
                }

                // reporte_archivo_transacciones_devoluciones
                if (0 === strpos($pathinfo, '/reporte-transacciones-devoluciones-archivo') && preg_match('#^/reporte\\-transacciones\\-devoluciones\\-archivo/(?P<filtros>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'reporte_archivo_transacciones_devoluciones')), array (  '_controller' => 'PqrsBundle\\Controller\\ReportesTransaccionesDevolucionesController::generarAction',));
                }

            }

        }

        // cierre_fecha_transacciones
        if ($pathinfo === '/cierre-fecha') {
            return array (  '_controller' => 'PqrsBundle\\Controller\\CierreFechaController::cierreAction',  '_route' => 'cierre_fecha_transacciones',);
        }

        if (0 === strpos($pathinfo, '/a')) {
            // homepage
            if ($pathinfo === '/app/example') {
                return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
            }

            if (0 === strpos($pathinfo, '/admin')) {
                // sonata_admin_redirect
                if (rtrim($pathinfo, '/') === '/admin') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_admin_redirect');
                    }

                    return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
                }

                // sonata_admin_dashboard
                if ($pathinfo === '/admin/dashboard') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
                }

                if (0 === strpos($pathinfo, '/admin/core')) {
                    // sonata_admin_retrieve_form_element
                    if ($pathinfo === '/admin/core/get-form-field-element') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
                    }

                    // sonata_admin_append_form_element
                    if ($pathinfo === '/admin/core/append-form-field-element') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
                    }

                    // sonata_admin_short_object_information
                    if (0 === strpos($pathinfo, '/admin/core/get-short-object-description') && preg_match('#^/admin/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_format' => 'html',));
                    }

                    // sonata_admin_set_object_field_value
                    if ($pathinfo === '/admin/core/set-object-field-value') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
                    }

                }

                // sonata_admin_search
                if ($pathinfo === '/admin/search') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::searchAction',  '_route' => 'sonata_admin_search',);
                }

                // sonata_admin_retrieve_autocomplete_items
                if ($pathinfo === '/admin/core/get-autocomplete-items') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:retrieveAutocompleteItemsAction',  '_route' => 'sonata_admin_retrieve_autocomplete_items',);
                }

                if (0 === strpos($pathinfo, '/admin/pqrs')) {
                    if (0 === strpos($pathinfo, '/admin/pqrs/usuario')) {
                        // admin_pqrs_usuario_list
                        if ($pathinfo === '/admin/pqrs/usuario/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.usuario',  '_sonata_name' => 'admin_pqrs_usuario_list',  '_route' => 'admin_pqrs_usuario_list',);
                        }

                        // admin_pqrs_usuario_create
                        if ($pathinfo === '/admin/pqrs/usuario/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.usuario',  '_sonata_name' => 'admin_pqrs_usuario_create',  '_route' => 'admin_pqrs_usuario_create',);
                        }

                        // admin_pqrs_usuario_batch
                        if ($pathinfo === '/admin/pqrs/usuario/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.usuario',  '_sonata_name' => 'admin_pqrs_usuario_batch',  '_route' => 'admin_pqrs_usuario_batch',);
                        }

                        // admin_pqrs_usuario_edit
                        if (preg_match('#^/admin/pqrs/usuario/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_usuario_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.usuario',  '_sonata_name' => 'admin_pqrs_usuario_edit',));
                        }

                        // admin_pqrs_usuario_delete
                        if (preg_match('#^/admin/pqrs/usuario/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_usuario_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.usuario',  '_sonata_name' => 'admin_pqrs_usuario_delete',));
                        }

                        // admin_pqrs_usuario_show
                        if (preg_match('#^/admin/pqrs/usuario/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_usuario_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.usuario',  '_sonata_name' => 'admin_pqrs_usuario_show',));
                        }

                        // admin_pqrs_usuario_export
                        if ($pathinfo === '/admin/pqrs/usuario/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.usuario',  '_sonata_name' => 'admin_pqrs_usuario_export',  '_route' => 'admin_pqrs_usuario_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/pqrs/area')) {
                        // admin_pqrs_area_list
                        if ($pathinfo === '/admin/pqrs/area/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.area',  '_sonata_name' => 'admin_pqrs_area_list',  '_route' => 'admin_pqrs_area_list',);
                        }

                        // admin_pqrs_area_create
                        if ($pathinfo === '/admin/pqrs/area/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.area',  '_sonata_name' => 'admin_pqrs_area_create',  '_route' => 'admin_pqrs_area_create',);
                        }

                        // admin_pqrs_area_batch
                        if ($pathinfo === '/admin/pqrs/area/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.area',  '_sonata_name' => 'admin_pqrs_area_batch',  '_route' => 'admin_pqrs_area_batch',);
                        }

                        // admin_pqrs_area_edit
                        if (preg_match('#^/admin/pqrs/area/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_area_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.area',  '_sonata_name' => 'admin_pqrs_area_edit',));
                        }

                        // admin_pqrs_area_delete
                        if (preg_match('#^/admin/pqrs/area/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_area_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.area',  '_sonata_name' => 'admin_pqrs_area_delete',));
                        }

                        // admin_pqrs_area_show
                        if (preg_match('#^/admin/pqrs/area/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_area_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.area',  '_sonata_name' => 'admin_pqrs_area_show',));
                        }

                        // admin_pqrs_area_export
                        if ($pathinfo === '/admin/pqrs/area/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.area',  '_sonata_name' => 'admin_pqrs_area_export',  '_route' => 'admin_pqrs_area_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/pqrs/roles')) {
                        // admin_pqrs_roles_list
                        if ($pathinfo === '/admin/pqrs/roles/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.roles',  '_sonata_name' => 'admin_pqrs_roles_list',  '_route' => 'admin_pqrs_roles_list',);
                        }

                        // admin_pqrs_roles_create
                        if ($pathinfo === '/admin/pqrs/roles/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.roles',  '_sonata_name' => 'admin_pqrs_roles_create',  '_route' => 'admin_pqrs_roles_create',);
                        }

                        // admin_pqrs_roles_batch
                        if ($pathinfo === '/admin/pqrs/roles/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.roles',  '_sonata_name' => 'admin_pqrs_roles_batch',  '_route' => 'admin_pqrs_roles_batch',);
                        }

                        // admin_pqrs_roles_edit
                        if (preg_match('#^/admin/pqrs/roles/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_roles_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.roles',  '_sonata_name' => 'admin_pqrs_roles_edit',));
                        }

                        // admin_pqrs_roles_delete
                        if (preg_match('#^/admin/pqrs/roles/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_roles_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.roles',  '_sonata_name' => 'admin_pqrs_roles_delete',));
                        }

                        // admin_pqrs_roles_show
                        if (preg_match('#^/admin/pqrs/roles/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_roles_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.roles',  '_sonata_name' => 'admin_pqrs_roles_show',));
                        }

                        // admin_pqrs_roles_export
                        if ($pathinfo === '/admin/pqrs/roles/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.roles',  '_sonata_name' => 'admin_pqrs_roles_export',  '_route' => 'admin_pqrs_roles_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/pqrs/p')) {
                        if (0 === strpos($pathinfo, '/admin/pqrs/permisos')) {
                            // admin_pqrs_permisos_list
                            if ($pathinfo === '/admin/pqrs/permisos/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.permisos',  '_sonata_name' => 'admin_pqrs_permisos_list',  '_route' => 'admin_pqrs_permisos_list',);
                            }

                            // admin_pqrs_permisos_create
                            if ($pathinfo === '/admin/pqrs/permisos/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.permisos',  '_sonata_name' => 'admin_pqrs_permisos_create',  '_route' => 'admin_pqrs_permisos_create',);
                            }

                            // admin_pqrs_permisos_batch
                            if ($pathinfo === '/admin/pqrs/permisos/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.permisos',  '_sonata_name' => 'admin_pqrs_permisos_batch',  '_route' => 'admin_pqrs_permisos_batch',);
                            }

                            // admin_pqrs_permisos_edit
                            if (preg_match('#^/admin/pqrs/permisos/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_permisos_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.permisos',  '_sonata_name' => 'admin_pqrs_permisos_edit',));
                            }

                            // admin_pqrs_permisos_delete
                            if (preg_match('#^/admin/pqrs/permisos/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_permisos_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.permisos',  '_sonata_name' => 'admin_pqrs_permisos_delete',));
                            }

                            // admin_pqrs_permisos_show
                            if (preg_match('#^/admin/pqrs/permisos/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_permisos_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.permisos',  '_sonata_name' => 'admin_pqrs_permisos_show',));
                            }

                            // admin_pqrs_permisos_export
                            if ($pathinfo === '/admin/pqrs/permisos/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.permisos',  '_sonata_name' => 'admin_pqrs_permisos_export',  '_route' => 'admin_pqrs_permisos_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/pqrs/portal')) {
                            // admin_pqrs_portal_list
                            if ($pathinfo === '/admin/pqrs/portal/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.portal',  '_sonata_name' => 'admin_pqrs_portal_list',  '_route' => 'admin_pqrs_portal_list',);
                            }

                            // admin_pqrs_portal_create
                            if ($pathinfo === '/admin/pqrs/portal/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.portal',  '_sonata_name' => 'admin_pqrs_portal_create',  '_route' => 'admin_pqrs_portal_create',);
                            }

                            // admin_pqrs_portal_batch
                            if ($pathinfo === '/admin/pqrs/portal/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.portal',  '_sonata_name' => 'admin_pqrs_portal_batch',  '_route' => 'admin_pqrs_portal_batch',);
                            }

                            // admin_pqrs_portal_edit
                            if (preg_match('#^/admin/pqrs/portal/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_portal_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.portal',  '_sonata_name' => 'admin_pqrs_portal_edit',));
                            }

                            // admin_pqrs_portal_delete
                            if (preg_match('#^/admin/pqrs/portal/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_portal_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.portal',  '_sonata_name' => 'admin_pqrs_portal_delete',));
                            }

                            // admin_pqrs_portal_show
                            if (preg_match('#^/admin/pqrs/portal/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_portal_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.portal',  '_sonata_name' => 'admin_pqrs_portal_show',));
                            }

                            // admin_pqrs_portal_export
                            if ($pathinfo === '/admin/pqrs/portal/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.portal',  '_sonata_name' => 'admin_pqrs_portal_export',  '_route' => 'admin_pqrs_portal_export',);
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/pqrs/variablesglobales')) {
                        // admin_pqrs_variablesglobales_list
                        if ($pathinfo === '/admin/pqrs/variablesglobales/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.variablesglobales',  '_sonata_name' => 'admin_pqrs_variablesglobales_list',  '_route' => 'admin_pqrs_variablesglobales_list',);
                        }

                        // admin_pqrs_variablesglobales_create
                        if ($pathinfo === '/admin/pqrs/variablesglobales/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.variablesglobales',  '_sonata_name' => 'admin_pqrs_variablesglobales_create',  '_route' => 'admin_pqrs_variablesglobales_create',);
                        }

                        // admin_pqrs_variablesglobales_batch
                        if ($pathinfo === '/admin/pqrs/variablesglobales/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.variablesglobales',  '_sonata_name' => 'admin_pqrs_variablesglobales_batch',  '_route' => 'admin_pqrs_variablesglobales_batch',);
                        }

                        // admin_pqrs_variablesglobales_edit
                        if (preg_match('#^/admin/pqrs/variablesglobales/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_variablesglobales_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.variablesglobales',  '_sonata_name' => 'admin_pqrs_variablesglobales_edit',));
                        }

                        // admin_pqrs_variablesglobales_delete
                        if (preg_match('#^/admin/pqrs/variablesglobales/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_variablesglobales_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.variablesglobales',  '_sonata_name' => 'admin_pqrs_variablesglobales_delete',));
                        }

                        // admin_pqrs_variablesglobales_show
                        if (preg_match('#^/admin/pqrs/variablesglobales/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_variablesglobales_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.variablesglobales',  '_sonata_name' => 'admin_pqrs_variablesglobales_show',));
                        }

                        // admin_pqrs_variablesglobales_export
                        if ($pathinfo === '/admin/pqrs/variablesglobales/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.variablesglobales',  '_sonata_name' => 'admin_pqrs_variablesglobales_export',  '_route' => 'admin_pqrs_variablesglobales_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/pqrs/c')) {
                        if (0 === strpos($pathinfo, '/admin/pqrs/copias')) {
                            // admin_pqrs_copias_list
                            if ($pathinfo === '/admin/pqrs/copias/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.copias',  '_sonata_name' => 'admin_pqrs_copias_list',  '_route' => 'admin_pqrs_copias_list',);
                            }

                            // admin_pqrs_copias_create
                            if ($pathinfo === '/admin/pqrs/copias/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.copias',  '_sonata_name' => 'admin_pqrs_copias_create',  '_route' => 'admin_pqrs_copias_create',);
                            }

                            // admin_pqrs_copias_batch
                            if ($pathinfo === '/admin/pqrs/copias/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.copias',  '_sonata_name' => 'admin_pqrs_copias_batch',  '_route' => 'admin_pqrs_copias_batch',);
                            }

                            // admin_pqrs_copias_edit
                            if (preg_match('#^/admin/pqrs/copias/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_copias_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.copias',  '_sonata_name' => 'admin_pqrs_copias_edit',));
                            }

                            // admin_pqrs_copias_delete
                            if (preg_match('#^/admin/pqrs/copias/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_copias_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.copias',  '_sonata_name' => 'admin_pqrs_copias_delete',));
                            }

                            // admin_pqrs_copias_show
                            if (preg_match('#^/admin/pqrs/copias/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_copias_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.copias',  '_sonata_name' => 'admin_pqrs_copias_show',));
                            }

                            // admin_pqrs_copias_export
                            if ($pathinfo === '/admin/pqrs/copias/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.copias',  '_sonata_name' => 'admin_pqrs_copias_export',  '_route' => 'admin_pqrs_copias_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/pqrs/causas')) {
                            // admin_pqrs_causas_list
                            if ($pathinfo === '/admin/pqrs/causas/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.causas',  '_sonata_name' => 'admin_pqrs_causas_list',  '_route' => 'admin_pqrs_causas_list',);
                            }

                            // admin_pqrs_causas_create
                            if ($pathinfo === '/admin/pqrs/causas/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.causas',  '_sonata_name' => 'admin_pqrs_causas_create',  '_route' => 'admin_pqrs_causas_create',);
                            }

                            // admin_pqrs_causas_batch
                            if ($pathinfo === '/admin/pqrs/causas/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.causas',  '_sonata_name' => 'admin_pqrs_causas_batch',  '_route' => 'admin_pqrs_causas_batch',);
                            }

                            // admin_pqrs_causas_edit
                            if (preg_match('#^/admin/pqrs/causas/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_causas_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.causas',  '_sonata_name' => 'admin_pqrs_causas_edit',));
                            }

                            // admin_pqrs_causas_delete
                            if (preg_match('#^/admin/pqrs/causas/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_causas_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.causas',  '_sonata_name' => 'admin_pqrs_causas_delete',));
                            }

                            // admin_pqrs_causas_show
                            if (preg_match('#^/admin/pqrs/causas/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_causas_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.causas',  '_sonata_name' => 'admin_pqrs_causas_show',));
                            }

                            // admin_pqrs_causas_export
                            if ($pathinfo === '/admin/pqrs/causas/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.causas',  '_sonata_name' => 'admin_pqrs_causas_export',  '_route' => 'admin_pqrs_causas_export',);
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/pqrs/multiplex')) {
                        // admin_pqrs_multiplex_list
                        if ($pathinfo === '/admin/pqrs/multiplex/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.multiplex',  '_sonata_name' => 'admin_pqrs_multiplex_list',  '_route' => 'admin_pqrs_multiplex_list',);
                        }

                        // admin_pqrs_multiplex_create
                        if ($pathinfo === '/admin/pqrs/multiplex/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.multiplex',  '_sonata_name' => 'admin_pqrs_multiplex_create',  '_route' => 'admin_pqrs_multiplex_create',);
                        }

                        // admin_pqrs_multiplex_batch
                        if ($pathinfo === '/admin/pqrs/multiplex/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.multiplex',  '_sonata_name' => 'admin_pqrs_multiplex_batch',  '_route' => 'admin_pqrs_multiplex_batch',);
                        }

                        // admin_pqrs_multiplex_edit
                        if (preg_match('#^/admin/pqrs/multiplex/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_multiplex_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.multiplex',  '_sonata_name' => 'admin_pqrs_multiplex_edit',));
                        }

                        // admin_pqrs_multiplex_delete
                        if (preg_match('#^/admin/pqrs/multiplex/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_multiplex_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.multiplex',  '_sonata_name' => 'admin_pqrs_multiplex_delete',));
                        }

                        // admin_pqrs_multiplex_show
                        if (preg_match('#^/admin/pqrs/multiplex/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pqrs_multiplex_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.multiplex',  '_sonata_name' => 'admin_pqrs_multiplex_show',));
                        }

                        // admin_pqrs_multiplex_export
                        if ($pathinfo === '/admin/pqrs/multiplex/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.multiplex',  '_sonata_name' => 'admin_pqrs_multiplex_export',  '_route' => 'admin_pqrs_multiplex_export',);
                        }

                    }

                }

                // logout
                if ($pathinfo === '/admin/logout') {
                    return array('_route' => 'logout');
                }

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
