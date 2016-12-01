<{ include file="public/header.tpl" }>
	<div id="main">

        <div class="head-dark-box">
				<div class="tit"><span class="red_font"><{$kind}>&nbsp;&nbsp;搜索结果</span>&nbsp;--&nbsp;类型:(<{$type}>)&nbsp;状态:(<{$status}>)&nbsp;部门:(<{$dept}>)</div>
        </div>
        
        <div class="msg-box">
				<div class="mar">
                    <ul class="viewmess">
                    	<li class="dark-row">
                            <span class="list_width width_font" style="width:30px">序号</span>
                            <span class="list_width width_font" style="width:200px">题&nbsp;&nbsp;目</span>
                            <span class="list_width width_font" style="width:100px">类&nbsp;&nbsp;型</span>
        					<span class="list_width width_font" style="width:50px">状&nbsp;&nbsp;态</span>
                            <span class="list_width width_font" style="width:150px">部&nbsp;&nbsp;门</span>
                            <{ if $status eq "不限"}>
                            <span class="list_width width_font" style="width:100px">填报日期</span>
                            <{ else }>
                            <span class="list_width width_font" style="width:100px"><{$status}>日期</span>
                            <{ /if}>
          
                        </li>
                        <{*从search.class.php的index操作中分配的$sets*}>
                        <{ section name=doc loop=$sets }>
        						<li class="<{if $smarty.section.doc.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc.index + 1 }></span>
        							<span class="list_width" style="width:200px"><{ $sets[doc].topic }></span>
                                    <span class="list_width" style="width:100px"><{ $sets[doc].type }></span>
                                    <span class="list_width" style="width:50px"><{ $sets[doc].status}></span>
        							<span class="list_width" style="width:150px"><{ $sets[doc].dept}></span>
                                    <span class="list_width" style="width:100px"><{ $sets[doc].date}></span>
        				
        						</li>
        				<{ sectionelse }>
        						<li class="light-row">
        							没有专利
        						</li>	
        				
                        <{ /section }>
                        
                        <li class="dark-row" style="text-align:right">
                          <{$fpage}>
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