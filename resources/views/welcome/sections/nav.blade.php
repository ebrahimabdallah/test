<nav>
  <a href="{{ route('welcome') }}" class="logo" aria-label="العودة للرئيسية">
    @include('welcome.sections._site-logo', ['variant' => 'nav'])
    <span></span>
  </a>
  <ul class="nav-links">
    <li><a href="{{ route('welcome') }}#services">الخدمات</a></li>
    <li><a href="{{ route('welcome') }}#why">ليه ثمرة</a></li>
    <li><a href="{{ route('welcome') }}#results">النتائج</a></li>
    <li><a href="{{ route('welcome') }}#works">أعمالنا</a></li>
    <li><a href="{{ route('welcome') }}#blog">المدونة</a></li>
    <li><a href="{{ route('welcome') }}#contact">تواصل</a></li>
  </ul>
  <a href="{{ $siteSettings->whatsappUrl() }}" class="nav-cta" target="_blank" rel="noopener noreferrer">احصل على استشارة</a>
  <button class="menu-toggle">☰</button>
</nav>
