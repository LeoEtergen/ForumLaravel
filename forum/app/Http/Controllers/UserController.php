<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function listAllUsers()
    {
        $users = User::all(); // Busca todos os usuários
        return view('users.listAllUsers', ['users' => $users]);
    }

    public function listUserById(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        return view('users.profile', ['user' => $user]);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('users.create');
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo' => $photoPath,
            ]);

            Auth::login($user);

            return redirect()->route('listAllUsers');
        }
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $request->file('photo')->store('photos', 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('listUserById', [$user->id])->with('message-success', 'Perfil atualizado com sucesso!');
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->comments()->delete();

            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->delete();

            return redirect()->route('listAllUsers')->with('success', 'Usuário deletado com sucesso!');
        }

        return redirect()->route('listAllUsers')->with('error', 'Usuário não encontrado.');
    }
}
