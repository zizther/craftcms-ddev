<?php

use craft\helpers\App;

return [
    '*' => [
        // The public-facing name of the plugin
        'pluginName' => 'SEO',

        // Should SEOmatic render metadata?
        'renderEnabled' => true,

        // Should SEOmatic render frontend sitemaps?
        'sitemapsEnabled' => true,

        // Should sitemaps be regenerated automatically?
        'regenerateSitemapsAutomatically' => true,

        // The server environment, either `live`, `staging`, or `local`
        'environment' => App::env('ENVIRONMENT'),

        // Should SEOmatic display the SEO Preview sidebar?
        'displayPreviewSidebar' => true,

        // Should SEOmatic display the SEO Analysis sidebar?
        'displayAnalysisSidebar' => true,

        // If `devMode` is on, prefix the <title> with this string
        'devModeTitlePrefix' => '&#x1f6a7; ',

        // The separator character to use for the `<title>` tag
        'separatorChar' => '|',

        // The max number of characters in the `<title>` tag
        'maxTitleLength' => 70,

        // The max number of characters in the `<meta name="description">` tag
        'maxDescriptionLength' => 160,

        // Controls whether SEOmatic will include the meta generator tag and X-Powered-By header
        'generatorEnabled' => false,

        // Controls whether SEOmatic will automatically add X-Robots-Tag, canonical, & Referrer-Policy to the http response headers.
        'headersEnabled' => true,

        // If you are using Site Groups to logically separate 'sister sites', turn this on.
        'siteGroupsSeparate' => true,

        // Controls whether SEOmatic will automatically add hreflang and og:locale:alternate tags.
        'addHrefLang' => true,
    ],
];