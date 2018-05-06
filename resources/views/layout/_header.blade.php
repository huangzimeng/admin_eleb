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
            {{--菜单动态获取  \App\Menu::menus(0):Menu中的方法 --}}
            <ul class="nav navbar-nav">
                {{--动态输出菜单栏--}}
                {!! \App\Menu::menus() !!}
            </ul>
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