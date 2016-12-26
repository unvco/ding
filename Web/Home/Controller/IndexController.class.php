<?php
namespace Home\Controller;
use Home\Model\TypeConfigModel;
use Think\Controller;
class IndexController extends BaseController {
    /**
     * 进入首页
     */
    public function index(){
        $companyType=(new TypeConfigModel())->selectByWhere(array('keyword'=>'企业类型'));
        $config_dizhi=(new TypeConfigModel())->selectByWhere(array('keyword'=>'地址'));

        $this->assign('company_type',$companyType);
        $this->assign('config_dizhi',$config_dizhi);
        $this->display('shouye');
    }
}