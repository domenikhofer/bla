@include('components.head')
<div class="categoriesWrapper">
    <div class="categories js-list">
        @foreach ($categories as $category)
            @php
                $counter = 0;
            @endphp
            @include('components.category', ['category' => $category, 'counter' => $counter])
        @endforeach
    </div>
</div>
<a class="button" href="{{ route('category.create') }}">+ Add new</a>
<a class="button" href="{{ route('category.reorder') }}">Reorder</a>

<div class="circle circle1"></div>
<div class="circle circle2"></div>

@include('components.foot')
