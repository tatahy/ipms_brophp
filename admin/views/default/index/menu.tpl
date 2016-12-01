<{include file="public/header.tpl"}>
		<div id="menu">
			<div class="option">
				<div class="menutitle">【管理选项】</div>
				<div class="content">
					<ul>
						<li class="opt">
							<a href="<{$url}>/main" onclick="switchmenu('optionmenu','menulist',0)" target="main">
							<img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="<{$res}>/images/system_d.gif"><br>
							 系统管理</a>
						</li>
						<li class="opt">
							<a href="<{$url}>/main" onclick="switchmenu('optionmenu','menulist',1)" target="main">
							<img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="<{$res}>/images/article_d.gif"><br>
							内容管理</a>
						</li>
						<li class="opt">	
							 <a href="<{$url}>/main" onclick="switchmenu('optionmenu','menulist',2)" target="main">
							 <img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="<{$res}>/images/user_d.gif"><br>
							 用户管理</a>
						</li>
					</ul>
				 </div>
			</div>
            <div class="nav"> </div>
            <div class="option">
				<div id="optionmenu" class="menutitle">【系统管理】</div>
				<div id="menulist" class="content"> 
				    	<div style="display:block">
						<{if $smarty.session.useradmin}>	   <{*“系统管理”模块访问权限设置，有授权的才显示。MySQL中的字段名是区分大小写的，否则查找不到表中的记录。*}>				
						<h4 onclick="domenu(this, 'list1')" class="tit">--常规管理--</h4>
						<ul id="list1">
							<li><a class="list" href="<{$app}>/base/sysinfo" target="main">系统信息</a></li>
							<li><a class="list" href="<{$app}>/base/baseset" target="main">基本设置</a></li>
							<li><a class="list" href="<{$app}>/base/upcache" target="main">更新缓存</a></li>
							
						</ul>
						
						<{else}>
							<h4>没有"系统管理"权限</h4>
						<{/if}>
				
					</div>

					<div> 
						<{if $smarty.session.authorityaud or authorityapp or authorityret}>    <{*“专利管理”模块访问权限设置，有授权的才显示*}>
						<h4 onclick="domenu(this, 'list21')" class="tit">--专利管理--</h4>
						<ul id="list21">
							<li><a class="list" href="<{$app}>/patent/add" target="main">添加专利</a></li>
							<li><a class="list" href="<{$app}>/patent" target="main">编辑专利</a></li>
						
						</ul>
						
						<{else}>
							<h4>没有“专利管理”权限</h4>
					
						<{/if}>
					</div>

					<div>
					<{if $smarty.session.useradmin}>  <{*“用户管理”模块访问权限设置，有授权的才显示。*}>
						<h4 onclick="domenu(this, 'list31')" class="tit">--用户组管理--</h4>
						<ul id="list31">
							<li><a class="list" href="<{$app}>/usergroup/add" target="main">添加用户组</a></li>
							<li><a class="list" href="<{$app}>/usergroup" target="main">编辑用户组</a></li>
						</ul>
						<h4 onclick="domenu(this, 'list32')" class="tit">--用户管理--</h4>
						<ul id="list32">
							<li><a class="list" href="<{$app}>/hyuser/add" target="main">添加用户</a></li>
							<li><a class="list" href="<{$app}>/hyuser" target="main">编辑用户</a></li>
						</ul>
					<{else}>
						<h4>没有"用户管理"权限</h4>
					<{/if}>
					</div>
					
					
				</div>
			</div>
		</div>
<{include file="public/footer.tpl"}>


