<?php
/**
 * 当前用户发送文章
 */
	header("Content-type:text/html;charset=utf-8"); 
	require_once("mysql_function.php");
	session_start();
	$content=$_POST['content'];
	$username=$_SESSION['username'];
	$sql="insert into article(username,art_content,cur_time,likes) values('{$username}','{$content}',now(),'0')";
	$conn=db_connect();
	$result=$conn->query($sql);
	if (!$result) {
		return false;
	}
?>