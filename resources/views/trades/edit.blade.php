@extends('layouts.app')

@section('title', 'Edit Trade')

@section('content')
<div class="space-y-6">
    
    
    <div class="flex justify-between items-center mb-6 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100">
            Edit Trade: <span class="text-accent-orange">{{ $trade->TradeName }}</span>
        </h2>
        <a href="{{ route('trades.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg transition-all duration-200 shadow-md">
            <span class="hidden md:inline">← Back to Trades List</span>
            <span class="md:hidden">← List</span>
        </a>
    </div>

    
    <div class="bg-primary-dark/50 p-6 rounded-xl shadow-xs border border-border-dark/70 max-w-8xl mx-auto">
        
        
        <div id="client-error-box" class="mb-5 p-3 rounded-lg bg-red-900/40 text-red-300 border border-red-500/50 hidden text-sm font-medium"></div>
        
        <form action="{{ route('trades.update', $trade->tradeCode) }}" method="POST" onsubmit="return validateTradeForm()">
            @csrf
            @method('PUT')

            
            <div class="mb-6">
                <label for="tradeCode" class="block text-sm font-medium text-gray-300 mb-2">Trade Code</label>
                <input type="text" id="tradeCode" name="tradeCode" value="{{ old('tradeCode', $trade->tradeCode) }}" 
                       placeholder="e.g., MECH01" maxlength="10" 
                       class="w-full px-4 py-3 bg-card-dark/40 border border-border-dark rounded-lg text-gray-400 placeholder-gray-500 cursor-not-allowed transition duration-150" 
                       required readonly>
                <span class="block text-xs text-gray-500 mt-1">This code is the unique identifier and cannot be modified.</span>
                @error('tradeCode')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="mb-8">
                <label for="TradeName" class="block text-sm font-medium text-gray-300 mb-2">Trade Name <span class="text-red-500">*</span></label>
                <input type="text" id="TradeName" name="TradeName" value="{{ old('TradeName', $trade->TradeName) }}" 
                       placeholder="e.g., Automotive Mechanics" 
                       class="w-full px-4 py-3 bg-card-dark/70 border border-border-dark rounded-lg text-white placeholder-gray-500 focus:ring-accent-purple focus:border-accent-purple transition duration-150" required>
                @error('TradeName')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('trades.index') }}" class="px-5 py-2.5 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition-all duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2.5 bg-accent-purple hover:bg-accent-purple/90 text-white font-semibold rounded-lg transition-all duration-200 shadow-md shadow-accent-purple/30">
                    Update Trade
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showClientError(message) {
        const errorBox = document.getElementById('client-error-box');
        errorBox.textContent = message;
        errorBox.classList.remove('hidden');
        // Scroll to the top to ensure the user sees the error
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    
    function hideClientError() {
        document.getElementById('client-error-box').classList.add('hidden');
    }

    function validateTradeForm() {
        hideClientError();

        const tradeName = document.getElementById('TradeName').value.trim();

        if (tradeName === '' || tradeName.length < 3) {
            showClientError('Trade name is required and must be at least 3 characters long.');
            return false;
        }

        return true;
    }
</script>
@endsection