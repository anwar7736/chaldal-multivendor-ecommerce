<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\City;
use App\Models\User;
use App\Models\ProductVariantItem;
use Auth, DB;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        if(count($cart) <= 0)
        {
            return redirect()->route('front.home');
        }

        $countries = Country::select('id', 'name')->orderBy('name')->get();

        return view('frontend.cart.checkout', compact('cart', 'countries'));
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

        $inputs = $request->validate([
            'billing_name' => 'required',
            'billing_email' => '',
            'billing_phone' => 'required',
            'billing_address' => 'required',
            'billing_country' => 'required',
            'billing_state' => 'required',
            'billing_city' => 'required',
            'billing_address_type' => 'required',
            'shipping_name' => 'required',
            'shipping_email' => '',
            'shipping_phone' => 'required',
            'shipping_address' => 'required',
            'shipping_country' => 'required',
            'shipping_state' => 'required',
            'shipping_city' => 'required',
            'shipping_address_type' => 'required',
            'payment_method' => 'required',
            'shipping_method' => 'required',
            'transection_id' => '',
        ]);

        $data = [];
        $data['order_id'] = rand();
        $data['user_id'] = Auth::id();
        $data['total_amount'] = cartTotalAmount()['total'];
        $data['product_qty'] = cartTotalAmount()['total_qty'];
        $data['payment_method'] = $request->payment_method;
        $data['shipping_method'] = $request->shipping_method;
        $data['shipping_cost'] = 0;
        $data['coupon_coast'] = 0;
        $data['order_status'] = 0;
        $data['cash_on_delivery'] = 0;
        $data['additional_info'] = 0;
        $data['assign_id'] = User::inRandomOrder()->first()->id;

        try{
            DB::beginTransaction();

            $order = Order::create($data);
            if($order)
            {
                $cart = session()->get('cart', []);
                foreach($cart as $key => $item)
                {

                    $orderProduct = OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $key,
                        'seller_id' => 0,
                        'product_name' => $item['name'],
                        'unit_price' => $item['price'],
                        'qty' => $item['quantity'],
                    ]);

                    if(!empty($item['variation']))
                    {
                        $variation_item = ProductVariantItem::findOrFail($item['variation']);

                        $orderProduct->orderProductVariants()->create([
                            'product_id' => $key,
                            'variant_name' => $variation_item['product_variant_name'],
                            'variant_value' => $variation_item['name'],
                            
                        ]);
                    }

                }

                $order->orderAddress()->create([
                    'billing_name' =>  $request->billing_name,
                    'billing_email' => $request->billing_email,
                    'billing_phone' =>  $request->billing_phone,
                    'billing_address' =>  $request->billing_address,
                    'billing_country' =>  $request->billing_country,
                    'billing_state' =>  $request->billing_state,
                    'billing_city' =>  $request->billing_city,
                    'billing_address_type' =>  $request->billing_address_type,
                    'shipping_email' => $request->shipping_email,
                    'shipping_phone' =>  $request->shipping_phone,
                    'shipping_address' =>  $request->shipping_address,
                    'shipping_country' =>  $request->shipping_country,
                    'shipping_state' =>  $request->shipping_state,
                    'shipping_city' =>  $request->shipping_city,
                    'shipping_address_type' =>  $request->shipping_address_type,
                    'payment_method' => $request->payment_method,
                    'shipping_method' => $request->shipping_method,
                    'transection_id' => $request->transection_id,
                ]);

            }

            DB::commit();

            session()->put('cart', []);

            return response()->json([
                'status' => true,
                'msg' => 'Order placed successfully',
            ], 200);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage(),
            ]);
        }


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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function stateByCountry($id){
        $states = CountryState::where(['status' => 1, 'country_id' => $id])->get();
        $html = "<option value=''>Please Select One</option>";
        foreach($states as $state)
        {
            $html .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return response()->json(['states'=>$states, 'html' => $html]);
    }

    public function cityByState($id){
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->get();
        $html = "<option value=''>Please Select One</option>";
        foreach($cities as $city)
        {
            $html .= "<option value='".$city->id."'>".$city->name."</option>";
        }

        return response()->json(['cities'=>$cities, 'html' => $html]);
    }
}
