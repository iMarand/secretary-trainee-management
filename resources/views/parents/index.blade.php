@extends('layouts.app')

@section('title', 'Parents List')

@section('content')

    
    <div class="flex justify-between items-center mb-6 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100">All Registered Parents</h2>
        <a href="{{ route('parents.create') }}" class="px-5 py-2 bg-accent-purple hover:bg-accent-purple/90 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span class="hidden sm:inline">Add New Parent</span>
        </a>
    </div>

    
    <div class="bg-primary-dark/50 p-6 rounded-xl shadow-2xl border border-border-dark/70">
        
        
        <div class="hidden md:grid grid-cols-10 gap-4 text-xs font-semibold uppercase text-gray-400 border-b border-border-dark pb-3 mb-3 px-4">
            <div class="col-span-2">National ID</div>
            <div class="col-span-3">Full Name</div>
            <div class="col-span-1">Gender</div>
            <div class="col-span-2">Phone Number</div>
            <div class="col-span-1 text-center">Children</div>
            <div class="col-span-1 text-center">Actions</div>
        </div>

        
        <div class="space-y-3">
            @forelse($parents as $parent)
            
            <div class="grid grid-cols-1 md:grid-cols-10 gap-y-2 md:gap-4 p-4 bg-card-dark rounded-lg hover:bg-card-dark/70 transition-colors duration-150 items-center border border-transparent hover:border-accent-purple/30">

                
                <div class="col-span-2 text-sm font-mono text-accent-orange/80">
                    <span class="md:hidden font-semibold text-gray-400">ID: </span>{{ $parent->ParentNationalId }}
                </div>

                
                <div class="col-span-3 text-sm font-semibold text-white">
                    <span class="md:hidden font-semibold text-gray-400">Name: </span>{{ $parent->pFirstName }} {{ $parent->pLastName }}
                </div>

                
                <div class="col-span-1 text-sm text-gray-300">
                    <span class="md:hidden font-semibold text-gray-400">Gender: </span>{{ $parent->pGender }}
                </div>

                
                <div class="col-span-2 text-sm text-gray-300">
                    <span class="md:hidden font-semibold text-gray-400">Contact: </span>
                    {{ $parent->PhoneNumber }} 
                    <span class="text-xs text-gray-500 hidden sm:inline">({{ $parent->District }})</span>
                    <div class="text-xs text-gray-500 sm:hidden">{{ $parent->District }}</div>
                </div>

                
                <div class="col-span-1 text-sm font-bold text-center">
                    <span class="md:hidden font-semibold text-gray-400">Children: </span>
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-accent-purple/30 text-accent-purple">{{ $parent->trainees_count }}</span>
                </div>

                
                <div class="col-span-1 flex justify-center md:justify-end space-x-2 mt-2 md:mt-0">
                    
                    <a href="{{ route('parents.show', $parent->ParentNationalId) }}" title="View Details" class="p-2 bg-blue-600/80 hover:bg-blue-600 text-white rounded-md transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </a>
                    
                    <a href="{{ route('parents.edit', $parent->ParentNationalId) }}" title="Edit Parent" class="p-2 bg-yellow-600/80 hover:bg-yellow-600 text-gray-900 rounded-md transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-9-4l9-9m-3 9l9-9"></path></svg>
                    </a>
                    
                    <button type="button" 
                            onclick="showConfirmModal('{{ route('parents.destroy', $parent->ParentNationalId) }}')" 
                            title="Delete Parent" 
                            class="p-2 bg-red-600/80 hover:bg-red-600 text-white rounded-md transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
            @empty
            <div class="text-center py-8 bg-card-dark rounded-lg text-gray-400">
                <p>No parents registered yet. Click the button above to add a new parent.</p>
            </div>
            @endforelse
        </div>
    </div>

    
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
        <div class="bg-card-dark p-8 rounded-lg max-w-lg w-full border border-red-500/30 shadow-2xl">
            <h4 class="text-2xl font-bold text-red-400 mb-4">Confirm Deletion</h4>
            <p class="text-gray-300 mb-6 text-lg">
                Are you absolutely sure you want to delete this parent? 
                <span class="font-bold text-red-300">This action is permanent and will also delete all associated trainees (children) under this parent.</span>
            </p>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeConfirmModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition">Cancel</button>
                <button type="button" id="confirmDeleteButton" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">Yes, Delete Parent & Trainees</button>
            </div>
        </div>
    </div>

    
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        const deleteForm = document.getElementById('deleteForm');
        const confirmModal = document.getElementById('confirmModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        
        function showConfirmModal(actionUrl) {
            deleteForm.action = actionUrl;
            confirmModal.classList.remove('hidden');
        }
        
        function closeConfirmModal() {
            confirmModal.classList.add('hidden');
        }

        confirmDeleteButton.onclick = () => {
            closeConfirmModal();
            deleteForm.submit(); 
        };
    </script>

@endsection