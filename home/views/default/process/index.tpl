<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        
        <div class="head-dark-box">
				<div class="tit"><span class="red_font">专利</span> 【<{ $topic }>】—— 过程记录</div>
        </div>
        
        <div class="msg-box">
				<div class="mar">
                    <ul class="viewmess">
                    	<li class="dark-row">
                            <span class="list_width width_font" style="width:30px">序号</span>
                            <span class="list_width width_font" style="width:80px">操作人</span>
                            <span class="list_width width_font" style="width:100px">系统角色</span>
                            <span class="list_width width_font" style="width:150px">操&nbsp;&nbsp;作</span>
                            <span class="list_width width_font" style="width:200px">时间</span>
        					<span class="list_width width_font" >说&nbsp;&nbsp;明</span>
          
                        </li>
                        <{*从patent.class.php的index操作中分配的$sets_pro带有登录用户的权限信息和可访问的专利信息*}>
                        <{ section name=doc_pro loop=$sets_pro }>
        						<li class="<{if $smarty.section.doc_pro.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc_pro.index + 1 }></span>
                                    <span class="list_width" style="width:80px"><{ $sets_pro[doc_pro].username }></span>
                                    <span class="list_width" style="width:100px"><{ $sets_pro[doc_pro].groupname }></span>
        							<span class="list_width" style="width:150px"><{ $sets_pro[doc_pro].oprreason }></span>
                                    <span class="list_width" style="width:200px"><{ $sets_pro[doc_pro].oprdate }></span>
                                    <span class="list_width" ><{ $sets_pro[doc_pro].note }></span>
        				
        						</li>
        				<{ sectionelse }>
        						<li class="light-row">
        							没有记录
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
				
