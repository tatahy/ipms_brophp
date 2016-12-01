<{extends file="patent/temp.tpl"}>

<{*【修改】操作的页面*}> 
<{block name="button"}>
    <{*$patent['status']为“填报”，【修改】操作的页面显示的按钮*}> 
    <{ if $patent['status'] eq "填报"}> 
        <input type="submit" class="button" name="opr_symbol" value="修改" />&nbsp;&nbsp;
        <input type="button" onclick="if(confirm('确定要删除吗?')) window.location='<{$url}>/del/pat_id/<{$patent.pat_id}>'" class="button" value="删 除">&nbsp;&nbsp;
        <{*
        <input type="submit" class="button" name="opr_symbol" value="提交" formaction="<{$url}>/sub/pat_id/<{$patent['pat_id']}>"/>&nbsp;&nbsp;
        *}> 
    <{ else }><{*$patent['status']不为“填报”，【修改】操作的页面显示的按钮*}>
        <input type="submit" class="button" name="opr_symbol" value="修改" />&nbsp;&nbsp;
        <{*
        <input type="submit" class="button" name="opr_symbol" value="提交" formaction="<{$url}>/sub/pat_id/<{$patent['pat_id']}>"/>&nbsp;&nbsp;
        *}>   
    <{ /if }>                 		
<{/block}>

