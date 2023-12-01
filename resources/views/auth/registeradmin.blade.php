<x-guest-layout>
    <form method="POST" action="{{$ok==='ok' ? url('/profile/update') : route('registeradmin') }}" enctype="multipart/form-data">
        @csrf
        <!-- Full Name  -->
        <div>
            <x-input-label for="Nom" value="Nom" />
            <x-text-input  class="block mt-1 w-full" type="text" name="Nom" value="{{$ok==='ok' ? $user->Nom : ''}}" required autofocus autocomplete="Nom" />
            <x-input-error :messages="$errors->get('Nom')" class="mt-2" />
        </div>

             <!-- Creation date -->
             <div>
                <x-input-label for="Date_creation" :value="__('Date de creation')" />
                <x-text-input  class="block mt-1 w-full" type="date" name="Date_creation" value="{{$ok==='ok' ? $user->Date_creation : ''}}" required autofocus autocomplete="Date_creation" />
                <x-input-error :messages="$errors->get('Date_creation')" class="mt-2" />
            </div>

        <!-- Telephone -->
        <div>
            <x-input-label for="slogan" :value="__('Slogan')" />
            <x-text-input class="block mt-1 w-full" type="text" name="slogan" value="{{$ok==='ok' ? $user->slogan : ''}}" required autofocus  />
            <x-input-error :messages="$errors->get('slogan')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$ok==='ok' ? $user->email : ''}}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


             <!-- Logo -->
             <div>
                <x-input-label for="logo" :value="__('Logo')" />
                <x-text-input  class="block mt-1 w-full" type="file" name="logo" :value="old('logo')" required autofocus autocomplete="logo" />
                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
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
                {{$ok==='ok' ? '' : __('Vous avez déja un compte?') }}
            </a>

            <x-primary-button class="ms-4">
                {{$ok==='ok' ? 'Modifier' : __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
