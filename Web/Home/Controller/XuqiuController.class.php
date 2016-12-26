<?php
namespace Home\Controller;
use Home\Logic\NewsLogic;
use Home\Model\CompanyModel;
use Home\Model\NewsModel;
use Home\Model\UserIntroduceModel;
use Home\Model\UserModel;
use Think\Controller;
class XuqiuController extends BaseController {

    public function __construct() {
        parent::__construct();
        $hotDiv=(new NewsModel())->selectByLimit(array('bankuai'=>'xuqiu'),3,'id desc');
        $this->assign('hotDiv',$hotDiv);

        $newDiv=(new NewsModel())->selectByLimit(array('bankuai'=>'xuqiu'),11,'id desc');
        $this->assign('newDiv',$newDiv);

        $hotDiv2=(new NewsModel())->selectByLimit(array('bankuai'=>'xuqiu'),10,'look_num desc');
        $this->assign('hotDiv2',$hotDiv2);

        $hotDiv3=(new NewsModel())->selectByLimit(array('bankuai'=>'xuqiu'),4,'look_num desc');
        $this->assign('hotDiv3',$hotDiv3);

        $hotUserDiv=(new CompanyModel())->selectByLimit(array(),10,'look_num desc');
        $this->assign('hotUserDiv',$hotUserDiv);
    }


    public function lists(){
        $get=I('get.');
        $return=(new NewsLogic())->getNewsLists('xuqiu',$get,15);
        $data=$return['data'];
        foreach($data as $k=>$value){
            $data[$k]['common_type']=str_replace(C('Separator'),'-',$value['common_type']);
        }
        $this->assign('data',$data);
        $this->assign('page',$return['page']);
        $this->display();
    }

    public function content(){
        $return=(new NewsLogic())->getNewsInfo(I('get.newsid'));
        if($return){
            $userIntroduce=(new UserIntroduceModel())->findByWhere(array('user_id'=>$return['user_id']));
            $userIntroduce['user_content']=html_entity_decode($userIntroduce['user_content']);
            $this->assign('userIntroduce',$userIntroduce);
        }
        $return['content']=html_entity_decode($return['content']);
        $this->assign('info',$return);

        $this->display();
    }
}