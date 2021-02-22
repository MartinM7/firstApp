<div>
    <div class="flex justify-center mb-4">
        <p>Blocked Users can't see your messages and you can't see their messages!</p>
    </div>
    <div class="flex justify-center">
        <div class="border-2 border-gray-200 rounded-lg w-max-content md:w-6/12">
            <div class="overflow-auto">
                <table class="w-full">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left py-2 px-3">Name</th>
                        <th class="text-left py-2 w-2/12">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        @if($user->id == auth()->id())
                            @continue
                        @endif
                        <tr class="border-gray-100 border-b-2 hover:bg-gray-100">
                            <td class="py-2 px-3 flex items-center">
                                <a href="#" class="p-2 whitespace-no-wrap font-bold text-blue-700 flex-grow">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td class="py-2 px-3">
                                <div class="flex justify-start items-center">
                                    <ul class="flex items-center">
                                        <li>
                                            <button class="{{ auth()->user()->isBlocked($user) ? 'text-green-600 ' : 'text-red-600' }} font-bold whitespace-no-wrap" wire:click="toggle({{ $user->id }})">
                                                {{ auth()->user()->isBlocked($user) ? 'Unblock User' : 'Block User' }}
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
</div>
