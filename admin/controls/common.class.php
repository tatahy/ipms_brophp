<?php
	class Common extends Action {
		function init(){   //验证登录账号对后台各个模块的操作权限, $_GET["m"]获得当前访问的模块名称。$_GET["a"]获得当前操作的名称。
			if(!file_exists("./runtime/install.lock")){
				header("Location:./install/index.php");
			}
			if(!(isset($_SESSION["isLogin"]) && $_SESSION["isLogin"]===1)){
				$this->redirect("login/index");
			}
			
			$useradmin=array('base');
			if(in_array($_GET["m"], $useradmin) && $_SESSION["useradmin"]!=1){
				$this->error("权限不足，你不是网络编辑不能操作这个模块", 3, "index/index");
			}

			$authorityret=array('article', 'play');
			if(in_array($_GET["m"], $authorityret) && $_SESSION["authorityret"]!=1){
				$this->error("权限不足，你不能对专利进行操作", 3, "index/index");
			}
			$useradmin=array('user', 'usergroup');
			if(in_array($_GET["m"], $useradmin) && $_SESSION["useradmin"]!=1){
				$this->error("权限不足，你不能对用户及用户组进行管理", 3, "index/index");
			}
		}

		function mess($mess="ok", $is=null){
			$message="";
			if(is_array($mess)){
				foreach($mess as $m){
					$message.=$m;
				}	
			}else{
				$message=$mess;
			}

			if(is_null($is)){
				$this->assign("mess", "");
			}else if($is){
				$this->assign("mess", "ok");
			}else{
				$this->assign("mess", "error");
			}
			$this->assign("tmess", $message);
		}
        
		function upimage(){
			$path=PROJECT_PATH.'public/uploads';
			
			global $pictureSize;
			$up=new FileUpload($path.'/tmp');
			
			$up->set("allowtype", array("gif", "png", "jpg", "jpeg"))
			   ->set("thumb", array("width"=>$pictureSize["maxWidth"], "height"=>$pictureSize["maxHeight"]))
			   ->set("watermark", array("water"=>$path.'/'.WATER, "position"=>POSITION));

			if($up->upload("upload")){
				$filename=$up->getFileName();
				$_SESSION["article"][]=$filename;
				$this->mkhtml(B_PUBLIC."/uploads/tmp/".$filename);
			}else{
				$mess=strip_tags($up->getErrorMsg());	
				$this->mkhtml('', $mess);
			}
		}

		function upflash(){
			$up=new FileUpload(PROJECT_PATH.'public/uploads/tmp');
			$up->set("allowtype", array("flv","swf"));
			if($up->upload("upload")){
				$filename=$up->getFileName();
				$_SESSION["article"][]=$filename;
				$this->mkhtml(B_PUBLIC."/uploads/tmp/".$filename);
			}else{
				$mess=strip_tags($up->getErrorMsg());	
				$this->mkhtml('', $mess);
			}
		}


		protected function mkhtml($fileurl,$message="") {
			$str='<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$_GET['CKEditorFuncNum'].', \''.$fileurl.'\', \''.$message.'\');</script>';
			exit($str);
		}

	}
