<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('majors.index', compact('majors'));
    }

    public function create()
    {
        return view('majors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Major::create([
            'name' => $request->name
        ]);

        return redirect()->route('majors.index')
            ->with('success', 'Major added successfully');
    }

    public function edit($id)
    {
        $major = Major::findOrFail($id);
        return view('majors.edit', compact('major'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $major = Major::findOrFail($id);
        $major->update([
            'name' => $request->name
        ]);

        return redirect()->route('majors.index')
            ->with('success', 'Major updated successfully');
    }

    public function destroy($id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        return redirect()->route('majors.index')
            ->with('success', 'Major deleted successfully');
    }
}