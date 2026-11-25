@extends('layouts.admin')
@section('title', 'Book Details')

@section('content')
    <div class="bg-white p-6 rounded shadow max-w-xl space-y-2">
        <h1 class="text-2xl font-bold">{{ $book->title }}</h1>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Category:</strong> {{ $book->category }}</p>
        <p><strong>Unit Price:</strong> ₱{{ number_format($book->unit_price, 2) }}</p>
        <p><strong>Availability:</strong> {{ $book->availability_status }}</p>
        <p><strong>Description:</strong> {{ $book->description }}</p>
        <p><strong>Added by:</strong> {{ $book->user->name }}</p>

        <div class="flex gap-3 pt-3">
            <a href="{{ route('books.edit', $book) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('books.index') }}" class="px-4 py-2 border rounded">Back to list</a>
        </div>
    </div>
@endsection