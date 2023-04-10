<?php

namespace App\Http\Controllers;
use App\Models\Shoes;
use Illuminate\Http\Request;

class ShoesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $shoes = Shoes::orderBy('id','desc')->paginate(5);
        return view('shoes.index', compact('shoes'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('shoes.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
            'price' => 'required',
        ]);

        Shoes::create($request->post());

        return redirect()->route('shoes.index')->with('success','shoes has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Shoes  $shoes
    * @return \Illuminate\Http\Response
    */
    public function show(Shoes $shoes)
    {
        return view('shoes.show',compact('shoes'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Shoes  $shoes
    * @return \Illuminate\Http\Response
    */
    public function edit(Shoes $shoes)
    {
        return view('shoes.edit',compact('shoes'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\shoes  $shoes
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Shoes $shoes)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
            'price' => 'required',
            // 'quantity' => 'required',
        ]);

        $shoes->fill($request->post())->save();

        return redirect()->route('shoes.index')->with('success','shoes Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\shoes  $shoes
    * @return \Illuminate\Http\Response
    */
    public function destroy(Shoes $shoes)
    {
        $shoes->delete();
        return redirect()->route('shoes.index')->with('success','shoes has been deleted successfully');
    }
}
