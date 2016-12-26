<?php

namespace Myweb\Logic;
use Home\Model\NewsModel;

class NewsLogic
{
    public function lists($bankuans,$post=array()){
        $where['bankuai']=array('in',$bankuans);
        $lists=(new NewsModel())->selectByWhere($where);
        return $lists;
    }


    public function getZhanshiList($get,$perpage=10){
        $p =$get['p']? $get['p']:1;
        $where=array();
        $where['user_id']=array('eq',$get['userid']);

        $model=D('Home/News');
        $Page=getpage($model,$where,$perpage);
        $order = $get['order']?$get['order']:'updatetime desc';
        $list = $model->where($where)->order($order)->page($p, $perpage)->select();

        foreach($list as $k=>$value){
            $pic_arr=array_filter(explode('/n',$value['pictures']));
            $list[$k]['pic_num']=count($pic_arr);
            $list[$k]['pic_arr']=$pic_arr;
        }
        return array("data" => $list, "page" => $Page->show());
    }

}