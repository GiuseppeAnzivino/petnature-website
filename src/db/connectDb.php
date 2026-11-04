<?php
    $host = getenv('DB_HOST') ?: 'localhost';
    $port = getenv('DB_PORT') ?: '5432';
    $dbname = getenv('DB_NAME') ?: 'Gruppo07';
    $username = getenv('DB_USER') ?: 'postgres';
    $password = getenv('DB_PASS') ?: '';


    $conn="host=$host port=$port dbname=$dbname user=$username password=$password";
    $db = pg_connect($conn) or die("Impossibile connettersi");

    session_start();
?>