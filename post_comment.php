<?php
/**
 * 当前用户发送评论
 */
	header("Content-type:text/html;charset=utf-8"); 
	require_once("mysql_function.php");
	session_start();
	$content=$_POST['content'];
	$art_id=$_POST['art_id'];
	$username=$_SESSION['username'];
	$sql="insert into comments(art_id,username,com_content,cur_time,likes) values('{$art_id}','{$username}','{$content}',now(),'0')";
	$conn=db_connect();
	$result=$conn->query($sql);
	if (!$result) {
		return false;
	}
	$com_id=mysqli_insert_id($conn);

	$com_sql="select c.username,c.com_id,c.com_content,c.cur_time,c.likes,u.user_img from comments c,user u where c.username=u.username and c.username='".$username."' and c.com_id='".$com_id."'";
	$com_result=$conn->query($com_sql);
	if (!$com_result) {
		return false;
	}
	$com_result=$com_result->fetch_array();
	$user_com=array(
		"username"=>$com_result['username'],
		"com_id"=>$com_result['com_id'],
		"com_content"=>$com_result['com_content'],
		"cur_time"=>$com_result['cur_time'],
		"likes"=>$com_result['likes'],
		"user_img"=>$com_result['user_img']
	);
	
	echo json_encode($user_com);
?>