@extends('layouts.app')

@section('title', 'Edit Parent')

@section('content')

<div class="max-w-8xl mx-auto">
    <div class="bg-card-dark p-8 rounded-xl ">
        
        
        <div class="flex justify-between items-center border-b border-border-dark pb-4 mb-6">
            <h2 class="text-3xl font-bold text-gray-100">Edit Parent Details</h2>
            <a href="{{ route('parents.index') }}" class="px-4 py-2 bg-accent-purple/90 hover:bg-accent-purple text-white font-semibold rounded-lg transition-all duration-200 shadow-md">
                ← Back to List
            </a>
        </div>

        
        <div id="form-message" class="hidden p-3 mb-4 rounded-lg text-sm font-medium bg-red-800/30 text-red-300 border border-red-500/50"></div>

        
        <form id="editParentForm" action="{{ route('parents.update', $parent->ParentNationalId) }}" method="POST" onsubmit="return validateParentForm()">
            @csrf
            @method('PUT')

            
            <div class="mb-5">
                <label for="ParentNationalId" class="block text-sm font-medium text-gray-400 mb-1">National ID <span class="text-red-500">*</span></label>
                <input type="text" id="ParentNationalId" name="ParentNationalId" 
                       value="{{ old('ParentNationalId', $parent->ParentNationalId) }}" 
                       required readonly 
                       class="w-full p-3 rounded-lg bg-gray-700/50 border border-border-dark text-gray-400 cursor-not-allowed focus:outline-none"
                       aria-describedby="nid-help">
                <small id="nid-help" class="text-xs text-gray-500 mt-1 block">National ID cannot be changed as it serves as the primary identifier.</small>
                @error('ParentNationalId')
                    <span class="text-sm text-red-400 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                
                
                <div>
                    <label for="pFirstName" class="block text-sm font-medium text-gray-400 mb-1">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="pFirstName" name="pFirstName" 
                           value="{{ old('pFirstName', $parent->pFirstName) }}" required 
                           class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150">
                    <span id="pFirstName-error" class="text-sm text-red-400 mt-1 block hidden"></span>
                    @error('pFirstName')
                        <span class="text-sm text-red-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                
                <div>
                    <label for="pLastName" class="block text-sm font-medium text-gray-400 mb-1">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="pLastName" name="pLastName" 
                           value="{{ old('pLastName', $parent->pLastName) }}" required 
                           class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150">
                    <span id="pLastName-error" class="text-sm text-red-400 mt-1 block hidden"></span>
                    @error('pLastName')
                        <span class="text-sm text-red-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                
                
                <div>
                    <label for="pGender" class="block text-sm font-medium text-gray-400 mb-1">Gender <span class="text-red-500">*</span></label>
                    <select id="pGender" name="pGender" required 
                            class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none cursor-pointer">
                        <option value="" class="bg-gray-700">-- Select Gender --</option>
                        <option value="Male" {{ old('pGender', $parent->pGender) == 'Male' ? 'selected' : '' }} class="bg-gray-700">Male</option>
                        <option value="Female" {{ old('pGender', $parent->pGender) == 'Female' ? 'selected' : '' }} class="bg-gray-700">Female</option>
                    </select>
                    <span id="pGender-error" class="text-sm text-red-400 mt-1 block hidden"></span>
                    @error('pGender')
                        <span class="text-sm text-red-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                
                <div>
                    <label for="PhoneNumber" class="block text-sm font-medium text-gray-400 mb-1">Phone Number <span class="text-red-500">*</span></label>
                    <input type="tel" id="PhoneNumber" name="PhoneNumber" 
                           value="{{ old('PhoneNumber', $parent->PhoneNumber) }}" placeholder="078XXXXXXX" required 
                           class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150">
                    <span id="PhoneNumber-error" class="text-sm text-red-400 mt-1 block hidden"></span>
                    @error('PhoneNumber')
                        <span class="text-sm text-red-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            
            <div class="mb-8">
                <label for="District" class="block text-sm font-medium text-gray-400 mb-1">District <span class="text-red-500">*</span></label>
                <select id="District" name="District" required 
                        class="w-full p-3 bg-card-dark border border-border-dark rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none cursor-pointer">
                    <option value="" class="bg-gray-700">-- Select District --</option>
                    <option value="Bugesera" {{ old('District', $parent->District) == 'Bugesera' ? 'selected' : '' }} class="bg-gray-700">Bugesera</option>
                    <option value="Gatsibo" {{ old('District', $parent->District) == 'Gatsibo' ? 'selected' : '' }} class="bg-gray-700">Gatsibo</option>
                    <option value="Kayonza" {{ old('District', $parent->District) == 'Kayonza' ? 'selected' : '' }} class="bg-gray-700">Kayonza</option>
                    <option value="Kirehe" {{ old('District', $parent->District) == 'Kirehe' ? 'selected' : '' }} class="bg-gray-700">Kirehe</option>
                    <option value="Ngoma" {{ old('District', $parent->District) == 'Ngoma' ? 'selected' : '' }} class="bg-gray-700">Ngoma</option>
                    <option value="Nyagatare" {{ old('District', $parent->District) == 'Nyagatare' ? 'selected' : '' }} class="bg-gray-700">Nyagatare</option>
                    <option value="Rwamagana" {{ old('District', $parent->District) == 'Rwamagana' ? 'selected' : '' }} class="bg-gray-700">Rwamagana</option>
                    <option value="Gasabo" {{ old('District', $parent->District) == 'Gasabo' ? 'selected' : '' }} class="bg-gray-700">Gasabo</option>
                    <option value="Kicukiro" {{ old('District', $parent->District) == 'Kicukiro' ? 'selected' : '' }} class="bg-gray-700">Kicukiro</option>
                    <option value="Nyarugenge" {{ old('District', $parent->District) == 'Nyarugenge' ? 'selected' : '' }} class="bg-gray-700">Nyarugenge</option>
                </select>
                <span id="District-error" class="text-sm text-red-400 mt-1 block hidden"></span>
                @error('District')
                    <span class="text-sm text-red-400 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex justify-start gap-4 pt-4 border-t border-border-dark/50">
                <button type="submit" class="px-6 py-2 bg-accent-orange hover:bg-orange-600 text-gray-900 font-bold rounded-lg transition-all duration-200 shadow-lg">
                    Update Parent
                </button>
                <a href="{{ route('parents.index') }}" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-all duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function displayError(fieldId, message) {
        const errorSpan = document.getElementById(fieldId + '-error');
        if (errorSpan) {
            errorSpan.textContent = message;
            errorSpan.classList.remove('hidden');
            document.getElementById(fieldId).classList.add('border-red-500');
            document.getElementById(fieldId).classList.remove('focus:ring-accent-orange', 'focus:border-accent-orange');
        }
    }

    function clearErrors() {
        // Clear global message
        document.getElementById('form-message').classList.add('hidden');
        
        // Clear field-specific errors
        const fields = ['pFirstName', 'pLastName', 'pGender', 'PhoneNumber', 'District'];
        fields.forEach(field => {
            const errorSpan = document.getElementById(field + '-error');
            const input = document.getElementById(field);
            if (errorSpan) errorSpan.classList.add('hidden');
            if (input) {
                input.classList.remove('border-red-500');
                input.classList.add('focus:ring-accent-orange', 'focus:border-accent-orange');
            }
        });
    }

    function showGlobalError(message) {
        const globalMessage = document.getElementById('form-message');
        globalMessage.textContent = message;
        globalMessage.classList.remove('hidden');
        globalMessage.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function validateParentForm() {
        clearErrors();
        let isValid = true;

        const firstName = document.getElementById('pFirstName').value.trim();
        const lastName = document.getElementById('pLastName').value.trim();
        const gender = document.getElementById('pGender').value;
        const phone = document.getElementById('PhoneNumber').value.trim();
        const district = document.getElementById('District').value;

        if (firstName === '' || firstName.length < 2) {
            displayError('pFirstName', 'First name must be at least 2 characters.');
            isValid = false;
        }

        if (lastName === '' || lastName.length < 2) {
            displayError('pLastName', 'Last name must be at least 2 characters.');
            isValid = false;
        }

        if (gender === '') {
            displayError('pGender', 'Please select a gender.');
            isValid = false;
        }

        const phoneRegex = /^07[2389]\d{7}$/; 
        if (!phoneRegex.test(phone)) {
            displayError('PhoneNumber', 'Please enter a valid Rwandan phone number (e.g., 0781234567).');
            isValid = false;
        }

   
        if (district === '') {
            displayError('District', 'Please select a district.');
            isValid = false;
        }

        if (!isValid) {
            showGlobalError('Please correct the errors in the highlighted fields before submitting.');
        }

        return isValid;
    }
</script>
@endsection