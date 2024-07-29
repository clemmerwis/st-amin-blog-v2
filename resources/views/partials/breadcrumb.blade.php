<div class="breadcrumb-text">
    @if ($active == 'SoM')
        <h3>Stories of Mirrors: All Chapters</h3>
        <div class="bt-option">
            <a href="{{ route('home') }}">Home</a>
            <span>Stories of Mirrors: Chapter Selection</span>
        </div>
    @else
        @if(isset($category) && $category)
            <h3>{{ $categoryName }}</h3>
        @else
            <h3>All Articles</h3>
        @endif
    @endif
</div>