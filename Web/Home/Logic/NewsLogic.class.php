<?php

namespace Home\Logic;
use Home\Model\UploadModel;
use Home\Model\UserModel;
use Think\Model;

class NewsLogic extends Model
{
    public function getNewsLists($type,$search = array(),$perpage = 10){
        $p =$search['p']? $search['p']:1;
        $where['bankuai']=array('eq',$type);

        $model=D('NewsUserView');
        $Page=getpage($model,$where,$perpage);
        $order = $search['order']?$search['order']:'updatetime desc';
        $list = $model->where($where)->order($order)->page($p, $perpage)->select();
        return array("data" => $list, "page" => $Page->show());
    }

    public function getNewsInfo($newsid){
        $where['id']=array('eq',$newsid);
        $model=D('NewsUserView');
        $return = $model->where($where)->find();
        return $return;
    }

    public function updatePicNewsId($pictures_arr,$newsid){
        $where['url']=array('in',$pictures_arr);
        (new UploadModel())->saveByWhere($where,array('news_id'=>$newsid));
    }


}