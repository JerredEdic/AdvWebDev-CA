@props(['action', 'method','review'])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

<div class="mb-4">
    <label for="title" class="block text-sm text-gray-700">Title</label>
<input
type="text"
name="title" id="title"
value="{{ old('title', $anime->title ?? '') }}"
required
class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" /> 
@error('title')
<p class="text-sm text-red-600">{{ $message }}</p>
@enderror
</div>



<div class="mb-4">
    <label for="numberOfEp" class="block text-sm text-gray-700">Number Of Episodes</label>
<input
type="text"
name="numberOfEp" id="numberOfEp"
value="{{ old('numberOfEp', $anime->numberOfEp ?? '') }}"
required
class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" /> 
@error('numberOfEp')
<p class="text-sm text-red-600">{{ $message }}</p>
@enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-sm text-gray-700">description</label>
<input
type="text"
name="description" id="description"
value="{{ old('description', $anime->description ?? '') }}"
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