<?php
namespace App\Handlers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ThumbImageHandler{
    //制作缩略图
    public function thumb($filename,$width=100,$height=100)
    {
        $path_parts = pathinfo(Storage::url($filename)); //Storage::url($filename);这个才是可用的图片路径
        $i_mg = $path_parts['filename'].'_'.$width.'X'.$height.'.'.$path_parts['extension']; //拼接缩略图文件路径
        $img = Image::make(public_path().Storage::url($filename))->resize($width, $height);//图片资源必须绝对路径!缩略图
        $img->save(public_path().$path_parts['dirname'].'/'.$i_mg);
        return dirname($filename).'/'.$i_mg;
    }
}