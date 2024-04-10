<div class="category">
    <div class="categoryWrapper">
        <div class="left">
            @if (count($category->children) > 0)
                <div class="toggle">{{ $category->name }}
                </div>
            @else
                <a href="{{ route('category.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
            @endif
        </div>
        <div class="right">
            <a class="button" href="{{ route('category.edit', ['category' => $category->id]) }}">Edit</a>
            <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    </div>

    @if (count($category->children) > 0)

        @php
            $counter++;
        @endphp
        @foreach ($category->children as $child)
            @include('components.category', ['category' => $child, 'counter' => $counter])
        @endforeach
    @endif
</div>
