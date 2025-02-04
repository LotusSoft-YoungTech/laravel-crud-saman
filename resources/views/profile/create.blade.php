@extends('layout')

@section('content')
<h1>Create a Post</h1>
<form method="POST" action="{{ url('/post/store') }}">
    @csrf
    <input type="text" name="title" placeholder="Title">
    <textarea name="content" placeholder="Content"></textarea>
    <button type="submit">Publish</button>
</form>
@endsection
