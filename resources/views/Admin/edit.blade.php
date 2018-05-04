@extends('layout.default')

@section('title','修改管理员')

@section('content')
    <form method="post" action="{{route('admin.update',['admin'=>$admin])}}">
        <div class="form-group">
            <label for="exampleInputEmail1">管理员名称</label>
            <input type="text" name="name" value="{{$admin->name}}" class="form-control" id="exampleInputEmail1" placeholder="管理员名称">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">邮箱</label>
            <input type="text" name="email" value="{{$admin->email}}" class="form-control" id="exampleInputPassword1" placeholder="密码">
        </div>
        <div class="form-group">
            @foreach($roles as $role)
                <label>
                <input type="checkbox" value="{{$role->id}}" name="role[]" {{$admin->hasRole($role->name)?'checked':''}}>
                    {{$role->display_name}}
                </label>
            @endforeach
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>
@stop