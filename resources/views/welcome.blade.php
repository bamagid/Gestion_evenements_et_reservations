<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased w-full">
    <nav >
        @auth('client')
            <div class="flex items-center justify-around flex-row p-4 bg-gray-300 text-black">
                <p class="text-xl font-bold">{{ Auth::guard('client')->user()->Prenom ."   ".Auth::guard('client')->user()->Nom }}</p>
                <p><a href="{{ url('/myreservation') }}" class="font-semibold hover:underline">{{ __('Mes reservations ')}}</a></p>
    
                <!-- Settings Dropdown -->
                <p><a href="{{ route('profile.edit') }}" class="font-semibold hover:underline">
                    {{ __('Modifier mes informations')}}
                </a></p>
    
                <!-- Authentication -->
                <p><a href="{{ url('/deconnect') }}" class="font-semibold hover:underline">
                    {{ __('Se deconnecter') }}
                </a></p>
    
                <p><x-danger-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                >{{ __('Delete Account') }}</x-danger-button>
            
                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')
            
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>
            
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>
            
                        <div class="mt-6">
                            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
            
                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                            />
            
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>
            
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>
            
                            <x-danger-button class="ms-3">
                                {{ __('Delete Account') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal></p>
            </div>
        @endauth
    
        @if (!Auth::guard('client')->check())
            <a href="/login" class="font-semibold hover:underline">
                {{ __('Log in') }}
            </a>
    
            <a href="/register" class="ml-4 font-semibold hover:underline">
                {{ __('Register') }}
            </a>
        @endif
    </nav>
    

    <!-- Page Content -->
    <main class="w-full">
        <div class="w-full my-10 flex flex-wrap justify-around">
            @forelse ($evenements as $evenement)
                <div class="w-2/5 mx-auto my-10 rounded overflow-hidden shadow-lg">
                    <img class="w-full h-2/5" src="{{ asset('evenements/' . $evenement->image_mise_en_avant) }}"
                        alt="Image mise en avant pour l'evenement">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">Libelle : {{ $evenement->libelle }}</div>
                        <p class="px-2 max-h-40 overflow-y-auto font-bold text-xl mb-2">
                            Description: {!! nl2br(e($evenement->description)) !!}
                        </p>
                        <div class="font-bold text-xl mb-2">Date limite pour s'inscrire:
                            {{ date('j F Y H:i:s', strtotime($evenement->date_limite_inscription)) }}</div>
                        <div class="font-bold text-xl mb-2">Organisateur de l'evenement:
                            {{ $evenement->association->Nom }}
                        </div>
                        <div class="font-bold text-xl mb-2">L'evenement aura lieux le:
                            {{ date('j F Y H:i:s', strtotime($evenement->date_evenement)) }}
                        </div>
                        <div class="font-bold text-xl mb-2">Lieux de l'evenenement: {{ $evenement->lieux }}</div>
                    </div>
                    @if ($evenement->est_cloture_ou_pas===0)                
                    <div class="d-flex justify-center flex-row px-6 py-4">
                        <form action="/reserver/evenement" method="post">
                            @csrf
                            <input type="hidden" name="evenement_id" value={{ $evenement->id }} />
                            <input type="number" name="nombre_de_place"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 mt-4 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Reserver</button>
                        </form>
                    </div>
                </div>
                    @else
                    <div class="font-bold text-xl mb-2">
                        L'evenement est cloturé, vous ne pouvez pas vous inscrire.
                    </div>
                    @endif
            @empty
                Desolé il n'y a pas d'evenement disponible actuellement
            @endforelse
        </div>
    </main>
    </div>
</body>

</html>
