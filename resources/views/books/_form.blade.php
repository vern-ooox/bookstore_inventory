{{-- Shared by Add and Edit. old() keeps what the user typed when validation fails. --}}
<div class="space-y-4 bg-white p-6 rounded shadow max-w-xl">
    <div>
        <label class="block font-medium">Book Title</label>
        <input type="text" name="title" class="w-full border rounded p-2"
               value="{{ old('title', $book->title ?? '') }}">
        @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium">Author</label>
        <input type="text" name="author" class="w-full border rounded p-2"
               value="{{ old('author', $book->author ?? '') }}">
        @error('author') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium">Category</label>
        <select name="category" class="w-full border rounded p-2">
            <option value="">Select category</option>
            @foreach (\App\Models\Book::CATEGORIES as $cat)
                <option value="{{ $cat }}" @selected(old('category', $book->category ?? '') === $cat)>{{ $cat }}</option>
            @endforeach
        </select>
        @error('category') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium">Unit Price (PHP)</label>
        <input type="text" name="unit_price" class="w-full border rounded p-2"
               value="{{ old('unit_price', $book->unit_price ?? '') }}">
        @error('unit_price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium">Description</label>
        <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description', $book->description ?? '') }}</textarea>
        @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium">Availability Status</label>
        <select name="availability_status" class="w-full border rounded p-2">
            <option value="">Select status</option>
            @foreach (\App\Models\Book::STATUSES as $s)
                <option value="{{ $s }}" @selected(old('availability_status', $book->availability_status ?? '') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        @error('availability_status') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ $button }}</button>
        <a href="{{ route('books.index') }}" class="px-4 py-2 border rounded">Cancel</a>
    </div>
</div>