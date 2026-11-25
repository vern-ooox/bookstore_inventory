@extends('layouts.admin')
@section('title', 'Books')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Book Inventory</h1>
        <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Book</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full bg-white rounded shadow text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Title</th>
                    <th class="p-3">Author</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Unit Price</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr class="border-t">
                        <td class="p-3">{{ $book->title }}</td>
                        <td class="p-3">{{ $book->author }}</td>
                        <td class="p-3">{{ $book->category }}</td>
                        <td class="p-3">₱{{ number_format($book->unit_price, 2) }}</td>
                        <td class="p-3 {{ $book->availability_status === 'Available' ? 'text-green-700' : 'text-red-700' }}">
                            {{ $book->availability_status }}
                        </td>
                        <td class="p-3">
                            <div class="flex gap-3 items-center">
                                <a href="{{ route('books.show', $book) }}" class="text-blue-600">View</a>
                                <a href="{{ route('books.edit', $book) }}" class="text-green-600">Edit</a>
                                {{-- DELETE method + confirmation before deleting --}}
                                <form method="POST" action="{{ route('books.destroy', $book) }}"
                                      onsubmit="return confirm('Delete this book record? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-3 text-center">No books yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $books->links() }}</div>
@endsection