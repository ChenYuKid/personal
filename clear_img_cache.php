<?php
/**
 * 清除服务器保存的用户图片
 */
	$clear_img_src=$_POST['clear_img_src'];
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		if (!empty($clear_img_src)) {
			unlink($clear_img_src);
		}
	}
?>