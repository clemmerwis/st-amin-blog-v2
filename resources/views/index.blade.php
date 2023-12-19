<x-app-layout>
    {{-- @include('partials.hero-section') --}}
    <!-- Hero Section Begin -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="hero">
                <div class="box grid">
            
                    <div class="box__center">
                        <img src="img/hero/owlx400.png" alt="golden owl">
                    </div>
            
                </div>
                <div class="st">
                    <div>
                        <h1 class="hero-heading">Stories</h1>
                    </div>
                    <div>
                        <span class="hero-heading">of</span>
                    </div>
                    <div>
                        <h1 class="hero-heading">Mirrors</h1>
                    </div>
                </div>
                @if($posts->isNotEmpty())
                    @php
                        $firstPostSlug = $posts->first()->slug; // Get the slug of the first post
                    @endphp

                    <div class="butts">
                        <div>
                            <!-- Use the slug in the route -->
                            <a class="secondary-btn"
                            href="{{ route('posts.show', ['category' => 'stories-of-mirrors', 'slug' => $firstPostSlug]) }}">
                            Read the Book</a>
                        </div>
                    </div>
                @else
                    <p>No posts available.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div style="background-size: cover; background-position: center 78%;" class="hs-item set-bg" data-setbg="img/hero/red.gif"></div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Latest Preview Section Begin -->
<section class="latest-preview-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h5>Stories of Mirrors</h5>
                    <p class="mt-2"><i class="fa fa-pencil"></i> Author: Erica Schmoll</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="lp-slider owl-carousel">
                @foreach($posts as $post)
                    <div class="col-lg-3">
                        @php
                            // get the subcat-- which will be the one that has a parent_id
                            $subcat = $post->categories->first(function ($category) {
                                return $category->parent_id !== null;
                            });
                            // get the parent category
                            $parentCat = $post->categories->first(function ($category) {
                                return $category->parent_id === null;
                            });
                        @endphp
                        <a href="{{ route('posts.show', ['category' => $parentCat->slug, 'slug' => $post->slug]) }}">
                            <div class="lp-item">
                                <div class="lp-pic set-bg" data-setbg="{{ asset($post->featured_image_thumb_url) }}"></div>
                                
                                <div class="lp-text">
                                    <h6>
                                        <!-- using category as title -->
                                        <span class="text-white">{{ $subcat?->name }}</span>
                                        <p>{{ $post->title }}</p>
                                    </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>
</section>
<!-- Latest Preview Section End -->
</x-app-layout>
