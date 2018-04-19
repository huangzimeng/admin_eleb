@extends('layout.default')

@section('title','分类编辑')

    @section('content')
        <form method="post" action="{{route('category.update',['category'=>$category])}}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" name="name" value="{{$category->name}}" class="form-control" id="exampleInputEmail1" placeholder="名称">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">logo</label>
                <img src="{{$category->logo}}" alt="" width="80px">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">修改logo</label>
                <input type="file" name="logo">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @stop