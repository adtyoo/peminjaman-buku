<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * LIST DATA BUKU
     */
    public function index()
    {
        $books = Book::with(['category', 'subcategory'])->latest()->get();

        return view('books.index', [
            'title' => 'Data Buku',
            'books' => $books
        ]);
    }

    /**
     * FORM TAMBAH BUKU
     */
    public function create()
    {
        return view('books.create', [
            'title' => 'Tambah Buku',
            'categories' => Category::all(),
            'subcategories' => Subcategory::all()
        ]);
    }

    /**
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|digits:4',
            'pages' => 'required|integer|min:1',
            'isbn' => 'required|unique:books',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'description' => 'nullable|string', // ✅ tambahin ini
            'stock_total' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        // default stok
        $validated['stock_available'] = $validated['stock_total'];

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit(Book $book)
    {
        return view('books.edit', [
            'title' => 'Edit Buku',
            'book' => $book,
            'categories' => Category::all(),
            'subcategories' => Subcategory::all()
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|digits:4',
            'pages' => 'required|integer|min:1',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'description' => 'nullable|string', // ✅ tambahin ini
            'stock_total' => 'required|integer|min:0',
            'stock_available' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // jika upload gambar baru
        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            // simpan gambar baru
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    /**
     * HAPUS DATA
     */
    public function destroy(Book $book)
    {
        // hapus gambar dari storage
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus');
    }

    public function show(Book $book)
    {
        $book->load(['category', 'subcategory']);

        return view('books.show', [
            'title' => 'Detail Buku',
            'book' => $book
        ]);
    }
}