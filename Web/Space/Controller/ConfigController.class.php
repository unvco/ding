<?php
namespace Space\Controller;

use Home\Model\TypeConfigModel;
use Space\Logic\ConfigLogic;

class ConfigController extends BaseController {
    public function index(){
        $this->assign('bankuai',I('get.bankuai'));
        $this->display();
    }

    public function table(){
        $result = (new ConfigLogic())->customerList(I('get.'),$this->user_info['id']);
        $this->assign('bankuai',I('get.bankuai'));
        $this->assign('list', $result[0]);
        $this->assign('pageBar', $result[1]);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $array=I('post.');
            $array['user_id']=$this->user_info['id'];
            switch ($array['bankuai'])
            {
                case 'gongying':
                    $keyword='石材类型';
                    break;
                case 'shebei':
                    $keyword='设备类型';
                    break;
                case 'zhanhui':
                    $keyword='展会分类';
                    break;
                case 'zhanshi':
                    $keyword='展示分类';
                    break;
                case 'xuqiu':
                    $keyword='需求分类';
                    break;
                case 'xinwen':
                    $keyword='新闻分类';
                    break;
                default:
                    $keyword='新闻分类';
            }
            $array['keyword']=$keyword;
            $return=(new TypeConfigModel())->addOrSave($array);
            $return===false?$this->errorjsonReturn('操作失败'):$this->setjsonReturn('操作成功');
        }else{
            if(I('get.id')){
                $config = (new TypeConfigModel())->findByWhere(array('id'=>I('get.id')));
                $this->assign('config',$config);
            }
            $this->assign('bankuai',I('get.bankuai'));
            $this->display();
        }
    }

    public function delect(){
        if(I('get.id')){
            $return = (new TypeConfigModel())->delectById(I('get.id'));
            if($return===true){
                $this->setjsonReturn('删除成功');
            }else{
                $this->errorjsonReturn('删除失败');
            }
        }else{
            $this->errorjsonReturn("操作错误");
        }
    }

    public function getConfigByFatherid(){
        $configCommonType=(new TypeConfigModel())->selectByWhere(array('fatherid'=>I('post.fatherid')));
        $this->setjsonReturn($configCommonType);
    }

    public function getConfigInfo(){
        $configInfo=(new TypeConfigModel())->findByWhere(array('id'=>I('post.id')));
        $this->setjsonReturn($configInfo);
    }


}