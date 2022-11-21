<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request,[
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:profile,login,posts,logout,image,register,devstagram,devstagram_oficial'],
        ]);
        
        if($request->image){
            $image = $request->file('image');

            $imageName = Str::uuid() . "." . $image->extension(); //método para crear un id unico para la imagen
    
            $imageServer = Image::make($image); //crea un objeto imagen de intervention
            $imageServer->fit(1000,1000); //le da dimensiones de 1000x1000
    
            $imagePath = public_path('profiles').'/'.$imageName; //crea un path basandose en el nombre de la imagen
            $imageServer->save($imagePath); //Guarda la imagen en el path
        }

        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->image = $imageName ?? auth()->user()->image ?? null;
        $usuario->save();

        return redirect()->route('post.index', $usuario->username);
    }

}
