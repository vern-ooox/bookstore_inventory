<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public const REPORTS = [
        'available' => 'Available Books',
        'unavailable' => 'Unavailable Books',
        'category' => 'Books by Category',
        'price_list' => 'Book Price List',
    ];

    public function index(Request $request)
    {
        [$books, $title, $filterText] = $this->getReport($request);

        return view('reports.index', compact('books', 'title', 'filterText'));
    }

    public function exportPdf(Request $request)
    {
        [$books, $title, $filterText] = $this->getReport($request);

        return app('dompdf.wrapper')->loadView('reports.pdf', compact('books', 'title', 'filterText'))
            ->setPaper('a4', 'portrait')
            ->download('book-report.pdf');
    }

    public function exportExcel(Request $request)
    {
        [$books] = $this->getReport($request);

        return app('excel')->download(new BooksExport($books), 'book-report.xlsx');
    }

    /**
     * One query used by the report page AND both exports,
     * so the PDF and Excel always contain the same records as the screen.
     */
    private function getReport(Request $request): array
    {
        $request->validate([
            'report' => ['nullable', Rule::in(array_keys(self::REPORTS))],
            'category' => ['nullable', Rule::in(Book::CATEGORIES)],
            'availability_status' => ['nullable', Rule::in(Book::STATUSES)],
        ]);

        $report = $request->input('report') ?: 'price_list';
        $category = $request->input('category');
        $status = $request->input('availability_status');

        // The Available and Unavailable reports use their own status.
        // The other reports use the Availability dropdown.
        if ($report === 'available') {
            $status = 'Available';
        }
        if ($report === 'unavailable') {
            $status = 'Unavailable';
        }

        // Category and status filters are chained, so they work together.
        // Example: Academic + Available returns only available academic books.
        $books = Book::query()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($status, fn ($q) => $q->where('availability_status', $status))
            ->orderBy('category')
            ->orderBy('title')
            ->get();

        // Text that describes the active filters (shown on screen and in the PDF)
        $parts = [];
        if ($category) {
            $parts[] = 'Category: '.$category;
        }
        if ($status) {
            $parts[] = 'Availability: '.$status;
        }
        $filterText = $parts ? implode('  |  ', $parts) : 'All books';

        return [$books, self::REPORTS[$report], $filterText];
    }
}