<?php
use Dotenv\Dotenv;

//Setup the environ:
require 'vendor/autoload.php';

$env = Dotenv::createImmutable(__DIR__);
$env->load();
?>