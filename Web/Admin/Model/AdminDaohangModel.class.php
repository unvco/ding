<?php

namespace Admin\Model;
use Think\Model;

/**
 * 后台导航模型
 * Class AdminDaohangModel
 * @package Home\Model
 */
class AdminDaohangModel extends model
{

    /**
     * 根据id获取基本信息
     * @param $id
     * @return mixed|null
     */
    function getInfoById($id){
        $info=NULL;
        if($id){
            $info=$this->where('id=%d',$id)->find();
            $info['fatheridName']=$info['fatherid']==0?"顶级导航":$this->where('id=%d',$info['fatherid'])->getField('name');
        }
        return $info;
    }




    /**
     * 添加或者修改数据
     * @param array $post
     * @return bool
     */
    function addOrSave($post=array()){
        $post['createtime']=time();
        if($post['id']){
            return $this->save($post)?true:false;
        }else{
            return $this->add($post)?true:false;
        }
    }

    /**
     * 根据where条件查找相关的数据
     * 返回多条数据
     * @param array $where
     * @return mixed
     */
    function selectByWhere($where=array()){
        return $this->where($where)->select();
    }

    /**
     * 根据where条件查找相关的数据
     * 返回一条数据
     * @param $id
     * @return mixed
     */
    function findByWhere($id){
        return $this->where('id=%d',$id)->find();;
    }


    /**
     * 根据条件删除相关数据
     * @param array $where
     * @return bool
     */
    function deleteById($where=array()){
        if(!$where){return false;}
        return $this->where($where)->delete()?true:false;
    }
}