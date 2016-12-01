<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        
        <div class="head-dark-box">
            <{if $smarty.session.groupname eq "超级管理员" or $smarty.session.groupname eq "批准人" or $smarty.session.groupname eq "维护人"}>
                <div class="tit"><span class="red_font">研究院专利</span> ——【<span class="red_font"><{$cstatus}></span>】状态</div>
            <{elseif $smarty.session.groupname eq "审核人" or $smarty.session.groupname eq "撰写人"}>
           	    <div class="tit"><span class="red_font">部门专利</span> ——【<span class="red_font"><{$cstatus}></span>】状态</div>
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
                            <span class="list_width width_font" style="width:100px">类&nbsp;&nbsp;型</span>
                            <span class="list_width width_font" style="width:80px">状&nbsp;&nbsp;态</span>
                            <span class="list_width width_font" style="width:80px">撰写人</span>
        					<span class="list_width width_font" style="width:100px">部门名称</span>
                            <span class="list_width width_font" style="width:100px"><{$cstatus }>日期</span>

                        </li>
                        
                        <{*从patent.class.php的patlist操作中分配的$sets_pat带有登录用户的权限信息和可访问的专利信息*}>
                        <{ section name=doc_pat loop=$sets_pat }>
        						<li class="<{if $smarty.section.doc_pat.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc_pat.index + 1 }></span>
                                    
                                    <{*专利名称可链接到该专利的状态页面operate_status.tpl，同时传送pat_id、登录用户的uid值*}>
                                    <span class="list_width"><a href="<{$url}>/operate_status/pat_id/<{ $sets_pat[doc_pat].pat_id }>/uid/<{$uid}>" target="_self">【<{ $sets_pat[doc_pat].pattopic }>】</a></span>                                    
                                    
                                    <span class="list_width width_font" style="width:100px"><{ $sets_pat[doc_pat].pattype }></span>
                                    <{*专利状态可链接到该专利的整个审批过程，即是显示ipms_process表中oprobjid=pat_id的所有记录 *}>
        							<span class="list_width" style="width:80px"><a href="<{$app}>/process/index/oprobjid/<{ $sets_pat[doc_pat].pat_id }>/topic/<{ $sets_pat[doc_pat].pattopic }>" target="_blank">【<{ $sets_pat[doc_pat].status }>】</a></span>
                                    <span class="list_width" style="width:80px"><{ $sets_pat[doc_pat].writer }></span>
                                    <span class="list_width" style="width:100px"><{ $sets_pat[doc_pat].dept}></span>
        							<span class="list_width" style="width:100px"><{ $sets_pat[doc_pat].date|date_format:"%Y-%m-%d" }></span>

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



<{if $smarty.get.flush}>
	<script>
		window.top.frames.menu.location.reload();
	</script>
<{/if}>
</body>
<{include file="hyuser/footer.tpl"}>
				
