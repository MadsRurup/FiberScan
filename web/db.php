<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With,Content-Type, Authorization");

$server = "mysql98.unoeuro.com";
$database = "fiberlaser_syd_dk_db_web";
$username = "fiberlaser_syd_dk";
$password = "6w9bkHcApxam4En32RDF";
$pdo = new PDO("mysql:host=$server;dbname=$database", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
?>