<?php

namespace Drupal\rest_oai_pmh_jpcoar\Plugin\OaiMetadataMap;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\rest_oai_pmh\Plugin\OaiMetadataMapBase;
use Drupal\views\Views;

/**
 * Mods using a View.
 *
 * @OaiMetadataMap(
 *  id = "jpcoar",
 *  label = @Translation("Jpcoar"),
 *  metadata_format = "jpcoar",
 *  template = {
 *    "type" = "module",
 *    "name" = "jpcoar",
 *    "directory" = "templates",
 *    "file" = "jpcoar"
 *  }
 * )
 */
class Jpcoar extends OaiMetadataMapBase {

  /**
   * Provides information on the metadata format.
   *
   * @return string[]
   *   The metadata format specification.
   */
  public function getMetadataFormat() {
    return [
      'metadataPrefix' => 'jpcoar',
      'schema' => 'http://schema.example.com',
      'metadataNamespace' => 'http://namespace.example.com',
    ];
  }

  /**
   * Provides information contained in the metadata wrapper.
   *
   * @return string[]
   *   The information needed in the metadata wrapper.
   */
  public function getMetadataWrapper() {
    return [
      'jpcoar' => [
        '@xmlns:jpcoar' => 'http://xmlns.example.com',
        '@xmlns:xsi' => 'http://xsi.example.com',
        '@xsi:schemaLocation' => 'http://xsd.example.com',
      ],
    ];
  }

  /**
   * Method to transform the provided entity into the desired metadata record.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity
   *   The entity to transform.
   *
   * @return string
   *   rendered XML.
   */
  public function transformRecord(ContentEntityInterface $entity) {

    $render_array['metadata_prefix'] = 'oai_dc';
    $render_array['elements']['title'][] = $entity->label();

    return parent::build($render_array);
  }

}
