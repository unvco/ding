<?php

namespace Space\Logic;



use Home\Model\TypeConfigModel;

class ConfigLogic
{

    function selectTypeByKeyword($keyword,$user_id){
        $info=(new TypeConfigModel())->selectByWhere(array('keyword'=>$keyword,'user_id'=>$user_id));
        return $info;
    }


    function customerList($array=array(),$user_id){
        if($array['name']){$where["name"]  = array('like','%'.$array["name"].'%');}
        if($array['createtime_date']){
            $where["createtime"]  = array('between',array(splitDate($array['createtime_date'])[0],splitDate($array['createtime_date'])[1]));
        }
        $where["user_id"] = array('eq',$user_id);//创建人

        switch ($array['bankuai'])
        {
            case 'gongying':
                $keyword='石材类型';
                break;
            case 'shebei':
                $keyword='设备类型';
                break;
            case 'zhanhui':
                $keyword='展会分类';
                break;
            case 'zhanshi':
                $keyword='展示分类';
                break;
            case 'xuqiu':
                $keyword='需求分类';
                break;
            case 'xinwen':
                $keyword='新闻分类';
                break;
            default:
                $keyword='新闻分类';
        }
        $where["keyword"] = array('eq',$keyword);//类型为石材类型

        $p = $array['p'] ? $array['p'] : 1 ;  //获得页码

        return (new TypeConfigModel())->configList($where,$p);
    }
}