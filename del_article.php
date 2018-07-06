<?php
/**
 * 级联删除当前登陆用户的文章
 */
	header("Content-type:text/html;charset=utf-8"); 
	require_once("mysql_function.php");
	$art_id=$_POST['art_id'];
	$conn=db_connect();
	$del_sql="delete from article where art_id='".$art_id."'";
	$result=$conn->query($del_sql);
	if (!$result) {
		return false;
	}
?>