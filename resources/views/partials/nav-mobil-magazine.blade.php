<li><a href="#">The Magazine <i class="fa fa-angle-down"></i></a>
    <span><img src="{{ asset('img/icons/icon2-earth.png') }}" alt=""></span>
    <ul class="dropdown">
        <li><a href="{{ route('posts.index') }}">All Latest Articles</a></li>
        @foreach ($subcats as $subcat)
            <li><a href="{{ route('posts.index', ['category' => $subcat->slug]) }}">{{ $subcat->name }}</a></li>
        @endforeach
    </ul>
</li>