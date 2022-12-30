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
        return view('pages.users.create');
    }

    public function edit($id)
    {
        $userData = User::getUser($id);

        return view('pages.users.edit', compact('userData'));
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

        $createUser = User::createUser($request->toArray());

        return $createUser;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ], [
                'password.required' => 'A senha é obrigatória',
                'password_confirmation.same' => 'As senhas não conferem',
                'password_confirmation.required' => 'A confirmação de senha é obrigatória'
            ]);
            $request->merge(['password' => Hash::make($request->password)]);
            unset($request['password_confirmation']);
        }

        $updateUser = User::updateUserById($id, $request->toArray());

        return $updateUser;
    }
}
