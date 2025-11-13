@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Dashboard Header -->
    <div class="mb-8 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100 mb-2">Dashboard Overview</h2>
        <p class="text-gray-400">Welcome back, <span class="text-accent-orange font-semibold">{{ Auth::user()->full_name }}</span></p>
    </div>

    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Total Trainees Card -->
        <div class="bg-primary-dark/50 p-6 rounded-xl border border-border-dark/70 shadow-lg hover:shadow-xl transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-accent-orange/20 rounded-lg">
                    <svg class="w-8 h-8 text-accent-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <span class="text-4xl font-bold text-white">{{ $totalTrainees }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wide">Total Trainees</h3>
            <p class="text-xs text-gray-500 mt-2">All registered trainees</p>
        </div>

        <!-- Total Trades Card -->
        <div class="bg-primary-dark/50 p-6 rounded-xl border border-border-dark/70 shadow-lg hover:shadow-xl transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-accent-purple/20 rounded-lg">
                    <svg class="w-8 h-8 text-accent-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-4xl font-bold text-white">{{ $totalTrades }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wide">Active Trades</h3>
            <p class="text-xs text-gray-500 mt-2">Available training programs</p>
        </div>

        <!-- Male Trainees Card -->
        <div class="bg-primary-dark/50 p-6 rounded-xl border border-border-dark/70 shadow-lg hover:shadow-xl transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-500/20 rounded-lg">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <span class="text-4xl font-bold text-white">{{ $maleTrainees }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wide">Male Trainees</h3>
            <p class="text-xs text-gray-500 mt-2">{{ $totalTrainees > 0 ? round(($maleTrainees / $totalTrainees) * 100, 1) : 0 }}% of total</p>
        </div>

        <!-- Female Trainees Card -->
        <div class="bg-primary-dark/50 p-6 rounded-xl border border-border-dark/70 shadow-lg hover:shadow-xl transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-pink-500/20 rounded-lg">
                    <svg class="w-8 h-8 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <span class="text-4xl font-bold text-white">{{ $femaleTrainees }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wide">Female Trainees</h3>
            <p class="text-xs text-gray-500 mt-2">{{ $totalTrainees > 0 ? round(($femaleTrainees / $totalTrainees) * 100, 1) : 0 }}% of total</p>
        </div>
    </div>

    <!-- Two Column Layout: Recent Trainees & Trade Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <!-- Recent Trainees Section -->
        <div class="bg-primary-dark/50 p-6 rounded-xl border border-border-dark/70 shadow-lg">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-border-dark">
                <h3 class="text-xl font-semibold text-accent-orange">Recent Trainees</h3>
                <a href="{{ route('trainees.index') }}" class="text-sm text-gray-400 hover:text-white transition">View All →</a>
            </div>
            
            <div class="space-y-3">
                @forelse($recentTrainees as $trainee)
                <div class="flex items-center justify-between p-3 bg-card-dark/50 rounded-lg hover:bg-card-dark transition-colors duration-150">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-accent-purple/20 flex items-center justify-center">
                            <span class="text-accent-purple font-bold text-sm">{{ substr($trainee->tFirstName, 0, 1) }}{{ substr($trainee->tLastName, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $trainee->tFirstName }} {{ $trainee->tLastName }}</p>
                            <p class="text-xs text-gray-400">{{ $trainee->trade->TradeName ?? 'N/A' }} - Level {{ $trainee->Level }}</p>
                        </div>
                    </div>
                    <a href="{{ route('trainees.show', $trainee->traineeId) }}" class="text-gray-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500 italic">
                    No trainees registered yet.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Trade Distribution Section -->
        <div class="bg-primary-dark/50 p-6 rounded-xl border border-border-dark/70 shadow-lg">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-border-dark">
                <h3 class="text-xl font-semibold text-accent-orange">Trade Distribution</h3>
                <a href="{{ route('trades.index') }}" class="text-sm text-gray-400 hover:text-white transition">Manage Trades →</a>
            </div>
            
            <div class="space-y-3">
                @forelse($tradeDistribution as $trade)
                <div class="p-3 bg-card-dark/50 rounded-lg hover:bg-card-dark transition-colors duration-150">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $trade->TradeName }}</p>
                            <p class="text-xs text-gray-500">Code: {{ $trade->tradeCode }}</p>
                        </div>
                        <span class="px-3 py-1 bg-accent-purple/20 text-accent-purple rounded-full text-sm font-bold">
                            {{ $trade->trainees_count }}
                        </span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-accent-purple h-2 rounded-full" style="width: {{ $totalTrainees > 0 ? ($trade->trainees_count / $totalTrainees) * 100 : 0 }}%"></div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500 italic">
                    No trades available.
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="bg-primary-dark/50 p-6 rounded-xl border border-border-dark/70 shadow-lg">
        <h3 class="text-xl font-semibold text-accent-orange mb-4 pb-3 border-b border-border-dark">Quick Actions</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('trainees.create') }}" class="flex items-center space-x-3 p-4 bg-card-dark/50 rounded-lg hover:bg-card-dark transition-all duration-200 group">
                <div class="p-3 bg-accent-orange/20 rounded-lg group-hover:bg-accent-orange/30 transition">
                    <svg class="w-6 h-6 text-accent-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-white">Add Trainee</p>
                    <p class="text-xs text-gray-400">Register new trainee</p>
                </div>
            </a>

            <a href="{{ route('trades.create') }}" class="flex items-center space-x-3 p-4 bg-card-dark/50 rounded-lg hover:bg-card-dark transition-all duration-200 group">
                <div class="p-3 bg-accent-purple/20 rounded-lg group-hover:bg-accent-purple/30 transition">
                    <svg class="w-6 h-6 text-accent-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-white">Add Trade</p>
                    <p class="text-xs text-gray-400">Create new trade program</p>
                </div>
            </a>

            <a href="{{ route('trainees.report') }}" class="flex items-center space-x-3 p-4 bg-card-dark/50 rounded-lg hover:bg-card-dark transition-all duration-200 group">
                <div class="p-3 bg-blue-500/20 rounded-lg group-hover:bg-blue-500/30 transition">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-white">View Report</p>
                    <p class="text-xs text-gray-400">Generate trainees report</p>
                </div>
            </a>

            <a href="{{ route('trainees.index') }}" class="flex items-center space-x-3 p-4 bg-card-dark/50 rounded-lg hover:bg-card-dark transition-all duration-200 group">
                <div class="p-3 bg-green-500/20 rounded-lg group-hover:bg-green-500/30 transition">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-white">All Trainees</p>
                    <p class="text-xs text-gray-400">Browse all trainees</p>
                </div>
            </a>
        </div>
    </div>

@endsection