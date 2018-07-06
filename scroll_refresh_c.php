<?php
/**
 * 获取当前文章的评论信息
 */
	header("Content-type:text/html;charset=utf-8");
	require_once("mysql_function.php");
	session_start();
	$username=$_SESSION['username'];
	$art_id=$_GET['c_art_id'];
	$conn=db_connect();

	$comm_info=select_user_comments($art_id);
	if ($comm_info->num_rows>0) {
		for ($j=0; $j < $comm_info->num_rows; $j++) { 
			$user_comm_info=$comm_info->fetch_array();

			$com_thumb_result=select_com_thumb($user_comm_info['com_id'],$username);
			if($com_thumb_result->num_rows>0) 
				$com_thumb=1;
			else 
				$com_thumb=0;
				
			$arr_list[$j]=array(
				"username"=>$user_comm_info['username'],
				"com_id"=>$user_comm_info['com_id'],
				"com_content"=>$user_comm_info['com_content'],
				"cur_time"=>$user_comm_info['cur_time'],
				"likes"=>$user_comm_info['likes'],
				"user_img"=>$user_comm_info['user_img'],
				"com_is_thumb"=>$com_thumb
			);
		}
	}else{
		$arr_list='';
	}

	//echo "<pre>";print_r($arr_list);echo "<pre>";
	echo json_encode($arr_list);
?>