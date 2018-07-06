<?php
/**
 * 用户更新账户信息
 */
	header("Content-type:text/html;charset=utf-8"); 
	require_once("mysql_function.php");
	session_start();
	$new_username=$_POST['new_username'];
	$new_password=$_POST['new_password'];
	$new_password=md5($new_password);
	$old_username=$_SESSION['username'];
	$update_sql="update user set username='".$new_username."',password='".$new_password."' where username='".$old_username."'";
	$conn=db_connect();
	$result=$conn->query($update_sql);
	if (!$result) {
		return false;
	}
	if (isset($_COOKIE['username'])) {
		setcookie("username",$new_username,time()+3600*24*7);
	}
	$_SESSION['username']=$new_username;
?>