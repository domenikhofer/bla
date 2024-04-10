<div class="category is-idle js-item">
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
            <div class="drag-handle js-drag-handle"></div>
        </div>
    </div>

    @if (count($category->children) > 0)

        @php
            $counter++;
        @endphp
        <div class="categories">
        @foreach ($category->children as $child)
            @include('components.category', ['category' => $child, 'counter' => $counter])
        @endforeach
    </div>
    @endif
</div>
