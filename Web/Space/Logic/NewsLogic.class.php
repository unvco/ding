<?php

namespace Space\Logic;




use Home\Model\NewsModel;

class NewsLogic
{
    function newsList($array=array(),$user_id){
        if($array['name']){$where["name"]  = array('like','%'.$array["name"].'%');}
        if($array['bankuai']){$where["bankuai"]  = array('eq',$array['bankuai']);}
        if($array['createtime_date']){
            $where["createtime"]  = array('between',array(splitDate($array['createtime_date'])[0],splitDate($array['createtime_date'])[1]));
        }
        $where["user_id"] = array('eq',$user_id);//创建人

        $p = $array['p'] ? $array['p'] : 1 ;  //获得页码

        return (new NewsModel())->newsList($where,$p);
    }
}