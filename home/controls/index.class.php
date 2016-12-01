<?php
	class Index {
		function index(){            
            if(!$this->isCached()) {
                //将网站名称分配到模板中，在标题栏中显示
				$this->assign("appname", APP_NAME);
				$this->assign("keywords", KEYWORD);
				$this->assign("description", DESCRIPTION);
			 
                $patent=D("patent");
                $time=strtotime(date("Y-m-d"))+60*60*24;
                //获取patent总数
                $pat_total=D("patent")->total();
                //获取“填报”的patent总数
                $pat_add=D("patent")->field('pat_id')->where(array('status'=>"填报"))->total(); 
                //获取有效的（“授权”&“维护”状态）patent总数
                $pat_license=D("patent")->field('pat_id')->where(array('status'=>array(授权,维护)))->total();
                
                $thesis=D("thesis");
                $time=strtotime(date("Y-m-d"))+60*60*24;
                //获取thesis总数
                $the_total=D("thesis")->total();
                //获取“填报”的thesis总数
                $the_add=D("thesis")->field('the_id')->where(array('status'=>"填报"))->total(); 
                //获取发表thesis总数
                $the_pub=D("thesis")->field('the_id')->where(array('status'=>"出版"))->total();  
                
                $this->assign("pat_total",$pat_total);
                $this->assign("pat_add",$pat_add);
                $this->assign("pat_license",$pat_license);
                
                $this->assign("the_total",$the_total);
                $this->assign("the_add",$the_add);
                $this->assign("the_pub",$the_pub);
                
			}
			$this->display();
		}
        
        //所有专利数据集合
        function index_patall(){            
            if(!$this->isCached()) {
                //将网站名称分配到模板中，在标题栏中显示
				$this->assign("appname", APP_NAME);
				$this->assign("keywords", KEYWORD);
				$this->assign("description", DESCRIPTION);

                //p("GET",$_GET);
                if (!empty($_GET['str'])){
                    $str_t=$_GET['str'];
                }else $str_t="dept";
                
                
                //$s=$GLOBALS["app"]."index/index_patall/str/".$str_t;
                //p("s",$s);
                /**
                 设置分页类的属性，共4个参数。第一个为总记录数，第二个为每页需要显示的记录数默认为“25”，
                 第三个为向下一个页面传递的参数，第四个默认为“true”，表示从第一页开始显示
                */                 
                $page_pat=new Page(D("patent")->total(),20,$GLOBALS["app"]."index/index_patall/str/".$str_t);
                
                //每页显示的记录内容
                $sets_pat=D("patent")->field('pat_id,pattopic,pattype,status,dept')
          				    ->limit($page_pat->limit)
                            ->order($str_t." asc")
                            ->select();
                            
                $page_pat->set("head", "个专利");
                
    			$this->assign("sets_pat",$sets_pat);
    			$this->assign("fpage_pat", $page_pat->fpage(0,3,2,4,7,6));
                
			}
			$this->display();
		}
        
        //有效专利数据集合
        function index_patvalid(){            
            if(!$this->isCached()) {
                //将网站名称分配到模板中，在标题栏中显示
				$this->assign("appname", APP_NAME);
				$this->assign("keywords", KEYWORD);
				$this->assign("description", DESCRIPTION);
			 
               
             
                $patent=D("patent");
                $time=strtotime(date("Y-m-d"))+60*60*24;
                
                
                //获取并分配所有已（“授权”&“维护”状态）patent
                $c=D("patent")->field('pat_id')->where(array('status'=>array(授权,维护)))->total(); 
                
                $page_pat=new Page($c);
                $sets_pat=D("patent")->field('pat_id,pattopic,pattype,status,owner')
  				    ->limit($page_pat->limit)
                    ->where(array('status'=>array(授权,维护)))
                    ->select(); 
                $page_pat->set("head", "个专利");
                
    			$this->assign("sets_pat",$sets_pat);
    			$this->assign("fpage_pat", $page_pat->fpage(0,3,2,4,7,6));
                
			}
			$this->display();
		}
		
        //所有论文数据集合
        function index_theall(){            
            if(!$this->isCached()) {
                 //将网站名称分配到模板中，在标题栏中显示
				$this->assign("appname", APP_NAME);
				$this->assign("keywords", KEYWORD);
				$this->assign("description", DESCRIPTION);

                //p("GET",$_GET);
                if (!empty($_GET['str'])){
                    $str_t=$_GET['str'];
                }else $str_t="dept";
                
                
                //$s=$GLOBALS["app"]."index/index_patall/str/".$str_t;
                //p("s",$s);
                /**
                 设置分页类的属性，共4个参数。第一个为总记录数，第二个为每页需要显示的记录数默认为“25”，
                 第三个为向下一个页面传递的参数，第四个默认为“true”，表示从第一页开始显示
                */                 
                $page_the=new Page(D("thesis")->total(),20,$GLOBALS["app"]."index/index_theall/str/".$str_t);
                
                //每页显示的记录内容
                $sets_the=D("thesis")->field('the_id,thetopic,thetype,status,dept')
          				    ->limit($page_the->limit)
                            ->order($str_t." asc")
                            ->select();
                            
                $page_the->set("head", "篇论文");
                
    			$this->assign("sets_the",$sets_the);
    			$this->assign("fpage_the", $page_the->fpage(0,3,2,4,7,6));
                
			}
			$this->display();
                
		}
        
        //发表论文数据集合
        function index_thepub(){            
            if(!$this->isCached()) {
               //将网站名称分配到模板中，在标题栏中显示
				$this->assign("appname", APP_NAME);
				$this->assign("keywords", KEYWORD);
				$this->assign("description", DESCRIPTION);

                $thesis=D("thesis");
                $time=strtotime(date("Y-m-d"))+60*60*24;
                
                //获取并分配所有已“出版”的thesis
                $c=D("thesis")->field('the_id')->where(array('status'=>"出版"))->total(); 
                
                $page_the=new Page($c);
                $sets_the=D("thesis")->field('the_id,thetopic,thetype,status,author1st')
  				    ->limit($page_the->limit)
                    ->where(array('status'=>"出版"))
                    ->select(); 
                $page_the->set("head", "篇论文");
                
    			$this->assign("sets_the",$sets_the);
    			$this->assign("fpage_the", $page_the->fpage(0,3,2,4,7,6));
                
			}
			$this->display();
		}
		
	}
