@extends('layouts.app')

@section('title', 'Add New Parent')

@section('content')

<div class="max-w-8xl mx-auto">
    <div class="flex justify-between items-center mb-6 pb-4">
        <h2 class="text-3xl ml-10 font-bold text-white">Register New Parent/Guardian</h2>
        <a href="{{ route('parents.index') }}" class="px-4 py-2 bg-accent-purple/90 hover:bg-accent-purple text-white font-semibold rounded-lg transition-all duration-200 shadow-md">
            <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
    </div>

    
    <div class="p-8 bg-card-dark rounded-xl">
        <form id="parentForm" action="{{ route('parents.store') }}" method="POST">
            @csrf

            
            <div class="mb-6">
                <label for="ParentNationalId" class="block text-sm font-medium text-gray-300 mb-2">National ID <span class="text-red-500">* (16 Digits)</span></label>
                <input type="text" id="ParentNationalId" name="ParentNationalId" value="{{ old('ParentNationalId') }}" 
                    placeholder="1199XXXXXXXXXX" required 
                    class="w-full px-4 py-3 bg-primary-dark border border-border-dark/70 rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150"
                    minlength="16" maxlength="16" pattern="[0-9]{16}">
                <p id="ParentNationalIdError" class="error-text text-red-400 text-xs mt-1 hidden">National ID must be exactly 16 digits.</p>
                @error('ParentNationalId')
                    <p class="error-text text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label for="pFirstName" class="block text-sm font-medium text-gray-300 mb-2">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="pFirstName" name="pFirstName" value="{{ old('pFirstName') }}" required
                        class="w-full px-4 py-3 bg-primary-dark border border-border-dark/70 rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150">
                    <p id="pFirstNameError" class="error-text text-red-400 text-xs mt-1 hidden">First name must be at least 2 characters.</p>
                    @error('pFirstName')
                        <p class="error-text text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                
                <div>
                    <label for="pLastName" class="block text-sm font-medium text-gray-300 mb-2">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="pLastName" name="pLastName" value="{{ old('pLastName') }}" required
                        class="w-full px-4 py-3 bg-primary-dark border border-border-dark/70 rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150">
                    <p id="pLastNameError" class="error-text text-red-400 text-xs mt-1 hidden">Last name must be at least 2 characters.</p>
                    @error('pLastName')
                        <p class="error-text text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label for="pGender" class="block text-sm font-medium text-gray-300 mb-2">Gender <span class="text-red-500">*</span></label>
                    <select id="pGender" name="pGender" required
                        class="w-full px-4 py-3 bg-primary-dark border border-border-dark/70 rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none">
                        <option value="" class="bg-card-dark text-gray-500">-- Select Gender --</option>
                        <option value="Male" class="bg-card-dark" {{ old('pGender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" class="bg-card-dark" {{ old('pGender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <p id="pGenderError" class="error-text text-red-400 text-xs mt-1 hidden">Please select a gender.</p>
                    @error('pGender')
                        <p class="error-text text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                
                <div>
                    <label for="PhoneNumber" class="block text-sm font-medium text-gray-300 mb-2">Phone Number <span class="text-red-500">*</span></label>
                    <input type="tel" id="PhoneNumber" name="PhoneNumber" value="{{ old('PhoneNumber') }}" placeholder="078XXXXXXX" required
                        class="w-full px-4 py-3 bg-primary-dark border border-border-dark/70 rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150">
                    <p id="PhoneNumberError" class="error-text text-red-400 text-xs mt-1 hidden">Please enter a valid Rwandan phone number (e.g., 078xxxxxxx).</p>
                    @error('PhoneNumber')
                        <p class="error-text text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            
            <div class="mb-8">
                <label for="District" class="block text-sm font-medium text-gray-300 mb-2">District <span class="text-red-500">*</span></label>
                <select id="District" name="District" required
                    class="w-full px-4 py-3 bg-primary-dark border border-border-dark/70 rounded-lg text-white focus:ring-accent-orange focus:border-accent-orange transition duration-150 appearance-none">
                    <option value="" class="bg-card-dark text-gray-500">-- Select District --</option>
                    <option value="Bugesera" class="bg-card-dark" {{ old('District') == 'Bugesera' ? 'selected' : '' }}>Bugesera</option>
                    <option value="Gatsibo" class="bg-card-dark" {{ old('District') == 'Gatsibo' ? 'selected' : '' }}>Gatsibo</option>
                    <option value="Kayonza" class="bg-card-dark" {{ old('District') == 'Kayonza' ? 'selected' : '' }}>Kayonza</option>
                    <option value="Kirehe" class="bg-card-dark" {{ old('District') == 'Kirehe' ? 'selected' : '' }}>Kirehe</option>
                    <option value="Ngoma" class="bg-card-dark" {{ old('District') == 'Ngoma' ? 'selected' : '' }}>Ngoma</option>
                    <option value="Nyagatare" class="bg-card-dark" {{ old('District') == 'Nyagatare' ? 'selected' : '' }}>Nyagatare</option>
                    <option value="Rwamagana" class="bg-card-dark" {{ old('District') == 'Rwamagana' ? 'selected' : '' }}>Rwamagana</option>
                    <option value="Gasabo" class="bg-card-dark" {{ old('District') == 'Gasabo' ? 'selected' : '' }}>Gasabo</option>
                    <option value="Kicukiro" class="bg-card-dark" {{ old('District') == 'Kicukiro' ? 'selected' : '' }}>Kicukiro</option>
                    <option value="Nyarugenge" class="bg-card-dark" {{ old('District') == 'Nyarugenge' ? 'selected' : '' }}>Nyarugenge</option>
                </select>
                <p id="DistrictError" class="error-text text-red-400 text-xs mt-1 hidden">Please select a district.</p>
                @error('District')
                    <p class="error-text text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            
            <div class="flex justify-end space-x-4 pt-4 border-t border-border-dark/50">
                <a href="{{ route('parents.index') }}" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-accent-orange/90 hover:bg-accent-orange text-gray-900 font-bold rounded-lg transition duration-200 shadow-xl">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Add Parent
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('parentForm');
    
    const showError = (id, message) => {
        const errorElement = document.getElementById(id + 'Error');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
    };

    const hideError = (id) => {
        const errorElement = document.getElementById(id + 'Error');
        if (errorElement) {
            errorElement.classList.add('hidden');
        }
    };

    form.addEventListener('submit', function(event) {
        let isValid = true;

        const nationalIdInput = document.getElementById('ParentNationalId');
        const nationalId = nationalIdInput.value.trim();
        if (nationalId === '' || !/^\d{16}$/.test(nationalId)) {
            showError('ParentNationalId', 'National ID must be exactly 16 digits (numbers only).');
            isValid = false;
        } else {
            hideError('ParentNationalId');
        }

        // 2. First Name Validation
        const firstNameInput = document.getElementById('pFirstName');
        const firstName = firstNameInput.value.trim();
        if (firstName === '' || firstName.length < 2) {
            showError('pFirstName', 'First name must be at least 2 characters.');
            isValid = false;
        } else {
            hideError('pFirstName');
        }

  
        const lastNameInput = document.getElementById('pLastName');
        const lastName = lastNameInput.value.trim();
        if (lastName === '' || lastName.length < 2) {
            showError('pLastName', 'Last name must be at least 2 characters.');
            isValid = false;
        } else {
            hideError('pLastName');
        }

 
        const genderInput = document.getElementById('pGender');
        if (genderInput.value === '') {
            showError('pGender', 'Please select a gender.');
            isValid = false;
        } else {
            hideError('pGender');
        }

        // 5. Phone Number Validation (Rwandan format: 07[238]XXXXXXX)
        const phoneInput = document.getElementById('PhoneNumber');
        const phone = phoneInput.value.trim();
        const phoneRegex = /^07[2389]\d{7}$/;
        if (!phoneRegex.test(phone)) {
            showError('PhoneNumber', 'Please enter a valid Rwandan phone number (e.g., 078xxxxxxx).');
            isValid = false;
        } else {
            hideError('PhoneNumber');
        }

        const districtInput = document.getElementById('District');
        if (districtInput.value === '') {
            showError('District', 'Please select a district.');
            isValid = false;
        } else {
            hideError('District');
        }

        if (!isValid) {
            event.preventDefault();
            const firstError = document.querySelector('.error-text:not(.hidden)');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
});
</script>
@endsection