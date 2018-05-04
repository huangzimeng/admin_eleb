@extends('layout.default')

@section('title','权限列表')

    @section('content')
        <a href="{{route('permit.create')}}" class="btn btn-primary btn-sm">添加</a>
        <table class="table table-responsive">
            <tr>
                <td>ID</td>
                <td>name</td>
                <td>display_name</td>
                <td>description</td>
                <td>操作</td>
            </tr>
            @foreach($permissions as $permission)
            <tr data-id="{{$permission->id}}">
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->description}}</td>
                <td>
                    <a href="{{route('permit.edit',['permission'=>$permission])}}" class="btn btn-success btn-sm">编辑</a>
                    <a href="" class="btn btn-danger btn-sm" name="mydelete">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $permissions->links() }}
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
                        url: 'permit/'+id,
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