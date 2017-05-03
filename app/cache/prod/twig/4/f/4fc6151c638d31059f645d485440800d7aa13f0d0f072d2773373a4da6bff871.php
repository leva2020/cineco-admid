<?php

/* PqrsBundle:Pqrs:index.html.twig */
class __TwigTemplate_4fc6151c638d31059f645d485440800d7aa13f0d0f072d2773373a4da6bff871 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("PqrsBundle::base.html.twig", "PqrsBundle:Pqrs:index.html.twig", 1);
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
        echo "Lista PQRS";
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"respuestas-pqrs\">
        <legend>Filtros de búsqueda</legend>
        ";
        // line 6
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : null), 'form');
        echo "
        <table class=\"table table-hover\">
            <tr>
                <td>Días transcurridos</td>
                <td>Id</td>
                <td>Correo</td>
                <td>Usuario</td>
                <td>No. Identificación</td>
                <td>Estado</td>
                <td>Tipo</td>
                <td>Fecha Registro</td>
                <td>Fecha última modificación</td>
                <td>Responsable actual</td>
                <td>Portal</td>
                <td>Ver Detalle</td>
            </tr>
            ";
        // line 22
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pqrs"]) ? $context["pqrs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["pq"]) {
            // line 23
            echo "                <tr>
                    <td class=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), $this->getAttribute($context["pq"], "id", array()), array(), "array"), "color", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), $this->getAttribute($context["pq"], "id", array()), array(), "array"), "diasreg", array()), "html", null, true);
            echo " </td>
                    <td>";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($context["pq"], "id", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["pq"], "correo", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["pq"], "nombreusuario", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 28
            if ($this->getAttribute($context["pq"], "documentousuario", array())) {
                echo twig_escape_filter($this->env, $this->getAttribute($context["pq"], "documentousuario", array()), "html", null, true);
            }
            echo "</td>
                    <td>";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), $this->getAttribute($context["pq"], "id", array()), array(), "array"), "estado", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), $this->getAttribute($context["pq"], "id", array()), array(), "array"), "tipo_comunicacion", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), $this->getAttribute($context["pq"], "id", array()), array(), "array"), "fecha", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), $this->getAttribute($context["pq"], "id", array()), array(), "array"), "fecha_mod", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), $this->getAttribute($context["pq"], "id", array()), array(), "array"), "area", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), $this->getAttribute($context["pq"], "id", array()), array(), "array"), "portal", array()), "html", null, true);
            echo "</td>
                    <td><a href=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("pqrs_detalle", array("id" => $this->getAttribute($context["pq"], "id", array()))), "html", null, true);
            echo "\"><i class=\"fa fa-search\"></i></a></td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pq'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "        </table>
    </div>
    <div class=\"paginacion\">
        ";
        // line 41
        echo $this->env->getExtension('knp_pagination')->render((isset($context["pqrs"]) ? $context["pqrs"] : null));
        echo "
    </div>
    ";
        // line 43
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashbag", array()), "get", array(0 => "error"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 44
            echo "        <div style=\"position: relative; padding-top: 50px;\" class=\"flash-notice\">
            ";
            // line 45
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
        return "PqrsBundle:Pqrs:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 45,  139 => 44,  135 => 43,  130 => 41,  125 => 38,  116 => 35,  112 => 34,  108 => 33,  104 => 32,  100 => 31,  96 => 30,  92 => 29,  86 => 28,  82 => 27,  78 => 26,  74 => 25,  68 => 24,  65 => 23,  61 => 22,  42 => 6,  38 => 4,  35 => 3,  29 => 2,  11 => 1,);
    }
}
