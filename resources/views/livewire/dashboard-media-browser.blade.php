<div>
    <div class="flex justify-center">
        <button class="bg-yellow-300 px-6 mb-4 h-12 rounded-lg" wire:click="updateDatabase()">
            Datenbank aktualisieren
        </button>
        <button class="bg-yellow-300 px-6 mb-4 h-12 rounded-lg" wire:click="test()">
            test
        </button>
    </div>

    @if($updateDatabase)
        <p>LADE</p>
    @endif

    <div>
        <div class="flex flex-wrap items-center justify-between mb-4">
            <div class="flex-grow">
                <input type="search" placeholder="Suche nach Dateien" class="w-full px-3 border-2 h-12 rounded-lg">
            </div>
        </div>
    </div>

    <div class="border-2 border-gray-200 rounded-lg">

        <div class="overflow-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left py-2 px-3">Name</th>
                    <th class="text-left py-2 px-3 w-2/12">Grösse</th>
                    <th class="text-left py-2 px-3 w-2/12">Datum</th>
                    <th class="py-2 w-2/12"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($medias as $media)
                    <tr class="border-gray-100 border-b-2 hover:bg-gray-100">
                        <td class="py-2 px-3 flex items-center">
                            <a href="" class="p-2 font-bold text-blue-700 flex-grow">
                                {{ $media->filename }}
                            </a>
                        </td>
                        <td class="py-2 px-3">
                            {{ $media->size }}
                        </td>
                        <td class="py-2 px-3">
                            <div class="w-max-content">
                                {{ $media->time }}
                            </div>
                        </td>
                        <td class="py-2 px-3">
                            <div class="flex justify-end items-center">
                                <ul class="flex items-center">
                                    <li class="mr-4">
                                        <button class="text-blue-400 font-bold">
                                            Info
                                        </button>
                                    </li>
                                    <li class="mr-4">
                                        <button class="text-green-600 font-bold">
                                            Download
                                        </button>
                                    </li>
                                    <li>
                                        <button class="text-red-600 font-bold" wire:click="delete({{ $media->id }})">
                                            Löschen
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
