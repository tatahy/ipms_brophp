<?php
	class Hyuser {
		function index(){
			$user=D("hyuser");
            $usergroup=D("usergroup");
			
			$this->mess('管理员用户不能删除，否则将不能登录系统，<a href="'.B_URL.'/index/disable/1" style="background:#EECCCC;">深色记录</a>为禁用用户.<br> 用户被删除时,他的文章及评论等所有信息也会一同删除. ');
			$arr=$_GET;

			if($arr["disable"] == "1") {
				$where=array("disable"=>1);
				$this->assign("disable", 1);
				$pget="disable/1";  //分页条件
			}else{
				$where="";
				$select=!empty($arr['gid']) ? $arr['gid'] : 0;
			
				$search=!empty($arr["search"]) ? $arr['search'] : "";
		
				$this->assign('select', D('usergroup')->formselect('groupid', $select));
 
				if($select != 0) {  //选择用户组
					$where["gid"]=$select;
					$pget.="/gid/{$select}";  //分页条件
					$this->assign("gid", $select);
				} 
				if($search!="") {    //搜索
					$where["username"]="%{$arr["search"]}%";
					$pget.="/search/{$arr["search"]}";  //分页条件
				} 
			}
			$page=new Page($user->total($where), ARTICLE_PAGE_SIZE, $pget);
          
 			$users=$user->field('userid,username,regdate,disable,dept,gid')->order("dept asc,gid asc,username asc")
                        ->limit($page->limit)
                        ->where($where)
                        ->r_select(
                            array("usergroup",'groupid,groupname','groupid','gid')
                        );

			$page->set("head", "个账号");
			$this->assign("users",$users);
			$this->assign("search", $search);
			$this->assign("fpage", $page->fpage(0,3,2,4,5,6));
			$this->assign("page", $page->page);
           
			$this->display();	
		}
	
		function  add(){
			$this->mess('提示: 带<span class="red_font">*</span>的项目为必填信息. ');
			$this->assign("select", D("usergroup")->formselect("gid", 2));
			$this->display();
		}

		function insert(){
			$user=D("hyuser");
			$_POST["srcpwd"]=$_POST["userpwd"];
			$_POST['userpwd']=md5($_POST['userpwd']);
			$_POST['repwd']=md5($_POST['repwd']);
			
			if($user->insert($_POST, 1, 1)){
				$this->mess("添加用户 <b>{$_POST["username"]}</b> 成功,可以继续添加！. ", true);
				
				$this->assign("post", array("jz"=>$_POST['jz']));

				if($_POST["jz"]=="1")
					$groupid=$_POST["groupid"];
				else
					$groupid=2;

				$this->assign("select", D("usergroup")->formselect("gid", $groupid));

			}else{
				$this->mess($user->getMsg(), false);
				$this->assign("post", $_POST);
				$this->assign("select", D("usergroup")->formselect("gid", $_POST['groupid']));
			}

			$this->display("add");
		}



		function del(){
	
			$user=D("hyuser");

			if(!empty($_POST)){
				$userid=$_POST["userid"];
				
			}else{
				$userid=$_GET["userid"];
			}
            p("userid",$userid);
            
            p("GET",$_GET);

			if(!empty($_GET["search"]))
				$pget.="/search/{$_GET["search"]}";
				
			if(!empty($_GET["groupid"]))
				$pget.="/groupid/{$_GET["groupid"]}";

			if(!empty($_GET["disable"]))
				$pget.="/disable/{$_GET["disable"]}";
             p("pget",$pget);

/*
			if($user->delete($id)){
				//删除用户的短信息
				D("message")->delete(array("uid"=>$id));
				//删除用户的动态
				$dynamic=D("dynamic");
				$dynamic->delete(array("uid"=>$id));
				$dynamic->delete(array("otype"=>5, "cid"=>$id));
				//删除用户文章
				D("article")->delete(array("uid"=>$id));
				//删除用户的评论
				D("comment")->delete(array("uid"=>$id));
				
				$this->redirect("index", "page/{$_GET['page']}".$pget);
			}else{
				$this->error("删除用户失败!", 3, "user/index/page/{$_GET['page']}".$pget);
			}
 */
			//删除用户所有信息
            if(/**
 * $user->where($userid)->r_delete(
 * 				array("message", 'uid'),
 * 				array("dynamic", 'uid'),
 * 				array("dynamic", 'cid', array("otype"=>5)), 
 * 				array("article", 'uid'), 
 * 				array('comment', 'uid'))
 */D("hyuser")->delete(array("userid"=>$userid))){
				
				$this->redirect("index", "page/{$_GET['page']}".$pget);
			}else{
				$this->error("删除用户失败!", 3, "user/index/page/{$_GET['page']}".$pget);
			}

		}


		function mod(){
			$user=D("hyuser")->field("userid,gid,username,regdate,disable,dept")->find($_GET['userid']);
			$this->mess('提示: 带<span class="red_font">*</span>的项目为必填信息. ');
			$this->assign("select", D("usergroup")->formselect("gid", $user['gid']));
			$this->assign("post", $user);
			$this->display();
		}

		function update(){

			$user=D("hyuser");

	
			if(!isset($_POST["disable"]))
				$_POST['disable']=0;
			if($_POST["userpwd"]=="") {
				unset($_POST["userpwd"]);
			}else {
				$_POST['userpwd']=md5($_POST['userpwd']);
				$_POST['repwd']=md5($_POST['repwd']);
			}
			$affectedrow=$user->update($_POST, 1, 1);
			
			if($affectedrow){
				$this->redirect('index');
			}else{
				if($affectedrow===0)
					$mess="用户记录没有被改变！";
				else
					$mess=$user->getMsg();
				$this->mess($mess, false);
				$this->assign("post", $_POST);
				$this->assign("select", D("usergroup")->formselect("gid", $_POST['gid']));
				$this->display("mod");
			}

		
		}


	}
