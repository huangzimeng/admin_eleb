@extends('layout.default')

@section('title','添加管理员')

    @section('content')
        <form method="post" action="{{route('admin.store')}}">
            <div class="form-group">
                <label for="exampleInputEmail1">管理员名称</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1" placeholder="管理员名称">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">邮箱</label>
                <input type="text" name="email" value="{{old('email')}}" class="form-control" id="exampleInputPassword1" placeholder="密码">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">确认密码</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="密码">
            </div>
            <div class="form-group">
                @foreach($roles as $role)
                    <label>
                        <input type="checkbox" name="role[]" value="{{$role->id}}">
                        {{$role->display_name}}
                    </label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            {{csrf_field()}}
        </form>
        @stop