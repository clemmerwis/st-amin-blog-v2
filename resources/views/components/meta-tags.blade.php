<!-- SEO meta -->
<title>{{ $title ?? config('app.name', 'Schmoll Thoughts') }}</title>
<meta name="keywords" content="{{ $keywords ?? 'default, keywords' }}" />
<meta name="description" content="{{ $description ?? 'default description' }}" />
<meta name="author" content="{{ $author ?? 'default author' }}" />
<meta name="robots" content="{{ $robots ?? 'index, follow' }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Social meta -->
<meta property="og:title" content="{{ $ogTitle ?? $title }}">
<meta property="og:description" content="{{ $ogDescription ?? $description }}">
<meta property="og:image" content="{{ $ogImage ?? url('/default-og-image.png') }}">
<meta property="og:url" content="{{ $ogUrl ?? url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $ogSiteName ?? config('app.name', 'Schmoll Thoughts') }}">

<meta name="twitter:card" content="{{ $twitterCard ?? 'summary_large_image' }}">
<meta name="twitter:title" content="{{ $twitterTitle ?? $title }}">
<meta name="twitter:description" content="{{ $twitterDescription ?? $description }}">
<meta name="twitter:image" content="{{ $twitterImage ?? url('/default-twitter-image.png') }}">