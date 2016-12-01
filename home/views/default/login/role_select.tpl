<html>
	<head>
		<title>系统角色选择</title>
		<meta http-equiv="Windows-Target" content="_top" />
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="Author" content="HY" />
		<meta name="Keywords" content="php,patent" />
		<meta http-equiv="Windows-Target" content="_top" />
		<link rel="stylesheet" type="text/css" href="<{$res}>/css/main.css" />
	</head>

<body class="center" onload="document.getElementById('login-form').username.focus()">
<div id="login-box">   <{*本句为注释，“id="login-box"”对应css文件中定义的“#login-box”的格式*}>
<div id="main">
	<div class="head-dark-box"> <{*本句为注释，“class="head-dark-box"”对应css文件中定义的“.head-dark-box”的格式*}>
		&nbsp;<b>IPMS系统角色选择</b>
	</div>
        <{ section name=doc loop=$role_array }>
            <li class="<{if $smarty.section.doc.index is even}>light-row<{else}>dark-row<{/if}>" style="text-align:center; padding-top:10px; padding-bottom:10px">
                <{*角色名称可链接到首页index.tpl，同时传送userid值*}>
                <a title="<{ $role_array[doc].groupdes }>" href="<{$app}>/login/index/uid/<{ $role_array[doc].userid }>/role/<{ $role_array[doc].groupname }>"><{ $role_array[doc].groupname }></a>
                <{*<span class="list_width"><{ $smarty.section.doc.groupdes}></span>*}>
            </li>
            <{ sectionelse }>
        				
            <{ /section }>
			
		</ul>

</div>
</div>
</body>
</html>