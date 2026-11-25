@extends('layouts.admin')
@section('title', 'Add Book')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Book</h1>

    <form method="POST" action="{{ route('books.store') }}">
        @csrf
        @include('books._form', ['book' => null, 'button' => 'Save Book'])
    </form>
@endsection