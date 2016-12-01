<?php
	class Patent {
        
        function index(){
            
            //p("GET",$_GET);
            //p("SESSION",$_SESSION);
            if (!empty($_POST)){
                $uid=$_POST['uid'];
            }else{
                $uid=$_GET['uid'];
            }
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
                      
            //从patent表查出记录数,登录账号是“超级管理员”/"批准人"/"维护人"是全部patent，其他的仅仅选择所处部门的patent
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $c=D("patent")->field('pat_id')->total();
                
            }else{
                $c=D("patent")->field('pat_id,dept')->where(array("dept"=>$dept))->total();
            }
            
            /**
                 设置分页类的属性，共4个参数。第一个为总记录数，第二个为每页需要显示的记录数默认为“25”，
                 第三个为向下一个页面传递的参数，第四个默认为“true”，表示从第一页开始显示
            */             
			//$page_pat=new Page($c,20,$GLOBALS["app"]."patent/index/str/".$str_t);
            $page_pat=new Page($c,20,"patent/index/str/".$str_t);
            
            //从patent表查出记录并由limit设置分页数量,“超级管理员”/"批准人"/"维护人"是全部patent，其他的仅仅是所处部门的patent
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $sets_pat=D("patent")->field('pat_id,uid,pattype,pattopic,status,writer,dept,adddate')
  				    ->limit($page_pat->limit)
                    ->order($str_t." desc")
                    ->select(); 
                //得到status的所有分类
                //$sets_status=D("patent")->field('status')
//  				    ->group('status')
//                    ->select(); 
                
                //p("uid",$uid);
                
            }else{
                $sets_pat=D("patent")->field('pat_id,uid,pattype,pattopic,status,writer,dept,adddate')
  				    ->limit($page_pat->limit)//
                    ->where(array("dept"=> $dept))
                    ->order($str_t." desc")
                    ->select(); 
                 //得到status的所有分类,结果是一个二维数组   
                 //$sets_status=D("patent")->field('status')
//  				    ->group('status')
//                    ->select();
                
                //p("uid",$uid);    
                    
            }
            
            //添加登录用户的权限信息到专利记录集中的每条记录，为在“index.tpl”中显示可对每个专利记录进行的操作提供判定信息
            for($i=0;$i<count($sets_pat);$i++){
                $sets_pat[$i]=array_merge_recursive($sets_pat[$i], $authority);   
            } 
            
            $page_pat->set("head", "个专利");
            //$this->assign("usergroup",$usergroup);
			$this->assign("sets_pat",$sets_pat);
			$this->assign("fpage_pat", $page_pat->fpage(0,3,2,4,7,6));//
            $this->assign("page", $page_pat);
            $this->assign("uid", $uid);
            $this->assign("writer", $writer);
            $this->assign("sets_status", $sets_status);
            
            //输出brophp.php中定义的status全局数组中'mod'项的值
            //p("STATUS",$GLOBALS["status"]['mod']);
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            $this->assign("flush", true);
            
            $this->display();
          
		}
        
        //检索出登录角色可操作的各个状态下的专利
        function my_index(){
            
            //p("GET",$_GET);
            //p("SESSION",$_SESSION);
            
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
                        $field_str="pat_id,uid,pattype,pattopic,status,writer,dept,adddate";
                        $where_str="status='提交' AND dept='$dept'"; 
                    
                    break;
                    
                    case "批准人" ://批准人
                        $field_str="pat_id,uid,pattype,pattopic,status,writer,dept,adddate";
                        $where_str="status='审核'";
                    
                    break;
                    
                    case "撰写人" ://撰写人
                        $field_str="pat_id,uid,pattype,pattopic,status,writer,dept,adddate";
                        $where_str="dept='$dept' AND uid='$uid' AND status='修改' OR dept='$dept' AND uid='$uid' AND status='退回' OR dept='$dept' AND uid='$uid' AND status='填报'"; 
                    
                    break;
                    
                    case "维护人" ://维护人
                        $field_str="pat_id,uid,pattype,pattopic,status,writer,dept,adddate";
                        $where_str="status='批准' OR status='申报' OR status='授权' OR status='放弃' OR status='驳回' OR status='维护'";
                    
                    break;
            
                default://
                    break; 
                }
                
                $c=D("patent")->field($field_str)->where($where_str)->total();
                
                /**
                 设置分页类的属性，共4个参数。第一个为总记录数，第二个为每页需要显示的记录数默认为“25”，
                 第三个为向下一个页面传递的参数，第四个默认为“true”，表示从第一页开始显示
                */             
    			$page_pat=new Page($c,20,"patent/my_index/str/".$str_t);
                
                $sets_pat=D("patent")->field($field_str)
                    ->where($where_str)
  				    ->limit($page_pat->limit)
                    ->order($str_t." desc")
                    ->select(); 
            
            //p("field_str",$field_str);
            //p("where_str",$where_str);
            
            //添加登录用户的权限信息到专利记录集中的每条记录，为在“index.tpl”中显示可对每个专利记录进行的操作提供判定信息
            for($i=0;$i<count($sets_pat);$i++){
                $sets_pat[$i]=array_merge_recursive($sets_pat[$i], $authority);   
            } 
            
            $page_pat->set("head", "个专利");
            //$this->assign("usergroup",$usergroup);
			$this->assign("sets_pat",$sets_pat);
			$this->assign("fpage_pat", $page_pat->fpage(0,3,2,4,7,6));//
            $this->assign("page", $page_pat);
            $this->assign("uid", $uid);
            $this->assign("writer", $writer);
            $this->assign("sets_status", $sets_status);
            
            //输出brophp.php中定义的status全局数组中'mod'项的值
            //p("STATUS",$GLOBALS["status"]['mod']);
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            $this->assign("flush", true);
            
            $this->display();
		}
        
        //
        function hynew(){
//            $writer=$_GET['writer'];
//            $uid= $_GET['uid'];
//            $this->assign("writer",$writer );
//            $this->assign("uid",$uid);
//            p("GET",$_GET);

            //p("POST",$_POST);
            //进行add操作的时间就是当天
            $patent=D("patent");
            $_POST["status"] = "新增";
            $_POST["adddate"] = date("Y-m-d");
            $_POST["writer"] = $_SESSION['username'];
            $_POST["uid"] = $_SESSION['userid'];
            $_POST["dept"] = $_SESSION['dept'];
            $patent=$_POST;
            
            //p("patent",$patent); 
                      
            $this->assign("patent", $patent);
            $this->display();
		
        }
        
        //新增
		function add(){
//            $writer=$_GET['writer'];
//            $uid= $_GET['uid'];
//            $this->assign("writer",$writer );
//            $this->assign("uid",$uid);
//            p("GET",$_GET);
            
            $this->assign("patent", $_POST);
            $this->display();
		
        }
        
        //添加
		function insert(){
            $_POST['status']="填报"; 
            $patent=D("patent");
            $num=$patent->insert($_POST, 1, 1);
                 
            	if($num){
    				//弹出窗体显示添加成功后的信息
                    //$this->success("新增专利： <b>{$_POST["pattopic"]}</b> 成功,可以继续添加！ ", 2,"patent/add");
                    
                    $str="新增专利：<b>{$_POST["pattopic"]}</b> 成功,若有附件请继续上传。";
                    //以绿色字体显示添加成功后的信息
                    $str="<font color=\"green\">".$str."</font>";
                    
                    //新增记录，记入process表中，利用model层中定义的process类的add方法
                    $_SESSION['oprreason']="填报";
                    $_SESSION['oprobjid']=$num;
                    $process = D("process");
                    $process->add(); 
                    
                    $_POST=$patent->field()->where(array("pat_id"=>$num))->find();
                    //添加成功后清除$_POST数组内的内容，便于添加下一个新的patent内容。
//                    $_POST=array();
//                    $_POST['writer']=$_SESSION['username'];
//                    $_POST['uid']=$_SESSION['userid'];
//                    $_POST['status']="新增";
                    
    			}else{
    				//接收经patent.xml校验后的信息
                    $str=$patent->getMsg();
                    
                    //以红色字体显示添加失败后的信息
                    $str="<font color=\"red\">".$str."</font>";
                    $_POST["status"] = "新增";
                    $_POST["adddate"] = date("Y-m-d");
                    $_POST["writer"] = $_SESSION['username'];
                    $_POST["uid"] = $_SESSION['userid'];
                    
                    
                    //弹出窗体显示添加失败后的信息
                    //$this->error($str, 5,"patent/add");
                    
    			}
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            $this->assign("flush", true);
            
            //通过$str变量传递到模板文件add.tpl显示进行添加操作后的信息
            $this->assign("str", $str);
            
            $this->assign("patent", $_POST);
                        
			$this->display("hynew");
        }
        
        //修改
        function mod(){
            $patent=D("patent");
            
            //根据index.tpl中选中专利的pat_id值查出选中专利的所有信息
            $patent=D("patent")->field()->find($_GET['pat_id']);
            
            //if($patent->update())
			//$this->assign("flush", true);
            
            //p("mod--patent",$patent['status']);
            
            //原来的状态
            $org_status=$patent['status'];
            
            $this->assign("org_status", $org_status);
            $this->assign("patent", $patent);
            
            $this->display();
        }
        
        //更新
        function update(){         
            //p("update--POST",$_POST);
            
            $patent=D("patent");
            
            $affectedrow=$patent->update($_POST, 1, 1);
            
            if($affectedrow){
                //弹出窗体显示修改成功后的信息,跳转到index页面
                //$str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                //$str="专利".$str."修改成功！";
                //$this->success($str, 1,"patent/index/uid/{$_POST['uid']}");
                
                //使用_SESSION全局变量向process表的操作传递内容。
                $_SESSION['oprobjid']=$_POST['pat_id'];
                $_SESSION['oprreason']=$_POST['opr_symbol'];
                $_SESSION['oprobjtype']="patent";
                $_SESSION['note']=$_POST['note'];
                
                //$flush=true，在temp.tpl中起到刷新menu页面的作用
                $this->assign("flush", true);
                                
                //根据$_POST['opr_symbol']选择相应的显示页面
                $opr_symbol=$_POST['opr_symbol'];                
                switch($opr_symbol){                   
                    case "完成" ://状态为“新增（new）”，可进行“新增（hynew）”，“提交（sub）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                        $str="专利".$str."填报成功！";
                        //$s="add";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();                                                
                        break;
                    case "填报" ://状态为“填报（add）”，可进行“修改（mod）”，“删除（del）”,“提交（sub）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                        $str="专利".$str."修改成功！";
                        //$s="add";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;
                    case "修改" ://状态为“修改（mod）”，可进行“修改（mod）”,“提交（sub）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                        $str="专利".$str."修改成功！";
                        //$s="mod";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;
                    case "提交" ://状态为“提交（sub）”，可进行“审核（aud）”，“退回（ret）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                        $str="专利".$str."提交成功！待部门【审核人】审核。";
                        //$s="sub";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();     
                        break;  
                    case "审核同意" ://状态为“审核（aud）”，可进行“批准（app）”,“退回（ret）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                        $str="专利".$str."部门审核通过！待院内【批准人】批准";
                        //$s="aud";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  ;   
                        break;
                    case "批准同意" ://状态为“审核（aud）”，可进行“批准（app）”,“退回（ret）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                        $str="专利".$str."已获院内批准！";
                        //$s="app";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;    
                    case "退回" ://状态为“退回（ret）”，可进行“修改（mod）”，“提交（sub）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                        $str="专利".$str."退回【撰写人】: ".$_POST['writer']."修改";
                        //$s="ret";
                        
                        //状态改变，记入process表中状态改变信息，利用model层中定义的process类的add方法
                        $process = D("process");
                        $process->add();  
                        break;
                    case "更新" ://状态为批准、申报、授权、放弃、驳回、维护，由维护人进行“维护（maintain）”操作
                        $str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                        $str="专利更新维护完成。";
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
                    //$str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                    //$str="专利".$str."未被修改！";
                    //$this->error($str, 3,"patent/mod/pat_id/{$_POST['pat_id']}");
                    
                    $str="<font color=\"red\">"."专利信息未发生变化！"."</font>";
                   
    			}else{
                    //弹出窗体显示接收经patent.xml校验后的信息，并以红色字体显示，跳转到index页面
                    //$str="<font color=\"blue\">"."<h4>{$_POST['pattopic']}</h4>"."</font>";
                    //$str="专利".$str."修改时出现以下错误：<br/>";
                    //$str1=$patent->getMsg();
                    //$str1="<font color=\"red\">".$str1."</font>";
                    //$str=$str.$str1;
                    //$this->error($str, 5,"patent/mod/pat_id/{$_POST['pat_id']}");
                    
                    $str=$patent->getMsg();
                    $str="<font color=\"red\">".$str."</font>";
                    
                    }
    			}
                
            //通过$str变量传递到模板文件显示进行操作后的信息
            $this->assign("str", $str);
            $this->assign("patent", $_POST);
            $patent=$_POST;
            
             //根据patent.status选择相应的显示页面，与$this->display($s);语句配合使用
/**
 *             switch($patent['status']){
 *                 case "新增" ://状态为“新增（new）”，可进行“新增（hynew）”，“提交（sub）”操作
 *                     $s="hynew";
 *                     break;
 *                 case "填报" ://状态为“填报（add）”，可进行“修改（mod）”，“删除（del）”,“提交（sub）”操作
 *                     $s="add";
 *                     break;
 *                 case "修改" ://状态为“修改（mod）”，可进行“修改（mod）”,“提交（sub）”操作
 *                     $s="mod";
 *                     break;
 *                 case "提交" ://状态为“提交（sub）”，可进行“审核（aud）”，“退回（ret）”操作
 *                     $s="sub";
 *                     break;  
 *                 case "审核" ://状态为“审核（aud）”，可进行“批准（app）”,“退回（ret）”操作
 *                     $s="aud";
 *                     break;
 *                 case "批准" ://状态为“审核（aud）”，可进行“批准（app）”,“退回（ret）”操作
 *                     $s="app";
 *                     break;
 *                 case "退回" ://状态为“退回（ret）”，可进行“修改（mod）”，“提交（sub）”操作
 *                     $s="ret";
 *                     break;
 *                 default://状态为“批准（app）”，无需操作
 *                 
 *                     break;
 *             }
 *             $this->display($s);
 */  
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            $this->assign("flush", true);
            $this->assign("org_status", $_POST['status']);
            
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
            //p("_POST",$_POST);
            //接收要上传附件的专利编号
            if (!empty($_GET['pat_id'])){
                    $pat_id =$_GET['pat_id'];
                }else $pat_id =$_POST['pat_id'];
            
            $patent=D("patent");
            
            if(isset($_POST["sub"])){
                
                $pat_id = $_POST['pat_id'];
               
               //判断上传文件的目录是否存在，不存在就创建
                $dirname=PROJECT_PATH.'file/patent/'.$pat_id.'/'.$gid;
                if($dir_handle=@opendir($dirname)){
                    //p("dir_handle",$dir_handle);
                    closedir($dir_handle);
                    $file_dir=PROJECT_PATH.'file/patent/'.$pat_id.'/'.$gid;
                }else{
                    $file_dir1=PROJECT_PATH.'file/patent/'.$pat_id;
                    mkdir($file_dir1);
                
                    $file_dir=$file_dir1.'/'.$gid;
                    mkdir($file_dir);
                    
                }
                
               // if($dir_handle=@opendir($file_dir)){
//                    
//                }else{
//                    mkdir($file_dir1);
//                    mkdir($file_dir);
//                    
//                }
                      
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
                    $_POST["pat_id"]=$pat_id;
                    
                    
                    //附件上传成功后将附件有关信息写入attachment表
                    $attachment=D("attachment");
                    $attachment->add($file_name,$att_name_display,"patent",$pat_id);
                    
                    if($patent->update()){
						
                        //上传成功后提示
                        $this->assign("message", "附件上传成功！");
						
					}
                }else{
                    //如果上传多个文件，下面方法返回是数组，是多条出错信息。单文件上传出错则直接返回一条错误报告
                    //print_r($up->getErrorMsg());
                    
                    //$this->error($up->getErrorMsg(),5,"patent/patlist/cstatus/$cstatus");
                    $this->assign("message", $up->getErrorMsg());
                    }
            }
            
            //p("patent",$patent);
            $this->assign("gid", $gid);
            $this->assign("groupname", $groupname);
            $this->assign("pat_id", $pat_id);
            $this->assign("patent", $patent->field("pat_id,pattopic,status,attachment")->find($pat_id));
                        
            $this->display();
        }
        
        //删除模板
        function del_temp(){
            //p("sub--POST",$_POST);
            $patent=D("patent")->field()->find($_GET['pat_id']);
           
            $patent['status']= "删除";
            
            $this->assign("patent", $patent);
            
            $this->display();
 
        }
        
        //删除
        function del(){

            $pat_id = $_GET['pat_id'] ;
              
            $patent = D("patent");
             
            $data = $patent -> where($pat_id)
                            -> r_delete(
                               array('process','oprobjid',array('oprobjtype'=>'patent'))
                            );
            
            //$flush=true，在temp.tpl中起到刷新menu页面的作用
            $this->assign("flush", true);
            
            $this->redirect("my_index");
 
        }
        
        //提交
        function sub(){
            
            //进行sub操作的时间就是当天
//            $_POST["submitdate"] = date("Y-m-d");            
//            $this->assign("patent", $_POST);
            
            //p("sub--POST",$_POST);
            
            //根据index.tpl中选中专利的pat_id值查出选中专利的所有信息
            $patent=D("patent")->field()->find($_GET['pat_id']);
            //$this->success("确定提交专利:"."{$patent['pattopic']}",3,"patent/sub");
            $patent['submitdate']=date("Y-m-d");
            //原来的状态
            $org_status=$patent['status'];
            
            //拟更改后的状态
            $patent['status']= "提交";
            
            $this->assign("org_status", $org_status);
            $this->assign("patent", $patent);
            
            $this->display();
        }
        
        //审核
        function aud(){
            //根据index.tpl中选中专利的pat_id值查出选中专利的所有信息
            $patent=D("patent")->field()->find($_GET['pat_id']);
            $patent['auditdate']=date("Y-m-d");
            //原来的状态
            $org_status=$patent['status'];

            if($_SESSION['groupname']=="审核人"){
                $patent['status']="审核";
            }else {
                $this->error("没有【审核】的操作权限,审核人才可进行此操作！",1,"patent/index");
                
            }
            
            $this->assign("org_status", $org_status);
            $this->assign("patent", $patent);
            
            $this->display();		
        }
        
        //批准
        function app(){
            $patent=D("patent")->field()->find($_GET['pat_id']);
            $patent['approvedate']=date("Y-m-d");
             //原来的状态
            $org_status=$patent['status'];
            
            if($_SESSION['groupname']=="批准人"){
                $patent['status']="批准";
            }else {
                $this->error("没有【批准】的操作权限，批准人才可进行此操作！",1,"patent/index");
                
            }
            $this->assign("org_status", $org_status);
            $this->assign("patent", $patent);
            
            $this->display();			
        }
        
        //退回
        function ret(){
             //p("ret--SESSION",$_SESSION);
            
            $patent=D("patent")->field()->find($_GET['pat_id']);
            $patent['mod_retdate']=date("Y-m-d");
            //原来的状态
            $org_status=$patent['status'];
            
            if($_SESSION['groupname']=="审核人"){
                $patent['status']="修改";
            }elseif($_SESSION['groupname']=="批准人"){
                $patent['status']="退回";
            }else {
                $this->error("没有【退回】的操作权限",1,"patent/index");
                
            }
            $this->assign("org_status", $org_status);
            $this->assign("patent", $patent);
            
            $this->display();		
        }
        
        //登录角色可看各状态专利的列表
        function patlist(){
            //p("GET",$_GET);
            //p("POST",$_POST);
      
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
                
            //从patent表查出记录,登录账号是admin/批准人/维护人是全部patent，其他的仅仅选择所处部门的patent
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $c=D("patent")->field('pat_id')->where(array('status'=>$cstatus))->total();
                
            }else{
                $c=D("patent")->field('pat_id,dept')->where(array('status'=>$cstatus,"dept"=>$dept))->total();
            }
            
            //通过分页类Page设置分页的表现形式,$str的内容是通过$GET数组保留的每一页查询显示所需的关键信息。
            $str="cstatus/".$cstatus;                
			$page_pat=new Page($c,10,$str);
            
            //各个状态专利需要显示对应的状态时间。
            $field_str="pat_id,uid,pattype,pattopic,status,writer,dept";
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
                    
                    case "申报" :
                        $field_str=$field_str.",apply_abandondate as 'date'";
                        
                    break;
                    
                    case "放弃" :
                        $field_str=$field_str.",apply_abandondate as 'date'";

                    break;
                    
                    case "驳回" :
                        $field_str=$field_str.",lic_rejdate as 'date'";
 
                    break;
                    
                    case "授权" :
                        $field_str=$field_str.",lic_rejdate as 'date'";
           
                    break;
                    
                    case "维护" :
                        $field_str=$field_str.",renewdate as 'date'";
           
                    break;                                        
            
                default:
                    $field_str=$field_str.",adddate as 'date'";
                      
                    break;
                }
            
            //从patent表查出记录并由limit设置分页数量,admin/批准人/维护人是全部patent，其他的仅仅是所处部门的patent
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $sets_pat=D("patent")->field($field_str)
  				    ->limit($page_pat->limit)
                    ->where(array("status"=>$cstatus))
                    ->order("date desc")
                    ->select(); 
                
            }else{
                $sets_pat=D("patent")->field($field_str)
  				    ->limit($page_pat->limit)//
                    ->where(array("status"=>$cstatus,"dept"=>$dept))
                    ->order("date desc","writer asc")
                    ->select(); 
               
            }
            
            //添加登录用户的权限信息到专利记录集中的每条记录，为在“index.tpl”中显示可对每个专利记录进行的操作提供判定信息
            for($i=0;$i<count($sets_pat);$i++){
                $sets_pat[$i]=array_merge_recursive($sets_pat[$i], $authority);   
            }
            
            //P("sets_pat",$sets_pat);
			
            $page_pat->set("head", "个专利");
            //$this->assign("usergroup",$usergroup);
			$this->assign("sets_pat",$sets_pat);
			$this->assign("fpage_pat", $page_pat->fpage(0,3,2,4,7,6));//
            $this->assign("page", $page_pat);
            $this->assign("uid", $uid);
            $this->assign("writer", $writer);
            $this->assign("cstatus",$cstatus);
            
            $this->display();      
        }
        
        //登录角色可操作各状态专利的列表
        function my_patlist(){
            //p("GET",$_GET);
            //p("POST",$_POST);
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
                
            //从patent表查出记录,登录账号是admin/批准人/维护人是全部patent，其他的仅仅选择所处部门的patent
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $c=D("patent")->field('pat_id')->where(array('status'=>$cstatus))->total();
                
            }elseif($groupname == "审核人" ){
                $c=D("patent")->field('pat_id,dept')->where(array('status'=>$cstatus,"dept"=>$dept))->total();
            }else{//$groupname == "撰写人"
                $c=D("patent")->field('pat_id,uid,dept')->where(array('status'=>$cstatus,"dept"=>$dept,"uid"=>$uid))->total();
            }
            
            //通过分页类Page设置分页的表现形式,$str的内容是通过$GET数组保留的每一页查询显示所需的关键信息。
            $str="cstatus/".$cstatus;                
			$page_pat=new Page($c,10,$str);

            $field_str="pat_id,uid,pattype,pattopic,status,writer,dept";
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
                    
                    case "申报" :
                        $field_str=$field_str.",apply_abandondate as 'date'";
                        
                    break;
                    
                    case "放弃" :
                        $field_str=$field_str.",apply_abandondate as 'date'";

                    break;
                    
                    case "驳回" :
                        $field_str=$field_str.",lic_rejdate as 'date'";
 
                    break;
                    
                    case "授权" :
                        $field_str=$field_str.",lic_rejdate as 'date'";
           
                    break;
                    
                    case "维护" :
                        $field_str=$field_str.",renewdate as 'date'";
           
                    break;                                        
            
                default:
                    $field_str=$field_str.",adddate as 'date'";
                      
                    break;
                }
            
            //从patent表查出记录并由limit设置分页数量,admin/批准人/维护人是全部patent，其他的仅仅是所处部门的patent
            if($groupname == "超级管理员" || $groupname == "批准人" || $groupname == "维护人"){
                $sets_pat=D("patent")->field($field_str)
  				    ->limit($page_pat->limit)
                    ->where(array("status"=>$cstatus))
                    ->order("date desc")
                    ->select(); 
                
            }elseif($groupname == "审核人" ){//$groupname == "审核人",本部门的专利
                $sets_pat=D("patent")->field($field_str)
  				    ->limit($page_pat->limit)//
                    ->where(array("status"=>$cstatus,"dept"=>$dept))
                    ->order( "date desc","writer asc")
                    ->select(); 
               
            }else{//$groupname == "撰写人",本部门自己撰写的专利
                $sets_pat=D("patent")->field($field_str)
  				    ->limit($page_pat->limit)//
                    ->where(array("status"=>$cstatus,"dept"=>$dept,"uid"=>$uid))
                    ->order("date desc")
                    ->select(); 
            }
            
            //添加登录用户的权限信息到专利记录集中的每条记录，为在“index.tpl”中显示可对每个专利记录进行的操作提供判定信息
            for($i=0;$i<count($sets_pat);$i++){
                $sets_pat[$i]=array_merge_recursive($sets_pat[$i], $authority);   
            }
            
            //P("sets_pat",$sets_pat);
			
            $page_pat->set("head", "个专利");
            //$this->assign("usergroup",$usergroup);
			$this->assign("sets_pat",$sets_pat);
			$this->assign("fpage_pat", $page_pat->fpage(0,3,2,4,7,6));//
            $this->assign("page", $page_pat);
            $this->assign("uid", $uid);
            $this->assign("writer", $writer);
            $this->assign("cstatus",$cstatus);

            $this->display();      
        }        
        
        //定义对单个patent记录的sub、aud、app、ret操作的显示页面所需的一些变量和开关
        function operate_status(){
            //根据operate_status.tpl中选中的pat_id值查出需要修改的专利
            $groupname=$_SESSION['groupname'];
            
            $patent=D("patent")->find($_GET['pat_id']);
            //p("patent",$patent);
            //p("GET",$_GET);
            //p("SESSION['gid']",$_SESSION['gid']);
            //p("SESSION['uid']",$_SESSION['userid']);
            //p("patent['uid']",$patent['uid']);
            //由开关控制operate_status.tpl中是否显示“附件下载”,登录账号为admin/批准人/审核人/维护人都显示,撰写人登录时与专利的撰写人为同一人也显示
            if($groupname == "审核人" || $groupname=="批准人" || $groupname=="超级管理员" || $groupname=="维护人"){
                $view=1;
            }elseif($groupname=="撰写人" && $_SESSION['userid']==$patent['uid']){
                $view=1;
            }else{
                $view=0;
            };
            
            
            
            $org_status=$patent['status'];
            
            $this->assign("org_status", $org_status);
            
            $this->assign("uid", $_GET['uid']);
            $this->assign("operate", $_GET['operate']);
            $this->assign("pat_uid", $patent['uid']);
            $this->assign("patent", $patent);
            $this->assign("view", $view);
            
            $this->display();
            }
            
        //维护,$_SESSION['groupname']="维护人"
        function maintain(){

            $groupname=$_SESSION['groupname'];
             //根据index.tpl中选中专利的pat_id值查出选中专利的所有信息
            $patent=D("patent")->field()->find($_GET['pat_id']);
            
            //查找之前所做更新记录
            $process=D("process")->field('groupname,username,oprdate,oprreason,note')
                            //>where(array("oprobjid"=>$_GET['pat_id']))
                            ->where(array("groupname"=>$groupname,"oprobjtype"=>"patent","oprobjid"=>$_GET['pat_id']))
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
            $org_status=$patent['status'];

            if($groupname=="维护人"){
                //$patent['status']="审核";
                switch($org_status){
                    case "批准":
                        $patent['status']="申报";
                        $patent['apply_abandondate']=date("Y-m-d");
                    break;
                    
                    case "申报":
                        $patent['apply_abandondate']=date("Y-m-d");
                    break;
                    
                    case "授权":
                        $patent['lic_rejdate']=date("Y-m-d");
                    break;
                    
                    case "放弃":
                        $patent['apply_abandondate']=date("Y-m-d");
                    break;
                    
                    case "驳回":
                        $patent['lic_rejdate']=date("Y-m-d");
                    break;
                    
                    case "维护":
                        $patent['renewdate']=date("Y-m-d");
                    break;
                    
                    
                    default:
                    break;
                }
                
            }else {
                $this->error("没有【维护】的操作权限,维护人才可进行此操作！",1,"patent/index");
                
            }
            
            $this->assign("org_status", $org_status);
            $this->assign("patent", $patent);
            $this->assign("mt_record",$mt_record);
            
            $this->display();
            			
        }

    }
    