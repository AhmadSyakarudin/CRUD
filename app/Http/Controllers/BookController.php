<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::all();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|min:5',
            'type' => 'required',
            'author' => 'required',
            'year' => 'required|numeric',
        ]);

        Book::create([
            'name' => $request->name,
            'type' => $request->type,
            'author' => $request->author,
            'year' => $request->year,
        ]);

        return redirect('/book/create')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $book = Book::find($id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|min:5',
            'type' => 'required',
            'author' => 'required',
            'year' => 'required|numeric',
        ]);

        Book::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'author' => $request->author,
            'year' => $request->year,
        ]);

        return redirect()->route('book.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Book::where('id', $id)->delete();

        return redirect()->route('book.home')->with('success', 'Berhasil menghapus data!');

    }
}
