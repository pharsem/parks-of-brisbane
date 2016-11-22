<?php

$host = "localhost";
$db = "petthar_parks";
$user = "petthar_parks";
$pass = "12321";

try {
    $dbh = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}


