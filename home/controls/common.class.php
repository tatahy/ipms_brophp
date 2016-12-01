<?php
	class Common extends Action {
		function init(){
			if(!file_exists("./runtime/install.lock")){
				header("Location:./install/index.php");
			}
			
			//没登录不能操作
			$bmks=array("hyuser");
			if(in_array($_GET["m"], $bmks) && $_SESSION["login"]!==1 && $_GET["a"] !="gts"){
				$this->error("你还没有登录，请先登录才能完成该操作", 3, "index/index");
			}

			$nocache=array("hyuser","search");

			if(in_array($_GET["m"], $nocache)){
				$this->caching=0;     //设置缓存关闭
			}

		}
        
//       	function mess($mess="ok", $is=null){
//			$message="";
//			if(is_array($mess)){
//				foreach($mess as $m){
//					$message.=$m;
//				}	
//			}else{
//				$message=$mess;
//			}
//
//			if(is_null($is)){
//				$this->assign("mess", "");
//			}else if($is){
//				$this->assign("mess", "ok");
//			}else{
//				$this->assign("mess", "error");
//			}
//			$this->assign("tmess", $message);
//		}
        		
	}
