<{block name="start"}>
<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        <div class="head-dark-box">
            <div class="tit">专利管理->【<span class="red_font"><{$patent.status}></span>】状态专利（提示: 带<span class="red_font">*</span>的项目为必填信息）</div>
            
        </div>	 
        <form  method="post" action="<{$url}>/update">

			<div class="msg-box">
				<ul class="viewmess">
                    <{*此种设为hidden的用法为漏洞，会导致越权操作漏洞，上乌云确认！HY*}>
                    <input type="hidden" name="pat_id" value="<{$patent.pat_id}>">
                           
                    <{*
                    定义的$t_status变量根据patent.class.php的operate_status操作传递的$patent['status']对各个输入框进行修改
                    因temp.tpl是operate_status.tpl的父模板，temp.tpl中的所有内容会先被operate_status.tpl继承后再被改写
                    *}>
                    <{$t_status=<{$patent['status']}>}>
 <{/block}>                    
                    
                    <li class="dark-row">
						<span class="col_width">专利题目&nbsp;<span class="red_font">*</span></span>
						<input name="pattopic" type="text" class="col_width3" value="<{ $patent.pattopic }>" class="text-box"/>

                        <span class="col_width">专利类型&nbsp;<span class="red_font">*</span></span>
						<{*<input class="col_width2" name="pattype" list="pattype"  value="<{ $patent.pattype }>"/>
                            <datalist id="pattype">
                                <option value="实用新型专利">
                                <option value="发明专利">
                                <option value="外观设计专利">
                                <option value="软件版权">
                                <option value="……">
                            </datalist>*}>
                        <select class="col_width2" name="pattype">
                                <option value="<{$patent.pattype}>" selected="selected"><{$patent.pattype}></option>
                                <option value="实用新型专利">实用新型专利</option>
                                <option value="发明专利">发明专利</option>
                                <option value="外观设计专利">外观设计专利</option>
                                <option value="软件版权">软件版权</option>
                                <option value="著作权">著作权</option>
                                <option value="集成电路图">集成电路图</option>
                                <option value="……">……</option>
                        </select>                        
                        
                    </li>
                    
                    <li class="light-row">
						<span class="col_width">专利所有人&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2" name="owner" type="text" value="<{ $patent.owner }>" placeholder="默认为广州市光机电技术研究院" class="text-box"/>
                        
                        <span class="col_width">专利作者&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2" name="author" type="text"  value="<{ $patent.author }>" class="text-box"/>
                        
                        <span class="col_width">专利其他作者</span>
						<input class="col_width2" name="authorother" type="text"  value="<{ $patent.authorother }>" class="text-box"/>						                     
                        
                    </li>
                    
                    
                    <li class="dark-row"> 
                    <{block name="status"}>
                        <span class="col_width">专利状态&nbsp;<span class="red_font">*</span></span>
                        <select class="col_width2" name="status">
                            <option value="<{$patent.status}>" selected="selected"><{$patent.status}></option>
                            <option value="申报">申报</option>
                            <option value="授权">授权</option>
                            <option value="放弃">放弃</option>
                            <option value="驳回">驳回</option>
                            <option value="维护">维护</option>
                        </select>
                    <{/block}> 
                        
                        <{*
                        <select class="col_width2" name="status">
                                <option value="<{$patent.status}>" selected="selected"><{$patent.status}></option>
                                <option value="填报">填报</option>
                                <option value="修改">修改</option>
                                <option value="提交">提交</option>
                                <option value="审核">审核</option>
                                <option value="批准">批准</option>
                                <option value="退回">退回</option>
                                <option value="申报">申报</option>
                                <option value="授权">授权</option>
                                <option value="放弃">放弃</option>
                                <option value="驳回">驳回</option>
                                <option value="维护">维护</option>
                                
                        </select>
                        *}>
                        <span class="col_width">专利撰写人&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2 text-box-readonly" name="writer" type="text"  value="<{ $patent.writer }>" readonly="readonly"/>
                        
                        <{*方便调试观察，正式上线后可隐藏
                        <span class="col_width">专利撰写人ID&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2 text-box-readonly" name="uid" type="text"  value="<{ $patent.uid }>" readonly="readonly"/>
                        *}>
					</li>
					
                    <li class="light-row">
					<{block name="maintain_1"}>	
                        <span class="col_width">申请编号</span>
                        <input class="col_width2 " name="applynumber" type="text" value="<{ $patent.applynumber }>" placeholder="填入专利的申报编号"/>
                                                
                        <span class="col_width">授权编号</span>
                        <input class="col_width2 " name="approvenumber" type="text" value="<{ $patent.approvenumber }>" placeholder="填入专利的授权编号"/>
                                                
                        <span class="col_width">代理机构</span>
                        <input class="col_width2 " list="agency" name="patagency" type="text" value="<{ $patent.patagency }>" placeholder="填入专利的申报代理机构"/>
                            <datalist id="agency">
                                <option value="广州市华学知识产权代理有限公司">
                                <option value="……">
                                
                            </datalist>     
                   <{/block}>
                    </li>    
                         
                    <li class="dark-row">
						<span class="col_width">院内填报日期</br>yyyy-mm-dd</span>
                    <{block name="adddate"}>
						<input class="col_width2 text-box-readonly" name="adddate" type="date"  value="<{ $patent.adddate }>" readonly="readonly"/>
                    <{/block}>
                        
                        <span class="col_width">院内提交日期</br>yyyy-mm-dd</span>
					<{block name="adddate"}>
                        <input class="col_width2 text-box-readonly" name="submitdate" type="date"  value="<{ $patent.submitdate }>" readonly="readonly"/>
                    <{/block}>
                        
                        <span class="col_width">院内审核日期</br>yyyy-mm-dd</span>
						<input class="col_width2 text-box-readonly" name="auditdate" type="date"  value="<{ $patent.auditdate }>" readonly="readonly"/>
                        
					</li>
                    
                    <li class="light-row"> <{*仅有chrome支持HTML5的时间控件——<input type="date"/>*}>
                        <{if $t_status eq "修改" }>
                            <span class="col_width">审核人退回日期</br>yyyy-mm-dd</span>
    						<input class="col_width2 text-box-readonly" name="mod_retdate" type="date"  value="<{ $patent.mod_retdate }>" readonly="readonly"/>

                        <{elseif ($t_status eq "退回")}>
                            <span class="col_width">批准人退回日期</br>yyyy-mm-dd</span>
    						<input class="col_width2 text-box-readonly" name="mod_retdate" type="date"  value="<{ $patent.mod_retdate }>" readonly="readonly"/>

                        <{else }>
                            <span class="col_width">院内修改/退回日期</br>yyyy-mm-dd</span>
    						<input class="col_width2 text-box-readonly" name="mod_retdate" type="date"  value="<{ $patent.mod_retdate }>" readonly="readonly"/>

                        <{/if}>
                        
                        <span class="col_width">院内批准日期</br>yyyy-mm-dd</span>
						<input class="col_width2 text-box-readonly" name="approvedate" type="date"  value="<{ $patent.approvedate }>" readonly="readonly" />
                    </li> <p align="left"></p>
      
            <{*仅有chrome支持HTML5的时间控件——<input type="date"/>*}>    
            <{*由定义的$t_status变量根据patent.class.php的operate_status操作传递的$patent['status']输入框的标题*}>
            
                    <li class="dark-row"> 
                    <{block name="maintain_2"}>
                        
                            <span class="col_width">申报/放弃日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="apply_abandondate" type="date"  value="<{ $patent.apply_abandondate }>"/>
                            
                            <span class="col_width">授权/驳回日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="lic_rejdate" type="date"  value="<{ $patent.lic_rejdate }>"/>
                            
                            <span class="col_width">续费日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="renewdate" type="date"  value="<{ $patent.renewdate }>"/>

                       
                        
                    <{/block}> 
                        
					</li>  
            
                               
                    <li class="light-row"> 
						<{*由定义的$t_status变量根据patent.class.php的operate_status操作传递的$patent['status']输入框的标题*}>
                        <{if $t_status eq "填报" or $t_status eq "修改"}>
                            <span class="col_width">所属部门&nbsp;<span class="red_font">*</span></span> 
    						<input class="col_width4" name="dept" type="text"  value="<{ $patent.dept }>" class="text-box"/><{*就为uid的dept值*}>
                            
                        <{else }>
                            <span class="col_width">所属部门&nbsp;<span class="red_font">*</span></span> 
    						<input class="col_width4" name="dept" type="text"  value="<{ $patent.dept }>" class="text-box"/><{*就为uid的dept值*}>
                        <{/if}>
                        
                        <span class="col_width">关键字&nbsp;<span class="red_font">*</span></span>
						<input class="col_width4" name="keyword" type="text"  value="<{ $patent.keyword }>" class="text-box"/>
                        
					</li>
                    
                    <li class="dark-row"> 
                        <span class="col_width">申请地&nbsp;<span class="red_font">*</span></span>
						<{*<input class="col_width2" name="applyplace" type="text"  value="<{ $patent.patagency }>" class="text-box"/>*}>
                        <select class="col_width2" name="applyplace" >
                            <option value="<{$patent.applyplace}>" selected="selected"><{$patent.applyplace}></option>
                            <option value="中国大陆">中国大陆</option>
                            <option value="港澳台">港澳台</option>
                            <option value="美日欧">美日欧</option>
                            <option value="其他">其他</option>                       
                        </select>
                        
                        <span class="col_width">关联项目编号&nbsp;<span class="red_font">*</span></span>
                        <textarea class="col_width2" rows="3" cols="20" name="prjnum" placeholder="填入支持专利的项目院内编号:XM2015001"><{$patent.prjnum}></textarea> 
                        
                        <span class="col_width">关联项目名称&nbsp;<span class="red_font">*</span></span>
                        <textarea class="col_width2" rows="3" cols="20" name="prjtopic" placeholder="填入支持专利的项目名称"><{$patent.prjtopic}></textarea>
      
                    </li>
                    
                    <li class="light-row"> 
                        <span class="col_width">简介</span>
						<{*<input class="col_width2" name="summary" type="text"  value="<{ $patent.summary }>" class="text-box"/>*}>
                        <textarea placeholder="填入对专利的简要描述" class="col_width3" rows="3" cols="20" name="summary" ><{$patent.summary}></textarea>
                        
					</li>  
                    
                    <{*附件的上传与下载，通过get方式传出要进行操作的专利名称$patent.pattopic，专利编号$patent.pat_id,专利状态$patent.status*}>
                    <li class="dark-row"> 
                    <{block name="attachment_upload"}> 
                        <span class="col_width"><span class="red_font">附件处理</span></span>
                       
                        <span class="col_width"><a target="main" href="<{$app}>/patent/upfile/pat_id/<{ $patent.pat_id }>">【附件上传】</a></span>
						
                    <{/block}>
                    
                    <{block name="attachment_download"}>    
                        <span class="col_width"><a target="main" href="<{$app}>/attachment/index/id/<{ $patent.pat_id }>/topic/<{ $patent.pattopic }>/kind/patent/operate/1">【附件下载】</a></span>
						
                    <{/block}>    
					</li>

                   
                    <li class="light-row"> 
                    <{block name="print"}>
                        <span class="col_width">【<span class="red_font"><{$patent.status}></span>】状态专利<p>结果:</p></span>
                    <{/block}>
                        <{*显示通过$str变量接受从patent模块update操作传来的进行update操作后的信息*}>
                        <span class="col_width2"><p><{$str}></p></span>
                        
                    <{block name="note"}>
                            <span class="col_width">【<span class="red_font"><{$patent.status}></span>】说明:</span>
                            <input class="col_width2" list="note" name="note"/>
                                <datalist id="note">
                                    <option value="提交专利代理申报">
                                    <option value="专利已授权">
                                    <option value="放弃专利权">
                                    <option value="专利申请被驳回">
                                    <option value="专利续费维护">
                                </datalist>
                            
                    <{/block}>       
					</li>
                    
                    <{if $mt_record}>
                    <li class="light-row">
                        <span class="col_width"><span class="red_font">已做维护记录</span></span>
                        <br /> 
                        <{$mt_record}>
                        <{*<{$mt_record}>内容实现的效果如下：
                        <span class="col_width3">1.012345678901234567890123456789</span>
                        <span class="col_width3">2.012345678901234567890123456789</span>
                        <span class="col_width3">3.012345678901234567890123456789</span>
                        *}> 
      
					</li>
                    <{/if}>  
                           
                
				    <li class="dark-row">
                    <span class="col_width"> &nbsp; </span>
                    <{block name="button"}> 
                        <input type="submit" class="button" name="opr_symbol" value="更新" />&nbsp;&nbsp;
                     <{/block}>       
                        
                        <input type="reset" class="button" value="重 置"/>&nbsp;&nbsp;
                     
                     <{*返回原有状态（$org_status，patent.class.phh中各个操作里有定义）下的专利列表界面*}>
                     <{block name="button_return"}> 
                        <input type="submit" class="button" value="返 回" formaction="<{$app}>/patent/my_patlist/cstatus/<{$org_status}>"/>&nbsp;&nbsp;
                     <{/block}> 
                        		
                    </li>
                    
                    
<{block name="end"}>
                </ul>	
			</div>
        </form>	


    </div>



<{if $flush}>
	<script>
		window.top.frames.menu.location.reload(true);
	</script>
<{/if}>
</body>
<{/block}> 

<{include file="hyuser/footer.tpl"}>
