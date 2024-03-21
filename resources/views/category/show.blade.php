@if ($category->children)
@foreach ($category->children as $child)
<a href="{{ route('category.show', ['category' => $child->id]) }}">{{ $child->name }}</a>
@endforeach
@else
    @foreach ($category->entries as $entry)
        {{ $entry->columns }}
    @endforeach

@endif
