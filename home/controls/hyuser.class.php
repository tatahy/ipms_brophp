<?php
	class Hyuser {
		function hyindex(){
			debug(0);  
            
            if (!empty($_POST)){
                $uid=$_POST['uid'];
            }else{
                $uid=$_GET['uid'];
            }
            
            $user= D("hyuser")->field('userid,username,dept')->where(array("userid"=>$uid))->find();
            
            //P("uid",$_POST['uid']);
            //p("user",$user);
            
            //用户在浏览器URL栏中通过输入uid的方法（../9_ipms_patent/index.php/hyuser/hyindex/uid/xx）登录是被禁止的。
			if(empty($_POST['uid']) || !$user){
                $this->error('不是合法登录的用户',3,"index/index");
            }
                   	
                $this->display();
		}
        
		function top(){
			debug(0);
			$this->display();
		}
        
        //按patent表和thesis表中记录的状态分别统计状态数，传递到menu.tpl进行显示
		function menu(){
			debug(0);
            
            //p("session",$_SESSION);
            
            if (!empty($_POST)){
                $uid=$_POST['uid'];
            }else{
                $uid=$_GET['uid'];
            }
           
             //从hyuser表查出登录用户的信息
            $user= D("hyuser")->field('userid,username,dept,gid')->where(array("userid"=>$uid))->find();
            
            //从usergroup表查出登录用户所拥有的权限
            $usergroup = D("usergroup")->field('groupid,groupname,authorityadd,authoritymod,authoritysub,authorityaud,authorityapp,authorityret,maintain,useradmin')
                ->where(array("groupid"=>$user['gid']))
                ->find();
            
            $user_authority=array_merge_recursive($user, $usergroup); 
            
            //p("user_authority",$user_authority);
            
            //传递登录用户及其权限信息到menu.tpl进行显示
            $this->assign("user_authority",$user_authority);  
            
            $patent = D("patent");
            $thesis = D("thesis");         
            
           //patent:专利的所有状态
           $gstatus=$GLOBALS["status_num"]; 
            //统计patent表里的各个状态的记录数，$user_authority['groupname']=="批准人" or "维护人" or "超级管理员"是整个表的
           if( $user_authority['groupname']=="批准人" || $user_authority['groupname']=="维护人" || $user_authority['groupname']=="超级管理员"){
                             
                //循环计算各个状态下的专利数
                $num_total=0;
                for($i=0; $i<count($gstatus); $i++){   
                    $num[$i]=$patent->field('status')->where(array("status"=>"$gstatus[$i]"))->total();
                    //计算专利总数
                    $num_total=$num_total+$num[$i];
                }
                
                //如果状态的总数为奇数，传递$add_li=1到menu.tpl，否则传递$add_li=0到menu.tpl
                if(count($num)%2==1){
                    $add_li=1;
                }else{
                    $add_li=0;
                }
                $this->assign("add_li",$add_li);                 
                
                $my_num_total=0;
                //"批准人" or "维护人"所要操作的专利状态及总数
                if($user_authority['groupname']=="维护人" ){
                    $my_status=array("批准","申报","授权","放弃","驳回","维护");
                    for($i=0; $i<count($my_status); $i++){
                        $my_num[$i]=$patent->field('status')->where(array("status"=>"$my_status[$i]"))->total();
                        $my_num_total=$my_num_total+$my_num[$i];
                    }
                
                }elseif($user_authority['groupname']=="批准人" ){
                    $my_status=array("审核");
                    for($i=0; $i<count($my_status); $i++){
                        $my_num[$i]=$patent->field('status')->where(array("status"=>"$my_status[$i]"))->total();
                        $my_num_total=$my_num_total+$my_num[$i];
                    }
                }
                
                //将所在本部门各个状态下的专利数传递给menut.tpl模板文件显示
                $this->assign("num",$num);
                
                //将所在本部门各个状态的名称传递给menut.tpl模板文件显示
                $this->assign("gstatus",$gstatus);
                
                //将所在本部门专利总数传递给menut.tpl模板文件显示
                $this->assign("num_total",$num_total);
                
                //将登录角色可操作的各个状态下的专利数传递给menut.tpl模板文件显示
                $this->assign("my_num",$my_num);
                
                //将登录角色可操作的各个状态的名称传递给menut.tpl模板文件显示
                $this->assign("my_status",$my_status);                
                
                //将登录角色可操作的专利总数传递给menut.tpl模板文件显示
                $this->assign("my_num_total",$my_num_total);
    
           }else{
                //$user_authority['groupname']=="撰写人" or "审核人" 是显示所在本部门的各个状态下的专利数
                $num_total=0;
                for($i=0; $i<count($gstatus); $i++){   
                    $num[$i]=$patent->field('status,dept')->where(array("status"=>"$gstatus[$i]","dept"=>$user_authority['dept']))->total();
                    //计算所在本部门专利总数
                    $num_total=$num_total+$num[$i];
                }
                
                //如果状态的总数为奇数，传递$add_li=1到menu.tpl，否则传递$add_li=0到menu.tpl
                if(count($num)%2==1){
                    $add_li=1;
                }else{
                    $add_li=0;
                }
                $this->assign("add_li",$add_li);
                
                $my_num_total=0;
                //"撰写人" or "审核人"所要操作的专利状态及总数
                if($user_authority['groupname']=="撰写人" ){
                    $my_status=array("填报","修改","退回");
                    for($i=0; $i<count($my_status); $i++){
                        $my_num[$i]=$patent->field('uid,status')->where(array("status"=>"$my_status[$i]","uid"=>$uid,"dept"=>$user_authority['dept']))->total();
                        $my_num_total=$my_num_total+$my_num[$i];
                    }
                
                }elseif($user_authority['groupname']=="审核人" ){
                    $my_status=array("提交");
                    for($i=0; $i<count($my_status); $i++){
                        $my_num[$i]=$patent->field('status')->where(array("status"=>"$my_status[$i]","dept"=>$user_authority['dept']))->total();
                        $my_num_total=$my_num_total+$my_num[$i];
                    }
                }
                
                //将所在本部门各个状态下的专利数传递给menut.tpl模板文件显示
                $this->assign("num",$num);
                
                //将所在本部门各个状态的名称传递给menut.tpl模板文件显示
                $this->assign("gstatus",$gstatus);
                
                //将所在本部门专利总数传递给menut.tpl模板文件显示
                $this->assign("num_total",$num_total);
                
                //将登录角色可操作的各个状态下的专利数传递给menut.tpl模板文件显示
                $this->assign("my_num",$my_num);
                
                //将登录角色可操作的各个状态的名称传递给menut.tpl模板文件显示
                $this->assign("my_status",$my_status);                
                
                //将登录角色可操作的专利总数传递给menut.tpl模板文件显示
                $this->assign("my_num_total",$my_num_total);
            
           }           
           	//$flush=true，在menu.tpl中起到刷新menu页面的作用
            //$this->assign("flush", true);
           
           //thesis:论文的所有状态
           $the_gstatus=$GLOBALS["the_status_num"];
            //统计thesis表里的各个状态的记录数，$user_authority['groupname']=="批准人" or "维护人" or "超级管理员"是整个表的
           if( $user_authority['groupname']=="批准人" || $user_authority['groupname']=="维护人" || $user_authority['groupname']=="超级管理员"){
                             
                //循环计算各个状态下的论文数
                $the_num_total=0;
                for($i=0; $i<count($the_gstatus); $i++){   
                    $the_num[$i]=$thesis->field('status')->where(array("status"=>"$the_gstatus[$i]"))->total();
                    //计算论文总数
                    $the_num_total=$the_num_total+$the_num[$i];
                }
                
                //如果状态的总数为奇数，传递$add_li=1到menu.tpl，否则传递$add_li=0到menu.tpl
                if(count($the_num)%2==1){
                    $the_add_li=1;
                }else{
                    $the_add_li=0;
                }
                $this->assign("the_add_li",$the_add_li);                 
                
                $the_my_num_total=0;
                //"批准人" or "维护人"所要操作的专利状态及总数
                if($user_authority['groupname']=="维护人" ){
                    $the_my_status=array("批准","投稿","收录","拒稿","出版");
                    for($i=0; $i<count($the_my_status); $i++){
                        $the_my_num[$i]=$thesis->field('status')->where(array("status"=>"$the_my_status[$i]"))->total();
                        $the_my_num_total=$the_my_num_total+$the_my_num[$i];
                    }
                
                }elseif($user_authority['groupname']=="批准人" ){
                    $the_my_status=array("审核");
                    for($i=0; $i<count($the_my_status); $i++){
                        $the_my_num[$i]=$thesis->field('status')->where(array("status"=>"$the_my_status[$i]"))->total();
                        $the_my_num_total=$the_my_num_total+$the_my_num[$i];
                    }
                }
                
                //将所在本部门各个状态下的论文数传递给menu.tpl模板文件显示
                $this->assign("the_num",$the_num);
                
                //将所在本部门各个状态的名称传递给menu.tpl模板文件显示
                $this->assign("the_gstatus",$the_gstatus);
                
                //将所在本部门论文总数传递给menu.tpl模板文件显示
                $this->assign("the_num_total",$the_num_total);
                
                //将登录角色可操作的各个状态下的论文数传递给menu.tpl模板文件显示
                $this->assign("the_my_num",$the_my_num);
                
                //将登录角色可操作的各个状态的名称传递给menu.tpl模板文件显示
                $this->assign("the_my_status",$the_my_status);                
                
                //将登录角色可操作的论文总数传递给menut.tpl模板文件显示
                $this->assign("the_my_num_total",$the_my_num_total);
    
           }else{
                //$user_authority['groupname']=="撰写人" or "审核人" 是显示所在本部门的各个状态下的论文数
                $the_num_total=0;
                for($i=0; $i<count($the_gstatus); $i++){   
                    $the_num[$i]=$thesis->field('status,dept')->where(array("status"=>"$the_gstatus[$i]","dept"=>$user_authority['dept']))->total();
                    //计算所在本部门论文总数
                    $the_num_total=$the_num_total+$the_num[$i];
                }
                
                //如果状态的总数为奇数，传递$add_li=1到menu.tpl，否则传递$add_li=0到menu.tpl
                if(count($the_num)%2==1){
                    $the_add_li=1;
                }else{
                    $the_add_li=0;
                }
                $this->assign("the_add_li",$the_add_li);
                
                $the_my_num_total=0;
                //"撰写人" or "审核人"所要操作的专利状态及总数
                if($user_authority['groupname']=="撰写人" ){
                    $the_my_status=array("填报","修改","退回");
                    for($i=0; $i<count($the_my_status); $i++){
                        $the_my_num[$i]=$thesis->field('uid,status')->where(array("status"=>"$the_my_status[$i]","uid"=>$uid,"dept"=>$user_authority['dept']))->total();
                        $the_my_num_total=$the_my_num_total+$the_my_num[$i];
                    }
                
                }elseif($user_authority['groupname']=="审核人" ){
                    $the_my_status=array("提交");
                    for($i=0; $i<count($the_my_status); $i++){
                        $the_my_num[$i]=$thesis->field('status')->where(array("status"=>"$the_my_status[$i]","dept"=>$user_authority['dept']))->total();
                        $the_my_num_total=$the_my_num_total+$the_my_num[$i];
                    }
                }
                
                //将所在本部门各个状态下的专利数传递给menut.tpl模板文件显示
                $this->assign("the_num",$the_num);
                
                //将所在本部门各个状态的名称传递给menut.tpl模板文件显示
                $this->assign("the_gstatus",$the_gstatus);
                
                //将所在本部门专利总数传递给menut.tpl模板文件显示
                $this->assign("the_num_total",$the_num_total);
                
                //将登录角色可操作的各个状态下的专利数传递给menut.tpl模板文件显示
                $this->assign("the_my_num",$the_my_num);
                
                //将登录角色可操作的各个状态的名称传递给menut.tpl模板文件显示
                $this->assign("the_my_status",$the_my_status);                
                
                //将登录角色可操作的专利总数传递给menut.tpl模板文件显示
                $this->assign("the_my_num_total",$the_my_num_total);
            
           }           
            if($user_authority['groupname']=="撰写人" ){
                $this->assign("uid",$user_authority['uid']);
                $this->assign("writer",$user_authority['username']);
            }
            
			$this->display();
		}
        
        function main(){
            
            $patent=D("patent");
            $thesis=D("thesis");
            $time=strtotime(date("Y-m-d"))+60*60*24;
            $groupname=$_SESSION['groupname']; 
            //p("SESSION",$_SESSION);
            
             //从patent表查出记录数,登录账号是“超级管理员”/"批准人"/"维护人"是全部patent，其他的仅仅选择所处部门的patent			
           if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
              	//获取patent总数
                $pat_total=$patent->total();
                //获取“填报”的patent总数
                $pat_add=$patent->where(array('status'=>"填报"))->total();
                //获取有效的（“授权”&“维护”状态）patent总数
                $pat_license=$patent->where(array('status'=>array("授权","维护")))->total();
                
                //获取thesis总数
                $the_total=$thesis->total();
                //获取“填报”的thesis总数
                $the_add=$thesis->where(array('status'=>"填报"))->total();
                //获取发表的（“出版”状态）thesis总数
                $the_pub=$thesis->where(array('status'=>"出版"))->total(); 
                                 
           }else{//无批准权限的账号，是显示所在本部门的各个状态下的专利数
                //获取patent总数
                $pat_total=$patent->where(array('dept'=>$_SESSION["dept"]))->total();
                //获取“填报”的patent总数
                $pat_add=$patent->where(array('dept'=>$_SESSION["dept"],'status'=>"填报"))->total(); 
                //获取有效的（“授权”&“维护”状态）patent总数
                $pat_license=$patent->where(array('dept'=>$_SESSION["dept"],'status'=>array("授权","维护")))->total();
                
                //获取thesis总数
                $the_total=$thesis->where(array('dept'=>$_SESSION["dept"]))->total();
                //获取“填报”的thesis总数
                $the_add=$thesis->where(array('dept'=>$_SESSION["dept"],'status'=>"填报"))->total(); 
                //获取有效的（“出版”状态）thesis总数
                $the_pub=$thesis->where(array('dept'=>$_SESSION["dept"],'status'=>"出版"))->total();
               
                } 
           
            //$flush=true，在main.tpl中起到刷新menu页面的作用
            //$this->assign("flush", true);
        
            $this->assign("pat_total",$pat_total);
            $this->assign("pat_add",$pat_add);
            $this->assign("pat_license",$pat_license);
            
            $this->assign("the_total",$the_total);
            $this->assign("the_add",$the_add);
            $this->assign("the_pub",$the_pub);
			
			$this->display();
          
            }
            
        //修改登录角色密码
		function pset(){
			
			if(isset($_POST["sub"])){
			
				if($_POST["userpwd"]!=$_POST["repwd"]){
					$this->assign("confirm", "confirm");
				}else{
					$user=D("hyuser");
                    //所有“username”的记录
					$row=$user->field("userid,username,userpwd")->where(array("username"=>$_SESSION["username"], "userpwd"=>md5($_POST["cuserpwd"])))->select();
                   
                    //将所有“username”的密码都修改为md5($_POST["userpwd"])
					if($row){
						$_POST["userpwd"]=md5($_POST["userpwd"]);
						if($user->where(array("username"=>$_SESSION["username"]))->update()){
						      
							$this->assign("confirm", "yes");
                            //p("yes的username",$row); 
						}else{
						     
							$this->assign("confirm", "no");
                             //p("no的username",$row); 
						
						}
					}else{
						$this->assign("confirm", "error");
					}
				}
				
				
			}
			
			$this->display();
		}
            
   }
            