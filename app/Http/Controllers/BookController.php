<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index(Request $request)
    {
        $genre = $request->query('genre', null);
        $year = $request->query('year', null);

        $books = $this->books();

        if ($genre !== null) {
            $books = array_filter($books, function ($book) use ($genre) {
                return $book['genre'] === $genre;
            });
        }

        if ($year !== null) {
            $books = array_filter($books, function ($book) use ($year) {
                return $book['year'] == $year;
            });
        }

        return view('books.index', [
            'books' => $books,
            'genre' => $genre,
            'year' => $year,
        ]);
    }

    
    public function create()
    {
        return view('books.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|max:255',
        'author' => 'required|max:255',
        'year' => 'required|numeric|min:1000|max:2026',
        'genre' => 'required|in:History,Fiction',
    ]);

        $books = $this->books();

    $newId = empty($books)
        ? 1
        : max(array_column($books, 'id')) + 1;

    $books[] = [
        'id' => $newId,
        'title' => $validated['title'],
        'author' => $validated['author'],
        'year' => $validated['year'],
        'genre' => $validated['genre'],
    ];

    $this->saveBooks($books);

    return redirect()->route('books.index')
        ->with('success', 'Book added successfully!');
    }
    
    
    public function show(string $id)
    {
        $books = $this->books();

        if (!isset($books[$id]))
        {
            abort(404);
        }
        return view('books.show', ['book' => $books[$id]]);
    }
    
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }
    
    public function destroy(string $id)
    {
        //
    }
    public function featured()
    {
        $books = $this->books();
        $book = $books[1];

        return view('books.featured', ['book' => $book]);
    }
    
    private function books(){
        $path = storage_path('app/books.json');

        return json_decode(file_get_contents($path), true);
    }

    private function saveBooks(array $books)
    {
        file_put_contents(
            storage_path('app/books.json'),
            json_encode($books, JSON_PRETTY_PRINT)
        );

    }
}

