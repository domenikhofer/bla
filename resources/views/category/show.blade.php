@include('components.head')
<div class="entriesWrapper" data-category="{{ $category->id }}">
    <div class="emoji">{{ $category->emoji }}</div>
    <div class="header">
        <h1>{{ $category->name }}</h1>
    </div>

    <div class="entryWrapper">

        @forelse ($category->entries as $entry)
            <div class="entry">
                <div class="title" contenteditable="true" spellcheck="false">
                    {{ $entry->value }}
                </div>
                <div class="actions">
                    {{-- <a class="location">📍</a> --}}
                    <a class="link" target="_blank">🔍</a>
                </div>
                <div class="similar">
                    <div class="label">Existing Entries</div>
                    <div class="results"></div>
                </div>
            </div>
        @empty
            <div class="entry">
                <div class="title" contenteditable="true" spellcheck="false">First Entry</div>
                <div class="actions">
                    <a class="link" target="_blank">🔍</a>
                </div>
                <div class="similar">
                    <div class="label">Existing Entries</div>
                    <div class="results"></div>
                </div>
            </div>
        @endforelse
        <div class="entry template">
            <div class="title" contenteditable="true" spellcheck="false"></div>
            <div class="actions">
                <a class="link" target="_blank">🔍</a>
            </div>
            <div class="similar">
                <div class="label">Existing Entries</div>
                <div class="results"></div>
            </div>
        </div>
    </div>
</div>
<div class="pageActions fixed">
    <a class="button" href="{{ route('category.index') }}">⬅️</a>
    <div class="button saveEntries" data-category="{{ $category->id }}">💾</div>
</div>


@include('components.foot')
