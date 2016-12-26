function yindiv(y){
  $(y).toggle();
}
function yindiv_input(x){//标准选项框函数
  var y="."+$(x).attr("class")+"_yin";
  var z="."+$(x).attr("class")+"_input";
  var x1="."+$(x).attr("class");
  $(x).find(y).toggle();
  $(x).find(y).find("span").click(function() {
	  dd=$(this).attr("dd");//获取选择的隐藏的值
      $(x).find(z).val($(this).text());//赋予显示出的值
	  $(x).find(z).attr("dd",dd);//赋予隐藏的值
	  $(x).find(y).toggle(); 
  });
}
function ka1(y){//样式一选项卡动作
  var x="."+$(y).attr("class");
  $(x).css("border-top","3px solid #f7f7f7");
  $(x).css("border-bottom","1px solid #dfdfdf");
  $(x).css("background","#f7f7f7");
  $(y).css("border-top","3px solid #d54f58");
  $(y).css("border-bottom","1px solid #ffffff");
  $(y).css("background","#FFF");
  var z=x+"_yin";
  $(z).hide();
  $("#"+$(y).attr("ka")).show();
}
function ka2(y){//样式二选项卡动作
  var x="."+$(y).attr("class");
  var bg1=$(y).attr("bg1");
  var bg2=$(y).attr("bg2");
  $(x).css("background","url("+bg1+") repeat-x bottom");
  $(y).css("background","url("+bg2+") no-repeat center bottom");
  var z=x+"_yin";
  $(z).hide();
  $("#"+$(y).attr("ka")).show();
}
function ka3(y){//石材供应幻灯片选项卡动作
  var x="."+$(y).attr("class");
  $(x).css("background","#FFF");
  $(y).css("background","#F00");
  var z=x+"_yin";
  $(z).hide();
  $("#"+$(y).attr("ka")).show();
}
//login.html界面
function login_input_focus(x,y){
  var x="#"+x;
  $(x).css("border","1px solid #46b907");
  if($(x).val()==y)
  {$(x).val("");}
}
function login_input_blur(x,y){
  var x="#"+x;
  $(x).css("border","1px solid #c6c6c6");
  if($(x).val()=="")
 {$(x).val(y);}
}
$(document).ready(function(){
  $("#login_button").mousedown(function() {//登陆按钮动作
	 $(this).css("background","#fbcf01");
  });
  $("#login_button").mouseup(function() {//登陆按钮动作
	 $(this).css("background","#f44800");
  });
  $("#login_button1").mousedown(function() {//登陆按钮动作
	 $(this).css("background","#fbcf01");
  });
  $("#login_button1").mouseup(function() {//登陆按钮动作
	 $(this).css("background","#f44800");
  });
  $(".kuang1_4").mouseover(function() {//企业展示幻灯片
     var yin="#kuang1_4"+$(this).attr("dd");
	 var bg1=$(this).attr("bg1");
     var bg2=$(this).attr("bg2");
	 $(".kuang1_4").css("background","url("+bg1+")");
	 $(this).css("background","url("+bg2+")");
	 $(".kuang1_4").css("color","#333");
	 $(this).css("color","#FFF");
	 $(".kuang1_div4").hide();
	 $(yin).show();
  });
  $(".ye3_2_1").mousemove(function() {//企业展示图片显隐
     var y="."+$(this).attr("class")+"_yin";
	 $(this).find(y).show();
  });
  $(".ye3_2_1").mouseleave(function() {//企业展示图片显隐
	 var y="."+$(this).attr("class")+"_yin";
	 $(this).find(y).hide();
  });
  $("#register_button").mousedown(function() {//登陆按钮动作
	 $(this).attr("src",$(this).attr("t2"));
  });
  $("#register_button").mouseup(function() {//登陆按钮动作
	 $(this).attr("src",$(this).attr("t1"));
  });
});
//login.html界面
//注册界面
function input_focus(x,y,z){
  var x="#"+x;
  $(x).css("border","1px solid #f88600");
  if($(x).val()==y)
  {$(x).val("");}
  $(".register_tishi").html(z);
}
function input_blur(x,y){
  var x="#"+x;
  $(x).css("border","1px solid #46b907");
  if($(x).val()=="")
  {$(x).val(y);}
}
$(document).ready(function(){
	//注册提交
	
	$("#is_qiye_div").click(function(){
	   if($(this).attr("checked"))
	   {$("#qiye_div").show();}else{$("#qiye_div").hide();}
	});

	//注册提交
});
//注册界面
$(document).ready(function(){
	//一级分类隐藏层显示
    $('.ji1_fen').mousemove(function(){
	$(this).find('.ji1_yin').show();
	$(this).find('.ji1_yin1').show();
	$(this).find('.ji1_yin2').show();
	$(this).find('.ji1_yin3').show();
	$(this).css("background","#ffffff");
	$(this).find('.ji1_fen_1').css("border-top-color","#F30");
	});
	$('.ji1_fen').mouseleave(function(){
	$(this).find('.ji1_yin').hide();
	$(this).find('.ji1_yin1').hide();
	$(this).find('.ji1_yin2').hide();
	$(this).find('.ji1_yin3').hide();
	$(this).css("background","#e4f1fa");
	$(this).find('.ji1_fen_1').css("border-top-color","#e4f1fa");
	});
	//一级分类隐藏层显示

});