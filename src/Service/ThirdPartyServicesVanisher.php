<?php

namespace Drupal\blizz_vanisher\Service;

use Drupal\blizz_vanisher\Entity\ThirdPartyServiceEntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Class ThirdPartyServicesVanisher.
 *
 * @package Drupal\blizz_vanisher\Service
 */
class ThirdPartyServicesVanisher {

  /**
   * The registered third party services vanisher.
   *
   * @var \Drupal\blizz_vanisher\Service\ThirdPartyServicesVanisherInterface[]
   */
  protected $vanisher;

  /**
   * The current third party services entity.
   *
   * @var \Drupal\blizz_vanisher\Entity\ThirdPartyServiceEntityInterface
   */
  protected $entity;


  /**
   * {@inheritdoc}
   */
  public function vanish(&$content) {
    $scripts = [];
    $scripts['begin'] = '<script type="text/javascript">';


    $services = array();
    $query = new \EntityFieldQuery();
    $query->entityCondition('entity_type', 'third_party_service')
      ->propertyCondition('enabled', true);

    $result = $query->execute();


    if (isset($result['third_party_service'])) {
      $news_items_nids = array_keys($result['third_party_service']);
      $services = entity_load('third_party_service', $news_items_nids);
    }

    /* $services = $this
       ->entityTypeManager
       ->getStorage('third_party_service')
       ->loadByProperties(['enabled' => TRUE]);
 */
   
    foreach ($services as $service) {
      // Check if the vanisher configured to use exists.
      if (!$this->hasVanisher($service->getVanisher())) {
        // TODO: Log warning.
        continue;
      }

      $vanisher_name = $service->getVanisher();
      $vanisher_id = $vanisher_name . '.' . $service->getId();

      // The vanished script.
      $vanisher = $this->getVanisher($vanisher_name);
      $vanisher->setEntity($service);
      $script = $vanisher->vanish($content);

      if ($script) {
        $scripts[$vanisher_id] = $script;
      }
    }

    $scripts['end'] = '</script>';

    // Add all replaced scripts to before the end of the body.
    if (count($scripts) > 2) {
      $content = str_replace('</body>', implode("\n", $scripts) . "\n" . '</body>', $content);
    }

    return $content;
  }

  /**
   * Adds a new third party service vanisher to the list of registered vanisher.
   *
   * @param \Drupal\blizz_vanisher\Service\ThirdPartyServicesVanisherInterface $vanisher
   *   The third party service vanisher to add.
   */
  public function add(ThirdPartyServicesVanisherInterface $vanisher) {
    $this->vanisher[$vanisher->getVanisherName()] = $vanisher;
  }

  /**
   * Returns all installed vanisher.
   *
   * @return \Drupal\blizz_vanisher\Service\ThirdPartyServicesVanisherInterface[]
   *   An array of installed vanisher.
   */
  public function getInstalled() {
    return $this->vanisher;
  }


  /**
   * Returns all installed vanisher.
   *
   * @return \Drupal\blizz_vanisher\Service\ThirdPartyServicesVanisherInterface[]
   *   An array of installed vanisher.
   */
  public function getInstalledVanisherNames() {
    $all = array();
    foreach($this->vanisher as $vanish){
     $all[$vanish->getVanisherName()] = (string)$vanish;
    }
    return $all;
  }

  /**
   * Finds a string by regex pattern in the content.
   *
   * @param string $pattern
   *   The regex pattern.
   * @param string $content
   *   The content.
   *
   * @return array
   *   An array of the found strings.
   */
  public function findInContent($pattern, $content) {
    $matches = [];
    $ret = preg_match_all($pattern, $content, $matches);
    if ($ret !== FALSE && $ret > 0) {
      return $matches[1];
    }

    return [];
  }

  /**
   * Returns an array with all scripts.
   *
   * @param string $html
   *   The html string containing the scripts.
   *
   * @return array
   *   The detected scripts.
   */
  protected function getAllScripts($html) {
    $scripts = [];
    preg_match_all('/<script.*?>.*?<\/script>/s', $html, $scripts);

    return reset($scripts);
  }

  /**
   * Removes the script from the content.
   *
   * @param string $script
   *   The script to remove.
   * @param string $content
   *   The content.
   *
   * @return string
   *   The content without the script.
   */
  protected function removeScript($script, $content) {
    return str_replace($script, '', $content);
  }

  /**
   * Returns the script that contains the string to search for.
   *
   * @param string $search_string
   *   The string used to identify the script.
   * @param array $scripts
   *   An array with scripts.
   *
   * @return string
   *   The content of the found script.
   */
  protected function getScript($search_string, array $scripts) {
    foreach ($scripts as $script) {
      if (stristr($script, $search_string)) {
        return $script;
      }
    }

    return NULL;
  }

  /**
   * Returns the script that contains the string to search for.
   *
   * @param string $search_string
   *   The string used to identify the script.
   * @param array $scripts
   *   An array with scripts.
   *
   * @return array
   *   The found scripts.
   */
  protected function getScripts($search_string, array $scripts) {
    $matching_scripts = array();

    foreach ($scripts as $script) {
      if (stristr($script, $search_string)) {
        $matching_scripts[] = $script;
      }
    }

    return $matching_scripts;
  }

  /**
   * Checks if the vanisher requested is installed.
   *
   * @param string $vanisher_name
   *   The name of the vanisher.
   *
   * @return bool
   *   TRUE if the vanisher is installed, otherwise FALSE.
   */
  private function hasVanisher($vanisher_name) {
    return $this->getVanisher($vanisher_name) ? TRUE : FALSE;
  }

  /**
   * Returns the vanisher by its name.
   *
   * @param string $vanisher_name
   *   The vanisher name.
   *
   * @return \Drupal\blizz_vanisher\Service\ThirdPartyServicesVanisher|null
   *   The installed vanisher or NULL.
   */
  public function getVanisher($vanisher_name) {
    return $this->vanisher[$vanisher_name];
  }

  /**
   * Sets the current third party services entity.
   *
   * @param \Drupal\blizz_vanisher\Entity\ThirdPartyServiceEntityInterface $entity
   *   The current third party services entity.
   */
  public function setEntity(ThirdPartyServiceEntityInterface $entity) {
    $this->entity = $entity;
  }

  /**
   * Returns entity.
   *
   * @return \Drupal\blizz_vanisher\Entity\ThirdPartyServiceEntityInterface
   *   The current third party services entity.
   */
  public function getEntity() {
    return $this->entity;
  }

}