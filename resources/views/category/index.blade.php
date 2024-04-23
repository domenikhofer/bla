@include('components.head')
<div class="categoriesWrapper index">

    @foreach ($categories as $category)
        @php
            $counter = 0;
        @endphp
        @include('components.category', ['category' => $category, 'counter' => $counter])
    @endforeach
</div>
<div class="plantTop">
    <img src="images/plantTop.png" alt="">
</div>
<div class="plantBottomWrapper">
    <div class="plantBottom">
        <img src="images/plantBottom.png" alt="">
    </div>
</div>

<div class="pageActions">
    <a class="button" href="{{ route('category.reorder') }}">✏️</a>
</div>
@include('components.foot')
