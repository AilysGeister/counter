<?php
require_once __DIR__ . '/DataBase.php';

/**
 * Work with a My SQL database.
 */
class db_MySQL extends Database {

    private $connection;
     public function __construct() {
         $this->connection = new mysqli(
             $_ENV['DB_HOST'],
             $_ENV['DB_USER'],
             $_ENV['DB_PASSWORD'],
             $_ENV['DB_NAME'],
             (int)$_ENV['DB_PORT']);
     }

    public function query($query): bool | mysqli_result {
        return mysqli_query($this->connection, $query);
    }
}