@extends('layouts.app')

@section('title', 'Register New Trainee')

@section('content')
<div class="max-w-8xl mx-auto p-6 bg-card-dark rounded-xl">
    
    
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100">Register New Trainee</h2>
        <a href="{{ route('trainees.index') }}" class="px-4 py-2 bg-accent-purple/90 hover:bg-accent-purple text-white font-semibold rounded-lg transition-all duration-200 shadow-md">
            ← Back to List
        </a>
    </div>

    
    <form action="{{ route('trainees.store') }}" method="POST" id="traineeRegistrationForm">
        @csrf

        
        <div id="validation-message" class="hidden mb-6 p-3 rounded-lg bg-red-800/50 text-red-300 font-medium border border-red-500"></div>

        
        <div class="mb-8 border-b border-border-dark pb-6">
            <h3 class="text-xl font-semibold text-accent-orange mb-4">1. Personal Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                
                <div class="form-group">
                    <label for="tFirstName" class="block text-gray-400 font-medium mb-2">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="tFirstName" name="tFirstName" value="{{ old('tFirstName') }}" required
                           class="w-full px-4 py-2 bg-primary-dark/80 border border-border-dark rounded-lg text-white focus:ring-accent-purple focus:border-accent-purple transition duration-150">
                    @error('tFirstName')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="tLastName" class="block text-gray-400 font-medium mb-2">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="tLastName" name="tLastName" value="{{ old('tLastName') }}" required
                           class="w-full px-4 py-2 bg-primary-dark/80 border border-border-dark rounded-lg text-white focus:ring-accent-purple focus:border-accent-purple transition duration-150">
                    @error('tLastName')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                
                <div class="form-group">
                    <label for="tGender" class="block text-gray-400 font-medium mb-2">Gender <span class="text-red-500">*</span></label>
                    <select id="tGender" name="tGender" required
                            class="w-full px-4 py-2 bg-primary-dark/80 border border-border-dark rounded-lg text-white appearance-none focus:ring-accent-purple focus:border-accent-purple transition duration-150">
                        <option value="" class="bg-primary-dark text-gray-500">-- Select Gender --</option>
                        <option value="Male" class="bg-primary-dark" {{ old('tGender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" class="bg-primary-dark" {{ old('tGender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('tGender')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="DOB" class="block text-gray-400 font-medium mb-2">Date of Birth <span class="text-red-500">*</span></label>
                    <input type="date" id="DOB" name="DOB" value="{{ old('DOB') }}" max="{{ date('Y-m-d') }}" required
                           class="w-full px-4 py-2 bg-primary-dark/80 border border-border-dark rounded-lg text-white focus:ring-accent-purple focus:border-accent-purple transition duration-150">
                    @error('DOB')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        
        <div class="mb-8 border-b border-border-dark pb-6">
            <h3 class="text-xl font-semibold text-accent-orange mb-4">2. Enrollment Details</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                
                <div class="form-group">
                    <label for="ParentNationalId" class="block text-gray-400 font-medium mb-2">Parent/Guardian <span class="text-red-500">*</span></label>
                    <select id="ParentNationalId" name="ParentNationalId" required
                            class="w-full px-4 py-2 bg-primary-dark/80 border border-border-dark rounded-lg text-white appearance-none focus:ring-accent-purple focus:border-accent-purple transition duration-150">
                        <option value="" class="bg-primary-dark text-gray-500">-- Select Parent --</option>
                        {{-- Assuming $parents is passed to the view --}}
                        @foreach($parents as $parent)
                            <option value="{{ $parent->ParentNationalId }}" class="bg-primary-dark" {{ old('ParentNationalId') == $parent->ParentNationalId ? 'selected' : '' }}>
                                {{ $parent->pFirstName }} {{ $parent->pLastName }} ({{ $parent->ParentNationalId }})
                            </option>
                        @endforeach
                    </select>
                    @error('ParentNationalId')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                    @if(isset($parents) && $parents->isEmpty())
                        <span class="text-yellow-400 text-sm mt-1 block">No parents available. <a href="{{ route('parents.create') }}" class="text-accent-purple hover:underline">Add a parent first</a>.</span>
                    @endif
                </div>

                
                <div class="form-group">
                    <label for="tradeCode" class="block text-gray-400 font-medium mb-2">Trade <span class="text-red-500">*</span></label>
                    <select id="tradeCode" name="tradeCode" required
                            class="w-full px-4 py-2 bg-primary-dark/80 border border-border-dark rounded-lg text-white appearance-none focus:ring-accent-purple focus:border-accent-purple transition duration-150">
                        <option value="" class="bg-primary-dark text-gray-500">-- Select Trade --</option>
                        {{-- Assuming $trades is passed to the view --}}
                        @foreach($trades as $trade)
                            <option value="{{ $trade->tradeCode }}" class="bg-primary-dark" {{ old('tradeCode') == $trade->tradeCode ? 'selected' : '' }}>
                                {{ $trade->TradeName }} ({{ $trade->tradeCode }})
                            </option>
                        @endforeach
                    </select>
                    @error('tradeCode')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                    @if(isset($trades) && $trades->isEmpty())
                        <span class="text-yellow-400 text-sm mt-1 block">No trades available. <a href="{{ route('trades.create') }}" class="text-accent-purple hover:underline">Add a trade first</a>.</span>
                    @endif
                </div>
            </div>
            
            
            <div class="form-group mt-6">
                <label for="Level" class="block text-gray-400 font-medium mb-2">Level <span class="text-red-500">*</span></label>
                <select id="Level" name="Level" required
                        class="w-full px-4 py-2 bg-primary-dark/80 border border-border-dark rounded-lg text-white appearance-none focus:ring-accent-purple focus:border-accent-purple transition duration-150">
                    <option value="" class="bg-primary-dark text-gray-500">-- Select Level --</option>
                    <option value="Level 1" class="bg-primary-dark" {{ old('Level') == 'Level 1' ? 'selected' : '' }}>Level 1</option>
                    <option value="Level 2" class="bg-primary-dark" {{ old('Level') == 'Level 2' ? 'selected' : '' }}>Level 2</option>
                    <option value="Level 3" class="bg-primary-dark" {{ old('Level') == 'Level 3' ? 'selected' : '' }}>Level 3</option>
                    <option value="Level 4" class="bg-primary-dark" {{ old('Level') == 'Level 4' ? 'selected' : '' }}>Level 4</option>
                    <option value="Level 5" class="bg-primary-dark" {{ old('Level') == 'Level 5' ? 'selected' : '' }}>Level 5</option>
                </select>
                @error('Level')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        
        <div class="flex justify-end gap-4 mt-6">
            <a href="{{ route('trainees.index') }}" class="px-6 py-2 border border-gray-600 text-gray-300 rounded-lg font-semibold hover:bg-gray-700 transition duration-150">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition duration-150 shadow-lg shadow-green-500/20">
                <svg class="w-5 h-5 inline-block mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Register Trainee
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('traineeRegistrationForm').onsubmit = function(event) {
        event.preventDefault(); 

        const msgBox = document.getElementById('validation-message');
        msgBox.classList.add('hidden');
        msgBox.textContent = '';
        
        const validationResult = validateTraineeForm();

        if (validationResult === true) {
            this.submit();
        } else {
            msgBox.textContent = validationResult;
            msgBox.classList.remove('hidden');
        }
    };

    function validateTraineeForm() {
        const firstName = document.getElementById('tFirstName').value.trim();
        const lastName = document.getElementById('tLastName').value.trim();
        const gender = document.getElementById('tGender').value;
        const dob = document.getElementById('DOB').value;
        const parent = document.getElementById('ParentNationalId').value;
        const trade = document.getElementById('tradeCode').value;
        const level = document.getElementById('Level').value;

        if (firstName === '' || firstName.length < 2) {
            return 'First name must be at least 2 characters.';
        }

        if (lastName === '' || lastName.length < 2) {
            return 'Last name must be at least 2 characters.';
        }

        if (gender === '') {
            return 'Please select a gender.';
        }

        if (dob === '') {
            return 'Please select date of birth.';
        }

        const today = new Date();
        const birthDate = new Date(dob);
        
        if (birthDate >= today) {
            return 'Date of birth cannot be today or in the future.';
        }

        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        if (age < 10) {
            return 'Trainee must be at least 10 years old to register.';
        }

        if (parent === '') {
            return 'Please select a parent.';
        }

        if (trade === '') {
            return 'Please select a trade.';
        }

        if (level === '') {
            return 'Please select a level.';
        }

        return true;
    }
</script>
@endsection