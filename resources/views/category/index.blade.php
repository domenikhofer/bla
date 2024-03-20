<ul>
    @foreach ($categories as $category)
        @if ($category->parent_id)
            <ul>
        @endif
        <li>
            <a href="{{ route('category.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
            <a href="{{ route('category.edit', ['category' => $category->id]) }}">Edit</a>
        </li>
        @if ($category->parent_id)
        </ul>
        @endif
    @endforeach
</ul>
<a href="{{ route('category.create') }}">+ Add new</a>
