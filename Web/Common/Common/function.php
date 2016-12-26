<?php
/**
 * Created by PhpStorm.
 * User: Jie
 * Date: 2016/7/14
 * Time: 13:35
 */

/**
 * 获取页面内容
 * @author JIE <xuhuijie@fangjinsuo.com>>
 * @param string $url : 页面地址
 * @param int $timeout : 超时
 * @return mixed: 页面内容
 */
function get_url($url, $timeout = 10)
{
    if (function_exists('curl_init')) {     // 服务器支持curl
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curlHandle, CURLOPT_HEADER, FALSE);    // 显示header
        curl_setopt($curlHandle, CURLOPT_NOBODY, FALSE);    // 不显示body
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);    // 超时
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, TRUE); // 重定向
        curl_setopt($curlHandle, CURLOPT_MAXREDIRS, 10);    // 最大跳转次数
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE); // 获取的信息以文件流的形式返回
        curl_setopt($curlHandle, CURLOPT_USERAGENT, "Chrome/49.0.2623.87");  // 模拟浏览器
        $result = curl_exec($curlHandle);
        curl_close($curlHandle);
    } else {                                // 服务器不支持curl
        $ctx = stream_context_create(array(
            'http' => array(
                'method' => "GET",
                'header' => "Content-Type: text/html; charset=utf-8",
                'timeout' => $timeout
            )
        ));
        $result = file_get_contents($url, 0, $ctx);
    }
    return $result;
}

/**
 * post提交
 * @author JIE <xuhuijie@fangjinsuo.com>
 * @param string $url : 提交地址
 * @param array $data : 提交的数据，$data = array('A' => '1', 'B' => '2');
 * @param int $timeout : 超时
 * @return mixed: 返回信息
 */
function post_url($url, $data, $timeout = 10)
{
    $curlHandle = curl_init(); // 启动一个CURL会话
    curl_setopt($curlHandle, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curlHandle, CURLOPT_HEADER, FALSE);    // 显示header
    curl_setopt($curlHandle, CURLOPT_NOBODY, FALSE);    // 不显示body
    curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);    // 超时
    curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, TRUE); // 重定向
    curl_setopt($curlHandle, CURLOPT_MAXREDIRS, 20);    // 最大跳转次数
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE); // 获取的信息以文件流的形式返回
    curl_setopt($curlHandle, CURLOPT_USERAGENT, "Chrome/49.0.2623.87");  // 模拟浏览器
    curl_setopt($curlHandle, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, http_build_query($data)); // Post提交的数据包
    $result = curl_exec($curlHandle); // 执行操作
    curl_close($curlHandle);
    return $result;
}

/*
 * 解析DatePicker 出来的区间时间；
 * @param string $rangeDate
 * @retun array
 */
function splitDate($rangeDate=''){
    $date = explode(' - ',$rangeDate);
    return array(strtotime($date[0]),strtotime($date[1].' 23:59:59'));
}

/**
 * TODO 基础分页的相同代码封装，使前台的代码更少
 * @param $m 模型，引用传递
 * @param $where 查询条件
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage(&$m,$where,$pagesize=10){
    $m1=clone $m;//浅复制一个模型
    $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
    $m=$m1;//为保持在为定的连惯操作，浅复制一个模型
    $p=new Think\Page($count,$pagesize);
    $p->lastSuffix=false;
    $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>'.$pagesize.'</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev','上一页');
    $p->setConfig('next','下一页');
    $p->setConfig('last','末页');
    $p->setConfig('first','首页');
    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

    $p->parameter=I('get.');

    $m->limit($p->firstRow,$p->listRows);

    return $p;
}
