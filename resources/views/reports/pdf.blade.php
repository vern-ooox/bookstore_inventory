<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* DejaVu Sans is built into DomPDF and can show the peso sign */
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h2 { margin-bottom: 2px; }
        p { margin: 2px 0 10px 0; color: #444; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>{{ $filterText }} ({{ $books->count() }} records)</p>

    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Availability</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category }}</td>
                    <td>₱{{ number_format($book->unit_price, 2) }}</td>
                    <td>{{ $book->availability_status }}</td>
                </tr>
            @empty
                <tr><td colspan="5">No books match the selected filters.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>