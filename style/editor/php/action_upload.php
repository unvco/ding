<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
session_start();
include "Uploader.class.php";

/* 上传配置 */
$base64 = "upload";
switch (htmlspecialchars($_GET['action'])) {
    case 'uploadimage':
        $config = array(
            "pathFormat" => $CONFIG['imagePathFormat'],
            //"pathFormat" => 'upload/image/'.date('Y',time()).'/'.date('mdHis',time()).rand(10,99),
            "maxSize" => $CONFIG['imageMaxSize'],
            "allowFiles" => $CONFIG['imageAllowFiles']
        );
        $fieldName = $CONFIG['imageFieldName'];
        break;
    case 'uploadscrawl':
        $config = array(
            "pathFormat" => $CONFIG['scrawlPathFormat'],
            "maxSize" => $CONFIG['scrawlMaxSize'],
            "allowFiles" => $CONFIG['scrawlAllowFiles'],
            "oriName" => "scrawl.png"
        );
        $fieldName = $CONFIG['scrawlFieldName'];
        $base64 = "base64";
        break;
    case 'uploadvideo':
        $config = array(
            "pathFormat" => $CONFIG['videoPathFormat'],
            "maxSize" => $CONFIG['videoMaxSize'],
            "allowFiles" => $CONFIG['videoAllowFiles']
        );
        $fieldName = $CONFIG['videoFieldName'];
        break;
    case 'uploadfile':
    default:
        $config = array(
            "pathFormat" => $CONFIG['filePathFormat'],
            //"pathFormat" => 'upload/file/'.date('Y',time()).'/'.date('mdHis',time()).rand(10,99),
            "maxSize" => $CONFIG['fileMaxSize'],
            "allowFiles" => $CONFIG['fileAllowFiles']
        );
        $fieldName = $CONFIG['fileFieldName'];
        break;
}

/* 生成上传实例对象并完成上传 */
$up = new Uploader($fieldName, $config, $base64);
$getFileInfo = $up->getFileInfo();

if($getFileInfo[state]=='SUCCESS') {
    //保存上传记录
    $filetype = substr($getFileInfo['type'],1);
    $filename = $getFileInfo['title'];
    $fileurl = $getFileInfo['url'];
    $filesize = $getFileInfo['size'];
    $addtime = date('y-m-d h:i:s',time());
	$session = $getFileInfo;
	$session['addtime'] = $addtime;
	$_SESSION['uploads'][] = $session;
	if(!isset($_SESSION['mysession_id']))//判断用户有没有登录
    {
	   $user_id=0;
    }else{
	   $user_id=$_SESSION['mysession_id'];
	}
    $arcid = 0;//文章ID



    //连接数据库
    $config='../../../protected/config/main.php';
    $config=require_once($config);
    $dbserveranddb=$config["components"]["db"]["connectionString"];//数据库主机名
    $dbusername=$config["components"]["db"]["username"];//数据库用户名
    $dbpassword=$config["components"]["db"]["password"];//数据库密码
    $uploadtable=$config["params"]["uploadtable"];//数据库密码
    $mysql_db="";$dbserver="";
    if (preg_match_all('|host=(\S+?);|', $dbserveranddb, $reg))
    {
        $dbserver=$reg[1][0];
    }
    if (preg_match_all('|;dbname=(\S+?)$|', $dbserveranddb, $reg))
    {
        $mysql_db=$reg[1][0];
    }
    $connid=@mysql_connect($dbserver,$dbusername,$dbpassword) or die ($this->error());
    mysql_select_db("$mysql_db",$connid) or die("没该数据库：".$mysql_db);
    mysql_query("set character set 'utf8'");//读库
    mysql_query("set names 'utf8'");//写库
    //连接数据库
    //将附件信息写入数据库
    $sql = "INSERT INTO $uploadtable (articleid,userid,type,name,url,size,createtime) VALUES ('$arcid','$user_id','$filetype','$filename','$fileurl','$filesize','$addtime')";
    if(!mysql_query($sql)){
        alert("上传出错");
    }else{
    }
    //将附件信息写入数据库
}

/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */

/* 返回数据 */
//return json_encode($up->getFileInfo());
return json_encode($getFileInfo);