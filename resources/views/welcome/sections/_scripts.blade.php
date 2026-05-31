<script>
  window.__WELCOME__ = {
    worksData: {!! $worksJson ?? '{}' !!}
  };
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
<script src="{{ asset('js/welcome.js') }}" defer></script>
