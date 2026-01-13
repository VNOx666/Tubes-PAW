<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
<div class="mt-4">
    <x-input-label for="role" value="Daftar sebagai" />
    <select id="role" name="role" class="block mt-1 w-full rounded-md border-gray-300">
        <option value="buyer" {{ old('role','buyer')==='buyer'?'selected':'' }}>Buyer</option>
        <option value="seller" {{ old('role')==='seller'?'selected':'' }}>Seller</option>
    </select>
    <x-input-error :messages="$errors->get('role')" class="mt-2" />
</div>

<!-- Gender -->
<div class="mt-4">
    <x-input-label for="gender" value="Gender" />
    <select id="gender" name="gender" class="block mt-1 w-full rounded-md border-gray-300">
        <option value="">Pilih</option>
        <option value="male" {{ old('gender')==='male'?'selected':'' }}>Male</option>
        <option value="female" {{ old('gender')==='female'?'selected':'' }}>Female</option>
        <option value="other" {{ old('gender')==='other'?'selected':'' }}>Other</option>
    </select>
    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
</div>

<!-- Bio -->
<div class="mt-4">
    <x-input-label for="bio" value="Bio" />
    <textarea id="bio" name="bio" rows="3"
        class="block mt-1 w-full rounded-md border-gray-300">{{ old('bio') }}</textarea>
    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
</div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
