<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// The Laravel application lives in ./pantheraa (kept out of the public web root,
// except this front controller + the static build/ images/ assets beside it).
$appDir = __DIR__.'/pantheraa';

// Maintenance mode...
if (file_exists($maintenance = $appDir.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoloader...
require $appDir.'/vendor/autoload.php';

// Bootstrap Laravel...
/** @var Application $app */
$app = require_once $appDir.'/bootstrap/app.php';

// This folder (the web root) holds the public assets — build/, images/, uploads/,
// favicon — so tell Laravel to treat it as the public path.
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
