<div>
    <div class="flex justify-center">
        @if(auth()->id() == 1)
            <button class="bg-yellow-300 px-6 mb-4 h-12 rounded-lg" wire:click="updateDatabase()">
                Refresh
            </button>
        @endif
    </div>

    <div>
        <div class="flex flex-wrap items-center justify-between mb-4">
            <div class="flex-grow">
                <input type="search" placeholder="Search..." class="w-full px-3 border-2 h-12 rounded-lg" wire:model="query">
            </div>
        </div>
    </div>

    <div class="border-2 border-gray-200 rounded-lg">

        <div class="overflow-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left py-2 px-3">Name</th>
                    <th class="text-left py-2 px-3 w-2/12">Size</th>
                    <th class="text-left py-2 px-3 w-2/12">Date</th>
                    <th class="text-left py-2 w-2/12">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($this->allMedia() as $media)
                    <tr class="border-gray-100 border-b-2 hover:bg-gray-100">
                        <td class="py-2 px-3 flex items-center">
                            <a href="" class="p-2 whitespace-no-wrap font-bold text-blue-700 flex-grow">
                                {{ $media->filename }}
                            </a>
                        </td>
                        <td class="py-2 px-3">
                            {{ $media->sizeForHumans() }}
                        </td>
                        <td class="py-2 px-3">
                            <div class="w-max-content">
                                {{ \Carbon\Carbon::createFromTimestamp($media->time) }}
                            </div>
                        </td>
                        <td class="py-2 px-3">
                            <div class="flex justify-start items-center">
                                <ul class="flex items-center">
{{--                                    <li class="mr-4">--}}
{{--                                        <button class="text-blue-400 font-bold">--}}
{{--                                            Info--}}
{{--                                        </button>--}}
{{--                                    </li>--}}
                                    <li class="mr-4">
                                        <a href="{{ route('file.download', $media->id) }}" class="text-green-600 font-bold">
                                            Download
                                        </a>
                                    </li>
                                    @if(auth()->id() == 1)
                                        <li>
                                            <button class="text-red-600 font-bold" wire:click="delete({{ $media->id }})">
                                                Delete
                                            </button>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $this->allMedia()->links() }}
    </div>

</div>
