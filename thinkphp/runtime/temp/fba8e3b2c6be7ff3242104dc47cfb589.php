<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\phpStudy\WWW\thinkphp\public/../application/index\view\login\index.html";i:1504440593;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>登录</title>
		<link rel="stylesheet" href="/thinkphp/public/static/login/layui.css" media="all" />
		<link rel="stylesheet" href="/thinkphp/public/static/login/login.css" />
	</head>

	<body class="beg-login-bg">
		<div class="beg-login-box">
			<header>
				<h1>后台登录</h1>
			</header>
			<div class="beg-login-main">
				<form action="<?php echo url('Login/login_add'); ?>" class="layui-form" method="post"><input name="__RequestVerificationToken" type="hidden" value="fkfh8D89BFqTdrE2iiSdG_L781RSRtdWOH411poVUWhxzA5MzI8es07g6KPYQh9Log-xf84pIR2RIAEkOokZL3Ee3UKmX0Jc8bW8jOdhqo81" />
					<div class="layui-form-item">
						<label class="beg-login-icon">
                        <i class="layui-icon">&#xe612;</i>
                    </label>
						<input type="text" name="userName" lay-verify="userName" autocomplete="off" placeholder="这里输入登录名" class="layui-input">
					</div>
					<div class="layui-form-item">
						<label class="beg-login-icon">
                        <i class="layui-icon">&#xe642;</i>
                    </label>
						<input type="password" name="password" lay-verify="password" autocomplete="off" placeholder="这里输入密码" class="layui-input">
					</div>
					<div class="layui-form-item">
						<div class="beg-pull-left beg-login-remember">
							<label>记住帐号？</label>
							<input type="checkbox" name="rememberMe" value="1" lay-skin="switch" checked title="记住帐号">
							<input type="hidden" name='ips' class="ips" value="">
						</div>
						<div class="beg-pull-right">
							<button class="layui-btn layui-btn-primary" >
                            <i class="layui-icon">&#xe650;</i> 登录
                        </button>
						</div>
						<div class="beg-clear"></div>
					</div>
				</form>
			</div>
			<footer>
				<p class="ip">Beginner © www.zhengjinfan.cn</p>
			</footer>
		</div>
		<script type="text/javascript" src="/thinkphp/public/static/login/layui.js"></script>
		<script>
			layui.use(['layer', 'form'], function() {
				var layer = layui.layer,
					$ = layui.jquery,
					form = layui.form();
					
				form.on('submit(login)',function(data){
					
					location.href='index.html';
					return false;
				});
			});
		</script>
		<script type="text/javascript" src="/thinkphp/public/static/lib/jquery/1.9.1/jquery.min.js"></script> 
		<script type="text/javascript">
		$(function(){ 
			// 获取IP
			jQuery(function($){
	    	var url = 'http://chaxun.1616.net/s.php?type=ip&output=json&callback=?&_='+Math.random(); 
	    		$.getJSON(url, function(data){
	        	$('.ips').val(data.Ip);
	    		});
			});
		});
		</script>
	</body>

</html>