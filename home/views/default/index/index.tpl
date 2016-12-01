<{ include file="public/header.tpl" }>

	<div id="main">

        <div class="leftbox">
				
       				<div class="dt"><strong>专利概况</strong></div>
        			<div class="dd">
					
						<ul>
							<{if $smarty.session.login eq 1}>
                                <li>专利总数：（<{$pat_total}>）<a href="<{$app}>/index/index_patall">【所有专利列表】</a></li></p>
                                <li>专利总数：（<{$pat_total}>）</li></p>
                                <li>&nbsp;&nbsp;其中</li>
                                <li>&nbsp;&nbsp;&nbsp;&nbsp;新增专利数：（<{$pat_add}>）</li>
    							<li>&nbsp;&nbsp;&nbsp;&nbsp;有效专利数：（<{$pat_license}>）<a href="<{$app}>/index/index_patvalid">【有效专利列表】</a></li>
                            <{else}>
                                <li>&nbsp;&nbsp;&nbsp;&nbsp;有效专利数：（<{$pat_license}>）<a href="<{$app}>/index/index_patvalid">【有效专利列表】</a></li>
                                <li>&nbsp;&nbsp;</li>
                                <li>&nbsp;&nbsp;</li>
                                <li>&nbsp;&nbsp;</li>
                            <{/if}>
                            
						</ul>
					
					
       				</div>
			
       		 	</div>
           
         <div class="leftbox">
				
       				<div class="dt"><strong>论文概况</strong></div>
        			<div class="dd">
					
						<ul>
							<{if $smarty.session.login eq 1}>
                                <li>论文总数：（<{$the_total}>）<a href="<{$app}>/index/index_theall">【所有论文列表】</a></li></p>
                                <li>论文总数：（<{$the_total}>）</li></p>
                                <li>&nbsp;&nbsp;其中</li>
                                <li>&nbsp;&nbsp;&nbsp;&nbsp;新增论文数：（<{$the_add}>）</li>
    							<li>&nbsp;&nbsp;&nbsp;&nbsp;发表论文数：（<{$the_pub}>）<a href="<{$app}>/index/index_thepub">【发表论文列表】</a></li>
                            <{else}>
                                <li>&nbsp;&nbsp;&nbsp;&nbsp;发表论文数：（<{$the_pub}>）<a href="<{$app}>/index/index_thepub">【发表论文列表】</a></li>
                                <li>&nbsp;&nbsp;</li>
                                <li>&nbsp;&nbsp;</li>
                                <li>&nbsp;&nbsp;</li>
                            <{/if}>
                            
						</ul>
					
					
       				</div>
			
       		 	</div>
         
         <div class="nav"> </div>
       
       <{*
         
         <div class="leftbox">
				
       				<div class="dt"><strong>成果登记概况（开发中）</strong></div>
        			<div class="dd">
					
						<ul>
							<li>成果登记总数：</li></p>
                            <li>&nbsp;&nbsp;其中</li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;新增成果登记数：2222</li>
							<li>&nbsp;&nbsp;&nbsp;&nbsp;批准成果登记数：22222</li>
						</ul>
					
					
       				</div>
			
       		 	</div>
           
         <div class="leftbox">
				
       				<div class="dt"><strong>获奖概况（开发中）</strong></div>
        			<div class="dd">
					
						<ul>
							<li>获奖总数：</li></p>
                            <li>&nbsp;&nbsp;其中</li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;奖项申请数：2222</li>
							<li>&nbsp;&nbsp;&nbsp;&nbsp;奖项获批数：22222</li>
						</ul>
					
					
       				</div>
			
       		 	</div>

        	<div class="sidebox">
       			<div class="dt"><strong>最近更新（开发中）</strong></div>
        		 <div class="dd dot">
            			<ul>
					
						<li>目前没有任何更新</li>
				
          			</ul>
			</div>
       		 </div>
             
        *}>     
      
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

