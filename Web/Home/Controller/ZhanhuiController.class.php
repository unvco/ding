<?php
namespace Home\Controller;
use Home\Logic\NewsLogic;
use Home\Model\CompanyModel;
use Home\Model\NewsModel;
use Home\Model\UserIntroduceModel;
use Home\Model\UserModel;
use Think\Controller;
class ZhanhuiController extends BaseController {

    public function __construct() {
        parent::__construct();
        $hotDiv=(new NewsModel())->selectByLimit(array('bankuai'=>'zhanhui'),3,'id desc');
        $this->assign('hotDiv',$hotDiv);

        $newDiv=(new NewsModel())->selectByLimit(array('bankuai'=>'zhanhui'),11,'id desc');
        $this->assign('newDiv',$newDiv);

        $hotDiv2=(new NewsModel())->selectByLimit(array('bankuai'=>'zhanhui'),10,'look_num desc');
        $this->assign('hotDiv2',$hotDiv2);

        $hotDiv3=(new NewsModel())->selectByLimit(array('bankuai'=>'zhanhui'),4,'look_num desc');
        $this->assign('hotDiv3',$hotDiv3);

        $hotUserDiv=(new CompanyModel())->selectByLimit(array(),10,'look_num desc');
        $this->assign('hotUserDiv',$hotUserDiv);
    }


    public function lists(){
        $get=I('get.');
        $return=(new NewsLogic())->getNewsLists('zhanhui',$get);

        $infos=$return['data'];
        foreach($infos as $k=>$v){
            $return_state=1;//正在开始
            if($v['starttime']>time()){$return_state=0;}//还未开始
            if($v['stoptime']<time()){$return_state=2;}//已经结束
            $infos[$k]['return_state']=$return_state;

            $infos[$k]['weekday']=self::weekday($v['starttime']);
        }

        $this->assign('data',$infos);
        $this->assign('page',$return['page']);
        $this->display();
    }

    static function weekday($time){
        if(is_numeric($time)){
            $weekday = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
            return $weekday[date('w', $time)];
        }
        return false;
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