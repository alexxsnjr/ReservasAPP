<?php

namespace App\Http\Controllers;

use App\Centro;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('primerlogin');
    }

    public function index()
    {
        return view('admin/admin');
    }

}
