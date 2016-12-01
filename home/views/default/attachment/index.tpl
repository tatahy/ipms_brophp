<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        
        <div class="head-dark-box">
				<div class="tit"><span class="red_font"><{ $obj_kind }></span>&nbsp;--&nbsp;<{ $topic }>&nbsp;--&nbsp;下载文件列表(状态：<{$status}>) </div>
        </div>
        
        <div class="msg-box">
				<div class="mar">
                    <ul class="viewmess">
                    	<li class="dark-row">
                            <span class="list_width width_font" style="width:30px">序号</span>
                            <span class="list_width width_font" style="width:200px">文件名称</span>
                            <span class="list_width width_font" style="width:100px">文件上传人</span>
                            <span class="list_width width_font" style="width:100px">系统角色</span>
                            <span class="list_width width_font" style="width:200px">文件上传时间</span>
        					<span class="list_width width_font" >操作</span>
          
                        </li>
                        <{*从patent.class.php的index操作中分配的$sets_pro带有登录用户的权限信息和可访问的专利信息*}>
                        <{ section name=doc_pro loop=$sets_pro }>
        						<li class="<{if $smarty.section.doc_pro.index is even}>light-row<{else}>dark-row<{/if}>" style="padding-top:5px; padding-bottom:5px">
        							<span class="list_width" style="width:30px"><{ $smarty.section.doc_pro.index + 1 }></span>
                                    <span class="list_width" style="width:200px"><{ $sets_pro[doc_pro].att_name_display }></span>
                                    <span class="list_width" style="width:100px"><{ $sets_pro[doc_pro].username }></span>
        							<span class="list_width" style="width:100px"><{ $sets_pro[doc_pro].role }></span>
                                    <span class="list_width" style="width:200px"><{ $sets_pro[doc_pro].upload_date }></span>
                                                                
                                    <span class="list_width" >
                                         
                                        <{*用表单按钮实现跳转到download.php进行附件下载,实现删除附件*}>
                                        <form action="<{$root}>/download.php" method="post">
                                            <input type="submit" value="下 载"/>
                                            <input type="hidden" name="file_dir" value="<{ $file_dir}><{ $sets_pro[doc_pro].gid }>/"/>
                                            <input type="hidden" name="file_name" value="<{ $sets_pro[doc_pro].att_name}>"/>
                                            <input type="hidden" name="att_id" value="<{ $sets_pro[doc_pro].att_id}>"/>
                                            <input type="hidden" name="obj_id" value="<{ $sets_pro[doc_pro].obj_id}>"/>
                                            <input type="hidden" name="topic" value="<{ $topic}>"/>
                                            <input type="hidden" name="kind" value="<{ $kind}>"/>
                                            <input type="hidden" name="operate" value="<{ $operate}>"/>
                                            
                                            <{*登录角色只能删除自己上传的附件*}>
                                            <{if $smarty.session.groupname eq $sets_pro[doc_pro].role}> 
                                                <input type="submit" value="删 除" formaction="<{$app}>/attachment/del_file"/>
                                            <{else}>
                                                
                                            <{/if}>
        
                                        </form>
                                    </span>
        				
        						</li>
        				<{ sectionelse }>
        						<li class="light-row">
        							没有上传文件
        						</li>	
        				
                        <{ /section }>
                        <li class="dark-row" style="text-align:left">
                            <{if $kind eq 'patent' and $operate eq 1}> 
                                &nbsp;&nbsp;<a target="_self" href="<{$app}>/patent/my_patlist/cstatus/<{$status}>">【返回】</a>
                            <{elseif $kind eq 'thesis' and $operate eq 1}>
                                &nbsp;&nbsp;<a target="_self" href="<{$app}>/thesis/my_thelist/cstatus/<{$status}>">【返回】</a>                
                            <{elseif $kind eq 'thesis'}>
                                &nbsp;&nbsp;<a target="_self" href="<{$app}>/thesis/thelist/cstatus/<{$status}>">【返回】</a>
                            <{elseif $kind eq 'patent'}>
                                &nbsp;&nbsp;<a target="_self" href="<{$app}>/patent/patlist/cstatus/<{$status}>">【返回】</a>
                            <{else}>
                            <{/if}>   
                        </li>
                        
                        <li class="dark-row" style="text-align:right">
                            <{$fpage_pat}>
                        </li>
                        
                    </ul>
                
                </div>
        </div>
                
        
    
    
    </div>



</body>
<{include file="hyuser/footer.tpl"}>
				
