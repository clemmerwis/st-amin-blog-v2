<x-app-layout :active="$active" :posts="$posts">
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg spad {{ $active != 'SoM' ? 'magazine-breadcrumb-section' : '' }}" data-setbg="{{ $active == 'SoM' ? 'img/bg/gradient-about.png' : 'img/stories-of-mirrors/ImageGirlRedDress_HouseBackground.jpg' }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    @include('partials.breadcrumb', [
                        'active' => $active,
                        'category' => $category ?? null,
                        'categoryName' => $categoryName ?? null
                    ])
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Categories Grid Section Begin -->
    <section class="categories-grid-section spad {{ $posts->first() && $posts->first()->categories->first()->slug == 'stories-of-mirrors' ? 'SoM-blog' : '' }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row staggered-grid">
                        @if ($posts->count())
                            @foreach ($posts as $post)
                                <div class="col-lg-6">
                                    <div class="cg-item">
                                        <a href="{{ route('posts.show', ['category' => $post->parentcat->slug, 'slug' => $post->slug]) }}">
                                            <div class="cg-pic set-bg" data-setbg="{{ $post->featured_image_url }}">
                                                <div class="label label1"><span>{{ $post->parentcat->name }}</span></div>
                                                @foreach($post->categories as $category)
                                                    @if($post->parentcat && $category->id === $post->parentcat->id)
                                                        @continue
                                                    @endif
                                                    {{-- loop->iteration plus 1 to account for manually added parent category --}}
                                                    <div class="label label{{ $loop->iteration+1 }}"><span>{{ $category->name }}</span></div>
                                                @endforeach
                                            </div>
                                        </a>
                                        <div class="cg-text">
                                            <h5>
                                                <a  href="{{ route('posts.show', [
                                                        'category' => $post->parentcat->slug, 
                                                        'slug' => $post->slug
                                                    ]) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h5>                                            
                                            <p>{{ $post->excerpt }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>There are no posts</p>
                        @endif
                    </div>
                    {{-- Pagination --}}
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Grid Section End -->
</x-app-layout>
