<?php
namespace Space\Controller;


use Home\Model\CompanyModel;
use Home\Model\TypeConfigModel;

class CompanyController extends BaseController {
    /**
     * 进入首页
     */
    public function index(){
        $this->display();
    }


    /**
     * 编辑企业资料
     */
    public function myInfo(){
        if(IS_POST){

            $array=I('post.');
            $array['user_id']=$this->user_info['id'];
            $return=(new CompanyModel())->addOrSaveByUserid($array);
            $return===false?$this->errorjsonReturn('操作失败'):$this->setjsonReturn('操作成功');
        }else{
            $info = (new CompanyModel())->findByWhere(array('user_id'=>$this->user_info['id']));
            $configWhere['keyword']=array('in','公用石材类型,公用设备类型');
            $configWhere['fatherid']=array('eq',0);
            $configCommonType=(new TypeConfigModel())->selectByWhere($configWhere);
            $this->assign('info',$info);
            $this->assign('configCommonType',$configCommonType);
            $this->display();
        }
    }

    /**
     * 截图界面
     */
    public function cutlogoIndex(){
        $this->display();
    }

    /**
     * 截图界面
     */
    public function cutlogo(){
        $info = (new CompanyModel())->findByWhere(array('user_id'=>$this->user_info['id']));
        $this->assign('info',$info);
        $this->display();
    }

}