<div class="breadcrumb-text">
    @if ($active == 'SoM')
        <h3>Stories of Mirrors: All Chapters</h3>
    @elseif(isset($categoryName) && $categoryName)
        <h3>{{ $categoryName }}</h3>
    @else
        <h3>All Articles</h3>
    @endif
</div>