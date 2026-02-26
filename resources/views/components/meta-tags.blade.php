<!-- SEO -->
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}" />
<meta name="author" content="{{ $author }}" />
<meta name="keywords" content="{{ $keywords }}" />

<!-- Open Graph meta tags -->
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:url" content="{{ $ogUrl }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="{{ $ogImageWidth ?? '1200' }}">
<meta property="og:image:height" content="{{ $ogImageHeight ?? '630' }}">
<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:site_name" content="Stories of Mirrors">
@if(config('services.facebook.app_id'))
<meta property="fb:app_id" content="{{ config('services.facebook.app_id') }}">
@endif

<!-- Twitter meta tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $twitterTitle }}">
<meta name="twitter:description" content="{{ $twitterDescription }}">
<meta name="twitter:image" content="{{ $twitterImage }}">