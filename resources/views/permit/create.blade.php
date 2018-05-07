@extends('layout.default')

@section('title','添加权限')

    @section('content')
        <form method="post" action="{{route('permit.store')}}">
            <div class="form-group">
                <label for="exampleInputEmail1">权限名称</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">显示名</label>
                <input type="text" name="display_name" class="form-control" id="exampleInputPassword1" value="{{old('display_name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">描述</label>
                <input type="text" name="description" class="form-control" id="exampleInputPassword1" value="{{old('description')}}">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
        </form>
        @stop