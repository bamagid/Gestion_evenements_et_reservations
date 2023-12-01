<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>mes reservations</title>
</head>

<body class="font-sans antialiased bg-gray-100 p-8">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6">Les reservation de cet evenement</h1>
        <table class="min-w-full border border-gray-300 bg-white shadow-md">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nom du client</th>
                    <th class="py-2 px-4 border-b">Email du client</th>
                    <th class="py-2 px-4 border-b">Date de reservation</th>
                    <th class="py-2 px-4 border-b">Nombre de places</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                    <th class="py-2 px-4 border-b">Reference </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-12 border-b ">{{ $reservation->client->Prenom }}
                            {{ $reservation->client->Nom }}</td>
                        <td class="py-2 px-20 border-b ">{{ $reservation->client->email }}</td>
                        <td class="py-2 px-20 border-b ">{{ date( 'j F Y H:i:s' ,strtotime($reservation->created_at ))}}</td>
                        <td class="py-2 px-20 border-b ">{{ $reservation->nombre_de_place }}</td>
                        @if ($reservation->est_accepte_ou_pas === 1)
                            <form action="/reservation/decline/{{ $reservation->id }}" method="post">
                                @csrf
                                @method('put')
                                <td class="py-2 px-4 border-b "> <button type="submit"
                                        class="bg-red-500  text-white font-bold py-2 px-4 rounded">Decline</button>
                                </td>
                            </form>
                        @else
                            <td> Déja refusé </td>
                        @endif

                        <td class=" py-2 px-20 border-b">{{ $reservation->reference }}</td>
                    </tr>
                @empty
                 <p class="text-3xl font-bold mb-6"> Cet evenement n'as pas encore de reservation </p> 
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
