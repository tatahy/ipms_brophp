<{extends file="thesis/temp.tpl"}>              

<{*$thesis['status']=填报，页面显示的按钮*}>
<{block name="button"}> 
    <input type="submit" class="button" value="修 改" />&nbsp;&nbsp;
    <input type="button" onclick="if(confirm('确定要删除吗?')) window.location='<{$url}>/del/the_id/<{$thesis.the_id}>'" class="button" value="删 除">&nbsp;&nbsp;
    
                           		
<{/block}>
                    