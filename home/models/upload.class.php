<?php
require "fileupload.class.php";
 
 //文件上传方法
        function upload(){
            
            $up = new FileUpload();
                //设置上传文件放置位置
            $up -> set('path','/usr/www/uploads')
                //设置上传文件允许的大小，单位为字节，约为9.5Mb
                -> set('maxSize',10000000)
                //设置允许上传文件的类型，单位为字节，约为9.5Mb
                -> set('allowType',array('gif','jpg','jpeg','pdf','doc','docx'))
                //设置启用上传后随机文件名，false使用原文件名
                -> set('israndname',true);
                
                //upfile为上传表单名称
            if($up->upload('upfile')){
                //返回上传后的文件名，
                return $up->getFileName();   
            } else {
                //若上传失败提示出错原因
                $this->error($up->getErrorMsg(),3,'index');
            }    
        }
        
        