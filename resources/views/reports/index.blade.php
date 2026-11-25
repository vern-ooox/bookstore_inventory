@extends('layouts.admin')
@section('title', 'Reports')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('reports.pdf', request()->query()) }}" class="bg-red-600 text-white px-4 py-2 rounded">PDF</a>
            <a href="{{ route('reports.excel', request()->query()) }}" class="bg-green-600 text-white px-4 py-2 rounded">Excel</a>
        </div>
    </div>

    <form method="GET" action="{{ route('reports.index') }}" class="bg-white p-4 rounded shadow mb-4">
        <div class="grid gap-4 md:grid-cols-4 items-end">
            <div>
                <label for="report" class="block font-medium">Report</label>
                <select id="report" name="report" class="w-full border rounded p-2">
                    @foreach (\App\Http\Controllers\ReportController::REPORTS as $value => $label)
                        <option value="{{ $value }}" @selected(request('report', 'price_list') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="category" class="block font-medium">Category</label>
                <select id="category" name="category" class="w-full border rounded p-2">
                    <option value="">All categories</option>
                    @foreach (\App\Models\Book::CATEGORIES as $category)
                        <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="availability_status" class="block font-medium">Availability</label>
                <select id="availability_status" name="availability_status" class="w-full border rounded p-2">
                    <option value="">All statuses</option>
                    @foreach (\App\Models\Book::STATUSES as $status)
                        <option value="{{ $status }}" @selected(request('availability_status') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Apply</button>
                <a href="{{ route('reports.index') }}" class="px-4 py-2 border rounded">Reset</a>
            </div>
        </div>
    </form>

    <p class="mb-3 text-gray-600">{{ $filterText }} ({{ $books->count() }} records)</p>

    <div class="overflow-x-auto">
        <table class="w-full bg-white rounded shadow text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Title</th>
                    <th class="p-3">Author</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Unit Price</th>
                    <th class="p-3">Status</th>
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
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-3 text-center">No books match the selected filters.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection