@extends('layouts.master')

@section('title', '商品列表')

@section('sidebar')
    @parent
@endsection

@section('content')

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
@endsection