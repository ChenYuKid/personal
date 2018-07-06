;$(function(){
	'use strict';
	function switch_login_register(){
		var login_button=$("#account-login-button");
		var register_button=$("#register-login-button");
		var account_form=$(".account-form");
		var register_form=$(".register-form");
		register_button.click(function(){
			$(this).css({"background-color":"#444","color":"#fff"});
			login_button.css({"background-color":"#d3d3d3","color":"#333"});
			account_form.css({"display":"none"});
			register_form.css({"display":"inline"});
			$(".login-success span").empty();
		})
		login_button.click(function(){
			$(this).css({"background-color":"#444","color":"#fff"});
			register_button.css({"background-color":"#d3d3d3","color":"#333"});
			account_form.css({"display":"inline"});
			register_form.css({"display":"none"});
			$(".login-success span").empty();
		})
	}
	function login_empty_prompt(){
		$("#user-pwd").focus(function(){
			if ($("#account-name").val()=='') {
				$(".login-success span").empty();
				$(".login-success span").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>请输入用户名");
			}else{
				$(".login-success span").empty();
			}
		})
		$("#account-name").focus(function(){
				$(".login-success span").empty();
		})
		$(".login-button").click(function(){
			if ($("#account-name").val()=='' || $("#user-pwd").val()=='') {
				$(".login-success span").empty();
				$(".login-success span").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>请输入用户名和密码");
				return false;
			}
		})
	}

	function register_empty_prompt(){
		$("#register-user-pwd").focus(function(){
			if ($("#register-name").val()=='') {
				$(".login-success span").empty();
				$(".login-success span").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>请输入用户名");
			}else{
				$(".login-success span").empty();
			}
		})
		$("#register-name").focus(function(){
				$(".login-success span").empty();
		})
		$("#user-repeat-pwd").focus(function(){
			if($("#register-user-pwd").val()==''){
				$(".login-success span").empty();
				$(".login-success span").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>请输入密码");
			}else{
				$(".login-success span").empty();
			}
		})
		$(".register-button").click(function(){
			
			if ($("#register-name").val()=='' || $("#register-user-pwd").val()=='' || $("#user-repeat-pwd").val()=='') {
				$(".login-success span").empty();
				$(".login-success span").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>请将表单填写完整");
				return false;
			}else if ($("#register-user-pwd").val()!=$("#user-repeat-pwd").val()) {
				$(".login-success span").empty();
				$(".login-success span").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>密码输入不一致");
				return false;
			}else if ($("#register-user-pwd").val().length<6||$("#register-user-pwd").val().length>32){
				$(".login-success span").empty();
				$(".login-success span").append("<i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i>密码长度为6到32位");
				return false;
			}else{
				return true;
			}
		})
	}
	switch_login_register();
	login_empty_prompt();
	register_empty_prompt();
})