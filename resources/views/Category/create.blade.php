@extends('layout.default')
@section('title','添加分类')
    @section('content')
        <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1" placeholder="名称">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">logo</label>
                <input type="file" name="logo">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
        </form>
        @stop