<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="logo">
       <img src="{{ $siteSettings->logoUrl() }}" alt="Logo">
          <span>
                </span></div>
        <p>شريكك في النمو الرقمي. حلول تسويقية مبنية على بيانات وفهم عميق لسوقك.</p>
      </div>
      <div class="footer-col">
        <h5>الخدمات</h5>
        <ul>
          <li><a href="#">SEO</a></li>
          <li><a href="#">سوشيال ميديا</a></li>
          <li><a href="#">إعلانات ممولة</a></li>
          <li><a href="#">تصميم متاجر</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>الشركة</h5>
        <ul>
          <li><a href="#">عن ثمرة</a></li>
          <li><a href="#works">أعمالنا</a></li>
          <li><a href="#">المدونة</a></li>
          <li><a href="#">الوظائف</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>تواصل</h5>
        <ul>
          <li><a href="{{ $siteSettings->whatsappUrl() }}" target="_blank" rel="noopener noreferrer">واتساب</a></li>
          <li><a href="#">البريد الإلكتروني</a></li>
          <li><a href="#">تويتر / X</a></li>
          <li><a href="#">لينكدإن</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div>© 2026 ثمرة. جميع الحقوق محفوظة.</div>
      <div class="socials">
        @if(filled($siteSettings->twitter_url))
          <a href="{{ $siteSettings->twitter_url }}" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="X"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
        @endif
        @if(filled($siteSettings->linkedin_url))
          <a href="{{ $siteSettings->linkedin_url }}" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.063 2.063 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg></a>
        @endif
        @if(filled($siteSettings->instagram_url))
          <a href="{{ $siteSettings->instagram_url }}" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
        @endif
        @if(filled($siteSettings->tiktok_url))
          <a href="{{ $siteSettings->tiktok_url }}" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19.321 5.562a5.124 5.124 0 01-.443-.258 6.228 6.228 0 01-1.137-.966c-.849-.971-1.166-1.957-1.282-2.647h.004C16.368 1.137 16.4.5 16.4.5h-3.288v12.7c0 .17 0 .34-.007.507l-.001.063-.002.027-.003.05c0 .002 0 .003-.001.005a2.798 2.798 0 01-1.415 2.212 2.741 2.741 0 01-1.367.362c-1.524 0-2.76-1.244-2.76-2.778s1.236-2.777 2.76-2.777c.288 0 .566.045.826.128l.004-3.348a6.142 6.142 0 00-4.733 1.378 6.473 6.473 0 00-1.413 1.745c-.13.226-.625 1.135-.685 2.611-.038.838.214 1.706.334 2.064v.008c.075.21.367.93.844 1.537.384.488.838.917 1.348 1.27v-.008l.008.008c1.51 1.027 3.185.96 3.185.96.29-.012 1.262 0 2.366-.524 1.224-.58 1.92-1.445 1.92-1.445a4.668 4.668 0 00.829-1.376c.231-.611.308-1.344.308-1.636V6.726c.039.023.547.359.547.359s.732.469 1.875.774c.82.217 1.924.263 1.924.263V4.917c-.387.042-1.173-.08-1.979-.481z"/></svg></a>
        @endif
      </div>
    </div>
  </div>
</footer>
