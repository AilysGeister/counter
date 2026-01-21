<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

//Setup the environment:
$env = Dotenv::createImmutable(__DIR__);
$env->load();
?>
<h1>hello world</h1>
