<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/compiled/all')) {
            // _assetic_f907f5b
            if ($pathinfo === '/compiled/all.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_f907f5b',);
            }

            if (0 === strpos($pathinfo, '/compiled/all_')) {
                if (0 === strpos($pathinfo, '/compiled/all_part_1_bootstrap')) {
                    // _assetic_f907f5b_0
                    if ($pathinfo === '/compiled/all_part_1_bootstrap-theme.min_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_f907f5b_0',);
                    }

                    // _assetic_f907f5b_1
                    if ($pathinfo === '/compiled/all_part_1_bootstrap_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_f907f5b_1',);
                    }

                    // _assetic_f907f5b_2
                    if ($pathinfo === '/compiled/all_part_1_bootstrap.min_3.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 2,  '_format' => 'css',  '_route' => '_assetic_f907f5b_2',);
                    }

                }

                // _assetic_f907f5b_3
                if ($pathinfo === '/compiled/all_style_2.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 3,  '_format' => 'css',  '_route' => '_assetic_f907f5b_3',);
                }

                // _assetic_f907f5b_4
                if ($pathinfo === '/compiled/all_bootstrap_3.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 4,  '_format' => 'css',  '_route' => '_assetic_f907f5b_4',);
                }

                // _assetic_f907f5b_5
                if ($pathinfo === '/compiled/all_font-awesome.min_4.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 5,  '_format' => 'css',  '_route' => '_assetic_f907f5b_5',);
                }

                // _assetic_f907f5b_6
                if ($pathinfo === '/compiled/all_jquery.gritter_5.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 6,  '_format' => 'css',  '_route' => '_assetic_f907f5b_6',);
                }

                // _assetic_f907f5b_7
                if ($pathinfo === '/compiled/all_nanoscroller_6.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 7,  '_format' => 'css',  '_route' => '_assetic_f907f5b_7',);
                }

                // _assetic_f907f5b_8
                if ($pathinfo === '/compiled/all_jquery.easy-pie-chart_7.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 8,  '_format' => 'css',  '_route' => '_assetic_f907f5b_8',);
                }

                if (0 === strpos($pathinfo, '/compiled/all_bootstrap-')) {
                    // _assetic_f907f5b_9
                    if ($pathinfo === '/compiled/all_bootstrap-switch_8.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 9,  '_format' => 'css',  '_route' => '_assetic_f907f5b_9',);
                    }

                    // _assetic_f907f5b_10
                    if ($pathinfo === '/compiled/all_bootstrap-datetimepicker.min_9.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 10,  '_format' => 'css',  '_route' => '_assetic_f907f5b_10',);
                    }

                }

                if (0 === strpos($pathinfo, '/compiled/all_s')) {
                    // _assetic_f907f5b_11
                    if ($pathinfo === '/compiled/all_select2_10.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 11,  '_format' => 'css',  '_route' => '_assetic_f907f5b_11',);
                    }

                    // _assetic_f907f5b_12
                    if ($pathinfo === '/compiled/all_slider_11.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 12,  '_format' => 'css',  '_route' => '_assetic_f907f5b_12',);
                    }

                }

                // _assetic_f907f5b_13
                if ($pathinfo === '/compiled/all_introjs_12.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 13,  '_format' => 'css',  '_route' => '_assetic_f907f5b_13',);
                }

                // _assetic_f907f5b_14
                if ($pathinfo === '/compiled/all_daterangepicker-bs3_13.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f907f5b',  'pos' => 14,  '_format' => 'css',  '_route' => '_assetic_f907f5b_14',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

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

        // _welcome
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_welcome');
            }

            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\WelcomeController::indexAction',  '_route' => '_welcome',);
        }

        if (0 === strpos($pathinfo, '/demo')) {
            if (0 === strpos($pathinfo, '/demo/secured')) {
                if (0 === strpos($pathinfo, '/demo/secured/log')) {
                    if (0 === strpos($pathinfo, '/demo/secured/login')) {
                        // _demo_login
                        if ($pathinfo === '/demo/secured/login') {
                            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::loginAction',  '_route' => '_demo_login',);
                        }

                        // _demo_security_check
                        if ($pathinfo === '/demo/secured/login_check') {
                            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::securityCheckAction',  '_route' => '_demo_security_check',);
                        }

                    }

                    // _demo_logout
                    if ($pathinfo === '/demo/secured/logout') {
                        return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::logoutAction',  '_route' => '_demo_logout',);
                    }

                }

                if (0 === strpos($pathinfo, '/demo/secured/hello')) {
                    // acme_demo_secured_hello
                    if ($pathinfo === '/demo/secured/hello') {
                        return array (  'name' => 'World',  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',  '_route' => 'acme_demo_secured_hello',);
                    }

                    // _demo_secured_hello
                    if (preg_match('#^/demo/secured/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_secured_hello')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',));
                    }

                    // _demo_secured_hello_admin
                    if (0 === strpos($pathinfo, '/demo/secured/hello/admin') && preg_match('#^/demo/secured/hello/admin/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_secured_hello_admin')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloadminAction',));
                    }

                }

            }

            // _demo
            if (rtrim($pathinfo, '/') === '/demo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_demo');
                }

                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::indexAction',  '_route' => '_demo',);
            }

            // _demo_hello
            if (0 === strpos($pathinfo, '/demo/hello') && preg_match('#^/demo/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_hello')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::helloAction',));
            }

            // _demo_contact
            if ($pathinfo === '/demo/contact') {
                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::contactAction',  '_route' => '_demo_contact',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
