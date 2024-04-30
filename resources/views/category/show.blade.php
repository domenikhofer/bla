{{--
    Todo:
    - Save to DB
    - Unique entries?
    - entry preview?
    - styling
--}}

@include('components.head')
<div class="entriesWrapper">
    <div class="header">
        <a href="{{ route('category.index') }}">⬅️</a>
        <h2>{{ $category->emoji }}{{ $category->name }}</h2>
    </div>

    <div class="entryWrapper">

        @foreach ($category->entries as $entry)
            <div class="entry">
                <div class="title" contenteditable="true" spellcheck="false">
                    {{ $entry->value }}
                </div>
                <a class="link" target="_blank">🔍</a>
            </div>
        @endforeach
        <div class="entry template">
            <div class="title" contenteditable="true" spellcheck="false"></div>
            <a class="link" target="_blank">🔍</a>
        </div>
    </div>
</div>

@include('components.foot')
