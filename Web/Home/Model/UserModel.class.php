<?php

namespace Home\Model;
use Think\Model;


class UserModel extends Model
{
    public function findByWhere($where){
        $userInfo=$this->where($where)->find();
        if($userInfo){
            return $userInfo;
        }else{
            return false;
        }
    }

    public function addOrSave($post=array()){
        $post['updatetime']=time();
        if($post['id']){
            $return=$this->save($post);
        }else{
            $return=$this->add($post);
        }
        return $return?$return:false;
    }

    function selectByLimit($where,$num,$order='id desc'){
        $return=$this->where($where)->order($order)->limit($num)->select();
        return $return;
    }



}