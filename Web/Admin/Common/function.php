<?php


/**生成后台导航一级类
 * @param $data
 * @param int $pid
 * @param int $level
 * @return string
 */
function adminMenu($data,$pid=0,$level=0){
    $str="";
    $templete1 = <<<NCTX
    <div class="accordionHeader">
                    <h2><span>Folder</span>%s</h2>
                </div>
                <div class="accordionContent"><ul class="tree treeFolder">
                    %s
                </ul></div>
NCTX;
    foreach ($data as $k=>$v){
        if($v['fatherid']==0){//如果是顶级分类，生成大类列表
            //下面是将子内容写到一级模板里面去
            $str =$str.sprintf($templete1, $v['name'], adminChildMenu($data,$v['id'],$level+1));
        }
//        unset($data[$k]);//移除已经用过的数据，减少循环次数
//        array_splice($data,$k,1);
    }
    return $str;
}

/**无限循环生成二级导航以下
 * @param $data
 * @param int $pid
 * @param int $level
 * @return string
 */
function adminChildMenu($data,$pid=0,$level=0){
    $str="";
    if ($level == 1) {//如果是一级分类
        $templete2 = <<<NCTX
<li><a href="%s" %s rel="%s"%s>%s</a></li>
NCTX;
        $templete3 = <<<NCTX
<li><a>%s</a><ul>%s</ul></li>
NCTX;
    }else{
        $templete2 = <<<NCTX
<li><a href="%s" %s rel="%s"%s>%s</a></li>
NCTX;
        $templete3 = <<<NCTX
<li><a>%s</a><ul>%s</ul></li>
NCTX;
    }
    foreach ($data as $k=>$v) {
        if ($v['fatherid'] == $pid) {//如果是这个id下的子分类
            if ($v['isdir'] == 1) {//如果是文件夹形式
                $str = $str . sprintf($templete3, $v['name'],adminChildMenu($data,$v['id'],$level+1));
            } else {//是连接形式
                if((strpos($v['url'], "http") === false)&&(strpos($v['url'], "https") === false)){$url=U($v['url']);}else{$url=$v['url'];}
                if($v['isdialog']==1){$target=' target="dialog" width="'.$v['width'].'" height="'.$v['height'].'"';}else{$target=' target="navTab"';}
                if(($v['external']==1)&&($v['isdialog']!=1)){$external='external="true"';}else{$external='';}
                $str = $str . sprintf($templete2, $url,$target,$v['rel'],$external,$v['name']);
            }
        }
//        unset($data[$k]);//移除已经用过的数据，减少循环次数
//        array_splice($data,$k,1);
    }
    return $str;
}


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
?>