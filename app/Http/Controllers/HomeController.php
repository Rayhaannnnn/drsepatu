<?php

namespace App\Http\Controllers;

use App\Models\ServicePrice;

class HomeController extends Controller
{
    public function index()
    {
        $services = ServicePrice::where('is_active', true)->get();
        return view('home', compact('services'));
    }
}
