@extends('layouts.app')

@section('title')
    Editing profile: {{auth()->user()->username}}
@endsection

@section('contents')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" action="{{route('profile.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="username" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{auth()->user()->username}}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">
                        Profile image
                    </label>
                    <input type="file" id="image" name="image" class="border p-3 w-full rounded-lg" accept=".jpg, .jpeg, .png">
                </div>

                <input type="submit" value="save changes" class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection