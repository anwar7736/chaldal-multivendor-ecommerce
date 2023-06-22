<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = session()->get('cart', []);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);

        if($item->qty <= 0 || $item->qty < $request->quantity)
        {
            return response()->json([
                'status' => false,
                'msg' => 'Stock not available!'
                ], 200);
        }

        if(isset($cart[$request->id]))
        {
            if($cart[$request->id]['quantity'] < $item->qty)
            {
                $cart[$request->id]['quantity'] += 1;
            }
            else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Stock not available!'
                    ], 200);
            }

        }

        else{
            $price = !empty($item->offer_price) ? $item->offer_price : $item->price;
            $cart[$request->id] = [
                'name' => $item ->name,
                'image' => $item ->thumb_image,
                'quantity' => $request->quantity,
                'price' => $price
            ];
        }

        session()->put('cart', $cart);


        return response()->json([
            'status' => true,
            'totalItems' => totalCartItems(),
            'msg' => 'Item has been added!'
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function increaseQty($id)
    {
        $item = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
           $newQty = $cart[$id]['quantity'] + 1;
           if($item->qty < $newQty)
           {
                return response()->json([
                    'status' => false,
                    'msg' => 'Stock not available!'
                    ], 200);
           }

           $cart[$id]['quantity'] =  $newQty;
           session()->put('cart', $cart);

           return response()->json([
               'status' => true,
               'totalItems' => totalCartItems(),
               'msg' => 'Item quantity increased!'
           ], 200);
        }
    }    
    
    public function decreaseQty($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
            if($cart[$id]['quantity'] == 1)
            {
                unset($cart[$id]);
                session()->put('cart', $cart);
                return response()->json([
                    'status' => true,
                    'totalItems' => totalCartItems(),
                    'msg' => 'Item has been removed!'
                ], 200);
            }
            else {
                $cart[$id]['quantity'] -= 1;
                session()->put('cart', $cart);
                return response()->json([
                    'status' => true,
                    'msg' => 'Item quantity decreased!'
                ], 200);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return response()->json([
                'status' => true,
                'totalItems' => totalCartItems(),
                'msg' => 'Item has been removed!',
            ], 200);
        }
    }
}
