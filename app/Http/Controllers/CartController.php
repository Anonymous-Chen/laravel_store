<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addItem ($productId){

        $cart = Cart::where('user_id',Auth::user()->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
            $cart->save();
        }

        $cartItem  = new Cartitem();
        $cartItem->product_id=$productId;
        $cartItem->cart_id= $cart->id;
        $cartItem->save();

        return redirect('/cart');

    }

    public function showCart(){


        $cart = Cart::where('user_id',Auth::user()->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
            $cart->save();
        }

        $items = $cart->cartItems;
        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }

        return view('cart.view',['items'=>$items,'total'=>$total]);
    }

    public function removeItem($id){

        $cartitem = CartItem::find($id);
        $product = Product::where('id',$cartitem->product_id )->first();
        CartItem::destroy($id);
        return redirect('/cart')->with('success','删除成功-'.$product->name);

    }

}
