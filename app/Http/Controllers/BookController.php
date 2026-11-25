<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('user')->latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        // Business rule: the creator is always the logged-in administrator.
        // It is set on the server, never taken from the form.
        $data['user_id'] = auth()->id();

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        // user_id is not changed on update, the original creator stays linked
        $book->update($this->validated($request));

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    // Server side validation shared by store() and update()
    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(Book::CATEGORIES)],
            // numeric + min:0 rejects negative and non numeric prices
            'unit_price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'description' => ['required', 'string'],
            'availability_status' => ['required', Rule::in(Book::STATUSES)],
        ], [
            'title.required' => 'Please enter the book title.',
            'author.required' => 'Please enter the author name.',
            'category.required' => 'Please choose a category.',
            'category.in' => "Category must be Fiction, Nonfiction, Academic, or Children's Books.",
            'unit_price.required' => 'Please enter the unit price.',
            'unit_price.numeric' => 'Unit price must be a number.',
            'unit_price.min' => 'Unit price cannot be negative.',
            'unit_price.max' => 'Unit price is too large.',
            'description.required' => 'Please enter a description.',
            'availability_status.required' => 'Please choose an availability status.',
            'availability_status.in' => 'Availability must be Available or Unavailable.',
        ]);
    }
}