<?php
	class attachment {
        function index(){
            //GET方法接受“operate_status.tpl”处传来的4个参数，id/<{ $patent.pat_id }>，topic/<{ $patent.pattopic }>，kind/?，operate/?
            //"operate"为1表示是在my_XXXlist列表中选中的项目，要显示“操作”列的信息，否则表示在XXXlist列表中选中的项目，不显示“操作”列的信息，
            
            //p("GET",$_GET);
            //p("SESSION",$_SESSION);    
            $kind=$_GET['kind'];
            $id=$_GET['id'];
            $operate=$_GET['operate'];
            $topic=$_GET['topic'];
            
            //p("kind",$kind);

            switch($kind){
                case "patent" :
                    $obj_kind="专利";
                    
                    //从attachment表查出obj_id=pat_id的所有记录
                    $sets_pro=D("attachment")->field('att_id,gid,att_name,att_name_display,username,role,upload_date,obj_type,obj_id')
          				    ->where(array("obj_id" => $id,"obj_type"=>$kind))
                            ->order("upload_date")
                            ->select(); 
                    
                    $sets_pat=D("patent")->field('pat_id,status')
          				    ->where(array("pat_id" => $id))
                            ->find(); 
                    $id=$sets_pat['pat_id'];        
                    $status=$sets_pat['status'];

                    break;
                case "thesis" :
                    $obj_kind="论文";
                    
                    //从attachment表查出obj_id=the_id的所有记录
                    $sets_pro=D("attachment")->field('att_id,gid,att_name,att_name_display,username,role,upload_date,obj_type,obj_id')
          				    ->where(array("obj_id" => $id,"obj_type"=>$kind))
                            ->order("upload_date")
                            ->select(); 
                    
                    $sets_the=D("thesis")->field('the_id,status')
          				    ->where(array("the_id" => $id))
                            ->find(); 
                    $id=$sets_the['the_id'];        
                    $status=$sets_the['status'];                    
                    
                    break;
                case "award" :
                    $obj_kind="奖项";
                    break;
                case "achievement" :
                    $obj_kind="成果";
                    break;
                default:
                    break;
            }          
          
            $file_dir=PROJECT_PATH."file/".$kind."/".$id."/";          
          
            $this->assign("sets_pro", $sets_pro);
            //$this->assign("id", $pat_id);
            $this->assign("status", $status);
            $this->assign("topic", $topic);
            $this->assign("obj_kind", $obj_kind);
            $this->assign("kind", $kind);
            $this->assign("operate", $operate);
            $this->assign("file_dir", $file_dir);
            
            $this->display();
          
		}
        //删除index.tpl页面中选中的文件
        function del_file(){
            //p("POST",$_POST);
            
            $att_id=$_POST['att_id'];               //文件对应attachment表中的att_id
            $topic=$_POST['topic'];                                //文件对应attachment表中topic 
            $kind=$_POST['kind'];                   //文件对应attachment表中的type
            $obj_id= $_POST['obj_id'];
            $operate= $_POST['operate'];                                
            
            $file_dir=$_POST['file_dir'];           //文件存放目录
            $file_name=$_POST['file_name'];             //文件名
            
            //删除attachment表中的记录
            D("attachment")->delete($att_id);
            
            //删除文件，成功后返回删除按钮界面
            if(file_exists($file_dir.$file_name)){
                unlink($file_dir.$file_name);
                $this->success("删除文件".$file_name."成功。",2,"attachment/index/id/".$obj_id."/topic/".$topic."/kind/".$kind."/operate/".$operate);	
            }else{
                exit();
            }
            
            //刷新index.tpl页面
            $this->assign("flush", true);
           
        }
        
        //下载文件，不是弹出框选择本地文件夹的下载，而是直接在浏览器中输出文件内容。不用。hy,2016/8/29
        function downfile(){
            if($_GET['att_id']){
                $att_id=$_GET['att_id'];
            }else{
                $att_id=$_POST['att_id'];
            }
            //p("GET",$_GET);
            //p("_POST",$_POST);
            $attachment=D("attachment")->field('att_id,att_name,obj_type,obj_id,gid')
  				    ->where(array("att_id" => $att_id))
                    ->find(); 
            //p("attachment",$attachment);
            $file_dir=PROJECT_PATH.'file/'.$attachment['obj_type'].'/'.$attachment['obj_id'].'/'.$attachment['gid'].'/';   //下载文件存放目录
            $file_name=$attachment['att_name'];             //下载文件名
            //p("file_info",$file_dir.$file_name);
            //检查文件是否存在
            if(!file_exists($file_dir.$file_name)){
                echo "文件不存在。";
                exit();    
            }else{
                //以只读模式打开文件
                $file=fopen($file_dir.$file_name,"r")or die("文件打开失败。");
                ob_end_clean();                 //清除缓冲区内容，将缓冲区关闭，但不输出内容。
                header("Content-Type:application/octet-stream");
                header("Content-Disposition:attachment;filename=".$file_name);
                header("Pragma:no-cache");      //不缓存页面
                //header("Content-Type:application/octet-stream");
                
                ob_clean();
                flush();
                readfile($file_dir.$file_name);
                exit();
            }
        }
    }
    