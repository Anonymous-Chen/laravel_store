<?php

namespace App\Http\Controllers;


use App\Cart;
use App\CartItem;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


use App\Http\Requests;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function result( $id){


        $order = Order::where('user_id',Auth::user()->id)->first();

        $cartitem = CartItem::find($id);


        if(!$order){
            $order =  new Order();
            $order->user_id=Auth::user()->id;
            $order->save();
        }

        $orderItem =new OrderItem();
        $orderItem->product_id=$cartitem->product_id;
        $orderItem->order_id= $cartitem->cart_id;
        $orderItem->save();

        CartItem::destroy($id);
        $orderItems = array( $orderItem );
        $total = $orderItem->product->price;
        return view('order.result',['items'=>$orderItems,'total'=>$total]);

    }

    public function result1( $id){


        $order = Order::where('user_id',Auth::user()->id)->first();


        if(!$order){
            $order =  new Order();
            $order->user_id=Auth::user()->id;
            $order->save();
        }

        $orderItem =new OrderItem();
        $orderItem->product_id=$id;
        $orderItem->order_id= $order->id;
        $orderItem->save();


        $orderItems = array( $orderItem );
        $total = $orderItem->product->price;
        return view('order.result',['items'=>$orderItems,'total'=>$total]);


    }

    public function result2( Request $request ){


        $ids = $request->input('subBox');

        $order = Order::where('user_id',Auth::user()->id)->first();


        if(!$order){
            $order =  new Order();
            $order->user_id=Auth::user()->id;
            $order->save();
        }

        $orderItems = array();
        $total = 0;

        foreach ( $ids as  $num => $id){


            $cartitem = CartItem::find($id);


            $orderItem =new OrderItem();
            $orderItem->product_id=$cartitem->product_id;
            $orderItem->order_id= $cartitem->cart_id;
            $orderItem->save();
            $total += $orderItem->product->price;


            $orderItems[$num] = $orderItem;

            CartItem::destroy($id);
        }



        return view('order.result',['items'=>$orderItems,'total'=>$total]);



    }

    public function lists( Request $requset ){

        $order = Order::where('user_id',Auth::user()->id)->first();

        if(!$order){
            $order =  new Order();
            $order->user_id=Auth::user()->id;
            $order->save();
        }

        $items = $order->orderItems;

        $lists = array();
        $liststotal = array();

        foreach ( $items as $item){
            $lists[(string)$item->created_at][$item->id] = $item;
            if ( array_key_exists( (string)$item->created_at , $liststotal )  ){
                $liststotal[(string)$item->created_at] += $item->product->price;
            }else{
                $liststotal[(string)$item->created_at] = $item->product->price;
            }

        }
//        dd($lists);




        return view('order.lists',['lists'=>$lists,'liststotal'=>$liststotal]);



    }



//  ajax测试 弃用
    public function te( $x1,$x2 ){


        if ( Session::has('id'.$x1) ){
            Session::forget('id'.$x1);
            $account = Session::get('account');
            Session::put('account',$account-$x2);

        }else{
            Session::put('id'.$x1,$x2);
            $account = Session::get('account');
            Session::put('account',$account+$x2);
        }
        $msg = Session::get('account');
        return response()->json(array('msg'=> $msg), 200);
    }


}
