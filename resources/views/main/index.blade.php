@extends('layouts.master')


@section('title', '商品列表')


@section('js')

@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <br><br><br>
    <div class="container">
        <div class="row">
            @foreach ($products as $product)

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{$product->imageurl}}" alt="..." width="200" height="200">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach ($products as $product)

                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail" >
                            <div  align="center"><img src="{{$product->imageurl}}" class="img-responsive"  ></div>

                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <h3>{{$product->name}}</h3>
                                    </div>
                                    <div class="col-md-6 col-xs-6 price">
                                        <h3>
                                            <label>￥{{$product->price}}</label></h3>
                                    </div>
                                </div>
                                <p>{{$product->description}}</p>
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <p><a href="{{ url('/order/result1',['id'=> $product->id])}}" class="btn btn-info btn-product"
                                              onclick="if(confirm('确认立即购买？') == false) return false"
                                            ><span class="fa fa-shopping-cart"></span> 购买</a>&nbsp;&nbsp;
                                        <a href="{{ url('/addProduct',['id'=> $product->id])}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> 加入购物车</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div>
        <div class="pull-right" >
            {{$products->render()}}
        </div>
    </div>

@endsection