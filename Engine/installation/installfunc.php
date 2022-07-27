<?php
require_once("../configs/config.php");
require_once("../mysql/mysql.php");
$conn = new mysql($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
function createtabelsmysql()
{
	global $conn;
	$conn->query("CREATE TABLE admins (id INTEGER AUTO_INCREMENT PRIMARY KEY, login VARCHAR(30), password VARCHAR(60));");
	$conn->query("CREATE TABLE users (id INTEGER AUTO_INCREMENT PRIMARY KEY, login VARCHAR(30), password VARCHAR(60), email VARCHAR(40));");
	$conn->query("CREATE TABLE template (id INTEGER AUTO_INCREMENT PRIMARY KEY, template VARCHAR(35));");
	return 1;
}
function addadmin($login, $password)
{
	global $conn;
	$conn->query("INSERT admins(id, login, password) VALUES (NULL, '$login', '".md5(mb_strtolower($password))."')");
	$conn->query("INSERT template(id, template) VALUES (NULL, 'default')");
	return 1;
}
function installdelete()
{
	unlink('installready.php');
	unlink('../admincreate.html');
	unlink('installfunc.php');
	header ('Location: ../adminpanel/admin.html');
}
?>