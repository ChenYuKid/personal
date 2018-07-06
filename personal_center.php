<?php
	header("Content-type: text/html; charset=utf-8");
	require_once('mysql_function.php');
	require_once('display_function.php');
	require_once('check_user.php');
	session_start();
	$username=$_SESSION['username'];
	check_user_valid();
	display_header($username);
	$user_img=select_user_img($username);
	if (empty($user_img)) {
		$user_img='user_img.jpg';
	}
	display_top_bar($user_img);
	display_background_header($user_img);

	$result_info=select_auther_info($username);
	@$rows=$result_info->num_rows;
	for ($i=0; $i < $rows; $i++) {
		$user_info=$result_info->fetch_array();
		$_SESSION['art_id']=$user_info['art_id'];

		$thumb_art_name=$_SESSION['username'];
		$result_thumb=select_thumb($user_info['art_id'],$thumb_art_name);

		display_background_content($user_info,$result_thumb,"删除");
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