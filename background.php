<?php
	session_start();
	$username=@$_COOKIE['username'];
	if (!empty(@$username)) {
		header("location:personal_page.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>background - 尘宇kid</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/background.js"></script>
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="./css/reset_css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./css/background.css">
</head>
<body>
	<div id="wrapper">
		<div class="header-box">
			<div class="header">
				<div class="logo-box">
					<a href="index.html"><img src="./images/icon2.png"/>尘宇kid</a>
					<ul>
						<li id="sidebar_trigger"><a href="index.html">主页</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main-box">
			<div class="login-box">
				<div class="box-border">
					<div id="login-button-box">
						<div id="account-login-button">账号密码登陆</div>
						<div id="register-login-button">用户注册登陆</div>
					</div>
					<div class="login-success">
						<span>
		<?php
			if(!empty($_GET['error'])){
				$error=$_GET['error'];
				if($error==1){
					echo "<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>账号或密码错误";
				}else if ($error==2) {
					echo "<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>该账户已经注册";
				}else if ($error==3) {
					echo "<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>注册失败";
				}else if ($error==4) {
					echo "<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>请先登陆";
				}
			}
		?>
						</span>
					</div>
					<div class="login-form">
						<form class="account-form" action="personal_page.php" method="post">
							<input type="text" name="account_name" autocomplete="off" placeholder="账号/邮箱/手机" id="account-name">
							<input type="password" name="user_password" maxlength="32" autocomplete="off" placeholder="密码" id="user-pwd">
							<div class="remember-box">
								<input class="auto-login" type="checkbox" name="remember-check" value="true"/>
								<span>一周内自动登陆</span>
							</div>
							<button class="login-button" >登陆</button>
						</form>
						<form class="register-form" action="personal_page.php" method="post">
							<input type="text" name="register_name" autocomplete="off" placeholder="账号/邮箱/手机" id="register-name">
							<input type="password" name="register_user_password" maxlength="32" autocomplete="off" placeholder="密码" id="register-user-pwd">
							<input type="password" name="user_repeat_password" maxlength="32" autocomplete="off" placeholder="再次输入密码" id="user-repeat-pwd">
							<div class="remember-box">
								<input class="auto-login" type="checkbox" name="remember-check" value="true"/>
								<span>一周内自动登陆</span>
							</div>
							<div class="register-success">
								<span>
									
								</span>
							</div>
							<button class="register-button" >注册</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-box">
			<footer>
				<ul class="share-group">
					<li><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></li>
					<li><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></li>
					<li><i class="fa fa-tencent-weibo fa-2x" aria-hidden="true"></i></li>
					<li><i class="fa fa-weixin fa-2x" aria-hidden="true"></i></li>
					<li><i class="fa fa-youtube-square fa-2x" aria-hidden="true"></i></li>
				</ul>
				<div class="copy">
					Copyright &copy 周宇宏 - 2018 - 个人博客网站
				</div>
			</footer>
		</div>
	</div>
</body>
</html>