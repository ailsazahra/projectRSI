<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <!-- Nama -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        
        <!-- Foto Profil -->
        <div>
            <x-input-label for="profile_photo" :value="('Profile Photo')" />
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="mt-1 block w-full">
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />

            @if ($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="mt-2 w-24 h-24 rounded-full">
            @endif
        </div>

        <!-- Expertise -->
        <div>
            <x-input-label for="expertise" :value="('Expertise')" />
            <x-text-input id="expertise" name="expertise" type="text" class="mt-1 block w-full" :value="old('expertise', $user->expertise)" autocomplete="expertise" />
            <x-input-error class="mt-2" :messages="$errors->get('expertise')" />
        </div>

        <!-- Link -->
        <div>
            <x-input-label for="link" :value="('Link')" />
            <x-text-input id="link" name="link" type="url" class="mt-1 block w-full" :value="old('link', $user->link)" autocomplete="link" />
            <x-input-error class="mt-2" :messages="$errors->get('link')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="save-btn">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
