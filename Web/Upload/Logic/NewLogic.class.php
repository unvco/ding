<?php

namespace Upload\Logic;

use Home\Model\NewsModel;
use Home\Model\UploadModel;

class NewLogic
{
    public function picDelOrSet($content,$news_id) {
        //下面对编辑器上传的图片进行处理
        //修改中删除了过去上传的图片
        $picinfoarr=(new UploadModel())->selectByWhere(array("new_id"=>$news_id));
        foreach($picinfoarr as $k=>$val){
            if(strpos($content, $val['url']) === false){//不包含这张图片，那就删掉这张图片
                @unlink($val['url']);//删除这张图片
                (new UploadModel())->deleteByWhere(array('id'=>$val['id']));
            }
        }
        $upsession=session('uploads');
        //上传附件处理代码
        if(!isset($upsession)) $upsession = array();
        //清除未保存的上传记录
        if(count($upsession)>0){
            foreach($upsession as $k=>$val) {
                if(strpos($content, $val['url']) === false){
                    @unlink($val['url']);//删除这张图片
                    array_splice($upsession,$k,1);
                    (new UploadModel())->deleteByWhere(array('url'=>$val['url'],'createtime'=>$val['addtime']));
                }
            }
        }
        //处理剩下上传成功的附件处理代码
        if(count($upsession)>0){
            foreach($upsession as $k=>$val) {
                if(strpos($content, $val['url']) >=0){
                    $save_where=array('url'=>$val['url'],'createtime'=>$val['addtime']);
                    $save_info=array('news_id'=>$news_id,'ok'=>1);
                    (new UploadModel())->saveByWhere($save_where,$save_info);
                }
            }
        }
        //头像处理代码----取第一张图片作为标题图片
        $picinfo=(new UploadModel())->findByWhere(array("new_id"=>$news_id,'ok'=>1));
        if(!empty($picinfo)){
            (new NewsModel())->saveByWhere(array('id'=>$news_id),array('pic_name'=>$picinfo['url']));
        }
        //文章入库后，清除 上传临时记录 $_SESSION['uploads']
        session('uploads',null);
    }
}