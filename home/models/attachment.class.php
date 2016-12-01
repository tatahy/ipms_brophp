<?php
	class attachment {
		function add($file_name,$display_name,$type,$id){
			//p("SESSION",$_SESSION);
            $attachment=D("attachment");
         //从$_SEESION数组中得到登录用户的信息
            $att_insert = array("att_name"=>$file_name,
                                "att_name_display"=>$display_name,
                                "uid"=>$_SESSION['userid'],
                                "username"=>$_SESSION['username'],
                                "gid"=>$_SESSION['gid'],
                                "role"=>$_SESSION['role'],
                                "obj_type"=>$type,
                                "obj_id"=>$id,
                                "upload_date"=>date("Y-m-d,H:i:s")
                                );
                                
            $attachment->insert($att_insert);
		}
        
       
	}





