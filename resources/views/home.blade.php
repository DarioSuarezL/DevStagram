@extends('layouts.app')
@section('title') Principal page @endsection

@section('contents')


<x-post-list :posts="$posts" />


@endsection