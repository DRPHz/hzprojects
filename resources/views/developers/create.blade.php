@extends('layouts.crud')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Create Developer</h1>

        <form action="{{ route('developers.store') }}" method="POST" class="space-y-4">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" id="name"
                    class="form-input w-full rounded-md shadow-sm border-2 @error('name') border-red-500 @enderror"
                    placeholder="Enter Developer's Name">
                @error('name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="website" class="block font-medium">Website</label>
                <input type="url" name="website" id="website"
                    class="form-input w-full rounded-md shadow-sm border-2 @error('website') border-red-500 @enderror"
                    placeholder="https://example.com">
                @error('website')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="bio" class="block font-medium">Bio &#40;optional&#41;</label>
                <textarea name="bio" id="bio" class="form-textarea w-full rounded-md shadow-sm border-2"></textarea>
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium">Password</label>
                <input type="password" id="password" name="password"
                    class="form-input w-full rounded-md shadow-sm border-2 @error('password') border-red-500 @enderror"
                    placeholder="Enter your password">
                <ul id="password-requirements" class="text-sm mt-1 space-y-1 hidden">
                    <li class="requirement">Must be at least 8 characters long</li>
                    <li class="requirement">Must contain at least one uppercase letter</li>
                    <li class="requirement">Must contain at least one lowercase letter</li>
                    <li class="requirement">Must contain at least one number</li>
                    <li class="requirement">Must contain at least one special character (@$!%*?&)</li>
                </ul>
                @error('password')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-input w-full rounded-md shadow-sm border-2 @error('password_confirmation') border-red-500 @enderror"
                    placeholder="Confirm your password">
                @error('password_confirmation')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var passwordField = document.getElementById('password');
            var requirementsList = document.getElementById('password-requirements');

            function validatePassword() {
                var password = passwordField.value;
                var requirements = document.querySelectorAll('.requirement');

                // Define the patterns for each requirement
                var patterns = [
                    /.{8,}/,
                    /[A-Z]/,
                    /[a-z]/,
                    /\d/,
                    /[@$!%*?&]/
                ];

                // Check each requirement against the password
                requirements.forEach(function(requirement, index) {
                    var pattern = patterns[index];
                    if (password.match(pattern)) {
                        requirement.classList.remove('text-red-500');
                        requirement.classList.add('text-green-500');
                    } else {
                        requirement.classList.remove('text-green-500');
                        requirement.classList.add('text-red-500');
                    }
                });

                // Show requirements list if password field is focused
                if (passwordField === document.activeElement) {
                    requirementsList.classList.remove('hidden');
                } else {
                    requirementsList.classList.add('hidden');
                }
            }

            // Attach the validatePassword function to the input event of password field
            passwordField.addEventListener('input', validatePassword);

            // Initial validation on page load
            validatePassword();
        });
    </script>
@endsection
