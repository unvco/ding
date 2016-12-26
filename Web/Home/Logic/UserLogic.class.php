<?php

namespace Home\Logic;
use Home\Model\UserModel;
use Think\Model;


class UserLogic extends Model
{
    public function getCompanyLists($search = array(),$perpage = 10){
        $p =$search['p']? $search['p']:1;

        $where=array();
        $model=D('UserCompanyView');
        $Page=getpage($model,$where,$perpage);
        $order = $search['order']?$search['order']:'updatetime desc';
        $list = $model->where($where)->order($order)->page($p, $perpage)->select();
        return array("data" => $list, "page" => $Page->show());
    }

    public function getJingjirenLists($search = array(),$perpage = 10){
        $p =$search['p']? $search['p']:1;
        $where=array();
        $model=D('User');
        $where['type']=array('eq','经纪人');
        $Page=getpage($model,$where,$perpage);
        $order = $search['order']?$search['order']:'updatetime desc';
        $list = $model->where($where)->order($order)->page($p, $perpage)->select();
        return array("data" => $list, "page" => $Page->show());
    }

    public function getShejishiLists($search = array(),$perpage = 10){
        $p =$search['p']? $search['p']:1;
        $where=array();
        $model=D('User');
        $where['type']=array('eq','设计师');
        $Page=getpage($model,$where,$perpage);
        $order = $search['order']?$search['order']:'updatetime desc';
        $list = $model->where($where)->order($order)->page($p, $perpage)->select();
        return array("data" => $list, "page" => $Page->show());
    }

    /**
     * 登陆逻辑
     * @param $username
     * @param $password
     * @return bool|string
     */
    public function login($username,$password){
        $userInfo=(new UserModel())->findByWhere(array('name'=>$username));
        if($userInfo===false){
            return '用户不存在';
        }else{
            if($userInfo['password']==$password){
                $userInfo['startlogintime']=time();
                $userInfo['isonline']=1;
                $userInfo['login_ip']=get_client_ip();
                if((new UserModel())->addOrSave($userInfo)===false){
                    return '登陆失败，请重试';
                }else{
                    session('user_info',$userInfo);
                    return true;
                }
            }else{
                return '密码不正确';
            }
        }
    }


    /**
     * 注册逻辑
     * @param $username
     * @param $password
     * @param $email
     * @return string
     */
    public function register($username,$password,$email){
        $where=array('name'=>$username, 'email'=>$email, '_logic'=>'or');
        $userInfo=(new UserModel())->findByWhere($where);
        if($userInfo===false){
            $array=array('name'=>$username,'password'=>$password,'email'=>$email,'regtime'=>time(),
                'startlogintime'=>time(),'isonline'=>1,'login_ip'=>get_client_ip(),'register_ip'=>get_client_ip());
            $return=(new UserModel())->addOrSave($array);
            if($return===false){
                return '注册失败，请重试';
            }else{
                $array['id']=$return;
                session('user_info',$array);
                return true;
            }
        }else{
            if($userInfo['name']==$username){
                return '用户名已存在';
            }elseif($userInfo['email']==$email){
                return '邮箱已经被注册';
            }else{
                return '用户存在';
            }
        }
    }
}