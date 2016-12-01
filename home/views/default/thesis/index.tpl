<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        
        <div class="head-dark-box">
            <{if $smarty.session.groupname eq "超级管理员" or $smarty.session.groupname eq "批准人" or $smarty.session.groupname eq "维护人"}>
                <div class="tit"><span class="red_font">研究院论文</span> —— 总表</div>
            <{elseif $smarty.session.groupname eq "审核人" or $smarty.session.groupname eq "撰写人"}>
                <div class="tit"><span class="red_font">部门论文</span> —— 总表</div>
            <{else}>
                <div class="tit"><span class="red_font">出错</div>
            <{/if}>
            
        </div>
                        
        <div class="msg-box">
				<div class="mar">
                    <ul class="viewmess">
                    	<li class="dark-row">
                            <span class="list_width width_font" style="width:30px">序号</span>
                            <span class="list_width width_font">题&nbsp;&nbsp;目</span>
                            <span class="list_width width_font" style="width:100px"><a href="<{$app}>/thesis/index/str/thetype">类&nbsp;&nbsp;型^</a></span>
                            <span class="list_width width_font" style="width:80px"><a href="<{$app}>/thesis/index/str/status">状&nbsp;&nbsp;态^</a></span>
                            <span class="list_width width_font" style="width:80px"><a href="<{$app}>/thesis/index/str/writer">撰写人^</a></span>
        					<span class="list_width width_font" style="width:100px"><a href="<{$app}>/thesis/index/str/dept">部门名称^</a></span>
                            <span class="list_width width_font" style="width:100px"><a href="<{$app}>/thesis/index/str/adddate">填报日期^</a></span>
                            
          
                        </li>
                        <{*从thesis.class.php的index操作中分配的$sets_the带有登录用户的权限信息和可访问的专利信息*}>
                        <{ section name=doc_the loop=$sets_the }>
        						<li class="<{if $smarty.section.doc_the.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc_the.index + 1 }></span>
                                    
                                    <{*论文名称可链接到该论文的状态页面operate_status.tpl，同时传送the_id、登录用户的uid值*}>
                                    <span class="list_width"><a href="<{$url}>/operate_status/the_id/<{ $sets_the[doc_the].the_id }>/uid/<{$uid}>" target="_self">【<{ $sets_the[doc_the].thetopic }>】</a></span>
                                    
                                    <span class="list_width width_font" style="width:100px"><{ $sets_the[doc_the].thetype }></span>
                                    
                                    <{*论文状态可链接到该论文的整个审批过程，即是显示ipms_process表中oprobjid=the_id的所有记录 *}>
        							<span class="list_width" style="width:80px"><a href="<{$app}>/process/index/oprobjid/<{ $sets_the[doc_the].the_id }>/topic/<{ $sets_the[doc_the].thetopic }>" target="_blank">【<{ $sets_the[doc_the].status }>】</a></span>
                                    
                                    <span class="list_width" style="width:80px"><{ $sets_the[doc_the].writer }></span>
                                    <span class="list_width" style="width:100px"><{ $sets_the[doc_the].dept}></span>
        							<span class="list_width" style="width:100px"><{ $sets_the[doc_the].adddate|date_format:"%Y-%m-%d" }></span>
           				
        						</li>
        				<{ sectionelse }>
        						<li class="light-row">
        							没有专利
        						</li>	
        				
                        <{ /section }>
                        
                        <li class="dark-row" style="text-align:right">
                            <{$fpage_pat}>
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
				
