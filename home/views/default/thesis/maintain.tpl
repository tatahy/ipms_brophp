<{block name="start"}>
<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        <div class="head-dark-box">
            <div class="tit">论文管理->【<span class="red_font"><{$thesis.status}></span>】状态论文（提示: 带<span class="red_font">*</span>的项目为必填信息）</div>
            
        </div>	 
        <form  method="post" action="<{$url}>/update">

			<div class="msg-box">
				<ul class="viewmess">
                    <{*此种设为hidden的用法为漏洞，会导致越权操作漏洞，上乌云确认！HY*}>
                    <input type="hidden" name="the_id" value="<{$thesis.the_id}>">
                           
                    <{*
                    定义的$t_status变量根据thesis.class.php的operate_status操作传递的$thesis['status']对各个输入框进行修改
                    因temp.tpl是operate_status.tpl的父模板，temp.tpl中的所有内容会先被operate_status.tpl继承后再被改写
                    *}>
                    <{$t_status=<{$thesis['status']}>}>
 <{/block}>                    
                    
                    <li class="dark-row">
						<span class="col_width">论文题目&nbsp;<span class="red_font">*</span></span>
						<input name="thetopic" type="text" class="col_width3" value="<{ $thesis.thetopic }>" class="text-box"/>

                        <span class="col_width">论文类型&nbsp;<span class="red_font">*</span></span>
						<{*<input class="col_width2" name="thetype" list="thetype"  value="<{ $thesis.thetype }>"/>
                            <datalist id="thetype">
                                <option value="实用新型论文">
                                <option value="发明论文">
                                <option value="外观设计论文">
                                <option value="软件版权">
                                <option value="……">
                            </datalist>*}>
                        <select class="col_width2" name="thetype">
                                <option value="<{$thesis.thetype}>" selected="selected"><{$thesis.thetype}></option>
                                <option value="会议（国际）论文">会议（国际）论文</option>
                                <option value="会议（国内）论文">会议（国内）论文</option>
                                <option value="期刊（国际）论文">期刊（国际）论文</option>
                                <option value="期刊（国内核心）论文">期刊（国内核心）论文</option>
                                <option value="期刊（国内非核心）论文">期刊（国内非核心）论文</option>
                                <option value="著作">著作</option>
                                <option value="……">……</option>
                        </select>                              
                        
                    </li>
                    
                    <li class="light-row">
						<span class="col_width">论文第一作者&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2" name="author1st" type="text"  value="<{ $thesis.author1st }>" class="text-box"/>
                        
                        <span class="col_width">论文第二作者&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2" name="author2nd" type="text"  value="<{ $thesis.author2nd }>" class="text-box"/>
                        
                        <span class="col_width">论文其他作者</span>
						<input class="col_width2" name="authorother" type="text"  value="<{ $thesis.authorother }>" class="text-box"/>						                     
                        
                        <br />
                        <br />
                        
                        <span class="col_width">论文撰写人&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2 text-box-readonly" name="writer" type="text" value="<{ $thesis.writer }>" class="text-box" readonly="readonly"/>
                        
                         <{*方便调试观察，正式上线后可隐藏
                        <span class="col_width">论文撰写人ID&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2 text-box-readonly" name="uid" type="text"  value="<{ $thesis.uid }>" readonly="readonly"/>
                        *}>
                    </li>
                    
                    
                    <li class="dark-row"> 
                    <{block name="status"}>
                        <span class="col_width">论文状态&nbsp;<span class="red_font">*</span></span>
                        <select class="col_width2" name="status">
                            <option value="<{$thesis.status}>" selected="selected"><{$thesis.status}></option>
                            <option value="投稿">投稿</option>
                            <option value="收录">收录</option>
                            <option value="拒稿">拒稿</option>
                            <option value="出版">出版</option>
                        </select>
                    <{/block}> 
                        
                       <span class="col_width">院内编号</span>
						<input class="col_width2 text-box-readonly" name="applynumber" type="text" value="<{ $thesis.applynumber }>" placeholder="LW2015001" readonly="readonly"/>

					</li>
					
                    <li class="light-row">
					<{block name="maintain_1"}>	
                        <span class="col_width">出版物/出版社名称&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2" name="pubname" type="text"  value="<{ $thesis.pubname }>" placeholder="《XX技术》出版社"/>
                        
                        <span class="col_width">出版物信息&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2" name="pubdetail" type="text" value="<{ $thesis.pubdetail }>" placeholder="《XX技术》2016年第8卷6月刊"/>
                        
                        <span class="col_width">出版物编码&nbsp;<span class="red_font">*</span></span>
						<input class="col_width2" name="pubcode" type="text" value="<{ $thesis.pubcode }>" placeholder="出版物的ISSN/CN/ISBN编号"/>    
                   <{/block}>
                    </li>    
                         
                    <li class="dark-row">
						<span class="col_width">院内填报日期</br>yyyy-mm-dd</span>
                    <{block name="adddate"}>
						<input class="col_width2 text-box-readonly" name="adddate" type="date"  value="<{ $thesis.adddate }>" readonly="readonly"/>
                    <{/block}>
                        
                        <span class="col_width">院内提交日期</br>yyyy-mm-dd</span>
					<{block name="adddate"}>
                        <input class="col_width2 text-box-readonly" name="submitdate" type="date"  value="<{ $thesis.submitdate }>" readonly="readonly"/>
                    <{/block}>
                        
                        <span class="col_width">院内审核日期</br>yyyy-mm-dd</span>
						<input class="col_width2 text-box-readonly" name="auditdate" type="date"  value="<{ $thesis.auditdate }>" readonly="readonly"/>
                        
					</li>
                    
                    <li class="light-row"> <{*仅有chrome支持HTML5的时间控件——<input type="date"/>*}>
                        <{if $t_status eq "修改" }>
                            <span class="col_width">审核人退回日期</br>yyyy-mm-dd</span>
    						<input class="col_width2 text-box-readonly" name="mod_retdate" type="date"  value="<{ $thesis.mod_retdate }>" readonly="readonly"/>

                        <{elseif ($t_status eq "退回")}>
                            <span class="col_width">批准人退回日期</br>yyyy-mm-dd</span>
    						<input class="col_width2 text-box-readonly" name="mod_retdate" type="date"  value="<{ $thesis.mod_retdate }>" readonly="readonly"/>

                        <{else }>
                            <span class="col_width">院内修改/退回日期</br>yyyy-mm-dd</span>
    						<input class="col_width2 text-box-readonly" name="mod_retdate" type="date"  value="<{ $thesis.mod_retdate }>" readonly="readonly"/>

                        <{/if}>
                        
                        <span class="col_width">院内批准日期</br>yyyy-mm-dd</span>
						<input class="col_width2 text-box-readonly" name="approvedate" type="date"  value="<{ $thesis.approvedate }>" readonly="readonly" />
                    </li> <p align="left"></p>
      
            <{*仅有chrome支持HTML5的时间控件——<input type="date"/>*}>    
            <{*由定义的$t_status变量根据thesis.class.php的operate_status操作传递的$thesis['status']输入框的标题*}>
            
                   <li class="dark-row"> 
                    <{block name="maintain_2"}>
                        <{if $t_status eq "投稿" }>
                            <span class="col_width">投稿日期</br>yyyy-mm-dd</span>
                            <input class="col_width2" name="cntrdate" type="date"  value="<{ $thesis.cntrdate }>"/>

                        <{elseif ($t_status eq "收录")}>
                            <span class="col_width">投稿日期</br>yyyy-mm-dd</span>
                            <input class="col_width2" name="cntrdate" type="date"  value="<{ $thesis.cntrdate }>"/>

                            <span class="col_width">收录日期</br>yyyy-mm-dd</span>
                            <input class="col_width2" name="incl_rejdate" type="date"  value="<{ $thesis.incl_rejdate }>"/>
                        
                        <{elseif $t_status eq "拒稿" }>
                            <span class="col_width">投稿日期</br>yyyy-mm-dd</span>
                            <input class="col_width2" name="cntrdate" type="date"  value="<{ $thesis.cntrdate }>"/>

                            <span class="col_width">拒稿日期</br>yyyy-mm-dd</span>
                            <input class="col_width2" name="incl_rejdate" type="date"  value="<{ $thesis.incl_rejdate }>"/>
                        
                        <{elseif $t_status eq "出版" }>
                            <span class="col_width">投稿日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="cntrdate" type="date"  value="<{ $thesis.cntrdate }>"/>
                            
                            <span class="col_width">收录日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="incl_rejdate" type="date"  value="<{ $thesis.incl_rejdate }>"/>
                            
                            <span class="col_width">出版日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="pubdate" type="date"  value="<{ $thesis.pubdate }>"/>

                        <{else }>
                            <span class="col_width">投稿日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="cntrdate" type="date"  value="<{ $thesis.cntrdate }>"/>
                            
                            <span class="col_width">收录/拒稿日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="incl_rejdate" type="date"  value="<{ $thesis.incl_rejdate }>"/>
                            
                            <span class="col_width">出版日期</br>yyyy-mm-dd</span>
    						<input class="col_width2" name="pubdate" type="date"  value="<{ $thesis.pubdate }>"/>

                        <{/if}>
                        
                    <{/block}> 
                        
					</li>  
            
                               
                    <li class="light-row"> 
						<{*由定义的$t_status变量根据thesis.class.php的operate_status操作传递的$thesis['status']输入框的标题*}>
                        <{if $t_status eq "填报" or $t_status eq "修改"}>
                            <span class="col_width">所属部门&nbsp;<span class="red_font">*</span></span> 
    						<input class="col_width4" name="dept" type="text"  value="<{ $thesis.dept }>" class="text-box"/><{*就为uid的dept值*}>
                            
                        <{else }>
                            <span class="col_width">所属部门&nbsp;<span class="red_font">*</span></span> 
    						<input class="col_width4" name="dept" type="text"  value="<{ $thesis.dept }>" class="text-box"/><{*就为uid的dept值*}>
                        <{/if}>
                        
                        <span class="col_width">关键词&nbsp;<span class="red_font">*</span></span>
						<input class="col_width4" name="keyword" type="text"  value="<{ $thesis.keyword }>" class="text-box"/>
                        
					</li>
                    
                    <li class="dark-row"> 
                        <span class="col_width">关联项目编号&nbsp;<span class="red_font">*</span></span>
                        <textarea class="col_width2" rows="3" cols="20" name="prjnum" placeholder="填入支持论文的项目院内编号:XM2015001"><{$thesis.prjnum}></textarea> 
                        
                        <span class="col_width">关联项目名称&nbsp;<span class="red_font">*</span></span>
                        <textarea class="col_width2" rows="3" cols="20" name="prjtopic" placeholder="填入支持论文的项目名称"><{$thesis.prjtopic}></textarea>
      
                    </li>
                    
                    <li class="light-row"> 
                        <span class="col_width">摘要</span>
						<{*<input class="col_width2" name="summary" type="text"  value="<{ $thesis.summary }>" class="text-box"/>*}>
                        <textarea placeholder="论文的摘要" class="col_width3" rows="5" cols="20" name="summary" ><{$thesis.summary}></textarea>
                        
					</li>  
                    
                    <{*附件的上传与下载，通过get方式传出要进行操作的论文名称$thesis.thetopic，论文编号$thesis.the_id,论文状态$thesis.status*}>
                    <li class="dark-row"> 
                    <{block name="attachment_upload"}> 
                        <span class="col_width"><span class="red_font">附件处理</span></span>
                       
                        <span class="col_width"><a target="main" href="<{$app}>/thesis/upfile/the_id/<{ $thesis.the_id }>">【附件上传】</a></span>
						
                    <{/block}>
                    
                    <{block name="attachment_download"}>    
                        <span class="col_width"><a target="main" href="<{$app}>/attachment/index/id/<{ $thesis.the_id }>/topic/<{ $thesis.thetopic }>/kind/thesis/operate/1">【附件下载】</a></span>
						
                    <{/block}>    
					</li>

                   
                    <li class="light-row"> 
                    <{block name="print"}>
                        <span class="col_width">【<span class="red_font"><{$thesis.status}></span>】状态论文<p>结果:</p></span>
                    <{/block}>
                        <{*显示通过$str变量接受从thesis模块update操作传来的进行update操作后的信息*}>
                        <span class="col_width2"><p><{$str}></p></span>
                        
                    <{block name="note"}>
                            <span class="col_width">【<span class="red_font"><{$thesis.status}></span>】说明:</span>
                            <input class="col_width3" list="note" name="note"/>
                                <datalist id="note">
                                    <option value="论文投稿出版方">
                                    <option value="论文被出版方收录">
                                    <option value="论文被出版方拒稿">
                                    <option value="论文由出版方出版">
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
                     
                     <{*返回原有状态（$org_status，thesis.class.phh中各个操作里有定义）下的论文列表界面*}>
                     <{block name="button_return"}> 
                        <input type="submit" class="button" value="返 回" formaction="<{$app}>/thesis/my_thelist/cstatus/<{$org_status}>"/>&nbsp;&nbsp;
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
