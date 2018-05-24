<?php

namespace Drupal\blizz_vanisher\Service;

/**
 * Class GpsiesVanisher.
 *
 * @package Drupal\blizz_vanisher\Service
 */
class GpsiesVanisher extends IframeVanisher {

  /**
   * {@inheritdoc}
   */
  protected function getIframeSearchRegexPattern() {
    return '~(<iframe.*?src=([\'"])(.*?www\.gpsies\.com.*?)\2.*><\/iframe>)~is';
  }

  /**
   * {@inheritdoc}
   */
  protected function getIframeName() {
    return 'gpsies';
  }

  /**
   * {@inheritdoc}
   */
  protected function getIframePrivacyUrl() {
    return 'http://www.gpsies.com/page.do?page=privacy';
  }

  /**
   * {@inheritdoc}
   */
  protected function getIframeCookies() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getVanisherName() {
    return 'gpsies_vanisher';
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return 'Gpsies Vanisher';
  }

}
