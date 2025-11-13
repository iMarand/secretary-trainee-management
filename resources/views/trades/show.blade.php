@extends('layouts.app')

@section('title', 'Trade Details')

@section('content')

    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100 mb-4 md:mb-0">Trade Profile: <span class="text-accent-orange">{{ $trade->TradeName }}</span></h2>
        
        <div class="flex gap-3">
            <a href="{{ route('trades.index') }}" class="px-4 py-2 bg-accent-orange/90 hover:bg-accent-orange text-white font-semibold rounded-lg transition-all duration-200 shadow-md">
                <span class="hidden md:inline">← Back to Trades List</span>
                <span class="md:hidden">← List</span>
            </a>
            
            <a href="{{ route('trades.edit', $trade->tradeCode) }}" class="px-4 py-2 bg-accent-orange/90 hover:bg-accent-orange text-gray-900 font-semibold rounded-lg transition-all duration-200 shadow-md">
                <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-9-4l9-9m-3 9l9-9"></path></svg>
                Edit Trade
            </a>
        </div>
    </div>

    
    <div class="p-6 bg-primary-dark/50 rounded-xl border border-border-dark/70 mb-8">
        <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-2 mb-4">Trade Information</h3>
        
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
            
            
            <div>
                <dt class="font-medium text-gray-400">Trade Name</dt>
                <dd class="text-lg font-bold text-white">{{ $trade->TradeName }}</dd>
            </div>
            
            
            <div>
                <dt class="font-medium text-gray-400">Trade Code</dt>
                <dd class="text-base text-gray-300">{{ $trade->tradeCode }}</dd>
            </div>

            
            <div>
                <dt class="font-medium text-gray-400">Total Trainees Enrolled</dt>
                <dd class="text-base text-white">{{ $trade->trainees->count() }}</dd>
            </div>

            
            <div>
                <dt class="font-medium text-gray-400">Record Created On</dt>
                <dd class="text-base text-white">{{ date('d-m-Y H:i', strtotime($trade->created_at)) }}</dd>
            </div>
        </dl>
    </div>

    
    @if($trade->trainees->count() > 0)
    <div class="p-6 bg-primary-dark/50 rounded-xl border border-border-dark/70">
        <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-2 mb-4">
            Enrolled Trainees ({{ $trade->trainees->count() }})
        </h3>
        
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border-dark">
                <thead>
                    <tr class="text-left text-xs font-semibold uppercase tracking-wider text-gray-400">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Full Name</th>
                        <th class="px-4 py-3">Gender</th>
                        <th class="px-4 py-3">Level</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark/50">
                    @foreach($trade->trainees as $trainee)
                    <tr class="hover:bg-card-dark transition duration-100">
                        <td class="px-4 py-3 whitespace-nowrap text-gray-300">{{ $trainee->traineeId }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-white font-medium">{{ $trainee->tFirstName }} {{ $trainee->tLastName }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-gray-300">{{ $trainee->tGender }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-gray-300">{{ $trainee->Level }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('trainees.show', $trainee->traineeId) }}" class="text-accent-orange hover:text-orange-300 transition duration-150">
                                View Profile
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="p-4 rounded-lg bg-gray-800/50 text-gray-400 border border-border-dark">
            No trainees are currently enrolled in the {{ $trade->TradeName }} trade.
        </div>
    @endif

    
    <div class="mt-8 pt-6 border-t border-border-dark/50">
        <form action="{{ route('trades.destroy', $trade->tradeCode) }}" method="POST" onsubmit="return showTradeDeleteConfirmModal()">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Delete Trade
            </button>
        </form>
    </div>

    
    <div id="tradeConfirmModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
        <div class="bg-card-dark p-8 rounded-lg max-w-sm w-full border border-red-500/30 shadow-2xl">
            <h4 class="text-xl font-bold text-red-400 mb-4">Confirm Trade Deletion</h4>
            <p class="text-gray-300 mb-6">
                Are you absolutely sure you want to delete the **{{ $trade->TradeName }}** trade? 
                <span class="text-red-300 font-semibold">This action is irreversible and will also delete all {{ $trade->trainees->count() }} trainees currently assigned to this trade!</span>
            </p>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeTradeConfirmModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition">Cancel</button>
                <button type="button" id="confirmTradeDeleteButton" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">Delete Trade</button>
            </div>
        </div>
    </div>

    <script>
        // Use a unique function name to avoid conflict with TraineeDetail.blade.php's modal
        function showTradeDeleteConfirmModal() {
            document.getElementById('tradeConfirmModal').classList.remove('hidden');
            
            return new Promise((resolve) => {
                const deleteBtn = document.getElementById('confirmTradeDeleteButton');
                
                deleteBtn.onclick = () => {
                    closeTradeConfirmModal();
                    resolve(true); 
                };

                window.closeTradeConfirmModal = () => {
                    document.getElementById('tradeConfirmModal').classList.add('hidden');
                    resolve(false);
                };
            });
        }
        
        // Attaching the custom confirmation logic to the form's submit event
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.querySelector('form[action*="trades.destroy"]');
            if (deleteForm) {
                deleteForm.onsubmit = async (event) => {
                    event.preventDefault(); 
                    const confirmed = await showTradeDeleteConfirmModal();
                    if (confirmed) {
                        deleteForm.submit(); 
                    }
                };
            }
        });
    </script>
@endsection