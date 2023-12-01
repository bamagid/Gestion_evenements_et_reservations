<x-app-layout>
    <div class="w-full my-10 flex flex-wrap justify-around">
        @forelse ($evenements as $evenement)   
        <div class="w-2/5 mx-auto my-10 rounded overflow-hidden shadow-lg">
            <img class="w-full" src="{{asset('evenements/'.$evenement->image_mise_en_avant)}}" alt="Image mise en avant pour l'evenement">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{$evenement->libelle}}</div>
                <p class="font-bold text-xl mb-2">
                    {!! nl2br(e($evenement->description)) !!}
                </p>
                <div class="font-bold text-xl mb-2">Date limite pour s'inscrire: {{$evenement->date_limite_inscription}}</div>
                <div class="font-bold text-xl mb-2">Organisateur de l'evenement: {{$evenement->association->Nom}}</div>
                <div class="font-bold text-xl mb-2">L'evenement aura lieux le: {{$evenement->date_evenement}}</div>
                <div class="font-bold text-xl mb-2">Lieux de l'evenenement: {{$evenement->lieux}}</div>
            </div>
            <div class="d-flex justify-center flex-row px-6 py-4">
                <a href="/evenement/update/{{$evenement->id}}" class="capitalize font-bold mb-5">Modifier</a>
                <a href="/evenement/supprimer/{{$evenement->id}}" class="capitalize font-bold mb-5">Supprimer</a>
                <form action="/evenement/reservations" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$evenement->id}}">
                <button type="submit" class="capitalize font-bold mb-5">Voir les reservations</button>
                </form>
                @if ($evenement->est_cloture_ou_pas===0)
                <a href="/evenement/cloturer/{{$evenement->id}}" class="capitalize font-bold mb-5">Cloturer</a>
                @endif
            </div>
        </div>
        @empty
        Desolé il n'y a pas d'evenement disponible actuellement 
        @endforelse
    </div>

</x-app-layout>