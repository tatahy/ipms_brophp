<?php
	define("DEBUG",0);				      //开启调试模式 1 开启 0 关闭
	define("DRIVER", "mysqli");		              //数据库的驱动，本系统支持pdo(默认)和mysqli两种
	//define("DSN", "mysql:host=localhost;dbname=brophp"); //如果使用PDO可以使用，不使用则默认连接MySQL
	define("HOST", "localhost");			      //数据库主机
	define("USER", "root");                               //数据库用户名
	define("PASS", "123456");                              //数据库密码
	define("DBNAME", "ipms_patent");			      //数据库名
	define("TABPREFIX", "ipms_");                           //数据表前缀
        //缓存开关 1开启，0为关闭
	define("CTIME", "3600");                       	       //缓存时间
	define("TPLPREFIX", "tpl");                           //模板文件的后缀名


	//$memServers = array("localhost", 11211);	     //使用memcache服务器
	
/*	//如果有多台memcache服务器可以使用二维数组
	$memServers = array(
			array("192.168.0.10", 11211),
			array("192.168.0.3", 11211),
			array("192.168.0.20", 11211),
			array("192.168.0.12", 11211)
		); */
	
      
	define("ARTICLE_PAGE_SIZE", "20");                                //后台文章每页显示的数目
	define("COMMENT_PAGE_SIZE", "20");                                //后台文章每页显示的数目
	define("PICTURE_PAGE_SIZE", "20");                                //后台图片每页显示的数目
	define("WATER","watermark.gif");                                   //水印图片名称
	define("POSITION", "5");
	$styleList = array("default" => "默认风格", "cial"=> "时代经典");  	//系统风格数组
	$pictureSize = array('maxWidth' => 500, 'maxHeight' => 500); 		//定义生成后的大小
	$thumbSize = array('width' => 200, 'height' => 30);   			//定义缩略图的大小
	define("APP_NAME", "知识产权管理系统");
	define("KEYWORD", "linux,php,java,xsphp,ip");
	define("DESCRIPTION", "HY,ipms");

    /**
    * 定义状态数组,home应用中hyuser模块的menu.tpl中的各个状态的显示顺序与$status_value的排序一致，
    * 因用到$GLOBALS["status_num"]用于循环时的引用。
    */   
    //patent的所有状态,关联型数组
    $status_value=array('add'=>'填报','sub'=>'提交','mod'=>'修改','ret'=>'退回','aud'=>'审核','app'=>'批准',
                        'apply'=>'申报','license'=>'授权','abandon'=>'放弃','reject'=>'驳回','maintain'=>'维护'); 
                        
     //thesis的所有状态,关联型数组
    $the_status_value=array('add'=>'填报','sub'=>'提交','mod'=>'修改','ret'=>'退回','aud'=>'审核','app'=>'批准',
                       'cntr'=>'投稿','incl'=>'收录','rej'=>'拒稿','pub'=>'出版');                       
    
    //将关联型数组赋值给全局数组，便于单个引用
    $GLOBALS["status_str"]=$status_value;
    $GLOBALS["the_status_str"]=$the_status_value;
    
    //将关联型数组转化为索引型数组后赋值给全局数组，便于循环时的引用,下标从0开始
    $GLOBALS["status_num"]=array_values($status_value);
    $GLOBALS["the_status_num"]=array_values($the_status_value);
    
     //patent的所有类型,索引型数组
    $GLOBALS["pat_type_num"]=array('实用新型专利','发明专利','外观设计专利','软件版权','著作权','集成电路图');
    
    //thesis的所有类型,索引型数组
    $GLOBALS["the_type_num"]=array('会议(国际)论文','会议(国内)论文','期刊(国际)论文','期刊(国内核心)论文','期刊(国内非核心)论文','著作');
    
    
