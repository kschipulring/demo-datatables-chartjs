<?php
require_once __DIR__ . '/vendor/autoload.php';

$env_file = $_SERVER["HTTP_HOST"] == "localhost" ? 'local' : 'live';

$dotenv = Dotenv\Dotenv::create(__DIR__, "{$env_file}.env");
$dotenv->load();
