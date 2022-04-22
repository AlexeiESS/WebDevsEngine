<?php
session_start();
require_once("../configs/config.php");
require_once("../mysql/mysql.php");
$conn = new mysql($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
function checkadmin($login, $password)
{
	global $conn;
	$conn->arr = $conn->fetchrow($conn->query("SELECT * FROM admins WHERE login = '".$conn->escape($login)."' AND password = '".md5(mb_strtolower($password))."'"));
	if(isset($conn->arr['password']))
	{
		return 1;
	}
	else {
		return 0;
	}
}
if(isset($_POST['start_logining_admin']))
{
	if(checkadmin($_POST['loginadm'],$_POST['passwordadm'])==1)
	{
		$_SESSION['admin'] = 1;
		header("Location: ../adminpanel/index.php");
	}
	else {
		header("Location: ../adminpanel/admin.html");
	}
}
?>