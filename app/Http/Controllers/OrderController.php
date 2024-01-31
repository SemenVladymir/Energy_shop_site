<?php

namespace App\Http\Controllers;

use App\Models\objectoftrade;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index() : View
    {
        $summ = 0;
        if(Auth::check()) {
            $allorders = Order::all()->where('userid', Auth::id());
            foreach ($allorders as $item)
                $summ += objectoftrade::all()->where('id',$item->objectid)->first()->price;
        }
        else {
            $allorders = Order::all()->where('status', false)->where('userid', 0);
            foreach ($allorders as $item)
                $summ += objectoftrade::all()->where('id',$item->objectid)->first()->price;
        }
        return view('order.index', [
            'myobjects' => $allorders,
            'myorders'=>false,
            'orders'=>$this->Authchecking(),
            'summa' => $summ
        ]);
    }

    public function create(Request $request) : View
    {
        $role = false;
        if(Auth::check()) {
            if(auth()->user()->role == 1)
                $role = true;
        }
        $id = $request->input('id');
        if (Order::all()->where('id', $id) != null) {
            $neworder = new order();
            $neworder->objectid = $request->input('id');
            $neworder->userid = (Auth::check()) ? Auth::id() : 0;
            $neworder->date = date('d-m-Y H:i:s');
            $neworder->status = false;
            $neworder->save();
            }
        $ObjectOfTrades = objectoftrade::all();
        return view('objectoftrade.index', [
            'myobjects' => $ObjectOfTrades,
            'myorders'=>false,
            'orders'=>$this->Authchecking(),
            'role'=>$role
        ]);
    }

    public function delete(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $order = Order::all()->where('id', $id)->first();
        $order->delete();
        return redirect()->route('order.index');
    }

    public function buying(){
        $summ = 0;

        if(Auth::check()) {
            $allorders = Order::all()->where('userid', Auth::id())->where('status', false);
            foreach ($allorders as $item) {
                $item->status = true;
                $item->update();
            }
        }
        else {
            $allorders = Order::all();
            foreach ($allorders as $item) {
                $item->status = true;
                $item->update();
            }
        }
        return view('order.index', [
            'myobjects' => $allorders,
            'myorders'=>false,
            'orders'=>0,
            'summa' => $summ
        ]);
    }

    public function Authchecking()
    {
        if(Auth::check())
            $orders = Order::all()->where('userid',Auth::id())->where('status', false)->count();
        else
            $orders = Order::all()->where('userid', 0)->where('status', false)->count();
        return $orders;
    }

}
