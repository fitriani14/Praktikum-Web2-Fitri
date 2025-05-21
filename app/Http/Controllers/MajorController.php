<?php

namespace App\Http\Controllers;

use App\Models\Majors;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Majors::all();
        return view('majors.index', compact('majors'));
    }

    public function show(string $id)
    {
        $major = Majors::findOrFail($id);
        return view('majors.show', compact('major'));
    }

    public function create()
    {
        return view('majors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'description' => 'nullable|string', // Allow description to be optional
        ]);

        Majors::create($request->only(['name', 'code', 'description']));

        return redirect()->route('majors.index')->with('success', 'Major created successfully.');
    }

    public function edit($id)
    {
        $major = Majors::findOrFail($id);
        return view('majors.edit', compact('major'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'description' => 'nullable|string', // Allow description to be optional
        ]);

        $major = Majors::findOrFail($id);
        $major->update($request->only(['name', 'code', 'description']));

        return redirect()->route('majors.index')->with('success', 'Major updated successfully.');
    }

    public function destroy($id)
    {
        $major = Majors::findOrFail($id);
        $major->delete();

        return redirect()->route('majors.index')->with('success', 'Major deleted successfully.');
    }
}
