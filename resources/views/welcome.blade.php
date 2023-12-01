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
                @auth('client')
                    <!-- Authentication -->
                    <a href={{ url('/deconnect') }}>{{ __('Se deconnecter') }}</a>
        
                    <a href="{{ url('/myreservation') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Mes reservations</a>
                @endauth
                @if (!Auth::guard('client')->check())
                    <a href="/login"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>
        
                    <a href="/register"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif

            <!-- Page Content -->
            <main class="w-full">
                <div class="w-full my-10 flex flex-wrap justify-around">
                    @forelse ($evenements as $evenement)
                        <div class="w-2/5 mx-auto my-10 rounded overflow-hidden shadow-lg">
                            <img class="w-full h-3/6" src="{{ asset('evenements/' . $evenement->image_mise_en_avant) }}"
                                alt="Image mise en avant pour l'evenement">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">Libelle : {{ $evenement->libelle }}</div>
                                <p class="font-bold text-xl mb-2">
                                  Description: {!! nl2br(e($evenement->description)) !!}
                                </p>
                                <div class="font-bold text-xl mb-2">Date limite pour s'inscrire:
                                    {{ $evenement->date_limite_inscription }}</div>
                                <div class="font-bold text-xl mb-2">Organisateur de l'evenement: {{ $evenement->association->Nom }}
                                </div>
                                <div class="font-bold text-xl mb-2">L'evenement aura lieux le: {{ $evenement->date_evenement }}
                                </div>
                                <div class="font-bold text-xl mb-2">Lieux de l'evenenement: {{ $evenement->lieux }}</div>
                            </div>
                            <div class="d-flex justify-center flex-row px-6 py-4">
                                <form action="/reserver" method="post">
                                    @csrf
                                    <input type="hidden" name="evenement_id" value={{ $evenement->id }} />
                                    <input type="number" name="nombre_de_place"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 mt-4 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Reserver</button>
            
                                </form>
                            </div>
                        </div>
                    @empty
                        Desolé il n'y a pas d'evenement disponible actuellement
                    @endforelse
                </div>
            </main>
        </div>
    </body>
</html>
    