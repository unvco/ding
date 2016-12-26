<?php
namespace Space\Controller;


use Home\Model\UserIntroduceModel;
use Home\Model\UserModel;
use Space\Logic\UserLogic;

class UserController extends BaseController {
    /**
     * 进入首页
     */
    public function index(){
        $this->display();
    }
    /**
     * 自己的编辑界面
     */
    public function myInfo(){
        if(IS_POST){
            $array=I('post.');
            if($array['birthday']){$array['birthday']=strtotime($array['birthday']);}
            $array['address']=$array['province'].C('Separator').$array['city'].C('Separator').$array['country'].C('Separator').$array['street'];
            $return=(new UserModel())->addOrSave($array);
            $return===false?$this->errorjsonReturn('操作失败'):$this->setjsonReturn('操作成功');
        }else{
            $userInfo = (new UserModel())->findByWhere(array('id'=>$this->user_info['id']));
            $userInfo['address']=explode(C('Separator'),$userInfo['address']);
            $this->assign('userInfo',$userInfo);
            $this->display();
        }
    }



    /**
     * 修改网站模板
     */
    public function muban(){
        if(IS_POST){
            $array=I('post.');
            $array['id']=$this->user_info['id'];
            $return=(new UserModel())->addOrSave($array);
            $return===false?$this->errorjsonReturn('操作失败'):$this->setjsonReturn('操作成功');
        }else{
            $userInfo = (new UserModel())->findByWhere(array('user_id'=>$this->user_info['id']));
            $this->assign('userInfo',$userInfo);
            $this->display();
        }
    }

    /**
     * 修改密码
     */
    public function editPassword(){
        if(IS_POST){
            $array=I('post.');
            $checkPassword=(new UserLogic())->checkpassword(I('post.old_password'),$this->user_info['id']);
            if($checkPassword===true){
                $array['id']=$this->user_info['id'];
                $array['password']=I('post.password');
                $return=(new UserModel())->addOrSave($array);
                $return===false?$this->errorjsonReturn('操作失败'):$this->setjsonReturn('操作成功');
            }else{
                $this->errorjsonReturn('您填写的密码不正确');
            }
        }else{
            $this->display();
        }
    }

    public function cutUserPicIndex(){
        $this->display();
    }

    public function cutUserPic(){
        $info = (new UserModel())->findByWhere(array('id'=>$this->user_info['id']));
        $this->assign('info',$info);
        $this->display();
    }




}