@include('components.head')

<form action="{{ route('entry.storeMedia') }}" method="post">
    <h2>Add Entry</h2>
    @csrf
    <label>
        <div class="label">
            Name
        </div>
        <input type="search" class="searchMovieTV" placeholder="">
    </label>
    <input type="hidden" id="image" name="image">
    <input type="hidden" id="url" name="url">
    <input type="hidden" id="value" name="value">
    <input type="hidden" id="category_id" name="category_id" value="5">
            {{-- todo: add dynamic category value --}}
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror
    @error('url')
    <div class="error">{{ $message }}</div>
@enderror
@error('image')
<div class="error">{{ $message }}</div>
@enderror
@error('category_id')
<div class="error">{{ $message }}</div>
@enderror
    <div class="imageEntryWrapper"></div>
    <div class="formActions">
        <button type="submit">✔️</button>
        <a class="button" href="{{ route('category.reorder') }}">✖️</a>
        {{-- todo: add correct back location --}}

    </div>
</form>
@include('components.foot')
