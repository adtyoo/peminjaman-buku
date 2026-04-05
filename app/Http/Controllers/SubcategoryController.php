<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * LIST DATA
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();

        return view('subcategories.index', [
            'title' => 'Data Subkategori',
            'subcategories' => $subcategories
        ]);
    }

    /**
     * FORM TAMBAH
     */
    public function create()
    {
        return view('subcategories.create', [
            'title' => 'Tambah Subkategori',
            'categories' => Category::all()
        ]);
    }

    /**
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);

        Subcategory::create($request->all());

        return redirect()->route('subcategories.index')
            ->with('success', 'Subkategori berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit(Subcategory $subcategory)
    {
        return view('subcategories.edit', [
            'title' => 'Edit Subkategori',
            'subcategory' => $subcategory,
            'categories' => Category::all()
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);

        $subcategory->update($request->all());

        return redirect()->route('subcategories.index')
            ->with('success', 'Subkategori berhasil diupdate');
    }

    /**
     * HAPUS DATA
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('subcategories.index')
            ->with('success', 'Subkategori berhasil dihapus');
    }
}