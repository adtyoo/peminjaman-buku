<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * LIST DATA
     */
    public function index()
    {
        $categories = Category::latest()->get(); // urut terbaru

        return view('categories.index', [
            'title' => 'Data Kategori',
            'categories' => $categories
        ]);
    }

    /**
     * FORM TAMBAH
     */
    public function create()
    {
        return view('categories.create', [
            'title' => 'Tambah Kategori'
        ]);
    }

    /**
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        Category::create($request->only('name'));

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'title' => 'Edit Kategori',
            'category' => $category
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id
        ]);

        $category->update($request->only('name'));

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * HAPUS DATA
     */
    public function destroy(Category $category)
    {
        // 🔥 CEGAH HAPUS kalau masih dipakai
        if ($category->books()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih digunakan di buku');
        }

        // Kalau nanti pakai subkategori
        if ($category->subcategories()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki subkategori');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}