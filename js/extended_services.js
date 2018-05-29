// GPSies.com
tarteaucitron.services.gpsies = {
  "key": "gpsies",
  "type": "other",
  "name": "GPSies.com",
  "uri": "http://www.gpsies.com/page.do?page=privacy",
  "needConsent": true,
  "cookies": [],
  "js": function () {
    "use strict";
    tarteaucitron.fallback(['tac_iframe'], function (x) {
      var width = x.getAttribute("width"),
          height = x.getAttribute("height"),
          url = x.getAttribute("data-url");

      return '<iframe src="' + url + '" width="' + width + '" height="' + height + '" frameborder="0" scrolling="no" allowtransparency allowfullscreen></iframe>';
    });
  },
  "fallback": function () {
    "use strict";
    var id = 'iframe';
    tarteaucitron.fallback(['tac_iframe'], function (elem) {
      elem.style.width = elem.getAttribute('width') + 'px';
      elem.style.height = elem.getAttribute('height') + 'px';
      return tarteaucitron.engage(id);
    });
  }
};

// matomo
tarteaucitron.services.matomo = {
  "key": "matomo",
  "type": "analytic",
  "name": "Matomo (formerly known as Piwik)",
  "uri": "https://matomo.org/faq/general/faq_146/",
  "needConsent": true,
  "cookies": ['_pk_ref', '_pk_cvar', '_pk_id', '_pk_ses', '_pk_hsr', 'piwik_ignore', '_pk_uid'],
  "js": function () {
    "use strict";
    if (tarteaucitron.user.matomoId === undefined) {
      return;
    }

    window._paq = window._paq || [];
    window._paq.push(["setSiteId", tarteaucitron.user.matomoId]);
    window._paq.push(["setTrackerUrl", tarteaucitron.user.matomoHost + "piwik.js"]);

    if (typeof tarteaucitron.user.matomoParameters === 'function') {
      tarteaucitron.user.matomoParameters();
    }

    tarteaucitron.addScript(tarteaucitron.user.matomoHost + 'piwik.js', '', '', true, 'defer', 'defer');
  }
};
