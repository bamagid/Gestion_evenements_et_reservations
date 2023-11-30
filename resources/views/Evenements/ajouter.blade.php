<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Ajouter un evenement</title>
</head>

<body class="w-full">
    <div class="w-full sm:max-w mt-6 px-4 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        style="margin: auto;">
        {{-- <div class="flex items-center justify-center p-12"> --}}
            <div class="mx-auto w-full max-w-[550px] bg-white">
            <div class="capitalize font-bold mb-5" style="margin: 5px 30%; display:flex ;flex-wrap:nowrap;">
                {{ $ok === 'ok' ? 'Modifier l\'evenement  ' . $evenement->libelle : 'Ajouter un evenement' }}</div>
            <form method="post"
                action="{{ $ok && $ok === 'ok' ? '/evenement/modifier/' . $evenement->id : '/evenement/ajouter' }}"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="libelle" class="mb-3 block text-base font-medium text-[#07074D]">
                        Libellé
                    </label>
                    <input type="text" name="libelle" id="name" placeholder="Libellé de l'evenement"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        value="{{ $ok && $ok === 'ok' ? $evenement->libelle : '' }}" />
                </div>
                <div class="mb-5">
                    <label for="date_limite_inscription" class="mb-3 block text-base font-medium text-[#07074D]">
                        Date limite pour reserver
                    </label>
                    <input type="datetime-local" name="date_limite_inscription" id="phone"
                        placeholder="Enter your phone number"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        value="{{ $ok && $ok === 'ok' ? $evenement->date_limite_inscription : '' }}" />
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                        La description de l'evenement :
                    </label>
                    <input type="text" name="description" id="email" placeholder="Decrivez votre evenement"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        value="{{ $ok && $ok === 'ok' ? $evenement->description : '' }}" />
                </div>
                <div class="mb-5">
                    <label for="image_mise_en_avant" class="mb-3 block text-base font-medium text-[#07074D]">
                        L'image que vous souhaiter mettre en avant pour cet evenement
                    </label>
                    <input type="file" name="image_mise_en_avant" id="date"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
                <div class="mb-5">
                    <label for="lieux" class="mb-3 block text-base font-medium text-[#07074D]">
                        Le lieux où aura lieu l'evenement
                    </label>
                    <input type="text" name="lieux" id="time"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        value="{{ $ok && $ok === 'ok' ? $evenement->lieux : '' }}" />
                </div>
                <div class="mb-5">
                    <label for="date_evenement" class="mb-5 block text-base font-semibold text-[#07074D] sm:text-xl">
                        Date de l'evenement
                    </label>
                    <input type="datetime-local" name="date_evenement" id="phone"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        value="{{ $ok && $ok === 'ok' ? $evenement->date_evenement : '' }}" />
                </div>
                <div>
                    <button type="submit"
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        {{ $ok === 'ok' ? 'Modifier l\evenement ' : 'Ajouter un evenement' }}
                    </button>
                </div>
            </form>
        </div>
        {{-- </div> --}}
    </div>
</body>

</html>
