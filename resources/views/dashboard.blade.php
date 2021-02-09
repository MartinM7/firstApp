<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="border-b pb-6">
                    <livewire:message-form/>
                </div>
               <livewire:message-board/>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mt-4">
               <livewire:dashboard-media-browser model="App\Models\Media"/>
            </div>
        </div>
    </div>
</x-app-layout>
