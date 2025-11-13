<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;

class ParentController extends Controller
{
 
    public function index()
    {
        $parents = ParentModel::withCount('trainees')->latest()->get();
        return view('parents.index', compact('parents'));
    }


    public function create()
    {
        return view('parents.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'ParentNationalId' => 'required|string|max:20|unique:parents,ParentNationalId',
            'pFirstName' => 'required|string|max:50',
            'pLastName' => 'required|string|max:50',
            'pGender' => 'required|in:Male,Female',
            'PhoneNumber' => 'required|string|max:15',
            'District' => 'required|string|max:50',
        ]);

        ParentModel::create($request->all());

        return redirect()->route('parents.index')
            ->with('success', 'Parent added successfully!');
    }

    
    public function show(ParentModel $parent)
    {
        $parent->load('trainees');
        return view('parents.show', compact('parent'));
    }

    
    public function edit(ParentModel $parent)
    {
        return view('parents.edit', compact('parent'));
    }

    
    public function update(Request $request, ParentModel $parent)
    {
        $request->validate([
            'ParentNationalId' => 'required|string|max:20|unique:parents,ParentNationalId,' . $parent->ParentNationalId . ',ParentNationalId',
            'pFirstName' => 'required|string|max:50',
            'pLastName' => 'required|string|max:50',
            'pGender' => 'required|in:Male,Female',
            'PhoneNumber' => 'required|string|max:15',
            'District' => 'required|string|max:50',
        ]);

        $parent->update($request->all());

        return redirect()->route('parents.index')
            ->with('success', 'Parent updated successfully!');
    }

    
    public function destroy(ParentModel $parent)
    {
        $parent->delete();

        return redirect()->route('parents.index')
            ->with('success', 'Parent deleted successfully!');
    }
}