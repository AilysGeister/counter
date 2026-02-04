<?php
require_once __DIR__ . '/controller/db_pgsql.php';
require_once __DIR__ . '/controller/db_MySQL.php';

use Dotenv\Dotenv;

function config(): void {
    //Setup the environment:
    $env = Dotenv::createImmutable(__DIR__.'/../');
    $env->load();

    //Connection to the database:
    switch ($_ENV['DB_CONNECTION']) {
        case "postgresql":
            $GLOBALS["database"] = new db_pgsql();
            break;
        case "mysql":
            $GLOBALS["database"] = new db_MySQL();
            break;
    }

    $GLOBALS["setup"]=true;
}
?>