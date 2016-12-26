<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Class TypeConfigController
 * @package Home\Controller
 * 用户管理
 */
class UserController extends BaseController {

    /**
     * 进入用户管理界面
     */
    public function lists(){
        $lists=D('User')->selectByWhere();
        $this->assign('lists',$lists);
        $this->display();
    }

    public function delete(){
        if(D('User')->deleteBywhere(array('id'=>I('get.uid')))){
            $this->setjsonReturn(self::DO_SUCCESS);
        }else{
            $this->errorjsonReturn(self::DO_FAIL);
        }
    }


    /**
     * 添加界面及添加操作
     */
    public function add(){
        //如果是写入数据
        if(IS_POST){
            $array=I('post.Admin');
            $array['regtime']=$array['lastlogintime']=$array['startlogintime']=time();
            if(D('User')->addOrSave($array)){
                $this->setjsonReturn(self::DO_SUCCESS);
            }else{
                $this->errorjsonReturn(self::DO_FAIL);
            }
        }else{
            //如果是进入修改界面
            $info=D('User')->getInfoById(I('get.uid'));
            $this->assign('info',$info);
            $this->display();
        }
    }

    public function selectBack(){
        $lists=D('User')->selectByWhere();
        $this->assign('lists',$lists);
        $this->display();
    }




}