<div class="breadcrumb-text">
    @if ($active == 'SoM')
        <h3>Stories of Mirrors: All Chapters</h3>
        <div class="bt-option">
            <a href="{{ route('home') }}">Home</a>
            <span>Stories of Mirrors: Chapter Selection</span>
        </div>
    @else
        <h3>Magazine: All Articles</h3>
        <div class="bt-option">
            <a href="{{ route('home') }}">Home</a>
            <span>Magazine</span>
        </div>
    @endif
</div>
