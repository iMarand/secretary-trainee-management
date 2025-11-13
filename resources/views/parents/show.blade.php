@extends('layouts.app')

@section('title', 'Parent Details')

@section('content')

    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100 mb-4 md:mb-0">Guardian Profile: <span class="text-accent-orange">{{ $parent->pFirstName }} {{ $parent->pLastName }}</span></h2>
        
        <div class="flex gap-3">
            <a href="{{ route('parents.index') }}" class="px-4 py-2 bg-accent-orange/90 hover:bg-accent-orange text-white font-semibold rounded-lg transition-all duration-200 shadow-md">
                <span class="hidden md:inline">← Back to List</span>
                <span class="md:hidden">← List</span>
            </a>
            
            <a href="{{ route('parents.edit', $parent->ParentNationalId) }}" class="px-4 py-2 bg-accent-orange/90 hover:bg-accent-orange text-gray-900 font-semibold rounded-lg transition-all duration-200 shadow-md">
                <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-9-4l9-9m-3 9l9-9"></path></svg>
                Edit Details
            </a>
        </div>
    </div>

    
    <div class="p-6 bg-primary-dark/50 rounded-xl border border-border-dark/70 shadow-lg">
        <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-3 mb-5">Contact & Identification</h3>
        
        <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5 text-sm">
            
            
            <div class="md:col-span-2 lg:col-span-1">
                <dt class="font-medium text-gray-400">Full Name</dt>
                <dd class="text-lg font-bold text-white">{{ $parent->pFirstName }} {{ $parent->pLastName }}</dd>
            </div>
            
            
            <div>
                <dt class="font-medium text-gray-400">National ID</dt>
                <dd class="text-base text-gray-300 font-mono">{{ $parent->ParentNationalId }}</dd>
            </div>

            
            <div>
                <dt class="font-medium text-gray-400">Gender</dt>
                <dd class="text-base text-white">{{ $parent->pGender }}</dd>
            </div>

            
            <div>
                <dt class="font-medium text-gray-400">Phone Number</dt>
                <dd class="text-base text-white">{{ $parent->PhoneNumber }}</dd>
            </div>

            
            <div>
                <dt class="font-medium text-gray-400">District</dt>
                <dd class="text-base text-white">{{ $parent->District }}</dd>
            </div>
            
            
            <div>
                <dt class="font-medium text-gray-400">Registered On</dt>
                <dd class="text-base text-white">{{ date('d-m-Y H:i', strtotime($parent->created_at)) }}</dd>
            </div>
            
            
            <div class="lg:col-span-3 pt-3 border-t border-border-dark">
                <dt class="font-medium text-gray-400">Total Registered Trainees</dt>
                <dd class="text-2xl font-bold text-accent-orange">{{ $parent->trainees->count() }}</dd>
            </div>
        </dl>
    </div>

    
    @if($parent->trainees->count() > 0)
    <div class="mt-8 p-6 bg-primary-dark/50 rounded-xl border border-border-dark/70 shadow-lg">
        <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-3 mb-5">Associated Trainees ({{ $parent->trainees->count() }})</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border-dark/50 rounded-lg overflow-hidden">
                <thead class="bg-primary-dark text-gray-300 uppercase text-xs tracking-wider">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left font-medium">ID</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Full Name</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Gender</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Trade</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Level</th>
                        <th scope="col" class="px-6 py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark/50 text-gray-200">
                    @foreach($parent->trainees as $trainee)
                    <tr class="hover:bg-primary-dark/30 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $trainee->traineeId }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $trainee->tFirstName }} {{ $trainee->tLastName }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $trainee->tGender }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-accent-orange">{{ $trainee->trade->TradeName ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $trainee->Level }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('trainees.show', $trainee->traineeId) }}" class="text-accent-orange hover:text-white transition duration-150">View Trainee →</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    
    <div class="mt-8 pt-6 border-t border-border-dark/50">
        <form id="deleteParentForm" action="{{ route('parents.destroy', $parent->ParentNationalId) }}" method="POST" onsubmit="return showConfirmModal(event)">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Delete Parent (Warning: Deletes associated Trainees!)
            </button>
        </form>
    </div>

    
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
        <div class="bg-card-dark p-8 rounded-lg max-w-lg w-full border border-red-500/30 shadow-2xl">
            <h4 class="text-xl font-bold text-red-400 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Confirm Destructive Action
            </h4>
            <p class="text-gray-300 mb-6">You are about to delete this parent. <strong class="text-red-300">This action will also permanently delete all associated trainee records!</strong> This cannot be undone.</p>
            <p class="text-sm text-gray-400 mb-6">Are you sure you want to proceed?</p>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeConfirmModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition">Cancel</button>
                <button type="button" id="confirmDeleteButton" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">Delete Parent</button>
            </div>
        </div>
    </div>

    <script>
        function showConfirmModal(event) {
            event.preventDefault(); 
            
            const modal = document.getElementById('confirmModal');
            const deleteBtn = document.getElementById('confirmDeleteButton');
            const deleteForm = event.target;

            modal.classList.remove('hidden');
            
            deleteBtn.onclick = () => {
                closeConfirmModal();
                deleteForm.submit(); 
            };

            window.closeConfirmModal = () => {
                modal.classList.add('hidden');
            };
            
            return false;
        }
    </script>
@endsection