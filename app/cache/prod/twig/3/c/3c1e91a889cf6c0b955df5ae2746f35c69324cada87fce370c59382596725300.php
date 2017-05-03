<?php

/* PqrsBundle:Reportes:transacciones-devoluciones.html.twig */
class __TwigTemplate_3c1e91a889cf6c0b955df5ae2746f35c69324cada87fce370c59382596725300 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("PqrsBundle::base.html.twig", "PqrsBundle:Reportes:transacciones-devoluciones.html.twig", 1);
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
        echo "Reporte Transacciones Reversiones";
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"reportes-pqrs devoluciones\">
        <legend>Reporte Transacciones Reversiones</legend>
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
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("reporte_archivo_transacciones_devoluciones", array("filtros" => (isset($context["filtros"]) ? $context["filtros"] : null))), "html", null, true);
            echo "\">Exportar</a>
            ";
        }
        // line 12
        echo "        </div>
        <table class=\"table table-hover\">
            <tr>
                <td>Tarjeta de crédito</td>
                <td>Medio de pago</td>
                <td>Factura Portal</td>
                <td>Autorización Banco</td>
                <td>Cliente</td>
                <td>Tipo y número de documento</td>
                <td>Estado de compra</td>
                <td>Fecha transacción</td>
                <td>Valor total</td>
                <td>Teatro</td>
                <td>Pelicula</td>
                <td>Localidad</td>
                <td>Fecha función</td>
                <td>Número de boletas</td>
            </tr>
            ";
        // line 30
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["reporte"]) ? $context["reporte"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["re"]) {
            // line 31
            echo "                <tr>
                    <td>";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "tarjeta_credito", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "entidad", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "factura", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "autorizacion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "nombre_cliente", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 37
            echo twig_escape_filter($this->env, (($this->getAttribute($context["re"], "tipo_doc", array()) . ": ") . $this->getAttribute($context["re"], "cedula", array())), "html", null, true);
            echo "</td>
                    <td>";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "estado", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "fecha_transaccion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 40
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "total", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "multiplex", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "pelicula", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "localidad_nombre", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "fecha_funcion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($context["re"], "no_boletas", array()), "html", null, true);
            echo "</td>            
                </tr> 
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['re'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "
        </table>
    </div>
    <div class=\"paginacion\">
        ";
        // line 52
        echo $this->env->getExtension('knp_pagination')->render((isset($context["reporte"]) ? $context["reporte"] : null));
        echo "
    </div>
    ";
        // line 54
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashbag", array()), "get", array(0 => "error"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 55
            echo "        <div style=\"position: relative; padding-top: 50px;\" class=\"flash-notice\">
            ";
            // line 56
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
        return "PqrsBundle:Reportes:transacciones-devoluciones.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 56,  159 => 55,  155 => 54,  150 => 52,  144 => 48,  135 => 45,  131 => 44,  127 => 43,  123 => 42,  119 => 41,  115 => 40,  111 => 39,  107 => 38,  103 => 37,  99 => 36,  95 => 35,  91 => 34,  87 => 33,  83 => 32,  80 => 31,  76 => 30,  56 => 12,  50 => 10,  48 => 9,  42 => 6,  38 => 4,  35 => 3,  29 => 2,  11 => 1,);
    }
}
