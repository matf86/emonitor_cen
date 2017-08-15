<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Place;

class OffersController extends Controller
{
    /**
     * Display a listing of the offers.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request)
    {
        try {
            Cache::rememberForever('place-'.$slug, function () use ($slug) {
                return Place::whereSlug($slug)->firstOrFail();
            });
        } catch(\Exception $exception) {
            return response()->redirectToRoute('home')
                ->with('page-not-found', "Brak podstrony dla adresu: ". $request->fullUrl());
        }

        return view('products');
    }

}
