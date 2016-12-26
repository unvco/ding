function tanchuceng(e,x,y,z,t,u,d){ //(鼠标事件，添加id号，窗口标题，宽度，高度，包含网页还是提取代码（frame or url），地址)
	    if($('#'+x).length>0){
          //不采取任何动作  .remove();移走
		} else {
		  var pointX = e.pageX;
		  var pointY = e.pageY+10;
		  if(u=='frame'){
		    str="<iframe src='"+d+"' width='"+(z-15)+"' height='"+(t-5)+"' frameborder='0'></iframe>";
			$("body").append("<div class='moveBar' id='"+x+"' style='width:"+z+"px;top:"+pointY+"px;left:"+pointX+"px;'><div class='moveBar_border_1'></div><div class='moveBar_border_2'></div><div class='moveBar_border_3'></div><div class='moveBar_banner'><div style='clear:both;'></div><span class='moveBar_banner_span_1'></span><span class='moveBar_banner_span_2'>"+y+"</span><span class='moveBar_close'></span><span class='moveBar_banner_span_4'></span></div><div class='moveBar_content' style='height:"+t+"px;'>"+str+"</div><div class='moveBar_footer'><span></span><div style='clear:both;'></div></div><div class='moveBar_border_3'></div><div class='moveBar_border_2'></div><div class='moveBar_border_1'></div></div>");
	        $(".moveBar_banner").bind("mousedown",yidong);//每次生成后都要绑定事件到class为banner的标签上
		  }else if(u=='url'){
			str="<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><div class='moveBar_add' style='width:"+(z-15)+"px; height:"+(t-5)+"px;overflow:auto;'></div></td></tr></table>";
			$("body").append("<div class='moveBar' id='"+x+"' style='width:"+z+"px;top:"+pointY+"px;left:"+pointX+"px;'><div class='moveBar_border_1'></div><div class='moveBar_border_2'></div><div class='moveBar_border_3'></div><div class='moveBar_banner'><div style='clear:both;'></div><span class='moveBar_banner_span_1'></span><span class='moveBar_banner_span_2'>"+y+"</span><span class='moveBar_close'></span><span class='moveBar_banner_span_4'></span></div><div class='moveBar_content' style='height:"+t+"px;'>"+str+"</div><div class='moveBar_footer'><span></span><div style='clear:both;'></div></div><div class='moveBar_border_3'></div><div class='moveBar_border_2'></div><div class='moveBar_border_1'></div></div>");
	        $(".moveBar_banner").bind("mousedown",yidong);//每次生成后都要绑定事件到class为banner的标签上
			$(".moveBar_add").load(d);
		  }
		}  
}
function yidong(evt){//控制class为banner的父元素可以移动
	var evt = evt || window.event;
    var isMove = true;
    var abs_x = evt.pageX - $(this).parent().offset().left; 
    var abs_y = evt.pageY - $(this).parent().offset().top;
	var parent_div_class="."+$(this).parent().attr("class");
	var close_class="."+$(this).parent().attr("class")+"_close";
	var move_div=this;
	$(parent_div_class).mousedown(function () {
	  $(parent_div_class).css("z-index","");
	  $(this).css("z-index","100");							   						   
    });//控制层的重叠
	$(close_class).click(function () {
								   
	  $(this).parent().parent().remove();;							   						   
    });//关闭层
    $(document).mousemove(function (evt) { 
	  //$(move_div).parent().children('.content').html("x坐标："+event.pageX+"+y坐标："+event.pageY+"<br>div左边距："+$(move_div).parent().offset().left+"+div上边距："+$(move_div).parent().offset().top+"<br>可视宽度："+$(window).width()+"+可视高度："+$(window).height());
      if (isMove) { 
	    var moveBar_x=evt.pageX - abs_x;//移动后的x坐标
		var moveBar_y=evt.pageY - abs_y;//移动后的y坐标
        $(move_div).parent().css("border","#d7e4e7 5px solid").css("border-top","0").css("border-left","0").css("opacity",0.5);;	
		if(moveBar_x<10){moveBar_x=10;}
		if(moveBar_y<10){moveBar_y=10;}
		if(moveBar_x>$(window).width()-$(move_div).parent().width()-10){moveBar_x=$(window).width()-$(move_div).parent().width()-10;}
		//不能移出屏幕
		if(moveBar_y>$(window).height()-$(move_div).parent().height()-10){moveBar_y=$(window).height()-$(move_div).parent().height()-10;}
        $(move_div).parent().css({'left':moveBar_x, 'top':moveBar_y}); 
      } 
    }).mouseup(function (){   
	  if (isMove){
	    $(move_div).parent().css("border","#d7e4e7 2px solid").css("border-top","0").css("border-left","0").css("opacity",1);;	
	  }
      isMove = false; 
    }); 
}