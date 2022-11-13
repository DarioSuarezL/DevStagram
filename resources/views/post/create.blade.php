@extends('layouts.app')

@section('title')
    Post something
@endsection

@push('styles')
{{-- <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script> --}}
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

@section('contents')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data"
            id='dropzone' class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            
            <form action="{{ route('post.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">
                        Title
                    </label>
                    <input type="text" id="title" name="title" placeholder="Publication title" class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror" value="{{old('title')}}">
                @error('title')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
                </div>
                
                <div class="mb-5">
                    <label for="Description" class="mb-2 block uppercase text-gray-500 font-bold">
                        Description
                    </label>
                    <textarea id="description" name="description" placeholder="Publication description" class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror resize-none">{{old('description')}}</textarea>
                @error('description')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
                </div>

                <div class="mb-5">
                    <input 
                        name="image"
                        type="hidden"
                        value="{{old('image')}}"
                    />
                    @error('image')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <input type="submit" value="post" class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection