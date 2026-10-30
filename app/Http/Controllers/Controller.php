<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $orderCount = [];
    
    public function __construct(){
        $this->orderCount['new'] = Order::where('status', 'new')->count();
        $this->orderCount['preparing'] = Order::where('status', 'preparing')->count();
        $this->orderCount['sent_to_delivery'] = Order::where('status', 'sent_to_delivery')->count();
        $this->orderCount['completed'] = Order::where('status', 'completed')->count();
        $this->orderCount['cancelled'] = Order::where('status', 'cancelled')->count();
    }
}
