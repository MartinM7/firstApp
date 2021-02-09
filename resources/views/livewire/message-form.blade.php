<div>
    <form action="#" wire:submit.prevent="storeMessage">
        <div class="mb-3">
            <label for="body" class="hidden">Message body</label>
            <textarea name="body" id="body" cols="30" rows="2" class="w-full border-2 border-gray-200 rounded-lg @error('body') border-pink-500 @enderror " placeholder="Write something..." wire:model.defer="body"></textarea>

            @error('body')
               <span class="font-semibold text-pink-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="h-10 px-4 text-center text-white bg-indigo-500 font-medium rounded-lg font-semibold">Send</button>
    </form>
</div>
