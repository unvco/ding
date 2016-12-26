$(function (){
	initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '44', '0', '0');
});

//得到地区码
function getAreaID(){
	var area = 0;          
	if($("#seachdistrict").val() != "0"){
		area = $("#seachdistrict").val();                
	}else if ($("#seachcity").val() != "0"){
		area = $("#seachcity").val();
	}else{
		area = $("#seachprov").val();
	}
	return area;
}

function showAreaID() {
	//地区码
	var areaID = getAreaID();
	//地区名
	var areaName = getAreaNamebyID(areaID) ;
	//网站网址
	var qiye_http=$("#qiye_http").val();
	//企业名称
	var name=$("#name").val();
	//用户qq
	var qq=$("#qq").val();
	//用户邮箱
	var email=$("#email").val();
	//邮编
	var youbian=$("#youbian").val();
	//手机
	var shouji=$("#shouji").val();
	//企业logo
	var touxiang=$("#yonghu_touxiang").val();
	//验证码
	var yanzhengma=$("#yanzhengma").val();
	//地址
	if(name==""){alert("企业名称不能为空");}
	else if(qq==""){alert("qq不能为空");}
	else if(email==""){alert("邮箱不能为空");}
	else if(youbian==""){alert("邮编不能为空");}
	else if(shouji==""){alert("手机号不能为空");}
	else if(touxiang==""){alert("请编辑头像");}
	else if(yanzhengma==""){alert("验证码不能为空");}
	else{
		if(areaName=="广东省"){
	    var dizhi=$("#dizhi").val();
	    }else{
	    var dizhi=areaName;
	    }
	    //地址详细
	    var dizhi_xiangxi=$("#dizhi_xiangxi").val();
	    var jieshao=UE.getEditor('editor').getContent();//编辑器内的html内容
	    var jieshao_txt=UE.getEditor('editor').getContentTxt();//编辑器内的纯文本
	    var lianxi=UE.getEditor('editor1').getContent();//编辑器内的html内容
	    var lianxi_txt=UE.getEditor('editor1').getContentTxt();//编辑器内的纯文本
	    //利用post传递参数
        $.post(qiye_http+"/action/post.php",
        {
	    name:name,
	    qq:qq,
	    email:email,
	    youbian:youbian,
	    shouji:shouji,
	    touxiang:touxiang,
	    dizhi:dizhi,
	    dizhi_xiangxi:dizhi_xiangxi,
	    jieshao:jieshao,
	    lianxi:lianxi,
	    yanzhengma:yanzhengma
        },
        function(data,status){
           if(data=="用户信息出现错误"){alert(data);}
	       else if(data=="信息写入成功"){alert(data);}
	       else{alert(data);}
        });
	}
	
}

//根据地区码查询地区名
function getAreaNamebyID(areaID){
	var areaName = "";
	if(areaID.length == 2){
		areaName = area_array[areaID];
	}else if(areaID.length == 4){
		var index1 = areaID.substring(0, 2);
		areaName = area_array[index1] + " " + sub_array[index1][areaID];
	}else if(areaID.length == 6){
		var index1 = areaID.substring(0, 2);
		var index2 = areaID.substring(0, 4);
		areaName = area_array[index1] + " " + sub_array[index1][index2] + " " + sub_arr[index2][areaID];
	}
	return areaName;
}