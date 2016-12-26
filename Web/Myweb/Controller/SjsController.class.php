<?php
namespace Myweb\Controller;
use Home\Model\UserModel;
use Myweb\Logic\NewsLogic;
use Think\Controller;
class SjsController extends Controller {
    protected $user_info;
    public function __construct() {
        parent::__construct();
        C('DEFAULT_THEME','Sjs');
        $userInfo=(new UserModel())->findByWhere(array('id'=>I('get.userid')));
        if($userInfo['type']!='设计师'){exit('非法操作');}
        $this->user_info=$userInfo;
        $this->assign('userInfo',$userInfo);
    }

    public function index(){
        $zhanshiInfos=(new NewsLogic())->getZhanshiList(I('get.'));

        $this->assign('data',$zhanshiInfos['data']);
        $this->assign('page',$zhanshiInfos['page']);
        $this->display('inde');
    }
}