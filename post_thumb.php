<?php
/**
 * 当前用户发送对文章的点赞
 */
	header("Content-type:text/html;charset=utf-8"); 
	require_once("mysql_function.php");
	session_start();
	$art_id=$_POST['art_id'];
	$username=$_SESSION['username'];
	$sql_select="select art_id,username from thumb_art where art_id='".$art_id."'and username='".$username."'";
	$conn=db_connect();
	$result=$conn->query($sql_select);
	if (!$result) {
		return false;
	}
	if ($result->num_rows>0) {
		$sql_delete="delete from thumb_art where art_id='".$art_id."'and username='".$username."'";
		$result=$conn->query($sql_delete);
		if (!$result) {
			return false;
		}
		$sql_updata="update article set likes=likes-1 where art_id='".$art_id."'";
		$result=$conn->query($sql_updata);
		if (!$result) {
			return false;
		}
	}else{
		$sql_insert="insert into thumb_art(art_id,username) values('{$art_id}','{$username}')";
		$result=$conn->query($sql_insert);
		if (!$result) {
			return false;
		}
		$sql_updata="update article set likes=likes+1 where art_id='".$art_id."'";
		$result=$conn->query($sql_updata);
		if (!$result) {
			return false;
		}
	}
?>