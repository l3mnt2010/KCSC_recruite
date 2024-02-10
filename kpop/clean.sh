#!/usr/local/bin/php

<?php
$host = "mysql-db";
$port = 3306;
$username_db = "KCSC";
$password_db = "REDACTED";
$database = "KCSC_TTV";

$conn = new mysqli($host, $username_db, $password_db, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("DELETE FROM logs");
?>