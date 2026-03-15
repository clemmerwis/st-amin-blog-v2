<x-app-layout>
    @push('seoMeta')
        <x-meta-tags
            title="The Author | Stories of Mirrors"
            description="Meet Erica Denise Schmoll — The Witch of the Wisconsin Northwoods, author of Stories of Mirrors, where true paranormal experiences, wellness, hidden knowledge, and modern mysticism meet."
            author="schmollthoughts.com"
            keywords="erica schmoll, stories of mirrors author, witchcraft, supernatural"

            ogTitle="The Author | Stories of Mirrors"
            ogDescription="Erica Denise Schmoll — The Witch of the Wisconsin Northwoods. True paranormal stories, wellness, hidden knowledge, and modern mysticism."
            ogUrl="{{ url()->current() }}"
            ogImage="{{ asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg') }}"
            ogType="website"

            twitterTitle="The Author | Stories of Mirrors"
            twitterDescription="Erica Denise Schmoll — The Witch of the Wisconsin Northwoods. True paranormal stories, wellness, hidden knowledge, and modern mysticism."
            twitterImage="{{ asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg') }}"
        />
    @endpush

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg spad" data-setbg="img/bg/gradient-about.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>Author</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Profile Header Section Begin -->
    <section class="about-profile-header spad">
        <div class="container">
            <div class="row d-flex justify-center pb-10">
                <div class="col-lg-8">                  
                    <img src="img/author-erica.png" alt="Profile Image" class="profile-image rounded-circle">
                    <h2 class="mt-4 mb-2">About Erica Denise Schmoll</h2>
                    
                    <h3 class="smallh3 mb2rem">
                        The Witch of the Wisconsin Northwoods
                    </h3>
                    <p style="font-style: italic;">
                        Mirror, mirror on the <span class="text-gradient-accent">wall...</span>
                    </p>
                    <p>
                        Here you will find the work of Erica Denise <span class="text-gradient-accent">Schmoll</span>.
                    </p>
                    <p>
                        Writer, technologist, and Reiki practitioner, Erica explores the space where science, spirit, beauty, wellness, and the unseen world quietly meet. Through Stories of Mirrors and The Witch Magazine, she shares true paranormal encounters, reflections on natural health, modern mysticism, and the hidden patterns shaping human experience.
                    </p>
                    <p class="mb3rem" style="font-style: italic;">
                        Some reflections reveal stories. Others reveal who we are meant to become.
                    </p>

                    <a class="btn about-page-btn mb-5" href="{{ route('posts.index', ['category' => 'stories-of-mirrors']) }}">
                        <span>Read Stories of Mirrors</span>
                    </a>
                    <div class="ht-social d-flex justify-content-center">
                        <a href="https://www.facebook.com/stories.of.mirrors/" target="_blank" aria-label="Share on Facebook" rel="noopener noreferrer" class="px-2 py-1">
                            <i class="fa fa-facebook"></i>
                            <span class="sr-only">Facebook</span>
                        </a>
                        <a href="https://www.instagram.com/storiesofmirrors/" target="_blank" aria-label="Visit our Instagram" rel="noopener noreferrer" class="px-2 py-1">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                        <a href="https://x.com/SchmollThoughts" target="_blank" aria-label="Follow us on X (formerly Twitter)" rel="noopener noreferrer" class="px-2 py-1">
                            <i class="fa fa-twitter"></i>
                            <span class="sr-only">X</span>
                        </a>
                        <a href="mailto:erica@storiesofmirrors.com" class="px-2 py-1">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                    </div>

                    <p style="max-width: 70%; margin-top: 5rem;">Welcome to the reflection, where curiosity leads and wonder follows. May we explore the unknown together.</p>
                    <div class="d-flex flex-column" style="max-width: max-content; margin-left: auto;">
                        <h3 class="specialh3 mb-5" style="margin-top: 5rem">Contact Info:</h3>
                        <div>
                            <p class="notme"><strong>Phone:</strong> <a class="about-page-link" href="tel:715-212-5574">715-212-5574</a></p>
                            <p><strong>Email:</strong> <a class="about-page-link" href="mailto:erica@storiesofmirrors.com">erica@storiesofmirrors.com</a></p>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </section>
    <!-- Profile Header Section End -->
</x-app-layout>