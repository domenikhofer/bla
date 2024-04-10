@include('components.head')

<div class="categories">
    @foreach ($categories as $category)
        @php
            $counter = 0;
        @endphp
        @include('components.category', ['category' => $category, 'counter' => $counter])
    @endforeach
</div>
<a class="button" href="{{ route('category.create') }}">+ Add new</a>
<a class="button" href="{{ route('category.reorder') }}">Reorder</a>

@include('components.foot')
