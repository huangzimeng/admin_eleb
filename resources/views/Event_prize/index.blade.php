@extends('layout.default')

@section('title','奖品列表')

    @section('content')
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>活动名称</td>
                <td>奖品名称</td>
                <td>奖品描述</td>
                <td>中奖店铺</td>
                <td>操作</td>
            </tr>
            @foreach($event_prizes as $event_prize)
            <tr data-id="{{$event_prize->id}}">
                <td>{{$event_prize->id}}</td>
                <td>{{$event_prize->enent->title}}</td>
                <td>{{$event_prize->name}}</td>
                <td>{{$event_prize->description}}</td>
                <td>{{$event_prize->member_id==0?"无":$event_prize->member->shop_name}}</td>
                <td>
                    <a href="{{route('event_prize.edit',['event_prize'=>$event_prize])}}" class="btn btn-sm btn-primary">编辑</a>
                    <a href="" name="mydelete" class="btn btn-sm btn-danger">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $event_prizes->links() }}
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
                        url: 'event_prize/'+id,
                        data: '_token={{ csrf_token() }}',
                        success: function(msg){
                            if (msg == 0){
                                alert('奖品未领奖!不能删除!')
                            }else {
                                tr.fadeOut();
                            }
                        }
                    });
                }

            });
        });
    </script>
@stop