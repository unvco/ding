<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/14 0014
 * Time: 下午 10:41
 */

/**
 * 无极分类排序公共函数
 * @param $data  传入的数组
 * @param int $pid  父导航
 * @param int $level  当前是第几级
 * @param string $fatheridmark 跟踪父id的标签
 * @param string $levelmark 定义输出等级的标签
 * @param string $idmark 跟踪主键id的标签
 * @return array
 */
function commonAdminMenu($data,$pid=0,$level=0,$fatheridmark='fatherid',$levelmark='level',$idmark='id'){
    $array=array();
    foreach ($data AS $k=>$value) {
        if ($value[$fatheridmark] == $pid) {
            $value[$levelmark]=$level;
            $array[] = $value;
            unset($data[$k]);//移除已经用过的数据，减少循环次数
            $array = array_merge($array, commonAdminMenu($data,$value[$idmark],$level+1,$fatheridmark,$levelmark));
        }
    }
    return $array;
}