<?php
$topic=$_POST['topic'];                                //文件对应attachment表中topic 
$kind=$_POST['kind'];                   //文件对应attachment表中的type
$obj_id= $_POST['obj_id'];
$operate= $_POST['operate']; 

$file_dir=$_POST['file_dir'];   //下载文件存放目录
$file_name=$_POST['file_name'];             //下载文件名
//echo $file_dir;
//echo $file_name;
if(!file_exists($file_dir.$file_name)){
    echo "文件不存在。";
    //$this->error('文件不存在',3,"attachment/index/id/".$obj_id."/topic/".$topic."/kind/".$kind."/operate/".$operate); 
    //无法使用$this->error进行页面自动跳转,因为不在broPHP框架下。hy,2016/8/29
    //header("Location:");//考虑用header函数的跳转来实现。
    exit();    
    }else{
        ob_end_clean();                 //清除缓冲区内容，将缓冲区关闭，但不输出内容。
        header("Content-Type:application/octet-stream");
        header("Content-Disposition:attachment;filename=".$file_name);
        header('Content-Length:'.filesize($file_dir.$file_name));
        header("Pragma:no-cache");      //不缓存页面
        //header("Content-Type:application/octet-stream");
        
        ob_clean();
        flush();
        readfile($file_dir.$file_name);
        exit();
    }
?>
