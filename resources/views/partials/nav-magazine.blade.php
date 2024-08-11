<li class="mega-menu spin mainitem"><a class="the-magazine" href="{{ route('posts.index') }}"><span>The Magazine <i class="fa fa-angle-down"></i></span></a>
    <div class="megamenu-wrapper">
        <ul class="mw-nav">
            <li><a href="{{ route('posts.index') }}"><span>All Articles</span></a></li>
            {{-- subcats from view service provider --}}
            @foreach ($subcats as $subcat)
                <li><a href="{{ route('posts.index', ['category' => $subcat->slug]) }}"><span>{{ $subcat->name }}</span></a></li>
            @endforeach
        </ul>
        <div class="mw-post">
            @foreach ($latest as $post)
                <div class="mw-post-item">
                    <div class="mw-pic">
                        <a href="{{ route('posts.show', [
                                'category' => $post->parentcat->slug,
                                'slug' => $post->slug
                            ]) }}">
                            <img src="{{ asset($post->featured_image_thumb_url) }}" alt="{{ $post->title }}">
                        </a>
                    </div>
                    <div class="mw-text">
                        <h6>
                            <a href="{{ route('posts.show', [
                                'category' => $post->parentcat->slug,
                                'slug' => $post->slug
                            ]) }}">
                                {{ $post->title }}
                            </a>
                        </h6>
                        <ul>
                            <li><i class="fa fa-clock-o"></i> {{ $post->published_at->format('M d, Y') }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</li>