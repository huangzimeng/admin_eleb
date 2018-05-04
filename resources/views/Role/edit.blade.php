@extends('layout.default')

@section('title','添加角色')

    @section('content')
        <form method="post" action="{{route('role.update',['role'=>$role])}}">
            <div class="form-group">
                <label for="exampleInputEmail1">name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$role->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">display_name</label>
                <input type="text" name="display_name" class="form-control" id="exampleInputPassword1" value="{{$role->display_name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">description</label>
                <input type="text" name="description" class="form-control" id="exampleInputPassword1" value="{{$role->description}}">
            </div>
            <div class="form-group">
                @foreach($permissionss as $permission)
                    <label>
                        <input type="checkbox" value="{{$permission->id}}" name="role[]"
                                {{$role->hasPermission($permission->name)?'checked':''}}>
                                {{--{{in_array($permission->id,$b)?'checked':''}}>--}}
                        {{$permission->display_name}}
                    </label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @stop