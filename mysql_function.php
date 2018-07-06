<?php
/*
	通过mysqli扩展连接数据库
*/
	function db_connect(){
		$result =new mysqli('localhost','personal_blog','personal_blog','personal_blog');
		if (!$result) {
			throw new Exception("无法连接到数据库");
		}else{
			return $result;
		}
	}
/*
	用户登陆
*/
	function user_login($account_name,$user_password){
		@$username=stripslashes(trim($account_name));
		@$password=stripslashes(trim($user_password));
		$password=md5($password);
		if ($username&&$password) {
			$conn=db_connect();
			$result=$conn->query("select * from user where username='".$username."'and password='".$password."'");
			if (!$result || !($result->num_rows>0)) {
				header("location:background.php?error=1");
				exit();
			}
			$_SESSION['username']=$username;
			$conn->close();
		}
	}
/*
	用户注册
*/
	function user_register($register_name,$register_user_password){
		@$username=stripslashes(trim($register_name));
		@$password=stripslashes(trim($register_user_password));
		$password=md5($password);
		$conn=db_connect();
		$result=$conn->query("select * from user where username='".$username."'");
		if (!$result) {
			header("location:background.php?error=3");
			exit();
		}
		if ($result->num_rows>0) {
			header("location:background.php?error=2");
			exit();
		}

		$result=$conn->query("insert into user(username,password) values ('".$username."','".$password."')");
		if (!$result) {
			header("location:background.php?error=3");
		}
		$_SESSION['username']=$username;
		$conn->close();
	}
/*
	更新用户图片信息
*/
	function update_user_img($username,$actual_image_name){
		$conn=db_connect();
		//$username=mysql_real_escape_string($username);
		$result=$conn->query("update user set user_img='".$actual_image_name."'where username='".$username."'");
		if (!$result) {
			return false;
		}
	}
/*
	通过用户名选择该用户名的图片信息
*/
	function select_user_img($username){
		$conn=db_connect();
		$result=$conn->query("select user_img from user where username='".$username."' limit 1");
		if (!$result || !($result->num_rows>0)) {
			return false;
		}
		$rows=array();
		$rows=$result->fetch_array();
		$row=$rows[0];
		if (empty($row)) {
			return '';
		}else{
			return $row;
		}
	}
/*
	获取用户基本信息，从user表和article表中选择
*/
	function select_user_info(){
		$conn=db_connect();
		$user_info="select user.username,user.user_img,article.art_id,article.art_content,article.cur_time,article.likes from user,article where user.username=article.username order by article.art_id desc limit 0,5";
		$result_info=$conn->query($user_info);
		if (!$result_info) {
			return false;
		}else if($result_info->num_rows>0){
			return $result_info;
		}
	}
/*
	获取文章坐着信息
 */
	function select_auther_info($username){
		$conn=db_connect();
		$user_info="select user.username,user.user_img,article.art_id,article.art_content,article.cur_time,article.likes from user,article where user.username=article.username and user.username='".$username."' order by article.art_id desc limit 0,5";
		$result_info=$conn->query($user_info);
		if (!$result_info) {
			return false;
		}else if($result_info->num_rows>0){
			return $result_info;
		}
	}
/*
	获取用户评论信息，通过当前评论的文章id进行查找该文章所有的评论信息
*/
	function select_user_comments($art_id){
		$conn=db_connect();
		$com_info="select comments.username,comments.com_id,comments.com_content,comments.cur_time,comments.likes,user.user_img from user,comments where comments.username=user.username and comments.art_id='".$art_id."' order by comments.com_id";
		$result_com=$conn->query($com_info);
		if (!$result_com) {
			return false;
		}else if($result_com->num_rows>0){
			return $result_com;
		}
	}
/*
	获取文章点赞信息，通过文章id以及用户名判断当前是否存在当前用户点赞
*/
	function select_thumb($art_id,$username){
		$conn=db_connect();
		$thumb_info="select art_id,username from thumb_art where art_id='".$art_id."'and username='".$username."'";
		$result_thumb=$conn->query($thumb_info);
		if (!$result_thumb) {
			return false;
		}
		return $result_thumb;
	}
/*
	获取评论点赞信息，通过评论id以及用户名判断当前是否存在当前用户点赞
*/
	function select_com_thumb($com_id,$username){
		$conn=db_connect();
		$thumb_com_info="select com_id,username from thumb_com where com_id='".$com_id."'and username='".$username."'";
		$result_com_thumb=$conn->query($thumb_com_info);
		if (!$result_com_thumb) {
			return false;
		}
		return $result_com_thumb;
	}
?>
