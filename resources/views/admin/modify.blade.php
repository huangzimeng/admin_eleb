@extends('layout.default')

@section('title','修改密码')

    @section('content')
        <form method="post" action="{{route('set_modify')}}">
            <div class="form-group">
                <label for="exampleInputEmail1">旧密码</label>
                <input type="password" name="oldpwd" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">新密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">确认新密码</label>
                <input type="password" name="re_password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-default">点击修改</button>
            {{csrf_field()}}
        </form>
        @stop