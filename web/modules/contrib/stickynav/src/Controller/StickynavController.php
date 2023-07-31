<?php

namespace Drupal\stickynav\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Extension\ThemeHandlerInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for stickynav module routes.
 */
class StickynavController extends ControllerBase {
  /**
   * The theme handler container.
   *
   * @var Drupal\Core\Extension\ThemeHandlerInterface
   */
  protected $themeHandler;

  /**
   * Constructs a \Drupal\stickynav\Controller\StickynavController object.
   *
   * @param \Drupal\Core\Extension\ThemeHandlerInterface $themeHandler
   *
   *   The theme handler.
   */
  public function __construct(ThemeHandlerInterface $themeHandler) {
    $this->themeHandler = $themeHandler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('theme_handler')
    );
  }

  /**
   * Lists links to configuration for stickynav per theme.
   *
   * @return string
   *   Table of all enabled themes where you can set the stickynav settings.
   */
  public function listThemes() {
    $build = [];
    $themes = $this->themeHandler->listInfo();
    $rows = [];
    foreach ($themes as $name => $theme) {
      $row = [$theme->info['name']];
      $links['edit'] = [
        'title' => $this->t('Edit'),
        'url' => Url::fromRoute('stickynav.set_theme', ['theme' => $name]),
      ];
      $row[] = [
        'data' => [
          '#type' => 'operations',
          '#links' => $links,
        ],
      ];
      $rows[] = $row;
    }
    $header = [
      $this->t('Theme'),
      $this->t('Action'),
    ];

    $build['stickynav_themes'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
