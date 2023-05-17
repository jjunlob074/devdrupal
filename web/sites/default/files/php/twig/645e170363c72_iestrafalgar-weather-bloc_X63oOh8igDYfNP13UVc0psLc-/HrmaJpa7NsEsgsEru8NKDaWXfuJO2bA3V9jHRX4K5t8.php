<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/iestrafalgar_weather/templates/iestrafalgar-weather-block.html.twig */
class __TwigTemplate_d02c19877603e0c40f875fed7a15ac08 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("iestrafalgar_weather/iestrafalgar_weather"), "html", null, true);
        echo "

<div class=\"cb-weather\">
  <h2>";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("Weather Block");
        echo "</h2>
  <p>Contenido del bloque de clima aquí</p>
  <p class=\"c-text\">El Tiempo actual</p>
  <p class=\"c-degrees\">";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["temperature"] ?? null), 7, $this->source), "html", null, true);
        echo " C</p>
  <p class=\"c-wind-speed\">";
        // line 8
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["windSpeed"] ?? null), 8, $this->source), "html", null, true);
        echo " km/h</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/custom/iestrafalgar_weather/templates/iestrafalgar-weather-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 8,  51 => 7,  45 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{{ attach_library('iestrafalgar_weather/iestrafalgar_weather') }}

<div class=\"cb-weather\">
  <h2>{{ 'Weather Block' }}</h2>
  <p>Contenido del bloque de clima aquí</p>
  <p class=\"c-text\">El Tiempo actual</p>
  <p class=\"c-degrees\">{{ temperature }} C</p>
  <p class=\"c-wind-speed\">{{ windSpeed }} km/h</p>
</div>
", "modules/custom/iestrafalgar_weather/templates/iestrafalgar-weather-block.html.twig", "/var/www/html/web/modules/custom/iestrafalgar_weather/templates/iestrafalgar-weather-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 1);
        static $functions = array("attach_library" => 1);

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
