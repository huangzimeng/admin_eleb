@extends('layout.default')

@section('title','添加菜单')

    @section('content')
        <form method="post" action="{{route('menu.store')}}">
            <div class="form-group">
                <label for="exampleInputEmail1">菜单名称</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1">
            </div>
            <label for="exampleInputPassword1">上级菜单</label>
            <div class="form-group">
                <select name="parent_id">
                    <option value="0">==顶级菜单==</option>
                @foreach($menus as $menu)
                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach
                </select>
            </div>
            <label for="exampleInputEmail1">地址(路由)</label>
            <div class="form-group">
                <select name="address" id="">
                    @foreach($permission as $value)
                    <option value="{{$value->name}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">排序</label>
                <input type="text" name="sort" value="{{old('sort')}}" class="form-control" id="exampleInputEmail1">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
        </form>
        @stop