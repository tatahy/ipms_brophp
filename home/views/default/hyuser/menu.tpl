<{include file="hyuser/header.tpl"}>
<body style="background:#EAEAEA">
<div id="umenu" class="top"><br/>	

<div class="">&nbsp;&nbsp;用户：<b>&nbsp;&nbsp;<{$user_authority.username}></b>&nbsp;&nbsp;&nbsp;&nbsp;
        角色：
        <a href="<{$app}>/login/role_select/name/<{$user_authority.username}>" target="_top" title="点击选择系统角色">
        <span class="redh">【<{$user_authority.groupname}>】</span>
        </a>
    </div>
    
    <div class="umess" style="text-indent:0.1cm;padding:10px;">所属部门：<b><{$user_authority.dept}></b>&nbsp;|&nbsp;<b><a target="main" href="<{$url}>/pset">【用户密码设置】</a></b>
        <br/><hr align="center" width="100%">
	</div>

		<div id="menu">
			<div class="option">
				<div class="menutitle">——管理选项——</div>
				<div class="content">
					<ul>
						<li class="opt">
							<a href="<{$url}>/main" onclick="switchmenu('optionmenu','menulist',0)" target="main">
							<img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="<{$res}>/images/patent_d.gif"><br>
							 专利管理</a>
						</li>
						<li class="opt">
							<a href="<{$url}>/main" onclick="switchmenu('optionmenu','menulist',1)" target="main">
							<img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="<{$res}>/images/thesis_d.gif"><br>
							论文管理</a>
						</li>
						<{*待完善M和V层的代码，2016/9/13,HY
                        <li class="opt">	
							 <a href="<{$url}>/main" onclick="switchmenu('optionmenu','menulist',2)" target="main">
							 <img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="<{$res}>/images/achievement_d.gif"><br>
							 成果管理</a>
						</li>
						<li class="opt">	
							 <a href="<{$url}>/main" onclick="switchmenu('optionmenu','menulist',3)" target="main">
							 <img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="<{$res}>/images/award_d.gif"><br>
							 奖项管理</a>
						</li> 
                        *}>                       
					</ul>
				 </div>
			</div>
            <div class="nav"> </div> <{*空白行*}>
            <div class="option">
				<div id="optionmenu" class="menutitle">——专利管理——</div>
				<div id="menulist" class="content"> 
   	                <div style="display:block"> <{*专利管理菜单，默认显示。&nbsp;有用的*}>

                        <{if $smarty.session.groupname eq '撰写人' or $smarty.session.groupname eq '审核人'}> 
    						<span onclick="domenu(this, 'list1')" class="tit" style="font-size:16px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>部门专利</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/patent/index"><b>【总数】</b></a>(<span class="redh"><b><{$num_total}></b></span>)
                            &nbsp;<a target="main" href="<{$app}>/search/index_manage/ser_dept/<{$smarty.session.dept}>"><b>【搜索】</b></a>
                            
                        <{elseif $smarty.session.groupname eq '批准人'}>
    						<span onclick="domenu(this, 'list1')" class="tit" style="font-size:16px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>研究院专利</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/patent/index"><b>【总数】</b></a>(<span class="redh"><b><{$num_total}></b></span>)
                            &nbsp;<a target="main" href="<{$app}>/search/index_manage"><b>【搜索】</b></a>
                            
                        <{elseif $smarty.session.groupname eq '维护人'}>
    						<span onclick="domenu(this, 'list1')" class="tit" style="font-size:16px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>研究院专利</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/patent/index"><b>【总数】</b></a>(<span class="redh"><b><{$num_total}></b></span>)
                            &nbsp;<a target="main" href="<{$app}>/search/index_manage"><b>【搜索】</b></a>

                        <{elseif $smarty.session.groupname eq '超级管理员'}>
    						<span onclick="domenu(this, 'list1')" class="tit" style="font-size:16px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>研究院专利</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/patent/index"><b>【总数】</b></a>(<span class="redh"><b><{$num_total}></b></span>)
                            &nbsp;<a target="main" href="<{$app}>/search/index_manage"><b>【搜索】</b></a>
                        
                        <{else}>
                            <div class="tit"><span class="red_font">专利总表</div>
                        <{/if}>
                        
                        <{*HY
                        <input type="hidden" value="patent" formmethod="get" formaction="<{$app}>hyuser/menu/kind/patent"/>
                        *}>
                        
						<ul id="list1"><{*登录角色能看到的各个状态的专利*}>
							<{ section name=doc loop=$num }>
                                <{$i= <{ $smarty.section.doc.index }>}>
                                <li><a target="main" href="<{$app}>/patent/patlist/cstatus/<{$gstatus[$i]}>">【<{$gstatus[$i]}>】</a>(<span class="redh"><b><{$num[$i]}></b></span>)</li>
                            <{ sectionelse }>
                            <{ /section }>	
							
                            <{if $add_li==1}>
                                <li></li>
                                <li></li>
                                <li></li>
                            <{else}>
                                <li></li>
                                <li></li>                            
                            <{/if}>
						</ul>
                        
                        <br /><{*空白*}>
                        <br /><{*空白*}>

                        <{if $smarty.session.groupname eq '超级管理员'}>
    						<span >&nbsp;&nbsp;&nbsp;待处理专利&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <b>【总数】</b>(<span class="redh"><b>0</b></span>)
                        
                        <{elseif $smarty.session.groupname eq '撰写人'}>
                            <span onclick="domenu(this, 'list11')" class="tit" style="font-size:14px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>待处理专利</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/patent/my_index"><b>【总数】</b></a>(<span class="redh"><b><{$my_num_total}></b></span>)
                            <a target="main" href="<{$app}>/patent/hynew/uid/<{$uid}>/writer/<{$writer}>"><b>【新增】</b></a>
                        <{else}> 
                            <span onclick="domenu(this, 'list11')" class="tit" style="font-size:14px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>待处理专利</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/patent/my_index"><b>【总数】</b></a>(<span class="redh"><b><{$my_num_total}></b></span>)
                        <{/if}>
      
						<ul id="list11"><{*登录角色要处理的各个状态的专利*}>
							<{ section name=doc loop=$my_num }>
                                <{$i= <{ $smarty.section.doc.index }>}>
                                <li><a target="main" href="<{$app}>/patent/my_patlist/cstatus/<{$my_status[$i]}>">【<{$my_status[$i]}>】</a>(<span class="redh"><b><{$my_num[$i]}></b></span>)</li>
                            <{ sectionelse }>
                            
                            <{ /section }>	
							
						</ul>
                        						
					</div>

					<div> <{*论文管理菜单*}>
                        
                        <{if $smarty.session.groupname eq '撰写人' or $smarty.session.groupname eq '审核人'}> 
    						<span onclick="domenu(this, 'list2')" class="tit" style="font-size:16px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>部门论文</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/thesis/index"><b>【总数】</b></a>(<span class="redh"><b><{$the_num_total}></b></span>)
                            &nbsp;<a target="main" href="<{$app}>/search/index_manage_the/ser_dept/<{$smarty.session.dept}>"><b>【搜索】</b></a>
                            
                        <{elseif $smarty.session.groupname eq '批准人'}>
    						<span onclick="domenu(this, 'list2')" class="tit" style="font-size:16px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>研究院论文</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/thesis/index"><b>【总数】</b></a>(<span class="redh"><b><{$the_num_total}></b></span>)
                            &nbsp;<a target="main" href="<{$app}>/search/index_manage_the"><b>【搜索】</b></a>
                            
                        <{elseif $smarty.session.groupname eq '维护人'}>
    						<span onclick="domenu(this, 'list2')" class="tit" style="font-size:16px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>研究院论文</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/thesis/index"><b>【总数】</b></a>(<span class="redh"><b><{$the_num_total}></b></span>)
                            &nbsp;<a target="main" href="<{$app}>/search/index_manage_the"><b>【搜索】</b></a>

                        <{elseif $smarty.session.groupname eq '超级管理员'}>
    						<span onclick="domenu(this, 'list2')" class="tit" style="font-size:16px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>研究院论文</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/thesis/index"><b>【总数】</b></a>(<span class="redh"><b><{$the_num_total}></b></span>)
                            &nbsp;<a target="main" href="<{$app}>/search/index_manage_the"><b>【搜索】</b></a>
                        
                        <{else}>
                            <div class="tit"><span class="red_font">论文总表</div>
                        <{/if}>                        
						
                        <ul id="list2"><{*登录角色能看到的各个状态的论文*}>
							<{ section name=doc loop=$the_num }>
                                <{$i= <{ $smarty.section.doc.index }>}>
                                <li><a target="main" href="<{$app}>/thesis/thelist/cstatus/<{$the_gstatus[$i]}>">【<{$the_gstatus[$i]}>】</a>(<span class="redh"><b><{$the_num[$i]}></b></span>)</li>
                            <{ sectionelse }>
                            <{ /section }>	
							
                            <{if $the_add_li==1}>
                                <li></li>
                                <li></li>
                                <li></li>
                            <{else}>
                                <li></li>
                                <li></li>
                            <{/if}>		
						</ul>
                        
                        <br /><{*空白*}>
                        <br /><{*空白*}>

                        <{if $smarty.session.groupname eq '超级管理员'}>
    						<span >&nbsp;&nbsp;&nbsp;待处理论文&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <b>【总数】</b>(<span class="redh"><b>0</b></span>)
                        
                        <{elseif $smarty.session.groupname eq '撰写人'}>
                            <span onclick="domenu(this, 'list21')" class="tit" style="font-size:14px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>待处理论文</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/thesis/my_index"><b>【总数】</b></a>(<span class="redh"><b><{$the_my_num_total}></b></span>)
                            <a target="main" href="<{$app}>/thesis/hynew/uid/<{$uid}>/writer/<{$writer}>"><b>【新增】</b></a>
                        <{else}> 
                            <span onclick="domenu(this, 'list21')" class="tit" style="font-size:14px;font-weight:bold">&nbsp;&nbsp;&nbsp;<a>待处理论文</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a target="main" href="<{$app}>/thesis/my_index"><b>【总数】</b></a>(<span class="redh"><b><{$the_my_num_total}></b></span>)
                        <{/if}>
                        
						<ul id="list21"><{*登录角色要处理的各个状态的论文*}>
							<{ section name=doc loop=$the_my_num }>
                                <{$i= <{ $smarty.section.doc.index }>}>
                                <li><a target="main" href="<{$app}>/thesis/my_thelist/cstatus/<{$the_my_status[$i]}>">【<{$the_my_status[$i]}>】</a>(<span class="redh"><b><{$the_my_num[$i]}></b></span>)</li>
                            <{ sectionelse }>
                            <{ /section }>	
							
						</ul>
                        					
					</div>

					<div> <{*成果管理菜单*}>
						<span onclick="domenu(this, 'list3')" class="tit" style="font-size:16px;font-weight:bold"><a>部门成果——开发中</a>&nbsp;
                        <{*
                        <a target="main" href="<{$app}>/patent/index">总数</a>(<span class="redh"><b><{$num_total}></b></span>)</span>
						<ul id="list3">
							<{ section name=doc loop=$num }>
                                <{$i= <{ $smarty.section.doc.index }>}>
                                <li><a target="main" href="<{$app}>/patent/patlist/cstatus/<{$gstatus[$i]}>">【<{$gstatus[$i]}>】</a>(<span class="redh"><b><{$num[$i]}></b></span>)</li>
                            <{ sectionelse }>
                            
                            <{ /section }>	
							
						</ul>
                        *}>
                        
                        <span onclick="domenu(this, 'list31')" class="tit" style="font-size:14px;font-weight:bold"><a>待处理成果——开发中</a>&nbsp;
                        <{*
                        <a target="main" href="<{$app}>/patent/my_index">总数</a>(<span class="redh"><b><{$my_num_total}></b></span>)</span>
						<ul id="list31">
							<{ section name=doc loop=$my_num }>
                                <{$i= <{ $smarty.section.doc.index }>}>
                                <li><a target="main" href="<{$app}>/patent/patlist/cstatus/<{$my_status[$i]}>">【<{$my_status[$i]}>】</a>(<span class="redh"><b><{$my_num[$i]}></b></span>)</li>
                            <{ sectionelse }>
                            
                            <{ /section }>	
							
						</ul>
                        *}>
                        					
					</div>
					
                    <div> <{*获奖管理菜单*}>
						<span onclick="domenu(this, 'list4')" class="tit" style="font-size:16px;font-weight:bold"><a>部门奖项——开发中</a>&nbsp;
                        <{*
                        <a target="main" href="<{$app}>/patent/index">总数</a>(<span class="redh"><b><{$num_total}></b></span>)</span>
						<ul id="list4">
							<{ section name=doc loop=$num }>
                                <{$i= <{ $smarty.section.doc.index }>}>
                                <li><a target="main" href="<{$app}>/patent/patlist/cstatus/<{$gstatus[$i]}>">【<{$gstatus[$i]}>】</a>(<span class="redh"><b><{$num[$i]}></b></span>)</li>
                            <{ sectionelse }>
                            
                            <{ /section }>	
							
						</ul>
                        *}>
                        
                        <span onclick="domenu(this, 'list41')" class="tit" style="font-size:14px;font-weight:bold"><a>待处理奖项——开发中</a>&nbsp;
                        <{*
                        <a target="main" href="<{$app}>/patent/my_index">总数</a>(<span class="redh"><b><{$my_num_total}></b></span>)</span>
						<ul id="list41">
							<{ section name=doc loop=$my_num }>
                                <{$i= <{ $smarty.section.doc.index }>}>
                                <li><a target="main" href="<{$app}>/patent/patlist/cstatus/<{$my_status[$i]}>">【<{$my_status[$i]}>】</a>(<span class="redh"><b><{$my_num[$i]}></b></span>)</li>
                            <{ sectionelse }>
                            
                            <{ /section }>	
							
						</ul>
                        *}>
                        					
					</div>
					
				</div>
			</div>
	   </div>
    
     
     
   	<div>
	   
       <{ if $smarty.session.login eq 1 }>
		<form action="<{$app}>/hyuser/menu" method="post">
            <input name="uid" type="hidden" size="10" value="<{$smarty.session.userid}>">&nbsp;
            <input type="submit" name="fresh" value="刷 新">&nbsp;
    
        </form>
        <{ else}>
        <{ /if}> 
	</div>
    
    <div style="padding:10px;">
        <p>
            &nbsp;&nbsp;<a  href="http://www.gzgjd.com" target="_blank"><span class="red_font">IPMS</span></a>——知识产权管理系统<br>
            是一个中小型企业/组织机构知识产权的资料存储、信息管理平台。操作简单，易于维护。
            <br/>
            <br/>
            目前版本为<span class="red_font">1.0呆萌版</span>（demo）。
    	</p>
    </div>
    
</div>
</body>        
<{include file="hyuser/footer.tpl"}>
