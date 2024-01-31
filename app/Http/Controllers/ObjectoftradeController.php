<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\objectoftrade;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PHPUnit\Framework\Constraint\Count;

class ObjectoftradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $ObjectOfTrades = objectoftrade::paginate(3);
        $role = false;
        if(Auth::check()) {
            if(auth()->user()->role == 1)
                $role = true;
        }
        return view('objectoftrade.index', [
            'myobjects' => $ObjectOfTrades,
            'myorders'=>false,
            'orders'=>$this->Authchecking(),
            'role'=>$role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) : View
    {
        return view('objectoftrade.create',['orders'=>$this->Authchecking()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'=>'required|string|min:5|max:255',
            'type'=>'required|string|min:5|max:255',
            'price'=>'required',
            'description'=>'required|string|min:5|max:10000',
            'imagesPath'=>'required|string|min:5|max:255'
        ]);
        $newobject = new objectoftrade();
        $newobject->name = $request->input('name');
        $newobject->type = $request->input('type');
        $newobject->price = $request->input('price');
        $newobject->imagesPath = $request->input('imagesPath');
        $newobject->description = $request->input('description');
        $newobject->save();

//        objectoftrade::created($validated);
//        $request->user()->objectoftrades()->create($validated);
        return redirect()->route('objectoftrade.index',['orders'=>$this->Authchecking()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request) : View
    {
        $role = false;
        if(Auth::check()) {
            if(auth()->user()->role == 1)
                $role = true;
        }
        $id = $request->input('id');
        $myobjects = objectoftrade::all();
        return view('objectoftrade.show', [
            'data' => $myobjects->where('id', $id)->first(),
            'orders'=>$this->Authchecking(),
            'role'=>$role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request) : View
    {
        $role = false;
        if(Auth::check()) {
            if(auth()->user()->role == 1)
                $role = true;
        }
        $id = $request->input('id');
        $myobjects = objectoftrade::all();
        return view('objectoftrade.edit', [
            'myobject' => $myobjects->where('id', $id)->first(),
            'orders'=>$this->Authchecking(),
            'role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id) : View
    {
        $data = $request->validate([
            'id'=>'required',
            'name'=>'required|string|min:5|max:255',
            'type'=>'required|string|min:5|max:255',
            'price'=>'required',
            'description'=>'required|string|min:5|max:10000',
            'imagesPath'=>'required|string|min:5|max:255'
        ]);
        $newobject = new objectoftrade();
        $newobject->id = $request->input('id');
        $newobject->name = $request->input('name');
        $newobject->type = $request->input('type');
        $newobject->price = $request->input('price');
        $newobject->imagesPath = $request->input('imagesPath');
        $newobject->description = $request->input('description');
        //dd($data);s
        //$id = $request->input('id');
        $myobjects = objectoftrade::all();
        $newobject->update($data);
        return view('objectoftrade.show', [
            'data' => $myobjects->where('id', $id)->first(),
            'orders'=>$this->Authchecking()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $myobject = objectoftrade::all()->where('id', $id)->first();
        $myobject->delete();
        return redirect()->route('objectoftrade.index', ['orders'=> $this->Authchecking()]);
    }


    public  function search(Request $request) : View
    {
        dd($request);
        $role = false;
        if(Auth::check()) {
            if(auth()->user()->role == 1)
                $role = true;
        }
        $input = $request->input('search');
        $data = objectoftrade::all()->where('name', 'LIKE', $input)->get()->paginate(3);
        return view('objectoftrade.index', [
            'myobjects' => $data,
            'myorders'=>false,
            'orders'=>$this->Authchecking(),
            'role'=>$role
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
