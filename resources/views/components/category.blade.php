<div id="cat{{ $category->id }}" class="category @if (count($category->children) > 0) categoriesTitle @endif">
    <div class="content">
        @if (count($category->children) > 0)
            {{ $category->name }}
        @else
            <a class="link" href="{{ route('category.show', ['category' => $category->id]) }}">
                <span class="emoji"><span class="icon">{{ $category->emoji }}</span></span>
                <span class="title"><span class="titleContent">{{ $category->name }}</span></span>
            </a>
        @endif
    </div>
    <div class="actions">
        <a class="button" href="{{ route('category.edit', ['category' => $category->id]) }}">✏️</a>
        <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">🗑️</button>
        </form>
    </div>


</div>

@if (count($category->children) > 0)

    @php
        $counter++;
    @endphp
    @if ($category->id == 9)
        <div class="subcategoriesWrapper">
            <div class="plantSide">
                <img src="images/plantSide.png" alt="">
            </div>
    @endif
    <div class="subcategories">
        @foreach ($category->children as $child)
            @include('components.category', ['category' => $child, 'counter' => $counter])
        @endforeach
    </div>
    @if ($category->id == 9)
        </div>
    @endif
@endif
