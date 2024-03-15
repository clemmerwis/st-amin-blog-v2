<x-app-layout>
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
                    <img src="img/erica.jpg" alt="Profile Image" class="profile-image rounded-circle">
                    <h2 class="mt-4 mb-2">About Erica Denise Schmoll</h2>
                    
                    <h3 class="smallh3 mb2rem">
                        Engineer of Software and Dreams: <span>Digital Design and Creative Writing
                        </span>
                    </h3>
                    <p>
                        In the dimly lit corridors of my memory, mirrors have always been more than mere reflectors of reality; they are gateways to a realm beyond our understanding, portals to a world that whispers secrets of the unseen. "Stories of Mirrors" is not just a collection of tales; it's a glimpse into the inexplicable encounters that have intertwined with the fabric of my existence, revealing the intricate dance between the spiritual kingdom and our own.                    
                    </p>
                    <p>
                        From a tender age, I found myself caught in the reflection of experiences that defied explanation. What I saw in the mirrors, the shadows that moved with intention, and the voices that echoed without a source, led me to question my sanity. But I was not alone. Others too peered into the glass and saw beyond their reflections; they too heard the whispers in the silence.
                    </p>
                    <p>
                        This book is a testament to those encounters, shared not from a place of fear, but of awe and wonder. Each story is a thread in the tapestry of our interaction with the spiritual realm, woven from the moments when the veil thinned and the other side gazed back.
                    </p>
                    <p>
                        This book, released in a blog-style format, is a testament to the power of digital innovation in storytelling. It's designed not just to showcase my skills in writing, design, and technology, but to inspire others to consider how stories can be told in new and exciting ways. In a world where technology constantly reshapes our lives, "Stories of Mirrors" is an invitation to look at the familiar from a fresh perspective, to see not just what is, but what could be.
                    </p>
                    <p class="mb3rem">
                        I invite you to journey with me through these pages, where the boundaries blur and the mirrors speak. These are not just my stories—they belong to anyone who has ever sensed that there is more to this world than what meets the eye. Let us explore the unexplained together, for in the reflection of our quest for understanding, we may find that we are not so alone after all.
                    </p>

                    <a class="btn about-page-btn mb-5" href="{{ route('posts.index', ['category' => 'stories-of-mirrors']) }}">
                        <span>Read Stories of Mirrors</span>
                    </a>
                    <div class="ht-social d-flex justify-content-center">
                        <a href="https://www.facebook.com/erica.schmoll" target="_blank" aria-label="Share on Facebook" rel="noopener noreferrer">
                            <i class="fa fa-facebook"></i>
                            <span class="sr-only">Facebook</span>
                        </a>
                        <a href="https://www.instagram.com/schmoll_thoughts" target="_blank" aria-label="Visit our Instagram" rel="noopener noreferrer">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                        <a href="mailto:erica@storiesofmirrors.com"><i class="fa fa-envelope-o"></i></a>
                    </div>
                    <div class="d-flex flex-column" style="max-width: max-content;">
                        <h3 class="specialh3 mb-5" style="margin-top: 5rem">Contact Info:</h3>
                        <div class="d-flex" style="gap: 1rem">
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