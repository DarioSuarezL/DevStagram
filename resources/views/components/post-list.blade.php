<div>

    @if ($posts->count())

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($posts as $post)
            <div class="m-3">
                <a href="{{route('post.show', ['post' => $post, 'user' => $post->user])}}">
                    <img src="{{asset('uploads').'/'.$post->image}}" alt="Imagen del post {{$post->title}}">
                </a>
            </div>
        @endforeach
    </div>
    
    <div class="my-10">
        {{$posts->links('pagination::tailwind')}}
    </div>

    @else
        <p class="text-center font-bold text-gray-400"> No posts, are you following someone?</p>
    @endif

</div>