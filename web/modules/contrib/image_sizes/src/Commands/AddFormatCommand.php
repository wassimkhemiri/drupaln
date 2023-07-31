<?php

namespace Drupal\image_sizes\Commands;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\image\Plugin\ImageEffect\ConvertImageEffect;
use Symfony\Component\Console\Output\OutputInterface;
use Drush\Commands\DrushCommands;

/**
 * Class GenerateImageSizeCommand.
 */
class AddFormatCommand extends DrushCommands {

  /**
   * Entity type manager service.
   *
   * @var Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * DeleteCommand constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   Entity type manager.
   */
  public function __construct(
      EntityTypeManagerInterface $entityTypeManager
  ) {
    $this->entityTypeManager = $entityTypeManager;
    parent::__construct();
  }

  /**
   * Generate image sizes presets.
   *
   * @param string $format
   *   Foramt.
   *
   * @command image-sizes:add-format
   *
   * @aliases isaf
   *
   * @usage image-sizes:generate 4x3 50 1600 50 --ratio=4x3
   * @usage image-sizes:generate 4x3 50 1600 50 --ratio=4x3 --generate-thumbnail
   */
  public function generate($format) {
    $this->options = [
      'format' => $format,
    ];
    $this->execute($this->output(), $format);
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(OutputInterface $output, $format) {
    /**
     * @var \Drupal\image\Entity\ImageStyle[]
     */
    $styles = $this->entityTypeManager->getStorage('image_style')->loadMultiple();
    foreach ($styles as $style) {
      /**
       * @var \Drupal\image\ConfigurableImageEffectBase[]
       */
      $effects = $style->getEffects();
      $convert = FALSE;
      foreach ($effects as $effect) {
        if ($effect instanceof ConvertImageEffect) {
          $convert = TRUE;
          break;
        }
      }
      if (!$convert) {
        $effect = \Drupal::service('plugin.manager.image.effect')->createInstance('image_convert', [
          'data' => [
            'extension' => $format,
          ],
        ]);
        $style->addImageEffect($effect->getConfiguration());
        $style->save();
        $this->io()->writeln("Add convert");
      }
    }
  }

}
