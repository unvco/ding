<?php
namespace Home\Controller;
use Home\Logic\UserLogic;
use Think\Controller;
class UserController extends BaseController {
    public function __construct() {
        parent::__construct();
    }
    /**
     * 进入首页
     */
    public function companyList(){
        $type_search['address']=array('地址',array('上海','杭州','江西','南昌','晋江','泉州','深圳'));
        $this->assign('type_search',$type_search);
        $get=I('get.');
        $return=(new UserLogic())->getCompanyLists($get);
        $this->assign('data',$return['data']);
        $this->assign('page',$return['page']);
        $this->display();
    }


    /**
     * 进入列表页
     */
    public function jingjirenList(){
        $type_search['address']=array('地址',array('上海','杭州','江西','南昌','晋江','泉州','深圳'));
        $this->assign('type_search',$type_search);
        $get=I('get.');
        $return=(new UserLogic())->getJingjirenLists($get);
        $this->assign('data',$return['data']);
        $this->assign('page',$return['page']);
        $this->display();
    }


    /**
     * 进入列表页
     */
    public function shejishiList(){
        $type_search['address']=array('地址',array('上海','杭州','江西','南昌','晋江','泉州','深圳'));
        $this->assign('type_search',$type_search);

        $get=I('get.');
        $return=(new UserLogic())->getShejishiLists($get);
        $this->assign('data',$return['data']);
        $this->assign('page',$return['page']);
        $this->display();
    }


    /**
     * 进入列表页
     */
    public function toJingjiren(){
        $this->display();
    }


    /**
     * 进入列表页
     */
    public function toShejishi(){
        $this->display();
    }
}