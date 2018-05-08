@extends('layout.default')
@section('title','活动列表')

    @section('content')
        @permission('activity.create')
        <a href="{{route('activity.create')}}" class="btn btn-success">添加</a>
        @endpermission
        <p></p>
        <table class="table table-responsive table-bordered">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>开始时间</td>
                <td>结束时间</td>
                @permission('activity.edit|activity.show|activity.destory')
                <td>操作</td>
                @endpermission
            </tr>
            @foreach($activitys as  $activity)
            <tr data-id="{{$activity->id}}">
                <td>{{$activity->id}}</td>
                <td>{{$activity->name}}</td>
                <td>{{$activity->start}}</td>
                <td>{{$activity->end}}</td>
                <td>
                    @permission('activity.edit')
                    <a href="{{route('activity.edit',['activity'=>$activity])}}" class="btn btn-primary btn-sm">编辑</a>
                    @endpermission

                    @permission('activity.show')
                    <a href="{{route('activity.show',['activity'=>$activity])}}" class="btn btn-success btn-sm">查看活动内容</a>
                    @endpermission

                    @permission('activity.destroy')
                    <a href="" class="btn btn-sm btn-danger" name="mydelete">删除</a>
                    @endpermission
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
                        url: 'activity/'+id,
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