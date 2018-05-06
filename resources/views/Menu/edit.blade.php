@extends('layout.default')

@section('title','添加菜单')

    @section('content')
        <form method="post" action="{{route('menu.update',['menu'=>$menu])}}">
            <div class="form-group">
                <label for="exampleInputEmail1">菜单名称</label>
                <input type="text" name="name" value="{{$menu->name}}" class="form-control" id="exampleInputEmail1">
            </div>
            <label for="exampleInputPassword1">上级菜单</label>
            <div class="form-group">
                <select name="parent_id">
                    <option value="">==顶级菜单==</option>
                @foreach($data as $v)
                    <option value="{{$v->id}}"
                    @if($v->id == $menu->parent_id) selected
                    @endif
                    >{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
            <label for="exampleInputEmail1">路由</label>
            <div class="form-group">
                <select name="address" id="">
                    @foreach($permissions as $permission)
                    <option value="{{$permission->name}}"
                    @if($menu->address == $permission->name) selected
                    @endif
                    >{{$permission->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">排序</label>
                <input type="text" name="sort" value="{{$menu->sort}}" class="form-control" id="exampleInputEmail1">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @stop