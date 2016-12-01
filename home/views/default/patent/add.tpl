<{extends file="patent/temp.tpl"}>              

<{*$patent['status']=填报，页面显示的按钮*}>
<{block name="button"}> 
    <input type="submit" class="button" value="修 改" />&nbsp;&nbsp;
    <input type="button" onclick="if(confirm('确定要删除吗?')) window.location='<{$url}>/del/pat_id/<{$patent.pat_id}>'" class="button" value="删 除">&nbsp;&nbsp;
    <input type="submit" class="button" value="提 交" formaction="<{$url}>/sub"/>&nbsp;&nbsp;
                           		
<{/block}>
                    