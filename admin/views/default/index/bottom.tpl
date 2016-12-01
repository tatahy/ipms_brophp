<{include file="public/header.tpl"}>	
		<div id="bottom">
			<ul>
				<li class="left">版本：1.0demo&nbsp;&nbsp;作者：HY</li>
					<li class="right"> 
						本系统现有： &nbsp; 

					<{*	<{if $smarty.session.authorityapp}>
							<a target="main" href="<{$app}>/patent">专利【<span class="red_font"><{$patent}></span>】项</a>&nbsp; &nbsp; 
							
						<{/if}> *}>
						
						<{if $smarty.session.useradmin}>
							<a target="main" href="<{$app}>/hyuser">账号【<span class="red_font"><{$user_role}></span>】个 </a>&nbsp; &nbsp;用户【<span class="red_font"><{$user_num}></span>】个  
						<{/if}>
					</li>	
			</ul>	
		</div>
<{include file="public/footer.tpl"}>	


