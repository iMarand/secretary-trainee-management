@extends('layouts.app')

@section('title', 'Trainee Details')


@section('content')

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100 mb-4 md:mb-0">Trainee Profile: <span class="text-accent-orange">{{ $trainee->tFirstName }} {{ $trainee->tLastName }}</span></h2>
        
        <div class="flex gap-3">
            <a href="{{ route('trainees.index') }}" class="px-4 py-2 bg-accent-orange/90 hover:bg-accent-orange text-white font-semibold rounded-lg transition-all duration-200 shadow-md">
                <span class="hidden md:inline">← Back to List</span>
                <span class="md:hidden">← List</span>
            </a>
            
            <a href="{{ route('trainees.edit', $trainee->traineeId) }}" class="px-4 py-2 bg-accent-orange/90 hover:bg-accent-orange text-gray-900 font-semibold rounded-lg transition-all duration-200 shadow-md">
                <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-9-4l9-9m-3 9l9-9"></path></svg>
                Edit Profile
            </a>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="col-span-1 lg:col-span-2 space-y-4 p-5 bg-primary-dark/50 rounded-xl border border-border-dark/70">
            <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-2 mb-4">Personal Details</h3>
            
            <dl class="grid grid-cols-2 gap-x-4 gap-y-3 text-sm">
                
                
                <div class="col-span-2 md:col-span-1">
                    <dt class="font-medium text-gray-400">Trainee Name</dt>
                    <dd class="text-lg font-bold text-white">{{ $trainee->tFirstName }} {{ $trainee->tLastName }}</dd>
                </div>
                
                
                <div class="col-span-2 md:col-span-1">
                    <dt class="font-medium text-gray-400">Trainee ID</dt>
                    <dd class="text-base text-gray-300">{{ $trainee->traineeId }}</dd>
                </div>

                
                <div>
                    <dt class="font-medium text-gray-400">Gender</dt>
                    <dd class="text-base text-white">{{ $trainee->tGender }}</dd>
                </div>

                
                <div>
                    <dt class="font-medium text-gray-400">Date of Birth</dt>
                    <dd class="text-base text-white">{{ date('d-m-Y', strtotime($trainee->DOB)) }}</dd>
                </div>
                
                
                <div>
                    <dt class="font-medium text-gray-400">Age</dt>
                    <dd class="text-base text-white">{{ date('Y') - date('Y', strtotime($trainee->DOB)) }} years</dd>
                </div>

                
                <div>
                    <dt class="font-medium text-gray-400">Registered On</dt>
                    <dd class="text-base text-white">{{ date('d-m-Y H:i', strtotime($trainee->created_at)) }}</dd>
                </div>
            </dl>
        </div>
        
        
        <div class="col-span-1 space-y-6">
            
            
            <div class="p-5 bg-primary-dark/50 rounded-xl border border-border-dark/70">
                <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-2 mb-4">Enrollment</h3>
                <dl class="space-y-3 text-sm">
                    <div>
                        <dt class="font-medium text-gray-400">Trade</dt>
                        <dd class="text-base text-white">{{ $trainee->trade->TradeName ?? 'N/A' }}</dd>
                        <span class="text-xs text-gray-500">({{ $trainee->tradeCode }})</span>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-400">Level</dt>
                        <dd class="text-base text-white">{{ $trainee->Level }}</dd>
                    </div>
                </dl>
            </div>
            
            
            <div class="p-5 bg-primary-dark/50 rounded-xl border border-border-dark/70">
                <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-2 mb-4">Parent/Guardian</h3>
                <dl class="space-y-3 text-sm">
                    <div>
                        <dt class="font-medium text-gray-400">Guardian Name</dt>
                        <dd class="text-base text-white">{{ $trainee->parent->pFirstName ?? 'N/A' }} {{ $trainee->parent->pLastName ?? '' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-400">National ID</dt>
                        <dd class="text-base text-white">{{ $trainee->ParentNationalId }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-400">Phone & District</dt>
                        <dd class="text-base text-white">{{ $trainee->parent->PhoneNumber ?? 'N/A' }}</dd>
                        <span class="text-xs text-gray-500">({{ $trainee->parent->District ?? 'N/A' }})</span>
                    </div>
                </dl>
            </div>

        </div>
    </div>

    
    <div class="mt-8 pt-6 border-t border-border-dark/50">
        <form action="{{ route('trainees.destroy', $trainee->traineeId) }}" method="POST" onsubmit="return showConfirmModal()">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Permanently Delete Trainee
            </button>
        </form>
    </div>

    
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
        <div class="bg-card-dark p-8 rounded-lg max-w-sm w-full border border-red-500/30 shadow-2xl">
            <h4 class="text-xl font-bold text-red-400 mb-4">Confirm Deletion</h4>
            <p class="text-gray-300 mb-6">Are you absolutely sure you want to delete this trainee? This action cannot be undone.</p>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeConfirmModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition">Cancel</button>
                <button type="button" id="confirmDeleteButton" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">Delete</button>
            </div>
        </div>
    </div>

    <script>
        function showConfirmModal() {
            
            document.getElementById('confirmModal').classList.remove('hidden');
            
            
            return new Promise((resolve) => {
                const deleteBtn = document.getElementById('confirmDeleteButton');
                
                
                deleteBtn.onclick = () => {
                    closeConfirmModal();
                    resolve(true); 
                };

                
                window.closeConfirmModal = () => {
                    document.getElementById('confirmModal').classList.add('hidden');
                    resolve(false); 
                };
            });
        }
        
        
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.querySelector('form[action*="trainees.destroy"]');
            if (deleteForm) {
                deleteForm.onsubmit = async (event) => {
                    event.preventDefault(); 
                    const confirmed = await showConfirmModal();
                    if (confirmed) {
                        deleteForm.submit(); 
                    }
                };
            }
        });
    </script>
@endsection