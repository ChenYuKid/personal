<?php
function display_header($username){
?>
<!DOCTYPE html>
<html>
<head>
	<title>personal - 
		<?php
		/*获取内存或浏览器本地用户名*/
			if (isset($_SESSION['username'])) {
			 	echo $_SESSION['username'];
			} else if (isset($_COOKIE['username'])) {
			 	echo $_COOKIE['username'];
			}else
			 	echo $username;
		?>
	</title>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="js/personal_page.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/reset_css/normalize.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="./css/personal_page.css">
</head>
<?php
}

function display_top_bar($user_img){
?>
	<body>
	<div id="wrapper">
		<div class="top-bar">
			<div class="top-container">
				<a class="logo" title="个人主页" href="index.html"><img src="./images/icon2.png" />首页</a>
				<ul class="top-nav">
					<li class="nav-list" id="tb-ic-li">
						<div class="nav-list-inner">
							<a class="nav-hover" href="personal_center.php">
								<i class="fa fa-user" aria-hidden="true"></i>
								<span>个人中心</span>
							</a>
						</div>
					</li>
					<li class="nav-list" id="tb-index-li">
						<div class="nav-list-inner">
							<a class="main-page" href="#">
								<i class="fa fa-home" aria-hidden="true"></i>
								<span>我的主页</span>
								<i class="fa fa-caret-down" aria-hidden="true"></i>
							</a>
						</div>
						<div class="nav-drop-down">
							<div class="side-area">
                                <div class="homepage-link">
                                    <a class="link-icon" href="./personal_page.php"><i class="fa fa-user" aria-hidden="true"></i></a>
                                    <a class="link-text" href="personal_page.php">主页</a>
                                </div>
                            </div>
                            <div class="main-area">
                                <div class="main-application">
                                    <ul class="main-application-list" id="tb_menu_list">
                                        <li class="menu_item_1">
                                            <a href="">
                                            	<i class="fa fa-address-book-o" aria-hidden="true"></i>
                                            </a>
                                            <a class="app-name">日志</a>
                                        </li>
                                        <li class="menu_item_2">
                                            <a href="">
                                            	<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                            </a>
                                            <a class="app-name">点赞</a>
                                        </li>
                                        <li class="menu_item_3">
                                            <a href="">
                                            	<i class="fa fa-commenting-o" aria-hidden="true"></i>
                                            </a>
                                            <a class="app-name">评论</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
						</div>
					</li>
					<li class="nav-list" id="tb-friend-li">
						<div class="nav-list-inner">
							<a class="friends-link" href="#">
								<i class="fa fa-users" aria-hidden="true"></i>
								<span>我的好友</span>
								<i class="fa fa-caret-down" aria-hidden="true"></i>
							</a>
						</div>
					</li>
				</ul>
				<div class="user-info">
                    <a class="user-home">
                        <img class="user-avatar" src="./upload_img/<?php echo $user_img; ?>" alt="您的头像">
                        <span class="user-name">
                        	<?php
                        	/*获取内存及客户端本地用户名*/
                        		if (isset($_SESSION['username'])) {
			 						echo $_SESSION['username'];
				 				} else
									echo $_COOKIE['username'];
                        	?>
                        </span>
                    </a>
					<a id="tb-logout" class="logout-new" href="log_out.php" title="退出">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
					</a>
					<div class="img-drop-down">
							<div class="img-side-area">
								<img class="img-user-avatar" src="./upload_img/<?php echo $user_img; ?>" alt="您的头像">
                                <span class="img-text">当前头像</span>
                            </div>
                            <div class="img-main-area">
                            	<div id="userphoto">
                            	</div>
                                <div class="img-main-application">
                                	<form id="imageform" action="./uploadphoto.php" method="post" enctype="multipart/form-data">
                                		<input id="upload_input" type="file" name="upload_input"/>
										<input id="upload_input_1" type="button" name="upload_input" value="选择文件"/><br>
										<input type="button" id="upload_insert" name="upload_insert" value="上传新头像"/>
									</form>
                                </div>
                            </div>
                    </div>
                    <div class="user-setting">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <div class="user-drop-down">
                            <div class="drop-down-setting">
                                <a>修改资料</a>
                            </div>
                            <div class="online-service">
                            	<a class="online-service-help">帮助中心</a>
                            	<a class="online-service-response">意见反馈</a>
                            </div>
                        </div>
                    </div>
                    <div class="update-user-info">
                        	<span>
								<i class="fa fa-times" aria-hidden="true"></i>
							</span>
							<input type="text" name="new_name" autocomplete="off" placeholder="新账号" id="update-name">
							<input type="password" name="new_password" maxlength="32" autocomplete="off" placeholder="新密码" id="update-pwd">
							<div class="update-success">
								
							</div>
							<button class="update-button" >确认修改</button>
                    </div>
				</div>
			</div>
		</div>
<?php
}
function display_background_header($user_img){
?>
	<div class="background-container">
			<div class="layout-head">
				<div class="head-content">
					<img class="user-avatar" src="./upload_img/<?php echo $user_img; ?>" alt="">
					<span class="username">
						<?php
						/*获取内存及客户端本地用户名*/
                        	if (isset($_SESSION['username'])) {
			 					echo $_SESSION['username'];
				 			} else
								echo $_COOKIE['username'];
                        ?>
                    </span>
				</div>
			</div>
			<div class="layout-body">
				<div id="body-main-content">
					<div id="poster_container">
						<div class="poster-inner">
							<div class="poster-editor-cont">
								<div class="editor-main-area">
									<textarea id="textarea-content"></textarea>
								</div>
								<div class="editor-side-area">
									<div class="attach-down">
										<span>
											<i class="fa fa-times" aria-hidden="true"></i>
										</span>
										<span>
											<i class="fa fa-hand-o-down" aria-hidden="true"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="poster-editor-bottom">
								<div class="post-bottom-area">
									<div class="side-bottom">
										<a class="gif-icon" title="插入表情">
											<i class="fa fa-smile-o" aria-hidden="true"></i>
										</a>
										<a title="提到好友"">
											<i class="fa fa-at" aria-hidden="true"></i>
										</a>
									</div>
								</div>
								<div class="post-prompt"></div>
								<div class="poster-button">
									<a class="btn-dismiss-post">
										<i class="fa fa-ban" aria-hidden="true"></i>
										<span class="txt">取消</span>
									</a>
									<a href="" class="btn-post">
										<i class="fa fa-upload" aria-hidden="true"></i>
										<span class="txt">发表</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="control-refresh">
						<div class="control-inner">
							<div class="control-inner-left">
								<a class="">
									<i class="fa fa-list-ul" aria-hidden="true"></i>
									<span>全部动态</span>
								</a>
							</div>
							<div class="control-inner-right">
								<a class="friend-refresh" title="刷新动态">
									<i class="fa fa-refresh" aria-hidden="true"></i>
								</a>
								<span>
									<i class="fa fa-paperclip fa-rotate-90" aria-hidden="true"></i>
								</span>
							</div>
						</div>
<?php
}

function display_content_btn($btn_name){
?>
	<div class="friend-hide">
		<i class="fa fa-caret-down" aria-hidden="true"></i>
		<div class="friend-hide-bar" alt=<?php if($btn_name=='删除') echo "delete";?> >
			<?php echo $btn_name; ?>
		</div>
	</div>
<?php
}

function display_background_content($user_info,$result_thumb,$btn_name){
?>
	<div class="control-container">
							<div class="container-inner">
								<ul id="friend-list-content">
									<li class="single-content">
										<div class="single-head">
											<div class="friend-img">
												<img src="./upload_img/
												<?php
													if(!empty($user_info["user_img"])) 
														echo $user_info["user_img"];
													else
														echo "user_img.jpg";
												?>">
											</div>
											<?php
												display_content_btn($btn_name);
											?>
											<div class="friend-info">
												<div class="friend-info-username">
													<a href=""><?php echo $user_info["username"];?></a>
												</div>
												<div class="friend-info-detail">
													<span class="info-time">更新时间：</span>
													<span class="info-time-content"><?php echo $user_info["cur_time"];?></span>
												</div>
											</div>
										</div>
										<div class="single-body">
											<div class="single-item">
												<div class="item-info">
													<?php echo $user_info["art_content"];?>
												</div>
											</div>
										</div>
										<div class="single-foot" alt="<?php echo $user_info['art_id'];?>">
											<div class="foot-detail">
												<p class="foot-detail-options">
													<a class="option-share"><i class="fa fa-share" aria-hidden="true"></i></a>

													<a class="option-comment"><i class="fa fa-commenting" aria-hidden="true"></i></a>

													<a class="option-thumb"><i style="
													<?php 
													if($result_thumb->num_rows>0) 
														echo "display: none;"; 
													else 
														echo "display: inline-block;";
													?>" class="fa fa-thumbs-up" aria-hidden="true"></i><i style="
													<?php 
													if($result_thumb->num_rows>0) 
														echo "display: inline-block;"; 
													else 
														echo "display: none;";
													?>" class="fa fa-heart" aria-hidden="true"></i>
													</a>
												</p>
											</div>

											<div class="foot-like">
												<div class="foot-like-btn">
													<a class="like-btn"><i class="fa fa-hand-peace-o" aria-hidden="true"></i></a>
												</div>
												<div class="like-account">
													<span><?php echo $user_info["likes"]; ?></span>
													<span>人觉得很赞</span>
												</div>
											</div>

											<div class="foot-comments">
												<div class="comments-list">
													<ul>
<?php
}

function display_background_comments($user_com,$result_com_thumb){
?>
	<li class="comment-item" alt="<?php echo $user_com['com_id'];?>">
															<div class="comment-item-bd">
																<div class="single-reply">
																	<div class="item-user-img">
																		<a class="commment-user-img">
																			<img class="commment-icon" src="./upload_img/
																			<?php
																				if(!empty($user_com["user_img"])) 
																					echo $user_com["user_img"];
																				else
																					echo "user_img.jpg";
																			?>">	
																		</a>
																	</div>
																	<div class="comment-info">
																		<span class="comment-info-span1">
																	<?php
																		echo $user_com["username"];
																	?>
																		</span>
																		<a class="comments-option-thumb">
																			<i style="
																			<?php
																				if($result_com_thumb->num_rows>0)
																					echo "display: none;";
																				else
																					echo "display: inline-block;";
																			?>" class="fa fa-thumbs-up" aria-hidden="true"></i><i style="
																			<?php
																				if($result_com_thumb->num_rows>0)
																					echo "display: inline-block;";
																				else
																					echo "display: none;";
																			?>" class="fa fa-heart" aria-hidden="true"></i><span class="comments-num"><?php echo $user_com["likes"];?></span><span class="comments-content">人觉得很赞</span>
																		</a>
																		<span class="comment-info-span2">
																	<?php
																		echo $user_com["cur_time"];
																	?>
																		</span>
																		<div class="comment-content">
																			<p>
																	<?php
																		echo $user_com["com_content"];
																	?>
																			</p>
																		</div>
																	</div>
																</div>
															</div>
														</li>
<?php
}

function display_background_footer(){
?>
	</ul>
												</div>

												<div class="comment-poster">
													<div class="comment-box">
														<textarea class="comment-textarea"></textarea>
														<span class="comment-prompt"></span>
													</div>
													<a class="comment-post-button">
														<i class="fa fa-upload" aria-hidden="true"></i>
														<span>评论</span>
													</a>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
<?php
}

function display_footer(){
?>
					</div>	
				</div>
			</div>
 			<div class="footer">
				<ul class="share-group">
					<li><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></li>
					<li><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></li>
					<li><i class="fa fa-tencent-weibo fa-2x" aria-hidden="true"></i></li>
					<li><i class="fa fa-weixin fa-2x" aria-hidden="true"></i></li>
					<li><i class="fa fa-youtube-square fa-2x" aria-hidden="true"></i></li>
				</ul>
				<div class="copy">
					Copyright &copy 周宇宏 - 2018/4 - 个人论坛网站
				</div>
			</div>
		</div>
	</div>
	<button class="back-to-top">返回顶部</button>
</body>
</html>
<?php
}
?>