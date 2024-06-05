<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Detail;
use App\Models\Post;
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
        $this->createChapterPosts();
        $this->createMagazinePosts();
    }

    private function createChapterPosts()
    {
        for ($i = 1; $i <= 4; $i++) {
            $chapterCategory = Category::where('name', "Chapter $i")->firstOrFail();

            switch ($i) {
                case 1:
                    $title = "The Unsleeping Lamp";
                    $slug = "the-unsleeping-lamp";
                    $excerpt = "March Early 90s, Marshfield & Dancy, Wisconsin";
                    $content = <<<EOT
                    <p>It was spring break in northern Wisconsin, and my sister and I were getting ready for a field trip...</p>
                    EOT;
                    $seoMeta = [
                        'title' => "The Unsleeping Lamp",
                        'keywords' => "enchanted forest, adventure, travel, nature",
                        'description' => "Chapter $i: Stories of Mirrors",
                        'author' => "Erica Schmoll",
                        'ogTitle' => "The Unsleeping Lamp",
                        'ogDescription' => "Chapter $i: Stories of Mirrors",
                        'ogUrl' => "https://stories-of-mirrors.com/posts/stories-of-mirrors/$slug",
                        'twitterTitle' => "The Unsleeping Lamp",
                        'twitterDescription' => "Chapter $i: Stories of Mirrors",
                    ];
                    break;
                case 2:
                    $title = "Unincorporated";
                    $slug = "unincorporated";
                    $excerpt = "Home";
                    $content = <<<EOT
                    <p>I was raised in the Northwoods of Wisconsin, in an unincorporated town named Dancy...</p>
                    EOT;
                    $seoMeta = [
                        'title' => "Unincorporated",
                        'keywords' => "enchanted forest, adventure, travel, nature",
                        'description' => "Chapter $i: Stories of Mirrors",
                        'author' => "Erica Schmoll",
                        'ogTitle' => "Unincorporated",
                        'ogDescription' => "Chapter $i: Stories of Mirrors",
                        'ogUrl' => "https://stories-of-mirrors.com/posts/stories-of-mirrors/$slug",
                        'twitterTitle' => "Unincorporated",
                        'twitterDescription' => "Chapter $i: Stories of Mirrors",
                    ];
                    break;
                case 3:
                    $title = "Divining Glass";
                    $slug = "divining-glass";
                    $excerpt = "April 1985";
                    $content = <<<EOT
                    <p>At the time, my family was renting an old farmhouse on Curve Road, just outside of Mosinee, Wisconsin...</p>
                    EOT;
                    $seoMeta = [
                        'title' => "Divining Glass",
                        'keywords' => "enchanted forest, adventure, travel, nature",
                        'description' => "Chapter $i: Stories of Mirrors",
                        'author' => "Erica Schmoll",
                        'ogTitle' => "Divining Glass",
                        'ogDescription' => "Chapter $i: Stories of Mirrors",
                        'ogUrl' => "https://stories-of-mirrors.com/posts/stories-of-mirrors/$slug",
                        'twitterTitle' => "Divining Glass",
                        'twitterDescription' => "Chapter $i: Stories of Mirrors",
                    ];
                    break;
                case 4:
                    $title = "Fever";
                    $slug = "fever";
                    $excerpt = "Memorial Day Weekend, May 1985";
                    $content = <<<EOT
                    <p>The timing of our move put us directly in the blossoming of spring...</p>
                    EOT;
                    $seoMeta = [
                        'title' => "Fever",
                        'keywords' => "enchanted forest, adventure, travel, nature",
                        'description' => "Chapter $i: Stories of Mirrors",
                        'author' => "Erica Schmoll",
                        'ogTitle' => "Fever",
                        'ogDescription' => "Chapter $i: Stories of Mirrors",
                        'ogUrl' => "https://stories-of-mirrors.com/posts/stories-of-mirrors/$slug",
                        'twitterTitle' => "Fever",
                        'twitterDescription' => "Chapter $i: Stories of Mirrors",
                    ];
                    break;
            }

            $post = Post::factory()->create([
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $excerpt,
                'body' => $content,
            ]);

            $post->categories()->attach([1, $chapterCategory->id]);

            $post->detail()->save(Detail::factory()->make([
                'seo_meta' => $seoMeta
            ]));
        }
    }

    private function createMagazinePosts()
    {
        $magazineCategories = [
            1 => 'Health & Healing',
            2 => 'Spells & Energy',
            3 => 'Tech & Web',
            4 => 'Useful Apparel'
        ];

        for ($i = 1; $i <= 4; $i++) {
            $magazineCategory = Category::where('name', $magazineCategories[$i])->firstOrFail();

            switch ($i) {
                case 1:
                    $title = "Health & Healing Guide";
                    $slug = "health-healing-guide";
                    $excerpt = "Explore the best practices for maintaining health and healing.";
                    $content = <<<EOT
                    <p>Welcome to the Health & Healing guide. This article will explore the best practices for maintaining health and healing...</p>
                    EOT;
                    $seoMeta = [
                        'title' => "Health & Healing Guide",
                        'keywords' => "health, healing, wellness, guide",
                        'description' => "Comprehensive guide to health and healing practices.",
                        'author' => "Author Name",
                        'ogTitle' => "Health & Healing Guide",
                        'ogDescription' => "Comprehensive guide to health and healing practices.",
                        'ogUrl' => "https://magazine-website.com/posts/health-healing-guide",
                        'twitterTitle' => "Health & Healing Guide",
                        'twitterDescription' => "Comprehensive guide to health and healing practices.",
                    ];
                    break;
                case 2:
                    $title = "Spells & Energy Techniques";
                    $slug = "spells-energy-techniques";
                    $excerpt = "Discover powerful spells and energy techniques.";
                    $content = <<<EOT
                    <p>This article delves into powerful spells and energy techniques that can enhance your spiritual practices...</p>
                    EOT;
                    $seoMeta = [
                        'title' => "Spells & Energy Techniques",
                        'keywords' => "spells, energy, techniques, magic",
                        'description' => "Discover powerful spells and energy techniques for spiritual enhancement.",
                        'author' => "Author Name",
                        'ogTitle' => "Spells & Energy Techniques",
                        'ogDescription' => "Discover powerful spells and energy techniques for spiritual enhancement.",
                        'ogUrl' => "https://magazine-website.com/posts/spells-energy-techniques",
                        'twitterTitle' => "Spells & Energy Techniques",
                        'twitterDescription' => "Discover powerful spells and energy techniques for spiritual enhancement.",
                    ];
                    break;
                case 3:
                    $title = "Latest in Tech & Web";
                    $slug = "latest-tech-web";
                    $excerpt = "Stay updated with the latest trends in technology and the web.";
                    $content = <<<EOT
                    <p>Stay updated with the latest trends and advancements in technology and the web...</p>
                    EOT;
                    $seoMeta = [
                        'title' => "Latest in Tech & Web",
                        'keywords' => "technology, web, trends, updates",
                        'description' => "The latest trends and advancements in technology and the web.",
                        'author' => "Author Name",
                        'ogTitle' => "Latest in Tech & Web",
                        'ogDescription' => "The latest trends and advancements in technology and the web.",
                        'ogUrl' => "https://magazine-website.com/posts/latest-tech-web",
                        'twitterTitle' => "Latest in Tech & Web",
                        'twitterDescription' => "The latest trends and advancements in technology and the web.",
                    ];
                    break;
                case 4:
                    $title = "Useful Apparel Tips";
                    $slug = "useful-apparel-tips";
                    $excerpt = "Find out the best tips and tricks for useful apparel.";
                    $content = <<<EOT
                    <p>Discover the best tips and tricks for choosing and using useful apparel in your daily life...</p>
                    EOT;
                    $seoMeta = [
                        'title' => "Useful Apparel Tips",
                        'keywords' => "apparel, tips, clothing, fashion",
                        'description' => "Best tips and tricks for choosing and using useful apparel.",
                        'author' => "Author Name",
                        'ogTitle' => "Useful Apparel Tips",
                        'ogDescription' => "Best tips and tricks for choosing and using useful apparel.",
                        'ogUrl' => "https://magazine-website.com/posts/useful-apparel-tips",
                        'twitterTitle' => "Useful Apparel Tips",
                        'twitterDescription' => "Best tips and tricks for choosing and using useful apparel.",
                    ];
                    break;
            }

            $post = Post::factory()->create([
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $excerpt,
                'body' => $content,
            ]);

            $post->categories()->attach([6, $magazineCategory->id]);

            $post->detail()->save(Detail::factory()->make([
                'seo_meta' => $seoMeta
            ]));
        }
    }
}