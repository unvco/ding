<?php
namespace Home\Controller;
use Home\Model\NewsModel;
use Think\Controller;
class NewsapiController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    //获取设计师最新的一篇设计
    public function getShejishiOneContent($newid){
        $info=(new NewsModel())->where(array('user_id'=>$newid,'bankuai'=>'zhanshi'))->order('id desc')->find();
        if(empty($info)){$this->errorjsonReturn('数据错误');}
        $info['pictures']=array_filter(explode('/n',$info['pictures']));
        $this->setjsonReturn($info);
    }
}