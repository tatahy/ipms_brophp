<{ include file="public/header.tpl" }>



	<div id="main">

        <div class="head-dark-box">
				<div class="tit"><span class="red_font">所有论文列表</span></div>
        </div>
        
        <div class="msg-box">
				<div class="mar">
                    <ul class="viewmess">
                    	<li class="dark-row">
                            <span class="list_width width_font" style="width:30px">序号</span>
                            <span class="list_width width_font" style="width:200px">题&nbsp;&nbsp;目</span>
                            <span class="list_width width_font" style="width:200px">类&nbsp;&nbsp;型</span>
        					<span class="list_width width_font" style="width:100px">状&nbsp;&nbsp;态</span>
                            <span class="list_width width_font" style="width:100px">所属部门</span>
          
                        </li>
                        <{*从thesis.class.php的index操作中分配的$sets_the带有登录用户的权限信息和可访问的专利信息*}>
                        <{ section name=doc_the loop=$sets_the }>
        						<li class="<{if $smarty.section.doc_the.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc_the.index + 1 }></span>
        							<span class="list_width" style="width:200px"><{ $sets_the[doc_the].thetopic }></span>
                                    <span class="list_width" style="width:200px"><{ $sets_the[doc_the].thetype }></span>
                                    <span class="list_width" style="width:100px"><{ $sets_the[doc_the].status}></span>
        							<span class="list_width" style="width:100px"><{ $sets_the[doc_the].dept}></span>
        				
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

