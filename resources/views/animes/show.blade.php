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
                    <div class="grid grid-cols1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <x-anime-details
                            :title="$anime->title"
                            :numberOfEp="$anime->numberOfEp"
                            :image="$anime->image"
                            :description="$anime->description"
                            />
                            <div>
                            <h4 class='font-semibold text-md mt-8'>Reviews</h4>
                            @if($anime->reviews->isEmpty())
                            <p class="text-gray-600">No Reviews Yet.</p>
                            @else
                            <ul class='mt-4 space-y-4'>
                                @foreach($anime->reviews as $review)
                                    <li class="bg-gray-100 p-4 rounded-lg">
                                        <p class="font-semibold">{{$review->user->name}} ({{$review->created_at->format('M d, Y')}})</p>
                                        <ul class="flex">
                                            @for($k=0;$k<$review->rating;$k++)
                                            <li>
                                            <svg width="25px" height="25px" fill="#fef739" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 0 0 .6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0 0 46.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path> </g></svg>
                                            </li>
                                            @endfor
                                        </ul>
                                        <p>{{$review->comment}}</p>
                                        @if(auth()->user()->role === 'admin' || auth()->user()->id===$review->user_id)
                                        <div class="mt-4 flex space-x-2">
                                        <a href="{{ route('reviews.edit', $review) }}" class="text-gray-600 bg-orange-300 hover:bg-orange-700 font-bold py-2 px-4 rounded">Edit</a>

                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('are you sure you want to delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-600 font-bold py-2 px-4 rounded">Delete</button>
                                        </form>
                                        </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                            </div>
                            <div>
                            <h4 class="font-semibold text-md mt-8">Post a Review</h4>
                            <form action="{{ route('reviews.store',$anime) }}" method="POST" class="mt-4">
                                @csrf
                                    <div class="mb-4">
                                        <label for="rating" class="block font-medium text-sm text-gray-700">Rating</label>
                                        <select name="rating" id="rating" class="mt-1 block w-full" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="comment" class="block font-medium text-sm text-gray-700"></label>
                                        <textarea name="comment" id="comment" class="mt-1 block w-full" placeholder='Write your review here . . .'></textarea>
                                    </div>

                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Post Review</button>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
