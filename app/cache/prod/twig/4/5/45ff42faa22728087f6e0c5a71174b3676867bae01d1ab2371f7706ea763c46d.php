<?php

/* PqrsBundle:Reportes:transacciones-banco.html.twig */
class __TwigTemplate_45ff42faa22728087f6e0c5a71174b3676867bae01d1ab2371f7706ea763c46d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("PqrsBundle::base.html.twig", "PqrsBundle:Reportes:transacciones-banco.html.twig", 1);
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
        echo "Reportes Transacciones Banco";
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"reportes-pqrs transacciones\">
        <legend>Reportes Transacciones Banco</legend>
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
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("reporte_archivo_transacciones_banco", array("filtros" => (isset($context["filtros"]) ? $context["filtros"] : null))), "html", null, true);
            echo "\">Exportar</a>
            ";
        }
        // line 12
        echo "        </div>
        <table class=\"table table-hover\">
            <tr>
                <td>Nombre Teatro</td>
                <td>Entidad Financiera</td>
                <td>Factura</td>
                <td>Autorización Banco</td>
                <td>Número de Auditoria</td>
                <td>Estado Transacción</td>
                <td>Tipo de Transacción</td>
                <td>Cédula del cliente</td>
                <td>Nombre del cliente</td>
                <td>Fecha y hora de Transacción</td>
                <td>Valor boletas</td>
                <td>Valor cargos</td>
                <td>Total transacción</td>
                <td>Función ID</td>
                <td>Pelicula Nombre</td>
                <td>Sala</td>
                <td>Localidad</td>
                <td>Sillas</td>
                <td>Fecha y hora Función</td>
                <td>Número de boletas</td>
                <td>Respuesta del Banco</td>
                <td>Origen</td>
                <td>Fecha de cierre</td>
                <td>Fecha Modificación</td>
                <td>Usuario Modificación</td>
            </tr>
            ";
        // line 41
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["reporte"]) ? $context["reporte"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["re"]) {
            // line 42
            echo "                <tr>
                    <td>";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "multiplex", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "entidad", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "factura", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "autorizacion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "auditoria", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "estado", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "tipo_transaccion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "cedula", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "nombre_cliente", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "fecha_transaccion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "valor_boletas", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "valor_cargos", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "total", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "funcion_id", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "pelicula", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "sala", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "localidad_nombre", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "sillas", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "fecha_funcion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "no_boletas", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "respuesta", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "origen", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "fecha_cierre", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "fecha_modificacion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "usuario_modificacion", array()), "html", null, true);
            echo "</td>
                </tr> 
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['re'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "
        </table>
    </div>
    <div class=\"paginacion\">
        ";
        // line 74
        echo $this->env->getExtension('knp_pagination')->render((isset($context["reporte"]) ? $context["reporte"] : null));
        echo "
    </div>
    ";
        // line 76
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashbag", array()), "get", array(0 => "error"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 77
            echo "        <div style=\"position: relative; padding-top: 50px;\" class=\"flash-notice\">
            ";
            // line 78
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
        return "PqrsBundle:Reportes:transacciones-banco.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 78,  214 => 77,  210 => 76,  205 => 74,  199 => 70,  190 => 67,  186 => 66,  182 => 65,  178 => 64,  174 => 63,  170 => 62,  166 => 61,  162 => 60,  158 => 59,  154 => 58,  150 => 57,  146 => 56,  142 => 55,  138 => 54,  134 => 53,  130 => 52,  126 => 51,  122 => 50,  118 => 49,  114 => 48,  110 => 47,  106 => 46,  102 => 45,  98 => 44,  94 => 43,  91 => 42,  87 => 41,  56 => 12,  50 => 10,  48 => 9,  42 => 6,  38 => 4,  35 => 3,  29 => 2,  11 => 1,);
    }
}
