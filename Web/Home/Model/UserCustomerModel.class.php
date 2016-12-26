<?php

namespace Home\Model;
use Think\Model;


class UserCustomerModel extends Model
{
    public function customerList($where,$p=1,$perpage=10){
        $count = $this->where($where)->count();
        $Page = new \Think\Page($count,$perpage);
        $list = $this->where($where)->Page($p,$perpage)->order('updatetime desc')->select();

        $return[0] = $list;             //信息列表
        $return[1] = $Page->show();     //分页信息
        return $return;
    }


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

    public function delectById($id){
        if($this->where(array('id'=>$id))->delete()){
            return true;
        }else{
            return false;
        }
    }

}