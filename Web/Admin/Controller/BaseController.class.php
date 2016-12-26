<?php
namespace Admin\Controller;
use Think\Controller;


class BaseController extends Controller {
    const DO_SUCCESS= "操作成功";
    const DO_FAIL="操作失败";
    const DO_FAIL_CHILDREN="存在子分类，请先删除子分类";
    const DO_FAIL_ARTICLE_TYPE="改分类下存在文章，请先删除文章";
    const DIVISION="<!--!>";//所有的合并字符串的分隔符


    /**
     * 返回正确的格式的json数据
     * @param $value
     * @param null $key
     */
    function setjsonReturn($value,$key=null){
        $result['code'] = 0;
        $result['data'] = null;
        if (isset($key))
            $result['data'][$key] = $value;
        else
            $result['data'] = $value;
        $this->ajaxReturn ($result,'JSON');
    }

    /**
     * 返回错误格式的json数据
     * @param $value
     */
    function errorjsonReturn($value){
        $result['code'] = -1;
        $result['msg'] = $value;
        $this->ajaxReturn ($result,'JSON');
    }


    /**
     * 发送HTTP请求方法，目前只支持CURL发送请求
     * @param  string  $url    请求URL
     * @param  array   $params 请求参数
     * @param  string  $method 请求方法GET/POST
     * @param  boolean $ssl    是否进行SSL双向认证
     * @return array   $data   响应数据
     */
    static function http($url, $params = array(), $method = 'GET'){
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        );
        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                if(empty($params)){
                    $opts[CURLOPT_URL] = $url;
                }else{
                    $opts[CURLOPT_URL] = $url .'?'. http_build_query($params);
                }
                break;
            case 'POST':
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
        }
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);
        if ($err > 0) {
            return false;
        }else {
            return $data;
        }
    }


}
