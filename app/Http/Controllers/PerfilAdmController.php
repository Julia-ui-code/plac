<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin as ModelsAdmin;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Cursos;
use Intervention\Image\Facades\Image as Image;

class PerfilAdmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function perfil($id)
    {   
        $usuario = Auth::user($id);
        $curso = Cursos::find($usuario->curso_id);
        return view('perfiladm', compact("usuario", "curso"));
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
        //$users = Auth::user($id);
        //return view('editperfiladm', compact('users'));
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
        return view('perfiladm', compact('users'));
    }
    public function updatefoto(Request $request){
        $usuario = Auth::user()->id;
        $user = Admin::find($usuario);
        if($request->hasFile('avatar')){
            $avatar = $request->file("avatar");
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            \Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );     
            
            $user->avatar = $filename;
            $user->save();
        }
        return redirect()->route('perfiladm', ['id' => $usuario]);
    }
}
