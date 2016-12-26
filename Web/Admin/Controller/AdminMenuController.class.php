<?php
namespace Admin\Controller;
use Think\Controller;
class AdminMenuController extends BaseController {

    /**
     * 进入后台导航管理界面
     */
    public function lists(){
        $lists=commonAdminMenu(D('AdminDaohang')->selectByWhere());
        $this->assign('lists',$lists);
        $this->display();
    }

    public function delete(){
        //查看是否有子分类
        if(D('AdminDaohang')->selectByWhere(array('fatherid'=>I('get.uid')))){
            $this->errorjsonReturn(self::DO_FAIL_CHILDREN);
        }else{
            if(D('AdminDaohang')->deleteById(array('id'=>I('get.uid')))){
                $this->setjsonReturn(self::DO_SUCCESS);
            }else{
                $this->errorjsonReturn(self::DO_FAIL);
            }
        }
    }


    /**
     * 添加界面及添加操作
     */
    public function add(){
        //如果是写入数据
        if(IS_POST){
            $array=I('post.Admin');
            $array['fatherid']=I('post.orgLookup_id');
            if(D('AdminDaohang')->addOrSave($array)){
                $this->setjsonReturn(self::DO_SUCCESS);
            }else{
                $this->errorjsonReturn(self::DO_FAIL);
            }
        }else{
            //如果是进入修改界面
            $info=D('AdminDaohang')->getInfoById(I('get.uid'));
            $this->assign('info',$info);
            $this->display();
        }
    }

    public function selectBack(){
        $lists=commonAdminMenu(D('AdminDaohang')->selectByWhere());
        $this->assign('lists',$lists);
        $this->display();
    }




}