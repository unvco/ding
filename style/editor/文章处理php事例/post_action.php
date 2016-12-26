<?php
header("Content-type: text/html; charset=UTF-8");//指定文档编码
//数据库
include("../system/confic.php");
$http_host='http://'.$_SERVER['HTTP_HOST'];
session_start();

if($_POST["action"]=="add"){
   $my_id=1;//从session中提取出登录用户的id号
   $name=$_POST["name"];
   $bankuai=$_POST["bankuai"];
   $jianjie=$_POST["jianjie"];
   $content=$_POST["content"];
   $pic_name=$_POST["pic_name"];
   $time=time();//发表文章的时间
   $content_txt="../content/".$bankuai."/".date("Y-m-d")."/".time().".txt";//文章的内容用txt形式保存到相应的文件夹中
   $content_txt_name="content/".$bankuai."/".date("Y-m-d")."/".time().".txt";//文章的内容用txt形式保存到相应的文件夹中
   if(!is_dir("../content/".$bankuai)){mkdir("../content/".$bankuai);}//创建板块文件夹
   if(!is_dir("../content/".$bankuai."/".date("Y-m-d"))){mkdir("../content/".$bankuai."/".date("Y-m-d"));}//创建板块文件夹内的小文件夹
   $handle=fopen($content_txt,"w");//写入方式打开文章内容
   fwrite($handle,$content);
   fclose($handle);
   $query="insert into ".$db_header."news(user_id,name,bankuai,jianjie,content,time) values ('$my_id','$name','$bankuai','$jianjie','$content_txt_name','$time');";
   if(@mysql_query($query)){
	   
      //上传附件处理代码
      if(!isset($_SESSION['uploads'])) $_SESSION['uploads'] = array();
      //清除未保存的上传记录
      if(count($_SESSION['uploads'])>0){
         foreach($_SESSION['uploads'] as $k=>$val) {
		    if(strpos($content, $val['url']) === false){
               @unlink($val['url']);
               array_splice($_SESSION['uploads'],$k,1);
               @mysql_query("DELETE FROM ".$db_header."uploads WHERE fileurl='".$val['url']."' and filesize='".$val['size']."' and addtime='".$val['addtime']."' ");
		    }
          }
       }
       //上传附件处理代码
	   
	   
	   $query_return="select * from ".$db_header."news where time='".$time."';";
       $result_return=mysql_query($query_return);
	   
	   //上传附件处理代码
	   $arcid=mysql_result($result_return,0,"id");
	   if(count($_SESSION['uploads'])>0){
          foreach($_SESSION['uploads'] as $k=>$val) {
            if(strpos($content, $val['url']) >=0){
                @mysql_query("UPDATE ".$db_header."uploads SET arcid='".$arcid."',ok=1 WHERE addtime='".$val['addtime']."' ");
            }
          }
       }
	   
	   //头像处理代码
	   if($pic_name==""){$pic_name=1;}
	   $pic_name=$pic_name-1;
	   $query_pic="select * from ".$db_header."uploads where arcid='".$arcid."';";
       $result_pic=mysql_query($query_pic);
	   $pic_return=mysql_result($result_pic,$pic_name,"fileurl");
	   if($pic_return==""){$pic_return="/upload/no_pic.jpg";}
	   
	   @mysql_query("UPDATE ".$db_header."news SET pic_name='".$pic_return."' WHERE id='".$arcid."' ");
	   //头像处理代码
	   
	   
       //文章入库后，清除 上传临时记录 $_SESSION['uploads']
       unset($_SESSION['uploads']);
	   //上传附件处理代码
	   
	   echo(mysql_result($result_return,0,"id"));
   }else{echo("文章发表失败");}
}