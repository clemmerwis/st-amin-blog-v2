<x-app-layout>
    <!-- Extract SEO Data -->
    @php
        $seoMeta = $post->detail->seo_meta ?? [];
    @endphp

    <!-- SEO Meta Tags -->
    @push('seoMeta')
        <!-- SEO Meta Tags -->
        <x-meta-tags 
            title="{{ $seoMeta['title'] ?? 'Default Title' }}" 
            description="{{ $seoMeta['description'] ?? 'Default Description' }}" 
            author="{{ $seoMeta['author'] ?? 'Default Author' }}"
            keywords="{{ $seoMeta['keywords'] ?? 'default,keywords' }}"

            ogTitle="{{ $seoMeta['ogTitle'] ?? 'Default OG Title' }}"
            ogDescription="{{ $seoMeta['ogDescription'] ?? 'Default OG Description' }}" 
            ogUrl="{{ $seoMeta['ogUrl'] ?? 'https://defaultogurl.com' }}"

            twitterTitle="{{ $seoMeta['twitterTitle'] ?? 'Default Twitter Title' }}" 
            twitterDescription="{{ $seoMeta['twitterDescription'] ?? 'Default Twitter Description' }}"
        />
    @endpush
    

    <!-- Details Hero Section Begin -->
    <section class="details-hero-section set-bg" data-setbg="{{ $post->featured_gif_url }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="details-hero-text">
                        @php
                            // get the parent category
                            $parentCat = $post->categories->first(function ($category) {
                                return $category->parent_id === null;
                            });
                        @endphp
                        <div class="label"><span>{{ $parentCat->name }}</span></div>
                        @foreach($post->categories as $category)
                            @if($parentCat && $category->id === $parentCat->id)
                                @continue
                            @endif
                            <div class="label"><span>{{ $category->name }}</span></div>
                        @endforeach
                        <h3>{{ $post->title }}</h3>
                        <ul>
                            <li>Published <br> <i class="ml-5 fa fa-clock-o"></i> {{ $post->published_at->format('F jS, Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Details Hero Section End -->

    <!-- Details Post Section Begin -->
    <section class="details-post-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 p-0">
                    <div class="details-text">
                        <div class="dt-desc">
                            <p>{{ $post->excerpt }}</p>
                        </div>
                        <div class="dt-item">
                            {{-- right now h5 are set by css to be the default stylistic headings for this page --}}
                            {{-- <h5>You Can Buy For Less Than A College Degree</h5> --}}
                            {!! $post->body !!}
                        </div>
                        <div class="dt-share mt-3">
                            <div class="ds-title">Share</div>
                            <div class="ds-links">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($seoMeta['ogUrl']) }}" target="_blank" aria-label="Share on Facebook" rel="noopener noreferrer">
                                    <i class="fa fa-facebook"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                                <a href="https://www.instagram.com/schmoll_thoughts" target="_blank" aria-label="Visit our Instagram" rel="noopener noreferrer">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                    <span class="sr-only">Instagram</span>
                                </a>
                                <a href="mailto:erica@storiesofmirrors.com"><i class="fa fa-envelope-o"></i></a>
                            </div>
                        </div>
                        
                        <div class="dt-related-post">
                            <div class="row">
                                @if($prevNext['prev']['url'])
                                    <div class="col-lg-6">
                                        <a href="{{ $prevNext['prev']['url'] }}" class="rp-prev">
                                            <span>Prev</span>
                                            <div class="rp-pic">
                                                <img src="../img/details/prev.jpg" alt="">
                                            </div>
                                            <div class="rp-text">
                                                <h6>{{ $prevNext['prev']['title'] }}</h6>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                @if($prevNext['next']['url'])
                                    <div class="col-lg-6">
                                        <a href="{{ $prevNext['next']['url'] }}" class="rp-next">
                                            <span>Next</span>
                                            <div class="rp-pic">
                                                <img src="../img/details/next.jpg" alt="">
                                            </div>
                                            <div class="rp-text">
                                                <h6>{{ $prevNext['next']['title'] }}</h6>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Details Post Section End -->
</x-app-layout>
