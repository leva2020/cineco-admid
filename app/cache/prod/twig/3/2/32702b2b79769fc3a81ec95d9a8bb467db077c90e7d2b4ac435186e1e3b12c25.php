<?php

/* PqrsBundle:Reportes:ventas-diarias.html.twig */
class __TwigTemplate_32702b2b79769fc3a81ec95d9a8bb467db077c90e7d2b4ac435186e1e3b12c25 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("PqrsBundle::base.html.twig", "PqrsBundle:Reportes:ventas-diarias.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "PqrsBundle::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo "Reportes Ventas Diarias";
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"reportes-pqrs ventas\">
        <legend>Reportes Ventas Diarias</legend>
        ";
        // line 6
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : null), 'form');
        echo "

        <div class=\"boton-exportar\">
            ";
        // line 9
        if (twig_in_filter("EXPORTAR", (isset($context["permisos"]) ? $context["permisos"] : null))) {
            // line 10
            echo "                <a class=\"pull-right btn\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("reporte_archivo_ventas_diarias", array("filtros" => (isset($context["filtros"]) ? $context["filtros"] : null))), "html", null, true);
            echo "\">Exportar</a>
            ";
        }
        // line 12
        echo "        </div>
        <table class=\"table table-hover\">
            <tr>
                ";
        // line 15
        if (((isset($context["consolidado"]) ? $context["consolidado"] : null) == false)) {
            // line 16
            echo "                    <td>Nombre Teatro</td>
                ";
        }
        // line 18
        echo "                <td>Entidad financiera</td>
                <td>Localidad</td>
                <td>Tipo transacción</td>
                <td>Total transacciones</td>
                <td>Número de boletas</td>
                <td>Total ingresos cargos suplementarios</td>
                <td>Total ingreso boletas</td>
                <td>Total ingreso exhibición</td>
            </tr>
            ";
        // line 27
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lista_mult"]) ? $context["lista_mult"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["mult"]) {
            // line 28
            echo "                ";
            if (twig_in_filter($context["mult"], twig_get_array_keys_filter((isset($context["reporte"]) ? $context["reporte"] : null)))) {
                // line 29
                echo "                    <div id=\"ran_";
                echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                echo "\">
                        ";
                // line 30
                if (((isset($context["consolidado"]) ? $context["consolidado"] : null) == false)) {
                    // line 31
                    echo "                            <tr>
                                <td>
                                    <a onclick=\"desplega_dato('metodo_";
                    // line 33
                    echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                    echo "', ";
                    echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                    echo ");\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "info", array(), "array"), "multiplex", array()), "html", null, true);
                    echo "</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>";
                    // line 38
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "info", array(), "array"), "totales", array(), "array"), "total_tran", array(), "array"), "html", null, true);
                    echo "</td>
                                <td>";
                    // line 39
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "info", array(), "array"), "totales", array(), "array"), "no_boletas", array(), "array"), "html", null, true);
                    echo "</td>
                                <td>";
                    // line 40
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "info", array(), "array"), "totales", array(), "array"), "ingresos_suple", array(), "array"), "html", null, true);
                    echo "</td>
                                <td>";
                    // line 41
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "info", array(), "array"), "totales", array(), "array"), "total_ingreso_boletas", array(), "array"), "html", null, true);
                    echo " </td>
                                <td>";
                    // line 42
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "info", array(), "array"), "totales", array(), "array"), "total_ingre", array(), "array"), "html", null, true);
                    echo "</td>
                            </tr>                            
                        ";
                }
                // line 45
                echo "                        ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["listado_ids_entidades"]) ? $context["listado_ids_entidades"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["list_entidades"]) {
                    // line 46
                    echo "                            ";
                    // line 47
                    echo "                            ";
                    if (twig_in_filter($context["list_entidades"], twig_get_array_keys_filter($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "det", array(), "array")))) {
                        // line 48
                        echo "                                ";
                        // line 49
                        echo "                                <tr style=\"display:";
                        echo twig_escape_filter($this->env, (isset($context["estado_consolidado"]) ? $context["estado_consolidado"] : null), "html", null, true);
                        echo "\" class=\"nivel_0_";
                        echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                        echo " metodo_";
                        echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                        echo "\">
                                    ";
                        // line 50
                        if (((isset($context["consolidado"]) ? $context["consolidado"] : null) == false)) {
                            // line 51
                            echo "                                        <td></td>
                                    ";
                        }
                        // line 52
                        echo " 
                                    <td>
                                        <a onclick=\"desplega_dato('entidad_";
                        // line 54
                        echo twig_escape_filter($this->env, $context["list_entidades"], "html", null, true);
                        echo "_";
                        echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                        echo "', ";
                        echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                        echo ");\">
                                            ";
                        // line 55
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "det", array(), "array"), $context["list_entidades"], array(), "array"), "entidad", array()), "html", null, true);
                        echo "
                                        </a>
                                    </td>
                                    <td></td><td></td>
                                    ";
                        // line 59
                        if (((isset($context["consolidado"]) ? $context["consolidado"] : null) == false)) {
                            // line 60
                            echo "                                        <td></td><td></td><td></td><td></td><td></td>
                                    ";
                        } else {
                            // line 62
                            echo "                                        <td>";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), $context["list_entidades"], array(), "array"), "info_consolidado", array(), "array"), "totales", array(), "array"), "total_tran", array(), "array"), "html", null, true);
                            echo "</td>
                                        <td>";
                            // line 63
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), $context["list_entidades"], array(), "array"), "info_consolidado", array(), "array"), "totales", array(), "array"), "no_boletas", array(), "array"), "html", null, true);
                            echo "</td>
                                        <td>";
                            // line 64
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), $context["list_entidades"], array(), "array"), "info_consolidado", array(), "array"), "totales", array(), "array"), "ingresos_suple", array(), "array"), "html", null, true);
                            echo "</td>
                                        <td>";
                            // line 65
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), $context["list_entidades"], array(), "array"), "info_consolidado", array(), "array"), "totales", array(), "array"), "total_ingreso_boletas", array(), "array"), "html", null, true);
                            echo " </td>
                                        <td>";
                            // line 66
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), $context["list_entidades"], array(), "array"), "info_consolidado", array(), "array"), "totales", array(), "array"), "total_ingre", array(), "array"), "html", null, true);
                            echo "</td>
                                    ";
                        }
                        // line 67
                        echo "                                    
                                </tr>
                                ";
                        // line 69
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["listado_localidades"]) ? $context["listado_localidades"] : null));
                        foreach ($context['_seq'] as $context["_key"] => $context["list_localidad"]) {
                            // line 70
                            echo "                                    ";
                            if (twig_in_filter($context["list_localidad"], twig_get_array_keys_filter($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "det", array(), "array"), $context["list_entidades"], array(), "array")))) {
                                // line 71
                                echo "                                        
                                        
                                        <tr style=\"display:none\" class=\"nivel_1_";
                                // line 73
                                echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                echo " entidad_";
                                echo twig_escape_filter($this->env, $context["list_entidades"], "html", null, true);
                                echo "_";
                                echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                echo "\">
                                            ";
                                // line 74
                                if (((isset($context["consolidado"]) ? $context["consolidado"] : null) == false)) {
                                    // line 75
                                    echo "                                                <td></td>
                                            ";
                                }
                                // line 77
                                echo "                                            <td></td>
                                            <td><a onclick=\"desplega_dato('localidad_";
                                // line 78
                                echo twig_escape_filter($this->env, $context["list_localidad"], "html", null, true);
                                echo "_";
                                echo twig_escape_filter($this->env, $context["list_entidades"], "html", null, true);
                                echo "_";
                                echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                echo "', ";
                                echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                echo ");\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "det", array(), "array"), $context["list_entidades"], array(), "array"), $context["list_localidad"], array(), "array"), "localidad", array()), "html", null, true);
                                echo "</a></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                        </tr>
                                        ";
                                // line 81
                                $context['_parent'] = (array) $context;
                                $context['_seq'] = twig_ensure_traversable((isset($context["listado_tipo_compra"]) ? $context["listado_tipo_compra"] : null));
                                foreach ($context['_seq'] as $context["_key"] => $context["list_compra"]) {
                                    // line 82
                                    echo "                                            ";
                                    if (twig_in_filter($context["list_compra"], twig_get_array_keys_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "det", array(), "array"), $context["list_entidades"], array(), "array"), $context["list_localidad"], array(), "array")))) {
                                        echo "                                                
                                                ";
                                        // line 83
                                        $context["det_total_tran"] = "0";
                                        // line 84
                                        echo "                                                ";
                                        $context["det_total_boletas"] = "0";
                                        // line 85
                                        echo "                                                ";
                                        $context["det_sup"] = "0";
                                        // line 86
                                        echo "                                                ";
                                        $context["det_boletas"] = "0";
                                        // line 87
                                        echo "                                                ";
                                        $context["det_exhi"] = "0";
                                        // line 88
                                        echo "                                                ";
                                        $context['_parent'] = (array) $context;
                                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "det", array(), "array"), $context["list_entidades"], array(), "array"), $context["list_localidad"], array(), "array"), $context["list_compra"], array(), "array"));
                                        foreach ($context['_seq'] as $context["_key"] => $context["detalle"]) {
                                            // line 89
                                            echo "                                                    ";
                                            $context["det_total_tran"] = ((isset($context["det_total_tran"]) ? $context["det_total_tran"] : null) + $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "total_tran", array()));
                                            // line 90
                                            echo "                                                    ";
                                            $context["det_total_boletas"] = ((isset($context["det_total_boletas"]) ? $context["det_total_boletas"] : null) + $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "no_boletas", array()));
                                            // line 91
                                            echo "                                                    ";
                                            $context["det_sup"] = ((isset($context["det_sup"]) ? $context["det_sup"] : null) + $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "ingresos_suple_sin", array()));
                                            // line 92
                                            echo "                                                    ";
                                            $context["det_boletas"] = ((isset($context["det_boletas"]) ? $context["det_boletas"] : null) + $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "ingreso_boletas_sin", array()));
                                            // line 93
                                            echo "                                                    ";
                                            $context["det_exhi"] = ((isset($context["det_exhi"]) ? $context["det_exhi"] : null) + $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "total_ingre_sin", array()));
                                            // line 94
                                            echo "                                                ";
                                        }
                                        $_parent = $context['_parent'];
                                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detalle'], $context['_parent'], $context['loop']);
                                        $context = array_intersect_key($context, $_parent) + $_parent;
                                        // line 95
                                        echo "
                                                <tr style=\"display:none\" class=\"nivel_2_";
                                        // line 96
                                        echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                        echo " localidad_";
                                        echo twig_escape_filter($this->env, $context["list_localidad"], "html", null, true);
                                        echo "_";
                                        echo twig_escape_filter($this->env, $context["list_entidades"], "html", null, true);
                                        echo "_";
                                        echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                        echo "\">
                                                    ";
                                        // line 97
                                        if (((isset($context["consolidado"]) ? $context["consolidado"] : null) == false)) {
                                            // line 98
                                            echo "                                                        <td></td>
                                                    ";
                                        }
                                        // line 100
                                        echo "                                                    <td></td>
                                                    <td></td>                                                
                                                    ";
                                        // line 102
                                        if (($context["list_compra"] == 1)) {
                                            // line 103
                                            echo "                                                        <td>
                                                            <a href=\"javascript:void(0);\" onclick=\"desplega_dato('compra_";
                                            // line 104
                                            echo twig_escape_filter($this->env, $context["list_localidad"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["list_entidades"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["list_compra"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                            echo "', ";
                                            echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                            echo ");\">Compra</a>
                                                        </td>
                                                    ";
                                        } elseif ((                                        // line 106
$context["list_compra"] == 2)) {
                                            // line 107
                                            echo "                                                        <td>
                                                            <a href=\"javascript:void(0);\" onclick=\"desplega_dato('compra_";
                                            // line 108
                                            echo twig_escape_filter($this->env, $context["list_localidad"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["list_entidades"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["list_compra"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                            echo "', ";
                                            echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                            echo ");\">Reserva</a>
                                                        </td>
                                                    ";
                                        }
                                        // line 111
                                        echo "                                                    <td>";
                                        echo twig_escape_filter($this->env, (isset($context["det_total_tran"]) ? $context["det_total_tran"] : null), "html", null, true);
                                        echo "</td>
                                                    <td>";
                                        // line 112
                                        echo twig_escape_filter($this->env, (isset($context["det_total_boletas"]) ? $context["det_total_boletas"] : null), "html", null, true);
                                        echo "</td>
                                                    <td>";
                                        // line 113
                                        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["det_sup"]) ? $context["det_sup"] : null), 2, ".", ","), "html", null, true);
                                        echo "</td>
                                                    <td>";
                                        // line 114
                                        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["det_boletas"]) ? $context["det_boletas"] : null), 2, ".", ","), "html", null, true);
                                        echo "</td>
                                                    <td>";
                                        // line 115
                                        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["det_exhi"]) ? $context["det_exhi"] : null), 2, ".", ","), "html", null, true);
                                        echo "</td>
                                                </tr>
                                                ";
                                        // line 117
                                        $context['_parent'] = (array) $context;
                                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["reporte"]) ? $context["reporte"] : null), $context["mult"], array(), "array"), "det", array(), "array"), $context["list_entidades"], array(), "array"), $context["list_localidad"], array(), "array"), $context["list_compra"], array(), "array"));
                                        foreach ($context['_seq'] as $context["_key"] => $context["detalle"]) {
                                            // line 118
                                            echo "                                                    <tr style=\"display:none\" class=\"nivel_3_";
                                            echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                            echo " compra_";
                                            echo twig_escape_filter($this->env, $context["list_localidad"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["list_entidades"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["list_compra"], "html", null, true);
                                            echo "_";
                                            echo twig_escape_filter($this->env, $context["mult"], "html", null, true);
                                            echo "\">
                                                        ";
                                            // line 119
                                            if (((isset($context["consolidado"]) ? $context["consolidado"] : null) == false)) {
                                                // line 120
                                                echo "                                                            <td></td>
                                                        ";
                                            }
                                            // line 122
                                            echo "                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>";
                                            // line 125
                                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "total_tran", array()), "html", null, true);
                                            echo "</td>
                                                        <td>";
                                            // line 126
                                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "no_boletas", array()), "html", null, true);
                                            echo "</td>
                                                        <td>";
                                            // line 127
                                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "ingresos_suple", array()), "html", null, true);
                                            echo "</td>
                                                        <td>";
                                            // line 128
                                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "ingreso_boletas", array()), "html", null, true);
                                            echo "</td>
                                                        <td>";
                                            // line 129
                                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detalle"], "detalle", array()), "total_ingre", array()), "html", null, true);
                                            echo "</td>                                                
                                                    </tr>
                                                ";
                                        }
                                        $_parent = $context['_parent'];
                                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detalle'], $context['_parent'], $context['loop']);
                                        $context = array_intersect_key($context, $_parent) + $_parent;
                                        // line 132
                                        echo "                                            ";
                                    }
                                    // line 133
                                    echo "                                        ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['list_compra'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 134
                                echo "                                    ";
                            }
                            // line 135
                            echo "                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['list_localidad'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 136
                        echo "                            ";
                    }
                    // line 137
                    echo "                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['list_entidades'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 138
                echo "                    </div> 
                ";
            }
            // line 140
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mult'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " 
        </table>
    </div>
    ";
        // line 143
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashbag", array()), "get", array(0 => "error"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 144
            echo "        <div style=\"position: relative; padding-top: 50px;\" class=\"flash-notice\">
            ";
            // line 145
            echo twig_escape_filter($this->env, $context["flashMessage"], "html", null, true);
            echo "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "PqrsBundle:Reportes:ventas-diarias.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  482 => 145,  479 => 144,  475 => 143,  465 => 140,  461 => 138,  455 => 137,  452 => 136,  446 => 135,  443 => 134,  437 => 133,  434 => 132,  425 => 129,  421 => 128,  417 => 127,  413 => 126,  409 => 125,  404 => 122,  400 => 120,  398 => 119,  385 => 118,  381 => 117,  376 => 115,  372 => 114,  368 => 113,  364 => 112,  359 => 111,  345 => 108,  342 => 107,  340 => 106,  327 => 104,  324 => 103,  322 => 102,  318 => 100,  314 => 98,  312 => 97,  302 => 96,  299 => 95,  293 => 94,  290 => 93,  287 => 92,  284 => 91,  281 => 90,  278 => 89,  273 => 88,  270 => 87,  267 => 86,  264 => 85,  261 => 84,  259 => 83,  254 => 82,  250 => 81,  236 => 78,  233 => 77,  229 => 75,  227 => 74,  219 => 73,  215 => 71,  212 => 70,  208 => 69,  204 => 67,  199 => 66,  195 => 65,  191 => 64,  187 => 63,  182 => 62,  178 => 60,  176 => 59,  169 => 55,  161 => 54,  157 => 52,  153 => 51,  151 => 50,  142 => 49,  140 => 48,  137 => 47,  135 => 46,  130 => 45,  124 => 42,  120 => 41,  116 => 40,  112 => 39,  108 => 38,  96 => 33,  92 => 31,  90 => 30,  85 => 29,  82 => 28,  78 => 27,  67 => 18,  63 => 16,  61 => 15,  56 => 12,  50 => 10,  48 => 9,  42 => 6,  38 => 4,  35 => 3,  29 => 2,  11 => 1,);
    }
}
