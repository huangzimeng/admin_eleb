<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand glyphicon glyphicon-home" href="{{route('home.index')}}">ELEB</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#" class="">店铺管理<span class="sr-only">(current)</span></a></li>
                <li><a href="#" class="">商家管理</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="">更多+</span><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.index')}}">管理员管理</a></li>
                        <li><a href="{{route('category.index')}}">分类管理</a></li>
                        <li><a href="{{route('activity.index')}}">活动管理</a></li>
                    </ul>
                </li>
            </ul>
            {{--<form class="navbar-form navbar-left">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--</form>--}}
            <ul class="nav navbar-nav navbar-right">
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user">{{\Illuminate\Support\Facades\Auth::user()->name}}</span><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <form action="{{route('logout')}}" method="post">
                            <button class="btn btn-link">注销</button>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a href="{{route('modify')}}" class=" btn btn-link">修改密码</a>
                    </ul>
                </li>
                @endauth
                @guest
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>