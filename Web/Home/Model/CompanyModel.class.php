<?php

namespace Home\Model;

use Think\Model;


class CompanyModel extends Model
{

    /**
     * 添加或者修改数据
     * @param array $post
     * @return bool
     */
    public function addOrSaveByUserid($post=array()){
        $post['updatetime']=time();
        $info=$this->where(array('user_id'=>$post['user_id']))->find();
        if($info){
            $return=$this->where(array('user_id'=>$post['user_id']))->save($post);
        }else{
            $post['createtime']=time();
            $return=$this->add($post);
        }
        return $return?$return:false;
    }

    /**
     * 添加或者修改数据
     * @param array $post
     * @return bool
     */
    public function addOrSave($post=array()){
        $post['updatetime']=time();
        if($post['id']){
            $return=$this->save($post);
        }else{
            $post['createtime']=time();
            $return=$this->add($post);
        }
        return $return?$return:false;
    }

    /**
     * @param array $where
     * @return bool|mixed
     */
    public function findByWhere($where){
        $userInfo=$this->where($where)->find();
        if($userInfo){
            return $userInfo;
        }else{
            return false;
        }
    }


    public function delectById($id){
        if($this->where(array('id'=>$id))->delete()){
            return true;
        }else{
            return false;
        }
    }


    function saveByWhere($where,$save){
        $save['updatetime']=time();
        return $this->where($where)->save($save);
    }

    function selectByLimit($where,$num,$order='id desc'){
        $return=$this->where($where)->order($order)->limit($num)->select();
        return $return;
    }


}