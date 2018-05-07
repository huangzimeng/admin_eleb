@extends('layout.default')

@section('title','管理员列表')

    @section('content')
        <a href="{{route('admin.create')}}" class="btn btn-primary btn-sm">添加</a>
        <p></p>
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>邮箱</td>
                <td>操作</td>
            </tr>
            @foreach($admins as $admin)
            <tr data-id="{{$admin->id}}">
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    <a href="{{route('admin.edit',['admin'=>$admin])}}" class="btn btn-primary btn-sm">编辑</a>
                    <a href="{{route('admin.show',['admin'=>$admin])}}" class="btn btn-primary btn-sm">查看角色</a>
                    <a href="" name="mydelete" class="btn btn-sm btn-danger">删除</a>
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
                        url: 'admin/'+id,
                        data: '_token={{ csrf_token() }}',
                        success: function(msg){
                            tr.fadeOut();
                        }
                    });
                }

            });
        });
    </script>
@stop