# blizz_vanisher
Please note that this module is released in Backdrop Contrib
for reference purposes. A new version with the name
GDPR Cookies is being published for use in Backdrop.

This module aims to help site administrators follow the guidelines of 
the "General Data Protection Regulation" (GDPR) regarding user 
tracking and integration of third party content.

Blizz Vanisher lets you prevent scripts and embedded content 
(e.g. videos) from being rendered until the user has given their
consent to do so.

Please note that installing and using this module does not mean your 
website becomes GDPR compliant.

## Details
The new European "General Data Protection Regulation" (GDPR) decrees 
that the well-known yet simple "This website uses cookies" banner is 
no longer sufficient and aims to provide for more transparency on the 
use of the website visitor's data.

As part of the new regulation websites are not allowed to set 
ANY cookie without explicit consent of the visitor. What first deems 
to be not that great an issue becomes a real problem when it comes to 
the integration of third party content - because website operators are 
also responsible for potential data usage by third parties.

## Does your website use
+ Google Analytics?
+ Youtube videos?
+ Vimeo videos?
+ Google Webfonts?
+ Twitter plugins?
+ Facebook plugins?
+ Or any other content integrated via CDNs?

Then you have to explicitly get the visitor's permission to integrate 
these services into your website - BEFORE any integration actually happens!

Blizz Vanisher integrates the cookie manager script "tarteaucitron.js",
which elegantly provides customization features to the website's 
end user and does all the heavy lifting for you. Simply install 
the module, configure the services needed and you're done.

When configured, Blizz Vanisher in conjunction with tarteaucitron.js 
prevents external services from being integrated into your website 
without proper consent.

This initial port to Backdrop is from Drupal release 7.x-1.3.
The included tarteaucitron scripts have been replaced with the
current versions (15-Aug-18).

## Dependencies
In Backdrop this module is dependent on the Entity Plus module that
provides some entity functions omitted from core. The tarteaucitron
library of scripts is included in the module.

## Installation
- Install this module using the official Backdrop CMS instructions at
  https://backdropcms.org/guide/modules.
- Use the configuration page at admin/config/system/gdpr_cookies/settings
 to control which services are needed to be processed via Blizz Vanisher.
 
## License
 This project is GPL v2 software. See the LICENSE.txt 
 file in this directory for complete text.

## References and Credits
+ https://github.com/AmauriC/tarteaucitron.js
+ https://opt-out.ferank.eu/en/
+ 'The GDPR is here' - https://www.youtube.com/watch?v=CyIFNsSHPxQ

### Port to Backdrop

+ Graham Oliver (github.com/Graham-72)

### Maintainers of Blizz Vanisher for Drupal:

+ Lars Rosenberg (rackberg)
+ Christian Lamine (CHiLi.HH)
+ marvin_B8

### Acknowledgement

This port to Backdrop would not, of course, be possible without all
the work done by the developers and maintainers of the Drupal module.
