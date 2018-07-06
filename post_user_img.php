<?php
/**
 * 用户提交相片
 */
	require_once('mysql_function.php');
	session_start();
	$username=$_SESSION['username'];
	$img_src=$_POST['img_src'];
	$old_img_src=$_POST['old_img_src'];
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		if (!empty($img_src)) {
			$img=array();
			$img=explode("/", $img_src);
			$actual_image_name=$img[2];
			if (!empty($old_img_src)) {
				$old_img=array();
				$old_img=explode("/", $old_img_src);
				$old_image_name=$old_img[2];
				unlink('./upload_img/'.$old_image_name);
			}
			update_user_img($username,$actual_image_name);
		}
	}
?>