<?php

use craft\helpers\App;

return [
	'checkDevServer' => App::env('CRAFT_ENVIRONMENT') === 'dev',
	'devServerInternal' => 'http://localhost:3000',
	'devServerPublic' => Craft::getAlias('@web') . ':3000',
	'errorEntry' => 'src/js/app.js',
	'manifestPath' => Craft::getAlias('@webroot') . '/dist/.vite/manifest.json',
	'serverPublic' => Craft::getAlias('@web')  . '/dist/',
	'useDevServer' => App::env('CRAFT_ENVIRONMENT') === 'dev',
];
