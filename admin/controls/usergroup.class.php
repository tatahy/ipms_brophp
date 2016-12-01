<?php
	class UserGroup {
		function index(){
			
            //$usergroups=D("usergroup");
//            $usergroups=D("usergroup")->field('groupid,groupname,groupdes')->select();
//            
            $this->mess('管理员用户组不能删除，否则将不能登录系统. ');
			$this->assign("usergroups", D("usergroup")->field('groupid,groupname,groupdes')->select());
                       
			$this->display();
		}
	
		function  add(){
			$this->mess('提示: 带<span class="red_font">*</span>的项目为必填信息. ');
			$this->display();
		}

		function insert(){
			$usergroups=D("usergroup");

			if($usergroups->insert($_POST, 1, 1)){
				$this->mess("用户组{$_POST["groupname"]}添加成功！. ",true);
				$this->assign("usergroups", D("usergroup")->field('groupid, groupname,groupdes')->select());
				$this->display('index');

			}else{
				$this->mess($usergroups->getMsg(),false);
				$this->assign("post", $_POST);
				$this->display('add');
			}
		}



		function del(){
			$usergroups=D("usergroup");
			if(D("user")->total(array('groupid'=>$_GET['groupid'])) > 0){
				$this->mess('请将该用户组中所有成员移动到其他组中再删除!', false);
			}else{
				if($usergroups->delete($_GET['groupid'])) {
					$this->mess('成功删除用户组！', true);
				}else{
					$this->mess($usergroups->getMsg(), false);
				}
			}
			$this->assign("usergroups", D("usergroup")->field('groupid, groupname,groupdes')->select());
			$this->display('index');

		}


		function mod(){ 
			$this->mess('提示: 带<span class="red_font">*</span>的项目为必填信息. ');
			$this->assign("post", D("usergroup")->find($_GET['groupid']));  //注意，此处用BroPHP框架中提供的D()方法后得到的数组下标都变为小写,所以数据表中的字段名都用小写方便统一
			$this->display();
            
		}

		function update(){
            $usergroups=D("usergroup");

		    $_POST["authorityadd"] = !empty($_POST["authorityadd"]) ? $_POST["authorityadd"] : 0;
			$_POST["authoritymod"] = !empty($_POST["authoritymod"]) ? $_POST["authoritymod"] : 0;
			$_POST["authoritysub"] = !empty($_POST["authoritysub"]) ? $_POST["authoritysub"] : 0;
			$_POST["authorityaud"] = !empty($_POST["authorityaud"]) ? $_POST["authorityaud"] : 0;
			$_POST["authorityapp"] = !empty($_POST["authorityapp"]) ? $_POST["authorityapp"] : 0;
			$_POST["authorityret"] = !empty($_POST["authorityret"]) ? $_POST["authorityret"] : 0;
            $_POST["maintain"] = !empty($_POST["maintain"]) ? $_POST["maintain"] : 0;
            $_POST["useradmin"] = !empty($_POST["useradmin"]) ? $_POST["useradmin"] : 0;

			$affectedrow=$usergroups->update($_POST,1,1);
            
			if($affectedrow){
				$this->mess("用户组【{$_POST["groupname"]}】修改成功！. ",true);
				$this->assign("usergroups", D("usergroup")->field('groupid, groupname,groupdes')->select());
				$this->display('index');
			}else{
				if($affectedrow===0)
					$mess="数据没有改变";
				else
					$mess=$usergroups->getMess();

				$this->mess($mess,false);
				$this->assign("post", $_POST);
				$this->display('mod');
			}
		}
	}
