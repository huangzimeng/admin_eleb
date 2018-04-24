@extends('layout.default')

@section('title','添加活动')

    @section('content')
        <form action="{{route('activity.update',['activity'=>$activity])}}" method="post">
            <!-- 加载编辑器的容器 -->
            <div class="form-group">
                <label for="exampleInputEmail1">活动名称</label>
                <input type="text" name="name" value="{{$activity->name}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">活动内容</label>
                <textarea name="contents" id="container">{{$activity->contents}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">活动开始时间</label>
                <input type="date" name="start" class="form-control" id="exampleInputEmail1" value="{{$activity->start}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">活动结束时间</label>
                <input type="date" name="end" class="form-control" id="exampleInputEmail1" value="{{$activity->end}}">
            </div>
            <input type="submit" value="提交" class="btn btn-success">
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @stop