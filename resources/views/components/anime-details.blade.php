@props(['title','numberOfEp','description','image'])

<div class="border rounded-lg shadow-md p-6 bg-white hover-shadow-lg transition duration-300 max-w-xl mx-auto">
    <h1 class="font-bold text-black-600 mb-2" style="font-size: 3rem;">{{$title}}</h1>
    <img src="{{url($image)}}" alt="{{$title}}" class="w-full max-w-xs h-auto object-cover">
    <h2 class="text-grey-500 text-sm italic mb-4" style="font-size: 1rem;">Episodes: {{$numberOfEp}}</h2>

    <h3 class="text-gray-800 font-semibold mb-2" style="font-size:2rem;">Description</h3>
    <p class="text-grey-700 leading-relaxed">{{$description}}</p>
</div>