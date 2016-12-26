<?php
namespace Space\Controller;


use Home\Model\NewsModel;
use Home\Model\TypeConfigModel;
use Space\Logic\ConfigLogic;
use Space\Logic\NewsLogic;
use Upload\Logic\NewLogic;

class NewsController extends BaseController {

    public function gongying(){
        $this->display();
    }
    public function shebei(){
        $this->display();
    }
    public function zhanshi(){
        $this->display();
    }
    public function xuqiu(){
        $this->display();
    }
    public function xinwen(){
        $this->display();
    }
    public function zhanhui(){
        $this->display();
    }


    public function gongyingTable(){
        $this->table('gongying');
    }
    public function shebeiTable(){
        $this->table('shebei');
    }
    public function zhanshiTable(){
        $this->table('zhanshi');
    }
    public function xuqiuTable(){
        $this->table('xuqiu');
    }
    public function xinwenTable(){
        $this->table('xinwen');
    }
    public function zhanhuiTable(){
        $this->table('zhanhui');
    }

    public function table($bankuai='xinwen'){
        $get=I('get.');
        $get['bankuai']=$bankuai;
        $result = (new NewsLogic())->newsList($get,$this->user_info['id']);
        $this->assign('list', $result[0]);
        $this->assign('pageBar', $result[1]);
        $this->display($bankuai.'Table');
    }


    public function gongyingAdd(){
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
            $configCommonType=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用石材类型','fatherid'=>0));
            $this->assign('configCommonType',$configCommonType);
            $configTypeColor=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用石材颜色','fatherid'=>0));
            $this->assign('configTypeColor',$configTypeColor);
            if(I('get.id')){
                $newInfo = (new NewsModel())->findByWhere(array('id'=>I('get.id')));
                $common_type=explode(C('Separator'),$newInfo['common_type']);
                $newInfo['common_type_1']=html_entity_decode($common_type[0]);
                $newInfo['common_type_2']=html_entity_decode($common_type[1]);

                $this->assign('newInfo',$newInfo);
            }
            $configType=(new ConfigLogic())->selectTypeByKeyword('石材类型',$this->user_info['id']);
            $this->assign('configType',$configType);
            $this->display();
        }
    }


    public function shebeiAdd(){
        if(IS_POST){
            $array=I('post.');
            $array['common_type']=$array['common_type_1'].C('Separator').$array['common_type_2'];
            $array['bankuai']='shebei';
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
            $configCommonType=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用设备类型','fatherid'=>0));
            $this->assign('configCommonType',$configCommonType);
            if(I('get.id')){
                $newInfo = (new NewsModel())->findByWhere(array('id'=>I('get.id')));
                $common_type=explode(C('Separator'),$newInfo['common_type']);
                $newInfo['common_type_1']=html_entity_decode($common_type[0]);
                $newInfo['common_type_2']=html_entity_decode($common_type[1]);
                $this->assign('newInfo',$newInfo);
            }
            $configType=(new ConfigLogic())->selectTypeByKeyword('设备类型',$this->user_info['id']);
            $this->assign('configType',$configType);
            $this->display();
        }
    }
    public function zhanshiAdd(){
        $this->add('zhanshi','展示分类');
    }
    public function xuqiuAdd(){
        if(IS_POST){
            $array=I('post.');
            $array['common_type']=$array['common_type_0'].C('Separator').$array['common_type_1'].C('Separator').$array['common_type_2'];
            $array['bankuai']='xuqiu';
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
            if(I('get.alltype')==1){
                $configCommonType=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用石材类型','fatherid'=>0));
                $this->assign('alltype','石材');
            }elseif(I('get.alltype')==2){
                $configCommonType=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用设备类型','fatherid'=>0));
                $this->assign('alltype','设备');
            }
            $this->assign('configCommonType',$configCommonType);
            if(I('get.id')){
                $newInfo = (new NewsModel())->findByWhere(array('id'=>I('get.id')));
                if(strpos($newInfo['common_type'], '石材'.C('Separator')) !== false){
                    $configCommonType=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用石材类型','fatherid'=>0));
                    $this->assign('alltype','石材');
                }elseif(strpos($newInfo['common_type'], '设备'.C('Separator')) !== false){
                    $configCommonType=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用设备类型','fatherid'=>0));
                    $this->assign('alltype','设备');
                }else{

                }
                $this->assign('configCommonType',$configCommonType);
                $common_type=explode(C('Separator'),$newInfo['common_type']);
                $newInfo['common_type_0']=html_entity_decode($common_type[0]);
                $newInfo['common_type_1']=html_entity_decode($common_type[1]);
                $newInfo['common_type_2']=html_entity_decode($common_type[2]);
                $this->assign('newInfo',$newInfo);
            }
            $configType=(new ConfigLogic())->selectTypeByKeyword('需求分类',$this->user_info['id']);
            $this->assign('configType',$configType);
            $this->display();
        }
    }
    public function xinwenAdd(){
        $this->add('xinwen','新闻分类');
    }
    public function zhanhuiAdd(){
        if(IS_POST){
            $array=I('post.');
            $array['bankuai']='zhanhui';
            $array['user_id']=$this->user_info['id'];
            $array['starttime']=strtotime($array['starttime']);
            $array['stoptime']=strtotime($array['stoptime']);
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
            if(I('get.id')){
                $newInfo = (new NewsModel())->findByWhere(array('id'=>I('get.id')));
                $this->assign('newInfo',$newInfo);
            }
            $configType=(new ConfigLogic())->selectTypeByKeyword('展会分类',$this->user_info['id']);
            $this->assign('configType',$configType);
            $this->display();
        }
    }

    public function add($bankuai='xinwen',$keyword='新闻分类'){
        if(IS_POST){
            $array=I('post.');
            $array['bankuai']=$bankuai;
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
            if(I('get.id')){
                $newInfo = (new NewsModel())->findByWhere(array('id'=>I('get.id')));
                $this->assign('newInfo',$newInfo);
            }
            $configType=(new ConfigLogic())->selectTypeByKeyword($keyword,$this->user_info['id']);
            $this->assign('configType',$configType);
            $this->display();
        }
    }



    public function delect(){
        if(I('get.id')){
            $return = (new NewsModel())->delectById(I('get.id'));
            if($return===true){
                $this->setjsonReturn('删除成功');
            }else{
                $this->errorjsonReturn('删除失败');
            }
        }else{
            $this->errorjsonReturn("操作错误");
        }
    }

}