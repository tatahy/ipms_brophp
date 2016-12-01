<{include file="public/header.tpl"}>	
	<div id="top">
			<div class="left">
				<a herf="index.php"><img  border="0" src="<{$res}>/images/logo.gif"></a>
                <img src="<{$res}>/images/gzomelogo.gif">
			</div>

		
			<div class="right_tool">
					<ul>
						<li><a href="<{$root}>/index.php" target="_top"><img border=0 src="<{$res}>/images/exit4.gif"></a></li>
						<li><a href="<{$app}>/login/logout" onclick="return confirm('你确定要退出系统吗？')" target="_top"><img border=0 src="<{$res}>/images/exit3.gif"></a></li>
					</ul>
			</div>
			<div class="right_user">
				<b>欢迎您-</b><a title="<{$smarty.session.groupdes}>" target="_top" href="<{$root}>/index.php/hyuser/hyindex/uid/<{$smarty.session.userid}>"><{ $smarty.session.username }></a>&nbsp;【<{$smarty.session.groupname}>】 &nbsp;&nbsp;
			</div>
		</div>
<{include file="public/footer.tpl"}>
