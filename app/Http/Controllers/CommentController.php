<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function store(Request $request, )
    {
        // dd('prueba superada');

        $this->validate($request,[
            'comment' => 'required|max:255'
        ]);

        Comment::create([

        ]);
    }

}
