<?php

/* PqrsBundle:Respuesta:index.html.twig */
class __TwigTemplate_1f8c67387823688a6860d6ca7161fb6410bfbc75c03a1bec051f8e05afc5a22b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("PqrsBundle::base.html.twig", "PqrsBundle:Respuesta:index.html.twig", 1);
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
        // line 3
        echo "    Ingresar nueva respuesta ";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "
";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "    <h3>Ingresar nueva respuesta para la PQRS ";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "</h3>
    <div class=\"formulario\">
        ";
        // line 8
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : null), 'form');
        echo "
    </div>
    <div class=\"causas\">
        ";
        // line 11
        if ((isset($context["causas"]) ? $context["causas"] : null)) {
            // line 12
            echo "            <h2>Causas anteriores:</h2>
            ";
            // line 13
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["causas"]) ? $context["causas"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ca"]) {
                // line 14
                echo "                ";
                echo twig_escape_filter($this->env, $context["ca"], "html", null, true);
                echo ",
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ca'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "        ";
        }
        // line 17
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "PqrsBundle:Respuesta:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 17,  72 => 16,  63 => 14,  59 => 13,  56 => 12,  54 => 11,  48 => 8,  42 => 6,  39 => 5,  32 => 3,  29 => 2,  11 => 1,);
    }
}
