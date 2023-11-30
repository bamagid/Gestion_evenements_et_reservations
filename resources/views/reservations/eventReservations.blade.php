<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mes reservations</title>
</head>

<body>
    <table class="table-auto">
        <thead>
            <tr>
                <th>Nom du client</th>
                <th>Email du client</th>
                <th>Date de reservation</th>
                <th>Nombre de places reservé</th>
                <th>Actions</th>
                <th>Reference de la reservation</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->client->Prenom }} {{ $reservation->client->Nom }}</td>
                    <td>{{ $reservation->client->email }}</td>
                    <td>{{ $reservation->created_at }}</td>
                    <td>{{ $reservation->nombre_de_place }}</td>
                    @if ($reservation->est_accepte_ou_pas ===1)
                    <form action="/reservation/decline/{{ $reservation->id }}" method="post">
                    @csrf
                    @method('put')
                    <td>  <button type="submit" class="bg-red-500 hover:bg-blue-700 text-white
                    font-bold py-2 px-4 rounded">Decline</button> </td>
                    </form>
                       
                    @else
                        <td> Déja refusé </td>
                    @endif

                    <td>{{ $reservation->reference }}</td>
                </tr>
            @empty
                Vous n'avez pas encore de reservations sur notre site
            @endforelse
        </tbody>
    </table>
</body>

</html>
