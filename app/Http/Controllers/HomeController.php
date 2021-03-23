<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cursos;
use App\Models\MateriaUser;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function perfil($id)
    {   
        $usuario = User::find($id);
        $curso = Cursos::find($usuario->curso_id);
        return view('perfil', compact("usuario", "curso"));
    }
    public function deletar(Request $request)
    {   
        $id = $request->get("user_id");
        $materia = MateriaUser::where('user_id', $id)->get();
        if(isset($materia)){
            foreach($materia as $m){
                $m->delete();
            }
        }
        $users = Auth::user($id);
        $users->delete();
        Auth::logout();
        return redirect('/');
    }
    public function editar($id)
    {   
        $id = $id;
        $user = Auth::user($id);
        $nome = $user->name;
        $email = $user->email;
        return view("editperfil", compact("id", "nome", "email"));

    }
    public function edit(Request $request)
    {   
        $nome = $request->get("nome");
        $email = $request->get("email");
        $id = $request->get("user_id");
        $user = Auth::user($id);
        $user->name = $nome;
        $user->email = $email;
        $user->save();
        return view("home");

    }
    public function update(Request $request){
        $usuario = Auth::user()->id;
        $user = User::find($usuario);
        if($request->hasFile('avatar')){
            $avatar = $request->file("avatar");
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            \Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );     
            
            $user->avatar = $filename;
            $user->save();
        }
        return redirect()->route('perfil', ['id' => $usuario]);
    }
}
