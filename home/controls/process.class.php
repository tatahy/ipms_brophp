<?php
	class Process {
		
        function index(){
            
            //p("GET",$_GET);
            //p("SESSION",$_SESSION);
            
            //从$_SEESION数组中得到登录用户的信息
//            $uid = $_SESSION['userid'];
//            $gid = $_SESSION['gid']; 
//            $writer = $_SESSION['username'];
//            $authority = array("gid"=>$gid,
//                               "authorityadd"=>$_SESSION['authorityadd'],
//                               "authoritymod"=>$_SESSION['authoritymod'],
//                               "authoritysub"=>$_SESSION['authoritysub'],
//                               "authorityaud"=>$_SESSION['authorityaud'],
//                               "authorityapp"=>$_SESSION['authorityapp'],
//                               "authorityret"=>$_SESSION['authorityret'],
//                               "useradmin"=>$_SESSION['useradmin']); 
//            $dept = $_SESSION['dept'];      
                      
            //从process表查出oprobjid=pat_id的所有记录
            $sets_pro=D("process")->field('username,groupname,oprreason,oprobjid,oprdate,note')
  				    ->where(array("oprobjid" => $_GET['oprobjid']))
                    ->order("oprdate")
                    ->select(); 
          
            $this->assign("sets_pro", $sets_pro);
            $this->assign("topic", $_GET['topic']);
            
            $this->display();
          
		}
        
        //添加
        function insert(){
            //p("SESSION",$_SESSION);
//            $process=D("process");
//         //从$_SEESION数组中得到登录用户的信息
//            $pro_insert = array("uid"=>$_SESSION['userid'],
//                                "gid"=>$_SESSION['gid'],
//                                "username"=>$_SESSION['username'],
//                                "oprtype"=>'0',
//                                "oprreason"=>$_SESSION['oprreason'],
//                                "oprobjtype"=>'patent',
//                                "oprobjid"=>$_SESSION['oprobjid'],
//                                "oprdate"=>date("Y-m-d,H:i:s"),
//                                "note"=>'++');
//            $process->insert($pro_insert);
           
        }
        
             
        
        //删除
        function del(){
		
        }
        



    }
    