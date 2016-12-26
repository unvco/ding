<?php
namespace Home\Controller;
use Home\Logic\UserLogic;
use Home\Model\CompanyModel;
use Home\Model\UserModel;
use Think\Controller;
class LoginController extends BaseController {
    /**
     * 用户登陆接口
     * @param $username
     * @param $password
     * @param $verify
     */
    public function login($username='',$password='',$verify=''){
        //如果是写入数据
        if(IS_POST){
            $return=(new UserLogic())->login($username,$password);
            if($return===true){
                $this->setjsonReturn('登陆成功');
            }else{
                $this->errorjsonReturn($return);
            }
        }else{
            if(session('user_info')){ redirect(U('/Home/Index/index')); }
        }
        $this->display();
    }

    /**
     * 注册用户
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function register($username='',$password='',$email=''){
        //如果是写入数据
        if(IS_POST){
            $return=(new UserLogic())->register($username,$password,$email);
            if($return===true){
                $this->setjsonReturn('注册成功');
            }else{
                $this->errorjsonReturn($return);
            }
        }else{
            if(session('user_info')){ redirect(U('/Home/Index/index')); }
        }
        $this->display();
    }

    /**
     * 登陆表格
     */
    public function loginTable(){
        $this->display();
    }

    /**
     * 退出
     */
    public function logout(){
        session('user_info',null);
        $this->setjsonReturn('退出成功');
    }

    /**
     * 注册之后选择角色界面
     */
    public function selectRole(){
        $this->display();
    }

    /**
     * 注册经纪人界面和动作
     */
    public function registerJingJiRen(){
        if(IS_POST){
            if(!session('user_info')){$this->errorjsonReturn('您还未登陆,请先登陆或注册');}
            $post=I('post.');
            $post['id']=$this->user_info['id'];
            $post['type']='经纪人';//定义用户的类型为经纪人
            $post['myweb_action']='Jjr';//定义个人网站控制器
            $post['template']='Jjr';//定义个人网站模板
            $post['address']=$post['province'].C('Separator').$post['city'].C('Separator').$post['country'].C('Separator').$post['street'];
            $return=(new UserModel())->addOrSave($post);
            if($return){
                $this->setjsonReturn('操作成功');
            }else{
                $this->errorjsonReturn('操作失败');
            }
        }else{
            if(!session('user_info')){
                redirect(U('Home/Login/login'));
            }
            $this->display();
        }
    }


    public function registerSheJiShi(){
        if(IS_POST){
            if(!session('user_info')){$this->errorjsonReturn('您还未登陆,请先登陆或注册');}
            $post=I('post.');
            $post['id']=$this->user_info['id'];
            $post['type']='设计师';//定义用户的类型为设计师
            $post['myweb_action']='Sjs';//定义个人网站控制器
            $post['template']='Sjs';//定义个人网站模板
            $post['address']=$post['province'].C('Separator').$post['city'].C('Separator').$post['country'].C('Separator').$post['street'];
            $return=(new UserModel())->addOrSave($post);
            if($return){
                $this->setjsonReturn('操作成功');
            }else{
                $this->errorjsonReturn('操作失败');
            }
        }else{
            if(!session('user_info')){
                redirect(U('Home/Login/login'));
            }
            $this->display();
        }
    }


    public function registerCompany(){
        if(IS_POST){
            if(!session('user_info')){$this->errorjsonReturn('您还未登陆,请先登陆或注册');}
            $post=I('post.');
            $userPost=$post['userInfo'];
            $userPost['id']=$this->user_info['id'];
            $userPost['type']='企业用户';//定义用户的类型为企业类型
            $userPost['myweb_action']='Company';//定义个人网站控制器
            $userPost['template']='Default';//定义个人网站模板
            $userPost['address']=$post['province'].C('Separator').$post['city'].C('Separator').$post['country'].C('Separator').$post['street'];
            $userPost['address_detail']=$post['address_detail'];

            $companyPost=$post['companyInfo'];
            $companyPost['user_id']=$this->user_info['id'];

            $userReturn=(new UserModel())->addOrSave($userPost);
            $companyReturn=(new CompanyModel())->addOrSaveByUserid($companyPost);

            $str='';
            if(!$userReturn){$str.='保存用户数据失败';}
            if(!$companyReturn){$str.='保存企业数据失败';}
            if($str==''){
                $this->setjsonReturn('操作成功');
            }else{
                $this->errorjsonReturn($str);
            }
        }else{
            if(!session('user_info')){
                redirect(U('Home/Login/login'));
            }
            $this->display();
        }
    }
}