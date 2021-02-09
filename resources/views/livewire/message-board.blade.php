<div class="overflow-auto h-72">
    @foreach($messages as $message)
        <div class="flex items-center justify-between border-b border-gray-200 p-3">
            <div>
                <h2 class="font-bold text-blue-700 mb-0.5">{{ $message->user->name }}:<span class="text-sm text-gray-400 font-thin px-3.5"> {{ $message->created_at->diffForHumans() }}</span></h2>
                <p class="mb-1.5">{{ $message->body }}</p>
            </div>
        </div>
    @endforeach

</div>




