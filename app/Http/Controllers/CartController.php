<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
        {
            return response()->json(Cart::with(['order'])->get(),200);
        }

    public function deliverCart(Cart $cart)
        {
            $cart->is_delivered = true;
            $status = $cart->save();

            return response()->json([
                'status'    => $status,
                'data'      => $cart,
                'message'   => $status ? 'Cart Delivered!' : 'Error Delivering Cart'
            ]);
        }

    public function store(Request $request)
    {
        $cart = Cart::create([
            'image' => $request->image,
            'name' => $request->name,
            'user_id' => Auth::id(),
            'order_id' => $request->id,
            'price' => $request->price,
            
        ]);

        return response()->json([
            'status' => (bool) $cart,
            'data'   => $cart,
            'message' => $cart ? 'Cart Created!' : 'Error Creating Cart'
        ]);
    }

    public function show(Cart $cart)
        {
            return response()->json($cart,200);
        }
}
