<?php
	class Login extends Action{
		function index(){
			debug(1);  //临时开启调试模式
			$this->display();
		}

		function prologin(){
			$this->validate();

			$user=D("hyuser")->field('userid,gid,username,disable')
				->where(array("username"=>$_POST["username"], "userpwd"=>md5($_POST["userpwd"]), "disable"=>0,"gid"=>1))
				->find();
                                
			if($user){
				$usergroup=D("usergroup")->field('groupname,groupdes,authorityadd,authoritymod,authoritysub,authorityaud,authorityapp,authorityret,useradmin')
                ->where(array("groupid"=>$user["gid"]))
                ->find();   //MySQL中的字段名是区分大小写的，否则查找不到表中的记录。
                
                $guser=array_merge($user, $usergroup);
                
				if($guser["useradmin"] || $guser["authorityapp"]) {
					$_SESSION=$guser;     
					$_SESSION["isLogin"]=1;
					$_SESSION["login"]=1;
					$this->redirect("index/index");
				}else {
					//P($guser);   //利用框架定义的P()函数输出结果
                    $this->error("不能登录后台，权限不足！", 10, "index");
                    
				}
			}else{
				$this->error("用户名或密码错误,请重新登录！", 3, "index");
			}
		}

		function logout(){
			$userName=$_SESSION["username"];
			
			D("hyuser")->logout();
			
			$this->success("再见{$username}, 退出成功!", 1, "index");
		}

		private function validate(){
			$stats=false;
			$errormess="登录失败：<br>";
			if(!preg_match('/^\S+$/i', $_POST["username"])){
				$errormess.="用户名不能为空!<br>";
				$stats=true;	
			}
			if(!preg_match('/^\S+$/i', $_POST["username"])){
				$errormess.="用户密码不能为空!<br>";
				$stats=true;	
			}
			if(strtoupper($_POST["code"])!=$_SESSION["code"]){
				$errormess.="验证码输出错误!<br>";
				$stats=true;	
			}
			if($stats){
				$this->error($errormess, 10, "index");
			}
		}

		function code(){
			echo new Vcode(50,20);
		}
      }
