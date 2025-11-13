<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use App\Models\ParentModel;
use App\Models\Trade;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    public function index()
    {
        $trainees = Trainee::with(['parent', 'trade'])->latest()->get();
        return view('trainees.index', compact('trainees'));
    }

    public function create()
    {
        $parents = ParentModel::all();
        $trades = Trade::all();
        return view('trainees.create', compact('parents', 'trades'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tFirstName' => 'required|string|max:50',
            'tLastName' => 'required|string|max:50',
            'tGender' => 'required|in:Male,Female',
            'DOB' => 'required|date|before:today',
            'ParentNationalId' => 'required|exists:parents,ParentNationalId',
            'tradeCode' => 'required|exists:trades,tradeCode',
            'Level' => 'required|in:Level 1,Level 2,Level 3,Level 4,Level 5',
        ]);

        Trainee::create($request->all());

        return redirect()->route('trainees.index')
            ->with('success', 'Trainee registered successfully!');
    }

    public function show(Trainee $trainee)
    {
        $trainee->load(['parent', 'trade']);
        return view('trainees.show', compact('trainee'));
    }

    public function edit(Trainee $trainee)
    {
        $parents = ParentModel::all();
        $trades = Trade::all();
        return view('trainees.edit', compact('trainee', 'parents', 'trades'));
    }

    public function update(Request $request, Trainee $trainee)
    {
        $request->validate([
            'tFirstName' => 'required|string|max:50',
            'tLastName' => 'required|string|max:50',
            'tGender' => 'required|in:Male,Female',
            'DOB' => 'required|date|before:today',
            'ParentNationalId' => 'required|exists:parents,ParentNationalId',
            'tradeCode' => 'required|exists:trades,tradeCode',
            'Level' => 'required|in:Level 1,Level 2,Level 3,Level 4,Level 5',
        ]);

        $trainee->update($request->all());

        return redirect()->route('trainees.index')
            ->with('success', 'Trainee updated successfully!');
    }

    public function destroy(Trainee $trainee)
    {
        $trainee->delete();

        return redirect()->route('trainees.index')
            ->with('success', 'Trainee deleted successfully!');
    }

    public function report()
    {
        $trainees = Trainee::with(['parent', 'trade'])->get();
        return view('trainees.report', compact('trainees'));
    }
}
