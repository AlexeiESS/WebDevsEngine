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
function select_template()
{
	if ($handle = opendir("../templates")) {
   	 while (false !== ($templates = readdir($handle))) {  
   	 			if(!is_dir($templates)){
    		        echo '<option name="'.$templates.'">'.$templates.'</option>';
  		 }
  	}
  	  closedir($handle); 
	}
}
function set_template($temp)
{
	global $conn;
	$conn->query("UPDATE template SET template = '$temp' WHERE id = '1'");
	return 1;
}






if(isset($_POST['change_template']))
{
	set_template($_POST['templates']);
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