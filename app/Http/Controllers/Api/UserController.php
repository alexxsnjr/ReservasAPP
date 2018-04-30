<?php

namespace App\Http\Controllers\Api;

use App\Profesor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = JWTAuth::toUser($request->token);

        return response()->json(compact('user'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|string|max: 20',
            'id' => 'required'
        ]);

        $profesor = Profesor::find($request->id);
        $profesor->name = $request->name;
        $profesor->email = $request->email;
        $profesor->save();

        return response()->json([],200);

    }
}
