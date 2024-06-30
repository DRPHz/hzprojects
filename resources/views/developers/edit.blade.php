@extends('layouts.crud')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Developer</h1>

        <form action="{{ route('developers.update', $developer) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $developer->name) }}"
                    class="form-input w-full rounded-md shadow-sm @error('name')  bg-red-200 @enderror">
                @error('name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $developer->email) }}"
                    class="form-input w-full rounded-md shadow-sm @error('email')  bg-red-200 @enderror"
                    placeholder="example@email.com">
                @error('email')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="bio" class="block font-medium">Bio</label>
                <textarea name="bio" id="bio" class="form-textarea w-full rounded-md shadow-sm">{{ old('bio', $developer->bio) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium">Password (leave blank to keep current password)</label>
                <input type="password" id="password" name="password"
                    class="form-input w-full rounded-md shadow-sm @error('password') bg-red-200 @enderror"
                    placeholder="Enter new password if changing">

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
                    class="form-input w-full rounded-md shadow-sm @error('password_confirmation') bg-red-200 @enderror"
                    placeholder="Confirm your new password">
                @error('password_confirmation')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
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
