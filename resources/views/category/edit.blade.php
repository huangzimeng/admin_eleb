@extends('layout.default')

@section('title','分类编辑')

    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form method="post" action="{{route('category.update',['category'=>$category])}}">
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" name="name" value="{{$category->name}}" class="form-control" id="exampleInputEmail1" placeholder="名称">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">logo</label>
                <img src="{{$category->logo}}" alt="" width="80px">
            </div>

            <div>
                <img src="" alt="" id="myimg" width="80px">
            </div>
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
                {{--上传图片隐藏域--}}
                <input type="hidden" name="logo" value="" id="mylogo">
            </div>

            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @stop

@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: '/webuploader/Uploader.swf',
            // 文件接收服务端。
            server: '/upload',

            formData:{'_token':"{{ csrf_token() }}"},
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
        uploader.on( 'uploadSuccess', function( file,response) {
            var url = response.url;
            $("#myimg").attr('src',url);
            $("#mylogo").val(url);
        });
    </script>
    @stop