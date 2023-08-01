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

/* themes/contrib/dxpr_theme/templates/page.html.twig */
class __TwigTemplate_6a6fefabcab586078640462fb918acb1 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'secondary_header' => [$this, 'block_secondary_header'],
            'navbar' => [$this, 'block_navbar'],
            'highlighted' => [$this, 'block_highlighted'],
            'page_title' => [$this, 'block_page_title'],
            'content_top' => [$this, 'block_content_top'],
            'main' => [$this, 'block_main'],
            'sidebar_first' => [$this, 'block_sidebar_first'],
            'action_links' => [$this, 'block_action_links'],
            'help' => [$this, 'block_help'],
            'content' => [$this, 'block_content'],
            'sidebar_second' => [$this, 'block_sidebar_second'],
            'content_bottom' => [$this, 'block_content_bottom'],
            'footer' => [$this, 'block_footer'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 60
        if ((( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_dth_page_layout", [], "any", false, false, true, 60), "getString", [], "method", false, false, true, 60) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 60), "boxed_layout", [], "any", false, false, true, 60)) || (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 61
($context["node"] ?? null), "field_dth_page_layout", [], "any", false, false, true, 61), "getString", [], "method", false, false, true, 61) == "boxed"))) {
            // line 62
            echo "<div class=\"dxpr-theme-boxed-container\">
";
        }
        // line 64
        echo "
";
        // line 66
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secondary_header", [], "any", false, false, true, 66)) {
            // line 67
            echo "  ";
            $this->displayBlock('secondary_header', $context, $blocks);
        }
        // line 82
        echo "
";
        // line 84
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "navigation", [], "any", false, false, true, 84) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "navigation_collapsible", [], "any", false, false, true, 84))) {
            // line 85
            echo "  ";
            $this->displayBlock('navbar', $context, $blocks);
        }
        // line 142
        echo "
<div class=\"wrap-containers\">

";
        // line 146
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 146)) {
            // line 147
            echo "  ";
            $this->displayBlock('highlighted', $context, $blocks);
        }
        // line 151
        echo "
";
        // line 153
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "page_title", [], "any", false, false, true, 153) &&  !(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 153), "page_title_home_hide", [], "any", false, false, true, 153) && ($context["is_front"] ?? null)))) {
            // line 154
            echo "
  ";
            // line 155
            $this->displayBlock('page_title', $context, $blocks);
        }
        // line 169
        echo "
";
        // line 171
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_top", [], "any", false, false, true, 171)) {
            // line 172
            echo "  ";
            $this->displayBlock('content_top', $context, $blocks);
        }
        // line 185
        echo "
";
        // line 187
        $this->displayBlock('main', $context, $blocks);
        // line 264
        echo "
";
        // line 266
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_bottom", [], "any", false, false, true, 266)) {
            // line 267
            echo "  ";
            $this->displayBlock('content_bottom', $context, $blocks);
        }
        // line 280
        echo "</div>

";
        // line 283
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 283)) {
            // line 284
            echo "  ";
            $this->displayBlock('footer', $context, $blocks);
        }
        // line 299
        echo "
";
        // line 300
        if ((( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_dth_page_layout", [], "any", false, false, true, 300), "getString", [], "method", false, false, true, 300) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 300), "boxed_layout", [], "any", false, false, true, 300)) || (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 301
($context["node"] ?? null), "field_dth_page_layout", [], "any", false, false, true, 301), "getString", [], "method", false, false, true, 301) == "boxed"))) {
            // line 302
            echo "</div><!-- end dxpr-theme-boxed-container -->
";
        }
    }

    // line 67
    public function block_secondary_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 68
        echo "    ";
        $context["container"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 68), "full_width_containers", [], "any", false, false, true, 68), "cnt_secondary_header", [], "any", false, false, true, 68)) ? ("dxpr-theme-fluid") : ("container"));
        // line 69
        echo "    <header id=\"secondary-header\" class=\"dxpr-theme-secondary-header clearfix ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 69), "secondary_header_hide", [], "any", false, false, true, 69), 69, $this->source)), "html", null, true);
        echo "\" role=\"banner\">
      <div class=\"";
        // line 70
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 70, $this->source), "html", null, true);
        echo " secondary-header-container\">
        ";
        // line 71
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 71), "full_width_containers", [], "any", false, false, true, 71), "cnt_secondary_header", [], "any", false, false, true, 71)) {
            // line 72
            echo "          <div class=\"row container-row\"><div class=\"col-sm-12 container-col\">
        ";
        }
        // line 74
        echo "        ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secondary_header", [], "any", false, false, true, 74), 74, $this->source), "html", null, true);
        echo "
        ";
        // line 75
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 75), "full_width_containers", [], "any", false, false, true, 75), "cnt_secondary_header", [], "any", false, false, true, 75)) {
            // line 76
            echo "          </div></div>
        ";
        }
        // line 78
        echo "      </div>
    </header>
  ";
    }

    // line 85
    public function block_navbar($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 86
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 86), "header_position", [], "any", false, false, true, 86)) {
            // line 87
            echo "      ";
            // line 88
            $context["navbar_classes"] = [0 => "navbar dxpr-theme-header dxpr-theme-header--top", 1 => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 90
($context["theme"] ?? null), "settings", [], "any", false, false, true, 90), "navbar_position", [], "any", false, false, true, 90)) ? (("navbar-is-" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 90), "navbar_position", [], "any", false, false, true, 90), 90, $this->source))) : ("")), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 91
($context["theme"] ?? null), "settings", [], "any", false, false, true, 91), "header_side_align", [], "any", false, false, true, 91)];
            // line 94
            echo "    ";
        } else {
            // line 95
            echo "      ";
            // line 96
            $context["navbar_classes"] = [0 => "navbar dxpr-theme-header clearfix", 1 => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 98
($context["theme"] ?? null), "settings", [], "any", false, false, true, 98), "header_position", [], "any", false, false, true, 98)) ? ("dxpr-theme-header--side") : ("dxpr-theme-header--top")), 2 => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 99
($context["theme"] ?? null), "settings", [], "any", false, false, true, 99), "navbar_position", [], "any", false, false, true, 99)) ? (("navbar-is-" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 99), "navbar_position", [], "any", false, false, true, 99), 99, $this->source))) : ("")), 3 => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 100
($context["theme"] ?? null), "settings", [], "any", false, false, true, 100), "header_top_layout", [], "any", false, false, true, 100)) ? (("dxpr-theme-header--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 100), "header_top_layout", [], "any", false, false, true, 100), 100, $this->source)))) : ("")), 4 => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 101
($context["theme"] ?? null), "settings", [], "any", false, false, true, 101), "header_style", [], "any", false, false, true, 101)) ? (("dxpr-theme-header--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 101), "header_style", [], "any", false, false, true, 101), 101, $this->source)))) : ("")), 5 => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 102
($context["theme"] ?? null), "settings", [], "any", false, false, true, 102), "menu_hover", [], "any", false, false, true, 102)) ? (("dxpr-theme-header--hover-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 102), "menu_hover", [], "any", false, false, true, 102), 102, $this->source)))) : ("")), 6 => (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 103
($context["theme"] ?? null), "settings", [], "any", false, false, true, 103), "header_top_fixed", [], "any", false, false, true, 103) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 103), "header_top_sticky", [], "any", false, false, true, 103))) ? ("dxpr-theme-header--sticky") : ("")), 7 => (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 104
($context["theme"] ?? null), "settings", [], "any", false, false, true, 104), "header_top_fixed", [], "any", false, false, true, 104) &&  !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 104), "header_top_sticky", [], "any", false, false, true, 104))) ? ("dxpr-theme-header--fixed") : (""))];
            // line 107
            echo "    ";
        }
        // line 108
        echo "    ";
        $context["mark_menu"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 108), "mark_menu_with_children", [], "any", false, false, true, 108)) ? ("dxpr-theme-menu--has-children") : (""));
        // line 109
        echo "    ";
        $context["navbar_attributes"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["navbar_attributes"] ?? null), "removeClass", [0 => "container"], "method", false, false, true, 109), "addClass", [0 => ($context["navbar_classes"] ?? null)], "method", false, false, true, 109);
        // line 110
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 110), "header_top_fixed", [], "any", false, false, true, 110) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 110), "header_top_sticky", [], "any", false, false, true, 110))) {
            // line 111
            echo "      ";
            $context["navbar_attributes"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["navbar_attributes"] ?? null), "setAttribute", [0 => "data-spy", 1 => "affix"], "method", false, false, true, 111), "setAttribute", [0 => "data-offset-top", 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 111), "header_top_height_sticky_offset", [], "any", false, false, true, 111)], "method", false, false, true, 111);
            // line 112
            echo "    ";
        }
        // line 113
        echo "    ";
        $context["hamburger_menu"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 113), "hamburger_menu", [], "any", false, false, true, 113)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 113), "hamburger_menu", [], "any", false, false, true, 113)) : ("three-dash"));
        // line 114
        echo "
    <header";
        // line 115
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_attributes"] ?? null), 115, $this->source), "html", null, true);
        echo ">
      ";
        // line 116
        $context["container"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 116), "full_width_containers", [], "any", false, false, true, 116), "cnt_header_nav", [], "any", false, false, true, 116)) ? ("dxpr-theme-fluid") : ("container"));
        // line 117
        echo "      <div class=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 117, $this->source), "html", null, true);
        echo " navbar-container\">
        ";
        // line 118
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 118), "full_width_containers", [], "any", false, false, true, 118), "cnt_header_nav", [], "any", false, false, true, 118)) {
            // line 119
            echo "          <div class=\"row container-row\"><div class=\"col-sm-12 container-col\">
        ";
        }
        // line 121
        echo "        <div class=\"navbar-header\">
          ";
        // line 122
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "navigation", [], "any", false, false, true, 122), 122, $this->source), "html", null, true);
        echo "
          ";
        // line 124
        echo "          ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "navigation_collapsible", [], "any", false, false, true, 124)) {
            // line 125
            echo "            <a id=\"dxpr-theme-menu-toggle\" href=\"#\" class=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["hamburger_menu"] ?? null), 125, $this->source), "html", null, true);
            echo "\"><span></span><div class=\"screenreader-text visually-hidden\">Toggle menu</div></a>
          ";
        }
        // line 127
        echo "        </div>

        ";
        // line 130
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "navigation_collapsible", [], "any", false, false, true, 130)) {
            // line 131
            echo "            <nav role=\"navigation\" id=\"dxpr-theme-main-menu\" class=\"dxpr-theme-main-menu ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["mark_menu"] ?? null), 131, $this->source), "html", null, true);
            echo "\">
            ";
            // line 132
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "navigation_collapsible", [], "any", false, false, true, 132), 132, $this->source), "html", null, true);
            echo "
            </nav>
        ";
        }
        // line 135
        echo "        ";
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 135), "full_width_containers", [], "any", false, false, true, 135), "cnt_header_nav", [], "any", false, false, true, 135)) {
            // line 136
            echo "          </div></div>
        ";
        }
        // line 138
        echo "      </div>
    </header>
  ";
    }

    // line 147
    public function block_highlighted($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 148
        echo "    ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 148), 148, $this->source), "html", null, true);
        echo "
  ";
    }

    // line 155
    public function block_page_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 156
        echo "  ";
        if (($context["title_bg_image_path"] ?? null)) {
            // line 157
            echo "    <style>
      #page-title-full-width-container::after{ background-image:url(";
            // line 158
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getFileUrl($this->sandbox->ensureToStringAllowed(($context["title_bg_image_path"] ?? null), 158, $this->source)), "html", null, true);
            echo ");}
    </style>
  ";
        }
        // line 161
        echo "    <div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_title_attributes"] ?? null), 161, $this->source), "html", null, true);
        echo " class=\"page-title-full-width-container\" id=\"page-title-full-width-container\">
    ";
        // line 162
        $context["container"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 162), "full_width_containers", [], "any", false, false, true, 162), "cnt_page_title", [], "any", false, false, true, 162)) ? ("dxpr-theme-fluid") : ("container"));
        // line 163
        echo "      <header role=\"banner\" id=\"page-title\" class=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 163, $this->source), "html", null, true);
        echo " page-title-container\">
        ";
        // line 164
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "page_title", [], "any", false, false, true, 164), 164, $this->source), "html", null, true);
        echo "
      </header>
    </div>
  ";
    }

    // line 172
    public function block_content_top($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 173
        echo "    ";
        $context["container"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 173), "full_width_containers", [], "any", false, false, true, 173), "cnt_content_top", [], "any", false, false, true, 173)) ? ("dxpr-theme-fluid") : ("container"));
        // line 174
        echo "    <div class=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 174, $this->source), "html", null, true);
        echo " content-top-container\">
      ";
        // line 175
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 175), "full_width_containers", [], "any", false, false, true, 175), "cnt_content_top", [], "any", false, false, true, 175)) {
            // line 176
            echo "      <div class=\"row container-row\"><div class=\"col-sm-12 container-col\">
      ";
        }
        // line 178
        echo "      ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_top", [], "any", false, false, true, 178), 178, $this->source), "html", null, true);
        echo "
      ";
        // line 179
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 179), "full_width_containers", [], "any", false, false, true, 179), "cnt_content_top", [], "any", false, false, true, 179)) {
            // line 180
            echo "      </div></div>
      ";
        }
        // line 182
        echo "    </div>
  ";
    }

    // line 187
    public function block_main($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 188
        echo "  ";
        $context["container"] = ((((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 188), "full_width_containers", [], "any", false, false, true, 188), "cnt_content", [], "any", false, false, true, 188) || (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 189
($context["node"] ?? null), "field_dth_main_content_width", [], "any", false, false, true, 189), "getString", [], "method", false, false, true, 189) == "dxpr-theme-util-full-width-content")) || (((        // line 190
($context["node"] ?? null) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 190), "full_width_content_types", [], "any", false, false, true, 190), twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "getType", [], "any", false, false, true, 190), [], "any", false, false, true, 190)) &&  !twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 191
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 191), 191, $this->source))))) &&  !twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 192
($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 192), 192, $this->source))))))) ? ("") : ("container"));
        // line 193
        echo "  <div role=\"main\" class=\"main-container ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 193, $this->source), "html", null, true);
        echo " js-quickedit-main-content clearfix\">
    ";
        // line 194
        if ((($context["container"] ?? null) != "")) {
            // line 195
            echo "    <div class=\"row\">
    ";
        }
        // line 197
        echo "      ";
        // line 198
        echo "      ";
        if (twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 198))))) {
            // line 199
            echo "        ";
            $this->displayBlock('sidebar_first', $context, $blocks);
            // line 204
            echo "      ";
        }
        // line 205
        echo "
      ";
        // line 207
        echo "      ";
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_dth_main_content_width", [], "any", false, false, true, 207), "getString", [], "method", false, false, true, 207)) {
            // line 208
            echo "        ";
            // line 209
            $context["content_classes"] = [0 => (((twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,             // line 210
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 210), 210, $this->source)))) && twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 210), 210, $this->source)))))) ? ("col-sm-6") : ("")), 1 => (((twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,             // line 211
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 211), 211, $this->source)))) && twig_test_empty(twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 211), 211, $this->source))))))) ? ("col-sm-9") : ("")), 2 => (((twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,             // line 212
($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 212), 212, $this->source)))) && twig_test_empty(twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 212), 212, $this->source))))))) ? ("col-sm-9") : ("")), 3 => (((((            // line 213
($context["container"] ?? null) != "") && twig_test_empty(twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 213), 213, $this->source)))))) && twig_test_empty(twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 213), 213, $this->source))))))) ? ("col-sm-12") : (""))];
            // line 216
            echo "      ";
        } else {
            // line 217
            echo "        ";
            $context["col"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_dth_main_content_width", [], "any", false, false, true, 217), "getString", [], "method", false, false, true, 217);
            // line 218
            echo "        ";
            // line 219
            $context["content_classes"] = [0 => (((            // line 220
($context["col"] ?? null) == "dxpr-theme-util-content-center-4-col")) ? ("col-md-4 col-md-offset-4") : ("")), 1 => (((            // line 221
($context["col"] ?? null) == "dxpr-theme-util-content-center-6-col")) ? ("col-md-6 col-md-offset-3") : ("")), 2 => (((            // line 222
($context["col"] ?? null) == "dxpr-theme-util-content-center-8-col")) ? ("col-md-8 col-md-offset-2") : ("")), 3 => (((            // line 223
($context["col"] ?? null) == "dxpr-theme-util-content-center-10-col")) ? ("col-md-10 col-md-offset-1") : (""))];
            // line 226
            echo "      ";
        }
        // line 227
        echo "
      <section";
        // line 228
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [0 => ($context["content_classes"] ?? null)], "method", false, false, true, 228), 228, $this->source), "html", null, true);
        echo ">

        ";
        // line 231
        echo "        ";
        if (($context["action_links"] ?? null)) {
            // line 232
            echo "          ";
            $this->displayBlock('action_links', $context, $blocks);
            // line 235
            echo "        ";
        }
        // line 236
        echo "
        ";
        // line 238
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "help", [], "any", false, false, true, 238)) {
            // line 239
            echo "          ";
            $this->displayBlock('help', $context, $blocks);
            // line 242
            echo "        ";
        }
        // line 243
        echo "
        ";
        // line 245
        echo "        ";
        $this->displayBlock('content', $context, $blocks);
        // line 249
        echo "      </section>

      ";
        // line 252
        echo "      ";
        if (twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 252))))) {
            // line 253
            echo "        ";
            $this->displayBlock('sidebar_second', $context, $blocks);
            // line 258
            echo "      ";
        }
        // line 259
        echo "    ";
        if ((($context["container"] ?? null) != "")) {
            // line 260
            echo "    </div><!-- end .ow -->
    ";
        }
        // line 262
        echo "  </div><!-- end main-container -->
";
    }

    // line 199
    public function block_sidebar_first($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 200
        echo "          <aside class=\"col-sm-3\" role=\"complementary\">
            ";
        // line 201
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 201), 201, $this->source), "html", null, true);
        echo "
          </aside>
        ";
    }

    // line 232
    public function block_action_links($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 233
        echo "            <ul class=\"action-links\" style=\"border: 2px dashed blue\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["action_links"] ?? null), 233, $this->source), "html", null, true);
        echo "</ul>
          ";
    }

    // line 239
    public function block_help($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 240
        echo "            ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "help", [], "any", false, false, true, 240), 240, $this->source), "html", null, true);
        echo "
          ";
    }

    // line 245
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 246
        echo "          <a id=\"main-content\"></a>
          ";
        // line 247
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 247), 247, $this->source), "html", null, true);
        echo "
        ";
    }

    // line 253
    public function block_sidebar_second($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 254
        echo "          <aside class=\"col-sm-3\" role=\"complementary\">
            ";
        // line 255
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 255), 255, $this->source), "html", null, true);
        echo "
          </aside>
        ";
    }

    // line 267
    public function block_content_bottom($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 268
        echo "    ";
        $context["container"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 268), "full_width_containers", [], "any", false, false, true, 268), "cnt_content_bottom", [], "any", false, false, true, 268)) ? ("dxpr-theme-fluid") : ("container"));
        // line 269
        echo "    <div class=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 269, $this->source), "html", null, true);
        echo " content-bottom-container\">
      ";
        // line 270
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 270), "full_width_containers", [], "any", false, false, true, 270), "cnt_content_bottom", [], "any", false, false, true, 270)) {
            // line 271
            echo "      <div class=\"row container-row\"><div class=\"col-sm-12 container-col\">
      ";
        }
        // line 273
        echo "      ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_bottom", [], "any", false, false, true, 273), 273, $this->source), "html", null, true);
        echo "
      ";
        // line 274
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 274), "full_width_containers", [], "any", false, false, true, 274), "cnt_content_bottom", [], "any", false, false, true, 274)) {
            // line 275
            echo "      </div></div>
      ";
        }
        // line 277
        echo "    </div>
  ";
    }

    // line 284
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 285
        echo "    <footer class=\"dxpr-theme-footer clearfix\" role=\"contentinfo\">
      ";
        // line 286
        $context["container"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 286), "full_width_containers", [], "any", false, false, true, 286), "cnt_footer", [], "any", false, false, true, 286)) ? ("dxpr-theme-fluid") : ("container"));
        // line 287
        echo "      <div class=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 287, $this->source), "html", null, true);
        echo " footer-container\">
        ";
        // line 288
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 288), "full_width_containers", [], "any", false, false, true, 288), "cnt_footer", [], "any", false, false, true, 288)) {
            // line 289
            echo "        <div class=\"row container-row\"><div class=\"col-sm-12 container-col\">
        ";
        }
        // line 291
        echo "        ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 291), 291, $this->source), "html", null, true);
        echo "
        ";
        // line 292
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 292), "full_width_containers", [], "any", false, false, true, 292), "cnt_footer", [], "any", false, false, true, 292)) {
            // line 293
            echo "        </div></div>
        ";
        }
        // line 295
        echo "      </div>
    </footer>
  ";
    }

    public function getTemplateName()
    {
        return "themes/contrib/dxpr_theme/templates/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  631 => 295,  627 => 293,  625 => 292,  620 => 291,  616 => 289,  614 => 288,  609 => 287,  607 => 286,  604 => 285,  600 => 284,  595 => 277,  591 => 275,  589 => 274,  584 => 273,  580 => 271,  578 => 270,  573 => 269,  570 => 268,  566 => 267,  559 => 255,  556 => 254,  552 => 253,  546 => 247,  543 => 246,  539 => 245,  532 => 240,  528 => 239,  521 => 233,  517 => 232,  510 => 201,  507 => 200,  503 => 199,  498 => 262,  494 => 260,  491 => 259,  488 => 258,  485 => 253,  482 => 252,  478 => 249,  475 => 245,  472 => 243,  469 => 242,  466 => 239,  463 => 238,  460 => 236,  457 => 235,  454 => 232,  451 => 231,  446 => 228,  443 => 227,  440 => 226,  438 => 223,  437 => 222,  436 => 221,  435 => 220,  434 => 219,  432 => 218,  429 => 217,  426 => 216,  424 => 213,  423 => 212,  422 => 211,  421 => 210,  420 => 209,  418 => 208,  415 => 207,  412 => 205,  409 => 204,  406 => 199,  403 => 198,  401 => 197,  397 => 195,  395 => 194,  390 => 193,  388 => 192,  387 => 191,  386 => 190,  385 => 189,  383 => 188,  379 => 187,  374 => 182,  370 => 180,  368 => 179,  363 => 178,  359 => 176,  357 => 175,  352 => 174,  349 => 173,  345 => 172,  337 => 164,  332 => 163,  330 => 162,  325 => 161,  319 => 158,  316 => 157,  313 => 156,  309 => 155,  302 => 148,  298 => 147,  292 => 138,  288 => 136,  285 => 135,  279 => 132,  274 => 131,  271 => 130,  267 => 127,  261 => 125,  258 => 124,  254 => 122,  251 => 121,  247 => 119,  245 => 118,  240 => 117,  238 => 116,  234 => 115,  231 => 114,  228 => 113,  225 => 112,  222 => 111,  219 => 110,  216 => 109,  213 => 108,  210 => 107,  208 => 104,  207 => 103,  206 => 102,  205 => 101,  204 => 100,  203 => 99,  202 => 98,  201 => 96,  199 => 95,  196 => 94,  194 => 91,  193 => 90,  192 => 88,  190 => 87,  187 => 86,  183 => 85,  177 => 78,  173 => 76,  171 => 75,  166 => 74,  162 => 72,  160 => 71,  156 => 70,  151 => 69,  148 => 68,  144 => 67,  138 => 302,  136 => 301,  135 => 300,  132 => 299,  128 => 284,  126 => 283,  122 => 280,  118 => 267,  116 => 266,  113 => 264,  111 => 187,  108 => 185,  104 => 172,  102 => 171,  99 => 169,  96 => 155,  93 => 154,  91 => 153,  88 => 151,  84 => 147,  82 => 146,  77 => 142,  73 => 85,  71 => 84,  68 => 82,  64 => 67,  62 => 66,  59 => 64,  55 => 62,  53 => 61,  52 => 60,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/dxpr_theme/templates/page.html.twig", "C:\\xampp\\htdocs\\drupal\\web\\themes\\contrib\\dxpr_theme\\templates\\page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 60, "block" => 67, "set" => 68);
        static $filters = array("escape" => 69, "clean_class" => 69, "trim" => 191, "striptags" => 191, "render" => 191);
        static $functions = array("file_url" => 158);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'block', 'set'],
                ['escape', 'clean_class', 'trim', 'striptags', 'render'],
                ['file_url']
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
