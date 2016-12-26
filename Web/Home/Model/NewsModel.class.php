<?php

namespace Home\Model;

use Think\Model;


class NewsModel extends Model
{

    public function newsList($where,$p=1,$perpage=10){
        $count = $this->where($where)->count();
        $Page = new \Think\Page($count,$perpage);
        $list = $this->where($where)->Page($p,$perpage)->order('updatetime desc')->select();

        $return[0] = $list;             //信息列表
        $return[1] = $Page->show();     //分页信息
        return $return;
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
            if($return!==false){
                return $post['id'];
            }else{
                return false;
            }
        }else{
            $post['createtime']=time();
            $return=$this->add($post);
            return $return?$return:false;
        }
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