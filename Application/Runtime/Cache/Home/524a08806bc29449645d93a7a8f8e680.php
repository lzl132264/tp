<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta charset="UTF-8">
        <title>新用户注册</title>
    </head>

    <body>
        <h2>注册用户界面</h2>
		
        <form method="POST" style="border:1px solid #000; text-align:center; width:300px">
            用&nbsp;户&nbsp;名:
            <input type="text" class="phone" id="name" name="phone" placeholder="请输入用户名">
            <br/>
            <br>
            密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:
            <input type="password" name="user_pwd" placeholder="请输入密码">
            <br/>
            <br>
			<input type="hidden" name="yyy" value="<?php echo ($_SESSION['iphonecode']); ?>" />
			<input type="text" name="yzm" value=""  />
           <input type="button" onclick="sendcode()" id="smsbtn" value="获取验证码" />
            <br/>
            <input type="submit" value="注册">	
            <a href="index.php?c=login&a=login">已经注册，直接登录</a>
        </form>
    </body>
	<script src="../../../../Public/jq.js" type="text/javascript" charset="utf-8"></script>
		<!--短信验证码60S倒计时及AJAX POST提交手机号-->
			<script type="text/javascript"> 
			var countdown=60; 
			function sendcode(){
				var obj = $("#smsbtn");
				settime(obj);
				
				$.ajax({
					type: 'POST',
					url: '/index.php/Home/Login/sendCode',
					data: {"iphone":$("#name").val()},
					dataType:'json',
					success: function(data){
						alert('返回数据：'+data);
						console.log("提交成功");
					},
					error: function(data){
						console.log("提交失败");
					}
				});
			}
			function settime(obj) { //发送验证码倒计时
				if (countdown == 0) { 
					obj.attr('disabled',false);
					obj.val("发送验证码");
					countdown = 60; 
					return;
				} else { 
					obj.attr('disabled',true);
					obj.val("重新发送(" + countdown + "s)");
					countdown--; 
				} 
			setTimeout(function() { 
				settime(obj) }
				,1000) 
			}
			</script>
</html>