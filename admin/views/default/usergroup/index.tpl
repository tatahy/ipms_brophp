<{include file="public/header.tpl"}>
		<div id="main">
			<div class="head-dark-box">
				<div class="tit">系统管理>用户组管理>编辑用户组</div>
			</div>	
		    <{ include file="public/title.tpl" }>	  
			<div class="msg-box">
				<ul class="viewmess">
				
					<li class="dark-row">
						<span class="list_width width_font">用户名</span>
						<span class="list_width width_font" style="width:400px">用户组描述</span>
						<span class="list_width width_font">操&nbsp;&nbsp;作</span>
					</li>
				        <{ section name=doc loop=$usergroups }>
						<li class="<{if $smarty.section.doc.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:10px; padding-bottom:10px">
							
							<span style="font-weight:bold" class="list_width"><a href="<{$app}>/user/index/gid/<{$usergroups[doc].groupid}>"><{ $usergroups[doc].groupname }></a></span>
							
							<span class="list_width" style="width:400px"><{ $usergroups[doc].groupdes|truncate:"50" }></span>
						
							<span class="list_width" style="width:160px;">
						
							【<a href="<{$url}>/mod/groupid/<{ $usergroups[doc].groupid }>">修改</a>】
							<{ if $usergroups[doc].groupid ne 1 }>
							【<a onclick="return confirm('确定要删除用户组【<{ $usergroups[doc].groupname }>】吗？')" href="<{$url}>/del/groupid/<{ $usergroups[doc].groupid }>">删除</a>】
							<{ /if }>
							</span>
						</li>
					<{ /section }>
				</ul>	
			</div>
                   
		</div>
<{include file="public/footer.tpl"}>	


