tarteaucitron.init({
  "hashtag": Drupal.settings.blizz_vanisher.hashtag, /* Automatically open the panel with the hashtag */
  "highPrivacy": Boolean(Drupal.settings.blizz_vanisher.highPrivacy), /* disabling the auto consent feature on navigation? */
  "orientation": Drupal.settings.blizz_vanisher.orientation, /* the big banner should be on 'top' or 'bottom'? */
  "adblocker": Boolean(Drupal.settings.blizz_vanisher.adblocker), /* Display a message if an adblocker is detected */
  "showAlertSmall": Boolean(Drupal.settings.blizz_vanisher.showAlertSmall), /* show the small banner on bottom right? */
  "cookieslist": Boolean(Drupal.settings.blizz_vanisher.cookieslist), /* Display the list of cookies installed ? */
  "removeCredit": Boolean(Drupal.settings.blizz_vanisher.removeCredit), /* remove the credit link? */
  "defaultRejected": Boolean(Drupal.settings.blizz_vanisher.defaultRejected) /* Should the services be rejected by default? */
});
