<{extends file="patent/temp.tpl"}>

<{*
<{block name="attachment_upload"}> 
&nbsp;&nbsp;
<{/block}>
                    
<{block name="attachment_download"}>    
&nbsp;&nbsp;
<{/block}>
*}>

<{block name="button"}> 
    <{*$patent['status']Ϊ����������޸ġ�������ҳ����ʾ�İ�ť*}> 
    <{ if $patent['status'] eq "�"}> 
        <input type="submit" class="button" name="opr_symbol" value="�޸�" />&nbsp;&nbsp;
        <input type="button" onclick="if(confirm('ȷ��Ҫɾ����?')) window.location='<{$url}>/del/pat_id/<{$patent.pat_id}>'" class="button" value="ɾ ��">&nbsp;&nbsp;
        <input type="submit" class="button" name="opr_symbol" value="�ύ" formaction="<{$url}>/sub/pat_id/<{$patent['pat_id']}>"/>&nbsp;&nbsp;
        
    <{ elseif $patent['status'] eq "�˻�" || $patent['status'] eq "�޸�" }><{*$patent['status']��Ϊ����������޸ġ�������ҳ����ʾ�İ�ť*}>
        <input type="submit" class="button" name="opr_symbol" value="�޸�" />&nbsp;&nbsp;
        <input type="submit" class="button" name="opr_symbol" value="�ύ" formaction="<{$url}>/sub/pat_id/<{$patent['pat_id']}>"/>&nbsp;&nbsp;  
    <{ else }>
        &nbsp;&nbsp;
    <{ /if }>      
  
<{/block}>