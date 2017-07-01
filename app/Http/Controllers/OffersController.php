<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the offers.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request)
    {
        return view('products');
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
}
