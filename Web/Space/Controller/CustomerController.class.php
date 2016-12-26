<?php
namespace Space\Controller;


use Home\Model\UserCustomerModel;
use Space\Logic\UserCustomerLogic;

class CustomerController extends BaseController {
    public function index(){
        $this->display();
    }

    public function table(){
        $result = (new UserCustomerLogic())->customerList(I('get.'),$this->user_info['id']);
        $this->assign('list', $result[0]);
        $this->assign('pageBar', $result[1]);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $array=I('post.');
            $array['user_id']=$this->user_info['id'];
            $return=(new UserCustomerModel())->addOrSave($array);
            $return===false?$this->errorjsonReturn('操作失败'):$this->setjsonReturn('操作成功');
        }else{
            if(I('get.id')){
                $customerInfo = (new UserCustomerModel())->findByWhere(array('id'=>I('get.id')));
                $this->assign('customerInfo',$customerInfo);
            }
            $this->display();
        }
    }

    public function delect(){
        if(I('get.id')){
            $return = (new UserCustomerModel())->delectById(I('get.id'));
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