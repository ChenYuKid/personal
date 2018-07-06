<?php
/**
 * 检测用户合法性
 */
	function check_user_valid(){
		if (isset($_COOKIE['username'])||isset($_SESSION['username'])) {
			if (isset($_COOKIE['username'])) {
				$_SESSION['username']=$_COOKIE['username'];
			}
		}else {
			header("location:background.php?error=4");
			exit();
		}
	}
?>