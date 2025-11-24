<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Create an account</h1>
        <p class="text-sm text-gray-500">Sign up to access all features</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" 
                name="name" 
                type="text" 
                class="block mt-1 w-full rounded-full px-4 py-3"
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" 
                name="email" 
                type="email" 
                class="block mt-1 w-full rounded-full px-4 py-3"
                :value="old('email')" 
                required 
                autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Phone --}}
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" 
                name="phone" 
                type="tel"
                class="block mt-1 w-full rounded-full px-4 py-3"
                :value="old('phone')" 
                required 
                autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        {{-- Role --}}
        <div>
            <x-input-label for="role" :value="__('Daftar sebagai')" />
            <select id="role" 
                name="role" 
                required
                class="block mt-1 w-full rounded-full px-4 py-3 border-gray-300">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Pilih Peran --</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="eo" {{ old('role') == 'eo' ? 'selected' : '' }}>Event Organizer</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" 
                name="password" 
                type="password"
                class="block mt-1 w-full rounded-full px-4 py-3" 
                required 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" 
                name="password_confirmation"
                type="password" 
                class="block mt-1 w-full rounded-full px-4 py-3"
                required 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Submit --}}
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}"
                class="text-sm text-gray-600 hover:text-gray-900">{{ __('Already registered?') }}</a>

            <x-primary-button class="ms-4 w-full py-3 rounded-full">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
