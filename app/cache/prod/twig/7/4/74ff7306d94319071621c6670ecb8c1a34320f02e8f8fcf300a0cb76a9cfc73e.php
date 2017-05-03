<?php

/* PqrsBundle::base.html.twig */
class __TwigTemplate_74ff7306d94319071621c6670ecb8c1a34320f02e8f8fcf300a0cb76a9cfc73e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />";
        // line 8
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 34
        echo "</head>
    <body>
        <!-- Fixed navbar -->
        <div id=\"head-nav\" class=\"navbar navbar-default navbar-fixed-top\">
            <div class=\"container-fluid\">
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                        <span class=\"fa fa-gear\"></span>
                    </button>
                    <a class=\"navbar-brand\" href=\"#\"><span>Sistema de resportes y PQRS</span></a>
                </div>
            </div>
        </div>
        <div id=\"cl-wrapper\" class=\"fixed-menu\">
            <div class=\"cl-sidebar\" data-position=\"right\" data-step=\"1\" data-intro=\"<strong>Fixed Sidebar</strong> <br/> It adjust to your needs.\" >
                <div class=\"cl-toggle\"><i class=\"fa fa-bars\"></i></div>
                <div class=\"cl-navblock\">
                    <div class=\"menu-space\">
                        <div class=\"content\">
                            <!--<div class=\"side-user\">
                                <div class=\"avatar\"><img src=\"images/avatar1_50.jpg\" alt=\"Avatar\" /></div>
                                <div class=\"info\">
                                    <a href=\"#\">Jeff Hanneman</a>
                                    <img src=\"images/state_online.png\" alt=\"Status\" /> <span>Online</span>
                                </div>
                            </div>-->
                            <ul class=\"cl-vnavigation\">
                                <li><a href=\"#\"><i class=\"fa fa-home\"></i><span>PQRS</span></a>
                                    <ul class=\"sub-menu\">
                                        ";
        // line 63
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "tokens"), "method")) {
            // line 64
            echo "                                            ";
            if (twig_in_filter("LEER", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "tokens"), "method"), "permisos_nombres", array()))) {
                // line 65
                echo "                                                <li class=\"active\" id=\"menu_admin_listado\"><a href=\"/\">Listado</a></li>
                                            ";
            }
            // line 67
            echo "                                            ";
            if (((twig_in_filter("CONSULTAR", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "tokens"), "method"), "permisos_nombres", array())) || twig_in_filter("ADMIN", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "tokens"), "method"), "roles", array()))) || twig_in_filter(1, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "tokens"), "method"), "areas", array())))) {
                // line 68
                echo "                                                <li class=\"\" id=\"menu_admin_reportes\">
                                                    <a onclick=\"mostrar_reportes('listado_reportes');\" href=\"javascript:void(0);\">Reportes</a>
                                                    <div id=\"listado_reportes\" class=\"reportes_oculto\" style=\"display:none\">
                                                        ";
                // line 71
                if ((twig_in_filter("ADMIN", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "tokens"), "method"), "roles", array())) || twig_in_filter(1, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "tokens"), "method"), "areas", array())))) {
                    // line 72
                    echo "                                                            <span id=\"menu_admin_pqrs\" class=\"\"><a href=\"/reporte-pqrs\">Reporte PQRS</a></span>
                                                            <span id=\"menu_admin_pqrs_respuestas\" class=\"\"><a href=\"/reporte-pqrs-respuestas\">Reporte PQRS Respuestas</a></span>
                                                        ";
                }
                // line 75
                echo "                                                        ";
                if (twig_in_filter("CONSULTAR", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "tokens"), "method"), "permisos_nombres", array()))) {
                    echo "                                                            
                                                            <span id=\"menu_admin_ventas\" class=\"\"><a href=\"/reporte-ventas-diarias\">Reporte Ventas Diarias</a></span>
                                                            <span id=\"menu_admin_consolidado\" class=\"\"><a href=\"/reporte-consolidado-banco\">Reporte Consolidado Bancos</a></span>
                                                            <span id=\"menu_admin_transacciones\" class=\"\"><a href=\"/reporte-transacciones-banco\">Reporte Transacciones Banco</a></span>
                                                            <span id=\"menu_admin_devoluciones\" class=\"\"><a href=\"/reporte-transacciones-devoluciones\">Reporte Transacciones Reversiones</a></span>
                                                            <span id=\"menu_admin_cierre\" class=\"\"><a href=\"/cierre-fecha\">Cierre de fecha</a></span>
                                                        ";
                }
                // line 82
                echo "                                                    </div>  
                                                </li>
                                            ";
            }
            // line 85
            echo "                                                <li>
                                                    <li class=\"active\" id=\"menu_admin_listado\"><a href=\"/cambio-clave\">Cambio de contraseña</a></li>
                                                </li>
                                        ";
        }
        // line 89
        echo "                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class=\"text-right collapse-button\" style=\"padding:7px 9px;\">
                        ";
        // line 95
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "name"), "method")) {
            // line 96
            echo "                            <div class=\"bienvenido\">
                                <span>Bienvenido</span>
                                <p>";
            // line 98
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "name"), "method"), "html", null, true);
            echo "</p>
                                <a href=\"";
            // line 99
            echo $this->env->getExtension('routing')->getPath("logout_sesion");
            echo "\">Cerrar Sesión </a>
                            </div>
                        ";
        }
        // line 102
        echo "                    </div>
                </div>
            </div>
            <div class=\"container-fluid\" id=\"pcont\">
                <div class=\"cl-mcont\">
                ";
        // line 107
        $this->displayBlock('body', $context, $blocks);
        // line 108
        echo "            </div>
        </div>
    </div>
    <footer>footer</footer>
        ";
        // line 112
        $this->displayBlock('javascripts', $context, $blocks);
        // line 136
        echo "</body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 8
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 9
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "f907f5b_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_0") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_part_1_bootstrap-theme.min_1.css");
            // line 26
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_1") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_part_1_bootstrap_2.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_2") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_part_1_bootstrap.min_3.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_3") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_style_2.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_4") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_bootstrap_3.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_5"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_5") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_font-awesome.min_4.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_6"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_6") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_jquery.gritter_5.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_7"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_7") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_nanoscroller_6.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_8"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_8") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_jquery.easy-pie-chart_7.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_9"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_9") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_bootstrap-switch_8.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_10"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_10") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_bootstrap-datetimepicker.min_9.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_11"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_11") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_select2_10.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_12"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_12") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_slider_11.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_13"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_13") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_introjs_12.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
            // asset "f907f5b_14"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b_14") : $this->env->getExtension('assets')->getAssetUrl("compiled/all_daterangepicker-bs3_13.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
        } else {
            // asset "f907f5b"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f907f5b") : $this->env->getExtension('assets')->getAssetUrl("compiled/all.css");
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />";
        }
        unset($context["asset_url"]);
        // line 28
        echo "<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'";
    }

    // line 107
    public function block_body($context, array $blocks = array())
    {
    }

    // line 112
    public function block_javascripts($context, array $blocks = array())
    {
        // line 113
        echo "        <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.gritter/js/jquery.gritter.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 115
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.nanoscroller/jquery.nanoscroller.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 116
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/behaviour/general.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 117
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.ui/jquery-ui.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 118
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.nestable/jquery.nestable.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap.switch/bootstrap-switch.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 120
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.select2/select2.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/skycons/skycons.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 123
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap.slider/js/bootstrap-slider.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 124
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/date/moment.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/date/daterangepicker.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 126
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/custom.js?qwert54321"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script type=\"text/javascript\">
            \$(document).ready(function () {
                //initialize the javascript
                App.init();
            });
        </script>
        <script src=\"";
        // line 133
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-2.1.3.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 134
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap/dist/js/bootstrap.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    ";
    }

    public function getTemplateName()
    {
        return "PqrsBundle::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  338 => 134,  334 => 133,  324 => 126,  320 => 125,  316 => 124,  312 => 123,  308 => 122,  304 => 121,  300 => 120,  296 => 119,  292 => 118,  288 => 117,  284 => 116,  280 => 115,  276 => 114,  271 => 113,  268 => 112,  263 => 107,  257 => 28,  175 => 26,  171 => 9,  168 => 8,  162 => 5,  156 => 136,  154 => 112,  148 => 108,  146 => 107,  139 => 102,  133 => 99,  129 => 98,  125 => 96,  123 => 95,  115 => 89,  109 => 85,  104 => 82,  93 => 75,  88 => 72,  86 => 71,  81 => 68,  78 => 67,  74 => 65,  71 => 64,  69 => 63,  38 => 34,  36 => 8,  33 => 6,  29 => 5,  23 => 1,);
    }
}
