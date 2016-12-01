<?php
	class Index {
		function index(){
			debug(1);  //临时开启调试模式
			$this->display();
		}
		function top(){
			debug(0);  //临时关闭调试模式
			$this->display();
		}
		function menu(){
			debug(0);  //临时关闭调试模式
			$this->display();
		}
		function main(){
			$this->mess("请操作左侧菜单，对本网站的内容进行管理. ");
			$this->display();
		}
		function bottom(){
			debug(0);  //临时关闭调试模式
            
			//对专利有批准权限才输出
			//if($_SESSION["authorityapp"]) {
//				$this->assign("patents", D("patent")->total());
//			}

		
			//有对用户管理的权限才输出
			if($_SESSION["useradmin"]) {
			    //系统账号数
                $user_role=D("hyuser")->total();
                //系统用户数
                $user_num = count(D("hyuser")->group('username')->select());
				$this->assign("user_role",$user_role);
                $this->assign("user_num",$user_num );
			}
			$this->display();
		}
	}
