<?php
	class Search {
		
        //首页中的搜索，10个参数
        function index(){
            if(!$this->isCached()) {
                
                //登录系统的用户才能进行搜索操作。
                if(!$_SESSION['login']){
                     $this->error("登录系统后才能进行操作。", 2);
                }
               
                //p("POST",$_POST);
                //p("GET",$_GET);
                if (!empty($_POST)){
                    $kind=$_POST['ser_kind'];
                    $type=$_POST['ser_type'];
                    $status=$_POST['ser_status'];
                    $topic=$_POST['ser_topic'];
                    $dept=$_POST['ser_dept'];
                    $start_date=$_POST['ser_start_date'];
                    $end_date=$_POST['ser_end_date'];
                    
                }else{
                    $kind=$_GET['ser_kind'];
                    $type=$_GET['ser_type'];
                    $status=$_GET['ser_status'];
                    $topic=$_GET['ser_topic'];
                    $dept=$_GET['ser_dept'];
                    $start_date=$_GET['ser_start_date'];
                    $end_date=$_GET['ser_end_date'];
                    
                }
                
                if(empty($kind)){
                    $kind="专利";
                }                 
                
                if(empty($type)){
                    $type="不限";
                }
                
                if(empty($status)){
                    $status="不限";
                }
                
                if(empty($topic)){
                    $topic="不限";
                }
                
                if(empty($dept)){
                    $dept="不限";
                }
                
                if(empty($start_date)){
                    $start_date="0000-00-00";
                }
                
                if(empty($end_date)){
                    $end_date="9999-12-31";
                }
                
                if($start_date>=$end_date){
                    $this->error("开始日期 应小于 结束日期。", 2);
                }
                
                //根据6个搜索条件$kind，得到查询结果
                switch($kind){
                    case "专利" ://专利，10个参数
                        $kind_s="patent";
                        //通过model层patent.class.php中的formselect函数，形成“类型”下拉单选框的html语句，在index.tpl中的<{$select_type}>处显示
                        $this->assign('select_type',D("patent")->formselect('ser_type',$type));
                        
                        //通过model层patent.class.php中的formselect函数，形成“状态”下拉单选框的html语句，在index.tpl中的<{$select_status}>处显示
                        $this->assign('select_status',D("patent")->formselect('ser_status',$status));
                        
                        $this->patent_ser($kind,$kind_s,$type,$status,$topic,$dept,$start_date,$end_date);
                    
                    break;
                    
                    case "论文" ://论文
                        $kind_s="thesis";
                        //通过model层thesis.class.php中的formselect函数，形成“类型”下拉单选框的html语句，在index.tpl中的<{$select_type}>处显示
                        $this->assign('select_type',D("thesis")->formselect('ser_type',$type));
                        
                        //通过model层thesis.class.php中的formselect函数，形成“状态”下拉单选框的html语句，在index.tpl中的<{$select_status}>处显示
                        $this->assign('select_status',D("thesis")->formselect('ser_status',$status));
                        $this->thesis_ser($kind,$kind_s,$type,$status,$topic,$dept,$start_date,$end_date);
                    
                    break;
                    
                    case "成果登记" ://成果登记
                        $kind_s="achievement";
                        $this->achievement_ser($kind,$kind_s,$type,$status,$topic,$dept,$start_date,$end_date);
                    
                    break;
                    
                    case "获奖情况" ://获奖情况
                        $kind_s="award";
                        $this->award_ser($kind,$kind_s,$type,$status,$topic,$dept,$start_date,$end_date);
                    
                    break;
            
                default://
                    break;     
                    
                }  
                 
			}		
        
            
            
			$this->display();
		}
        
        //管理界面中专利的搜索，12个搜索参数
		function index_manage(){
            if(!$this->isCached()) {
                
                //登录系统的用户才能进行搜索操作。
                if(!$_SESSION['login']){
                     $this->error("登录系统后才能进行操作。", 2);
                }
               
                //p("POST",$_POST);
                //p("GET",$_GET);
                
                if (!empty($_POST)){
                    $kind=$_POST['ser_kind'];
                    $type=$_POST['ser_type'];
                    $status=$_POST['ser_status'];
                    $topic=$_POST['ser_topic'];
                    $dept=$_POST['ser_dept'];
                    $authors=$_POST['ser_authors'];
                    $authortype=$_POST['ser_authortype'];
                    $prj_info=$_POST['ser_prj_info'];
                    $prj_infotype=$_POST['ser_prj_infotype'];
                    $start_date=$_POST['ser_start_date'];
                    $end_date=$_POST['ser_end_date'];
                    
                }else{
                    $kind=$_GET['ser_kind'];
                    $type=$_GET['ser_type'];
                    $status=$_GET['ser_status'];
                    $topic=$_GET['ser_topic'];
                    $dept=$_GET['ser_dept'];
                    $authors=$_GET['ser_authors'];
                    $authortype=$_GET['ser_authortype'];
                    $prj_info=$_GET['ser_prj_info'];
                    $prj_infotype=$_GET['ser_prj_infotype'];
                    $start_date=$_GET['ser_start_date'];
                    $end_date=$_GET['ser_end_date'];
                    
                }
                                
                if(empty($kind)){
                    $kind="专利";
                }                 
                
                if(empty($type)){
                    $type="不限";
                }
                
                if(empty($status)){
                    $status="不限";
                }
                
                if(empty($topic)){
                    $topic="不限";
                }
                
                if(empty($dept)){
                    $dept="不限";
                }
                
                if(empty($authors)){
                    $authors="不限";
                }
                
                if(empty($prj_info)){
                    $prj_info="不限";
                }
                        
                if(empty($start_date)){
                    $start_date="0000-00-00";
                }
                
                if(empty($end_date)){
                    $end_date="9999-12-31";
                }
                
                if($start_date>=$end_date){
                    $this->error("开始日期 应小于 结束日期。", 2);
                }
                
                $kind_s="patent";
                //12个参数
                $this->patent_ser($kind,$kind_s,$type,$status,$topic,$dept,$start_date,$end_date,$authors,$authortype,$prj_info,$prj_infotype);

			}		

			$this->display();
		}
        
        //管理界面中论文的搜索,12个搜索参数
		function index_manage_the(){
            if(!$this->isCached()) {
                
                //登录系统的用户才能进行搜索操作。
                if(!$_SESSION['login']){
                     $this->error("登录系统后才能进行操作。", 2);
                }
               
                //p("POST",$_POST);
                //p("GET",$_GET);
                
                if (!empty($_POST)){
                    $kind=$_POST['ser_kind'];
                    $type=$_POST['ser_type'];
                    $status=$_POST['ser_status'];
                    $topic=$_POST['ser_topic'];
                    $dept=$_POST['ser_dept'];
                    $authors=$_POST['ser_authors'];
                    $authortype=$_POST['ser_authortype'];
                    $prj_info=$_POST['ser_prj_info'];
                    $prj_infotype=$_POST['ser_prj_infotype'];
                    $start_date=$_POST['ser_start_date'];
                    $end_date=$_POST['ser_end_date'];
                    
                }else{
                    $kind=$_GET['ser_kind'];
                    $type=$_GET['ser_type'];
                    $status=$_GET['ser_status'];
                    $topic=$_GET['ser_topic'];
                    $dept=$_GET['ser_dept'];
                    $authors=$_GET['ser_authors'];
                    $authortype=$_GET['ser_authortype'];
                    $prj_info=$_GET['ser_prj_info'];
                    $prj_infotype=$_GET['ser_prj_infotype'];
                    $start_date=$_GET['ser_start_date'];
                    $end_date=$_GET['ser_end_date'];
                    
                }
                                
                if(empty($kind)){
                    $kind="论文";
                }                 
                
                if(empty($type)){
                    $type="不限";
                }
                
                if(empty($status)){
                    $status="不限";
                }
                
                if(empty($topic)){
                    $topic="不限";
                }
                
                if(empty($dept)){
                    $dept="不限";
                }
                
                if(empty($authors)){
                    $authors="不限";
                }
                
                if(empty($prj_info)){
                    $prj_info="不限";
                }
                        
                if(empty($start_date)){
                    $start_date="0000-00-00";
                }
                
                if(empty($end_date)){
                    $end_date="9999-12-31";
                }
                
                if($start_date>=$end_date){
                    $this->error("开始日期 应小于 结束日期。", 2);
                }
                
                $kind_s="thesis";
                //12个参数
                $this->thesis_ser($kind,$kind_s,$type,$status,$topic,$dept,$start_date,$end_date,$authors,$authortype,$prj_info,$prj_infotype);

			}		

			$this->display();		  
          
		}
        
        //搜索专利,12个参数
       	private function patent_ser($k,$ks,$tp,$s,$tc,$d,$s_d,$e_d,$as,$astp,$p_i,$p_it){
       	    $kind=$k;      //$kind="专利"
            $kind_s=$ks;   //$kind_s="patent"
            $type=$tp;
            $status=$s;
            $topic=$tc;
            $dept=$d;
            $start_date=$s_d;
            $end_date=$e_d;
            $authors=$as;
            $authortype=$astp;
            $prj_info=$p_i;
            $prj_infotype=$p_it;
            
            if($type!="不限"){
                switch($status){
                    case "填报" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,adddate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND adddate>='$start_date' AND adddate<='$end_date'";              
                    
                    break;
                    
                    case "提交" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,submitdate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND submitdate>='$start_date' AND submitdate<='$end_date'"; 
                    
                    break;
                    
                    case "修改" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,mod_retdate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND mod_retdate>='$start_date' AND mod_retdate<='$end_date'"; 
                    
                    break;
                    
                    case "退回" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,mod_retdate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND mod_retdate>='$start_date' AND mod_retdate<='$end_date'"; 
                    
                    break;
                    
                    case "审核" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,auditdate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND auditdate>='$start_date' AND auditdate<='$end_date'"; 
                    
                    break;
                    
                    case "批准" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,approvedate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND approvedate>='$start_date' AND approvedate<='$end_date'";
                    
                    break;
                    
                    case "申报" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,apply_abandondate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND apply_abandondate>='$start_date' AND apply_abandondate<='$end_date'";
                    
                    break;
                    
                    case "放弃" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,apply_abandondate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND apply_abandondate>='$start_date' AND apply_abandondate<='$end_date'";
                    
                    break;
                    
                    case "驳回" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,lic_rejdate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND lic_rejdate>='$start_date' AND lic_rejdate<='$end_date'";
                    
                    break;
                    
                    case "授权" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,lic_rejdate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND lic_rejdate>='$start_date' AND lic_rejdate<='$end_date'";
                    
                    break;
                    
                    case "维护" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,renewdate as 'date'";
                        $where_str="pattype='$type' AND status='$status' AND renewdate>='$start_date' AND renewdate<='$end_date'";
                    
                    break;                                        
            
                default://$status="不限"
                    $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,adddate as 'date'";
                    $where_str="pattype='$type'";
                    
                    break;
                }
             }else{//$type=="不限"
                switch($status){
                    case "填报" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,adddate as 'date'";
                        $where_str="status='$status' AND adddate>='$start_date' AND adddate<='$end_date'";              
                    
                    break;
                    
                    case "提交" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,submitdate as 'date'";
                        $where_str="status='$status' AND submitdate>='$start_date' AND submitdate<='$end_date'"; 
                    
                    break;
                    
                    case "修改" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,mod_retdate as 'date'";
                        $where_str="status='$status' AND mod_retdate>='$start_date' AND mod_retdate<='$end_date'"; 
                    
                    break;
                    
                    case "退回" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,mod_retdate as 'date'";
                        $where_str="status='$status' AND mod_retdate>='$start_date' AND mod_retdate<='$end_date'"; 
                    
                    break;
                    
                    case "审核" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,auditdate as 'date'";
                        $where_str="status='$status' AND auditdate>='$start_date' AND auditdate<='$end_date'"; 
                    
                    break;
                    
                    case "批准" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,approvedate as 'date'";
                        $where_str="status='$status' AND approvedate>='$start_date' AND approvedate<='$end_date'";
                    
                    break;
                    
                    case "申报" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,apply_abandondate as 'date'";
                        $where_str="status='$status' AND apply_abandondate>='$start_date' AND apply_abandondate<='$end_date'";
                    
                    break;
                    
                    case "放弃" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,apply_abandondate as 'date'";
                        $where_str="status='$status' AND apply_abandondate>='$start_date' AND apply_abandondate<='$end_date'";
                    
                    break;
                    
                    case "驳回" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,lic_rejdate as 'date'";
                        $where_str="status='$status' AND lic_rejdate>='$start_date' AND lic_rejdate<='$end_date'";
                    
                    break;
                    
                    case "授权" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,lic_rejdate as 'date'";
                        $where_str="status='$status' AND lic_rejdate>='$start_date' AND lic_rejdate<='$end_date'";
                    
                    break;
                    
                    case "维护" :
                        $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,renewdate as 'date'";
                        $where_str="status='$status' AND renewdate>='$start_date' AND renewdate<='$end_date'";
                    
                    break;                                        
            
                default://$status="不限"
                    $field_str="pat_id,pattopic as 'topic',pattype as 'type',status,dept,adddate as 'date'";
                    $where_str="adddate>='$start_date' AND adddate<='$end_date'";
                    
                    break;
               } 
             }   
                
             if($dept!="不限"){
                $where_str=$where_str."AND dept LIKE '%$dept%' ";
             }else{//$dept=="不限"
                $where_str;
             }
             
             if($topic!="不限"){
                $where_str=$where_str."AND pattopic LIKE '%$topic%' ";
             }else{//$dept=="不限"
                $where_str;
             }
             
             if($authors!="不限"){
                switch($authortype){
                    case'writer':
                        $field_str=$field_str.",writer as 'authors'";
                        $where_str=$where_str."AND writer LIKE '%$authors%' ";
                    break;
                        
                    case'author':
                        $field_str=$field_str.",author as 'authors'";
                        $where_str=$where_str."AND author LIKE '%$authors%' ";
                    break;
                    
                    case'authorother':
                        $field_str=$field_str.",authorother as 'authors'";
                        $where_str=$where_str."AND authorother LIKE '%$authors%' ";
                    break;
                    
                    default:
                    
                    break;
                    
                }
                
             }else{//$authors=="不限"
                switch($authortype){
                    case'writer':
                        $field_str=$field_str.",writer as 'authors'";
                        $where_str=$where_str;
                    break;
                        
                    case'author':
                        $field_str=$field_str.",author as 'authors'";
                        $where_str=$where_str;
                    break;
                    
                    case'authorother':
                        $field_str=$field_str.",authorother as 'authors'";
                        $where_str=$where_str;
                    break;
                    
                    default:
                        $field_str=$field_str.",writer as 'authors'";
                        $where_str=$where_str;
                    break;
                    }
             } 
             
             if($prj_info!="不限"){
                switch($prj_infotype){
                    case'prj_num':
                        $field_str=$field_str.",prjnum as 'prj_info'";
                        $where_str=$where_str."AND prjnum LIKE '%$prj_info%' ";
                    break;
                        
                    case'prj_topic':
                        $field_str=$field_str.",prjtopic as 'prj_info'";
                        $where_str=$where_str."AND prjtopic LIKE '%$prj_info%' ";
                    break;
                    
                    case'pat_keyword':
                        $field_str=$field_str.",keyword as 'prj_info'";
                        $where_str=$where_str."AND keyword LIKE '%$prj_info%' ";
                    break;
                    
                    default:
                        
                    break;
                    }
                
             }else{//$prj_info=="不限"
                switch($prj_infotype){
                    case'prj_num':
                        $field_str=$field_str.",prjnum as 'prj_info'";
                        $where_str=$where_str;
                    break;
                        
                    case'prj_topic':
                        $field_str=$field_str.",prjtopic as 'prj_info'";
                        $where_str=$where_str;
                    break;
                    
                    case'pat_keyword':
                        $field_str=$field_str.",keyword as 'prj_info'";
                        $where_str=$where_str;
                    break;
                    
                    default:
                        $field_str=$field_str.",prjtopic as 'prj_info'";
                        $where_str=$where_str;
                    break;
                    }
                
             }                                                              
            
            $sets1=D("patent")->field($field_str)
                            //->where(array("dept"=>$dept_s))
                            ->where($where_str)
                            ->total();
                      
            /**
            设置分页类的属性，共4个参数。第一个为总记录数，第二个为每页需要显示的记录数默认为“25”，
            第三个为向下一个页面传递的参数，第四个默认为“true”，表示从第一页开始显示
            */                 
            $page=new Page($sets1,10,"/ser_kind/".$kind."/ser_type/".$type."/ser_status/".$status."/ser_topic/".$topic
            ."/ser_dept/".$dept."/ser_start_date/".$start_date."/ser_end_date/".$end_date."/ser_authors/".$authors."/ser_authortype/".$authortype
            ."/ser_prj_info/".$prj_info."/ser_prj_infotype/".$prj_infotype);
                                    
            //每页显示的记录内容
            $sets=D("patent")->field($field_str)
                            //->where(array("dept"=>$dept_s))
                            ->where($where_str)
                            ->order("date desc")
                            ->limit($page->limit)
                            ->select();             
            
            //p("field_str",$field_str);
            //p("where_str",$where_str);
 
            $page->set("head", "个".$kind);
            
            $this->assign("kind",$kind);    
            $this->assign("sets",$sets);
            $this->assign("type",$type);
            $this->assign("status",$status);
            $this->assign("topic",$topic);
    		$this->assign("dept",$dept);
            $this->assign("authors",$authors);
            $this->assign("authortype",$authortype);
            $this->assign("prj_info",$prj_info);
            $this->assign("prj_infotype",$prj_infotype);
            $this->assign("start_date",$start_date);
            $this->assign("end_date",$end_date);
    		$this->assign("fpage", $page->fpage(0,3,2,4,7,6));
       	}
        
        //搜索论文
        private function thesis_ser($k,$ks,$tp,$s,$tc,$d,$s_d,$e_d,$as,$astp,$p_i,$p_it){
       	    $kind=$k;           //$kind="论文"
            $kind_s=$ks;        //$kind_s="thesis"
            $type=$tp;
            $status=$s;
            $topic=$tc;
            $dept=$d;
            $start_date=$s_d;
            $end_date=$e_d;
            $authors=$as;
            $authortype=$astp;
            $prj_info=$p_i;
            $prj_infotype=$p_it;

            if($type!="不限"){
                switch($status){
                    case "填报" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,adddate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND adddate>='$start_date' AND adddate<='$end_date'";              
                    
                    break;
                    
                    case "提交" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,submitdate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND submitdate>='$start_date' AND submitdate<='$end_date'"; 
                    
                    break;
                    
                    case "修改" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',dept,mod_retdate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND mod_retdate>='$start_date' AND mod_retdate<='$end_date'"; 
                    
                    break;
                    
                    case "退回" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,mod_retdate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND mod_retdate>='$start_date' AND mod_retdate<='$end_date'"; 
                    
                    break;
                    
                    case "审核" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,auditdate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND auditdate>='$start_date' AND auditdate<='$end_date'"; 
                    
                    break;
                    
                    case "批准" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,approvedate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND approvedate>='$start_date' AND approvedate<='$end_date'";
                    
                    break;
                    
                    case "投稿" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,cntrdate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND cntrdate>='$start_date' AND cntrdate<='$end_date'";
                    
                    break;
                    
                    case "收录" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,incl_rejdate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND incl_rejdate>='$start_date' AND incl_rejdate<='$end_date'";
                    
                    break;
                    
                    case "拒稿" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,incl_rejdate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND incl_rejdate>='$start_date' AND incl_rejdate<='$end_date'";
                    
                    break;
                    
                    case "出版" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,pubdate as 'date'";
                        $where_str="thetype='$type' AND status='$status' AND pubdate>='$start_date' AND pubdate<='$end_date'";
                    
                    break;                                        
            
                default://$status="不限"
                    $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,adddate as 'date'";
                    $where_str="thetype='$type'";
                    
                    break;
                }
             }else{//$type=="不限"
                switch($status){
                    case "填报" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,adddate as 'date'";
                        $where_str="status='$status' AND adddate>='$start_date' AND adddate<='$end_date'";              
                    
                    break;
                    
                    case "提交" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,submitdate as 'date'";
                        $where_str="status='$status' AND submitdate>='$start_date' AND submitdate<='$end_date'"; 
                    
                    break;
                    
                    case "修改" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,mod_retdate as 'date'";
                        $where_str="status='$status' AND mod_retdate>='$start_date' AND mod_retdate<='$end_date'"; 
                    
                    break;
                    
                    case "退回" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,mod_retdate as 'date'";
                        $where_str="status='$status' AND mod_retdate>='$start_date' AND mod_retdate<='$end_date'"; 
                    
                    break;
                    
                    case "审核" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,auditdate as 'date'";
                        $where_str="status='$status' AND auditdate>='$start_date' AND auditdate<='$end_date'"; 
                    
                    break;
                    
                    case "批准" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,approvedate as 'date'";
                        $where_str="status='$status' AND approvedate>='$start_date' AND approvedate<='$end_date'";
                    
                    break;
                    
                    case "投稿" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,cntrdate as 'date'";
                        $where_str="status='$status' AND cntrdate>='$start_date' AND cntrdate<='$end_date'";
                    
                    break;
                    
                    case "收录" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,incl_rejdate as 'date'";
                        $where_str="status='$status' AND incl_rejdate>='$start_date' AND incl_rejdate<='$end_date'";
                    
                    break;
                    
                    case "拒稿" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,incl_rejdate as 'date'";
                        $where_str="status='$status' AND incl_rejdate>='$start_date' AND incl_rejdate<='$end_date'";
                    
                    break;
                    
                    case "出版" :
                        $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,pubdate as 'date'";
                        $where_str="status='$status' AND pubdate>='$start_date' AND pubdate<='$end_date'";
                    
                    break;
                    
                default://$status="不限"
                    $field_str="the_id,thetopic as 'topic',thetype as 'type',status,dept,adddate as 'date'";
                    $where_str="adddate>='$start_date' AND adddate<='$end_date'";
                    
                    break;
               } 
             }
             
             if($dept!="不限"){
                $where_str=$where_str."AND dept LIKE '%$dept%' ";
             }else{//$dept=="不限"
                $where_str;
             }
             
             if($topic!="不限"){
                $where_str=$where_str."AND thetopic LIKE '%$topic%' ";
             }else{//$dept=="不限"
                $where_str;
             }
             
             if($authors!="不限"){
                switch($authortype){
                    case'writer':
                        $field_str=$field_str.",writer as 'authors'";
                        $where_str=$where_str."AND writer LIKE '%$authors%' ";
                    break;
                        
                    case'author1st':
                        $field_str=$field_str.",author1st as 'authors'";
                        $where_str=$where_str."AND author1st LIKE '%$authors%' ";
                    break;
                    
                    case'author2nd':
                        $field_str=$field_str.",author2nd as 'authors'";
                        $where_str=$where_str."AND author2nd LIKE '%$authors%' ";
                    break;
                    
                    case'authorother':
                        $field_str=$field_str.",authorother as 'authors'";
                        $where_str=$where_str."AND authorother LIKE '%$authors%' ";
                    break;
                    
                    default:
                    
                    break;
                    
                }
                
             }else{//$authors=="不限"
                switch($authortype){
                    case'writer':
                        $field_str=$field_str.",writer as 'authors'";
                        $where_str=$where_str;
                    break;
                        
                    case'author1st':
                        $field_str=$field_str.",author1st as 'authors'";
                        $where_str=$where_str;
                    break;
                    
                    case'author2nd':
                        $field_str=$field_str.",author2nd as 'authors'";
                        $where_str=$where_str;
                    break;
                    
                    case'authorother':
                        $field_str=$field_str.",authorother as 'authors'";
                        $where_str=$where_str;
                    break;
                    
                    default:
                        $field_str=$field_str.",writer as 'authors'";
                        $where_str=$where_str;
                    break;
                    }
             } 
             
             if($prj_info!="不限"){
                switch($prj_infotype){
                    case'prj_num':
                        $field_str=$field_str.",prjnum as 'prj_info'";
                        $where_str=$where_str."AND prjnum LIKE '%$prj_info%' ";
                    break;
                        
                    case'prj_topic':
                        $field_str=$field_str.",prjtopic as 'prj_info'";
                        $where_str=$where_str."AND prjtopic LIKE '%$prj_info%' ";
                    break;
                    
                    case'the_keyword':
                        $field_str=$field_str.",keyword as 'prj_info'";
                        $where_str=$where_str."AND keyword LIKE '%$prj_info%' ";
                    break;
                    
                    default:
                        
                    break;
                    }
                
             }else{//$prj_info=="不限"
                switch($prj_infotype){
                    case'prj_num':
                        $field_str=$field_str.",prjnum as 'prj_info'";
                        $where_str=$where_str;
                    break;
                        
                    case'prj_topic':
                        $field_str=$field_str.",prjtopic as 'prj_info'";
                        $where_str=$where_str;
                    break;
                    
                    case'the_keyword':
                        $field_str=$field_str.",keyword as 'prj_info'";
                        $where_str=$where_str;
                    break;
                    
                    default:
                        $field_str=$field_str.",prjtopic as 'prj_info'";
                        $where_str=$where_str;
                    break;
                    }
                
             }                            



            $sets1=D("thesis")->field($field_str)
                            //->where(array("dept"=>$dept_s))
                            ->where($where_str)
                            ->total();
                      
            /**
            设置分页类的属性，共4个参数。第一个为总记录数，第二个为每页需要显示的记录数默认为“25”，
            第三个为向下一个页面传递的参数，第四个默认为“true”，表示从第一页开始显示
            */                 
            $page=new Page($sets1,10,"/ser_kind/".$kind."/ser_type/".$type."/ser_status/".$status."/ser_topic/".$topic
            ."/ser_dept/".$dept."/ser_start_date/".$start_date."/ser_end_date/".$end_date."/ser_authors/".$authors."/ser_authortype/".$authortype
            ."/ser_prj_info/".$prj_info."/ser_prj_infotype/".$prj_infotype);
                                    
            //每页显示的记录内容
            $sets=D("thesis")->field($field_str)
                            //->where(array("dept"=>$dept_s))
                            ->where($where_str)
                            ->order("date desc")
                            ->limit($page->limit)
                            ->select();       
            
            //p("field_str",$field_str);
            //p("where_str",$where_str);
            
            $page->set("head", "篇".$kind);
            
            $this->assign("kind",$kind);    
            $this->assign("sets",$sets);
            $this->assign("type",$type);
            $this->assign("status",$status);
            $this->assign("topic",$topic);
    		$this->assign("dept",$dept);
            $this->assign("authors",$authors);
            $this->assign("authortype",$authortype);
            $this->assign("prj_info",$prj_info);
            $this->assign("prj_infotype",$prj_infotype);
            $this->assign("start_date",$start_date);
            $this->assign("end_date",$end_date);
    		$this->assign("fpage", $page->fpage(0,3,2,4,7,6));       	    
            
       	}
        
        //搜索成果登记
        private function achievement_ser($k,$ks,$tp,$s,$tc,$d,$s_d,$e_d){
       	    $kind=$k;
            $kind_s=$ks;
            $type=$tp;
            $status=$s;
            $topic=$tc;
            $dept=$d;
            $start_date=$s_d;
            $end_date=$e_d;

            //$page->set("head", "个".$kind);
            
            $this->assign("kind","搜索".$kind."开发中");    
            $this->assign("sets",$sets);
            $this->assign("type",$type);
            $this->assign("status",$status);
            $this->assign("topic",$topic);
    		$this->assign("dept",$dept);
            $this->assign("start_date",$start_date);
            $this->assign("end_date",$end_date);
    		//$this->assign("fpage", $page->fpage(0,3,2,4,7,6));                     	    
            
       	}
        
        //搜索获奖情况
        private function award_ser($k,$ks,$tp,$s,$tc,$d,$s_d,$e_d){
       	    $kind=$k;
            $kind_s=$ks;
            $type=$tp;
            $status=$s;
            $topic=$tc;
            $dept=$d;
            $start_date=$s_d;
            $end_date=$e_d;

            //$page->set("head", "个".$kind);
            
            $this->assign("kind","搜索".$kind."开发中");    
            $this->assign("sets",$sets);
            $this->assign("type",$type);
            $this->assign("status",$status);
            $this->assign("topic",$topic);
    		$this->assign("dept",$dept);
            $this->assign("start_date",$start_date);
            $this->assign("end_date",$end_date);
    		//$this->assign("fpage", $page->fpage(0,3,2,4,7,6));                   	    
            
       	}
        
	}
