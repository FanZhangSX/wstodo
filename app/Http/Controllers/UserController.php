<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;

class UserController extends Controller
{
    public function index() 
    {
        return response()->json(User::with(['Todos'])->get());
    }

    // api/login
    public function login(Request $request) 
    {
        $status = 401;
        $response = ['error' => 'unauthorised'];

        if(Auth::attempt($request->only(['email', 'password']))) 
        {
            $status = 200;
            $response = [
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('xxxx')->accessToken,
            ];
        }

        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $status = 401;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()
            ], $status);
        }

        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('xxxx')->accessToken,
        ]);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function showTodos(User $user)
    {
        return response()->json($user->todos()->with(['todo'])->get());
    }
}
