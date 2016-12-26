<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Class TypeConfigController
 * @package Home\Controller
 * 程序方法管理
 */
class ActionController extends BaseController {

    /**
     * 进入方法管理界面
     */
    public function lists(){
        $lists=D('Action')->selectByWhere();
        $this->assign('lists',$lists);
        $this->display();
    }

    public function delete(){
        if(D('Action')->deleteById(array('id'=>I('get.uid')))){
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
            if(D('Action')->addOrSave($array)){
                $this->setjsonReturn(self::DO_SUCCESS);
            }else{
                $this->errorjsonReturn(self::DO_FAIL);
            }
        }else{
            //如果是进入修改界面
            $info=D('Action')->getInfoById(I('get.uid'));
            $this->assign('info',$info);
            $this->display();
        }
    }

    public function selectBack(){
        $lists=D('Action')->selectByWhere();
        $this->assign('lists',$lists);
        $this->display();
    }




}