@include('welcome.sections._head')

<body>
@include('welcome.sections._gtm-body')
@include('welcome.sections.nav')

<article class="blog-post">
  <div class="container">
    <a href="{{ url('/#blog') }}" class="blog-back">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      العودة للمدونة
    </a>

    <header class="blog-post-header reveal">
      <div class="section-tag">مدونة ثمرة</div>
      <h1 class="blog-post-title">{{ $blog->title }}</h1>
      @if(filled($blog->excerpt))
        <p class="blog-post-excerpt">{{ $blog->excerpt }}</p>
      @endif
      <div class="blog-date">
        @if($blog->formattedPublishedDate())
          {{ $blog->formattedPublishedDate() }} ·
        @endif
        {{ $blog->readingTimeMinutes() }} دقائق قراءة
      </div>
    </header>

    @if($blog->featuredImageUrl())
      <div class="blog-post-featured reveal">
        <img
          src="{{ $blog->featuredImageUrl() }}"
          alt="{{ $blog->title }}"
          loading="lazy"
          decoding="async"
        >
      </div>
    @endif

    <div class="blog-post-body reveal">
      {!! $blog->content !!}
    </div>
  </div>
</article>

@include('welcome.sections.footer')

<script src="{{ asset('js/welcome.js') }}" defer></script>
</body>
</html>
