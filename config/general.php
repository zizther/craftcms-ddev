<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 */

use craft\helpers\App;

// The site basepath
define('BASEPATH', realpath(dirname(__FILE__) . '/../') . '/');

// The site URL
define('SITEURL', rtrim(App::env('PRIMARY_SITE_URL'), '/'));

$env = APP::env('CRAFT_ENVIRONMENT');
$isDev = $env === 'dev';
$isProd = $env === 'production';

return [
    // Global settings
    '*' => [
        // Aliases / ENV variables
        'aliases' => [
            '@baseUrl' => SITEURL,
            '@basePath' => BASEPATH,
            '@web' => SITEURL,
            '@webroot' => dirname(__DIR__) . '/web',
        ],

        // Whether administrative changes should be allowed
        'allowAdminChanges' => $isDev,

        // Cache duration
	    'cacheDuration' => 'P3M',

        // Ascii character support - Also related to limitAutoSlugsToAscii
        'convertFilenamesToAscii' => true,

        // Control Panel trigger word
        'cpTrigger' => APP::env('CRAFT_CP_TRIGGER') ?: 'admin',

        // Default search term options
        'defaultSearchTermOptions' => [
            'subLeft' => true,
            'subRight' => true,
        ],

        // Default Week Start Day (0 = Sunday, 1 = Monday...)
        'defaultWeekStartDay' => 0,

        // Whether Dev Mode should be enabled (see https://craftcms.com/guides/what-dev-mode-does)
        'devMode' => $isDev,

        // Whether crawlers should be allowed to index pages and following links
        'disallowRobots' => !$isProd,

        // Template caching
        'enableTemplateCaching' => !$isDev,

        // Generate image transform before page load
        'generateTransformsBeforePageLoad' => false,

        // Ascii character support - Also related to convertFilenamesToAscii
        'limitAutoSlugsToAscii' => true,

        // Max file upload size
	    'maxUploadFileSize' => 5242880, // 5mb

        // Max revisions
        'maxRevisions' => 5,

        // Whether generated URLs should omit "index.php"
        'omitScriptNameInUrls' => true,

        // Redirect to path after CP login.
        'postCpLoginRedirect' => 'entries',

        // The SameSite (opens new window)value that should be set on Craft cookies, if any.
        // This can be set to 'Lax', 'Strict', or null.
        'sameSiteCookieValue' => 'Lax',

        // Remove Craft from header request
		// Services won't be able to detect what CMS is being used
		'sendPoweredByHeader' => false,

        // Use email as username
        'useEmailAsUsername' => true,
    ],

    // Dev environment settings
    'dev' => [
        // Member login info duration
		// http://www.php.net/manual/en/dateinterval.construct.php
		'userSessionDuration'           => 'P1Y',
		'rememberedUserSessionDuration' => 'P1Y',
		'rememberUsernameDuration'      => 'P1Y',
    ],
];
