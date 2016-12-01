<{extends file="thesis/temp.tpl"}>              

<{*$thesis['status']=填报，进行【删除】操作时页面显示的按钮*}>
<{block name="button"}> 
    <input type="button" onclick="if(confirm('确定要删除吗?')) window.location='<{$url}>/del/the_id/<{$thesis.the_id}>'" class="button" value="删 除">&nbsp;&nbsp;
                           		
<{/block}>

<{block name="button_return"}> 
    <input type="submit" class="button" value="返 回" formaction="<{$app}>/thesis/my_thelist/cstatus/填报"/>&nbsp;&nbsp;
<{/block}> 
                    