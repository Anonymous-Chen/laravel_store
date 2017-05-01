@extends('layouts.master')

@section('title', '购买结果')

@section('js')
    <script type="text/javascript">
        setTimeout("window.location.href='{{url("/")}}';", 3000 );
    </script>
@endsection


@section('sidebar')
    @parent
@endsection

@section('content')
    <br><br><br>

    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>商品</th>
                    <th></th>
                    <th class="text-center"></th>
                    <th class="text-center">小计</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>

                    @foreach( $items as $item)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{$item->product->imageurl}}" style="width: 100px; height: 72px;"> </a>
                                <div class="media-body" style=" text-align:center;" >
                                    <h4 class="media-heading"><a href="#">{{$item->product->name}}</a></h4>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->product->price}}</strong></td>
                        <td class="col-sm-1 col-md-1">
                        </td>
                        <td class="col-sm-1 col-md-1">
                        </td>
                    </tr>
                    @endforeach


                </tbody>
                <tfoot>
                    `<tr>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>总价</h3></td>
                        <td class="text-right"><h3><strong>{{$total}}</strong></h3></td>
                        <td>   </td>
                    </tr>
                    <tr>
                        <td><div style=" text-align:right;" ><h3>付款成功,3S后自动返回 </h3></div> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td ></td>
                    </tr>
                    <tr>
                        <td><div style=" text-align:right;" ><h4><a href="{{url("/")}}" >若浏览器没反应，则点击此处</a> </h4></div> </td>
                        <td>   </td>
                        <td>   </td>
                        <td>

                        <td>

                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection