<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(){
        $sites = Site::all();
        return view('test', compact('sites'));
    }
    
}
