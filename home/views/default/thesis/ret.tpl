<{extends file="thesis/temp.tpl"}>

<{*【退回】操作的页面*}> 
<{block name="note"}>
    <span class="col_width">【<span class="red_font"><{$thesis.status}></span>】意见:</span>
    <input class="col_width3" list="note" name="note"/>
        <datalist id="note">
        	<option value="退回修改">
        </datalist>
    
<{/block}>

<{*$thesis['status']=提交，进行【退回】操作时页面显示的按钮*}> 
<{block name="button"}> 
    <input type="submit" class="button" name="opr_symbol" value="退回" />&nbsp;&nbsp;
  
<{/block}>
