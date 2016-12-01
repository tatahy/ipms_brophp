<?php
	class patent {
		function logout(){
			$_SESSION=array();

			if(isset($_COOKIE[session_name()])){
				setCookie(session_name(), '', time()-3600, '/');
			}

			session_destroy();
		}
        
       function pat_upload($pat_id,$gid){
             
            
            } 
       
       function formselect($name="ser_type", $value="不限",$change=""){
	       switch($name){
	           case "ser_type" ://“类型”下拉单选框
                    $data=array_merge($GLOBALS["pat_type_num"],array("不限"));
                    $html='<select id="sel_type" name="'.$name.'">';
               break;
               
               case "ser_status" ://“状态”下拉单选框
                    $data=array_merge($GLOBALS["status_num"],array("不限"));
                    $html='<select id="sel_status" name="'.$name.'">';
               break;
            
            default://
                    break;
               
	       }
          
            $num=0;
            //$html.='<option selected="selected" value="'.$num.'">'.$status.'</option>';

            foreach($data as $val){
                if($value==$val)
                    $html.='<option selected="selected"  value="'.$val.'">';
                else
                    $html.='<option value="'.$val.'">';
                    
                $html.=$val;
                $html.='</option>';	
                
                $num++;
            }
            //$html.='<option value="'.$num.'">'."(不限)".'</option>';
            $html.='</select>';
            
            return $html;
           
	   }
       
	}





