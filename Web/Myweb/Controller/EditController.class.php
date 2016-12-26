<?php
namespace Myweb\Controller;
use Home\Model\UserConfigModel;
use Upload\Logic\UploadLogic;

class EditController extends BaseController {
    public function setPicByAction(){
        $action=I('get.action');
        if(self::checkAction($action)===false){exit('请正确操作');}
        $this->assign('action',$action);
        $this->display();
    }

    public function uploadSetPicAction(){
        $action=I('post.action');
        if(self::checkAction($action)===false){$this->errorjsonReturn('请正确操作');}
        $Filedata=$_FILES['Filedata'];
        $user_id=session('user_info.id');//上传文件名用户id
        $return=(new UploadLogic())->uploadAction($Filedata,$user_id,$action);
        if(is_array ($return)){
            $configReturn=(new UserConfigModel())->addOrSaveByKeyword(array('user_id'=>$user_id,'keyword'=>$action,'value'=>$return['url']));
            $configReturn===false?$this->errorjsonReturn('添加数据出错'):$this->setjsonReturn($return);
        }else{
            $this->errorjsonReturn($return);
        }
    }

    public function setIntroduceOne(){
        if(IS_POST){
            $post=I('post.');
            $keyword='default模板首页介绍1';
            $value=serialize($post);
            $user_id=session('user_info.id');
            $return=(new UserConfigModel())->addOrSaveByKeyword(array('user_id'=>$user_id,'keyword'=>$keyword,'value'=>$value));
            $return===false?$this->errorjsonReturn('操作出错'):$this->setjsonReturn($return);
        }else{
            $userConfig=(new UserConfigModel())->findByWhere(array('user_id'=>session('user_info.id'),'keyword'=>'default模板首页介绍1'));
            $this->assign('setIntroduceOne',unserialize($userConfig['value']));
            $this->display();
        }
    }

    public function setIntroduceTwo(){
        if(IS_POST){
            $value=I('post.content');
            $keyword='default模板首页介绍2';
            $user_id=session('user_info.id');
            $return=(new UserConfigModel())->addOrSaveByKeyword(array('user_id'=>$user_id,'keyword'=>$keyword,'value'=>$value));
            $return===false?$this->errorjsonReturn('操作出错'):$this->setjsonReturn($return);
        }else{
            $userConfig=(new UserConfigModel())->findByWhere(array('user_id'=>session('user_info.id'),'keyword'=>'default模板首页介绍2'));
            $this->assign('value',$userConfig['value']);
            $this->display();
        }
    }

    public function setIntroduceThree(){
        if(IS_POST){
            $post=I('post.');
            $keyword='default模板首页介绍3';
            $value=serialize($post);
            $user_id=session('user_info.id');
            $return=(new UserConfigModel())->addOrSaveByKeyword(array('user_id'=>$user_id,'keyword'=>$keyword,'value'=>$value));
            $return===false?$this->errorjsonReturn('操作出错'):$this->setjsonReturn($return);
        }else{
            $userConfig=(new UserConfigModel())->findByWhere(array('user_id'=>session('user_info.id'),'keyword'=>'default模板首页介绍3'));
            $this->assign('setIntroduceThree',unserialize($userConfig['value']));
            $this->display();
        }
    }

    static function checkAction($action){
        $action_arr=array('default网站背景','default模板顶部广告','default模板中部广告','default编辑尾部广告');
        if(!in_array($action,$action_arr)){
            return false;
        }else{
            return true;
        }
    }
}