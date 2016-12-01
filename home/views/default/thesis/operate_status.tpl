<{extends file="thesis/temp.tpl"}>
    
<{block name="button"}> 
    &nbsp;&nbsp;                           		
<{/block}>

<{*不显示“附件上传”*}> 
<{block name="attachment_upload"}>    
    <span class="col_width"><span class="red_font">附件处理</span></span>
    <span class="col_width"></span>
    						
<{/block}> 

<{*
由开关控制是否显示“附件下载”,"operate"为1表示是在my_patlist列表中选中的项目，要显示“操作”列的信息，
否则表示在patlist列表中选中的项目，不显示“操作”列的信息，
*}>                        
<{block name="attachment_download"}>    
    <{ if $view eq 1 }>
        <span class="col_width"><a target="main" href="<{$app}>/attachment/index/id/<{ $thesis.the_id }>/topic/<{ $thesis.thetopic }>/kind/thesis/operate/<{ $operate }>">【附件下载】</a></span>
    <{ else }>
        <span class="col_width">登录账号不是论文撰写人，无下载权限。</span>
    <{ /if }>						
<{/block}>  


<{block name="button_return"}> 
    <{ if $operate eq 1 }>
        <input type="submit" class="button" value="返 回" formaction="<{$app}>/thesis/my_thelist/cstatus/<{$org_status}>"/>&nbsp;&nbsp;
    <{ else }>
        <input type="submit" class="button" value="返 回" formaction="<{$app}>/thesis/thelist/cstatus/<{$org_status}>"/>&nbsp;&nbsp;
    <{ /if }>
<{/block}>

