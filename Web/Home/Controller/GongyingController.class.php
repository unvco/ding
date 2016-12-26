<?php
namespace Home\Controller;
use Home\Logic\NewsLogic;
use Home\Model\CompanyModel;
use Home\Model\NewsModel;
use Home\Model\TypeConfigModel;
use Home\Model\UserIntroduceModel;
use Home\Model\UserModel;
use Think\Controller;
class GongyingController extends BaseController {

    public function __construct() {
        parent::__construct();
        $hotDiv=(new NewsModel())->selectByLimit(array('bankuai'=>'gongying'),3,'id desc');
        $this->assign('hotDiv',$hotDiv);

        $newDiv=(new NewsModel())->selectByLimit(array('bankuai'=>'gongying'),11,'id desc');
        $this->assign('newDiv',$newDiv);

        $hotDiv2=(new NewsModel())->selectByLimit(array('bankuai'=>'gongying'),10,'look_num desc');
        $this->assign('hotDiv2',$hotDiv2);

        $hotDiv3=(new NewsModel())->selectByLimit(array('bankuai'=>'gongying'),4,'look_num desc');
        $this->assign('hotDiv3',$hotDiv3);

        $hotUserDiv=(new CompanyModel())->selectByLimit(array(),10,'look_num desc');
        $this->assign('hotUserDiv',$hotUserDiv);
    }


    public function lists(){
        //下面定义列表,类型搜索关键词
        $type_search=array();
        $stoneTypeConfig=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用石材类型','fatherid'=>0));
        foreach($stoneTypeConfig as $v){$stoneTypeConfigView[$v['name']]=$v['name'];}
        $stoneColorConfig=(new TypeConfigModel())->selectByWhere(array('keyword'=>'公用石材颜色','fatherid'=>0));
        foreach($stoneColorConfig as $v){$stoneColorConfigView[$v['name']]=$v['name'];}
        $addressConfig=(new TypeConfigModel())->selectByWhere(array('keyword'=>'地址','fatherid'=>0));
        foreach($addressConfig as $v){$addressConfigView[$v['id']]=$v['name'];}
        $type_search['common_type']=array('石材类型',$stoneTypeConfigView);
        $type_search['stone_color']=array('石材颜色',$stoneColorConfigView);
        $type_search['address']=array('企业地址',$addressConfigView);
        $get=I('get.');
        $return=(new NewsLogic())->getNewsLists('gongying',$get);
        $this->assign('data',$return['data']);
        $this->assign('page',$return['page']);
        $this->assign('type_search',$type_search);
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