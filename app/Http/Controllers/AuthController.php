<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;

class AuthController extends Controller
{
    public function register(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6'
        ]);

        $data = $user->create([
            'name'       => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'api_token' => bcrypt($request->email),
        ]);

        $response = fractal()
                    ->item($data)
                    ->transformWith(new UserTransformer)
                    ->addMeta([
                        'token' => $data->api_token
                    ])
                    ->toArray();

        return response()->json($response, 201);
    }

    public function login(Request $request, User $user)
    {
        if (!Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ])) {
            return response()->json([
                'error' => 'Login fault!!'
            ], 401);
        }

        $data = $user->find(Auth::user()->id);

        return fractal()
                ->item($data)
                ->transformWith(new UserTransformer)
                ->addMeta([
                    'token' => $data->api_token
                ])
                ->toArray();
    }
}
