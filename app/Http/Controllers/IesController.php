<?php

namespace App\Http\Controllers;

use App\Ies;
use Illuminate\Http\Request;

class IesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('asistente');

    }

    public function asistente()
    {

        return view('admin/asistente/index');

    }
}
