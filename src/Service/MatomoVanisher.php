<?php

namespace Drupal\blizz_vanisher\Service;

/**
 * Class MatomoVanisher.
 *
 * @package Drupal\blizz_vanisher\Service
 */
class MatomoVanisher extends ThirdPartyServicesVanisher implements ThirdPartyServicesVanisherInterface {

  /**
   * {@inheritdoc}
   */
  public function vanish(&$content) {
    $replaced_script = [];
    $script = $this->getScript('piwik.php', $this->getAllScripts($content));

    if ($script) {
      $data = $this->getData($script);

      if ($data) {
        $replaced_script = $this->getReplacementScript($data);

        // Remove the original script.
        $content = $this->removeScript($script, $content);

        // Remove the piwik script loaded by the piwik module if installed.
        $content = $this->removeByRegex('~(<script.*?piwik\.js.*?><\/script>)~i', $content);
      }
    }

    $replaced_script[] = '(tarteaucitron.job = tarteaucitron.job || []).push(\'matomo\');';

    return implode("\n", $replaced_script);
  }

  /**
   * Returns the matomo data.
   *
   * @param string $script
   *   The matomo script.
   *
   * @return array
   *   The matomo data.
   */
  protected function getData($script) {
    $matches = [];
    $ret = preg_match_all('~(\/\/.*?)"|"setSiteId", "(\d+)"~is', $script, $matches);
    if ($ret !== FALSE && $ret > 0) {
      return [
        'matomo_host' => $matches[1][0],
        'matomo_id' => $matches[2][2],
      ];
    }

    return [];
  }

  /**
   * Returns the replacement script.
   *
   * @param array $data
   *   The matomo data.
   *
   * @return string
   *   The replacement script.
   */
  public function getReplacementScript(array $data) {
    return <<< EOF
tarteaucitron.user.matomoId = '{$data['matomo_id']}';
    tarteaucitron.user.matomoHost = '{$data['matomo_host']}';
EOF;
  }

  /**
   * Returns the vanisher name.
   *
   * @return string
   *   The vanisher name.
   */
  public function getVanisherName() {
    return 'matomo_vanisher';
  }

  /**
   * Returns the name of this vanisher.
   *
   * @return string
   *   The name of this vanisher.
   */
  public function __toString() {
    return 'Matomo Vanisher';
  }

}
