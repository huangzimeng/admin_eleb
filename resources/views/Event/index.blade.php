@extends('layout.default')

@section('title','抽奖列表')

    @section('content')
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>标题</td>
                <td>开始报名时间</td>
                <td>结束报名时间</td>
                <td>开奖时间</td>
                <td>报名人数限制</td>
                <td>是否开奖</td>
                <td>操作</td>
            </tr>
            @foreach($events as $event)
            <tr data-id="{{$event->id}}">
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->signup_start}}</td>
                <td>{{$event->signup_end}}</td>
                <td>{{$event->prize_date}}</td>
                <td>{{$event->signup_num}}</td>
                <td>{{$event->is_prize==0?"×":"√"}}</td>
                <td>
                    <a href="{{route('event.edit',['enent'=>$event])}}" class="btn btn-sm btn-primary">编辑</a>
                    <a href="{{route('event.show',['enent'=>$event])}}" class="btn btn-sm btn-primary">查看</a>

                    @if($event->is_prize)
                    <a href="{{route('show_members',['enent'=>$event])}}" class="btn btn-sm btn-primary">查看中奖名单</a>
                    @else
                    <a href="{{route('start_prize',['enent'=>$event])}}" class="btn btn-sm btn-success">开始抽奖</a>
                    @endif

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