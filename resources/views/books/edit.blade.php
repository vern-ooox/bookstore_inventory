@extends('layouts.admin')
@section('title', 'Edit Book')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Book</h1>

    <form method="POST" action="{{ route('books.update', $book) }}">
        @csrf
        @method('PUT')
        @include('books._form', ['button' => 'Update Book'])
    </form>
@endsection