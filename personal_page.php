<?php
	header("Content-type: text/html; charset=utf-8");
	require_once('mysql_function.php');
	require_once('display_function.php');
	require_once('check_user.php');
	session_start();
	/*
		获取登陆用户数据，与数据库对比，并将用户名传入session中，作为用户凭证
		获取注册用户数据，插入到数据库中，并检测是否有重名
		检测当前用户是否存在，通过session或者客户端cookie，如果不存在则重新登陆
	*/
	if(@$_POST['account_name']!=''&&@$_POST['user_password']!=''){
		user_login($_POST['account_name'],$_POST['user_password']);
	}else if(@$_POST['register_name']!=''&&@$_POST['register_user_password']!=''){
		user_register($_POST['register_name'],$_POST['register_user_password']);
	}else{
		check_user_valid();
	}

	@$remember=$_POST['remember-check'];
	if (!empty($remember)) {
		session_id('123456');
		setcookie("username",$_SESSION['username'],time()+3600*24*7);
	}
	if (!empty($_SESSION['username'])) {
		$user_img=select_user_img($_SESSION['username']);
	}else $user_img='user_img.jpg';
	if (!empty($_COOKIE['username'])) {
		$user_img=select_user_img($_COOKIE['username']);
	}
	if (empty($user_img)) {
		$user_img='user_img.jpg';
	}

	display_header(@$username);
	display_top_bar($user_img);
	display_background_header($user_img);
/*通过后台查询数据库中用户动态内容，以及用户的信息，并且通过遍历循环输出用户发表的文章内容*/
	$result_info=select_user_info();
	@$rows=$result_info->num_rows;
	for ($i=0; $i < $rows; $i++) {
		$user_info=$result_info->fetch_array();
		$_SESSION['art_id']=$user_info['art_id'];

		$thumb_art_name=$_SESSION['username'];
		$result_thumb=select_thumb($user_info['art_id'],$thumb_art_name);

		display_background_content($user_info,$result_thumb,"隐藏");
/*查找数据库，通过循环遍历输出用户对当前文章的所有评论*/
		$result_com=select_user_comments($user_info['art_id']);
		@$rows_com=$result_com->num_rows;
		for ($j=0; $j < $rows_com; $j++) {
			$user_com=$result_com->fetch_array();

			$thumb_com_name=$_SESSION['username'];
			$result_com_thumb=select_com_thumb($user_com['com_id'],$thumb_com_name);

			display_background_comments($user_com,$result_com_thumb);
		}
		display_background_footer();
	}
	display_footer();
?>