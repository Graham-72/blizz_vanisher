<?php

class BlizzFactory {

  static public $thirdpartyservices;

  public function createThirdPartyServicesVanisher() {
    if (BlizzFactory::$thirdpartyservices == NULL) {
      require_once('Service/ThirdPartyServicesVanisherInterface.php');
      require_once('Service/IframeVanisherInterface.php');
      require_once('Service/IframeVanisher.php');
      require_once('Service/ThirdPartyServicesVanisher.php');
      require_once('Service/EmbeddedVideoVanisher.php');
      require_once('Service/FacebookCommentsVanisher.php');
      require_once('Service/FacebookFriendboxVanisher.php');
      require_once('Service/FacebookLikesVanisher.php');
      require_once('Service/GoogleAnalyticsVanisher.php');
      require_once('Service/GoogleDoubleClickVanisher.php');
      require_once('Service/GoogleMapsVanisher.php');
      require_once('Service/GoogleTagManagerVanisher.php');
      require_once('Service/GpsiesVanisher.php');
      require_once('Service/HotjarVanisher.php');
      require_once('Service/MatomoVanisher.php');
      require_once('Service/TwitterTimelineVanisher.php');
      require_once('Service/VimeoVanisher.php');
      require_once('Service/YoutubeVanisher.php');


      $vanisher = new \Backdrop\blizz_vanisher\Service\ThirdPartyServicesVanisher();

      $vanisher->add(new \Backdrop\blizz_vanisher\Service\VimeoVanisher($vanisher));
      $vanisher->add(new \Backdrop\blizz_vanisher\Service\YoutubeVanisher($vanisher));
      $vanisher->add(new \Backdrop\blizz_vanisher\Service\GoogleAnalyticsVanisher());
      $vanisher->add(new \Backdrop\blizz_vanisher\Service\GoogleTagManagerVanisher());
      $vanisher->add(new \Backdrop\blizz_vanisher\Service\HotjarVanisher());
      $vanisher->add(new \Backdrop\blizz_vanisher\Service\GoogleDoubleClickVanisher());
      $vanisher->add(new \Backdrop\blizz_vanisher\Service\TwitterTimelineVanisher());
      $vanisher->add(new \Backdrop\blizz_vanisher\Service\MatomoVanisher());
      $vanisher->add(new \Backdrop\blizz_vanisher\Service\GoogleMapsVanisher($vanisher));

      BlizzFactory::$thirdpartyservices = $vanisher;
    }

    return BlizzFactory::$thirdpartyservices;


  }

}
