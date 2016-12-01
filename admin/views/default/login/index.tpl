<html>
	<head>
		<title>IPMS管理系统</title>
		<meta http-equiv="Windows-Target" content="_top" />
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="Author" content="HY" />
		<meta name="Keywords" content="php,ipms" />
		<meta http-equiv="Windows-Target" content="_top" />
		<link rel="stylesheet" type="text/css" href="<{$res}>/css/style.css" />
	</head>

<body class="center" onload="document.getElementById('login-form').username.focus()">
<div id="login-box">    <{*本句为注释，“id="login-box"”对应css文件中定义的“#login-box”的格式*}>
<div id="main">
	<div class="head-dark-box"> <{*本句为注释，“class="head-dark-box"”对应css文件中定义的“.head-dark-box”的格式*}>
		&nbsp;<b>IPMS管理系统登录</b>
	</div>

	<form method="post" action="<{$url}>/prologin" id="login-form">
		<ul>	
			<li style="height:25px" class="dark-row" >
				<span class="list_width">用户名</span>
				<input type="text" class="text-box" size="15" name="username">
			</li>
			<li style="height:25px" class="light-row">
				<span class="list_width">密&nbsp;&nbsp;&nbsp;码</span>
				<input type="password" class="text-box" size="15" name="userpwd">
			</li>
			<li style="height:25px" class="dark-row">
				<span class="list_width">验证码</span>
				<input type="text" onkeyup="if (this.value != this.value.toUpperCase()) this.value=this.value.toUpperCase();"  class="text-box" size="6" name="code" />
				<img style="cursor:pointer;" alt="看不清，换一张" onclick="this.src='<{$url}>/code/'+Math.random()" src="<{$url}>/code" />
			</li>
			<li style="height:25px" class="light-row">
				<input type="hidden" name="action" value="login"> 
				<span class="list_width">&nbsp;</span>
				<input type="submit" class="button" value="登录系统" />
			</li>
		</ul>
	</form>
</div>
</div>
</body>
</html>

