<?php if (!defined('THINK_PATH')) exit();?><html>
        <head>
            <meta charset="UTF-8">
            <title>登录</title>
        </head>
    
        <body>
			<!--短信验证码60S倒计时及AJAX POST提交手机号-->
			
            <h2>登录用户界面</h2>
            <form method="POST" style="border:1px solid #000; text-align:center; width:300px">
                用&nbsp;户&nbsp;名:
                <input type="text" name="phone" placeholder="请输入登录用户名">
                <br/>
                <br>
                密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:
                <input type="password" name="user_pwd" placeholder="请输入登录密码">
                
                <br/>
                <br/>
				
                <input type="submit" value="登录">
                <a href="index.php?c=login&a=register">还没有注册，去注册</a>
            </form>
        </body>
		
		
    </html>