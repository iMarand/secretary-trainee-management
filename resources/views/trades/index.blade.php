@extends('layouts.app')

@section('title', 'Trades List')

@section('content')
<div class="space-y-6">

    
    <div class="flex justify-between items-center mb-6 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100">Trade Management</h2>
        <a href="{{ route('trades.create') }}" class="flex items-center px-4 py-2 bg-accent-purple hover:bg-accent-purple/90 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Add New Trade
        </a>
    </div>

    
    <div class="bg-primary-dark/50 p-6 rounded-xl shadow-lg border border-border-dark/70 overflow-x-auto">
        <table class="min-w-full divide-y divide-border-dark">
            <thead class="bg-primary-dark/70">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider rounded-tl-lg">
                        Trade Code
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Trade Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Trainees
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider rounded-tr-lg">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-dark">
                @forelse($trades as $trade)
                <tr class="hover:bg-primary-dark/30 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-accent-orange">
                        {{ $trade->tradeCode }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                        {{ $trade->TradeName }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-secondary-dark text-white">
                            {{ $trade->trainees_count }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('trades.show', $trade->tradeCode) }}" class="p-2 text-gray-400 hover:text-white transition duration-150 rounded-full hover:bg-gray-700/50" title="View Details">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('trades.edit', $trade->tradeCode) }}" class="p-2 text-yellow-500 hover:text-yellow-400 transition duration-150 rounded-full hover:bg-gray-700/50" title="Edit Trade">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-7 1l9-9m-3 9l9-9"></path></svg>
                            </a>
                            <form action="{{ route('trades.destroy', $trade->tradeCode) }}" method="POST" onsubmit="return showConfirmModalTrade(event, '{{ $trade->TradeName }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:text-red-400 transition duration-150 rounded-full hover:bg-gray-700/50" title="Delete Trade">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 whitespace-nowrap text-center text-sm text-gray-500 italic">
                        No trades are currently registered. Click 'Add New Trade' to get started.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<div id="tradeConfirmModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
    <div class="bg-card-dark p-8 rounded-xl max-w-lg w-full border border-red-500/30 shadow-2xl">
        <h4 class="text-xl font-bold text-red-400 mb-4">Confirm Deletion of Trade</h4>
        <p class="text-gray-300 mb-6" id="modalMessage"></p>
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeTradeConfirmModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition">Cancel</button>
            <button type="button" id="confirmTradeDeleteButton" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">Delete</button>
        </div>
    </div>
</div>

<script>
    let formToSubmit = null;

    function showConfirmModalTrade(event, tradeName) {
        event.preventDefault(); 
        formToSubmit = event.target; 


        const message = document.getElementById('modalMessage');
        message.innerHTML = `Are you absolutely sure you want to delete the trade: <strong>${tradeName}</strong>? <br><br> 
                             This action will affect all associated trainees and cannot be undone.`;


        document.getElementById('tradeConfirmModal').classList.remove('hidden');
        const deleteBtn = document.getElementById('confirmTradeDeleteButton');
        
        deleteBtn.onclick = null; 

        deleteBtn.onclick = () => {
            closeTradeConfirmModal();
            if (formToSubmit) {
                formToSubmit.submit(); 
            }
        };

        return false; 
    }

    function closeTradeConfirmModal() {
        document.getElementById('tradeConfirmModal').classList.add('hidden');
    }
</script>
@endsection