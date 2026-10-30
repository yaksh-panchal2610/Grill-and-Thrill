<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $redirectTo = '/cart';

    // public function __construct()
    // {
    //   $this->middleware('guest')->except('logout');
    // }

    public function guard()
    {
        return Auth::guard('customer');
    }
    public function customerLogin()
    {
        $pageName = 'Login';
        return view('frontend/customer/login', ['pageName' => $pageName]);
    }

    public function customerRegistration()
    {
        $pageName = 'Login';
        return view('frontend/customer/registration', ['pageName' => $pageName]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            $customer_info = Customer::where('email', $request->email)->first();
            session()->put('customer', $customer_info);
            return redirect()->route('checkout');
            // return redirect()->intended('cart')
            //             ->withSuccess('Signed in');
        }


        return redirect("customerlogin")->withInput($request->only('email', 'remember'))->withErrors('Login details are not valid');
    }

    public function storeCustomer(Request $request)
    {

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'contact_no' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'address' => ['required'],
            // 'post_code' => ['required'],
        ]);


        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'contact_no'      => $request->contact_no,
            'password'   => Hash::make($request->password),
            'address'    => $request->address,
            'post_code' => $request->post_code,
        ]);


        session()->put('customer', $customer);


        return redirect()->route('checkout');
    }

    public function customerLogout(Request $request)
    {
        Auth::guard('customer')->logout();

        session()->forget('customer');

        return redirect('/');
    }

    public function customerDashboard()
    {
        $customerinfo = session()->get('customer');
        $customerOrderCount = [];
        $customerOrderCount['current'] = Order::where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->where('customer_id', $customerinfo->id)->count();
        $customerOrderCount['completed'] = Order::where('status', 'completed')->where('customer_id', $customerinfo->id)->count();
        $customerOrderCount['cancelled'] = Order::where('status', 'cancelled')->where('customer_id', $customerinfo->id)->count();
        
        $pageName = 'CustomerDashboard';
        return view('customer/dashboard', ['pageName' => $pageName, 'customerOrderCount' => $customerOrderCount]);
    }
    public function customerBasicLogin()
    {
        $pageName = 'Login';
        return view('frontend/customer/basicLogin', ['pageName' => $pageName]);
    }

    public function basicLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            $customer_info = Customer::where('email', $request->email)->first();
            session()->put('customer', $customer_info);
            return redirect('/');
            // return redirect()->intended('cart')
            //             ->withSuccess('Signed in');
        }


        return redirect("/customer/login")->withInput($request->only('email', 'remember'))->withErrors('Login details are not valid');
    }

    public function orderList($status)
    {
        $customerinfo = session()->get('customer');
        $customerOrderCount = [];
        if ($status == 'current') {
            $allOrders = Order::where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->where('customer_id', $customerinfo->id)->with('order_details', 'customer', 'order_details.product')->get();
            $pageName = 'customer_current_order';
        }else if ($status == 'completed') {
            $allOrders = Order::where('status', 'completed')->where('customer_id', $customerinfo->id)->with('order_details', 'customer', 'order_details.product')->get();
            $pageName = 'customer_completed_order';
        }else if ($status == 'cancelled') {
            $allOrders = Order::where('status', 'cancelled')->where('customer_id', $customerinfo->id)->with('order_details', 'customer', 'order_details.product')->get();
            $pageName = 'customer_cancelled_order';
        }

        $customerOrderCount['current'] = Order::where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->where('customer_id', $customerinfo->id)->count();
        $customerOrderCount['completed'] = Order::where('status', 'completed')->where('customer_id', $customerinfo->id)->count();
        $customerOrderCount['cancelled'] = Order::where('status', 'cancelled')->where('customer_id', $customerinfo->id)->count();
        
        return view('customer/order/list', ['pageName' => $pageName, 'allOrders' => $allOrders, 'customerOrderCount' => $customerOrderCount]);
    }

    public function customerOrderDetails($id)
    {
        $customerinfo = session()->get('customer');
        $customerOrderCount = [];
        $customerOrderCount['current'] = Order::where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->where('customer_id', $customerinfo->id)->count();
        $customerOrderCount['completed'] = Order::where('status', 'completed')->where('customer_id', $customerinfo->id)->count();
        $customerOrderCount['cancelled'] = Order::where('status', 'cancelled')->where('customer_id', $customerinfo->id)->count();

        $orderData = Order::find($id);
        $pageName = 'customer_order_details';

        return view('customer/order/details', ['pageName' => $pageName, 'orderData' => $orderData, 'customerOrderCount' => $customerOrderCount]);
    }
}
