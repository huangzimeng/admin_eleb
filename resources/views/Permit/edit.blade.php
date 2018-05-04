@extends('layout.default')

@section('title','编辑权限')

    @section('content')
        <form method="post" action="{{route('permit.update',['permit'=>$permit])}}">
            <div class="form-group">
                <label for="exampleInputEmail1">name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$permit->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">display_name</label>
                <input type="text" name="display_name" class="form-control" id="exampleInputPassword1" value="{{$permit->display_name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">description</label>
                <input type="text" name="description" class="form-control" id="exampleInputPassword1" value="{{$permit->description}}">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @stop