<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Class TypeConfigController
 * @package Home\Controller
 * 配置类别管理
 */
class TypeConfigController extends BaseController {

    /**
     * 进入类型配置管理界面
     */

    public function lists(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere());
        $this->assign('lists',$lists);
        $this->display();
    }

    public function stoneTypeLists(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere(array('keyword'=>'公用石材类型')));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function shebeiTypeLists(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere(array('keyword'=>'公用设备类型')));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function colorTypeLists(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere(array('keyword'=>'公用石材颜色')));
        $this->assign('lists',$lists);
        $this->display();
    }
    public function userTypeLists(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere(array('keyword'=>'用户角色')));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function delete(){
        //查看是否有子分类
        if(D('TypeConfig')->selectByWhere(array('fatherid'=>I('get.uid')))){
            $this->errorjsonReturn(self::DO_FAIL_CHILDREN);
        }else{
            if(D('TypeConfig')->deleteById(array('id'=>I('get.uid')))){
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
            if(D('TypeConfig')->addOrSave($array)){
                $this->setjsonReturn(self::DO_SUCCESS);
            }else{
                $this->errorjsonReturn(self::DO_FAIL);
            }
        }else{
            //如果是进入修改界面
            $info=D('TypeConfig')->getInfoById(I('get.uid'));
            $this->assign('info',$info);
            $this->display();
        }
    }

    public function shebeiTypeAdd(){
        //如果是进入修改界面
        $info=D('TypeConfig')->getInfoById(I('get.uid'));
        $this->assign('info',$info);
        $this->display();
    }

    public function stoneTypeAdd(){
        //如果是进入修改界面
        $info=D('TypeConfig')->getInfoById(I('get.uid'));
        $this->assign('info',$info);
        $this->display();
    }

    public function colorTypeAdd(){
        //如果是进入修改界面
        $info=D('TypeConfig')->getInfoById(I('get.uid'));
        $this->assign('info',$info);
        $this->display();
    }
    public function userTypeAdd(){
        //如果是进入修改界面
        $info=D('TypeConfig')->getInfoById(I('get.uid'));
        $this->assign('info',$info);
        $this->display();
    }

    public function selectBack(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere());
        $this->assign('lists',$lists);
        $this->display();
    }

    public function shebeiTypeSelectBack(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere(array('keyword'=>'公用设备类型')));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function stoneTypeSelectBack(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere(array('keyword'=>'公用石材类型')));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function colorTypeSelectBack(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere(array('keyword'=>'公用石材颜色')));
        $this->assign('lists',$lists);
        $this->display();
    }

    public function userTypeSelectBack(){
        $lists=commonAdminMenu(D('TypeConfig')->selectByWhere(array('keyword'=>'用户角色')));
        $this->assign('lists',$lists);
        $this->display();
    }




}