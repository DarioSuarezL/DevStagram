@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('contents')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads').'/'. $post->image}}" alt="">
            <div class="p-3">
                <p>0 Likes</p>
            </div>

            <div>
                <p class="font-bold"> {{$post->user->username}} </p>
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
                                <a href="{{ route('post.index',$comment->user) }}" class="font-bold">{{ $comment->user->name }}</a>
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