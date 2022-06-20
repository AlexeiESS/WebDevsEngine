<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if(isset($_POST['goinstl']))
{
	$host = $_POST['host'];
	$user = $_POST['user'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$config = '$config';
	$instalcfgtobd = "<?php $config = array('db_host'     => '".$host."' , 'db_user'     => '".$user."' , 'db_pass'     => '".$password."' , 'db_name'     => '".$name."',); ?>";
	mkdir("../configs", 0700);
	$fp = fopen("../configs/config.php", "w");
	fwrite($fp, $instalcfgtobd);
	chmod("../configs/config.php", 0400);
	fclose($fp);
	require_once('../configs/config.php');
	if(!$link = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']))
	{
		header ('Location: ../install.html');
		die(mysqli_connect_error());
	}
	else
	{
		$fh = fopen('../install.html', 'a');
		unlink('../install.html');
		fclose($fh);
		mysqli_close($link);
		header ('Location: ../admincreate.html');
	}
}
if(isset($_POST['lastinstl']))
{
	if($_POST['password1']==$_POST['password2'])
	{
		require_once("installfunc.php");
		createtabelsmysql();
		addadmin($_POST['login'],$_POST['password1']);
		installdelete();
	}
}
?>
