<?php
namespace Home\Controller;

use Home\Logic\NewsLogic;
use Home\Model\NewsModel;
use Home\Model\TypeConfigModel;
use Think\Controller;
class PublicController extends BaseController {

    public function __construct() {
        parent::__construct();
        if(session('user_info')){
            $user_info = session('user_info');
            $this->user_info=$user_info;
        }else{
            redirect(U('Home/Login/login'));
        }
    }

    public function selectType(){
        $typeConfig=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用石材类型'));
        $typeCreate=commonAdminMenu($typeConfig);
        $this->assign('typeCreate',$typeCreate);
        $this->display();
    }

    public function selectShebeiType(){
        $typeConfig=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用设备类型'));
        $typeCreate=commonAdminMenu($typeConfig);
        $this->assign('typeCreate',$typeCreate);
        $this->display();
    }

    public function publicStone(){
        if(IS_POST){
            $array=I('post.');
            $array['common_type']=$array['common_type_1'].C('Separator').$array['common_type_2'];
            $array['bankuai']='gongying';
            $array['user_id']=$this->user_info['id'];
            $return=(new NewsModel())->addOrSave($array);
            if($return===false){
                $this->errorjsonReturn('操作失败');
            }else{
                $content=$array['content'];
                //下面是删除编辑器中没用的图片
                (new NewLogic())->picDelOrSet($content,$return);
                $this->setjsonReturn('操作成功');
            }
        }else{
            if(I('get.type')){
                //验证是不是石材类型的
                $stoneTypeInfo=(new TypeConfigModel())->findByWhere(array('id'=>I('get.type'),'keyword'=>'公用石材类型'));
                if(empty($stoneTypeInfo)){exit('非法操作');}
                $this->assign('stoneTypeInfo',$stoneTypeInfo);
                $configTypeColor=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用石材颜色','fatherid'=>0));
                $this->assign('configTypeColor',$configTypeColor);

            }elseif(I('get.newid')){

            }else{
                exit('非法操作');
            }
            $this->display();
        }
    }

    public function publicShebei(){
        if(IS_POST){
            $array=I('post.');
            $array['common_type']=$array['common_type_1'].C('Separator').$array['common_type_2'];
            $array['bankuai']='gongying';
            $array['user_id']=$this->user_info['id'];
            $return=(new NewsModel())->addOrSave($array);
            if($return===false){
                $this->errorjsonReturn('操作失败');
            }else{
                $content=$array['content'];
                //下面是删除编辑器中没用的图片
                (new NewLogic())->picDelOrSet($content,$return);
                $this->setjsonReturn('操作成功');
            }
        }else{
            if(I('get.type')){
                //验证是不是设备类型的
                $shebeiTypeInfo=(new TypeConfigModel())->findByWhere(array('id'=>I('get.type'),'keyword'=>'公用设备类型'));
                if(empty($shebeiTypeInfo)){exit('非法操作');}
                $this->assign('stoneTypeInfo',$shebeiTypeInfo);
            }elseif(I('get.newid')){

            }else{
                exit('非法操作');
            }
            $this->display();
        }
    }

    public function publicNews(){
        if(IS_POST){
            $array=I('post.');
            $array['common_type']=$array['common_type_1'].C('Separator').$array['common_type_2'];
            $array['bankuai']='gongying';
            $array['user_id']=$this->user_info['id'];
            $return=(new NewsModel())->addOrSave($array);
            if($return===false){
                $this->errorjsonReturn('操作失败');
            }else{
                $content=$array['content'];
                //下面是删除编辑器中没用的图片
                (new NewLogic())->picDelOrSet($content,$return);
                $this->setjsonReturn('操作成功');
            }
        }else{
            //验证是不是设备类型的
            $configTypeInfo=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用新闻类型'));
            $this->assign('configTypeInfo',$configTypeInfo);

            $this->display();
        }
    }

    public function publicZhanshi(){
        if(IS_POST){
            $array=I('post.');
            if(!(new TypeConfigModel())->validPublicType($array['common_type'],'公用展示类型')){
                $this->errorjsonReturn('栏目错误');
            }
            $pictures_arr=array_filter(explode('/n',$array['pictures']));
            if(empty($pictures_arr)){$this->errorjsonReturn('请上传图片');}
            $array['bankuai']='zhanshi';
            $array['user_id']=$this->user_info['id'];
            $array['address']=$array['province'].C('Separator').$array['city'].C('Separator').$array['country'].C('Separator').$array['street'];
            $array['pic_name']=$pictures_arr[0];
            $return=(new NewsModel())->addOrSave($array);
            if($return===false){
                $this->errorjsonReturn('操作失败');
            }else{
                //下面将上传的图片全部生效
                (new NewsLogic())->updatePicNewsId($pictures_arr,$return);
                $this->setjsonReturn($return);
            }
        }else{
            //验证是不是设备类型的
            if(I('get.newsid')){
                $info=(new NewsModel())->findByWhere(array('id'=>I('get.newsid')));
                $info['address']=explode(C('Separator'),$info['address']);
                $info['province']=$info['address'][0];
                $info['city']=$info['address'][1];
                $info['country']=$info['address'][2];
                $info['street']=$info['address'][3];
                $this->assign('info',$info);
                $this->assign('picture_arr',array_filter(explode('/n',$info['pictures'])));
            }
            $configTypeInfo=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用展示类型'));
            $this->assign('configTypeInfo',$configTypeInfo);
            $this->display();
        }
    }

    public function publicXuqiu(){
        if(IS_POST){
            $array=I('post.');
            $array['common_type']=$array['common_type_1'].C('Separator').$array['common_type_2'];
            $array['bankuai']='gongying';
            $array['user_id']=$this->user_info['id'];
            $return=(new NewsModel())->addOrSave($array);
            if($return===false){
                $this->errorjsonReturn('操作失败');
            }else{
                $content=$array['content'];
                //下面是删除编辑器中没用的图片
                (new NewLogic())->picDelOrSet($content,$return);
                $this->setjsonReturn('操作成功');
            }
        }else{
            //验证是不是设备类型的
            if(I('get.type')){
                //验证是不是设备类型的
                $shebeiTypeInfo=(new TypeConfigModel())->findByWhere(array('id'=>I('get.type'),'keyword'=>'公用设备类型'));
                if(empty($shebeiTypeInfo)){exit('非法操作');}
                $this->assign('stoneTypeInfo',$shebeiTypeInfo);
            }elseif(I('get.newid')){

            }else{
                exit('非法操作');
            }
            $this->display();
        }
    }


    public function publicSuccess(){
        $url1=$url2='';
        $newInfo=(new NewsModel())->findByWhere(array('id'=>I('newsid')));
        if($newInfo['bankuai']=='zhanshi'){
            $url1=U('Home/Zhanshi/content',array('id'=>I('newsid')));
            $url2=U('Home/Public/publicZhanshi');
        }
        $this->assign('url1',$url1);
        $this->assign('url2',$url2);
        $this->display();
    }
}