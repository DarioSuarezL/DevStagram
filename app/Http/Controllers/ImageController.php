<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');

        $imageName = Str::uuid() . "." . $image->extension(); //método para crear un id unico para la imagen

        $imageServer = Image::make($image); //crea un objeto imagen de intervention
        $imageServer->fit(1000,1000); //le da dimensiones de 1000x1000

        $imagePath = public_path('uploads').'/'.$imageName; //crea un path basandose en el nombre de la imagen
        $imageServer->save($imagePath); //Guarda la imagen en el path

        return response()->json(['image' =>$imageName]);
    }
}
