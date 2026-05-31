@php
  $variant = $variant ?? 'nav';
  $maxHeight = $variant === 'footer' ? '52px' : '42px';
  $maxWidth = $variant === 'footer' ? '180px' : '150px';
@endphp
<img
  src="{{ $siteSettings->logoUrl() }}"
  alt="ثمرة"
  class="site-logo-img"
  width="150"
  height="42"
  decoding="async"
  style="display:block;max-height:{{ $maxHeight }};max-width:{{ $maxWidth }};width:auto;height:auto;object-fit:contain;"
>
