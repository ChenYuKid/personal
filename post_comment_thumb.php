<?php
/**
 * 当前用户发送对评论的点赞
 */
	header("Content-type:text/html;charset=utf-8"); 
	require_once("mysql_function.php");
	session_start();
	$com_id=$_POST['com_id'];
	$username=$_SESSION['username'];
	$sql_select="select com_id,username from thumb_com where com_id='".$com_id."'and username='".$username."'";
	$conn=db_connect();
	$result=$conn->query($sql_select);
	if (!$result) {
		return false;
	}
	if ($result->num_rows>0) {
		$sql_delete="delete from thumb_com where com_id='".$com_id."'and username='".$username."'";
		$result=$conn->query($sql_delete);
		if (!$result) {
			return false;
		}
		$sql_updata="update comments set likes=likes-1 where com_id='".$com_id."'";
		$result=$conn->query($sql_updata);
		if (!$result) {
			return false;
		}
	}else{
		$sql_insert="insert into thumb_com(com_id,username) values('{$com_id}','{$username}')";
		$result=$conn->query($sql_insert);
		if (!$result) {
			return false;
		}
		$sql_updata="update comments set likes=likes+1 where com_id='".$com_id."'";
		$result=$conn->query($sql_updata);
		if (!$result) {
			return false;
		}
	}
?>