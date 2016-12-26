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
}