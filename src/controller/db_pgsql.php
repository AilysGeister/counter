<?php
require_once __DIR__ . '/DataBase.php';

/**
 * Work with a PostgreSQL database.
 */
class db_pgsql extends DataBase {
    var $connection = null;

    function __construct() {
        $this->connection = pg_connect("host=127.0.0.1 dbname=counter_troll user=user password=password");

        var_dump($this->connection);
        //$conn_string = "host=".$_ENV["DB_HOST"]." port=".$_ENV["DB_PORT"]." dbname=".$_ENV["DB_NAME"]." user=".$_ENV["DB_USER"]." password=".$_ENV["DB_PASSWORD"];
        //$this->connection = pg_connect($conn_string);
    }

    function query($query): false | \PgSql\Result {
        return pg_query($this->connection, $query);
    }
}