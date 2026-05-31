<section class="contact" id="contact">
  <div class="container">
    <div class="contact-grid">
      <div class="contact-info reveal">
        <div class="section-tag">تواصل معنا</div>
        <h2>جاهز تبدأ <span style="color:var(--lime)">ثمرة</span> نجاحك؟</h2>
        <p>تواصل معنا اليوم واحصل على استشارة مجانية لمتجرك الإلكتروني. هنرد عليك في أقل من ساعة.</p>
        <div class="contact-channels">
          <div class="channel">
            <div class="channel-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.512 5.26l-.999 3.648 3.736-.978zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </div>
            <div class="channel-info">
              <div class="channel-label">واتساب</div>
              <div class="channel-value">{{ $siteSettings->whatsappDisplay() ?: '+966 50 123 4567' }}</div>
            </div>
          </div>
          <div class="channel">
            <div class="channel-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
            </div>
            <div class="channel-info">
              <div class="channel-label">البريد الإلكتروني</div>
              <div class="channel-value">hello@thamaraa.com</div>
            </div>
          </div>
          <div class="channel">
            <div class="channel-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="channel-info">
              <div class="channel-label">المقر</div>
              <div class="channel-value">الرياض، المملكة العربية السعودية</div>
            </div>
          </div>
        </div>
      </div>

      <div class="contact-form reveal">
        <div class="form-group">
          <label>الاسم الكامل</label>
          <input type="text" placeholder="اكتب اسمك">
        </div>
        <div class="form-group">
          <label>البريد الإلكتروني</label>
          <input type="email" placeholder="your@email.com">
        </div>
        <div class="form-group">
          <label>رقم الجوال</label>
          <input type="tel" placeholder="+966 5x xxx xxxx">
        </div>
        <div class="form-group">
          <label>كلمنا عن مشروعك</label>
          <textarea placeholder="نوع التجارة، التحديات، الأهداف..."></textarea>
        </div>
        <button class="form-submit">ابدأ مشروعك معنا</button>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
