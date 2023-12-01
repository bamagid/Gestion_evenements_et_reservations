<x-app-layout>
    <div class=" w-full my-10 flex flex-wrap justify-around">
        @forelse ($evenements as $evenement)
            <div class="w-2/5 mx-auto my-10 rounded overflow-hidden shadow-lg">
                <img class="w-full h-3/6" src="{{ asset('evenements/' . $evenement->image_mise_en_avant) }}"
                    alt="Image mise en avant pour l'evenement">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $evenement->libelle }}</div>
                    <div class="px-2 py-4 max-h-100 overflow-y-scroll font-bold text-xl mb-2">
                            {!! nl2br(e($evenement->description)) !!}
                    </div>
                    <div class="font-bold text-xl mb-2">Date limite pour s'inscrire:
                        {{ date( 'j F Y H:i:s' ,strtotime($evenement->date_limite_inscription ))}}</div>
                    <div class="font-bold text-xl mb-2">Organisateur de l'evenement : {{ $evenement->association->Nom }}
                    </div>
                    <div class="font-bold text-xl mb-2">L'evenement aura lieux le : {{ date( 'j F Y H:i:s' ,strtotime($evenement->date_evenement)) }}
                    </div>
                    <div class="font-bold text-xl ">Lieux de l'evenenement: {{ $evenement->lieux }}</div>
                </div>
                <div class="flex justify-around flex-row flex-nowrap px-6 py-4 mb-5">
                    <a href="/evenement/update/{{ $evenement->id }}" class="bg-blue-500  text-white font-bold py-2 px-4 rounded">Modifier</a>
                    <a href="/evenement/supprimer/{{ $evenement->id }}" class="bg-red-500  text-white font-bold py-2 px-4 rounded"">Supprimer</a>
                    <form action="/evenement/reservations" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$evenement->id }}">
                        <button type="submit" class="bg-green-500  text-white font-bold py-2 px-4 rounded">Voir les reservations</button>
                    </form>
                    @if ($evenement->est_cloture_ou_pas === 0)
                        <a href="/evenement/cloturer/{{ $evenement->id }}"
                            class="bg-black  text-white font-bold py-2 px-4 rounded">Cloturer</a>
                    @endif
                </div>
            </div>
        @empty
            Desolé il n'y a pas d'evenement disponible actuellement
        @endforelse
    </div>

</x-app-layout>
