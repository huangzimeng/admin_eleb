<?php

namespace App\Http\Controllers\Main;

use App\Handlers\ThumbImageHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    //图片上传
    public function upload(Request $request){
        $i_mg = $request->file('file')->store('public/date'.date('md'));//public/RZ7jUQBBPvnuD90Bxr9qz8NXZvTtv36o0aoqKt0g.jpeg
        //本地文件路径: D:\www\admin_eleb\storage\app\public\RZ7jUQBBPvnuD90Bxr9qz8NXZvTtv36o0aoqKt0g.jpeg
//        $path = storage_path("app/".$img);
        $thumbimagehander = new ThumbImageHandler();
        $img = $thumbimagehander->thumb($i_mg);
        try{
            $client = App::make('aliyun-oss');
            $client->uploadFile(getenv('OSS_BUCKET'),$img,storage_path("app/".$img));
            $filename = "https://shop-eleb.oss-cn-beijing.aliyuncs.com/".$img;
        } catch(\OSS\Core\OssException $e) {
            $message = printf($e->getMessage() . "\n");
            session()->flash('danger',$message);
            return redirect()->back()->withInput();
        }
        //返回图片路径
        return ['url'=>$filename];
    }
}
