@extends('layout.default')

@section('title','抽奖列表')

    @section('content')
        <h3 style="text-align: center">抽奖活动列表</h3>
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>标题</td>
                <td>开奖时间</td>
                <td>报名人数限制</td>
                <td>是否开奖</td>
                <td>操作</td>
            </tr>
            @foreach($events as $event)
            <tr data-id="{{$event->id}}">
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->prize_date}}</td>
                <td>{{$event->signup_num."人"}}</td>
                <td>{{$event->is_prize==0?"×":"√"}}</td>
                <td>
                    <a href="{{route('event.edit',compact('event'))}}" class="btn btn-sm btn-primary">编辑</a>
                    <a href="{{route('event.show',compact('event'))}}" class="btn btn-sm btn-primary">查看</a>
                    <a href="{{route('show_prize',compact('event'))}}" class="btn btn-sm btn-primary">查看奖品</a>
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
                        url: 'event/'+id,
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