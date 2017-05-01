@extends('layouts.master')

@section('购买结果', 'Page Title')




@section('content')
    <form action="{{url('/order/result2')}}" method="post">
        {{ csrf_field() }}
        Last name: <input type="text" name="lname" />
        <button type="submit" class="btn btn-success">
            结算 <span class="fa fa-play"></span>
        </button>
    </form>

@endsection