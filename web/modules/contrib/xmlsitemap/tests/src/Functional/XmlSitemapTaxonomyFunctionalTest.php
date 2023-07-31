<?php

namespace Drupal\Tests\xmlsitemap\Functional;

use Drupal\Core\Language\LanguageInterface;
use Drupal\taxonomy\Entity\Vocabulary;

/**
 * Tests the generation of taxonomy links.
 *
 * @group xmlsitemap
 */
class XmlSitemapTaxonomyFunctionalTest extends XmlSitemapTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['taxonomy'];

  /**
   * Entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->entityTypeManager = $this->container->get('entity_type.manager');

    // Add a vocabulary.
    $vocabulary = Vocabulary::create([
      'name' => 'Tags',
      'description' => $this->randomMachineName(),
      'vid' => 'tags',
      'langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED,
      'help' => '',
    ]);
    $vocabulary->save();

    $this->admin_user = $this->drupalCreateUser(['administer taxonomy', 'administer xmlsitemap']);
  }

  /**
   * Test xmlsitemap settings for taxonomies.
   */
  public function testTaxonomySettings() {
    $this->drupalLogin($this->admin_user);

    // Enable XML Sitemap settings for our vocabulary.
    $settings = [
      'status' => '1',
      'priority' => '1.0',
    ];
    xmlsitemap_link_bundle_settings_save('taxonomy_term', 'tags', $settings);

    $this->drupalGet('admin/structure/taxonomy/manage/tags/add');
    $session = $this->assertSession();
    $session->statusCodeEquals(200);
    $session->fieldExists('xmlsitemap[status]');
    $session->fieldExists('xmlsitemap[priority]');
    $session->fieldExists('xmlsitemap[changefreq]');

    $term_name = $this->randomMachineName();
    $edit = [
      'name[0][value]' => $term_name,
      'xmlsitemap[status]' => 'default',
      'xmlsitemap[priority]' => 'default',
    ];
    $this->submitForm($edit, t('Save'));

    $term = $this
      ->entityTypeManager
      ->getStorage("taxonomy_term")
      ->loadByProperties([
        "name" => $term_name,
        "vid" => 'tags',
      ]);
    $term = $term[1];
    $link = $this->linkStorage->load('taxonomy_term', $term->id());
    $this->assertEquals(1, (int) $link['status']);
    $this->assertEquals(1, (int) $link['priority']);
  }

}
