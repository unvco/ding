<?php

namespace Home\Model;
use Think\Model\ViewModel;

class UserCompanyViewModel extends ViewModel
{
    public $viewFields = array(
        'company'=>array('id','user_id','name','jingying','xingzhi','moshi','faren','renshu','birthday','money_year','chanpin','content','look_num','area','register_money','createtime','updatetime','logo_path'),
        'user'=>array('name'=>'user_name','truename'=>'user_truename','sex'=>'user_sex','headerpic'=>'user_headerpic','idcard'=>'user_idcard','type'=>'user_type','email'=>'user_email','qq'=>'user_qq','mobile'=>'user_mobile','openid'=>'user_openid','qqid'=>'user_qqid','weixinid'=>'user_weixinid','lastlogintime'=>'user_lastlogintime','startlogintime'=>'user_startlogintime','updatetime'=>'user_updatetime','regtime'=>'user_regtime','isonline'=>'user_isonline','address'=>'user_address','address_detail'=>'user_address_detail','locx'=>'user_locx','locy'=>'user_locy','birthday'=>'user_birthday','register_ip'=>'user_register_ip','login_ip'=>'user_login_ip','is_vip'=>'user_is_vip','is_shenhe'=>'user_is_shenhe','is_renzheng'=>'user_is_renzheng','_on'=>'user.id=company.user_id')
    );
}