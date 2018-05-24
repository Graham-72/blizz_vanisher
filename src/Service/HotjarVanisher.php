<?php

namespace Drupal\blizz_vanisher\Service;

/**
 * Class HotjarVanisher.
 *
 * @package Drupal\blizz_vanisher\Service
 */
class HotjarVanisher extends ThirdPartyServicesVanisher implements ThirdPartyServicesVanisherInterface {

  /**
   * {@inheritdoc}
   */
  public function vanish(&$content) {
    $replaced_script = NULL;
    $script = $this->getScript('window,document,\'https://static.hotjar.com/c/hotjar-\'', $this->getAllScripts($content));

    if ($script) {
      $hjsv = $this->getHjsv($script);
      $hjid = $this->getHjid($script);

      if ($hjsv && $hjid) {
        $replaced_script = $this->getReplacementScript($hjsv, $hjid);

        // Remove the original script.
        $content = $this->removeScript($script, $content);
      }
    }

    return $replaced_script;
  }

  /**
   * Returns the replacement script.
   *
   * @param string $gtm_id
   *   The google tag manager id.
   *
   * @return string
   *   The replacement script.
   */
  public function getReplacementScript($hjsv , $hjid) {
    return 'tarteaucitron.user.hotjarId = \'' . $hjid . '\';
    tarteaucitron.user.hotjarsv = \'' . $hjsv . '\';
        (tarteaucitron.job = tarteaucitron.job || []).push(\'hotjar\');';
  }

  /**
   * Returns the Hotjar id.
   *
   * @param string $script
   *   The script containing the Hotjar id.
   *
   * @return string
   *   The Hotjar ID.
   *
   * @throws \Exception
   *   When no Hotjar ID has been found.
   */
  protected function getHjid($script) {
    $matches = [];
    if (FALSE === preg_match("/hjid\:(.*?)\,/s", $script, $matches)) {
      throw new \Exception('Could not find google tag manager id in script.');
    }
    return $matches[1];
  }

  /**
   * Returns the Hotjar SV.
   *
   * @param string $script
   *   The script containing the Hotjar SV.
   *
   * @return string
   *   The Hotjar SV.
   *
   * @throws \Exception
   *   When no Hotjar SV has been found.
   */
  protected function getHjsv($script) {
    $matches = [];
    if (FALSE === preg_match("/hjsv\:(.*?)}/s", $script, $matches)) {
      throw new \Exception('Could not find Hotjar SV  in script.');
    }
    return $matches[1];
  }

  /**
   * {@inheritdoc}
   */
  public function getVanisherName() {
    return 'hotjar_vanisher';
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return 'Hotjar';
  }

}
