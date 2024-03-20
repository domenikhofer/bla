@if ($category->parent_id)
    <a href="{{ route('category.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
@else
    @foreach ($category->entries as $entry)
        {{ $entry->columns }}
    @endforeach

@endif
