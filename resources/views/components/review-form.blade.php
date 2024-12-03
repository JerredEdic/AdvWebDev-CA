@props(['action', 'method','review'])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif


    <div class="mb-4">
    <label for="rating" class="block font-medium text-sm text-gray-700">Rating</label>
    <select name="rating" value="{{ old('rating', $review->rating ?? '') }}" id="rating" class="mt-1 block w-full" required>
        @for($k=1;$k< 6;$k++)  
            <option value="$k" {{ ($k === $review->rating) ? 'selected' : '' }}>{{$k}}</option>
        @endfor
    </select>
</div>


<div class="mb-4">
    <label for="comment" class="block text-sm text-gray-700">comment</label>
<input
type="text"
name="comment" id="comment"
value="{{ old('comment', $review->comment ?? '') }}"
required
class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" /> 
@error('comment')
<p class="text-sm text-red-600">{{ $message }}</p>
@enderror
</div>




<div>
<x-primary-button>
{{ isset($anime) ? 'Update Anime' : 'Add Anime' }} </x-primary-button>
</div> </form>