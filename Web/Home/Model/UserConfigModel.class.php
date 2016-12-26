<?php

namespace Home\Model;

use Think\Model;


class UserConfigModel extends Model
{

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
     * 通过关键字 添加或者修改数据
     * @param array $post
     * @return bool
     */
    public function addOrSaveByKeyword($post=array()){
        $userConfig=(new UserConfigModel())->findByWhere(array('user_id'=>$post['user_id'],'keyword'=>$post['keyword']));
        $post['updatetime']=time();
        if($userConfig){
            $return=$this->where(array('user_id'=>$post['user_id'],'keyword'=>$post['keyword']))->save($post);
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

    /**
     * @param array $where
     * @return bool|mixed
     */
    public function selectByWhere($where){
        $userInfo=$this->where($where)->select();
        if($userInfo){
            return $userInfo;
        }else{
            return false;
        }
    }



}