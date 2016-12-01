<{extends file="thesis/temp.tpl"}>

<{*
<{block name="attachment_upload"}> 
&nbsp;&nbsp;
<{/block}>
                    
<{block name="attachment_download"}>    
&nbsp;&nbsp;
<{/block}>
*}>

<{block name="button"}> 
    <{*$thesis['status']为“填报”，【修改】操作的页面显示的按钮*}> 
    <{ if $thesis['status'] eq "填报"}> 
        <input type="submit" class="button" name="opr_symbol" value="修改" />&nbsp;&nbsp;
        <input type="button" onclick="if(confirm('确定要删除吗?')) window.location='<{$url}>/del/the_id/<{$thesis.the_id}>'" class="button" value="删 除">&nbsp;&nbsp;
        <input type="submit" class="button" name="opr_symbol" value="提交" formaction="<{$url}>/sub/the_id/<{$thesis.the_id}>"/>&nbsp;&nbsp;
        
    <{ elseif $thesis['status'] eq "退回" || $thesis['status'] eq "修改" }><{*$thesis['status']不为“填报”，【修改】操作的页面显示的按钮*}>
        <input type="submit" class="button" name="opr_symbol" value="修改" />&nbsp;&nbsp;
        <input type="submit" class="button" name="opr_symbol" value="提交" formaction="<{$url}>/sub/the_id/<{$thesis.the_id}>"/>&nbsp;&nbsp;  
    <{ else }>
        &nbsp;&nbsp;
    <{ /if }>      
  
<{/block}>