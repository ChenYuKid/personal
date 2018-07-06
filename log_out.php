<?php
/**
 * 登出当前用户
 */
	session_start();
	unset($_SESSION['username']);
	session_destroy();
	echo "<script>
		window.location.href='index.html';
	</script>";
?>