function post_content() {
	var name=$("#name").val();//文章标题
	var content=UE.getEditor('editor').getContent();//编辑器内的html内容
	var content_txt=UE.getEditor('editor').getContentTxt();//编辑器内的纯文本
	var leixing=$("#leixing option:selected").val();//获取的类型值
	var pinpai=$("#pinpai option:selected").val();//获取的品牌id值
	var is_pinglun=$("#is_pinglun").attr("checked");//是否允许评论
	var pic_name=$("#pic_name").val();//图片标题
	var jianjie=$("#jianjie").val();//文章简介
	var yanzhengma=$("#yanzhengma").val();//验证码
	var bankuai="zhanshi";//设定好为展示发文章板块
	if(name==""){alert("标题不能为空！！");}
	else if(content_txt==""){alert("主要内容不能为空！！");}
	else{
      $.post("../../../action/post.php",
      {
	    name:name,
		content:content,
		leixing:leixing,
		pinpai:pinpai,
		is_pinglun:is_pinglun,
		pic_name:pic_name,
		jianjie:jianjie,
		yanzhengma:yanzhengma,
		bankuai:bankuai
      },
      function(data,status){
        if(data=="用户信息出现错误"){alert("您还未登录，不能发文章。现在自动跳转到登录界面！");location.href="../../../index.php/to/login.html";}
	    else if(!isNaN(data)){alert("石材展示文章发布成功，自动跳转到发布的文章页");location.href="../../../index.php/to/content4_"+data+".html";}
	    else{alert(data);}
      });
	}
}

function post_content_shebei() {
	var name=$("#name").val();//文章标题
	var content=UE.getEditor('editor').getContent();//编辑器内的html内容
	var content_txt=UE.getEditor('editor').getContentTxt();//编辑器内的纯文本
	var jiage=$("#jiage").val();//获取价格
	var pinpai=$("#pinpai option:selected").val();//获取的品牌id值
	var is_pinglun=$("#is_pinglun").attr("checked");//是否允许评论
	var pic_name=$("#pic_name").val();//图片标题
	var jianjie=$("#jianjie").val();//文章简介
	var yanzhengma=$("#yanzhengma").val();//验证码
	var bankuai="shebei";//设定好为展示发文章板块
	if(name==""){alert("标题不能为空！！");}
	else if(content_txt==""){alert("主要内容不能为空！！");}
	else if(jiage==""){alert("设备的价格不能为空！！");}
	else{
      $.post("../../../action/post.php",
      {
	    name:name,
		content:content,
		jiage:jiage,
		pinpai:pinpai,
		is_pinglun:is_pinglun,
		pic_name:pic_name,
		jianjie:jianjie,
		yanzhengma:yanzhengma,
		bankuai:bankuai
      },
      function(data,status){
        if(data=="用户信息出现错误"){alert("您还未登录，不能发文章。现在自动跳转到登录界面！");location.href="../../../index.php/to/login.html";}
	    else if(!isNaN(data)){alert("设备信息发布成功，自动跳转到发布的文章页");location.href="../../../index.php/to/content3_"+data+".html";}
	    else{alert(data);}
      });
	}
}

function post_content_gongying() {
	var name=$("#name").val();//文章标题
	var content=UE.getEditor('editor').getContent();//编辑器内的html内容
	var content_txt=UE.getEditor('editor').getContentTxt();//编辑器内的纯文本
	var leixing=$("#leixing option:selected").val();//获取的类型值
	var jiage=$("#jiage").val();//价格
	var shuliang=$("#shuliang").val();//数量
	var pinpai=$("#pinpai option:selected").val();//获取的品牌id值
	var is_pinglun=$("#is_pinglun").attr("checked");//是否允许评论
	var pic_name=$("#pic_name").val();//图片标题
	var jianjie=$("#jianjie").val();//文章简介
	var yanzhengma=$("#yanzhengma").val();//验证码
	var bankuai="gongying";//设定好为展示发文章板块
	if(name==""){alert("标题不能为空！！");}
	else if(content_txt==""){alert("主要内容不能为空！！");}
	else{
      $.post("../../../action/post.php",
      {
	    name:name,
		content:content,
		jiage:jiage,
		shuliang:shuliang,
		leixing:leixing,
		pinpai:pinpai,
		is_pinglun:is_pinglun,
		pic_name:pic_name,
		jianjie:jianjie,
		yanzhengma:yanzhengma,
		bankuai:bankuai
      },
      function(data,status){
        if(data=="用户信息出现错误"){alert("您还未登录，不能发文章。现在自动跳转到登录界面！");location.href="../../../index.php/to/login.html";}
	    else if(!isNaN(data)){alert("石材供应信息发布成功，自动跳转到发布的文章页");location.href="../../../index.php/to/content1_"+data+".html";}
	    else{alert(data);}
      });
	}
}

function post_content_xuqiu() {
	var name=$("#name").val();//文章标题
	var content=UE.getEditor('editor').getContent();//编辑器内的html内容
	var content_txt=UE.getEditor('editor').getContentTxt();//编辑器内的纯文本
	var leixing=$("#leixing option:selected").val();//获取的类型值
	var shuliang=$("#shuliang").val();//数量
	var time_start=$("#time_start").val();//数量
	var time_stop=$("#time_stop").val();//数量
	var pinpai=$("#pinpai option:selected").val();//获取的品牌id值
	var is_pinglun=$("#is_pinglun").attr("checked");//是否允许评论
	var pic_name=$("#pic_name").val();//图片标题
	var jianjie=$("#jianjie").val();//文章简介
	var yanzhengma=$("#yanzhengma").val();//验证码
	var bankuai="xuqiu";//设定好为展示发文章板块
	if(name==""){alert("标题不能为空！！");}
	else if(content_txt==""){alert("主要内容不能为空！！");}
	else if(time_start==""){alert("开始时间不能为空！！");}
	else if(time_stop==""){alert("结束时间不能为空！！");}
	else{
      $.post("../../../action/post.php",
      {
	    name:name,
		content:content,
		leixing:leixing,
		shuliang:shuliang,
		time_start:time_start,
		time_stop:time_stop,
		pinpai:pinpai,
		is_pinglun:is_pinglun,
		pic_name:pic_name,
		jianjie:jianjie,
		yanzhengma:yanzhengma,
		bankuai:bankuai
      },
      function(data,status){
        if(data=="用户信息出现错误"){alert("您还未登录，不能发文章。现在自动跳转到登录界面！");location.href="../../../index.php/to/login.html";}
	    else if(!isNaN(data)){alert("需求信息发布成功，自动跳转到发布的文章页");location.href="../../../index.php/to/content2_"+data+".html";}
	    else{alert(data);}
      });
	}
}


function post_content_zixun() {
	var name=$("#name").val();//文章标题
	var content=UE.getEditor('editor').getContent();//编辑器内的html内容
	var content_txt=UE.getEditor('editor').getContentTxt();//编辑器内的纯文本
	var leixing=$("#leixing option:selected").val();//获取的类型值
	var pinpai=$("#pinpai option:selected").val();//获取的品牌id值
	var is_pinglun=$("#is_pinglun").attr("checked");//是否允许评论
	var pic_name=$("#pic_name").val();//图片标题
	var jianjie=$("#jianjie").val();//文章简介
	var yanzhengma=$("#yanzhengma").val();//验证码
	var bankuai="zixun";//设定好为展示发文章板块
	if(name==""){alert("标题不能为空！！");}
	else if(content_txt==""){alert("主要内容不能为空！！");}
	else{
      $.post("../../../action/post.php",
      {
	    name:name,
		content:content,
		leixing:leixing,
		pinpai:pinpai,
		is_pinglun:is_pinglun,
		pic_name:pic_name,
		jianjie:jianjie,
		yanzhengma:yanzhengma,
		bankuai:bankuai
      },
      function(data,status){
        if(data=="用户信息出现错误"){alert("您还未登录，不能发文章。现在自动跳转到登录界面！");location.href="../../../index.php/to/login.html";}
	    else if(!isNaN(data)){alert("新闻资讯文章发布成功，自动跳转到发布的文章页");location.href="../../../index.php/to/content6_"+data+".html";}
	    else{alert(data);}
      });
	}
}

function post_content_xinshang() {
	var name=$("#name").val();//文章标题
	var content=UE.getEditor('editor').getContent();//编辑器内的html内容
	var content_txt=UE.getEditor('editor').getContentTxt();//编辑器内的纯文本
	var pinpai=$("#pinpai option:selected").val();//获取的品牌id值
	var is_pinglun=$("#is_pinglun").attr("checked");//是否允许评论
	var pic_name=$("#pic_name").val();//图片标题
	var jianjie=$("#jianjie").val();//文章简介
	var yanzhengma=$("#yanzhengma").val();//验证码
	var bankuai="xinshang";//设定好为展示发文章板块
	if(name==""){alert("标题不能为空！！");}
	else if(content_txt==""){alert("主要内容不能为空！！");}
	else{
      $.post("../../../action/post.php",
      {
	    name:name,
		content:content,
		pinpai:pinpai,
		is_pinglun:is_pinglun,
		pic_name:pic_name,
		jianjie:jianjie,
		yanzhengma:yanzhengma,
		bankuai:bankuai
      },
      function(data,status){
        if(data=="用户信息出现错误"){alert("您还未登录，不能发文章。现在自动跳转到登录界面！");location.href="../../../index.php/to/login.html";}
	    else if(!isNaN(data)){alert("项目展示发布成功，自动跳转到发布的该项目页");location.href="../../../index.php/to/content5_"+data+".html";}
	    else{alert(data);}
      });
	}
}