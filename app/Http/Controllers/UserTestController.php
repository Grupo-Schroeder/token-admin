<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserTestController extends Controller
{
    public function index(){
        $users = User::all();

        return view('users.list', compact('users'));
    }

    public function show(string $id): View
    {
        $user = User::find($id);


        return view('users.show', ['user' => $user]);
    }


    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json(
            [
                'message' => 'Usuario creado correctamente',
                'user' => $data['email'],
            ], 201);

    }

    public function create(){
        return view('users.create');
    }

}
