<?php
	class Thesis {
		function index(){
		
            //从$_SEESION数组中得到登录用户的信息
            $uid = $_SESSION['userid'];
            $gid = $_SESSION['gid']; 
            $groupname=$_SESSION['groupname']; 
            $writer = $_SESSION['username'];
            $authority = array("groupname"=>$groupname,
                               "authorityadd"=>$_SESSION['authorityadd'],
                               "authoritymod"=>$_SESSION['authoritymod'],
                               "authoritysub"=>$_SESSION['authoritysub'],
                               "authorityaud"=>$_SESSION['authorityaud'],
                               "authorityapp"=>$_SESSION['authorityapp'],
                               "authorityret"=>$_SESSION['authorityret'],
                               "maintain"=>$_SESSION['maintain'],
                               "useradmin"=>$_SESSION['useradmin']); 
            $dept = $_SESSION['dept']; 
            
             if (!empty($_GET['str'])){
                    $str_t=$_GET['str'];
                }else $str_t="writer";     
                      
            //从thesis表查出记录数,登录账号是“超级管理员”/"批准人"/"维护人"是全部thesis，其他的仅仅选择所处部门的thesis
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $c=D("thesis")->field('the_id')->total();
                
            }else{
                $c=D("thesis")->field('the_id,dept')->where(array("dept"=>$dept))->total();
            }
            
            /**
                 设置分页类的属性，共4个参数。第一个为总记录数，第二个为每页需要显示的记录数默认为“25”，
                 第三个为向下一个页面传递的参数，第四个默认为“true”，表示从第一页开始显示
            */             
			//$page_the=new Page($c,20,$GLOBALS["app"]."thesis/index/str/".$str_t);
            $page_the=new Page($c,20,"thesis/index/str/".$str_t);
            
            //从thesis表查出记录并由limit设置分页数量,“超级管理员”/"批准人"/"维护人"是全部thesis，其他的仅仅是所处部门的thesis
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $sets_the=D("thesis")->field('the_id,uid,thetype,thetopic,status,writer,dept,adddate')
  				    ->limit($page_the->limit)
                    ->order($str_t." desc")
                    ->select(); 
                //得到status的所有分类
                //$sets_status=D("thesis")->field('status')
//  				    ->group('status')
//                    ->select(); 
                
                //p("uid",$uid);
                
            }else{
                $sets_the=D("thesis")->field('the_id,uid,thetype,thetopic,status,writer,dept,adddate')
  				    ->limit($page_the->limit)//
                    ->where(array("dept"=> $dept))
                    ->order($str_t." desc")
                    ->select(); 
                 //得到status的所有分类,结果是一个二维数组   
                 //$sets_status=D("thesis")->field('status')
//  				    ->group('status')
//                    ->select();
                
                //p("uid",$uid);    
                    
            }
            
            //添加登录用户的权限信息到论文记录集中的每条记录，为在“index.tpl”中显示可对每个论文记录进行的操作提供判定信息
            for($i=0;$i<count($sets_the);$i++){
                $sets_the[$i]=array_merge_recursive($sets_the[$i], $authority);   
            } 
            
            $page_the->set("head", "个论文");
            //$this->assign("usergroup",$usergroup);
			$this->assign("sets_the",$sets_the);
			$this->assign("fpage_the", $page_the->fpage(0,3,2,4,7,6));//
            $this->assign("page", $page_the);
            $this->assign("uid", $uid);
            $this->assign("writer", $writer);
            $this->assign("sets_status", $sets_status);
            
            //输出brophp.php中定义的status全局数组中'mod'项的值
            //p("STATUS",$GLOBALS["status"]['mod']);
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            //$this->assign("flush", true);
            
            $this->assign("operating", $operating);
            
            $this->display();        
        
		}
        
        //定义对单个thesis记录的sub、aud、app、ret操作的显示页面所需的一些变量和开关
        function operate_status(){
            
            $groupname=$_SESSION['groupname'];
            
            $thesis=D("thesis");
            //根据operate_status.tpl中选中的the_id值查出需要修改的论文记录
            $thesis=$thesis->find($_GET['the_id']);
            
            //p("thesis",$thesis);
            //p("SESSION['gid']",$_SESSION['gid']);
            //p("SESSION['uid']",$_SESSION['userid']);
            //p("thesis['uid']",$thesis['uid']);
            
            //由开关控制operate_status.tpl中是否显示“附件下载”,登录账号为admin/批准人/审核人/维护人都显示,撰写人登录时与论文的撰写人为同一人也显示
            if($groupname == "审核人" || $groupname=="批准人" || $groupname=="超级管理员" || $groupname=="维护人"){
                $view=1;
            }elseif($groupname=="撰写人" && $_SESSION['userid']==$thesis['uid']){
                $view=1;
            }else{
                $view=0;
            };
            
            $org_status=$thesis['status'];
            
            $this->assign("org_status", $org_status);
            
            $this->assign("uid", $_GET['uid']);
            $this->assign("operate", $_GET['operate']);
            $this->assign("the_uid", $thesis['uid']);
            $this->assign("thesis", $thesis);
            $this->assign("view", $view);
            
            $this->display();
            }
            
        //检索出登录角色可操作的各个状态下的论文
        function my_index(){
            
            //p("GET",$_GET);
            
            //从$_SEESION数组中得到登录用户的信息
            $uid = $_SESSION['userid'];
            $gid = $_SESSION['gid']; 
            $writer = $_SESSION['username'];
            $groupname=$_SESSION['groupname'];
            $authority = array("gid"=>$gid,
                               "groupname"=>$groupname,
                               "authorityadd"=>$_SESSION['authorityadd'],
                               "authoritymod"=>$_SESSION['authoritymod'],
                               "authoritysub"=>$_SESSION['authoritysub'],
                               "authorityaud"=>$_SESSION['authorityaud'],
                               "authorityapp"=>$_SESSION['authorityapp'],
                               "authorityret"=>$_SESSION['authorityret'],
                               "maintain"=>$_SESSION['maintain'],
                               "useradmin"=>$_SESSION['useradmin']); 
            $dept = $_SESSION['dept']; 
            
             if (!empty($_GET['str'])){
                    $str_t=$_GET['str'];
                }else $str_t="writer";

                switch($groupname){
                    case "审核人" ://审核人
                        $field_str="the_id,uid,thetype,thetopic,status,writer,dept,adddate";
                        $where_str="status='提交' AND dept='$dept'"; 
                    
                    break;
                    
                    case "批准人" ://批准人
                        $field_str="the_id,uid,thetype,thetopic,status,writer,dept,adddate";
                        $where_str="status='审核'";
                    
                    break;
                    
                    case "撰写人" ://撰写人
                        $field_str="the_id,uid,thetype,thetopic,status,writer,dept,adddate";
                        $where_str="dept='$dept' AND uid='$uid' AND status='修改' OR dept='$dept' AND uid='$uid' AND status='退回' OR dept='$dept' AND uid='$uid' AND status='填报'"; 
                    
                    break;
                    
                    case "维护人" ://维护人
                        $field_str="the_id,uid,thetype,thetopic,status,writer,dept,adddate";
                        $where_str="status='批准' OR status='投稿' OR status='收录' OR status='拒稿' OR status='出版'";
                    
                    break;
            
                default://
                    break; 
                }
                
                $c=D("thesis")->field($field_str)->where($where_str)->total();
                
                /**
                 设置分页类的属性，共4个参数。第一个为总记录数，第二个为每页需要显示的记录数默认为“25”，
                 第三个为向下一个页面传递的参数，第四个默认为“true”，表示从第一页开始显示
                */             
    			$page_the=new Page($c,20,"thesis/my_index/str/".$str_t);
                
                $sets_the=D("thesis")->field($field_str)
                    ->where($where_str)
  				    ->limit($page_the->limit)
                    ->order($str_t." desc")
                    ->select(); 
            
            //添加登录用户的权限信息到论文记录集中的每条记录，为在“index.tpl”中显示可对每个论文记录进行的操作提供判定信息
            for($i=0;$i<count($sets_the);$i++){
                $sets_the[$i]=array_merge_recursive($sets_the[$i], $authority);   
            } 
            
            $page_the->set("head", "个论文");
            //$this->assign("usergroup",$usergroup);
			$this->assign("sets_the",$sets_the);
			$this->assign("fpage_the", $page_the->fpage(0,3,2,4,7,6));//
            $this->assign("page", $page_the);
            $this->assign("uid", $uid);
            $this->assign("writer", $writer);
            $this->assign("sets_status", $sets_status);
            
            //输出brophp.php中定义的status全局数组中'mod'项的值
            //p("STATUS",$GLOBALS["status"]['mod']);
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            //$this->assign("flush", true);
            
            $this->display();
		}
        
        //登录角色可看各状态论文的列表
        function thelist(){
            //p("GET",$_GET);
            //p("SESSION",$_SESSION);
            
            $cstatus = $_GET['cstatus'];
            //从$_SEESION数组中得到登录用户的信息
            $uid = $_SESSION['userid'];
            $gid = $_SESSION['gid']; 
            $groupname=$_SESSION['groupname']; 
            $writer = $_SESSION['username'];
            $authority = array("groupname"=>$groupname,
                               "authorityadd"=>$_SESSION['authorityadd'],
                               "authoritymod"=>$_SESSION['authoritymod'],
                               "authoritysub"=>$_SESSION['authoritysub'],
                               "authorityaud"=>$_SESSION['authorityaud'],
                               "authorityapp"=>$_SESSION['authorityapp'],
                               "authorityret"=>$_SESSION['authorityret'],
                               "useradmin"=>$_SESSION['useradmin']); 
            $dept = $_SESSION['dept'];
                
            //从thesis表查出记录,登录账号是admin/批准人/维护人是全部thesis，其他的仅仅选择所处部门的thesis
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $c=D("thesis")->field('the_id')->where(array('status'=>$cstatus))->total();
                
            }else{
                $c=D("thesis")->field('the_id,dept')->where(array('status'=>$cstatus,"dept"=>$dept))->total();
            }
            
            //通过分页类Page设置分页的表现形式,$str的内容是通过$GET数组保留的每一页查询显示所需的关键信息。
            $str="cstatus/".$cstatus;                
			$page_the=new Page($c,10,$str);
            
            //各个状态论文需要显示对应的状态时间。
            $field_str="the_id,uid,thetype,thetopic,status,writer,dept";
            switch($cstatus){
                    case "填报" :
                        $field_str=$field_str.",adddate as 'date'";

                    break;
                    
                    case "提交" :
                        $field_str=$field_str.",submitdate as 'date'";

                    break;
                    
                    case "修改" :
                        $field_str=$field_str.",mod_retdate as 'date'";

                    break;
                    
                    case "退回" :
                        $field_str=$field_str.",mod_retdate as 'date'";
                    break;
                    
                    case "审核" :
                        $field_str=$field_str.",auditdate as 'date'";
                       
                    break;
                    
                    case "批准" :
                        $field_str=$field_str.",approvedate as 'date'";
           
                    break;
                    
                    case "投稿" :
                        $field_str=$field_str.",cntrdate as 'date'";
                        
                    break;
                    
                    case "收录" :
                        $field_str=$field_str.",incl_rejdate as 'date'";

                    break;
                    
                    case "拒稿" :
                        $field_str=$field_str.",incl_rejdate as 'date'";
 
                    break;
                    
                    case "出版" :
                        $field_str=$field_str.",pubdate as 'date'";
           
                    break;                  
            
                default:
                    $field_str=$field_str.",adddate as 'date'";
                      
                    break;
                }
            
            //从thesis表查出记录并由limit设置分页数量,admin/批准人/维护人是全部thesis，其他的仅仅是所处部门的thesis
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $sets_the=D("thesis")->field($field_str)
  				    ->limit($page_the->limit)
                    ->where(array("status"=>$cstatus))
                    ->order("date desc")
                    ->select(); 
                
            }else{
                $sets_the=D("thesis")->field($field_str)
  				    ->limit($page_the->limit)//
                    ->where(array("status"=>$cstatus,"dept"=>$dept))
                    ->order("date desc","writer asc" )
                    ->select(); 
               
            }
            
            //添加登录用户的权限信息到论文记录集中的每条记录，为在“index.tpl”中显示可对每个论文记录进行的操作提供判定信息
            for($i=0;$i<count($sets_the);$i++){
                $sets_the[$i]=array_merge_recursive($sets_the[$i], $authority);   
            }
            
            //P("sets_the",$sets_the);
			
            $page_the->set("head", "个论文");
            //$this->assign("usergroup",$usergroup);
			$this->assign("sets_the",$sets_the);
			$this->assign("fpage_the", $page_the->fpage(0,3,2,4,7,6));//
            $this->assign("page", $page_the);
            $this->assign("uid", $uid);
            $this->assign("writer", $writer);
            $this->assign("cstatus",$cstatus);
            
            $this->display();      
        }                    

        //登录角色可操作各状态论文的列表
        function my_thelist(){
            //p("GET",$_GET);
            //p("SESSION",$_SESSION);
            
            $cstatus = $_GET['cstatus'];
            //从$_SEESION数组中得到登录用户的信息
            $uid = $_SESSION['userid'];
            $gid = $_SESSION['gid']; 
            $groupname=$_SESSION['groupname']; 
            $writer = $_SESSION['username'];
            $authority = array("groupname"=>$groupname,
                               "gid"=>$gid,
                               "authorityadd"=>$_SESSION['authorityadd'],
                               "authoritymod"=>$_SESSION['authoritymod'],
                               "authoritysub"=>$_SESSION['authoritysub'],
                               "authorityaud"=>$_SESSION['authorityaud'],
                               "authorityapp"=>$_SESSION['authorityapp'],
                               "authorityret"=>$_SESSION['authorityret'],
                               "useradmin"=>$_SESSION['useradmin']); 
            $dept = $_SESSION['dept'];
                
            //从thesis表查出记录,登录账号是admin/批准人/维护人是全部thesis，其他的仅仅选择所处部门的thesis
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $c=D("thesis")->field('the_id')->where(array('status'=>$cstatus))->total();
                
            }elseif($groupname == "审核人" ){
                $c=D("thesis")->field('the_id,dept')->where(array('status'=>$cstatus,"dept"=>$dept))->total();
            }else{//$groupname == "撰写人"
                $c=D("thesis")->field('the_id,uid,dept')->where(array('status'=>$cstatus,"dept"=>$dept,"uid"=>$uid))->total();
            }
            
            //通过分页类Page设置分页的表现形式,$str的内容是通过$GET数组保留的每一页查询显示所需的关键信息。
            $str="cstatus/".$cstatus;                
			$page_the=new Page($c,10,$str);

            $field_str="the_id,uid,thetype,thetopic,status,writer,dept";
            switch($cstatus){
                    case "填报" :
                        $field_str=$field_str.",adddate as 'date'";

                    break;
                    
                    case "提交" :
                        $field_str=$field_str.",submitdate as 'date'";

                    break;
                    
                    case "修改" :
                        $field_str=$field_str.",mod_retdate as 'date'";

                    break;
                    
                    case "退回" :
                        $field_str=$field_str.",mod_retdate as 'date'";
                    break;
                    
                    case "审核" :
                        $field_str=$field_str.",auditdate as 'date'";
                       
                    break;
                    
                    case "批准" :
                        $field_str=$field_str.",approvedate as 'date'";
           
                    break;
                    
                    case "投稿" :
                        $field_str=$field_str.",cntrdate as 'date'";
                        
                    break;
                    
                    case "收录" :
                        $field_str=$field_str.",incl_rejdate as 'date'";

                    break;
                    
                    case "拒稿" :
                        $field_str=$field_str.",incl_rejdate as 'date'";
 
                    break;
                    
                    case "出版" :
                        $field_str=$field_str.",pubdate as 'date'";
           
                    break;
                    
                default:
                    $field_str=$field_str.",adddate as 'date'";
                      
                    break;
                }
            
            //从thesis表查出记录并由limit设置分页数量,admin/批准人/维护人是全部thesis，其他的仅仅是所处部门的thesis
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $sets_the=D("thesis")->field($field_str)
  				    ->limit($page_the->limit)
                    ->where(array("status"=>$cstatus))
                    ->order("date desc")
                    ->select(); 
                
            }elseif($groupname == "审核人" ){//$groupname == "审核人",本部门的论文
                $sets_the=D("thesis")->field($field_str)
  				    ->limit($page_the->limit)//
                    ->where(array("status"=>$cstatus,"dept"=>$dept))
                    ->order("date desc","writer asc" )
                    ->select(); 
               
            }else{//$groupname == "撰写人",本部门自己撰写的论文
                $sets_the=D("thesis")->field($field_str)
  				    ->limit($page_the->limit)//
                    ->where(array("status"=>$cstatus,"dept"=>$dept,"uid"=>$uid))
                    ->order("date desc")
                    ->select(); 
            }
            
            //添加登录用户的权限信息到论文记录集中的每条记录，为在“index.tpl”中显示可对每个论文记录进行的操作提供判定信息
            for($i=0;$i<count($sets_the);$i++){
                $sets_the[$i]=array_merge_recursive($sets_the[$i], $authority);   
            }
            
            //P("sets_the",$sets_the);
			
            $page_the->set("head", "个论文");
            //$this->assign("usergroup",$usergroup);
			$this->assign("sets_the",$sets_the);
			$this->assign("fpage_the", $page_the->fpage(0,3,2,4,7,6));//
            $this->assign("page", $page_the);
            $this->assign("uid", $uid);
            $this->assign("writer", $writer);
            $this->assign("cstatus",$cstatus);

            $this->display();      
        }
        
        //新增
        function hynew(){
//            $writer=$_GET['writer'];
//            $uid= $_GET['uid'];
//            $this->assign("writer",$writer );
//            $this->assign("uid",$uid);
//            p("GET",$_GET);

            //p("POST",$_POST);
            //进行add操作的时间就是当天
            $thesis=D("thesis");
            $_POST["status"] = "新增";
            $_POST["adddate"] = date("Y-m-d");
            $_POST["writer"] = $_SESSION['username'];
            $_POST["uid"] = $_SESSION['userid'];
            $_POST["dept"] = $_SESSION['dept'];
            $thesis=$_POST;
            
            //p("thesis",$thesis); 
                      
            $this->assign("thesis", $thesis);
            $this->display();
		
        }
        
        //添加
		function add(){
//            $writer=$_GET['writer'];
//            $uid= $_GET['uid'];
//            $this->assign("writer",$writer );
//            $this->assign("uid",$uid);
//            p("GET",$_GET);
            
            $this->assign("thesis", $_POST);
            $this->display();
		
        } 
        
        //更新
        function update(){         
            //p("update--POST",$_POST);
            
            $thesis=D("thesis");
            
            $affectedrow=$thesis->update($_POST, 1, 1);
            
            if($affectedrow){
                //弹出窗体显示修改成功后的信息,跳转到index页面
                //$str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                //$str="论文".$str."修改成功！";
                //$this->success($str, 1,"thesis/index/uid/{$_POST['uid']}");
                
                //使用_SESSION全局变量向process表的操作传递内容。
                $_SESSION['oprobjid']=$_POST['the_id'];
                $_SESSION['oprreason']=$_POST['opr_symbol'];
                $_SESSION['oprobjtype']="thesis";
                $_SESSION['note']=$_POST['note'];
                
                //$flush=true，在temp.tpl中起到刷新menu页面的作用
                $this->assign("flush", true);
                                
                //根据$_POST['opr_symbol']选择相应的显示页面
                $opr_symbol=$_POST['opr_symbol'];                
                switch($opr_symbol){                   
                    case "完成" ://状态为“新增（new）”，可进行“新增（hynew）”，“提交（sub）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                        $str="论文".$str."填报成功！";
                        //$s="add";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();                                                
                        break;
                    case "填报" ://状态为“填报（add）”，可进行“修改（mod）”，“删除（del）”,“提交（sub）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                        $str="论文".$str."修改成功！";
                        //$s="add";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;
                    case "修改" ://状态为“修改（mod）”，可进行“修改（mod）”,“提交（sub）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                        $str="论文".$str."修改成功！";
                        //$s="mod";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;
                    case "提交" ://状态为“提交（sub）”，可进行“审核（aud）”，“退回（ret）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                        $str="论文".$str."提交成功！待部门【审核人】审核。";
                        //$s="sub";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();     
                        break;  
                    case "审核同意" ://状态为“审核（aud）”，可进行“批准（app）”,“退回（ret）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                        $str="论文".$str."部门审核通过！待院内【批准人】批准";
                        //$s="aud";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  ;   
                        break;
                    case "批准同意" ://状态为“审核（aud）”，可进行“批准（app）”,“退回（ret）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                        $str="论文".$str."已获院内批准！";
                        //$s="app";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;    
                    case "退回" ://状态为“退回（ret）”，可进行“修改（mod）”，“提交（sub）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                        $str="论文".$str."退回【撰写人】: ".$_POST['writer']."修改";
                        //$s="ret";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;
                    case "更新" ://状态为批准、投稿、收录、拒稿、出版，由维护人进行“维护（maintain）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                        $str="论文更新维护完成。";
                        //$s="ret";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;    
                default://状态为“批准（app）”，无需操作
                    break; 
                }  
            }else{
                if($affectedrow===0){
                    //弹出窗体显示未进行修改的信息,跳转到index页面
                    //$str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                    //$str="论文".$str."未被修改！";
                    //$this->error($str, 3,"thesis/mod/the_id/{$_POST['the_id']}");
                    
                    $str="<font color=\"red\">"."论文信息未发生变化！"."</font>";
                   
    			}else{
                    //弹出窗体显示接收经thesis.xml校验后的信息，并以红色字体显示，跳转到index页面
                    //$str="<font color=\"blue\">"."<h4>{$_POST['thetopic']}</h4>"."</font>";
                    //$str="论文".$str."修改时出现以下错误：<br/>";
                    //$str1=$thesis->getMsg();
                    //$str1="<font color=\"red\">".$str1."</font>";
                    //$str=$str.$str1;
                    //$this->error($str, 5,"thesis/mod/the_id/{$_POST['the_id']}");
                    
                    $str=$thesis->getMsg();
                    $str="<font color=\"red\">".$str."</font>";
                    
                    }
    			}
                
            //通过$str变量传递到模板文件显示进行操作后的信息
            $this->assign("str", $str);
            $this->assign("thesis", $_POST);
            $thesis=$_POST;
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            $this->assign("flush", true);
            $this->assign("org_status", $_POST['status']);
            
            $this->display();
        }
        
        //添加
		function insert(){
            $_POST['status']="填报"; 
            $thesis=D("thesis");
            $num=$thesis->insert($_POST, 1, 1);
                 
            	if($num){
    				//弹出窗体显示添加成功后的信息
                    //$this->success("新增论文： <b>{$_POST["thetopic"]}</b> 成功,可以继续添加！ ", 2,"thesis/add");
                    
                    $str="新增论文：<b>{$_POST["thetopic"]}</b> 成功,若有附件请继续上传。";
                    //以绿色字体显示添加成功后的信息
                    $str="<font color=\"green\">".$str."</font>";
                    
                    //新增记录，记入process表中，利用model层中定义的process类的add方法
                    $_SESSION['oprreason']="填报";
                    $_SESSION['oprobjid']=$num;
                    $process = D("process");
                    $process->add(); 
                    $_POST=$thesis->field()->where(array("the_id"=>$num))->find();
                    
                    //添加成功后清除$_POST数组内的内容，便于添加下一个新的thesis内容。
//                    $_POST=array();
//                    $_POST['writer']=$_SESSION['username'];
//                    $_POST['uid']=$_SESSION['userid'];
//                    $_POST['status']="新增";
                    
    			}else{
    				//接收经thesis.xml校验后的信息
                    $str=$thesis->getMsg();
                    
                    //以红色字体显示添加失败后的信息
                    $str="<font color=\"red\">".$str."</font>";
                    $_POST["status"] = "新增";
                    $_POST["adddate"] = date("Y-m-d");
                    $_POST["writer"] = $_SESSION['username'];
                    $_POST["uid"] = $_SESSION['userid'];
                    
    			}
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            $this->assign("flush", true);
            
            //通过$str变量传递到模板文件add.tpl显示进行添加操作后的信息
            $this->assign("str", $str);
            
            $this->assign("thesis", $_POST);
                        
			$this->display("hynew");
        }
        
        //修改
        function mod(){
            $thesis=D("thesis");
            
            //根据index.tpl中选中论文的the_id值查出选中论文的所有信息
            $thesis=D("thesis")->field()->find($_GET['the_id']);
            
            //if($thesis->update())
			//$this->assign("flush", true);
            
            //p("mod--thesis",$thesis['status']);
            
            //原来的状态
            $org_status=$thesis['status'];
            
            $this->assign("org_status", $org_status);
            $this->assign("thesis", $thesis);
            
            $this->display();
        }
        
        //提交
        function sub(){
            
            //进行sub操作的时间就是当天
//            $_POST["submitdate"] = date("Y-m-d");            
//            $this->assign("thesis", $_POST);
            
            //p("sub--POST",$_POST);
            
            //根据index.tpl中选中论文的the_id值查出选中论文的所有信息
            $thesis=D("thesis")->field()->find($_GET['the_id']);
            //$this->success("确定提交论文:"."{$thesis['thetopic']}",3,"thesis/sub");
            $thesis['submitdate']=date("Y-m-d");
            //原来的状态
            $org_status=$thesis['status'];
            
            //拟更改后的状态
            $thesis['status']= "提交";
            
            $this->assign("org_status", $org_status);
            $this->assign("thesis", $thesis);
            
            $this->display();
        }
        
         //上传附件的操作,待完成。参考“brocms\home\controls\user.class.php”里的function tset()来做
        function upfile(){
            //从$_SEESION数组中得到登录用户的信息
            $uid = $_SESSION['userid'];
            $gid=$_SESSION['gid'];
            $groupname = $_SESSION['groupname'];
            $att_name_display=$_POST["att_name_display"];
            
            if (empty($att_name_display)){
                $att_name_display=$_SESSION['groupname']."上传文件";
            }
            
            //p("_GET",$_GET);
            //p("POST",$_POST);
            //接收要上传附件的论文编号
            if (!empty($_GET['the_id'])){
                    $the_id =$_GET['the_id'];
                }else $the_id =$_POST['the_id'];
            
            $thesis=D("thesis");
            
            if(isset($_POST["sub"])){
                //判断上传文件的目录是否存在，不存在就创建
                $dirname=PROJECT_PATH.'upfile/thesis/'.$the_id.'/'.$gid;
                if($dir_handle=@opendir($dirname)){
                    closedir($dir_handle);
                    $file_dir=PROJECT_PATH.'upfile/thesis/'.$the_id.'/'.$gid;
                }else{
                    $file_dir1=PROJECT_PATH.'upfile/thesis/'.$the_id;
                    mkdir($file_dir1);
                
                    $file_dir=$file_dir1.'/'.$gid;
                    mkdir($file_dir);
                    
                }
                
                      
                //p("file_dir",$file_dir);
                
                //实例化文件上传对象。利用brophp框架的文件上传类“fileupload.class.php”
                $up = new FileUpload();
                
                //通过set方法设置上传的属性
                $up->set('path',$file_dir)                                          //根据gid的值将文件传到不同的文件夹
                ->set('maxsize', 10000000)                                          //限制上传文件最大为10MB
                ->set('allowtype', array('jpg', 'pdf', 'doc', 'docx', 'rar'))       //限制上传文件的类型
                ->set('israndname', true);                                          //不使用原文件名，让系统命名
                
                //调用$up对象的upload()方法上传文件，myfile是表单名称，上传成功返回true，否则为false
                if( $up->upload('myfile')){
                    $file_name= $up->getFileName();
                    $_POST["attachment"]=$file_name;
                    $_POST["the_id"]=$the_id;
  
                    //附件上传成功后将附件有关信息写入attachment表
                    $attachment=D("attachment");
                    $attachment->add($file_name,$att_name_display,"thesis",$the_id);
                    
                    if($thesis->update()){
                        $this->assign("message", "附件上传成功！");
                        //p("file_name",$file_name);
                        
                        //$this->assign("flush", true);
					}
                }else{
                    //如果上传多个文件，下面方法返回是数组，是多条出错信息。单文件上传出错则直接返回一条错误报告
                    //print_r($up->getErrorMsg());
                    
                    //$this->error($up->getErrorMsg(),5,"thesis/thelist/cstatus/$cstatus");
                    $this->assign("message", $up->getErrorMsg());
                    }
            }
            
            //p("thesis",$thesis);
            $this->assign("gid", $gid);
            $this->assign("groupname", $groupname);
            $this->assign("the_id", $the_id);
            $this->assign("thesis", $thesis->field("the_id,thetopic,status,attachment")->find($the_id));
                        
            $this->display();
        }
        
        //批准
        function app(){
            $thesis=D("thesis")->field()->find($_GET['the_id']);
            $thesis['approvedate']=date("Y-m-d");
             //原来的状态
            $org_status=$thesis['status'];
            
            if($_SESSION['groupname']=="批准人"){
                $thesis['status']="批准";
            }else {
                $this->error("没有【批准】的操作权限，批准人才可进行此操作！",1,"thesis/index");
                
            }
            $this->assign("org_status", $org_status);
            $this->assign("thesis", $thesis);
            
            $this->display();			
        }
        
        //审核
        function aud(){
            //根据index.tpl中选中论文的the_id值查出选中论文的所有信息
            $thesis=D("thesis")->field()->find($_GET['the_id']);
            $thesis['auditdate']=date("Y-m-d");
            //原来的状态
            $org_status=$thesis['status'];

            if($_SESSION['groupname']=="审核人"){
                $thesis['status']="审核";
            }else {
                $this->error("没有【审核】的操作权限,审核人才可进行此操作！",1,"thesis/index");
                
            }
            
            $this->assign("org_status", $org_status);
            $this->assign("thesis", $thesis);
            
            $this->display();		
        }
        
         //删除
        function del(){

            $the_id = $_GET['the_id'] ;
              
            $thesis = D("thesis");
             
            $data = $thesis -> where($the_id)
                            -> r_delete(
                               array('process','oprobjid',array('oprobjtype'=>'thesis'))
                            );
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            $this->assign("flush", true);
            
            $this->redirect("my_index");
 
        }
        
        //维护,$_SESSION['groupname']="维护人"
        function maintain(){
            
            $groupname=$_SESSION['groupname'];
             //根据index.tpl中选中论文的the_id值查出选中论文的所有信息
            $thesis=D("thesis")->field()->find($_GET['the_id']);
            
            //查找之前所做更新记录
            $process=D("process")->field('groupname,username,oprdate,oprreason,note')
                            //>where(array("oprobjid"=>$_GET['pat_id']))
                            ->where(array("groupname"=>$groupname,"oprobjtype"=>"thesis","oprobjid"=>$_GET['pat_id']))
                            ->select();
            
            //遍历二维数组$process，生成HTML代码赋值给$mt_record后再在maintain.tpl模板中输出
            foreach($process as $m){
                $mt_record.='<span class="col_width3">&nbsp;&nbsp;';
                foreach($m as $n){
                    $mt_record.=$n.';&nbsp;';
                }
                $mt_record=$mt_record.'</span>';
            }
            
            //原来的状态
            $org_status=$thesis['status'];

            if($groupname=="维护人"){
                //$thesis['status']="审核";
                switch($org_status){
                    case "批准":
                        
                        $thesis['cntrdate']=date("Y-m-d");
                    break;
                    
                    case "投稿":
                        $thesis['cntrdate']=date("Y-m-d");
                    break;
                    
                    case "收录":
                        $thesis['incl_rejdate']=date("Y-m-d");
                    break;
                    
                    case "拒稿":
                        $thesis['incl_rejdate']=date("Y-m-d");
                    break;
                    
                    case "出版":
                        $thesis['pubdate']=date("Y-m-d");
                    break;
                    
                    default:
                    break;
                }
                
            }else {
                $this->error("没有【维护】的操作权限,维护人才可进行此操作！",1,"thesis/index");
                
            }
            
            $this->assign("org_status", $org_status);
            $this->assign("thesis", $thesis);
            $this->assign("mt_record",$mt_record);
            
            $this->display();
            			
        }
        
         //退回
        function ret(){
             //p("ret--SESSION",$_SESSION);
            
            $thesis=D("thesis")->field()->find($_GET['the_id']);
            $thesis['mod_retdate']=date("Y-m-d");
            //原来的状态
            $org_status=$thesis['status'];
            
            if($_SESSION['groupname']=="审核人"){
                $thesis['status']="修改";
            }elseif($_SESSION['groupname']=="批准人"){
                $thesis['status']="退回";
            }else {
                $this->error("没有【退回】的操作权限",1,"thesis/index");
                
            }
            $this->assign("org_status", $org_status);
            $this->assign("thesis", $thesis);
            
            $this->display();		
        }
        
        //删除模板
        function del_temp(){
            //p("sub--POST",$_POST);
            $thesis=D("thesis")->field()->find($_GET['the_id']);
           
            $thesis['status']= "删除";
            
            $this->assign("thesis", $thesis);
            
            $this->display();
 
        }
                              

	}
