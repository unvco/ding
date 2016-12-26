<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    /**
     * 后台首页
     */
    public function index(){
        $data=M('admin_daohang')->select();
        $html=adminMenu($data);
        $this->assign("adminmenu",$html);
        $this->display();
    }



    public function ss(){
        for($i=0;$i<1000;$i++){
            sleep(1);
            file_put_contents("sleep.txt", "[时间".strtotime('Y-m-d h:i:s',time())."]\r\n<hr>",FILE_APPEND);
        }
    }


    /**
     * 仿照YII的Gii创建模板功能
     */
    public function stytemManger(){
        if(IS_POST){
            \Think\Build::buildController('Admin','Role');
        }else{
            $this->display();
        }
    }



}