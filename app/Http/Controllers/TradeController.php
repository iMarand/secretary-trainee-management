<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    
    public function index()
    {
        $trades = Trade::withCount('trainees')->latest()->get();
        return view('trades.index', compact('trades'));
    }

    
    public function create()
    {
        return view('trades.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'tradeCode' => 'required|string|max:10|unique:trades,tradeCode',
            'TradeName' => 'required|string|max:100',
        ]);

        Trade::create($request->all());

        return redirect()->route('trades.index')
            ->with('success', 'Trade added successfully!');
    }

    
    public function show(Trade $trade)
    {
        $trade->load('trainees');
        return view('trades.show', compact('trade'));
    }

    
    public function edit(Trade $trade)
    {
        return view('trades.edit', compact('trade'));
    }

    
    public function update(Request $request, Trade $trade)
    {
        $request->validate([
            'tradeCode' => 'required|string|max:10|unique:trades,tradeCode,' . $trade->tradeCode . ',tradeCode',
            'TradeName' => 'required|string|max:100',
        ]);

        $trade->update($request->all());

        return redirect()->route('trades.index')
            ->with('success', 'Trade updated successfully!');
    }

    
    public function destroy(Trade $trade)
    {
        $trade->delete();

        return redirect()->route('trades.index')
            ->with('success', 'Trade deleted successfully!');
    }
}