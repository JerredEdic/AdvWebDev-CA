<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-alert-success>
        {{session('success')}}
    </x-alert-success>

    <x-alert-error>
        {{session('error')}}
    </x-alert-error>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Anime List</h3>
                    <div class="grid grid-cols1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($animes as $anime)
                        <div class="border rounded-lg shadow-md pg-6 bg-white hover-shadow-lg transition duration-300">
                            <a href="{{route('animes.show',$anime)}}">
                                <x-anime-card
                                :title="$anime->title"
                                :numberOfEp="$anime->numberOfEp"
                                :image="$anime->image"
                                :description="$anime->description"
                                />
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <div class="mt-4 flex space-x-2">
                            <a href="{{ route('animes.edit', $anime) }}" class="text-gray-600 bg-orange-300 hover:bg-orange-700 font-bold py-2 px-4 rounded">Edit</a>

                            <form action="{{ route('animes.destroy', $anime) }}" method="POST" onsubmit="return confirm('are you sure you want to delete this anime?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-600 font-bold py-2 px-4 rounded">Delete</button>
                            </form>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>