<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Detail;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lastChapterDate = $this->createChapterPosts();
        $this->createMagazinePosts($lastChapterDate);
    }

    private function createChapterPosts()
    {
        $startDate = Carbon::create(2023, 1, 1);  // January 1, 2023
    
        $chapters = [
            [
                'title' => "The Eerie Tale of The Unsleeping Lamp",
                'slug' => "the-eerie-tale-of-the-unsleeping-lamp",
                'excerpt' => "March Early 90s, Dancy, Wisconsin",
                'content_file' => "chapter1.md",
            ],
            [
                'title' => "The Mysterious Phenomena of Unincorporated",
                'slug' => "mysterious-phenomena-unincorporated",
                'excerpt' => "Home",
                'content_file' => "chapter2.md",
            ],
            [
                'title' => "Mystical Reflections: The Divining Glass",
                'slug' => "mystical-reflections-divining-glass",
                'excerpt' => "April 1985",
                'content_file' => "chapter3.md",
            ],
            [
                'title' => "Paranormal Fever",
                'slug' => "paranormal-fever",
                'excerpt' => "Memorial Day Weekend, May 1985",
                'content_file' => "chapter4.md",
            ],
            [
                'title' => "What's Next in Stories of Mirrors",
                'slug' => "whats-next-stories-of-mirrors",
                'excerpt' => "Dear Readers/Listeners",
                'content_file' => "chapter5.md",
            ],
        ];
    
        $storiesOfMirrorsCategory = Category::where('name', 'Stories of Mirrors')->firstOrFail();
        $lastDate = $startDate;
    
        foreach ($chapters as $index => $chapter) {
            $chapterNumber = $index + 1;
            $chapterCategory = Category::where('name', "Chapter " . ($index + 1))->firstOrFail();
    
            $lastDate = $startDate->copy()->addDays($index);

            // Read content from file
            $contentPath = database_path("seeders/content/{$chapter['content_file']}");
            $content = file_exists($contentPath) ? file_get_contents($contentPath) : "<p>Content not found.</p>";

            $post = Post::factory()->create([
                'title' => $chapter['title'],
                'slug' => $chapter['slug'],
                'excerpt' => $chapter['excerpt'],
                'body' => $content,
                'published_at' => $lastDate,
                'created_at' => $lastDate,
                'updated_at' => $lastDate,
            ]);

            // Attach categories
            $post->categories()->attach([$storiesOfMirrorsCategory->id, $chapterCategory->id]);
    
            // Add featured image
            $imagePattern = public_path("img/WebsitePicsGifs/SOM_Chapter{$chapterNumber}_*/*.jpg");
            $imagePaths = glob($imagePattern);
            if (!empty($imagePaths)) {
                $post->addMedia($imagePaths[0])
                    ->preservingOriginal()
                    ->toMediaCollection('featured-images');
            }

            // Add featured GIF
            $gifPattern = public_path("img/WebsitePicsGifs/SOM_Chapter{$chapterNumber}_*/*.gif");
            $gifPaths = glob($gifPattern);
            if (!empty($gifPaths)) {
                $post->addMedia($gifPaths[0])
                    ->preservingOriginal()
                    ->toMediaCollection('featured-gifs');
            }
    
            $post->detail()->save(Detail::factory()->make([
                'seo_meta' => [
                    'title' => $chapter['title'],
                    'keywords' => "Paranormal experiences, haunted artifacts, ghost stories, supernatural encounters, mysterious phenomena, unexplained events, eerie tales, paranormal investigation, supernatural mysteries, haunted objects",
                    'description' => "Chapter " . ($index + 1) . ": Stories of Mirrors",
                    'author' => "Erica Schmoll",
                    'ogTitle' => $chapter['title'],
                    'ogDescription' => "Chapter " . ($index + 1) . ": Stories of Mirrors",
                    'ogUrl' => "https://storiesofmirrors.com/posts/stories-of-mirrors/" . $chapter['slug'],
                    'twitterTitle' => $chapter['title'],
                    'twitterDescription' => "Chapter " . ($index + 1) . ": Stories of Mirrors",
                ]
            ]));
        }

        return $lastDate;
    }

    private function createMagazinePosts($startDate)
    {
        $startDate = $startDate->addDays(1);

        $magazineCategories = [
            1 => ['name' => 'Health & Healing', 'folder' => 'HealthHealing', 'content_file' => 'health_healing.md'],
            2 => ['name' => 'Spells & Energy', 'folder' => 'SpellsEnergy', 'content_file' => 'spells_energy.md'],
            3 => ['name' => 'Tech & Web', 'folder' => 'TechWeb', 'content_file' => 'tech_web.md'],
            4 => ['name' => 'Useful Apparel', 'folder' => 'UsefulApparel', 'content_file' => 'useful_apparel.md'],
            5 => ['name' => 'Paranormal', 'folder' => 'Paranormal', 'content_file' => 'paranormal.md']
        ];
    
        foreach ($magazineCategories as $i => $categoryInfo) {
            $magazineCategory = Category::where('name', $categoryInfo['name'])->firstOrFail();

            switch ($i) {
                case 1:
                    $title = "Holistic Health: A Witch's Perspective";
                    $slug = "holistic-health-a-witchs-perspective";
                    $excerpt = "Explore the best practices for maintaining health and healing, where the art of holistic wellness and mystical remedies ensures that goodness and beauty will surround you all the days of your life, allowing you to dwell in peace and harmony forever. Delve into ancient healing arts, modern wellness tips, and magical approaches to living a balanced and harmonious life.";
                    $seoMeta = [
                        'title' => "Holistic Health: A Witch's Perspective",
                        'keywords' => "health, healing, wellness, guide",
                        'description' => "Comprehensive guide to health and healing practices.",
                        'author' => "Author Name",
                        'ogTitle' => "Holistic Health: A Witch's Perspective",
                        'ogDescription' => "Comprehensive guide to health and healing practices.",
                        'ogUrl' => "https://storiesofmirrors.com/posts/holistic-health-a-witchs-perspective",
                        'twitterTitle' => "Holistic Health: A Witch's Perspective",
                        'twitterDescription' => "Comprehensive guide to health and healing practices.",
                    ];
                    break;
                case 2:
                    $title = "My Journey into the World of Energy & Spells";
                    $slug = "my-journey-into-the-world-of-energy-and-spells";
                    $excerpt = "Mirror, mirror, scry for me, mirror, mirror let me see, as I will, so mote it be. Unlock the secrets of mystical energies and powerful spells that shape your reality. Delve into ancient incantations, energy work, and rituals designed to empower and transform. Whether you seek to manifest your desires or protect your spirit, this section offers the knowledge and tools to harness the unseen forces and align them with your will.";
                    $seoMeta = [
                        'title' => "My Journey into the World of Energy & Spells",
                        'keywords' => "spells, energy, techniques, magic",
                        'description' => "Discover powerful spells and energy techniques for spiritual enhancement.",
                        'author' => "Author Name",
                        'ogTitle' => "My Journey into the World of Energy & Spells",
                        'ogDescription' => "Discover powerful spells and energy techniques for spiritual enhancement.",
                        'ogUrl' => "https://storiesofmirrors.com/posts/magazine/my-journey-into-the-world-of-energy-and-spells",
                        'twitterTitle' => "My Journey into the World of Energy & Spells",
                        'twitterDescription' => "Discover powerful spells and energy techniques for spiritual enhancement.",
                    ];
                    break;
                case 3:
                    $title = "Bridging the Gap Between Tech and Witchcraft";
                    $slug = "bridging-the-gap-between-tech-and-witchcraft";
                    $excerpt = "Code, after all, is simply witchcraft in a digital realm. Explore the intersection of technology and magic, where modern innovations meet ancient wisdom. Discover the latest in web resources, digital tools, and tech advancements that can enhance your mystical practices. Whether you're a tech-savvy witch or a curious novice, this section unveils the secrets of cyber sorcery and the powerful spells of code.";
                    $seoMeta = [
                        'title' => "Bridging the Gap Between Tech and Witchcraft",
                        'keywords' => "technology, web, trends, updates",
                        'description' => "The latest trends and advancements in technology and the web.",
                        'author' => "Author Name",
                        'ogTitle' => "Bridging the Gap Between Tech and Witchcraft",
                        'ogDescription' => "The latest trends and advancements in technology and the web.",
                        'ogUrl' => "https://storiesofmirrors.com/posts/magazine/bridging-the-gap-between-tech-and-witchcraft",
                        'twitterTitle' => "Bridging the Gap Between Tech and Witchcraft",
                        'twitterDescription' => "The latest trends and advancements in technology and the web.",
                    ];
                    break;
                case 4:
                    $title = "Embracing Witchy Fashion: More Than Just Clothes";
                    $slug = "embracing-witchy-fashion-more-than-just-clothes";
                    $excerpt = 'Useful apparel is one of the greatest tools one can have. Discover the enchanting world of witchy fashion, where practicality meets magical flair. From enchanted hats to spell-bound shoes that echo the magic of "there\'s no place like home," learn how to dress in a way that empowers and protects you. Whether you\'re looking for everyday witchy wear or mystical accessories, this section provides inspiration and guidance on building a wardrobe that reflects your inner magic.';
                    $seoMeta = [
                        'title' => "Embracing Witchy Fashion: More Than Just Clothes",
                        'keywords' => "apparel, tips, clothing, fashion",
                        'description' => "Best tips and tricks for choosing and using useful apparel.",
                        'author' => "Author Name",
                        'ogTitle' => "Embracing Witchy Fashion: More Than Just Clothes",
                        'ogDescription' => "Best tips and tricks for choosing and using useful apparel.",
                        'ogUrl' => "https://storiesofmirrors.com/posts/magazine/embracing-witchy-fashion-more-than-just-clothes",
                        'twitterTitle' => "Embracing Witchy Fashion: More Than Just Clothes",
                        'twitterDescription' => "Best tips and tricks for choosing and using useful apparel.",
                    ];
                    break;
                case 5:
                    $title = "Exploring the Paranormal";
                    $slug = "exploring-the-paranormal";
                    $excerpt = 'In "Stories of Mirrors," I explore the inexplicable encounters that have intertwined with my existence, revealing the intricate dance between the spiritual kingdom and our own. From ghostly reflections to whispered secrets from beyond, these tales offer a glimpse into the unknown that has always captivated my imagination.';
                    $seoMeta = [
                        'title' => "Exploring the Paranormal",
                        'keywords' => "apparel, tips, clothing, fashion",
                        'description' => "Best tips and tricks for choosing and using useful apparel.",
                        'author' => "Author Name",
                        'ogTitle' => "Exploring the Paranormal",
                        'ogDescription' => "Best tips and tricks for choosing and using useful apparel.",
                        'ogUrl' => "https://storiesofmirrors.com/posts/magazine/useful-apparel-tips",
                        'twitterTitle' => "Useful Apparel Tips",
                        'twitterDescription' => "Best tips and tricks for choosing and using useful apparel.",
                    ];
                    break;
            }

            $postDate = $startDate->copy()->addDays($i);

            // Read content from file
            $contentPath = database_path("seeders/content/{$categoryInfo['content_file']}");
            $content = file_exists($contentPath) ? file_get_contents($contentPath) : "<p>Content not found.</p>";
            
            $post = Post::factory()->create([
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $excerpt,
                'body' => $content,
                'published_at' => $postDate,
                'created_at' => $postDate,
                'updated_at' => $postDate
            ]);

            $post->categories()->attach([7, $magazineCategory->id]);

            // Add featured image
            $imagePattern = public_path("img/WebsitePicsGifs/MAG_{$categoryInfo['folder']}*/*.jpg");
            $imagePaths = glob($imagePattern);
            if (!empty($imagePaths)) {
                $post->addMedia($imagePaths[0])
                    ->preservingOriginal()
                    ->toMediaCollection('featured-images');
            }

            // Add featured GIF
            $gifPattern = public_path("img/WebsitePicsGifs/MAG_{$categoryInfo['folder']}*/*.gif");
            $gifPaths = glob($gifPattern);
            if (!empty($gifPaths)) {
                $post->addMedia($gifPaths[0])
                    ->preservingOriginal()
                    ->toMediaCollection('featured-gifs');
            }

            $post->detail()->save(Detail::factory()->make([
                'seo_meta' => $seoMeta
            ]));

            // PRODUCT UPDATE HERE - RIGHT BEFORE THE LOOP CONTINUES
            if ($slug === 'holistic-health-a-witchs-perspective') {
                $post->update([
                    'featured' => true,
                    'product_name' => 'Product Name Here!',
                    'product_price' => 3369,  // $33.69 in cents
                    'product_image_url' => null
                ]);
            }
        }
    }
}