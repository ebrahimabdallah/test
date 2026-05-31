// Scroll reveal
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// Roadmap sequential path animation — fast, no heavy sampling
const roadmapEl = document.querySelector('.roadmap');
if (roadmapEl) {
  const roadmapObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        startRoadmapAnimation();
        roadmapObserver.disconnect();
      }
    });
  }, { threshold: 0.05 });
  roadmapObserver.observe(roadmapEl);
}

function startRoadmapAnimation() {
  const svg        = document.querySelector('.roadmap-svg');
  const pathGlow   = document.getElementById('mainPath');
  const pathBg     = document.querySelector('.path-bg');
  const arrow      = document.getElementById('pathArrow');
  const stations   = Array.from(document.querySelectorAll('.station'));
  const destination= document.querySelector('.roadmap-destination');
  if (!svg || !pathGlow) return;

  const totalLen = pathGlow.getTotalLength();
  pathGlow.style.strokeDasharray  = totalLen;
  pathGlow.style.strokeDashoffset = totalLen;

  /*
    The path has 7 equal S-curve segments (6 station stops + 1 to destination).
    Each cubic bezier segment is roughly equal length, so station i sits at (i/7) of total.
    We use fixed fractions — zero sampling, instant calculation.
  */
  const STOPS = [
    1/7,   // station 1
    2/7,   // station 2
    3/7,   // station 3
    4/7,   // station 4
    5/7,   // station 5
    6/7,   // station 6
    1.0,   // destination
  ];

  const SEG_MS   = 700;   // ms per segment — fast and snappy
  const PAUSE_MS = 200;   // pause at each station

  let segIdx = 0;
  let startLen = 0;

  // Show travelling arrow immediately
  if (arrow) arrow.style.opacity = '1';

  function ease(t) {
    // smooth ease-in-out
    return t < 0.5 ? 2*t*t : 1 - Math.pow(-2*t+2,2)/2;
  }

  function getArrowPos(len) {
    const rect    = svg.getBoundingClientRect();
    const roadRect= roadmapEl.getBoundingClientRect();
    const vb      = svg.viewBox.baseVal;
    const sx      = rect.width  / vb.width;
    const sy      = rect.height / vb.height;
    const pt      = pathGlow.getPointAtLength(len);
    const pt2     = pathGlow.getPointAtLength(Math.min(len + 8, totalLen));
    const angle   = Math.atan2(pt2.y - pt.y, pt2.x - pt.x) * 180 / Math.PI;
    return {
      left : rect.left - roadRect.left + pt.x * sx,
      top  : rect.top  - roadRect.top  + pt.y * sy,
      angle,
    };
  }

  function runSegment() {
    if (segIdx >= STOPS.length) return;

    const endLen   = totalLen * STOPS[segIdx];
    const fromLen  = startLen;
    const segStart = performance.now();

    function tick(now) {
      const t       = Math.min((now - segStart) / SEG_MS, 1);
      const et      = ease(t);
      const curLen  = fromLen + (endLen - fromLen) * et;

      // Draw path
      pathGlow.style.strokeDashoffset = totalLen - curLen;

      // Move arrow
      if (arrow) {
        const pos = getArrowPos(curLen);
        arrow.style.left      = pos.left  + 'px';
        arrow.style.top       = pos.top   + 'px';
        arrow.style.transform = `translate(-50%,-50%) rotate(${pos.angle}deg)`;
      }

      if (t < 1) {
        requestAnimationFrame(tick);
      } else {
        // Arrived at this stop
        startLen = endLen;

        if (segIdx < stations.length) {
          // Reveal matching station card
          stations[segIdx].classList.add('visible');
        }

        if (segIdx === STOPS.length - 1) {
          // ---- Reached destination ----
          // Snap arrow to point straight down at the badge
          if (arrow) {
            const pos = getArrowPos(totalLen);
            arrow.style.left      = pos.left  + 'px';
            arrow.style.top       = pos.top   + 'px';
            arrow.style.transform = `translate(-50%,-50%) rotate(90deg)`;
            // Pulse the arrow 3 times then keep it
            arrow.querySelector('svg').style.filter =
              'drop-shadow(0 0 14px rgba(197,232,71,1))';
          }

          // Reveal & pulse destination badge
          if (destination) {
            destination.classList.add('visible');
            const badge = destination.querySelector('.destination-badge');
            if (badge) {
              badge.style.transition = 'transform .35s, box-shadow .35s';
              badge.style.transform  = 'translateY(-6px) scale(1.08)';
              badge.style.boxShadow  = '0 24px 70px rgba(197,232,71,.65)';
              setTimeout(() => {
                badge.style.transform = '';
                badge.style.boxShadow = '';
                setTimeout(() => {
                  badge.style.transform = 'translateY(-4px) scale(1.04)';
                  badge.style.boxShadow = '0 18px 55px rgba(197,232,71,.5)';
                }, 350);
              }, 350);
            }
          }

        } else {
          segIdx++;
          setTimeout(runSegment, PAUSE_MS);
        }
      }
    }

    requestAnimationFrame(tick);
  }

  // Small initial delay then start
  setTimeout(() => { segIdx = 0; runSegment(); }, 300);
}

// Smooth scroll for nav section links
document.querySelectorAll('.nav-links a[href*="#"]').forEach(link => {
  link.addEventListener('click', e => {
    const url = new URL(link.href);
    const hash = url.hash;
    if (!hash) return;

    const target = document.querySelector(hash);
    const onSamePage = window.location.pathname === url.pathname;

    if (target && onSamePage) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth' });
      history.replaceState(null, '', hash);
      document.querySelector('nav')?.classList.remove('menu-open');
      document.querySelector('.menu-toggle')?.setAttribute('aria-expanded', 'false');
    }
  });
});

const nav = document.querySelector('nav');
const menuToggle = document.querySelector('.menu-toggle');
if (menuToggle && nav) {
  menuToggle.addEventListener('click', () => {
    const isOpen = nav.classList.toggle('menu-open');
    menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });
  menuToggle.setAttribute('aria-expanded', 'false');
  menuToggle.setAttribute('aria-label', 'فتح القائمة');
}

// Services mind map details
const servicesDetails = {
  strategy: {
    axis: 'الاستراتيجية',
    title: 'استراتيجية قبل أي تنفيذ',
    text: 'نبدأ بفهم وضع متجرك، أرقامك، جمهورك، والمشكلة الأساسية. بعدها نحدد الخدمات اللي تحتاجها فعلًا بدل ما ندخلك في باقة أكبر من احتياجك.',
    points: ['تشخيص واضح', 'أولويات تنفيذ', 'خطة قابلة للقياس']
  },
  consultation: {
    axis: 'الاستراتيجية',
    title: 'استشارة تكشف الخلل الحقيقي',
    text: 'جلسة تحليل مركزة نراجع فيها وضع المتجر، القنوات الحالية، ومؤشرات الأداء عشان نطلع بتوصيات عملية قابلة للتنفيذ.',
    points: ['تحليل الوضع الحالي', 'تحديد نقاط الضعف', 'توصيات مباشرة']
  },
  accounts: {
    axis: 'الاستراتيجية',
    title: 'إدارة حسابات مبنية على هدف',
    text: 'نتابع الحسابات والقنوات التسويقية بانتظام، ونربط كل قرار بهدف واضح بدل إدارة يومية بلا اتجاه.',
    points: ['متابعة أداء', 'تنسيق القنوات', 'قرارات مبنية على بيانات']
  },
  growth: {
    axis: 'تسويق النمو',
    title: 'نمو محسوب مش صرف عشوائي',
    text: 'نشتغل على القنوات اللي ترفع المبيعات وتخفض تكلفة الاكتساب، مع اختبار مستمر وتحسين للأداء.',
    points: ['اختبارات نمو', 'تحسين التحويل', 'قياس العائد']
  },
  'paid-ads': {
    axis: 'تسويق النمو',
    title: 'إعلانات ممولة بميزانية أذكى',
    text: 'حملات مدروسة على القنوات المناسبة لجمهورك، مع تتبع للنتائج وتحسين مستمر لتكلفة الاكتساب والعائد.',
    points: ['استهداف دقيق', 'تحسين ROAS', 'تقارير واضحة']
  },
  seo: {
    axis: 'تسويق النمو',
    title: 'SEO يجلب طلب مستمر',
    text: 'نحسن ظهور متجرك في نتائج البحث بالكلمات المناسبة، وهيكلة الصفحات والمحتوى عشان العملاء يلاقوك وقت الاحتياج.',
    points: ['كلمات بحث', 'تحسين صفحات', 'محتوى قابل للترتيب']
  },
  social: {
    axis: 'السوشيال ميديا',
    title: 'سوشيال ميديا تخدم البيع',
    text: 'نحول المنصات من مجرد نشر يومي لقناة تبني ثقة، تشرح القيمة، وتدفع العميل للخطوة التالية.',
    points: ['خطة محتوى', 'تفاعل حقيقي', 'رسائل واضحة']
  },
  content: {
    axis: 'السوشيال ميديا',
    title: 'محتوى يشرح ويقنع',
    text: 'نصنع محتوى مناسب للمنصة والجمهور، يوضح المشكلة والحل ويقرب العميل من قرار الشراء.',
    points: ['أفكار شهرية', 'كتابة منشورات', 'زوايا بيع']
  },
  community: {
    axis: 'السوشيال ميديا',
    title: 'إدارة مجتمع تزيد الثقة',
    text: 'نتابع التعليقات والرسائل ونبني أسلوب تواصل يحافظ على صورة البراند ويحول الأسئلة لفرص بيع.',
    points: ['ردود منظمة', 'إدارة التفاعل', 'تحسين الانطباع']
  },
  creative: {
    axis: 'الإنتاج الإبداعي',
    title: 'إنتاج يخدم الفكرة مش الشكل فقط',
    text: 'ننتج مواد بصرية وصوتية مبنية على رسالة واضحة، مناسبة للإعلانات والسوشيال وصفحات المتجر.',
    points: ['سكريبتات', 'تصوير', 'مونتاج']
  },
  video: {
    axis: 'الإنتاج الإبداعي',
    title: 'فيديو قصير يبيع الفكرة بسرعة',
    text: 'فيديوهات للإعلانات والمنصات تشرح القيمة بسرعة، بخطاف واضح ورسالة تناسب سلوك العميل.',
    points: ['Reels', 'إعلانات فيديو', 'مونتاج سريع']
  },
  photo: {
    axis: 'الإنتاج الإبداعي',
    title: 'تصوير يبرز المنتج بثقة',
    text: 'صور منتجات ولايف ستايل تساعد العميل يشوف القيمة والجودة، وتخدم صفحات البيع والمحتوى.',
    points: ['تصوير منتجات', 'لايف ستايل', 'صور للحملات']
  },
  audio: {
    axis: 'الإنتاج الإبداعي',
    title: 'صوتيات تضيف حضور للبراند',
    text: 'تعليقات صوتية ورسائل سمعية واضحة للإعلانات والفيديوهات، بنبرة تناسب شخصية البراند.',
    points: ['فويس أوفر', 'رسائل إعلانية', 'تنقية صوت']
  },
  branding: {
    axis: 'الهوية والتصميم',
    title: 'هوية تخلي البراند مفهوم',
    text: 'نرتب شكل ورسالة البراند بصريًا ولغويًا عشان العميل يفهمك بسرعة ويحس بثقة في كل نقطة تواصل.',
    points: ['هوية بصرية', 'لغة تواصل', 'قوالب تصميم']
  },
  brand: {
    axis: 'الهوية والتصميم',
    title: 'برندينج منظم من الأساس',
    text: 'نحدد شخصية البراند، الألوان، الخطوط، وطريقة الكلام عشان كل ظهور يكون متسق وواضح.',
    points: ['شخصية البراند', 'دليل بصري', 'نبرة صوت']
  },
  'store-design': {
    axis: 'الهوية والتصميم',
    title: 'تصميم متجر يسهّل الشراء',
    text: 'نصمم صفحات المتجر بطريقة تقلل الاحتكاك وتوضح المنتج والعرض، مع تجربة استخدام مريحة.',
    points: ['صفحات بيع', 'تحسين UX', 'واجهة متوافقة']
  },
  media: {
    axis: 'الهوية والتصميم',
    title: 'ميديا متناسقة لكل القنوات',
    text: 'تصاميم ومنشورات وإعلانات تحافظ على شكل البراند وتوصل الرسالة بدون تشتت.',
    points: ['تصاميم سوشيال', 'بنرات إعلانية', 'قوالب ثابتة']
  },
  ecommerce: {
    axis: 'التجارة الإلكترونية',
    title: 'تجارة إلكترونية قابلة للنمو',
    text: 'نساعدك في تطوير وإدارة المتجر، من الأداء وتجربة المستخدم لحد تنظيم المنتجات والعمليات اليومية.',
    points: ['تحسين المتجر', 'عمليات تشغيل', 'تجربة شراء']
  },
  'web-dev': {
    axis: 'التجارة الإلكترونية',
    title: 'تطوير ويب يخدم التحويل',
    text: 'تطوير صفحات ومزايا تساعد المتجر يكون أسرع وأسهل وأكثر وضوحًا للعميل.',
    points: ['صفحات هبوط', 'تحسين سرعة', 'تكاملات']
  },
  'store-management': {
    axis: 'التجارة الإلكترونية',
    title: 'إدارة متاجر بدون فوضى',
    text: 'تنظيم المنتجات، العروض، الصفحات، ومتابعة التفاصيل التشغيلية اللي تأثر مباشرة على تجربة الشراء.',
    points: ['تنظيم منتجات', 'متابعة عروض', 'تحسين صفحات']
  }
};

const serviceModal = document.getElementById('serviceModal');
const modalClose = document.getElementById('modalClose');
const detailAxis = document.getElementById('modalServiceAxis');
const detailTitle = document.getElementById('modalServiceTitle');
const detailText = document.getElementById('modalServiceText');
const detailPoints = document.getElementById('modalServicePoints');
const serviceButtons = document.querySelectorAll('[data-service]');

const closeServiceModal = () => {
  serviceModal.classList.remove('active');
  document.body.classList.remove('modal-open');
  setTimeout(() => {
    serviceModal.hidden = true;
  }, 280);
};

const openServiceModal = (detail) => {
  detailAxis.textContent = detail.axis;
  detailTitle.textContent = detail.title;
  detailText.textContent = detail.text;
  detailPoints.replaceChildren(...detail.points.map(point => {
    const item = document.createElement('span');
    item.textContent = point;
    return item;
  }));

  serviceModal.hidden = false;
  document.body.classList.add('modal-open');
  requestAnimationFrame(() => serviceModal.classList.add('active'));
};

serviceButtons.forEach(button => {
  button.addEventListener('click', () => {
    const detail = servicesDetails[button.dataset.service];
    if (!detail) return;

    serviceButtons.forEach(item => item.classList.remove('active'));
    button.classList.add('active');
    openServiceModal(detail);
  });
});

modalClose.addEventListener('click', closeServiceModal);
serviceModal.addEventListener('click', event => {
  if (event.target === serviceModal) closeServiceModal();
});

const worksModalEl = document.getElementById('worksModal');
const worksModalCloseBtn = document.getElementById('worksModalClose');
const worksModalImg = document.getElementById('worksModalImg');
const worksModalEyebrow = document.getElementById('worksModalEyebrow');
const worksModalTitle = document.getElementById('worksModalTitle');
const worksModalDesc = document.getElementById('worksModalDesc');
const worksModalFeatures = document.getElementById('worksModalFeatures');

function closeWorksModal() {
  if (!worksModalEl) return;
  worksModalEl.classList.remove('active');
  document.body.classList.remove('modal-open');
  setTimeout(() => {
    worksModalEl.hidden = true;
    if (worksModalImg) {
      worksModalImg.removeAttribute('src');
      worksModalImg.alt = '';
    }
  }, 280);
}

function openWorksModal(project, categoryLabel) {
  if (!worksModalEl || !project || !worksModalImg || !worksModalTitle || !worksModalDesc || !worksModalFeatures) return;
  if (worksModalEyebrow) worksModalEyebrow.textContent = categoryLabel || '';
  worksModalTitle.textContent = project.name;
  worksModalImg.src = project.image || '';
  worksModalImg.alt = project.name || '';

  worksModalDesc.replaceChildren();
  if (project.type) {
    const lead = document.createElement('p');
    lead.className = 'works-modal-lead';
    lead.textContent = project.type;
    worksModalDesc.appendChild(lead);
  }
  // Description can be HTML string (from RichEditor) or array of strings
  if (typeof project.description === 'string') {
    const div = document.createElement('div');
    div.innerHTML = project.description;
    worksModalDesc.appendChild(div);
  } else if (Array.isArray(project.description)) {
    project.description.forEach(text => {
      const p = document.createElement('p');
      p.textContent = text;
      worksModalDesc.appendChild(p);
    });
  }

  worksModalFeatures.replaceChildren(...(project.features || []).map(f => {
    const span = document.createElement('span');
    span.textContent = f;
    return span;
  }));

  worksModalEl.hidden = false;
  document.body.classList.add('modal-open');
  requestAnimationFrame(() => worksModalEl.classList.add('active'));
}

if (worksModalCloseBtn) worksModalCloseBtn.addEventListener('click', closeWorksModal);
if (worksModalEl) {
  worksModalEl.addEventListener('click', event => {
    if (event.target === worksModalEl) closeWorksModal();
  });
}

document.addEventListener('keydown', event => {
  if (event.key !== 'Escape') return;
  if (!serviceModal.hidden) {
    closeServiceModal();
    return;
  }
  if (worksModalEl && !worksModalEl.hidden) closeWorksModal();
});

// ===== Our Works — portfolio carousel =====
const worksIcons = {
  cart: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 6h15l-1.5 9H8L6 6z"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/><path d="M6 6L5 3H2"/></svg>',
  food: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 11h16M6 11V8a6 6 0 0112 0v3"/><path d="M8 21h8"/></svg>',
  clinic: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 5v14M5 12h14"/><circle cx="12" cy="12" r="9"/></svg>',
  building: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="3" width="16" height="18" rx="1"/><path d="M9 7h1M9 11h1M9 15h1M14 7h1M14 11h1M14 15h1"/></svg>',
  brand: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M8 12h8M12 8v8"/></svg>',
  ui: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M8 20h8"/></svg>',
  dashboard: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="8" height="8" rx="1"/><rect x="13" y="3" width="8" height="5" rx="1"/><rect x="13" y="10" width="8" height="11" rx="1"/><rect x="3" y="13" width="8" height="8" rx="1"/></svg>'
};

const worksCategories = [
  { id: 'ecommerce', label: 'نتائج الحملات الإعلانية', icon: 'cart' },
  { id: 'restaurants', label: 'نتائج السوشيال ميديا', icon: 'food' },
  { id: 'systems', label: 'نتائج محركات البحث', icon: 'dashboard' }
];

// Works data loaded from database
const worksData = window.__WELCOME__?.worksData ?? {};

const worksFiltersEl = document.getElementById('worksFilters');
const worksTrackEl = document.getElementById('worksTrack');
const worksViewportEl = document.getElementById('worksViewport');
const worksDotsEl = document.getElementById('worksDots');
const worksPrevBtn = document.getElementById('worksPrev');
const worksNextBtn = document.getElementById('worksNext');

if (worksFiltersEl && worksTrackEl) {
  let worksCategory = 'ecommerce';
  let worksIndex = 0;
  let worksSwitchTimer = null;

  function buildWorksCard(project, i) {
    const feats = (project.features || []).map(f => `<span>${f}</span>`).join('');
    const hasImage = Boolean(project.image);
    const previewClass = `works-preview works-preview--${project.theme}${hasImage ? ' works-preview--has-image' : ''}`;
    const imageHtml = hasImage
      ? `<img class="works-preview-img" src="${project.image}" alt="${project.name}" loading="lazy" decoding="async">`
      : '';
    return `
      <article class="works-card" data-index="${i}" tabindex="0" role="button" aria-haspopup="dialog" aria-label="عرض تفاصيل ${project.name}">
        <div class="works-frame">
          <div class="${previewClass}">
            ${imageHtml}
            <div class="works-preview-ui">
              <div class="works-preview-bar"><span></span><span></span><span></span></div>
              <p class="works-preview-brand">${project.name}</p>
              <p class="works-preview-tag">${project.type || ''}</p>
              <button type="button" class="works-preview-cta" tabindex="-1">${project.cta || ''}</button>
              <div class="works-preview-features">${feats}</div>
            </div>
          </div>
        </div>
        <div class="works-card-meta">
          <h4>${project.name}</h4>
          <span>${project.type || ''}</span>
        </div>
      </article>`;
  }

  function renderWorksFilters() {
    worksFiltersEl.innerHTML = worksCategories.map(cat => `
      <button type="button" class="works-filter${cat.id === worksCategory ? ' active' : ''}"
        data-category="${cat.id}" role="tab" aria-selected="${cat.id === worksCategory}">
        ${worksIcons[cat.icon]}${cat.label}
      </button>`).join('');
  }

  function renderWorksSlides() {
    const projects = worksData[worksCategory] || [];
    worksIndex = Math.min(worksIndex, Math.max(0, projects.length - 1));
    worksTrackEl.innerHTML = projects.map(buildWorksCard).join('');
    worksDotsEl.innerHTML = projects.map((_, i) =>
      `<button type="button" class="works-dot${i === worksIndex ? ' active' : ''}" data-index="${i}" aria-label="المشروع ${i + 1}"></button>`
    ).join('');
    requestAnimationFrame(() => {
      requestAnimationFrame(updateWorksCarousel);
    });
  }

  function updateWorksCarousel() {
    const cards = worksTrackEl.querySelectorAll('.works-card');
    const projects = worksData[worksCategory] || [];
    if (!cards.length) return;

    cards.forEach((card, i) => {
      card.classList.toggle('is-active', i === worksIndex);
    });

    worksDotsEl.querySelectorAll('.works-dot').forEach((dot, i) => {
      dot.classList.toggle('active', i === worksIndex);
    });

    worksFiltersEl.querySelectorAll('.works-filter').forEach(btn => {
      const on = btn.dataset.category === worksCategory;
      btn.classList.toggle('active', on);
      btn.setAttribute('aria-selected', on);
    });

    const active = cards[worksIndex];
    const offset = active.offsetLeft - (worksViewportEl.offsetWidth / 2) + (active.offsetWidth / 2);
    worksTrackEl.style.transform = `translateX(${-offset}px)`;

    worksPrevBtn.disabled = worksIndex <= 0;
    worksNextBtn.disabled = worksIndex >= projects.length - 1;
  }

  function goWorks(dir) {
    const total = (worksData[worksCategory] || []).length;
    const next = worksIndex + dir;
    if (next < 0 || next >= total) return;
    worksIndex = next;
    updateWorksCarousel();
  }

  function switchWorksCategory(cat) {
    if (cat === worksCategory) return;
    worksCategory = cat;
    worksIndex = 0;
    worksViewportEl.classList.add('is-switching');
    clearTimeout(worksSwitchTimer);
    worksSwitchTimer = setTimeout(() => {
      renderWorksFilters();
      renderWorksSlides();
      worksViewportEl.classList.remove('is-switching');
    }, 320);
  }

  renderWorksFilters();
  renderWorksSlides();

  worksFiltersEl.addEventListener('click', e => {
    const btn = e.target.closest('.works-filter');
    if (btn) switchWorksCategory(btn.dataset.category);
  });

  worksPrevBtn.addEventListener('click', () => goWorks(-1));
  worksNextBtn.addEventListener('click', () => goWorks(1));

  worksDotsEl.addEventListener('click', e => {
    const dot = e.target.closest('.works-dot');
    if (!dot) return;
    worksIndex = Number(dot.dataset.index);
    updateWorksCarousel();
  });

  worksTrackEl.addEventListener('click', e => {
    const card = e.target.closest('.works-card');
    if (!card) return;
    worksIndex = Number(card.dataset.index);
    updateWorksCarousel();
    const project = (worksData[worksCategory] || [])[worksIndex];
    const cat = worksCategories.find(c => c.id === worksCategory);
    if (project) openWorksModal(project, cat ? cat.label : '');
  });

  worksTrackEl.addEventListener('keydown', e => {
    const card = e.target.closest('.works-card');
    if (!card || (e.key !== 'Enter' && e.key !== ' ')) return;
    e.preventDefault();
    worksIndex = Number(card.dataset.index);
    updateWorksCarousel();
    const project = (worksData[worksCategory] || [])[worksIndex];
    const cat = worksCategories.find(c => c.id === worksCategory);
    if (project) openWorksModal(project, cat ? cat.label : '');
  });

  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(updateWorksCarousel, 120);
  });
}

// ===== Hero images — auto-changing swiper =====
(function initHeroImagesSwiper() {
  const swiperEl = document.querySelector('.hero-images-swiper');
  if (!swiperEl || typeof Swiper === 'undefined') return;

  const slideCount = swiperEl.querySelectorAll('.swiper-slide').length;
  if (slideCount <= 1) return;

  const paginationEl = swiperEl.querySelector('.hero-images-pagination');

  new Swiper(swiperEl, {
    slidesPerView: 1,
    spaceBetween: 0,
    grabCursor: true,
    rtl: document.documentElement.dir === 'rtl',
    loop: slideCount > 2,
    rewind: slideCount === 2,
    speed: 900,
    watchOverflow: true,
    effect: 'fade',
    fadeEffect: { crossFade: true },
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    pagination: paginationEl
      ? {
          el: paginationEl,
          clickable: true,
        }
      : undefined,
  });
})();

// ===== Hero partners — marquee swiper on line below dashboard =====
(function initHeroPartnersSwiper() {
  const swiperEl = document.querySelector('.hero-partners-swiper');
  if (!swiperEl || typeof Swiper === 'undefined') return;

  const slideCount = swiperEl.querySelectorAll('.swiper-slide').length;
  if (slideCount === 0) return;

  const loop = slideCount >= 3;

  new Swiper(swiperEl, {
    slidesPerView: 'auto',
    spaceBetween: 12,
    loop,
    loopAdditionalSlides: loop ? Math.min(slideCount, 12) : 0,
    speed: 8500,
    grabCursor: true,
    allowTouchMove: true,
    watchOverflow: true,
    rtl: document.documentElement.dir === 'rtl',
    initialSlide: 0,
    centeredSlides: false,
    autoplay: loop
      ? {
          delay: 0,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        }
      : {
          delay: 2800,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        },
    freeMode: loop
      ? {
          enabled: true,
          momentum: false,
        }
      : false,
    breakpoints: {
      768: { spaceBetween: 14 },
      1200: { spaceBetween: 16 },
    },
  });
})();

// ===== Partners — marquee swipers (LTR rows, alternate direction) =====
(function initPartnersSwipers() {
  const swipers = document.querySelectorAll('.partners-swiper');
  if (!swipers.length || typeof Swiper === 'undefined') return;

  swipers.forEach((el) => {
    const slideCount = el.querySelectorAll('.swiper-slide').length;
    if (slideCount === 0) return;

    const reverse = el.dataset.reverse === '1';
    const loop = slideCount >= 3;
    const rowNum = parseInt(el.className.match(/partners-swiper--row-(\d+)/)?.[1] || '1', 10);
    const rowSpeed = 7500 + (rowNum - 1) * 2000;

    new Swiper(el, {
      slidesPerView: 'auto',
      spaceBetween: 12,
      loop,
      loopAdditionalSlides: loop ? slideCount : 0,
      speed: rowSpeed,
      grabCursor: true,
      allowTouchMove: true,
      watchOverflow: true,
      rtl: false,
      initialSlide: 0,
      centeredSlides: false,
      autoplay: loop
        ? {
            delay: 0,
            disableOnInteraction: false,
            reverseDirection: reverse,
            pauseOnMouseEnter: true,
          }
        : {
            delay: 2800,
            disableOnInteraction: false,
            reverseDirection: reverse,
            pauseOnMouseEnter: true,
          },
      freeMode: loop
        ? {
            enabled: true,
            momentum: false,
          }
        : false,
      breakpoints: {
        768: {
          spaceBetween: 14,
        },
        1200: {
          spaceBetween: 16,
        },
      },
    });
  });
})();

// ===== Testimonials — Swiper (4 slides on desktop, full image fit) =====
(function initTestimonialsSwiper() {
  const swiperEl = document.querySelector('.testimonials-swiper');
  if (!swiperEl || typeof Swiper === 'undefined') return;

  const slideCount = swiperEl.querySelectorAll('.swiper-slide').length;

  const swiper = new Swiper(swiperEl, {
    slidesPerView: 1,
    spaceBetween: 16,
    grabCursor: true,
    rtl: document.documentElement.dir === 'rtl',
    loop: slideCount > 4,
    watchOverflow: true,
    navigation: {
      nextEl: '.testimonials-next',
      prevEl: '.testimonials-prev',
    },
    pagination: {
      el: '.testimonials-pagination',
      clickable: true,
    },
    breakpoints: {
      560: {
        slidesPerView: 2,
        spaceBetween: 16,
      },
      900: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 24,
      },
    },
  });

  swiperEl.querySelectorAll('.testimonial-slide-media img').forEach((img) => {
    const refresh = () => swiper.update();
    if (img.complete) refresh();
    else img.addEventListener('load', refresh, { once: true });
  });
})();
