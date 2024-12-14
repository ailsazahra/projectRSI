<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="profile-container">
    <!-- Left Section -->
    <div class="profile-left">
        <!-- Profil Gambar -->
        <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile Photo">
        <!-- Nama -->
        <h2>{{ auth()->user()->name }}</h2>
        <!-- Email -->
        <p>{{ auth()->user()->email }}</p>
        <!-- Keahlian -->
        <p>{{ auth()->user()->expertise }}</p>
        <!-- Link -->
        <a href="{{ auth()->user()->link }}" target="_blank" class="LinkedId">
           <b>LinkedIn</b>
        </a>

    </div>

    <!-- Right Section -->
    <div class="profile-right">
        <!-- Update Profile Information -->
        <div>
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <button type="button" class="password-btn" onclick="window.location.href='{{ route('change.password') }}'">Change Password</button>



        <!-- Delete Account -->
        <div>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>



</x-app-layout>
