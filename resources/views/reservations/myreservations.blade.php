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
        <h1 class="text-3xl font-bold mb-6">Reservations</h1>
    <table class="min-w-full border border-gray-300 bg-white shadow-md">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nom de l'evenement</th>
                <th class="py-2 px-4 border-b">Nom de l'oragnisateur</th>
                <th class="py-2 px-4 border-b">Date de reservation</th>
                <th class="py-2 px-4 border-b">Date de l'evenement</th>
                <th class="py-2 px-4 border-b">Reference de la reservation</th>
                <th class="py-2 px-4 border-b">Nombres de places reservé</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr  class="hover:bg-gray-100">
                    <td class="py-2 px-20 border-b">{{ $reservation->evenement->libelle }}</td>
                    <td class="py-2 px-20 border-b">{{ $reservation->evenement->association->Nom }}</td>
                    <td class="py-2 px-20 border-b">{{ date( 'j F Y H:i:s' ,strtotime($reservation->created_at ))}}</td>
                    <td class="py-2 px-20 border-b">{{date( 'j F Y H:i:s' ,strtotime( $reservation->evenement->date_evenement)) }}</td>
                    <td class="py-2 px-20 border-b">{{ $reservation->reference }}</td>
                    <td class="py-2 px-20 border-b">{{ $reservation->nombre_de_place }}</td>
                </tr>
            @empty
            <p class="text-3xl font-bold mb-6">   Vous n'avez pas encore de reservations sur notre site </p>
            @endforelse
        </tbody>
    </table>
    </div>
</body>

</html>
