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
    <{*$thesis['status']Ϊ����������޸ġ�������ҳ����ʾ�İ�ť*}> 
    <{ if $thesis['status'] eq "�"}> 
        <input type="submit" class="button" name="opr_symbol" value="�޸�" />&nbsp;&nbsp;
        <input type="button" onclick="if(confirm('ȷ��Ҫɾ����?')) window.location='<{$url}>/del/the_id/<{$thesis.the_id}>'" class="button" value="ɾ ��">&nbsp;&nbsp;
        <input type="submit" class="button" name="opr_symbol" value="�ύ" formaction="<{$url}>/sub/the_id/<{$thesis.the_id}>"/>&nbsp;&nbsp;
        
    <{ elseif $thesis['status'] eq "�˻�" || $thesis['status'] eq "�޸�" }><{*$thesis['status']��Ϊ����������޸ġ�������ҳ����ʾ�İ�ť*}>
        <input type="submit" class="button" name="opr_symbol" value="�޸�" />&nbsp;&nbsp;
        <input type="submit" class="button" name="opr_symbol" value="�ύ" formaction="<{$url}>/sub/the_id/<{$thesis.the_id}>"/>&nbsp;&nbsp;  
    <{ else }>
        &nbsp;&nbsp;
    <{ /if }>      
  
<{/block}>