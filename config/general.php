<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings at https://craftcms.com/docs/5.x/reference/config/general.html
 *
 * @see craft\config\GeneralConfig
 */

use craft\config\GeneralConfig;
use craft\helpers\App;

$isProd = getenv('CRAFT_ENVIRONMENT') === 'production';

// The site basepath
define('BASEPATH', dirname(__DIR__));

// The site URL
define('SITEURL', rtrim(App::env('PRIMARY_SITE_URL'), '/'));

return GeneralConfig::create()
    // Any custom Yii aliases(opens new window) that should be defined for every request.
    ->aliases([
        '@baseUrl' => SITEURL,
        '@basePath' => BASEPATH,
        '@web' => SITEURL,
        '@webroot' => BASEPATH . '/web',
        '@assetBaseUrl' => '@web/assets',
        '@assetBasePath' => '@webroot/assets',
    ])
    // Whether users should be allowed to create similarly-named tags.
    // E.G. `celebrations` and `Celebrations` / `christmas day` and `Christmas Day`
    ->allowSimilarTags(false)
    // Whether uppercase letters should be allowed in slugs.
    ->allowUppercaseInSlug(false)
    // Whether CSRF values should be injected via JavaScript for greater cache-ability.
    // Craft now sends no-cache headers for requests that generate/retrieve a CSRF token.
    // If your Craft install is behind a static caching service like Cloudflare,
    // enable the asyncCsrfInputs config setting to avoid a significant cache hit reduction.
    ->asyncCsrfInputs(true)
    // Auto login user after account activation
    ->autoLoginAfterAccountActivation(true)
    // The default length of time Craft will store data, RSS feed, and template caches.
    ->cacheDuration('P1M') // 1 months
    // Whether uploaded filenames with non-ASCII characters should be converted to ASCII (i.e. ñ → n).
    // Also related to limitAutoSlugsToAscii
    ->convertFilenamesToAscii(true)
    // The amount of time a user must wait before re-attempting to log in
    // after their account is locked due to too many failed login attempts.
    ->cooldownDuration('PT5M') // 5 minutes
    // The default options that should be applied to each search term.
    ->defaultSearchTermOptions([
        'subLeft' => true,
        'subRight' => true,
    ])
    // Default Week Start Day (0 = Sunday, 1 = Monday...)
    ->defaultWeekStartDay(0)
    // Whether crawlers should be allowed to index pages and following links
    ->disallowRobots(!$isProd)
    // Whether the GraphQL API should be enabled.
    ->enableGql(false)
    // List of additional file kinds Craft should support
    ->extraFileKinds([
        'svg' => [
            'label' => 'SVG',
            'extensions' => ['svg'],
        ]
    ])
    // Generate image transform before page load
    ->generateTransformsBeforePageLoad(true)
    // The URI Craft should redirect to when user token validation fails.
    // A token is used on things like setting and resetting user account passwords.
    //Note that this only affects front-end site requests.
    ->invalidUserTokenPath('nope')
    // Whether non-ASCII characters in auto-generated slugs should be converted to ASCII (i.e. ñ → n)
    // Also related to convertFilenamesToAscii
    ->limitAutoSlugsToAscii(true)
    // Login Path when using {% loginRequired %}
    ->loginPath('login')
    // The maximum number of revisions that should be stored for each element.
    ->maxRevisions(3)
    // Max file upload size
    ->maxUploadFileSize('10M')
    // Whether generated URLs should omit "index.php"
    ->omitScriptNameInUrls(true)
    // Redirect to path after CP login.
    ->postCpLoginRedirect('entries')
    // The maximum amount of memory Craft will try to reserve during memory-intensive operations such as zipping,
    //unzipping and updating. Defaults to an empty string, which means it will use as much memory as it can.
    ->phpMaxMemoryLimit(App::env('CRAFT_PHP_MAX_MEMORY_LIMIT'))
    // Preload Single entries as Twig variables
    ->preloadSingles()
    // The SameSite (opens new window) value that should be set on Craft cookies, if any.
    // This can be set to 'Lax', 'Strict', or null.
    ->sameSiteCookieValue('Lax')
    // Remove Craft from header request
    // Services won't be able to detect what CMS is being used
    ->sendPoweredByHeader(false)
    // Word separator
    ->slugWordSeparator('-')
    // The timezone of the site. If set, it will take precedence over the Timezone setting in Settings → General.
    ->timezone('Europe/London')
    // Whether GIF files should be cleansed/transformed.
    ->transformGifs(false)
    // Use email as username
    ->useEmailAsUsername(true)
    // Whether Craft should specify the path using PATH_INFO or as a query string parameter when generating URLs.
    ->usePathInfo(true);
