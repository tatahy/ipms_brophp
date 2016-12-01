<{block name="start"}>
<{include file="hyuser/header.tpl"}>
<body style="background:white;margin:1px;">
    <div id="main">
        <div class="head-dark-box">
            <div class="tit"><span class="red_font">论文</span>&nbsp;--&nbsp;<{$thesis.thetopic}>&nbsp;--&nbsp;的附件处理 ->【附件上传】</div>
            
        </div>	
         
        <form  method="post" action="<{$url}>/upfile" enctype="multipart/form-data">

			 <div class="msg-box">
				<ul class="viewmess">
                    
                    <p>请选择您计算机中文件，文件需小于<span class="redh">10M</span><br>
    				你可以上传<span class="redh">JPG</span>、<span class="redh">pdf</span>、<span class="redh">doc</span>、<span class="redh">docx</span>或<span class="redh">rar</span>文件。<br>
    				</p>
                    
                    <{if $message}>
                        <p><div class="redh"><{$message}></div></p>
                    <{/if}>
                    
                    <input type="hidden" name="the_id" value="<{$the_id}>"><br>
                    <input type="hidden" name="cstatus" value="<{$thesis.status}>"><br>
                    <input type="hidden" name="attachment" value="<{$thesis.attachment}>" style="width:300px"><br>
                    &nbsp;&nbsp;上传文件名称：<input type="text" name="att_name_display" style="width:300px"><br> 
                     <{*根据登录系统的角色不同，显示的上传项不同 *}>
                    <{ if $groupname eq '撰写人'}>
                        <p>&nbsp;&nbsp;<span class="redh">撰写人</span>上传文件：<input type="file" name="myfile" ></p>
                        <input type="submit" name="sub" value="上传文件" > 
                        <input type="submit" value="返 回" formaction="<{$app}>/thesis/my_thelist/cstatus/<{$thesis.status}>"/>&nbsp;&nbsp; 
                    <{ elseif $groupname eq '审核人' }>
                        <p>&nbsp;&nbsp;<span class="redh">审核人</span>上传文件：<input type="file" name="myfile" ></p>
                        <input type="submit" name="sub" value="上传文件" > 
                        <input type="submit" value="返 回" formaction="<{$app}>/thesis/my_thelist/cstatus/<{$thesis.status}>"/>&nbsp;&nbsp; 
                    <{ elseif $groupname eq '批准人' }>
                        <p>&nbsp;&nbsp;<span class="redh">批准人</span>上传文件：<input type="file" name="myfile" ></p> 
                        <input type="submit" name="sub" value="上传文件" > 
                        <input type="submit" value="返 回" formaction="<{$app}>/thesis/my_thelist/cstatus/<{$thesis.status}>"/>&nbsp;&nbsp;    
                    <{ elseif $groupname eq '维护人' }>
                        <p>&nbsp;&nbsp;<span class="redh">维护人</span>上传文件：<input type="file" name="myfile" ></p> 
                        <input type="submit" name="sub" value="上传文件" > 
                        <input type="submit" value="返 回" formaction="<{$app}>/thesis/my_thelist/cstatus/<{$thesis.status}>"/>&nbsp;&nbsp; 
                    <{ else }>
                        <p>&nbsp;&nbsp;<span class="redh">无上传文件权限</span></p>
                        <input type="submit" value="返 回" formaction="<{$app}>/thesis/my_thelist/cstatus/<{$thesis.status}>"/>&nbsp;&nbsp;
                    <{ /if }>    
                    
 <{/block}>                    
                
                    
<{block name="end"}>
                </ul>	
			</div>
        </form>	

    </div>

</body>
<{/block}>

<{include file="hyuser/footer.tpl"}>
