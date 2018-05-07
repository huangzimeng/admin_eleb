@extends('layout.default')

@section('title','添加奖品')

    @section('content')
        <form method="post" action="{{route('event_prize.update',['event_prize'=>$event_prize])}}">
            <div class="form-group">
                <label for="exampleInputEmail1">奖品名称</label>
                <input type="text" name="name" value="{{$event_prize->name}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">详情</label>
                <input type="text" name="description" value="{{$event_prize->description}}" class="form-control" id="exampleInputPassword1" >
            </div>
            <label for="exampleInputPassword1">活动名称</label>
            <div>
                <select name="events_id">
                    @foreach($events as $event)
                    <option value="{{$event->id}}"
                    @if($event_prize->events_id == $event->id) selected
                    @endif
                    >{{$event->title}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @stop