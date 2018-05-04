@extends('layout.default')

@section('title','角色列表')

    @section('content')
        <h3 style="text-align: center">角色列表</h3>
        <a href="{{route('role.create')}}" class="btn btn-sm btn-primary">添加角色</a>
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>描述</td>
                <td>操作</td>
            </tr>
            @foreach($roles as $role)
            <tr data-id="{{$role->id}}">
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->description}}</td>
                <td>
                    <a href="{{route('role.edit',['role'=>$role])}}">修改</a>
                    <a href="{{route('role.show',['role'=>$role])}}">查看</a>
                    <a href="" name="mydelete">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
        @stop

@section('js')
    <script type="text/javascript">
        $(function () {
            $('a[name=mydelete]').click(function () {
                //发送ajax请求
                if (confirm('确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.data('id');
                    $.ajax({
                        type: "DELETE",
                        url: 'role/'+id,
                        data: '_token={{ csrf_token() }}',
                        success: function(msg){
//                            tr.fadeOut();
                            console.debug(msg)
                        }
                    });
                }

            });
        });
    </script>
@stop