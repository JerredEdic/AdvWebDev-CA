<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <x-anime-details
                            :title="$anime->title"
                            :numberOfEp="$anime->numberOfEp"
                            :image="$anime->image"
                            :description="$anime->description"
                            />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
