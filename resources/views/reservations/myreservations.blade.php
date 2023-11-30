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
                <th>Nom de l'evenement</th>
                <th>Nom de l'oragnisateur</th>
                <th>Date de reservation</th>
                <th>Date de l'evenement</th>
                <th>Reference de la reservation</th>
                <th>Nombres de places reservé</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->evenement->libelle }}</td>
                    <td>{{ $reservation->evenement->association->Nom }}</td>
                    <td>{{ $reservation->created_at }}</td>
                    <td>{{ $reservation->evenement->date_evenement }}</td>
                    <td>{{ $reservation->reference }}</td>
                    <td>{{ $reservation->nombre_de_place }}</td>
                </tr>
            @empty
                Vous n'avez pas encore de reservations sur notre site
            @endforelse
        </tbody>
    </table>
</body>

</html>
