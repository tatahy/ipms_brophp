<{extends file="thesis/temp.tpl"}>

<{block name="note"}>
    <span class="col_width">【<span class="red_font"><{$thesis.status}></span>】意见:</span>
    <input class="col_width3" list="note" name="note"/>
        <datalist id="note">
        	<option value="批准同意">
        </datalist>
    
<{/block}>

<{block name="button"}>
    <input type="submit" class="button" name="opr_symbol" value="批准同意" />&nbsp;&nbsp;
    <input type="submit" class="button" name="opr_symbol" value="退回" formaction="<{$app}>/thesis/ret/the_id/<{$thesis['the_id']}>"/>&nbsp;&nbsp;  
           		
<{/block}>


