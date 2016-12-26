<?php

namespace Home\Model;
use Think\Model;


class UploadModel extends Model
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
            $post['createtime']=time();
            $return=$this->add($post);
        }
        return $return?$return:false;
    }

    public function selectByWhere($where){
        $userInfo=$this->where($where)->select();
        if($userInfo){
            return $userInfo;
        }else{
            return false;
        }
    }

    function deleteByWhere($where=array()){
        if(!$where){return false;}
        return $this->where($where)->delete()?true:false;
    }

    function saveByWhere($where,$save){
        $save['updatetime']=time();
        return $this->where($where)->save($save);
    }

}