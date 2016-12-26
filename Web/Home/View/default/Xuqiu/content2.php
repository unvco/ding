<?php
//公共变量
//  $my_db数据表名称，例如ding_gongying
//  $content_txt_str----文章内容
//  $qiye_txt_str-----企业介绍变量
//  $w_userid----发表文章用户的id号
//  $result数组----文章数据库数组
//  $result_user数组----发表文章用户数据库信息数组
//  $result_qiye数组----发表文章用户的企业数据库信息数组
//获取该文章的数据信息，并返回到$result中
$block="news";
$my_db="ding_".$block;
$bankuai="xuqiu";
$contentye="content2";
$my_db="ding_".$block;
$sql="SELECT * FROM $my_db WHERE id='$wid'";
$result = mysql_query($sql);
$num_result=mysql_num_rows($result);
//获取该文章的数据信息，并返回到$result中
if($num_result==0){
	$tishi1="错误提示！";
	$tishi2="没有该产品文章！！！";
	$tishi3=$http_host."/index.php/to/list".$bankuai.".html";
	include('tpls/web/defult2/php/tishi.php');
	exit;
}
//从保存的文本中获取该文章的内容，值保存在$content_txt_str变量中
$content_txt=ROOT.mysql_result($result,0,"content");
$content_txt_fp=fopen($content_txt,"r");//
$content_txt_str=fread($content_txt_fp,filesize($content_txt));
fclose($content_txt_fp);
$content_txt_str=str_replace("\\\"","\"",$content_txt_str);
//从保存的文本中获取该文章的内容，值保存在$content_txt_str变量中
$w_userid=mysql_result($result,0,"user_id");//获取发表该文章的用户id号
//获取发表该文章的用户数据信息，并返回到$result_user中
$sql_user="SELECT * FROM ding_user WHERE id='$w_userid'";
$result_user = mysql_query($sql_user);
$num_result_user=mysql_num_rows($result_user);
if(mysql_result($result_user,0,"leixing")=="企业用户"){$is_qiye=1;}else{$is_qiye=0;}
//获取发表该文章的用户数据信息，并返回到$result_user中
//获取发表该文章的用户的企业数据信息，并返回到$result_qiye中
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo(mysql_result($result,0,"name"));?></title>
<!--{include"public_style.php"}--> 
</head>

<body>
<!--{include"public_daohang.php"}--> 
<!--{include"public_logo.php"}--> 


<!--广告区 -->
<a style="text-align:center; display:block; margin:10px 0px 10px 0px;">
   <img src="tpls_img/ad11.jpg" width="1200" height="60"> 
</a>
<!--广告区 -->



<!--页面body部分 -->
<div style="margin:0 auto; width:1200px;">
  <!--页面位置部分 -->
  <div>
     <a href="<?php echo($http_host);?>" style="display:block; padding:0px 5px 0px 5px; line-height:50px; color:#666; font-size:13px; float:left;">首页</a>
     <span style="display:block; padding:0px 5px 0px 5px; line-height:50px; color:#666; font-size:13px; float:left;">></span>
     <a href="<?php echo($http_host);?>/index.php/to/listshebei.html" style="display:block; padding:0px 5px 0px 5px; line-height:50px; color:#666; font-size:13px; float:left;">设备供应列表</a>
     <span style="display:block; padding:0px 5px 0px 5px; line-height:50px; color:#666; font-size:13px; float:left;">></span>
     <a href="<?php echo($http_host);?>/index.php/to/listgongying.html" style="display:block; padding:0px 5px 0px 5px; line-height:50px; color:#666; font-size:13px; float:left;"><?php echo(mysql_result($result,0,"name"));?></a>
     <div style="clear:both;"></div>
  </div>
  <!--页面位置部分 -->
  <div style="clear:both;"></div>
  <!--内容页左侧部分 -->
  <div style="float:left; width:895px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="365">
    <!--内容页标题图片部分 -->
    <div><img src="<?php echo($http_host);?>/system/img/imgtitlepic.php?src=<?php echo($http_host);?><?php echo(mysql_result($result,0,"pic_name"));?>&&w=450" width="365" height="275" /></div>
    
    <!--内容页标题图片部分 -->
    </td>
    <td>
    <!--内容页标题部分 -->
    <div style="margin-left:15px; position:relative;">
       <div style="font-size:18px; display:block; font-weight:bold;"><?php echo(mysql_result($result,0,"name"));?></div>
       <div style="line-height:40px; color:#999; border-bottom:1px double #dbdbdb; margin-bottom:8px;">
          <span>编号<?php echo($wid);?></span>&nbsp;
          <span>更新时间：<?php echo(mysql_result($result,0,"time"));?></span>&nbsp;
          <span>浏览次数：<?php echo(mysql_result($result,0,"num"));?></span>
       </div>
       <div style="line-height:30px;"><b>价&nbsp;格：</b><span style="color:#F00; text-decoration:none; font-size:16px; font-weight:bold;border-bottom:1px double #dbdbdb;"><?php if((mysql_result($result,0,"jiage")==0)||(mysql_result($result,0,"jiage")=="")){echo("不限");}else{echo(mysql_result($result,0,"jiage")."元");}?></span><b style="margin-left:20px;">供应能力：</b><?php if((mysql_result($result,0,"shuliang")==0)||(mysql_result($result,0,"shuliang")=="")){echo("不限");}else{echo(mysql_result($result,0,"shuliang"));}?></div>
       <div style="line-height:30px; height:30px; overflow:hidden;"><b>原产地</b>：<?php echo(mysql_result($result,0,"chandi"));?></div>
       <div style="line-height:30px; height:30px; overflow:hidden;"><b>供应地址</b>：<?php echo(mysql_result($result_user,0,"dizhi"));?>(<span style="color:#999;"><?php echo(mysql_result($result_user,0,"dizhi_xiangxi"));?></span>)</div>
       <div style="line-height:30px; border-bottom:1px double #dbdbdb; height:30px; overflow:hidden;"><b>联系人</b>：<?php echo(mysql_result($result_user,0,"true_name"));?><b style="margin-left:20px;">电&nbsp;话：</b><span style="color:#F00; text-decoration:none; font-size:16px; font-weight:bold;border-bottom:1px double #dbdbdb;"><?php echo(mysql_result($result_user,0,"shouji"));?></span></div>
       <div style="line-height:30px;"><b>企业标签</b>：</div>
       <div style="line-height:30px;">
       <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td>
       <?php
       if($is_qiye==1){
	      $qiye_leixing=mysql_result($result_user,0,"qiye_leixing");
		  $qiye_leixing_arr = explode("_",$qiye_leixing);
		  for($i=1;$i <=6;$i++){
	      if($qiye_leixing_arr[$i]!=""){
       ?>
       <div style="line-height:25px; font-size:12px; padding:0px 10px 0px 10px; float:left; border:#066 1px solid; background:#FCF; text-align:center; margin-right:15px;"><?php echo($qiye_leixing_arr[$i]);?></div>
       <?php
		  }}}
	   ?>
       </td></tr></table>
       </div>
       <div>
          <div style="line-height:36px; background:url(tpls_img/bg14.jpg) no-repeat 4px 10px; padding-left:28px; color:#2a54a0; float:left; margin-right:50px;"><a href="mailto:<?php echo(mysql_result($result_user,0,"email"));?>">发送到邮箱</a></div>
          <div style="line-height:36px; background:url(tpls_img/bg15.jpg) no-repeat 4px 10px; padding-left:28px; color:#2a54a0; float:left; margin-right:50px;">收藏</div>
          <div style="line-height:36px; background:url(tpls_img/bg16.jpg) no-repeat 4px 10px; padding-left:28px; color:#2a54a0; float:left; margin-right:50px;"><a href="mailto:<?php echo(mysql_result($result_user,0,"email"));?>">发送到邮箱</a></div>
          <div style="clear:both;"></div>
       </div>
       <?php
       if(mysql_result($result,0,"is_renzheng")=="1"){
       ?>
       <div style="width:146px; height:141px; position:absolute; z-index:2; left: 356px; top: 20px;"><img src="tpls_img/bg17.jpg" width="146" height="141" /></div>
       <?php
	   }
	   ?>
    </div>
    <!--内容页标题部分 -->
    </td>
  </tr>
  </table>
  <!--内容内容部分 -->
  <?php
  if(mysql_result($result_user,0,"jianjie")!=""){
  ?>
  <div style="border-bottom:3px solid #cc0001; margin-top:15px;">
     <div style="line-height:26px; width:85px; text-align:center; font-size:14px; font-weight:bold; background:url(tpls_img/bg18.jpg); color:#FFF;">用户简介</div>
  </div>
  <div style="margin:10px 0px 10px 0px; color:#666; font-size:14px; line-height:25px;text-indent: 2em;">
      <?php echo(mysql_result($result_user,0,"jianjie"));?>...<a href="<?php echo($http_host);?>/space.php/to/<?php echo($w_userid);?>.html" target="_blank" style=" color:#C30;">进入企业店铺</a>
  </div>
  <?php }?>
  <div style="border-bottom:3px solid #cc0001; margin-top:15px;">
     <div style="line-height:26px; width:85px; text-align:center; font-size:14px; font-weight:bold; background:url(tpls_img/bg18.jpg); color:#FFF;">产品介绍</div>
  </div>
  <div style="margin:10px 0px 10px 0px; color:#666; font-size:14px; line-height:25px;">
     <?php echo($content_txt_str);?> 
  </div>
  <div style="border-bottom:3px solid #cc0001; margin-top:15px;">
     <div style="line-height:26px; width:85px; text-align:center; font-size:14px; font-weight:bold; background:url(tpls_img/bg18.jpg); color:#FFF;">位置信息</div>
  </div>
  <div style="margin:10px 0px 10px 0px; color:#666; font-size:14px; width:800px; background:#CCC;">
    <iframe width='800' height='410' class='ueditor_baidumap' src='<?php echo($http_host);?>/system<?php echo(mysql_result($result_user,0,"dizhi_baidu"));?>' frameborder='0'></iframe>
  </div>
  <!--内容内容部分 -->
  </div>
  <!--内容页左侧部分 -->
  <!--内容页右侧部分 -->
  <div style="float:right; width:285px;">
    <!--{include"public_content_user.php"}-->
    <!--图片推荐产品 -->
    <?php
    //获取石材供应最热文章11篇
    $sql_hot1="SELECT * FROM $my_db WHERE user_id='$w_userid' and bankuai='$bankuai' ORDER BY rand() LIMIT 0 , 2";
    $result_hot1 = mysql_query($sql_hot1);
    $num_result_hot1=mysql_num_rows($result_hot1);
    //获取石材供应最热文章11篇
	for($i=1;$i <=1;$i++){
    ?> 
    <a href="<?php echo($http_host);?>/index.php/to/<?php echo($contentye);?>_<?php echo(mysql_result($result_hot1,$i,"id"));?>.html" target="_blank" style="border:1px solid #dbdbdb; text-align:center; padding:10px 0px 0px 0px; margin:10px 0px 10px 0px; display:block; text-decoration:none; color:#333;">
       <img src="<?php echo($http_host);?>/system/img/imgtitlepic.php?src=<?php echo($http_host);?><?php echo(mysql_result($result_hot1,$i,"pic_name"));?>&&w=300" width="269" height="222">
       <span style="line-height:30px;"><?php echo(mysql_result($result_hot1,$i,"name"));?></span>
    </a>
    <?php
    }
    ?>
    <!--图片推荐产品 -->

    
    <!--{include"public_content2.php"}-->
    
  
  </div>
  <!--内容页右侧部分 -->
  <div style="clear:both;"></div>
  <!--{include"public_content1.php"}-->
</div>
<!--页面body部分 -->
<div style="margin:0 auto; width:1200px; height:15px;"></div>
<!--{include"public_fooer.php"}-->
</body>
</html>
<?php  //增加点击量
   $w_num=mysql_result($result,0,"num");
   $w_num=$w_num+1;
   $addnum_query="update $my_db set num='$w_num' where id='$wid';";
   mysql_query($addnum_query);
?>
<?php mysql_close($connid);?>