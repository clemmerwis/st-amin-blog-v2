<!-- SEO -->
<title>{!! $title !!}</title>
<meta name="description" content="{!! $description !!}" />
<meta name="author" content="{!! $author !!}" />
<meta name="keywords" content="{!! $keywords !!}" />

<!-- Open Graph meta tags -->
<meta property="og:title" content="{!! $ogTitle !!}">
<meta property="og:description" content="{!! $ogDescription !!}">
<meta property="og:url" content="{!! $ogUrl !!}">
<meta property="og:image" content="{!! $ogImage !!}">
<meta property="og:type" content="{!! $ogType ?? 'website' !!}">
<meta property="og:site_name" content="Stories of Mirrors">

<!-- Twitter meta tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{!! $twitterTitle !!}">
<meta name="twitter:description" content="{!! $twitterDescription !!}">
<meta name="twitter:image" content="{!! $twitterImage !!}">