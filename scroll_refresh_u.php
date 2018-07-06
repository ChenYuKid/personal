<?php
/**
 * 获取所有用户的文章信息
 */
	header("Content-type:text/html;charset=utf-8");
	require_once("mysql_function.php");
	$page=$_GET['page'];
	$start=$page*5;
	session_start();
	$username=$_SESSION['username'];
	$conn=db_connect();
	$user_info="select user.username,user.user_img,article.art_id,article.art_content,article.cur_time,article.likes from user,article where user.username=article.username order by article.art_id desc limit $start,5";
	$result_info=$conn->query($user_info);
	if (!$result_info) {
		return false;
	}
	for ($i=0; $i < $result_info->num_rows; $i++) { 
		$user_art_info=$result_info->fetch_array();

		$user_thumb_result=select_thumb($user_art_info['art_id'],$username);
		if($user_thumb_result->num_rows>0) 
			$user_thumb=1;
		else 
			$user_thumb=0;
		
		$arr_list[$i]=array(
			"username"=>$user_art_info['username'],
			"user_img"=>$user_art_info['user_img'],
			"art_id"=>$user_art_info['art_id'],
			"art_content"=>$user_art_info['art_content'],
			"cur_time"=>$user_art_info['cur_time'],
			"likes"=>$user_art_info['likes'],
			"user_is_thumb"=>$user_thumb
		);
	}

	//echo "<pre>";print_r($arr_list);echo "<pre>";
	echo json_encode($arr_list);
?>