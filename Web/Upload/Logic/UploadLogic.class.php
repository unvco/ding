<?php

namespace Upload\Logic;


use Home\Model\UploadModel;

class UploadLogic
{

    /**
     * 上传图片动作
     * @param $Filedata 资源
     * @param $user_id  操作人id
     * @param $keyword  图片表中的 关键字
     * @return array|string
     */
    public function uploadAction($Filedata,$user_id,$keyword){
        $tempFile = $Filedata['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);

        //根据上传文件的类型分别指定图片文件夹和附件文件夹
        if (in_array($fileParts['extension'],C('fileTypesImg'))) {
            $foder=rtrim($_SERVER['DOCUMENT_ROOT'] . C('targetFolderImg'),'/');
        }elseif (in_array($fileParts['extension'],C('fileTypesFile'))) {
            $foder=rtrim($_SERVER['DOCUMENT_ROOT'] . C('targetFolderFile'),'/');
        } else {
            return '您上传的类型不允许';
        }

        //创建文件夹
        $file_name=time().'.'.$fileParts['extension'];
        if (!file_exists($foder)){ mkdir ($foder);}
        $childFoder=$foder.'/'.date("Y-m-d", time());
        if (!file_exists($childFoder)){ mkdir ($childFoder);}
        $targetFile = $childFoder.'/'.$file_name;

        //上传文件
        if(!move_uploaded_file($tempFile,$targetFile)){
            return "服务器移动文件失败";
        }else{
            $info['type'] = $fileParts['extension'];//文件的类型
            $info['name'] = $file_name;                //文件的标题
            $info['url'] = str_replace($_SERVER['DOCUMENT_ROOT'],'', $targetFile);                 //文件的地址
            $info['size'] = $Filedata['size'];         //文件的大小
            $info['original'] =  $Filedata['name'];//源文件的名字
            $info['keyword'] = $keyword;
            $info['user_id']=$user_id;//上传文件名用户id
            //下面是写入附件信息表
            (new UploadModel())->addOrSave($info);
        }
        //如果是图片文件，要进行缩放处理
        if (in_array($fileParts['extension'],C('fileTypesImg'))) {
            $picinfo=self::resizeImage($targetFile);
            return array('url'=>$info['url'],'width'=>$picinfo['width'],'height'=>$picinfo['height']);
        }else{
            return array('url'=>$info['url']);
        }
    }

    /**
     * 图片裁剪动作
     * @param $post  地址,坐标
     * @param $user_id  操作人id
     * @param $keyword  图片表中的 关键字
     * @return array|string
     */
    public function cutPicAction($post,$user_id,$keyword){
        $pathinfo_url=pathinfo($post['url']);
        $foder=rtrim($_SERVER['DOCUMENT_ROOT'] . '/uploads/cutpic','/');
        //创建文件夹
        if (!file_exists($foder)){ mkdir ($foder);}
        $childFoder=$foder.'/'.date("Y-m-d", time());
        if (!file_exists($childFoder)){ mkdir ($childFoder);}
        $file_name=time().'.'.$pathinfo_url['extension'];
        $cutCreateImage = $childFoder.'/'.$file_name;

        if(self::cutPic($post,$cutCreateImage)===false){return '切图失败';}

        $path=str_replace($_SERVER['DOCUMENT_ROOT'],'', $cutCreateImage);
        $info['type'] = $pathinfo_url['extension'];//文件的类型
        $info['name'] = $file_name;                //文件的标题
        $info['url'] = $path;                      //文件的地址
        $info['size'] = 100;                       //文件的大小
        $info['original'] =  $pathinfo_url['basename'];//源文件的名字basename
        $info['keyword'] = $keyword;
        $info['user_id']=$user_id;//上传文件名用户id
        //下面是写入附件信息表
        if((new UploadModel())->addOrSave($info)){
            return array('path'=>$path);
        }else{
            return '保存截图信息失败';
        }
    }

    /**
     * 图片裁剪动作
     * @param $post  图片的地址,裁剪坐标
     * @param $new_path  新的保存地址
     */
    static function cutPic($post,$new_path){
        $url=$_SERVER['DOCUMENT_ROOT'].str_replace('http://'.$_SERVER['HTTP_HOST'],'', $post['url']);
        $img_info = getimagesize($url);
        if($img_info==false){return false;}

        $picwidth=$img_info[0];
        $picheight=$img_info[1];
        //生成图片的质量
        $jpeg_quality = 90;

        switch ($img_info[2]) {
            case 1 :
                $img_r = @imagecreatefromgif($url);
                break;
            case 2 :
                $img_r = @imagecreatefromjpeg($url);
                break;
            case 3 :
                $img_r = @imagecreatefrompng($url);
                break;
        }

        if (function_exists('imagecopyresampled')) {
            $dst_r = ImageCreateTrueColor( $picwidth, $picheight );
            imagecopyresampled($dst_r,$img_r,0,0,$post['x1'],$post['y1'],$picwidth,$picheight,$post['w'],$post['h']);
        } else {
            $dst_r = imagecreate( $picwidth, $picheight );
            imagecopyresized($dst_r,$img_r,0,0,$post['x1'],$post['y1'],$picwidth,$picheight,$post['w'],$post['h']);
        }
        imagejpeg($dst_r, $new_path, $jpeg_quality); //100质量最好，默认75
        //释放与 image 关联的内存
        @imagedestroy($dst_r);
        return true;
    }


    /**
     * 图片缩放处理
     * @param $source_path  资源的地址
     * @param string $wmax  缩放临界宽度
     * @return array
     */
    static function resizeImage($source_path,$wmax='700'){
        $imagedata = getimagesize($source_path);
        $olgWidth = $imagedata[0];
        $oldHeight = $imagedata[1];

        $newWidth=$olgWidth;
        $newHeight=$oldHeight;

        //根据最大值，算出另一个边的长度，得到缩放后的图片宽度和高度,只有宽度太大才操作
        if($olgWidth > $wmax){
            $newWidth = $wmax;
            $newHeight = $oldHeight*($wmax/$olgWidth);

            $image = imagecreatefromjpeg($source_path);
            $thumb = imagecreatetruecolor ($newWidth, $newHeight);
            imagecopyresized ($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $olgWidth, $oldHeight);
            imagejpeg($thumb, $source_path);

            imagedestroy($thumb);
            imagedestroy($image);
        }
        return array('width'=>$newWidth,'height'=>$newHeight);
    }
}