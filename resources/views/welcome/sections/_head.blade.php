<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>

  
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $pageTitle ?? 'ثمرة — حلول تسويقية لتجارتك الإلكترونية' }}</title>

@php($favicon = $siteSettings->faviconUrl() ?? asset('images/favicon.svg'))
<link rel="icon" type="image/png" href="{{ $favicon }}">
<link rel="shortcut icon" href="{{ $favicon }}">
<link rel="apple-touch-icon" href="{{ $favicon }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Google Tag -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W58SMST9');</script>
<!-- End Google Tag Manager -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
