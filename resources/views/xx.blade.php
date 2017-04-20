<html>
<head>

    <title>Laravel 商店</title>
    <meta name="renderer" content="webkit">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@section('sidebar')
    <nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url("/")}}">Laravel 商店</a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li><a href="{{url("/order")}}">我的订单 <span class="fa fa-briefcase"></span></a></li>
                        <li><a href="{{url("/cart")}}">购物车 <span class="fa fa-shopping-cart"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
@show

<div class="container">


        <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{url('admin/product/new')}}" class="btn btn-success">新增商品</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div> </div>
                    <table class="table table-striped">
                        <thead>
                        <td>名称</td>
                        <td>价格</td>
                        <td>文件</td>
                        <td>操作</td>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>￥{{$product->price}}</td>
                                <td>{{$product->file->original_filename}}</td>
                                <td><a href="{{url("/admin/product/destroy")}}/{{$product->id}}" class="btn btn-danger">删除</a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>