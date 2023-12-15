<x-app-layout>
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
                                <a href="#" class="wide"><i class="fa fa-heart-o"></i><span>120</span></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                        <div class="dt-related-post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="#" class="rp-prev">
                                        <span>Prev</span>
                                        <div class="rp-pic">
                                            <img src="../img/details/prev.jpg" alt="">
                                        </div>
                                        <div class="rp-text">
                                            <h6>The Real-Estate Developers Are the Enemy</h6>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="#" class="rp-next">
                                        <span>Next</span>
                                        <div class="rp-pic">
                                            <img src="../img/details/next.jpg" alt="">
                                        </div>
                                        <div class="rp-text">
                                            <h6>Montreal real estate: Bargains in cottage countrya</h6>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7">
                    <div class="sidebar-option">
                        <div class="social-media">
                            <div class="section-title">
                                <h5>Social media</h5>
                            </div>
                            <ul>
                                <li>
                                    <div class="sm-icon"><i class="fa fa-facebook"></i></div>
                                    <span>Facebook</span>
                                    <div class="follow">1,2k Follow</div>
                                </li>
                                <li>
                                    <div class="sm-icon"><i class="fa fa-twitter"></i></div>
                                    <span>Twitter</span>
                                    <div class="follow">1,2k Follow</div>
                                </li>
                                <li>
                                    <div class="sm-icon"><i class="fa fa-youtube-play"></i></div>
                                    <span>Youtube</span>
                                    <div class="follow">2,3k Subs</div>
                                </li>
                                <li>
                                    <div class="sm-icon"><i class="fa fa-instagram"></i></div>
                                    <span>Instagram</span>
                                    <div class="follow">2,6k Follow</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Details Post Section End -->
</x-app-layout>
