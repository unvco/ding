<?php

namespace Home\Model;
use Think\Model\ViewModel;

class NewsUserViewModel extends ViewModel
{
    public $viewFields = array(
        'news'=>array('id','user_id','name','type','common_type','bankuai','pic_name','stone_color','chandi','price','pictures','content','look_num','good_num','bad_num','is_shenhe','createtime','updatetime','starttime','stoptime','_type'=>'LEFT'),
        'user'=>array('name'=>'user_name','truename'=>'user_truename','sex'=>'user_sex','headerpic'=>'user_headerpic','idcard'=>'user_idcard','type'=>'user_type','email'=>'user_email','qq'=>'user_qq','mobile'=>'user_mobile','openid'=>'user_openid','qqid'=>'user_qqid','weixinid'=>'user_weixinid','lastlogintime'=>'user_lastlogintime','startlogintime'=>'user_startlogintime','updatetime'=>'user_updatetime','regtime'=>'user_regtime','isonline'=>'user_isonline','address'=>'user_address','address_detail'=>'user_address_detail','locx'=>'user_locx','locy'=>'user_locy','birthday'=>'user_birthday','register_ip'=>'user_register_ip','login_ip'=>'user_login_ip','is_vip'=>'user_is_vip','is_shenhe'=>'user_is_shenhe','is_renzheng'=>'user_is_renzheng','_on'=>'user.id=news.user_id'),
        'company'=>array('name'=>'company_name','jingying'=>'company_jingying','xingzhi'=>'company_xingzhi','moshi'=>'company_moshi','faren'=>'company_faren','renshu'=>'company_renshu','birthday'=>'company_birthday','money_year'=>'company_money_year','chanpin'=>'company_chanpin','content'=>'company_content','look_num'=>'company_look_num','area'=>'company_area','register_money'=>'company_register_money','createtime'=>'company_createtime','updatetime'=>'company_updatetime','logo_path'=>'company_logo_path','_on'=>'company.user_id=news.user_id')
    );
}