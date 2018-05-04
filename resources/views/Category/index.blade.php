@extends('layout.default')

@section('title','分类列表')

    @section('content')
        <a href="{{route('category.create')}}" class="btn btn-sm btn-info">添加</a>
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>logo</td>
                <td>操作</td>
            </tr>
            @foreach($categorys as $category)
            <tr data-id="{{$category->id}}">
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td><img src="{{$category->logo}}" style="width: 80px"></td>
                <td>
                    <a href="{{route('category.edit',['category'=>$category])}}" class="btn btn-sm btn-primary">编辑</a>
                    <a href=""  class="btn btn-danger btn-sm" name="mydelete">删除</a>
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
                        url: 'category/'+id,
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