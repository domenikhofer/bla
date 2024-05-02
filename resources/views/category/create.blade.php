@include('components.head')

<form action="{{ route('category.store') }}" method="post">
    <h2>Add Category</h2>
    @csrf
    <label>
        <div class="label">
            Emoji
        </div>
        <input type="text" name="emoji" maxlength="2" placeholder="">
    </label>
    <label>
        <div class="label">
            Name
        </div>
        <input type="text" name="name" placeholder="">
    </label>
    <label>
        <div class="label">
        Parent Category
    </div>
    <select name="parent_id">
        <option value="">No Category</option>
        @foreach ($categories as $c)
            <option value="{{ $c->id }}">{{ $c->name }}
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
        <option value="{{ $c->id }}">{{ $c->name }}
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
