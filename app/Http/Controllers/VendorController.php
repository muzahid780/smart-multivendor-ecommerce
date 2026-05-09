<?php

namespace App\Http\Controllers;

class VendorController extends Controller
{
    public function dashboard()
    {
        return view('vendor.dashboard');
    }
}