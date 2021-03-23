<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin as ModelsAdmin;
use Illuminate\Support\Facades\Auth;

class Perfil2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function destroy($id)
    {
        $users = Auth::user($id);
        Auth::logout();
        if ($users->delete()) {
            return redirect('/')->with('mensagem', 'Conta deletada com sucesso!');
        }
    }
    public function show($id)
    {
        $users = Auth::user($id);
        return view('editperfil2', compact('users'));
    }
    public function update(Request $request, $id)
    {
        $users = Auth::user($id);
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$users->id
        ]);
        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->save();
        return redirect('/home-admin')->with('mensagem', 'Dados alterados com sucesso!');
    }
    public function edit($id)
    {
        $users = Auth::user($id);
        return view('perfil2', compact('users'));
    }
}
