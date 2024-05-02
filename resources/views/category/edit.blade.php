@include('components.head')

<form action="{{ route('category.update', ['category' => $category->id]) }}" method="post">
    <h2>Edit Category</h2>
    @csrf
    @method('PUT')
    <label>
        <div class="label">
            Emoji
        </div>
        <input type="text" name="emoji" maxlength="2" placeholder="" value="{{ $category->emoji }}">
    </label>
    <label>
        <div class="label">
            Name
        </div>
        <input type="text" name="name" placeholder="" value="{{ $category->name }}">
    </label>
    <label>
        <div class="label">
        Parent Category
    </div>
    <select name="parent_id">
        <option value="">No Category</option>
        @foreach ($categories as $c)
            <option value="{{ $c->id }}" @if ($category->parent_id == $c->id) selected @endif>{{ $c->name }}
            </option>
        @endforeach

    </select>
</label>
<label>
    <div class="label">
    Category Type
</div>
<select name="category_type_id">
    <option value="">No Type</option>
    @foreach ($categoryTypes as $c)
        <option value="{{ $c->id }}" @if ($category->category_type_id == $c->id) selected @endif>{{ $c->name }}
        </option>
    @endforeach

</select>
</label>
<div class="formActions">
    <button type="submit">✔️</button>
    <a class="button" href="{{ route('category.reorder') }}">✖️</a>
</div>
</form>
@include('components.foot')
