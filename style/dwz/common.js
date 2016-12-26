//require jQuery

(function($, owner) {
    
	owner.baseUrl = 'http://www.ezd-express.com/index.php/';
	/**
	 * ajax post
	 **/
        owner.post = function(action,postData,recall){
            $.ajax({
                url: action,
                dataType: "json",
                async: true,
                data: postData,
                type: "post",
                beforeSend: function() {
                    
                },
                success: function(req) {
                    if(req.code == 0){
                        recall(req);
                    }
                    else if(req.code == -1){
                        alert(req.msg);
                    }
                    else if(req.code == -2){
                        alert('登录超时,请重新登录');
                    }
                },
                complete: function() {
                    
                },
                error: function() {
                    alert('网络错误, 请重试');
                }
            });
        };
        

        //处理地址栏参数
        owner.Q = function(name){
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if(r!=null)return  unescape(r[2]); return null;
        }
        
}(jQuery, window.ding = {}));

var regBox = {
    regEmail : /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/,//邮箱
    regName : /^[a-z0-9_-]{3,16}$/,//用户名
    regMobile : /^0?1[3|4|5|8][0-9]\d{8}$/,//手机
    regTel : /^0[\d]{2,3}-[\d]{7,8}$/
}

//dwz表单提交回调处理，tabid是要更新的窗口
function dialogformcallback(data,tabid){
    if(data.code==-1){
        alertMsg.error(data.msg);
    }else if(data.code==0){
        alertMsg.correct(data.data);
        $.pdialog.closeCurrent();
        navTab.reload("", "", [tabid]);
    }else{
        alertMsg.error("操作出错");
    }
}
function tabformcallback(data){
    if(data.code==-1){
        alertMsg.error(data.msg);
    }else if(data.code==0){
        alertMsg.correct(data.data);
        navTab.reload();
    }else{
        alertMsg.error("操作出错");
    }
}

function tabformcallbackGoto(data,tabid){
    if(data.code==-1){
        alertMsg.error(data.msg);
    }else if(data.code==0){
        alertMsg.correct(data.data);
        navTab.closeCurrentTab();
        navTab.reload("", "", [tabid]);
    }else{
        alertMsg.error("操作出错");
    }
}