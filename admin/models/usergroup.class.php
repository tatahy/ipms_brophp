<?php
	class  Usergroup {  //
		function formselect($name="gid", $value="0",$change=""){
			$data=$this->field('groupid,groupname')->select();

			$html='<select '.$change.' id="sel" name="'.$name.'">';
			$html.='<option value="0">--用户组--</option>';
            
			foreach($data as $val){
				if($value==$val["groupid"])
					$html.='<option selected value="'.$val['groupid'].'">';
				else
					$html.='<option value="'.$val['groupid'].'">';

				$html.=$val['groupname'];
				$html.='</option>';	
			}
			$html.='</select>';

			return $html;
		}
	}

