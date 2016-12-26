<?php
namespace Myweb\Controller;
use Home\Model\CompanyModel;
use Home\Model\UserConfigModel;
use Home\Model\UserModel;
use Myweb\Logic\NewsLogic;
use Think\Controller;
class IndexController extends Controller {
    public function __construct() {
        parent::__construct();
        $userInfo=(new UserModel())->findByWhere(array('id'=>I('get.userid')));
        if(!$userInfo){exit('no user');}
        $companyInfo=(new CompanyModel())->findByWhere(array('user_id'=>I('get.userid')));
        if(!$companyInfo){exit('no Company');}
        $userConfig=(new UserConfigModel())->selectByWhere(array('user_id'=>I('get.userid')));
        $userConfigInfo=array();
        foreach($userConfig as $value){
            $userConfigInfo[$value['keyword']]=$value['value'];
        }
        $enableEdit=session('user_info.id')==I('get.userid')?1:0;
        $this->assign('userInfo',$userInfo);
        $this->assign('companyInfo',$companyInfo);
        $this->assign('userConfigInfo',$userConfigInfo);
        $this->assign('enableEdit',$enableEdit);
        $this->assign('userid',I('get.userid'));
//        var_dump($userInfo);
//        var_dump($companyInfo);
//        var_dump($userConfigInfo);
    }

    public function index(){
        $this->display('inde');
    }

    public function newslist1(){
        $lists=(new NewsLogic())->lists(array('gongying','shebei'));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function newslist2(){
        $lists=(new NewsLogic())->lists(array('xuqiu'));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function newslist3(){
        $lists=(new NewsLogic())->lists(array('zhanshi'));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function newslist4(){
        $lists=(new NewsLogic())->lists(array('xinwen'));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function content1(){
        $this->display();
    }

    public function content2(){
        $this->display();
    }

    public function content3(){
        $this->display();
    }

    public function liuyan(){
        $this->display();
    }
}