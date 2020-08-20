<?php
require 'environment.php';

global $config;
$config = array();

if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/workshop-api/");
	$config['dbname'] = 'workshop';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
	$config['jwt_secret_key'] = 'abC123';
} else {
	define("BASE_URL", "http://localhost/workshop-api/");
	$config['dbname'] = 'workshop';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
	$config['jwt_secret_key'] = 'abC123';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}