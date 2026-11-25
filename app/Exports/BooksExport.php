<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    // Receives the already filtered books from ReportController
    public function __construct(private Collection $books)
    {
    }

    public function collection()
    {
        return $this->books;
    }

    public function headings(): array
    {
        return ['Book Title', 'Author', 'Category', 'Unit Price (PHP)', 'Availability Status'];
    }

    public function map($book): array
    {
        return [
            $book->title,
            $book->author,
            $book->category,
            (float) $book->unit_price,
            $book->availability_status,
        ];
    }

    // Column D shows prices with two decimals, like 89.50
    public function columnFormats(): array
    {
        return ['D' => '#,##0.00'];
    }
}