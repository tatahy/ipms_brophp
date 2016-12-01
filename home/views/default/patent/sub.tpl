<{extends file="patent/temp.tpl"}>
<{*【提交】操作的页面显示*}> 
<{*
<{block name="status"}>
    <span class="col_width">专利状态&nbsp;<span class="red_font">*</span></span>
    <input class="col_width2 text-box-readonly" name="status" value="提交" readonly="readonly" />

<{/block}> 
*}>

<{block name="note"}>
    <span class="col_width">【<span class="red_font">提交</span>】意见:</span>
    <input class="col_width3" list="note" name="note"/>
        <datalist id="note">
        	<option value="提交审核">
            
        </datalist>
    
<{/block}>

<{*$patent['status']=填报/修改/退回，进行【提交】操作时页面显示的按钮*}> 
<{block name="button"}> 
   <input type="submit" class="button" name="opr_symbol" value="提交" formaction="<{$url}>/update"/>&nbsp;&nbsp;
                           		
<{/block}>
