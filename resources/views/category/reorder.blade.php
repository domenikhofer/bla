@include('components.head')
<div class="categoriesWrapper reorder">
        @foreach ($categories as $category)
            @php
                $counter = 0;
            @endphp
            @include('components.category', ['category' => $category, 'counter' => $counter])
        @endforeach
</div>
<div class="pageActions">
<a class="button" href="{{ route('category.create') }}">➕</a>
<a class="button" href="{{ route('category.index') }}">✖️</a>
</div>

@include('components.foot')
