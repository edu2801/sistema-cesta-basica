<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $dataTable = User::all();
        return view('pages.users.index', compact('dataTable'));
    }

    public function create()
    {
        return view('pages.users.form');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.form', compact('user'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ], [
            'name.required' => 'O nome é obrigatório',
            'email.unique' => 'Este e-mail já está cadastrado',
            'password.required' => 'A senha é obrigatória',
            'password_confirmation.same' => 'As senhas não conferem',
            'password_confirmation.required' => 'A confirmação de senha é obrigatória'
        ]);

        $data = $request->except('password_confirmation');
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $data = $request->except(['password', 'password_confirmation']);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ], [
                'password.required' => 'A senha é obrigatória',
                'password_confirmation.same' => 'As senhas não conferem',
                'password_confirmation.required' => 'A confirmação de senha é obrigatória'
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json($user);
    }
}
