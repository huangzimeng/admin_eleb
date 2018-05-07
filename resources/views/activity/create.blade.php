@extends('layout.default')

@section('title','添加活动')

    @section('content')
        <form action="{{route('activity.store')}}" method="post">
            <!-- 加载编辑器的容器 -->
            <div class="form-group">
                <label for="exampleInputEmail1">活动名称</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">活动内容</label>
                <textarea name="contents" id="container" cols="30" rows="10">{{old('contents')}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">活动开始时间</label>
                <input type="date" name="start" class="form-control" id="exampleInputEmail1" value="{{old('start')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">活动结束时间</label>
                <input type="date" name="end" class="form-control" id="exampleInputEmail1" value="{{old('end')}}">
            </div>
            <input type="submit" value="提交" class="btn btn-success">
            {{csrf_field()}}
        </form>
        @stop