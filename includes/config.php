<?php
    $server = "ict726_tutorial6-db-1";
    $username = "root";
    $password = "root";
    $database = "testdb";

    $db_conn = new mysqli($server, $username, $password, $database);

    if($db_conn->connect_error) {
        die("Connection Failed: " . $db_conn->connect_error);
    }

    require(SITE_ROOT . "/models/schema.php");
    $database_schema = new DatabaseSchema($db_conn);
    $database_schema->createAllTables();
?>