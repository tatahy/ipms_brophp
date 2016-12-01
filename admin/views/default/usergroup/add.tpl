<{include file="public/header.tpl"}>
		<div id="main">
			<div class="head-dark-box">
				<div class="tit">系统管理>用户组管理>添加用户组</div>
			</div>	
		    <{ include file="public/title.tpl" }>
		    <form  method="post" action="<{$url}>/insert">
			<div class="msg-box">
				<ul class="viewmess">
					<li class="light-row">
						<span class="col_width">用户组名&nbsp;&nbsp;&nbsp;<span class="red_font">*</span></span>
						<input name="groupname" type="text"  value="<{$post.groupname}>" class="text-box">
						可以使用中文，但禁止除[@][.]以外的特殊符号
					</li>
					
					<li class="dark-row">
						<span class="col_width" style="margin-top:30px">组描述<span class="red_font">*</span></span>
						<textarea class="text-box" name="groupdes" cols="40" rows="5"><{ $post.groupdes }></textarea>
					</li>	
					
				    <li class="light-row">
						<span class="col_width">设置权限</span>
						<span style="height:30px;">				
							<label for="q1"><input id="q1" <{if $post.authorityadd eq 1}>checked<{/if}> type="checkbox" name="authorityadd" value="1"> 添加(Add)</label>&nbsp;&nbsp;
							<label for="q2"><input id="q2" <{if $post.authoritymod eq 1}>checked<{/if}> type="checkbox" name="authoritymod" value="1"> 修改(Mod)</label>&nbsp;&nbsp;
							<label for="q3"><input id="q3" <{if $post.authoritysub eq 1}>checked<{/if}> type="checkbox" name="authoritysub" value="1"> 提交(Sub)</label>
						</span><br>
						<span class="col_width">&nbsp;</span>
						<span  style="height:30px;">
							<label for="q4"><input id="q4" <{if $post.authorityaud eq 1}>checked<{/if}> type="checkbox" name="authorityaud" value="1"> 审核(Aud)</label>&nbsp;&nbsp;
							<label for="q5"><input id="q5" <{if $post.authorityapp eq 1}>checked<{/if}> type="checkbox" name="authorityapp" value="1"> 批准(App)</label>&nbsp;&nbsp;
							<label for="q6"><input id="q6" <{if $post.authorityret eq 1}>checked<{/if}> type="checkbox" name="authorityret" value="1"> 退回(Ret)</label>
        					</span><br>
                        <span class="col_width">&nbsp;</span>
						<span  style="height:30px;">
							<label for="q7"><input id="q7" <{if $post.maintain eq 1}>checked<{/if}> type="checkbox" name="maintain" value="1"> 维护管理(Maintain)</label>&nbsp;
                            <label for="q8"><input id="q8" <{if $post.useradmin eq 1}>checked<{/if}> type="checkbox" name="useradmin" value="1"> 用户管理(userAdmin)</label>&nbsp;    
                        </span>   
					</li>
				
					<li class="dark-row">
						<span class="col_width"> &nbsp; </span>
						<input type="submit" class="button"  value="添 加">&nbsp;&nbsp;
						<input type="reset" class="button" value="重 置">
					</li>
				</ul>	
			</div>
                    </form>	
		</div>
<{include file="public/footer.tpl"}>	


