<x-guest-layout>
    <form method="POST" action="{{$ok==='ok' ? route('profile.update') : route('registerok') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="Prenom" :value="__('Prenom')" />
            <x-text-input  class="block mt-1 w-full" type="text" name="Prenom" value="{{$ok==='ok' ? $user->Prenom : ''}}" required autofocus autocomplete="Prenom" />
            <x-input-error :messages="$errors->get('Prenom')" class="mt-2" />
        </div>
        <!-- Last Name -->
        <div>
            <x-input-label for="Nom" :value="__('Nom')" />
            <x-text-input  class="block mt-1 w-full" type="text" name="Nom" value="{{$ok==='ok' ? $user->Nom : ''}}" required autofocus autocomplete="Nom" />
            <x-input-error :messages="$errors->get('Nom')" class="mt-2" />
        </div>

        <!-- Telephone -->
        <div>
            <x-input-label for="Telephone" :value="__('Telephone')" />
            <x-text-input class="block mt-1 w-full" type="text" name="Telephone" value="{{$ok==='ok' ? $user->Telephone : ''}}" required autofocus autocomplete="Telephone" />
            <x-input-error :messages="$errors->get('Telephone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$ok==='ok' ? $user->email: ''}}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="/login">
                {{ __('Vous avez déja un compte?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
