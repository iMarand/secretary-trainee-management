@extends('layouts.app')

@section('title', 'Edit Trainee')

@section('content')

    
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100">
            <span class="text-accent-orange">Editing:</span> {{ $trainee->tFirstName }} {{ $trainee->tLastName }}
        </h2>
        <a href="{{ route('trainees.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-md">
            ← Back to List
        </a>
    </div>

    
    <div class="bg-primary-dark/50 p-6 rounded-xl border border-border-dark/70">
        
        
        <div id="client-error-box" class="hidden mb-6 p-4 rounded-lg bg-red-900/50 text-red-400 border border-red-600/50 font-medium"></div>

        <form action="{{ route('trainees.update', $trainee->traineeId) }}" method="POST" onsubmit="return validateTraineeForm()">
            @csrf
            @method('PUT')

            
            <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-2 mb-6">Personal Details</h3>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label for="tFirstName" class="block text-sm font-medium text-gray-400 mb-2">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="tFirstName" name="tFirstName" value="{{ old('tFirstName', $trainee->tFirstName) }}" required 
                           class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150">
                    @error('tFirstName')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                
                <div>
                    <label for="tLastName" class="block text-sm font-medium text-gray-400 mb-2">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="tLastName" name="tLastName" value="{{ old('tLastName', $trainee->tLastName) }}" required
                           class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150">
                    @error('tLastName')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-8">
                
                <div>
                    <label for="tGender" class="block text-sm font-medium text-gray-400 mb-2">Gender <span class="text-red-500">*</span></label>
                    <select id="tGender" name="tGender" required
                            class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none cursor-pointer">
                        <option value="" class="bg-card-dark text-gray-400">-- Select Gender --</option>
                        <option value="Male" {{ old('tGender', $trainee->tGender) == 'Male' ? 'selected' : '' }} class="bg-card-dark">Male</option>
                        <option value="Female" {{ old('tGender', $trainee->tGender) == 'Female' ? 'selected' : '' }} class="bg-card-dark">Female</option>
                    </select>
                    @error('tGender')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                
                <div>
                    <label for="DOB" class="block text-sm font-medium text-gray-400 mb-2">Date of Birth <span class="text-red-500">*</span></label>
                    <input type="date" id="DOB" name="DOB" value="{{ old('DOB', $trainee->DOB) }}" max="{{ date('Y-m-d') }}" required
                           class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none">
                    @error('DOB')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            
            <h3 class="text-xl font-semibold text-accent-orange border-b border-border-dark pb-2 mb-6">Enrollment & Guardian</h3>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label for="ParentNationalId" class="block text-sm font-medium text-gray-400 mb-2">Guardian <span class="text-red-500">*</span></label>
                    <select id="ParentNationalId" name="ParentNationalId" required
                            class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none cursor-pointer">
                        <option value="" class="bg-card-dark text-gray-400">-- Select Guardian --</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->ParentNationalId }}" {{ old('ParentNationalId', $trainee->ParentNationalId) == $parent->ParentNationalId ? 'selected' : '' }} class="bg-card-dark">
                                {{ $parent->pFirstName }} {{ $parent->pLastName }} ({{ $parent->ParentNationalId }})
                            </option>
                        @endforeach
                    </select>
                    @error('ParentNationalId')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                
                <div>
                    <label for="tradeCode" class="block text-sm font-medium text-gray-400 mb-2">Trade <span class="text-red-500">*</span></label>
                    <select id="tradeCode" name="tradeCode" required
                            class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none cursor-pointer">
                        <option value="" class="bg-card-dark text-gray-400">-- Select Trade --</option>
                        @foreach($trades as $trade)
                            <option value="{{ $trade->tradeCode }}" {{ old('tradeCode', $trainee->tradeCode) == $trade->tradeCode ? 'selected' : '' }} class="bg-card-dark">
                                {{ $trade->TradeName }} ({{ $trade->tradeCode }})
                            </option>
                        @endforeach
                    </select>
                    @error('tradeCode')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            
            <div class="mb-8 max-w-md">
                <label for="Level" class="block text-sm font-medium text-gray-400 mb-2">Level <span class="text-red-500">*</span></label>
                <select id="Level" name="Level" required
                        class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none cursor-pointer">
                    <option value="" class="bg-card-dark text-gray-400">-- Select Level --</option>
                    <option value="Level 1" {{ old('Level', $trainee->Level) == 'Level 1' ? 'selected' : '' }} class="bg-card-dark">Level 1</option>
                    <option value="Level 2" {{ old('Level', $trainee->Level) == 'Level 2' ? 'selected' : '' }} class="bg-card-dark">Level 2</option>
                    <option value="Level 3" {{ old('Level', $trainee->Level) == 'Level 3' ? 'selected' : '' }} class="bg-card-dark">Level 3</option>
                    <option value="Level 4" {{ old('Level', $trainee->Level) == 'Level 4' ? 'selected' : '' }} class="bg-card-dark">Level 4</option>
                    <option value="Level 5" {{ old('Level', $trainee->Level) == 'Level 5' ? 'selected' : '' }} class="bg-card-dark">Level 5</option>
                </select>
                @error('Level')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex gap-4 pt-4 border-t border-border-dark/50">
                <button type="submit" class="px-6 py-3 bg-accent-orange hover:bg-opacity-90 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m15.356-2H20v5m-1 2H5m0 0l2-2m-2 2l2 2m9-2h-3m3 0l-2-2m2 2l-2 2"></path></svg>
                    Update Trainee
                </button>
                <a href="{{ route('trainees.index') }}" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    
    <script>
    function showClientError(message) {
        const errorBox = document.getElementById('client-error-box');
        errorBox.textContent = message;
        errorBox.classList.remove('hidden');
        
        errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });

        setTimeout(() => {
            errorBox.classList.add('hidden');
        }, 5000);
    }

    function validateTraineeForm() {
        document.getElementById('client-error-box').classList.add('hidden');

        const firstName = document.getElementById('tFirstName').value.trim();
        const lastName = document.getElementById('tLastName').value.trim();
        const gender = document.getElementById('tGender').value;
        const dob = document.getElementById('DOB').value;
        const parent = document.getElementById('ParentNationalId').value;
        const trade = document.getElementById('tradeCode').value;
        const level = document.getElementById('Level').value;

        if (firstName === '' || firstName.length < 2) {
            showClientError('First name is required and must be at least 2 characters.');
            return false;
        }

        if (lastName === '' || lastName.length < 2) {
            showClientError('Last name is required and must be at least 2 characters.');
            return false;
        }

        if (gender === '') {
            showClientError('Please select a gender.');
            return false;
        }

        if (dob === '') {
            showClientError('Please select the date of birth.');
            return false;
        }

        const today = new Date();
        // Convert DOB to Date object, adjusting for time zone issues by only comparing date parts
        const birthDate = new Date(dob);
        const maxDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

        if (birthDate >= maxDate) {
            showClientError('Date of birth cannot be today or in the future.');
            return false;
        }

        if (parent === '') {
            showClientError('Please select a guardian/parent.');
            return false;
        }

        if (trade === '') {
            showClientError('Please select a trade.');
            return false;
        }

        if (level === '') {
            showClientError('Please select the trainee level.');
            return false;
        }

        return true;
    }
    </script>
@endsection