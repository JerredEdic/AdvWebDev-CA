@props(['title','numberOfEp','description','image'])

<div class="border rounded-lg shadow-md pg-6 bg-white hover-shadow-lg transition duration-300">
    <h4 class="font-bold text-lg">{{$title}}</h4>
    <img src="{{url($image)}}" alt="{{$title}}">
    <p class="text-grey-600">{{$numberOfEp}} Episodes</p>
    <p class="text-grey-600 mt-4">{{$description}}</p>
</div>