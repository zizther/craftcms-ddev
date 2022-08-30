<?php
/**
 * Database Configuration
 *
 * All of your system's database connection settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/DbConfig.php.
 *
 * @see craft\config\DbConfig
 */

use craft\helpers\App;

return [
    'dsn' => App::env('DB_DSN') ?: null,
    'driver' => getenv('CRAFT_DB_DRIVER'),
    'server' => getenv('CRAFT_DB_SERVER'),
    'port' => getenv('CRAFT_DB_PORT'),
    'user' => getenv('CRAFT_DB_USER'),
    'password' => getenv('CRAFT_DB_PASSWORD'),
    'database' => getenv('CRAFT_DB_DATABASE'),
    'schema' => getenv('CRAFT_DB_SCHEMA'),
    'tablePrefix' => getenv('CRAFT_DB_TABLE_PREFIX')
];
