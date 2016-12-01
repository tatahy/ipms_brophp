<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        
        <div class="head-dark-box">
				<div class="tit"><span class="red_font">待处理论文</span> ——【<span class="red_font"><{$cstatus}></span>】状态</div>
        </div>
        
        <div class="msg-box">
				<div class="mar">
                    <ul class="viewmess">
                    	<li class="dark-row">
                            <span class="list_width width_font" style="width:30px">序号</span>
                            <span class="list_width width_font">题&nbsp;&nbsp;目</span>
                            <span class="list_width width_font" style="width:100px">类&nbsp;&nbsp;型</span>
                            <span class="list_width width_font" style="width:80px">状&nbsp;&nbsp;态</span>
                            <span class="list_width width_font" style="width:80px">撰写人</span>
        					<span class="list_width width_font" style="width:100px">部门名称</span>
                            <span class="list_width width_font" style="width:100px"><{$cstatus }>日期</span>
                            <span class="list_width width_font">操&nbsp;&nbsp;作</span>
          
                        </li>
                        
                        <{*从thesis.class.php的thelist操作中分配的$sets_the带有登录用户的权限信息和可访问的论文信息*}>
                        <{ section name=doc_the loop=$sets_the }>
        						<li class="<{if $smarty.section.doc_the.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc_the.index + 1 }></span>
                                    
                                    <{*论文名称可链接到该论文的状态页面operate_status.tpl，同时传送the_id、登录用户的uid值*}>
                                    <span class="list_width"><a href="<{$url}>/operate_status/the_id/<{ $sets_the[doc_the].the_id }>/uid/<{$uid}>/operate/1" target="_self">【<{ $sets_the[doc_the].thetopic }>】</a></span>                                    
                                    
                                    <span class="list_width width_font" style="width:100px"><{ $sets_the[doc_the].thetype }></span>
                                    <{*论文状态可链接到该论文的整个审批过程，即是显示ipms_process表中oprobjid=the_id的所有记录 *}>
        							<span class="list_width" style="width:80px"><a href="<{$app}>/process/index/oprobjid/<{ $sets_the[doc_the].the_id }>/topic/<{ $sets_the[doc_the].thetopic }>" target="_blank">【<{ $sets_the[doc_the].status }>】</a></span>
                                    <span class="list_width" style="width:80px"><{ $sets_the[doc_the].writer }></span>
                                    <span class="list_width" style="width:100px"><{ $sets_the[doc_the].dept}></span>
        							<span class="list_width" style="width:100px"><{ $sets_the[doc_the].date|date_format:"%Y-%m-%d" }></span>
                                    
                                    <{*状态不同，可进行的操作不同。并且非"超级管理员"或"批准人"的登录账号，thesis中的uid需要与登录的uid一致才显示操作*}>
                                    <span class="list_width">
                                    <{ if $sets_the[doc_the].groupname eq "超级管理员" || $sets_the[doc_the].groupname eq "批准人"}>
                                        <{ if $sets_the[doc_the].status eq '填报' && $sets_the[doc_the].authorityadd eq 1}>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修订</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                            【<a href="<{$url}>/del_temp/the_id/<{ $sets_the[doc_the].the_id }>">删除</a>】
                                            
                                        <{ elseif $sets_the[doc_the].status eq '修改' && $sets_the[doc_the].authorityadd eq 1}>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修订</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                            
                                        <{ elseif $sets_the[doc_the].status eq '提交' && $sets_the[doc_the].authorityaud eq 1 }>
                                            【<a href="<{$url}>/aud/the_id/<{ $sets_the[doc_the].the_id }>">审核</a>】
                                            【<a href="<{$url}>/ret/the_id/<{ $sets_the[doc_the].the_id }>">退回</a>】
                                            
                                        <{ elseif $sets_the[doc_the].status eq '审核' && $sets_the[doc_the].authorityapp eq 1 }>
                                            【<a href="<{$url}>/app/the_id/<{ $sets_the[doc_the].the_id }>">批准</a>】
                                            【<a href="<{$url}>/ret/the_id/<{ $sets_the[doc_the].the_id }>">退回</a>】
                                            
                                        <{ elseif $sets_the[doc_the].status eq '退回' && $sets_the[doc_the].authorityadd eq 1 }>  
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修订</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                        <{ else }><{*状态为“批准（app）”，无需操作*}>
                                           
                                        <{ /if }>
                                     <{ elseif $sets_the[doc_the].groupname eq "审核人" || $sets_the[doc_the].groupname eq "撰写人" }> <{*"审核人"、"撰写人"，thesis中的uid需要与登录的uid一致才显示操作*}>  
                                        <{ if $sets_the[doc_the].status eq '填报' && $sets_the[doc_the].groupname eq "撰写人" && $sets_the[doc_the].uid eq $uid }>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修订</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                            【<a href="<{$url}>/del_temp/the_id/<{ $sets_the[doc_the].the_id }>">删除</a>】
                                        <{ elseif $sets_the[doc_the].status eq '修改' && $sets_the[doc_the].groupname eq "撰写人" && $sets_the[doc_the].uid eq $uid}>
                                             <{*状态为“修改（mod）”(表示提交后被审核人退回修改)，可进行“修改（mod）”,“提交（sub）”操作*}>
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修订</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                        <{ elseif $sets_the[doc_the].status eq '提交' && $sets_the[doc_the].authorityaud eq 1 }>
                                            【<a href="<{$url}>/aud/the_id/<{ $sets_the[doc_the].the_id }>">审核</a>】
                                            【<a href="<{$url}>/ret/the_id/<{ $sets_the[doc_the].the_id }>">退回</a>】
                                        <{ elseif $sets_the[doc_the].status eq '审核' && $sets_the[doc_the].authorityapp eq 1 }>
                                            【<a href="<{$url}>/app/the_id/<{ $sets_the[doc_the].the_id }>">批准</a>】
                                            【<a href="<{$url}>/ret/the_id/<{ $sets_the[doc_the].the_id }>">退回</a>】
                                        <{ elseif $sets_the[doc_the].status eq '退回' && $sets_the[doc_the].groupname eq "撰写人" && $sets_the[doc_the].uid eq $uid}> 
                                            【<a href="<{$url}>/mod/the_id/<{ $sets_the[doc_the].the_id }>" target="_self">修订</a>】
                                            【<a href="<{$url}>/sub/the_id/<{ $sets_the[doc_the].the_id }>">提交</a>】
                                        <{ else }><{*状态为“批准（app）”，无需操作*}>
                                            
                                        <{ /if }>
                                    <{ else }>
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
                        
                        <li class="dark-row" style="text-align:right">
                            <{$fpage_the}>
                        </li>
                        
                    </ul>
                
                </div>
        </div>
                
        
    
    
    </div>



<{if $smarty.get.flush}>
	<script>
		window.top.frames.menu.location.reload();
	</script>
<{/if}>
</body>
<{include file="hyuser/footer.tpl"}>
				
