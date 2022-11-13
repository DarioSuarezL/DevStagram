@extends('layouts.app')
@section('title')
    {{$user->username}}'s account
@endsection
@section('contents')
    
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{asset('img/usuario.svg')}}" alt="imagen perfil">
            </div>
            
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <p class="text-gray-500 text-2xl">{{$user->username}}</p>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0 <span class="font-normal">followers</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0 <span class="font-normal">followed</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0 <span class="font-normal">Posts</span>
                </p>
            </div>

        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Posts</h2>
        @if ($posts->count())
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($posts as $post)
                <div class="m-3">
                    <a href="{{route('post.show', ['post' => $post, 'user' => $user])}}">
                        <img src="{{asset('uploads').'/'.$post->image}}" alt="Imagen del post {{$post->title}}">
                    </a>
                </div>
            @endforeach
        </div>
        
        <div>
            {{$posts->links('pagination::tailwind')}}
        </div>

        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">This person has not posted anything</p>
        @endif

    </section>

@endsection 
