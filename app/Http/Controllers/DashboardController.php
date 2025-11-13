<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use App\Models\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalTrainees = Trainee::count();
        $totalTrades = Trade::count();
        
        $maleTrainees = Trainee::where('tGender', 'Male')->count();
        $femaleTrainees = Trainee::where('tGender', 'Female')->count();
   
        $recentTrainees = Trainee::with(['trade', 'parent'])
            ->latest('created_at')
            ->take(5)
            ->get();
        
        
        $tradeDistribution = Trade::withCount('trainees')
            ->orderBy('trainees_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalTrainees',
            'totalTrades',
            'maleTrainees',
            'femaleTrainees',
            'recentTrainees',
            'tradeDistribution'
        ));
    }
}