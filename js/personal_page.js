;$(function(){
	$(".logo").mousedown(function(){
		$(this).css({ "border-bottom": "3px solid #fff" });
	})
	$(".friend-refresh").click(function(){
		window.location.reload();
	})
	$(".comment-post-button").mousedown(function(){
		$(this).css("opacity","0.7");
	}).mouseup(function(){
		$(this).css("opacity","1");
	})
	$(".btn-dismiss-post").mousedown(function(){
		$(this).css("opacity","0.7");
	}).mouseup(function(){
		$(this).css("opacity","1");
	})
	$(".btn-post").mousedown(function(){
		$(this).css("opacity","0.7");
	}).mouseup(function(){
		$(this).css("opacity","1");
	})
	$(".attach-down span:first").mousedown(function(){
		$(this).css("opacity","0.7");
	}).mouseup(function(){
		$(this).css("opacity","1");
	})
	$(".attach-down span:last").mousedown(function(){
		$(this).css("opacity","0.7");
	}).mouseup(function(){
		$(this).css("opacity","1");
	})
	$(".friend-refresh").mousedown(function(){
		$(this).css("opacity","0.7");
	}).mouseup(function(){
		$(this).css("opacity","1");
	})
	function home_drop_down(){
		$("#tb-index-li").click(function(){
			$(".nav-drop-down").css({"display":"inline"});
		}).mouseleave(function(){
			$(".nav-drop-down").css("display","none");
		});
	}
	function img_drop_down(){
		$(".user-home").click(function(){
			$(".img-drop-down").css({"display":"inline"});
			$(this).css("opacity","0.5");
		});
		$(".background-container").click(function(){
			$(".img-drop-down").css("display","none");
			$(".user-home").css("opacity","1");
			var clear_img_src=$(".userphoto").attr("src");
			var old_img_src=$(".img-user-avatar").attr("src");
			if (clear_img_src!=old_img_src) {
				$.post("clear_img_cache.php",{ clear_img_src : clear_img_src },function(data){
					$("#userphoto").html('');
				},'text');
			}
		})
		$("#upload_insert").click(function(){
			var user_img=$("#userphoto").html();
			if (user_img==null||user_img.length==0) {
				return false;
			}else{
				var old_img_src=$(".img-user-avatar").attr("src");
				var img_src=$(".userphoto").attr("src");
				$.post("post_user_img.php",{ img_src : img_src , old_img_src : old_img_src},function(data){
					$(".img-user-avatar").attr("src",img_src);
					$(".user-avatar").attr("src",img_src);
				},'text');
				$(".img-drop-down").css("display","none");
				$(".user-home").css("opacity","1");
			}
		})
	}
	function service_drop_down(){
		$(".user-setting").click(function(){
			$(".user-drop-down").fadeToggle(300);
		})
	}
	function friend_info_hide(){
		$(".friend-hide .fa").click(function(){
			$(this).css("opacity","0.7");
			$(this).parent().find(".friend-hide-bar").fadeToggle(300);
		})
		$(".friend-hide-bar").click(function(){
			var bar=$(this);
			var btn_name=$(this).attr("alt");
			var art_id=$(this).parent().parent().next().next().attr("alt");
			if (btn_name=="delete") {
				$.post("del_article.php",{ art_id : art_id },function(data){},'text');
			}
			bar.css("opacity","0.7");
			bar.parents(".control-container").fadeOut(500);
		})
	}
	function upload_img(){
		$("#upload_input_1").click(function(){
			$("[type=file]").click();
			$('#upload_input').change(function(){   
        		$("#userphoto").html('');
            	$("#userphoto").html('<img class="userphoto" src="./images/loader.gif" alt="Uploading...."/ style="height:inherit;width:inherit;">');  
            	$("#imageform").ajaxForm({  
                        target: '#userphoto'
        		}).submit();
        	});
		})
	}
	function editor_bottom(){
		$(".attach-down span:last").on('click',function(){
			$('html,body').animate({scrollTop:358},800);
			$(".poster-editor-bottom").css("display","none");
		})
		$("#textarea-content").focus(function(){
			$(".poster-editor-bottom").css("display","block");
		})
		$(".btn-dismiss-post").click(function(){
			$("#textarea-content").val('');
			$(".post-prompt").empty();
			$(".poster-editor-bottom").css("display","none");
		})
		$(".attach-down span:first").click(function(){
			$("#textarea-content").val('');
			$(".post-prompt").empty();
			$(".poster-editor-bottom").css("display","none");
		})
	}
	function drop_update_form(){
		$(".drop-down-setting").click(function(){
			$(".update-user-info").animate({top:"-7px"},300);
		})
		$(".update-user-info span").click(function(){
			$("#update-pwd").val("");
			$("#update-name").val("");
			$(".update-success").empty();
			$(".update-user-info").animate({top:"-350px"},300);
		})
	}
	function post_article(){
		$(".btn-post").click(function(){ 
			var textarea_content=$("#textarea-content");
			var str='';
			if(textarea_content.val() == ''){
				$(".post-prompt").empty();
				str = "<p><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i><strong>内容为空</strong></p>";
   				$(".post-prompt").prepend(str);
				return false;
			}
			
 			$.post("post_article.php",{username : $(".head-content .username").val() , content : $("#textarea-content").val()}, function(data){ 
  				$(".post-prompt").empty();
   				str = "<p><i class=\"fa fa-check\" aria-hidden=\"true\"></i><strong>发表了一篇文章</strong></p>"; 
   				$(".post-prompt").prepend(str);
  			}, 'text'); 
 		});  
	}

	function post_comment(){
		$(document).on('click',".comment-post-button",function(){
			var textarea_content=$(this).parent().find("textarea");
			var span=$(this).parent().find(".comment-prompt");
			var art_id=$(this).parent().parent().parent().attr("alt");
			if(textarea_content.val() == ''){
				span.empty();
				var str = "<p><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i><strong>内容为空</strong></p>"
   				span.prepend(str);
				return false;
			}
 			$.post("post_comment.php",{ content : textarea_content.val() , art_id : art_id }, function(data){ 
  				if(data){ 
  					span.empty();
   					var str = "<p><i class=\"fa fa-check\" aria-hidden=\"true\"></i><strong>发表了评论</strong></p>";
   					span.prepend(str);

   					var username=data.username,
   					com_id=data.com_id,
   					com_content=data.com_content,
   					cur_time=data.cur_time,
   					likes=data.likes,
   					user_img=data.user_img;

   					if (user_img=='') {
   						user_img='user_img.jpg';
   					}

   					var com_str=
   						 '<li class="comment-item" alt="'+com_id+'">'
   						+'<div class="comment-item-bd">'
   						+'<div class="single-reply">'
   						+'<div class="item-user-img">'
   						+'<a class="commment-user-img">'
   						+'<img class="commment-icon" src="./upload_img/'+user_img+'">'
   						+'</a>'
   						+'</div>'
   						+'<div class="comment-info">'
   						+'<span class="comment-info-span1">'+username+'</span>'
   						+'<a class="comments-option-thumb">'
   						+'<i style="display: inline-block;" class="fa fa-thumbs-up" id="fa-thumbs" aria-hidden="true"></i>'
   						+'<i style="display: none;" class="fa fa-heart" id="fa-thumbs" aria-hidden="true"></i>'
   						+'<span class="comments-num">'+likes+'</span>'
   						+'<span class="comments-content">人觉得很赞</span>'
   						+'</a>'
   						+'<span class="comment-info-span2">'+cur_time+'</span>'
   						+'<div class="comment-content">'
   						+'<p>'+com_content+'</p>'
   						+'</div></div></div></div></li>';
   					$(".comments-list ul").append(com_str);

   					setTimeout(function(){
   						span.empty();
   					},3000);
  				}else{
  					span.empty();
  					var str = "<p><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i><strong>评论失败</strong></p>";
   					span.prepend(str);
   					setTimeout(function(){
   						span.empty();
   					},3000);
  				} 
  			}, 'json');
  			textarea_content.val('');
		});
		
		if ($(".comment-textarea").val()!='') {
			$(".comment-prompt").empty();
		}
	}
	function post_thumb(){
		$(document).on('click',".foot-detail-options .option-thumb",function(){
			var thumb_num=$(this).parent().parent().parent().find("span:first").text();
			var art_id=$(this).parent().parent().parent().attr("alt");
			var thumb=$(this).find(".fa-thumbs-up").css("display");/*.fadeOut(300);*/
			var heart=$(this).find(".fa-heart").css("display");/*.fadeIn(300);*/
			var thumb_option=$(this).find(".fa-thumbs-up");
			var heart_option=$(this).find(".fa-heart");
 			$.post("post_thumb.php",{ art_id : art_id }, 'text');
  			if (thumb=='none') {
				heart_option.fadeOut(300);
				thumb_option.fadeIn(300);
				thumb_num=parseInt(thumb_num)-1;
				$(this).parent().parent().parent().find("span:first").text(thumb_num);
			}else{
				thumb_option.fadeOut(300);
				heart_option.fadeIn(300);
				thumb_num=parseInt(thumb_num)+1;
				$(this).parent().parent().parent().find("span:first").text(thumb_num);
			}
		})
	}
	function post_comment_thumb(){
		$(document).on('click','.comments-option-thumb .fa',function(){
			var thumb_com_num=$(this).parent().find(".comments-num").text();
			var com_id=$(this).parent().parent().parent().parent().parent().attr("alt");
			var thumb_com=$(this).parent().find(".fa-thumbs-up").css("display");
			var heart_com=$(this).parent().find(".fa-heart").css("display");
			var thumb_com_option=$(this).parent().find(".fa-thumbs-up");
			var heart_com_option=$(this).parent().find(".fa-heart");
 			$.post("post_comment_thumb.php",{ com_id : com_id }, 'text');
  			if (thumb_com=='none') {
				heart_com_option.fadeOut(300);
				thumb_com_option.fadeIn(300);
				thumb_com_num=parseInt(thumb_com_num)-1;
				$(this).parent().find(".comments-num").text(thumb_com_num);
			}else{
				thumb_com_option.fadeOut(300);
				heart_com_option.fadeIn(300);
				thumb_com_num=parseInt(thumb_com_num)+1;
				$(this).parent().find(".comments-num").text(thumb_com_num);
			}
		})
	}
	function post_update_info(){
		$("#update-pwd").focus(function(){
			if ($("#update-name").val()=='') {
				$(".update-success").empty();
				$(".update-success").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>请输入用户名");
			}else{
				$(".update-success").empty();
			}
		})
		$("#update-name").focus(function(){
				$(".update-success").empty();
		})
		$(".update-button").click(function(){
			if ($("#update-name").val()=='' || $("#update-pwd").val()=='') {
				$(".update-success").empty();
				$(".update-success").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>请将信息填写完整");
				return false;
			}
			if ($("#update-pwd").val().length<6||$("#update-pwd").val().length>32){
				$(".update-success").empty();
				$(".update-success").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>密码长度为6到32位");
				return false;
			}
			
			$.post("post_update_info.php",{ new_username : $("#update-name").val() , new_password : $("#update-pwd").val() } , function(data){ 
  					$(".update-success").empty();
   					var str = "<i class=\"fa fa-check\" aria-hidden=\"true\"></i><strong>修改成功</strong>";
   					$(".update-success").prepend(str);
   					$("#update-name").val("");
   					$("#update-pwd").val("");
  			}, 'text');
		})
	}
	function back_to_top(){
		$(".back-to-top").on('click',function(){
			$('html,body').animate({scrollTop:0},800)
		})
		$(window).on('scroll',function(){
			if ($(window).scrollTop()>$(window).height()) {
				$(".back-to-top").fadeIn();
			}else{
				$(".back-to-top").fadeOut();
			}
		})
	}

	function scroll_refresh(){
		var win_h=$(window).height();
		var p=1;
		$(window).on('scroll',function(){
			var page_h=$(document.body).height();
			var scroll_t=$(window).scrollTop();
			var range=(page_h-win_h-scroll_t)/win_h;
			var strUrl=location.href;
    		var arrUrl=strUrl.split("/");
    		var strPage=arrUrl[arrUrl.length-1];
    		var get_url='';
			if (strPage=='personal_page.php') {
				get_url="scroll_refresh_u.php";
			}else if (strPage=='personal_center.php') {
				get_url="scroll_refresh_p.php";
			}
			//console.log(page_h+" "+scroll_t+" "+range);
			if (range<0.01) {
				$.ajaxSettings.async=false;
				$.getJSON(get_url,{ page : p },function(data){
					//data=JSON.parse(data);
					if (data) {
						var user_str='';
						$.each(data,function(i,u_data){
							var u_username=u_data.username,
							u_user_img=u_data.user_img,
							u_art_id=u_data.art_id,
							u_art_content=u_data.art_content,
							u_cur_time=u_data.cur_time,
							u_likes=u_data.likes,
							u_is_thumb=u_data.user_is_thumb;

							var u_thumbs_up='',u_thumbs_heart='';
							if (u_user_img=='') {
   								u_user_img='user_img.jpg';
   							}

   							if (u_is_thumb==1) {
   								u_thumbs_up="display: none;";
   								u_thumbs_heart="display: inline-block;";
   							}else if(u_is_thumb==0){
   								u_thumbs_up="display: inline-block;";
   								u_thumbs_heart="display: none;";
   							}

							user_str=
							'<div class="control-container" style="display:none;">'
							+'<div class="container-inner">'
							+'<ul id="friend-list-content">'
							+'<li class="single-content">'
							+'<div class="single-head">'
							+'<div class="friend-img">'
							+'<img src="./upload_img/'+u_user_img+'">'
							+'</div>'
							+'<div class="friend-hide">'
							+'<i class="fa fa-caret-down" aria-hidden="true"></i>'
							+'<div class="friend-hide-bar" alt="">'
							+'隐藏</div></div>'
							+'<div class="friend-info">'
							+'<div class="friend-info-username">'
							+'<a href="">'+u_username+'</a>'
							+'</div>'
							+'<div class="friend-info-detail">'
							+'<span class="info-time">更新时间：</span>'
							+'<span class="info-time-content">'+u_cur_time+'</span>'
							+'</div></div></div>'
							+'<div class="single-body">'
							+'<div class="single-item">'
							+'<div class="item-info">'+u_art_content+'</div></div></div>'
							+'<div class="single-foot" alt="'+u_art_id+'">'
							+'<div class="foot-detail">'
							+'<p class="foot-detail-options">'
							+'<a class="option-share"><i class="fa fa-share" aria-hidden="true"></i></a>'
							+'<a class="option-comment"><i class="fa fa-commenting" aria-hidden="true"></i></a>'
							+'<a class="option-thumb"><i style="'+u_thumbs_up+'" class="fa fa-thumbs-up" aria-hidden="true"></i>'
							+'<i style="'+u_thumbs_heart+'" class="fa fa-heart" aria-hidden="true"></i>'
							+'</a></p></div>'
							+'<div class="foot-like">'
							+'<div class="foot-like-btn">'
							+'<a class="like-btn"><i class="fa fa-hand-peace-o" aria-hidden="true"></i></a>'
							+'</div>'
							+'<div class="like-account">'
							+'<span>'+u_likes+'</span>'
							+'<span>人觉得很赞</span>'
							+'</div></div>'
							+'<div class="foot-comments">'
							+'<div class="comments-list">'
							+'<ul>';
							$.ajaxSettings.async=false;
							$.getJSON("scroll_refresh_c.php",{ c_art_id : u_art_id },function(comm_data){
								$.each(comm_data,function(j,c_data){
									var c_username=c_data.username,
									c_com_id=c_data.com_id,
									c_com_content=c_data.com_content,
									c_cur_time=c_data.cur_time,
									c_likes=c_data.likes,
									c_user_img=c_data.user_img,
									c_is_thumb=c_data.com_is_thumb;
									var c_thumbs_up='',c_thumbs_heart='';
									if (c_user_img=='') {
   										c_user_img='user_img.jpg';
   									}

   								
									if (c_is_thumb==1) {
   										c_thumbs_up="display: none;";
   										c_thumbs_heart="display: inline-block;";
   									}else if(c_is_thumb==0){
   										c_thumbs_up="display: inline-block;";
   										c_thumbs_heart="display: none;";
   									}

									user_str+='<li class="comment-item" alt="'+c_com_id+'">'
									+'<div class="comment-item-bd">'
									+'<div class="single-reply">'
									+'<div class="item-user-img">'
									+'<a class="commment-user-img">'
									+'<img class="commment-icon" src="./upload_img/'+c_user_img+'">'
									+'</a></div>'
									+'<div class="comment-info">'
									+'<span class="comment-info-span1">'+c_username+'</span>'
									+'<a class="comments-option-thumb">'
									+'<i style="'+c_thumbs_up+'" class="fa fa-thumbs-up" aria-hidden="true"></i>'
									+'<i style="'+c_thumbs_heart+'" class="fa fa-heart" aria-hidden="true"></i>'
									+'<span class="comments-num">'+c_likes+'</span>'
									+'<span class="comments-content">人觉得很赞</span>'
									+'</a>'
									+'<span class="comment-info-span2">'+c_cur_time+'</span>'
									+'<div class="comment-content">'
									+'<p>'+c_com_content+'</p>'
									+'</div></div></div></div></li>';
								});
							});
							$.ajaxSettings.async=true;
							user_str+='</ul></div>'
							+'<div class="comment-poster">'
							+'<div class="comment-box">'
							+'<textarea class="comment-textarea"></textarea>'
							+'<span class="comment-prompt"></span></div>'
							+'<a class="comment-post-button">'
							+'<i class="fa fa-upload" aria-hidden="true"></i>'
							+'<span>评论</span>'
							+'</a>'
							+'</div></div></div></li></ul></div></div>';

							$(".control-refresh").append(user_str);
							$(".control-container").last().fadeIn((i+1)*600);
						});
						p++;
					}else{
						console.log("null");
						return false;
					}
				});
				$.ajaxSettings.async=true;
			}else{
				return false;
			}
		})
	}

	friend_info_hide();
	back_to_top();
	post_article();
	post_comment();
	post_thumb();
	post_comment_thumb();
	post_update_info();
	home_drop_down();
	img_drop_down();
	service_drop_down();
	upload_img();
	editor_bottom();
	drop_update_form();
	scroll_refresh();
})