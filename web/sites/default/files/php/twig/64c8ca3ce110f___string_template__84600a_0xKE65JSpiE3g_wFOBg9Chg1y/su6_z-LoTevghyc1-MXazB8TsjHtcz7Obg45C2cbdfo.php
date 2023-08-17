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

<<<<<<<< HEAD:web/sites/default/files/php/twig/64dda6df6b41b_file-upload-help.html.twi_CqgxBQrFZ0s-GmqyTiLHoetnj/kZkgSV0FbpbgSTuFYoP6aF0zVyqH7CSpFZ-S6nFi_ag.php
/* core/modules/file/templates/file-upload-help.html.twig */
class __TwigTemplate_d0432b0d4f1c17b18c0898a3f95419d1 extends Template
========
/* __string_template__84600a57813a4eb563f7e829dbaa3ba7 */
class __TwigTemplate_ed294705992e8b3be24fd87265070316 extends Template
>>>>>>>> origin/main:web/sites/default/files/php/twig/64c8ca3ce110f___string_template__84600a_0xKE65JSpiE3g_wFOBg9Chg1y/su6_z-LoTevghyc1-MXazB8TsjHtcz7Obg45C2cbdfo.php
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
        // line 14
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->safeJoin($this->env, $this->sandbox->ensureToStringAllowed(($context["descriptions"] ?? null), 14, $this->source), "<br />"));
        echo "
";
    }

    public function getTemplateName()
    {
        return "core/modules/file/templates/file-upload-help.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 14,);
    }

    public function getSourceContext()
    {
        return new Source("", "core/modules/file/templates/file-upload-help.html.twig", "C:\\xampp\\htdocs\\drupal\\web\\core\\modules\\file\\templates\\file-upload-help.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("safe_join" => 14);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['safe_join'],
                []
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
