<{include file="public/header.tpl"}>
		<div id="main">
			<div class="head-dark-box">
				<div class="tit">系统管理>用户管理>管理用户</div>
			</div>	
		    <{ include file="public/title.tpl" }>	  
			<div class="msg-box">
				<ul class="viewmess">
					  <form  method="post" action="<{$url}>/del/page/<{$page}><{if $search}>/search/<{$search}><{/if}>
                      <{if $gid}>/gid/<{$gid}><{/if}><{if $disable}>/disable/<{$disable}><{/if}>" 
                      onsubmit="return confirm('你确定要删除选中的用户吗?')" >
					<{if $disable ne 1}>
					<li class="light-row">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户组：<{$select}> &nbsp;&nbsp;  
                        <{*本行为注释行，<{$select}>可视为一个占位符，其内容由controls/hyuser.class.php调用/models/usergroup.class.php里的formselect函数生成*}>

						输入需要查找的用户名：
						<input type="text" size="20" id="sea" name="username" value="<{$search}>"> 
						<input onclick="search()" type="button" class="button" value="搜索用户">
					
					</li>

					<script>
						var sel=document.getElementById("sel");
						
						sel.onchange=function(){
							var gid=this.options[this.selectedIndex].value;
							window.location="<{$url}>/index/gid/"+gid;
						}
						function search(){
							var gid=sel.options[sel.selectedIndex].value;
							var sval=document.getElementById("sea").value;	
							window.location="<{$url}>/index/gid/"+gid+"/search/"+sval;
						}
					</script>  
					<{/if}>
					
					<li class="dark-row">
						<span class="list_width width_font">用户名</span>
						<span class="list_width width_font" style="width:200px">部门名称</span>
						<span class="list_width width_font">注册时间</span>
                        <span class="list_width width_font">用户组</span>
						<span class="list_width width_font">操&nbsp;&nbsp;作</span>
					</li>
				        <{ section name=doc loop=$users }>
						<li class="<{if $users[doc].disable eq 1}>red-row<{elseif $smarty.section.doc.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
							<{ if $users[doc].disable eq 1 }>
								<span class="list_width red_font">	
							<{ else }>
								<span class="list_width">
							<{/if}>
							<{ if $users[doc].userid ne 1 }>
								<input type="checkbox" name="userid[]"  value="<{ $users[doc].userid }>">
							<{ /if }>
                            <{*本行为注释行，{$res}>/js/menu.js中73行需要用到变量"userid[]"。*}>   
						
						
							<a target="_blank" href="<{$root}>/index.php/hyuser/index/userid/<{$users[doc].userid}>"><{ $users[doc].username }></a>
							</span>
							
							<span class="list_width" style="width:200px"><{ $users[doc].dept }></span>
							<span class="list_width"><{ $users[doc].regdate|date_format:"%Y-%m-%d" }></span>
				            <span class="list_width" style="width:200px"><{ $users[doc].groupname }></span>
							<span class="list_width" style="width:160px;">
						
							【<a href="<{$url}>/mod/userid/<{ $users[doc].userid }>">修改</a>】
							<{ if $users[doc].userid ne 1 }>
							【<a onclick="return confirm('确定要删除用户【<{ $users[doc].username }>】吗？')" href="<{$url}>/del/userid/<{ $users[doc].userid }>/page/<{$page}><{if $search}>/search/<{$search}><{/if}><{if $groupid}>/groupid/<{$groupid}><{/if}><{if $disable}>/disable/<{$disable}><{/if}>">删除</a>】
							<{ /if }>
							</span>
						</li>
					<{ sectionelse }>
						<li class="light-row">
							该页没有用户
						</li>
					<{ /section }>
                    
                    <{*
                    循环预计<{$smarty.section.doc.index}>次<br>
                    循环共<{$smarty.section.doc.total}>次<br>
                    *}>
				
					<li class="dark-row">
						<span class="col_width" style="margin-left:15px;width:240px"> 
							<a href="javascript:select()">全选</a>/<a href="javascript:fanselect()">反选</a>/<a href="javascript:noselect()">全不选</a>&nbsp;&nbsp;选中项: 
							
							<input  name="dels" type="image" title="删除" value="delete" src="<{$res}>/images/delete.gif">&nbsp;&nbsp;
						 </span> 
					</li>
				
					<li class="dark-row" style="text-align:right">
						
							<{$fpage}>
					</li>
					 </form>
				</ul>	
			</div>
                   
		</div>
<{include file="public/footer.tpl"}>	


