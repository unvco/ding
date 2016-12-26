<?php
namespace Space\Controller;
use Think\Controller;

class BaseController extends Controller
{
    protected $user_info;
    protected $ret = array('errNum'=>0, 'errMsg'=>'success', 'retData'=>array());
    public function __construct() {
        parent::__construct();
        if(session('user_info')){
            $user_info = session('user_info');
            $this->user_info=$user_info;
        }else{
            redirect(U('Home/Login/login'));
        }
    }

    /**
     * 返回正确的格式的json数据
     * @author dingwenzi@fangjinsuo.com
     * @param $value 要json转换的数据
     * @param null $key 数据对应的关键词(可选)
     * @return json数据
     */
    function setjsonReturn($value,$key=null){
        if (isset($key))
            $this->ret['retData'][$key]=$value;
        else
            $this->ret['retData']=$value;
        $this->ajaxReturn ($this->ret,'JSON');
    }

    /**
     * 返回错误格式的json数据
     * @param $value
     * @return json数据
     */
    function errorjsonReturn($value){
        $this->ret['errNum']=-1;
        $this->ret['errMsg']=$value;
        $this->ajaxReturn ($this->ret,'JSON');
    }
}