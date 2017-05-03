<?php

/* PqrsBundle:DetallePqrs:index.html.twig */
class __TwigTemplate_8519bf2491422d24a6b0678081d273ab49040faab545426063f407803943817b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("PqrsBundle::base.html.twig", "PqrsBundle:DetallePqrs:index.html.twig", 1);
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
        echo "Detalle pqrs ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "id", array()), "html", null, true);
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "    <div class=\"titulos\">
        <h1>Detalle pqrs ";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "id", array()), "html", null, true);
        echo "</h1>
    </div>\t\t\t\t\t
    <div class=\"detalle-pqrs\">
        <table class=\"table table-hover\">

            <tr>
                <td>Tipo:</td><td>";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["tipo_comunicacion"]) ? $context["tipo_comunicacion"] : null), "html", null, true);
        echo "</td>
                <td>Fecha Creación: </td><td>";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["fecha_registro"]) ? $context["fecha_registro"] : null), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <td>Area asignada: </td><td>";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["area"]) ? $context["area"] : null), "html", null, true);
        echo "</td>
                <td>Fecha Modificación:</td><td> ";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["fecha_modificacion"]) ? $context["fecha_modificacion"] : null), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <td>Estado: </td><td>";
        // line 20
        echo twig_escape_filter($this->env, (isset($context["estado"]) ? $context["estado"] : null), "html", null, true);
        echo "</td>
                <td>Fecha suceso: </td><td>";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["fecha_hora"]) ? $context["fecha_hora"] : null), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <td>Nombre:</td><td> ";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "nombreusuario", array()), "html", null, true);
        echo "</td>
                <td>Pelicula:</td><td> ";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "pelicula", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <td>Correo: </td><td>";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "correo", array()), "html", null, true);
        echo "</td>
                <td>Multiplex: </td><td>";
        // line 29
        echo twig_escape_filter($this->env, (isset($context["multiplex"]) ? $context["multiplex"] : null), "html", null, true);
        echo " </td>
            </tr>
            <tr>
                <td>Documento: </td><td>";
        // line 32
        if ($this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "documentousuario", array())) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "documentousuario", array()), "html", null, true);
        }
        echo "</td>
                <td>Areas de referencia:</td><td>
                    ";
        // line 34
        if ((isset($context["areas_referencia"]) ? $context["areas_referencia"] : null)) {
            echo "                    
                        ";
            // line 35
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["areas_referencia"]) ? $context["areas_referencia"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ar"]) {
                // line 36
                echo "                            ";
                echo twig_escape_filter($this->env, $context["ar"], "html", null, true);
                echo ",
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ar'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "                    ";
        }
        // line 39
        echo "                </td>
            </tr>
            <tr>
                <td>Teléfono: </td><td>";
        // line 42
        if ($this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "telefono", array())) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "telefono", array()), "html", null, true);
            echo " ";
        }
        echo "</td>
                <td>Ciudad: </td><td>";
        // line 43
        echo twig_escape_filter($this->env, (isset($context["ciudad"]) ? $context["ciudad"] : null), "html", null, true);
        echo " </td>
            </tr>
            ";
        // line 45
        if ((isset($context["causas"]) ? $context["causas"] : null)) {
            // line 46
            echo "                <tr>
                    <td>
                        Causa final: </td><td>";
            // line 48
            echo twig_escape_filter($this->env, (isset($context["causas"]) ? $context["causas"] : null), "html", null, true);
            echo "
                    </td>
                </tr>
            ";
        }
        // line 51
        echo "                
        </table>

        ";
        // line 54
        if ((isset($context["adjuntos"]) ? $context["adjuntos"] : null)) {
            // line 55
            echo "            <div class=\"motivp-pqrs\"><span>Archivos Adjuntos:</span>
                ";
            // line 56
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["adjuntos"]) ? $context["adjuntos"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ad"]) {
                // line 57
                echo "                    <p><a target=\"_blank\" href=\"";
                echo twig_escape_filter($this->env, $context["ad"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["ad"], "html", null, true);
                echo "</a></p>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ad'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 59
            echo "            </div>
        ";
        }
        // line 61
        echo "        <div class=\"motivp-pqrs\"><span>Motivo:</span> ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "motivo", array()), "html", null, true);
        echo "</div>

        ";
        // line 63
        if ((isset($context["respuestas"]) ? $context["respuestas"] : null)) {
            // line 64
            echo "            <h2>Respuestas</h2>
            <table class=\"table table-hover\">
                <tr>
                    <td>id Respuesta</td>
                    <td>Respuesta</td>
                    <td>Estado</td>
                    <td>Nombre Usuario</td>
                    <td>de</td>
                    <td>para</td>
                    <td>Fecha</td>
                    <td>Consultar</td>
                </tr>
                ";
            // line 76
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["respuestas"]) ? $context["respuestas"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["key"] => $context["res"]) {
                // line 77
                echo "                    <tr>
                        <td>";
                // line 78
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "id", array()), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, (twig_length_filter($this->env, (isset($context["respuestas"]) ? $context["respuestas"] : null)) - $this->getAttribute($context["loop"], "index0", array())), "html", null, true);
                echo "</td>
                        <td>";
                // line 79
                echo $this->getAttribute($context["res"], "respuesta", array());
                echo "</td>
                        <td>";
                // line 80
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["info_res"]) ? $context["info_res"] : null), $context["key"], array(), "array"), "estado", array()), "html", null, true);
                echo "</td>
                        <td>";
                // line 81
                echo twig_escape_filter($this->env, $this->getAttribute($context["res"], "usuario", array()), "html", null, true);
                echo "</td>
                        <td>";
                // line 82
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["info_res"]) ? $context["info_res"] : null), $context["key"], array(), "array"), "area_ant", array()), "html", null, true);
                echo "</td>
                        <td>";
                // line 83
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["info_res"]) ? $context["info_res"] : null), $context["key"], array(), "array"), "area", array()), "html", null, true);
                echo "</td>
                        <td>";
                // line 84
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["res"], "fecha", array()), "d - m - Y h:i A"), "html", null, true);
                echo "</td>
                        <td><a class=\"btn btn-primary\" data-toggle=\"modal\" onclick=\"\$('#mod-info .modal-body').load('";
                // line 85
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("pqrs_respuesta_detalle", array("id" => $this->getAttribute($context["res"], "id", array()))), "html", null, true);
                echo "');\" data-target=\"#mod-info\"><i class=\"fa fa-info-circle\"></i>Ver</a></td>
                    </tr>
                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['res'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 88
            echo "            </table>
        ";
        }
        // line 90
        echo "        <div id=\"formulario-respuesta\"></div>
        <span><a class=\"btn btn-primary\" href=\"";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("pqrs_respuesta", array("id" => $this->getAttribute((isset($context["pqrs"]) ? $context["pqrs"] : null), "id", array()))), "html", null, true);
        echo "\">Nueva Respuesta</a></span>
    </div>
    <div class=\"modal fade\" id=\"mod-info\" tabindex=\"-1\" role=\"dialog\">
        <div class=\"modal-dialog\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                </div>
                <div class=\"modal-body\">
                    <div class=\"text-center\">
                        <div class=\"i-circle primary\"><i class=\"fa fa-check\"></i></div>
                        <h4>Cargando..</h4>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
";
    }

    public function getTemplateName()
    {
        return "PqrsBundle:DetallePqrs:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  284 => 91,  281 => 90,  277 => 88,  260 => 85,  256 => 84,  252 => 83,  248 => 82,  244 => 81,  240 => 80,  236 => 79,  230 => 78,  227 => 77,  210 => 76,  196 => 64,  194 => 63,  188 => 61,  184 => 59,  173 => 57,  169 => 56,  166 => 55,  164 => 54,  159 => 51,  152 => 48,  148 => 46,  146 => 45,  141 => 43,  134 => 42,  129 => 39,  126 => 38,  117 => 36,  113 => 35,  109 => 34,  101 => 32,  95 => 29,  91 => 28,  85 => 25,  81 => 24,  75 => 21,  71 => 20,  65 => 17,  61 => 16,  55 => 13,  51 => 12,  42 => 6,  39 => 5,  36 => 4,  29 => 2,  11 => 1,);
    }
}
