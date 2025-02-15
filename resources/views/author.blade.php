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
                        Welcome to my magical realm! I'm Erica Denise Schmoll, a writer, technical designer, analytical thinker, and energy & spirit organizer. My journey is rooted in a diverse background that combines deep knowledge in pharmacy, health, and cutting-edge technology.
                    </p>
                    <p>
                        With extensive training in pharmacy, I have completed the pharmacy technician program, providing me with a robust understanding of medications, their interactions, and their impacts on the body and mind. This expertise is not just limited to pharmaceutical management but extends to holistic health practices. I hold certifications in fitness and nutrition and have completed a rigorous 15-month intensive development program with a professional trainer, focusing on advanced lifting techniques and nutrition. Additionally, as a certified Reiki practitioner, I integrate ancient healing arts into my holistic approach to health and wellness.
                    </p>

                    <p>
                        In the realm of technology, my skills span from automation design and consulting within the pharmacy field to project management and API development. I have a strong foundation in creating modern technological solutions that seamlessly blend with ancient practices. Currently, I am pursuing a Ph.D. in Natural Medicine, continuously expanding my knowledge and expertise.
                    </p>

                    <p class="mb3rem">
                        My work, particularly through "Stories of Mirrors" and The Witch Magazine, aims to inspire and educate by offering insights drawn from my personal journey and professional background. Whether you're delving into the mysteries of the paranormal, exploring holistic health practices, or seeking modern tech solutions, there's something here for everyone. Welcome to our growing community, where magic meets the modern world.
                    </p>

                    <h3 class="specialh3">Schmoll Thoughts and The Witch Magazine</h3>
                    <p class="mb3rem">
                        Schmoll Thoughts is a multifaceted platform that combines marketing, writing, and technical design to offer a wide range of services. Along with my dedicated team, we provide full-service web design, marketing advertising, talent management, and publishing. Our mission is to bring your creative visions to life by merging modern technology with timeless creativity, ensuring that every project is executed with precision and passion.
                    </p>
                    
                    <h3 class="specialh3 h3mb">
                        <a href="{{ route('posts.index', ['category' => 'stories-of-mirrors']) }}">Stories of Mirrors</a>
                        <p><i>Where magic meets reality</i></p>
                    </h3> 
                    <p class="mb3rem">
                        "Stories of Mirrors" invites you to step into a world where magic meets reality. This section takes you on a journey through tales that unveil the hidden layers of our existence, where mirrors serve as portals to the unexplained and supernatural events challenge our perception of reality. These stories, drawn from my personal journey and professional expertise, are designed to inspire, educate, and open your mind to the wonders that lie beyond the physical realm.
                    </p>

                    <h3 class="specialh3 h3mb">
                        <a href="{{ route('posts.index', ['category' => 'magazine']) }}">Expanding The Witch Magazine</a>
                    </h3>
                    <p class="mb3rem">
                        "The Witch Magazine" is evolving to embrace a broader spectrum of topics within the world of witchcraft and spirituality. Our expansion aims to provide a comprehensive and enriching experience for every witch and spiritual seeker. We are dedicated to covering a wide range of categories, ensuring that our readers have access to diverse content that supports their spiritual journey and deepens their understanding of the mystical arts.
                    </p>

                    <h3 class="specialh3 h3mb">
                        <a href="{{ route('posts.index', ['category' => 'spells-energy']) }}">Spells & Energy:</a>
                    </h3>
                    <p>Explore energy work, from Reiki to spellcraft, and harness these forces for positive change.</p>

                    <h3 class="specialh3 h3mb">
                        <a href="{{ route('posts.index', ['category' => 'tech-web']) }}">Tech & Web:</a></h3> 
                    <p>Discover how modern technology and ancient practices can enhance your spiritual journey.</p>

                    <h3 class="specialh3 h3mb">
                        <a href="{{ route('posts.index', ['category' => 'health-healing']) }}">Health & Healing:</a>
                    </h3> 
                    <p>Delve into holistic health practices, nutrition, and natural medicine.</p>

                    <h3 class="specialh3 h3mb">
                        <a href="{{ route('posts.index', ['category' => 'useful-apparel']) }}">Apparel:</a>
                    </h3> 
                    <p class="mb3rem">Embrace witchy fashion with practical tips, DIY guides, and historical context.</p>

                    <h3 class="specialh3">The Magic Touch:</h3>
                    <p class="mb3rem">
                        Every great story has a good witch, and my journey is no different. Raised in the Wisconsin Northwoods on a property dating back to the late 1880s, my upbringing on a conduit of supernatural energy has profoundly influenced my work. I aim to dispel the stigma around witches by showcasing the beauty and wisdom in our craft—much like the good witches in our favorite fairy tales.
                    </p>

                    <h3 class="specialh3">Embracing Our Essence:</h3>
                    <p>
                        My goal is to further the understanding of our essential nature with class & style. By binding through the power of design, digital communication, and data collection, we can spell out magical energy and provide patterns of vibration that explain our human experiences. This helps us remember who we are, rewrite history, and save our futures.
                    </p>

                    <p class="mb3rem">
                        Everyone I meet has a tale to share about something that can't be explained. 'Stories of Mirrors' are my own true interactions with the spiritual kingdom, shared to inspire and enlighten others. The truth is hidden in fairy tales, with clues left for us to identify who we are, where we came from, and how to identify the bad guy, evil in this world. Understanding who you are and where you come from is crucial, which is why "Stories of Mirrors" retraces the steps to find the patterns, review the code, read the language, and find the keywords and numbers associated with these events.
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

                    <p style="max-width: 70%; margin-top: 5rem;">Welcome to the journey, and may we explore the unknown together with an open mind and a sense of wonder.</p>
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