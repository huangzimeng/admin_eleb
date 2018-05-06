@extends('layout.default')

@section('title','菜单列表')

    @section('content')
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>地址</td>
                <td>排序</td>
                <td>操作</td>
            </tr>
            @foreach($data as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->name}}</td>
                <td>{{$menu->address}}</td>
                <td>{{$menu->sort}}</td>
                <td>
                    <a href="{{route('menu.edit',['menu'=>$menu])}}">编辑</a>
                </td>
            </tr>
            @endforeach
        </table>
        @stop