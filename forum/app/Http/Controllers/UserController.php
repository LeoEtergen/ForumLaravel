<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function listAllUsers()
    {
        $users = User::all();

        return view('user.listAllUsers', compact('users'));
    }

    public function listUser(Request $request, $uid) {
        $user = User::where('id', $uid)->first();
        return view('user.profile', ['user' => $user]);
    }

    public function updateUser(Request $request, $uid) {
        $user = User::where('id', $uid)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('listUser', [$user->id])->with('message', 'Atualizado com sucesso!!!');
    }

    public function deleteUser(Request $request, $uid) {
        $user = User::where('id', $uid)->first();
        if ($user) {
            $user->delete();
        }
        return redirect()->route('listAllUsers')->with('message', 'Excluído com sucesso!!!');
    }
    

    public function registerUser(Request $request) {
        if ($request->method() === 'GET') {
            return view('user.register');
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'password' => 'required|string|max:8|confirmed'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            Auth::login($user);

            return redirect()->route('listAllUsers');
        }
    }
}
