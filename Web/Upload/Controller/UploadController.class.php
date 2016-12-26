<?php
namespace Upload\Controller;
use Home\Model\CompanyModel;
use Home\Model\UserModel;
use Space\Controller\BaseController;
use Upload\Logic\UploadLogic;

/**
 * Class TypeConfigController
 * @package Home\Controller
 * 上传管理
 */
class UploadController extends BaseController {

    /**
     * 上传动作接口
     */
    public function uploadPic(){
        $Filedata=$_FILES['Filedata'];
        $user_id=session('user_info')?session('user_info.id'):0;//上传文件名用户id
        $keyword='默认原图';
        $return=(new UploadLogic())->uploadAction($Filedata,$user_id,$keyword);
        is_array ($return)?$this->setjsonReturn($return):$this->errorjsonReturn($return);
    }

    /**
     * 上传动作接口
     */
    public function upload(){
        $Filedata=$_FILES['Filedata'];
        $user_id=session('user_info')?session('user_info.id'):0;//上传文件名用户id
        $keyword='企业logo原图';
        $return=(new UploadLogic())->uploadAction($Filedata,$user_id,$keyword);
        is_array ($return)?$this->setjsonReturn($return):$this->errorjsonReturn($return);
    }

    /**
     * 上传头像接口
     */
    public function uploadUser(){
        $Filedata=$_FILES['Filedata'];
        $user_id=session('user_info')?session('user_info.id'):0;//上传文件名用户id
        $keyword='用户头像原图';
        $return=(new UploadLogic())->uploadAction($Filedata,$user_id,$keyword);
        is_array ($return)?$this->setjsonReturn($return):$this->errorjsonReturn($return);
    }

    /**
     * 裁剪logo接口
     */
    public function cutaction(){
        $post=I('post.');
        $user_id=session('user_info')?session('user_info.id'):0;
        $return=(new UploadLogic())->cutPicAction($post,$user_id,'企业logo');
        if(is_array ($return)){
            //下面保存企业的logo信息
            $array['user_id']=session('user_info.id');
            $array['logo_path']=$return['path'];
            (new CompanyModel())->addOrSaveByUserid($array);
            $info['url']='http://'.$_SERVER['HTTP_HOST'].$return['path'];
            $this->setjsonReturn($info);
        }else{
            $this->errorjsonReturn($return);
        }
    }

    /**
     * 裁剪头像接口
     */
    public function cutUserAction(){
        $post=I('post.');
        $user_id=session('user_info')?session('user_info.id'):0;
        $return=(new UploadLogic())->cutPicAction($post,$user_id,'企业logo');
        if(is_array ($return)){
            //下面保存用户头像信息
            $array['id']=session('user_info.id');
            $array['headerpic']=$return['path'];
            (new UserModel())->addOrSave($array);
            $info['url']='http://'.$_SERVER['HTTP_HOST'].$return['path'];
            $this->setjsonReturn($info);
        }else{
            $this->errorjsonReturn($return);
        }
    }
}