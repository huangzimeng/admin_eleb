@extends('layout.default')
@section('title','添加商铺')

    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form method="post" action="{{route('home.store')}}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">店铺名称</label>
                <input type="text" value="{{old('name')}}" name="name" class="form-control" id="exampleInputEmail1" placeholder="请输入店铺名称">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">邮箱</label>
                <input type="text" value="{{old('email')}}" name="email" class="form-control" id="exampleInputEmail1" placeholder="请输入邮箱">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="请尽量设置安全的密码">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">确认密码</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="必须和密码一致">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">起送金额</label>
                <input type="text" name="start_send" value="{{old('start_send')}}" class="form-control" id="exampleInputEmail1" placeholder="起送金额">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">配送费</label>
                <input type="text" name="send_cost" value="{{old('send_cost')}}" class="form-control" id="exampleInputEmail1" placeholder="配送费">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺公告</label>
                <input type="text" name="notice" value="{{old('notice')}}" class="form-control" id="exampleInputEmail1" placeholder="店铺公告">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">优惠信息</label>
                <input type="text" name="discount" value="{{old('discount')}}" class="form-control" id="exampleInputEmail1" placeholder="优惠信息">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺地址</label>
                <input type="text" name="address" value="{{old('address')}}" class="form-control" id="exampleInputEmail1" placeholder="店铺地址">
            </div>

            <div class="form-group">
                <img src="" alt="" id="myimg" width="80px">
            </div>
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <input type="hidden" name="shop_img" id="myinput" value="">

            <div class="form-group">
                <label for="exampleInputPassword1">类型</label>
                <select name="category_id">
                    @foreach($category as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                是否是品牌: &emsp;
                <label>是<input type="radio" name="brand" value="1" @if(old('brand')) checked @endif></label>
                <label>不是<input type="radio" name="brand" value="0" @if(old('brand')) checked @endif></label>
            </div>
            <div class="form-group">
                是否准时达: &emsp;
                <label>是<input type="radio" name="on_time" value="1" @if(old('on_time')) checked @endif></label>
                <label>不是<input type="radio" name="on_time" value="0" @if(old('on_time')) checked @endif></label>
            </div>
            <div class="form-group">
                是否是蜂鸟配送: &emsp;
                <label>是<input type="radio" name="fengniao" value="1" @if(old('fengniao')) checked @endif></label>
                <label>不是<input type="radio" name="fengniao" value="0" @if(old('fengniao')) checked @endif></label>
            </div>
            <div class="form-group">
                是否保标记: &emsp;
                <label>是<input type="radio" name="bao" value="1" @if(old('bao')) checked @endif></label>
                <label>不是<input type="radio" name="bao" value="0" @if(old('bao')) checked @endif></label>
            </div>
            <div class="form-group">
                是否票标记: &emsp;
                <label>是<input type="radio" name="piao" value="1" @if(old('piao')) checked @endif></label>
                <label>不是<input type="radio" name="piao" value="0" @if(old('piao')) checked @endif></label>
            </div>
            <div class="form-group">
                是否准标记: &emsp;
                <label>是<input type="radio" name="zhun" value="1" @if(old('zhun')) checked @endif></label>
                <label>不是<input type="radio" name="zhun" value="0" @if(old('zhun')) checked @endif></label>
            </div>
            <input type="submit" value="提交">
            {{csrf_field()}}
        </form>
        @stop

@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: '/webuploader/Uploader.swf',
            // 文件接收服务端。
            server: '/upload',

            formData:{'_token':"{{csrf_token()}}"},
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file,response ) {
            var url = response.url;
            $("#myimg").attr('src',url);
            $('#myinput').val(url);
        });
    </script>
    @stop