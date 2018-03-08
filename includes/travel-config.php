<?php
//DB connection setup from lab6 thank you Randy
error_reporting(E_ALL);
ini_set('display_errors','1');

$ip = getenv('IP');
$port = '3306';

define('DBCONNECTION', "mysql:host=$ip;port=$port;dbname=travel;charset=utf8mb4;");
define('DBUSER', getenv('C9_USER'));
define('DBPASS', '');

spl_autoload_register(function ($class) {
 $file = 'classes/'.$class .'.class.php';
 if (file_exists($file))
 include $file;
});

$connection = DatabaseHelper::createConnection(array(DBCONNECTION,DBUSER,DBPASS));
?>