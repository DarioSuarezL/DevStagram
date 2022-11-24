@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('contents')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads').'/'. $post->image}}" alt="">

            <div class="p-3 flex items-center gap-2">

                @auth

                @if ($post->checkLike(auth()->user()))
                    <form method="POST" action="{{route('post.like.destroy',$post)}}">
                        @method('DELETE')
                        @csrf
                        <div class="my-4">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{route('post.like.store',$post)}}">
                        @csrf
                        <div class="my-4">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                @endif


                @endauth

                <p class="font-bold">
                    {{$post->likes->count()}}
                    <span class="font-normal">
                        Likes
                    </span>
                </p>
            </div>

            <div>
                <a href="{{ route('post.index',$post->user) }}" class="font-bold"> {{$post->user->username}} </a>
                <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
                <p class="mt-5">{{$post->description}}</p>
            </div>

            @auth
                @if( $post->user_id === auth()->user()->id )
                    <form action="{{ route('post.destroy',$post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input
                        type="submit"
                        value="Delete post"
                        class="bg-red-500 hover:bg-red-700 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                        >
                    </form>
                @endif
            @endauth
            
        </div>


        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">

                @auth

                @if (session('message'))
                    <div class="bg-green-700 p-2 rounded-lg mb-6 text-white text-center font-bold">
                        {{session('message')}}
                    </div>
                @endif
                
                <p class="text-xl font-bold text-center mb-4">Comment something</p>

                <form action=" {{ route('comment.store', ['post' => $post, 'user' => $user]) }} " method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">
                            Comment
                        </label>
                        <textarea id="comment" name="comment" placeholder="Comment something" class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror resize-none"></textarea>
                    @error('comment')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                    </div>

                    <input type="submit" value="Comment" class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                </form>

                @endauth

                <div class="bg-white shadow my-5 max-h-96 overflow-y-scroll">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('post.index',$comment->user) }}" class="font-bold">{{ $comment->user->username }}</a>
                                <p>{{ $comment->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No comments yet</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection