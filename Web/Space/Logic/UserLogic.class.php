<?php

namespace Space\Logic;

use Home\Model\UserModel;
use Think\Model;


class UserLogic extends Model
{
    public function checkpassword($password,$id){
        $userInfo=(new UserModel())->findByWhere(array('id'=>$id));
        if($userInfo['password']==$password){
            return true;
        }else{
            return false;
        }
    }
}