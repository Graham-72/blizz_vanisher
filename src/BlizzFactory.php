<?php

class BlizzFactory {

  static public $thirdpartyservices;

  public function createThirdPartyServicesVanisher() {
    if (BlizzFactory::$thirdpartyservices == NULL) {

      require_once('Service/ThirdPartyServicesVanisher.php');
      require_once('Service/ThirdPartyServicesVanisherInterface.php');
      require_once('Service/IframeVanisher.php');
      require_once('Service/EmbeddedVideoVanisher.php');

      require_once('Service/VimeoVanisher.php');
      require_once('Service/YoutubeVanisher.php');

      require_once('Service/GoogleMapsVanisher.php');

      require_once('Service/GoogleAnalyticsVanisher.php');
      require_once('Service/GoogleTagManagerVanisher.php');

      require_once('Service/HotjarVanisher.php');

      require_once('Service/GoogleDoubleClickVanisher.php');
      require_once('Service/TwitterTimelineVanisher.php');
      require_once('Service/MatomoVanisher.php');

      $vanisher = new \Drupal\blizz_vanisher\Service\ThirdPartyServicesVanisher();

      $vanisher->add(new \Drupal\blizz_vanisher\Service\VimeoVanisher($vanisher));
      $vanisher->add(new \Drupal\blizz_vanisher\Service\YoutubeVanisher($vanisher));
      $vanisher->add(new \Drupal\blizz_vanisher\Service\GoogleAnalyticsVanisher());
      $vanisher->add(new \Drupal\blizz_vanisher\Service\GoogleTagManagerVanisher());
      $vanisher->add(new \Drupal\blizz_vanisher\Service\HotjarVanisher());
      $vanisher->add(new \Drupal\blizz_vanisher\Service\GoogleDoubleClickVanisher());
      $vanisher->add(new \Drupal\blizz_vanisher\Service\TwitterTimelineVanisher());
      $vanisher->add(new \Drupal\blizz_vanisher\Service\MatomoVanisher());
      $vanisher->add(new \Drupal\blizz_vanisher\Service\GoogleMapsVanisher());

      BlizzFactory::$thirdpartyservices = $vanisher;
    }

    return BlizzFactory::$thirdpartyservices;


  }

}
