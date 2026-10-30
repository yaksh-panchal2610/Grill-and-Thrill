<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\ProductDrink;
use App\Models\ProductFlavour;
use App\Models\ProductSauce;
use App\Models\ProductSide;
use App\Models\ProductVariation;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageName = 'cart';
        $cartItems = Cart::getContent();
        // dd(Auth());
        // session()->forget('customer');

        return view('frontend/cart', ['pageName' => $pageName, 'cartItems' => $cartItems]);
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
        //
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
        Cart::remove($id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.index');
    }

    public function updateCart(Request $request)
    {
        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.index');
    }
    public function updateProductCart($id, $quantity)
    {
        Cart::update(
            $id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $quantity
                ],
            ]
        );

        $response = array(
            'success'  => true,
            'id'       => $id,
            'message'  => 'Successfully Added'
        );
        return response()->json($response);


        // session()->flash('success', 'Item Cart is Updated Successfully !');

        // return redirect()->route('cart.index');
    }


    public function clearAllCart()
    {
        Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.index');
    }


    public function addToCart(Request $request, $id)
    {
        //////validation start
        $productFlavourCount = ProductFlavour::where('product_id', $id)->count();
        $productDrinkCount = ProductDrink::where('product_id', $id)->count();
        $productSauceCount = ProductSauce::where('product_id', $id)->count();
        $productSideCount = ProductSide::where('product_id', $id)->count();

        $validationParameters = array();
        $validationParameters['variation'] = 'required';

        if ($productFlavourCount > 0) {
            $validationParameters['flavour'] = 'required';
        }
        if ($productSideCount > 0) {
            $validationParameters['side'] = 'required';
        }
        if ($productSauceCount > 0) {
            $validationParameters['sauce'] = 'required';
        }
        if ($request->variation != '') {
            $variationInfo = ProductVariation::where('product_id', $id)->where('name', $request->variation)->first();
            if ($productDrinkCount > 0 && $variationInfo->type == 'meal') {
                $validationParameters['drink'] = 'required';
            }
        }
        $request->validate($validationParameters);


        //////validation ends

        $selectedRemovablesString = '';
        $selectedRemovables = $request->removables;
        if (isset($selectedRemovables)) {
            foreach ($selectedRemovables as $removable) {
                if ($selectedRemovablesString == '') {
                    $selectedRemovablesString .= $removable;
                } else {
                    $selectedRemovablesString .= ', ';
                    $selectedRemovablesString .= $removable;
                }
            }
        }

        $cartItems = Cart::getContent();
        $productNewOrOld = 'new';
        $oldProductUniqueId = 0;
        foreach ($cartItems as $key => $item) {
            if ($id == $item['attributes']['product_id'] && $request->variation == $item['attributes']['variation'] && $request->flavour == $item['attributes']['flavour'] && $request->side == $item['attributes']['side'] && $request->sauce == $item['attributes']['sauce'] && $request->drink == $item['attributes']['drink'] && $selectedRemovablesString == $item['attributes']['removable']) {
                $productNewOrOld = 'old';
                $oldProductUniqueId = $key;
            }
        }

        if ($productNewOrOld == 'new') {
            $itemInfo = Product::find($id);
            $uniqueId = Cart::getContent()->count();
            Cart::add([
                'id'         => $uniqueId,
                'name'       => $itemInfo->name,
                'price'      => $variationInfo->price,
                'quantity'   => $request->quantity,
                'attributes' => array(
                    'product_id'  => $id,
                    'image'  => $itemInfo->image,
                    'variation'  => $request->variation,
                    'flavour' => $request->flavour,
                    'side'   => $request->side,
                    'sauce'  => $request->sauce,
                    'drink'  => $request->drink,
                    'removable'  => $selectedRemovablesString,
                )
            ]);
        } else {
            Cart::update(
                $oldProductUniqueId,
                [
                    'quantity' => [
                        'relative' => true,
                        'value' => $request->quantity
                    ],
                ]
            );
        }

        $cartqty = Cart::getContent()->count();
        $response = array(
            'oldOrNew'  => $productNewOrOld,
            // 'uniqueId'  => $uniqueId,
            'success'  => true,
            'id'       => $id,
            'cqty'     => $cartqty,
            'message'  => 'Successfully Added'
        );
        return response()->json($response);
    }

    public function checkout()
    {
        $pageName = 'cart';
        $cartItems = Cart::getContent();
        if (count($cartItems) == 0) {
            return redirect()->route('cart.index');
        }

        // session()->forget('customer');
        // $customer_info = Customer::find(1);
        // session()->put('customer', $customer_info);
        $customerinfo = session()->get('customer');
        if (empty($customerinfo)) {
            return redirect()->route('customer.login');
        }
        return view('frontend/checkout', ['pageName' => $pageName, 'cartItems' => $cartItems, 'customer' => $customerinfo]);
    }


    public function paymentProcess(Request $request)
    {
        $validationRules['delivery_method'] = 'required';
        $this->validate($request, $validationRules);
        if ($request->delivery_method == 'Delivery') {
            $validationRules['address'] = 'required';
        }
        $this->validate($request, $validationRules);

        $address = 'N/A';
        if ($request->delivery_method == 'Delivery') {
            $address = $request->address;
        }


        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $customerinfo = session()->get('customer');
        $products =  Cart::getContent();

        $lineItems = [];

        $totalPrice = 0;
        foreach ($products as $item) {
            $totalPrice += $item->quantity * $item->price;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => $item->name,
                        'images' => [$item->attributes['image']]
                    ],
                    'unit_amount' => $item->quantity * $item->price * 100,
                ],
                'quantity' => 1,
            ];
        }
        ////for delivery charge
        $delivery_charge = 300;
        if ($totalPrice > 30 || $request->delivery_method == 'Pickup') {
            $delivery_charge = 0;
        }
        // if ($totalPrice <= 30) {
        //     $lineItems[] = [
        //         'price_data' => [
        //             'currency' => 'gbp',
        //             'product_data' => [
        //                 'name' => 'Delivery Charge'
        //             ],
        //             'unit_amount' => $delivery_charge,
        //         ],
        //         'quantity' => 1,
        //     ];
        // }
        ////for delivery charge
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            // 'discounts' => [['coupon' => 'KS5mzhEF']],
            'shipping_options' => [
                [
                    'shipping_rate_data' => [
                        'type' => 'fixed_amount',
                        'fixed_amount' => [
                            'amount' => $delivery_charge,
                            'currency' => 'gbp',
                        ],
                        'display_name' => 'Delivery Charge',
                    ],
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}&delivery_method=$request->delivery_method&address=$address",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        // $order = new Order();
        // $order->payment_status      = 'unpaid';
        // $order->status      = 'new';
        // $order->customer_id = $customerinfo->id;
        // $order->delivery_charge = $delivery_charge/100;
        // $order->address = $customerinfo->address;
        // $order->date        = date('Y-m-d');
        // $order->total_price = $totalPrice;
        // $order->session_id  = $session->id;
        // $order->save();

        // foreach ($products as $item) {

        //     $details = new OrderDetails();
        //     $details->order_id    = $order->id;
        //     $details->product_id = $item->attributes['product_id'];
        //     $details->quantity = $item->quantity;
        //     $details->price = $item->price;
        //     $details->variation = $item->attributes['variation'];
        //     $details->flavour = $item->attributes['flavour'];
        //     $details->side = $item->attributes['side'];
        //     $details->sauce = $item->attributes['sauce'];
        //     $details->drink = $item->attributes['drink'];
        //     $details->removable = $item->attributes['removable'];
        //     $details->save();
        // }
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        try {
            $customerinfo = session()->get('customer');
            $products =  Cart::getContent();

            $totalPrice = 0;
            foreach ($products as $item) {
                $totalPrice += $item->quantity * $item->price;
            }
            ////for delivery charge
            $delivery_charge = 300;
            if ($totalPrice > 30) {
                $delivery_charge = 0;
            }
            ////for delivery charge

            $order = new Order();
            $order->payment_status      = 'paid';
            $order->status      = 'new';
            $order->customer_id = $customerinfo->id;
            $order->delivery_charge = $delivery_charge / 100;
            $order->delivery_method = $request->get('delivery_method');
            $order->address = $request->get('address');
            $order->date        = date('Y-m-d');
            $order->total_price = $totalPrice;
            $order->session_id  = $request->get('session_id');
            $order->save();

            foreach ($products as $item) {

                $details = new OrderDetails();
                $details->order_id    = $order->id;
                $details->product_id = $item->attributes['product_id'];
                $details->quantity = $item->quantity;
                $details->price = $item->price;
                $details->variation = $item->attributes['variation'];
                $details->flavour = $item->attributes['flavour'];
                $details->side = $item->attributes['side'];
                $details->sauce = $item->attributes['sauce'];
                $details->drink = $item->attributes['drink'];
                $details->removable = $item->attributes['removable'];
                $details->save();
            }


            // $session = \Stripe\Checkout\Session::retrieve($sessionId);
            Cart::clear();
            // $order = Order::where('session_id', $session->id)->first();
            // if ($order->payment_status === 'unpaid') {
            //     $order->payment_status = 'paid';
            //     $order->save();
            // }

            return redirect()->route('cart.order.confirm');
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->withErrors($e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route('checkout')->withErrors('You Have cancel Your Payment');
    }

    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->payment_status === 'unpaid') {
                    $order->payment_status = 'paid';
                    $order->save();
                    // Send email to customer
                }

                // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }

    public function orderConfirm()
    {
        $pageName = 'cart';

        return view('frontend/order-confirm', ['pageName' => $pageName]);
    }
}
