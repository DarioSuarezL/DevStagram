<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //Modificar el request para formatear como está en la bd y así no haya errores dentro
        // $request->username = Str::slug($request->username);
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validaciones
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|min:5|confirmed'
        ]);

        //Creación de registro
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenticacion de usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //Otro modo:
        auth()-> attempt($request->only('email','password'));

        // Redirrecionamiento
        return redirect()->route('post.index', auth()->user()->username);
    }
}
