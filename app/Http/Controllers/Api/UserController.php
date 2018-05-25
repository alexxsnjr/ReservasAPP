<?php

namespace App\Http\Controllers\Api;

use App\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = JWTAuth::toUser($request->token);

        return response()->json(compact('user'));
    }

    public function update(Request $request , $id)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|string|max: 20',

        ]);

        $profesor = Profesor::find($id);
        $profesor->name = $request->name;
        $profesor->email = $request->email;
        $profesor->save();

        return response()->json($profesor,200);

    }

    public function checkPassword(Request $request)
    {
        Auth::shouldUse('api');

        $this->validate($request, [
            'password' => 'required|string',
            'email' => 'required|email',

        ]);
        $credentials = $request->only('email', 'password');
        if  (JWTAuth::attempt($credentials)) {
            return response()->json(true);
        }

        return response()->json(false);

    }

    public function updatePassword(Request $request, $id)
    {
        Auth::shouldUse('api');

        $this->validate($request, [
            'password' => 'required|string',
            'new' => 'required|string',
            'email' => 'required|email',

        ]);
        $credentials = $request->only('email', 'password');
        if  (JWTAuth::attempt($credentials)) {

            $profesor = Profesor::find($id);
            $profesor->password = bcrypt($request->new);
            $profesor->save();

            return response()->json('update',200);

        }



    }
}
