<?php

use Core\Request;
use Core\Route;
use Dotenv\Dotenv;

require_once getcwd().'/../vendor/autoload.php';

require_once getcwd().'/../core/helpers.php';

require_once getcwd().'/../app/routes.php';

$dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/../');
$dotenv->safeLoad();

echo Route::find(Request::getUrl(), Request::getMethod());
