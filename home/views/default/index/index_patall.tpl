<{ include file="public/header.tpl" }>



	<div id="main">

        <div class="head-dark-box">
				<div class="tit"><span class="red_font">所有专利列表</span></div>
        </div>
        
        <div class="msg-box">
				<div class="mar">
                    <ul class="viewmess">
                    	<li class="dark-row">
                            <span class="list_width width_font" style="width:30px">序号</span>
                            <span class="list_width width_font" style="width:200px">题&nbsp;&nbsp;目</span>
                            <span class="list_width width_font" style="width:200px"><a href="<{$app}>/index/index_patall/str/pattype">类&nbsp;&nbsp;型^</a></span>
        					<span class="list_width width_font" style="width:100px"><a href="<{$app}>/index/index_patall/str/status">状&nbsp;&nbsp;态^</a></span>
                            <span class="list_width width_font" style="width:100px"><a href="<{$app}>/index/index_patall/str/dept">部&nbsp;&nbsp;门^</a></span>
          
                        </li>
                        <{*从patent.class.php的index操作中分配的$sets_pat带有登录用户的权限信息和可访问的专利信息*}>
                        <{ section name=doc_pat loop=$sets_pat }>
        						<li class="<{if $smarty.section.doc_pat.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc_pat.index + 1 }></span>
        							<span class="list_width" style="width:200px"><{ $sets_pat[doc_pat].pattopic }></span>
                                    <span class="list_width" style="width:200px"><{ $sets_pat[doc_pat].pattype }></span>
                                    <span class="list_width" style="width:100px"><{ $sets_pat[doc_pat].status}></span>
        							<span class="list_width" style="width:100px"><{ $sets_pat[doc_pat].dept}></span>
        				
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

	<div class="nav"> </div>
	<div id="link">
       		<div class="dt"><strong><span>友情链接</span></strong></div>
        	<div class="dd">
               		<ul>
				<{ section name=ls loop=$links }>
					<li><a href="<{ $links[ls].url }>" target="_blank">
						<{ if $links[ls].list }>
							<img height="40" alt="<{ $links[ls].webname }>" src="<{$public}>/uploads/logos/<{ $links[ls].logo }>" border="0" >
						<{else}>
							<{ $links[ls].webname }>
						<{/if}>

					</a></li>
				<{ /section }>
          		</ul>
		</div>
      	 </div>
	<div class="nav"> </div>
<{ include file="public/footer.tpl" }>

