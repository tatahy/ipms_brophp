<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        
        <div class="head-dark-box">
            <{if $smarty.session.groupname eq '撰写人'}> 
                <div class="tit"><span class="red_font">我的待处理论文</span> —— 总表</div>
            <{elseif $smarty.session.groupname eq '审核人' or $smarty.session.groupname eq '批准人' or $smarty.session.groupname eq '维护人'}>
                <div class="tit"><span class="red_font">待处理论文</span> —— 总表</div>
            <{else}>
                <div class="tit"><span class="red_font">论文总表</div>
            <{/if}>
            
        </div>
        
        <div class="msg-box">
				<div class="mar">
                    <ul class="viewmess">
                    	<li class="dark-row">
                            <span class="list_width width_font" style="width:30px">序号</span>
                            <span class="list_width width_font">题&nbsp;&nbsp;目</span>
                            <span class="list_width width_font" style="width:100px"><a href="<{$app}>/thesis/my_index/str/thetype">类&nbsp;&nbsp;型^</a></span>
                            <span class="list_width width_font" style="width:80px"><a href="<{$app}>/thesis/my_index/str/status">状&nbsp;&nbsp;态^</a></span>
                            <span class="list_width width_font" style="width:80px"><a href="<{$app}>/thesis/my_index/str/writer">撰写人^</a></span>
        					<span class="list_width width_font" style="width:100px"><a href="<{$app}>/thesis/my_index/str/dept">部门名称^</a></span>
                            <span class="list_width width_font" style="width:100px"><a href="<{$app}>/thesis/my_index/str/adddate">填报日期^</a></span>
                            <span class="list_width width_font">操&nbsp;&nbsp;作</span>
          
                        </li>
                        <{*从thesis.class.php的index操作中分配的$sets_the带有登录用户的权限信息和可访问的论文信息*}>
                        <{ section name=doc_the loop=$sets_the }>
        						<li class="<{if $smarty.section.doc_the.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc_the.index + 1 }></span>
                                    
                                    <{*论文名称可链接到该论文的状态页面operate_status.tpl，同时传送the_id、登录用户的uid值*}>
                                    <span class="list_width"><a href="<{$url}>/operate_status/the_id/<{ $sets_the[doc_the].the_id }>/uid/<{$uid}>/operate/1" target="_self">【<{ $sets_the[doc_the].thetopic }>】</a></span>
                                    
                                    <{*论文名称可链接到该论文的修改页面，同时传送the_id值
                                    <span class="list_width"><a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self"><{ $sets_the[doc_the].thetopic }></a></span>
                                    *}>
                                    
                                    <span class="list_width width_font" style="width:100px"><{ $sets_the[doc_the].thetype }></span>
                                    
                                    <{*论文状态可链接到该论文的整个审批过程，即是显示ipms_process表中oprobjid=the_id的所有记录 *}>
        							<span class="list_width" style="width:80px"><a href="<{$app}>/process/index/oprobjid/<{ $sets_the[doc_the].the_id }>/topic/<{ $sets_the[doc_the].thetopic }>" target="_blank">【<{ $sets_the[doc_the].status }>】</a></span>
                                    
                                    <span class="list_width" style="width:80px"><{ $sets_the[doc_the].writer }></span>
                                    <span class="list_width" style="width:100px"><{ $sets_the[doc_the].dept}></span>
        							<span class="list_width" style="width:100px"><{ $sets_the[doc_the].adddate|date_format:"%Y-%m-%d" }></span>
                                    
                                    <{*状态不同，可进行的操作不同，并且非"超级管理员"或"批准人"的登录账号，thesis中的uid需要与登录的uid一致才显示操作*}>
                                    <span class="list_width">
                                     <{ if $sets_the[doc_the].groupname eq "超级管理员" || $sets_the[doc_the].groupname eq "批准人"}>
                                        <{ if $sets_the[doc_the].status eq '填报' && $sets_the[doc_the].authorityadd eq 1 }>
                                              <{*状态为“新增（add）”，可进行“修改（mod）”，“删除（del）”,“提交（sub）”操作*}>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修改</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                            【<a href="<{$url}>/del_temp/the_id/<{ $sets_the[doc_the].the_id }>">删除</a>】
                                        <{ elseif $sets_the[doc_the].status eq '修改' && $sets_the[doc_the].authorityadd eq 1 }>
                                              <{*状态为“修改（mod）”(表示提交后被审核人退回修改)，可进行“修改（mod）”,“提交（sub）”操作*}>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修改</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                        <{ elseif $sets_the[doc_the].status eq '提交' && $sets_the[doc_the].authorityaud eq 1 }>
                                             <{*状态为“提交（sub）”，可进行“审核（aud）”，“退回（ret）”操作*}>
                                            【<a href="<{$url}>/aud/the_id/<{ $sets_the[doc_the].the_id }>">审核</a>】
                                            【<a href="<{$url}>/ret/the_id/<{ $sets_the[doc_the].the_id }>">退回</a>】
                                        <{ elseif $sets_the[doc_the].status eq '审核' && $sets_the[doc_the].authorityapp eq 1 }>
                                             <{*状态为“审核（aud）”，可进行“批准（app）”,“退回（ret）”操作*}>
                                            【<a href="<{$url}>/app/the_id/<{ $sets_the[doc_the].the_id }>">批准</a>】
                                            【<a href="<{$url}>/ret/the_id/<{ $sets_the[doc_the].the_id }>">退回</a>】
                                        <{ elseif $sets_the[doc_the].status eq '退回' && $sets_the[doc_the].authorityadd eq 1 && $sets_the[doc_the].uid eq $uid}>    
                                              <{*状态为“退回（ret）”(表示已提交，但被批准人退回修改)，可进行“修改（mod）”，“提交（sub）”操作*}>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修改</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                        <{ else }><{*状态为“批准（app）”，无需操作*}>
                                            
                                        <{ /if }>
                                     <{ elseif $sets_the[doc_the].groupname eq "审核人" || $sets_the[doc_the].groupname eq "撰写人" }> 
                                        
                                        <{ if $sets_the[doc_the].status eq '填报' && $sets_the[doc_the].authorityadd eq 1 && $sets_the[doc_the].uid eq $uid }>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修改</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                            【<a href="<{$url}>/del_temp/the_id/<{ $sets_the[doc_the].the_id }>">删除</a>】
                                        <{ elseif $sets_the[doc_the].status eq '修改' && $sets_the[doc_the].authorityadd eq 1 && $sets_the[doc_the].uid eq $uid}>
                                             <{*状态为“修改（mod）”(表示提交后被审核人退回修改)，可进行“修改（mod）”,“提交（sub）”操作*}>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修改</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                        <{ elseif $sets_the[doc_the].status eq '提交' && $sets_the[doc_the].authorityaud eq 1 }>
                                            【<a href="<{$url}>/aud/the_id/<{ $sets_the[doc_the].the_id }>">审核</a>】
                                            【<a href="<{$url}>/ret/the_id/<{ $sets_the[doc_the].the_id }>">退回</a>】
                                        <{ elseif $sets_the[doc_the].status eq '审核' && $sets_the[doc_the].authorityapp eq 1 }>
                                            【<a href="<{$url}>/app/the_id/<{ $sets_the[doc_the].the_id }>">批准</a>】
                                            【<a href="<{$url}>/ret/the_id/<{ $sets_the[doc_the].the_id }>">退回</a>】
                                        <{ elseif $sets_the[doc_the].status eq '退回' && $sets_the[doc_the].authorityadd eq 1 && $sets_the[doc_the].uid eq $uid}> 
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修改</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                        <{ else }>
                                            
                                        <{ /if }>
                                        
                                    <{ else }><{*$sets_the[doc_the].groupname eq "维护人"*}>
                                        <{ if $sets_the[doc_the].status eq '批准' || $sets_the[doc_the].status eq '投稿'}>
                                            【<a href="<{$url}>/maintain/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">维护</a>】
                                        <{ elseif $sets_the[doc_the].status eq '收录' || $sets_the[doc_the].status eq '拒稿' || $sets_the[doc_the].status eq '出版' }>
                                            【<a href="<{$url}>/maintain/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">维护</a>】    
                                        <{ /if }>
                                    <{ /if }> 
                                    </span>
        				
        						</li>
        				<{ sectionelse }>
        						<li class="light-row">
        							没有论文
        						</li>	
        				
                        <{ /section }>
        				              
        				<li class="light-row">
                            <{if $smarty.session.authorityadd eq 1}>  <{*authorityadd为1的才显示。*}>                            
                                 <{*按钮实现跳转到add页面的操作*}>
                                <span class="col_width"> &nbsp; </span>
                                <span class="list_width" style="width:100px"></span>
                                    <form  method="post" action="<{$url}>/hynew">
                                        <input type="hidden" name="uid" value="<{$uid}>"/>
                                        <input type="hidden" name="writer" value="<{$writer}>"/>
                                        <input type="submit" class="button" value="新 增" />
                                    </form>
                                 
                                <{*用超链接实现跳转到add页面的操作
                                <input type="submit" class="button" value="新 增" formaction="<{$url}>/index/uid/<{$uid}>/writer/<{$writer}>"/>
                                *}>
                                
                            <{else}>
                                 <{*<h4>没有"新增论文"权限</h4>*}>
                            <{/if}>
                        </li>
                        
                        <li class="dark-row" style="text-align:right">
                            <{$fpage_the}>
                        </li>
                        
                    </ul>
                
                </div>
        </div>
                
        
    
    
    </div>



<{if $flush}>
	<script>
		window.top.frames["menu"].location.reload(true);
	</script>
<{/if}>
</body>
<{include file="hyuser/footer.tpl"}>				
