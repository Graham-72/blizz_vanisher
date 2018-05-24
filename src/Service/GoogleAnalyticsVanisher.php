<?php

namespace Drupal\blizz_vanisher\Service;

/**
 * Class GoogleAnalyticsVanisher.
 *
 * @package Drupal\blizz_vanisher\Service
 */
class GoogleAnalyticsVanisher extends ThirdPartyServicesVanisher implements ThirdPartyServicesVanisherInterface {

  const REPLACE_SCRIPT = 'tarteaucitron.user.gajsUa = \'UA-XXXXXXXX-X\';
        tarteaucitron.user.gajsMore = function () { /* add here your optionnal _ga.push() */ };
        (tarteaucitron.job = tarteaucitron.job || []).push(\'gajs\');';

  /**
   * GoogleAnalyticsVanisher constructor.
   */
  public function __construct() {
  }

  /**
   * {@inheritdoc}
   */
  public function vanish(&$content) {
    $replace_script = NULL;

    $script = $this->getScript('GoogleAnalyticsObject', $this->getAllScripts($content));
    if ($script) {
      $account_id = $this->getAccountId($script);

      // Remove the original script.
      $content = $this->removeScript($script, $content);

      $replace_script = str_replace('UA-XXXXXXXX-X', $account_id, self::REPLACE_SCRIPT);
    }

    return $replace_script;
  }

  /**
   * Returns the account id from the script.
   *
   * @param string $script
   *   The script.
   *
   * @return string
   *   The google analytics account id.
   *
   * @throws \Exception
   *   When no account id could be found in the script.
   */
  public function getAccountId($script) {
    $matches = [];
    if (FALSE === preg_match('~"(UA.*?)"~s', $script, $matches)) {
      throw new \Exception('Could not find account id in google analytics script.');
    }

    return $matches[1];
  }

  /**
   * Returns the vanisher name.
   *
   * @return string
   *   The vanisher name.
   */
  public function getVanisherName() {
    return 'google_analytics_vanisher';
  }

  /**
   * Returns the name of this vanisher.
   *
   * @return string
   *   The name of this vanisher.
   */
  public function __toString() {
    return 'Google Analytics Vanisher';
  }

}
