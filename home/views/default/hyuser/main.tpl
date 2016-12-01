<{include file="hyuser/header.tpl"}>
		<div id="main">
			
            <div class="head-dark-box">
                <{if $smarty.session.groupname eq "超级管理员" or $smarty.session.groupname eq "批准人" or $smarty.session.groupname eq "维护人"}>
                    <div class="tit"><span class="red_font">研究院</span> —— 知识产权概况</div>
                <{elseif $smarty.session.groupname eq "审核人" or $smarty.session.groupname eq "撰写人"}>
                    <div class="tit"><span class="red_font"><{$smarty.session.dept}></span> —— 知识产权概况</div>
                <{else}>
                    <div class="tit"><span class="red_font">出错</div>
                <{/if}>				
                
			</div>
            
            <div class="leftbox">
				
       				<div class="dt"><strong>专利概况</strong></div>
        			<div class="dd">
					
						<ul>
							<li>专利总数：（<{$pat_total}>）</li></p>
                            <li>&nbsp;&nbsp;其中</li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;“填报”专利数：（<{$pat_add}>）</li>
							<li>&nbsp;&nbsp;&nbsp;&nbsp;有效专利数：（<{$pat_license}>）</p>（有效专利：“授权”和“维护”）
						</ul>
					
					
       				</div>
			
       		 	</div>
           
         <div class="leftbox">
				
       				<div class="dt"><strong>论文概况</strong></div>
        			<div class="dd">
					
						<ul>
							<li>论文总数：（<{$the_total}>）</li></p>
                            <li>&nbsp;&nbsp;其中</li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;“填报”论文数：（<{$the_add}>）</li>
							<li>&nbsp;&nbsp;&nbsp;&nbsp;发表论文数：（<{$the_pub}>）</li>
						</ul>
					
					
       				</div>
			
       		 	</div>
         
         <div class="nav"> </div>
         <{*
         <div class="leftbox">
				
       				<div class="dt"><strong>成果登记概况</strong></div>
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
				
       				<div class="dt"><strong>获奖概况</strong></div>
        			<div class="dd">
					
						<ul>
							<li>获奖总数：</li></p>
                            <li>&nbsp;&nbsp;其中</li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;新增获奖数：2222</li>
							<li>&nbsp;&nbsp;&nbsp;&nbsp;批准获奖数：22222</li>
						</ul>
					
					
       				</div>
			
       		 	</div>
            *}>
            
            <{*
            <p>
					<a  href="http://www.gzgjd.com" target="_blank"><span class="red_font">IPMS</span></a>——知识产权信息管理系统，是一套中小型企业/组织机构知识产权的资料存储、管理系统平台.<br>
                    &nbsp;它操作简单，易于维护，更采用了WEB开发领先技术，目前版本为1.0Beta版. <br>
			</p>
                
                <ul><b>系统特点</b>: 
					<li class="mess">使用流行脚本语言PHP编写，搭配性能稳定的MySQL数据库. </li>
					<li class="mess">系统可以跨平台，运行在Windows、Linux等操作系统中. </li>
					<li class="mess">使用DIV+CSS技术布局,遵循WEB标准,兼容各种浏览器. </li>
					<li class="mess">采用Smarty模板引擎,页面高速缓存技术. </li>
					<li class="mess">采用完全的MVC模式,并使用自定义框架. </li>
					<li class="mess">采用完全的PHP5面向对象设计. </li>	
					<li class="mess">系统采用超经量级PHP框架<a  href="http://www.brophp.com" target="_blank"><span class="red_font">BroPHP</span></a>实现. </li>	
				</ul>
             *}> 
                            
		</div>
        
<{if $flush}>
	<script>
		window.top.frames["menu"].location.reload(true);
	</script>
<{/if}>        
         
             
<{include file="hyuser/footer.tpl"}>	


