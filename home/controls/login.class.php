<?php
	class Login extends Action{
		function index(){
			$this->caching=0;     //设置缓存关闭
            
			//p("POST",$_POST); 
            //p("GET",$_GET); 
                       
            if(!empty($_GET['uid'])){
                $temp_user=D("hyuser")->field('userid,gid,username,disable,dept')
    				->where(array("userid"=>$_GET['uid'],"disable"=>0))
    				->find();
                
                $usergroup=D("usergroup")->field('groupname,groupdes,authorityadd,authoritymod,authoritysub,authorityaud,authorityapp,authorityret,maintain,useradmin')
                    ->where(array("groupid"=>$temp_user["gid"]))
                    ->find();   //MySQL中的字段名是区分大小写的，否则查找不到表中的记录。
                
                $user=array_merge($temp_user, $usergroup);
                
                //P("user",$user);
               
   				$_SESSION=$user;
                $_SESSION["role"]=$_GET['role'];
                $_SESSION["login"]=1;
                
                
                //P("SESSION",$_SESSION);
                
                //common.class.php对角色账号的访问权限有全局的控制。！！HY
   				$this->success("你好 {$user['username']}, 登录成功！",1,"index/index");
  
    			}else{
                    $this->error("该角色 {$_GET['role']} 已被禁用,请重新选择其他角色或联系管理员！", 3,"role_select");
                }
                    
                
            }

        
        function role_select(){
            $this->caching=0;     //设置缓存关闭
            
            $stats=false;
			$errormess="登录失败：<br>";
            
            //$_GET["name"]响应..\ipms\home\views\default\public\header.tpl和
            //..\ipms\home\views\default\hyuser\menu.tpl两处选择系统角色的超链接操作（<a>标签）
            if(empty($_GET["name"])){
                if(!preg_match('/^\S+$/i', $_POST["username"])){
				$errormess.="用户名不能为空!<br>";
				$stats=true;	
    			}
    			if(!preg_match('/^\S+$/i', $_POST["userpwd"])){
    				$errormess.="用户密码不能为空!<br>";
    				$stats=true;	
    			}
    		
    			if($stats){
    				$this->error($errormess, 3,"index/index");
    			}
                
                //将登录用户所有的角色及权限查出，但是如果各个角色的密码不同，查出来的可能不是该用户所有的角色！！HY    
    			$role_array=D("hyuser")->field('userid,gid,username,disable')->order("gid desc")
                                ->where(array("username"=>$_POST["username"],"userpwd"=>md5($_POST["userpwd"]), "disable"=>0))
                                ->r_select(
                                    array("usergroup",'groupid,groupname','groupid','gid')
                                    );
                
            }elseif($_GET["name"]==$_SESSION["username"]){
                $role_array=D("hyuser")->field('userid,gid,username,disable')->order("gid desc")
                            ->where(array("username"=>$_GET["name"],"disable"=>0))
                            ->r_select(
                                array("usergroup",'groupid,groupname','groupid','gid')
                                );
            }else{
                $this->error("您不是用户 ".$_GET["name"].",请重新登录！", 2);
            }            
            
            if($role_array){
                 $this->assign("role_array",$role_array);
			     $this->display();
                
            }else{
    				$this->error("该用户不存在,请重新登录！", 2);
    			}
       
               
        }


        function logout(){
 			$this->caching=0;     //设置缓存关闭
			$username=$_SESSION["username"];
    		D("hyuser", "admin")->logout();
 			$this->success("再见 $username , 退出成功!", 1, "index/index");
		}

/**
		function register(){
			$this->caching=0;     //设置缓存关闭
			$this->display();	
		}


 * 		function insert(){
 * 			$this->caching=0;     设置缓存关闭
 * 			$user=D("user","admin");
 * 			$_POST["regtime"]=time();
 * 			$_POST["userpwd"]=md5($_POST["userpwd"]);
 * 			$_POST["repwd"]=md5($_POST["repwd"]);
 * 			$_POST["gid"]=2;
 * 			$lastid=$user->insert($_POST, 1, 1);
 * 			if($lastid){
 * 				$user=$user->field('id,gid,username,disable')->find($lastid);
 * 				$group=D("group")->field('groupname,useradmin,webadmin,articleadmin,sendarticle,sendcomment,sendmessage')->where(array("id"=>$user["gid"]))->find();
 * 				$guser=array_merge($user, $group);
 * 				$_SESSION=$guser;
 * 				$_SESSION["login"]=1;
 * 				$this->success("注册成功,直接登录！",1,'index/index');
 * 			}else{
 * 				$this->error($user->getMsg(), 3, 'register');
 * 			}
 * 		}
 */

/**
 * 		function unique(){
 * 			$this->caching=0;     //设置缓存关闭
 * 			debug(0);
 * 			if(D("user")->total(array("username"=>$_GET["username"])) > 0){
 * 				echo "false";
 * 			}else{
 * 				echo "true";
 * 			}
 * 		}
 */

		function code(){
			$this->caching=0;     //设置缓存关闭
			echo new Vcode();
		}

		function vcode(){
			$this->caching=0;     //设置缓存关闭
			debug(0);
			if(strtoupper($_GET["code"])==$_SESSION["code"]){
				echo "true";
			}else{
				echo "false";
			}
		}
	}
