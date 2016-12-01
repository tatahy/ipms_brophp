<?php
	class process {
		function add(){
			//p("SESSION",$_SESSION);
            $process=D("process");
         //从$_SEESION数组中得到登录用户的信息
            $pro_insert = array("uid"=>$_SESSION['userid'],
                                "gid"=>$_SESSION['gid'],
                                "groupname"=>$_SESSION['role'],
                                "username"=>$_SESSION['username'],
                                "oprtype"=>'0',
                                "oprreason"=>$_SESSION['oprreason'],
                                "oprobjtype"=>$_SESSION['oprobjtype'],
                                "oprobjid"=>$_SESSION['oprobjid'],
                                "oprdate"=>date("Y-m-d,H:i:s"),
                                "note"=>$_SESSION['note']);
            $process->insert($pro_insert);
		}
        
       
	}





