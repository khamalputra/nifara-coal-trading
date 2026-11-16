/* *
 * PT. NIFARA COAL TRADING - Interactive Controller & Animations (website_v2)
 * Features:
 * - Scroll-Driven Header Progress Bar
 * - Mobile Off-Canvas Drawer with Touch Ergonomics
 * - IntersectionObserver Staggered Scroll Reveals
 * - Interactive Animated Number Counters
 * - Live Interactive RFQ Estimator Calculator
 * - Interactive Coal Grade Filter Pills
 * - Bilingual (ID/EN) Runtime State Manager
 * - High-Resolution Legal Document Lightbox Modal */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Legal Documents Data Store (Full verified data from the company dossier)
  const LEGAL_DOCS = {
    akta: {
      title: { id: "Akta Pendirian Perseroan Terbatas", en: "Deed of Company Establishment" },
      subtitle: { id: "Akta Notaris No. 08, 21 Agustus 2026", en: "Notarial Deed No. 08, 21 August 2026" },
      desc: { 
        id: "Salinan Akta Pendirian Perseroan Terbatas PT. NIFARA COAL TRADING yang disahkan di hadapan Notaris resmi.",
        en: "Official copy of the Deed of Establishment of PT. NIFARA COAL TRADING executed before an accredited public notary."
      },
      img: "assets/images/akta.jpg",
      specs: [
        { label: { id: "Nomor Akta", en: "Deed Number" }, val: "08" },
        { label: { id: "Tanggal Akta", en: "Date" }, val: "21 Agustus 2026" },
        { label: { id: "Notaris", en: "Notary Public" }, val: "Echo Pratama, S.H., M.Kn." },
        { label: { id: "SK Notaris", en: "Notary Decree" }, val: "AHU-02670.AH.02.01 Tahun 2023" },
        { label: { id: "Kedudukan Notaris", en: "Domicile" }, val: "Kab. Sijunjung, Sumatera Barat" }
      ]
    },
    sk: {
      title: { id: "Pengesahan Badan Hukum Perseroan", en: "Decree of Legal Entity Approval" },
      subtitle: { id: "SK Menkumham RI No. AHU-0068094.AH.01.01.Tahun 2026", en: "Ministry of Law Decree AHU-0068094.AH.01.01.Tahun 2026" },
      desc: { 
        id: "Keputusan Menteri Hukum Republik Indonesia tentang Pengesahan Pendirian Badan Hukum PT NIFARA COAL TRADING.",
        en: "Official Decree of the Minister of Law of the Republic of Indonesia approving the establishment of PT NIFARA COAL TRADING."
      },
      img: "assets/images/pengesahan.jpg",
      specs: [
        { label: { id: "Nomor Keputusan", en: "Decree Number" }, val: "AHU-0068094.AH.01.01.Tahun 2026" },
        { label: { id: "Tanggal Pengesahan", en: "Approval Date" }, val: "24 Agustus 2026" },
        { label: { id: "Daftar Perseroan", en: "Company Registry" }, val: "AHU-0211918.AH.01.11.Tahun 2026" },
        { label: { id: "Jenis Perseroan", en: "Company Entity" }, val: "Perseroan Terbatas Swasta Nasional" },
        { label: { id: "Kedudukan Hukum", en: "Legal Domicile" }, val: "Kota Payakumbuh, Sumatera Barat" }
      ]
    },
    modal: {
      title: { id: "Struktur Modal & Kepemilikan Saham", en: "Capital Structure & Shareholding" },
      subtitle: { id: "Modal Ditempatkan Rp 1.000.000.000 (100% Disetor Penuh)", en: "Issued Capital IDR 1,000,000,000 (Fully Paid)" },
      desc: { 
        id: "Lampiran resmi Kemenkumham RI yang mencantumkan susunan modal perseroan dan pemegang saham dewan komisaris dan direksi.",
        en: "Official appendix from the Ministry of Law detailing company capital structure, director, and commissioner equity."
      },
      img: "assets/images/lampiran.jpg",
      specs: [
        { label: { id: "Modal Dasar", en: "Authorized Capital" }, val: "Rp 1.000.000.000 (Satu Miliar Rupiah)" },
        { label: { id: "Modal Ditempatkan / Disetor", en: "Issued & Paid Capital" }, val: "Rp 1.000.000.000" },
        { label: { id: "Komisaris (95%)", en: "Commissioner (95%)" }, val: "Niha Meisya Maharani (950 lembar / Rp 950 Juta)" },
        { label: { id: "Direktur (5%)", en: "Director (5%)" }, val: "Rizki Abdian Putra (50 lembar / Rp 50 Juta)" }
      ]
    },
    nib: {
      title: { id: "Nomor Induk Berusaha (NIB)", en: "Business Identification Number (NIB)" },
      subtitle: { id: "NIB: 3108260031993 - Perizinan Berbasis Risiko OSS", en: "NIB: 3108260031993 - Risk-Based OSS Certification" },
      desc: { 
        id: "Identitas pelaku usaha nasional yang diterbitkan oleh Kementerian Investasi/BKPM melalui sistem OSS RBA.",
        en: "Official enterprise identification and operating credential issued by the Ministry of Investment / BKPM."
      },
      img: "assets/images/nib.jpg",
      specs: [
        { label: { id: "Nomor NIB", en: "NIB Number" }, val: "3108260031993" },
        { label: { id: "Tanggal Terbit", en: "Issued Date" }, val: "31 Agustus 2026" },
        { label: { id: "NPWP Perusahaan", en: "Corporate Tax ID" }, val: "1000000010896416" },
        { label: { id: "Status Penanaman Modal", en: "Investment Status" }, val: "PMDN (Penanaman Modal Dalam Negeri)" },
        { label: { id: "Hak Akses Kepabeanan", en: "Customs Access" }, val: "Terdaftar Resmi untuk Ekspor & Impor" }
      ]
    },
    izin: {
      title: { id: "Izin Usaha Pengangkutan & Penjualan Batubara", en: "Coal Transport & Sales License" },
      subtitle: { id: "Izin No: 31082600319930002 | KBLI 46710", en: "License: 31082600319930002 | KBLI 46710" },
      desc: { 
        id: "Lisensi operasional primer dari Kementerian ESDM & Investasi RI untuk mendistribusikan, mengangkut, dan memperdagangkan batubara.",
        en: "Primary operational license issued under Ministry of Energy & Mineral Resources authority for coal transportation and trading."
      },
      img: "assets/images/izin.jpg",
      specs: [
        { label: { id: "Nomor Izin Operasional", en: "License Number" }, val: "31082600319930002" },
        { label: { id: "Klasifikasi Baku (KBLI)", en: "Business Classification" }, val: "46710 (Perdagangan Besar Bahan Bakar Padat/Batubara)" },
        { label: { id: "Status Izin", en: "Operational Status" }, val: "Telah Memenuhi Persyaratan (Active & Verified)" },
        { label: { id: "Tanggal Penetapan", en: "Effective Date" }, val: "6 November 2026" },
        { label: { id: "Kantor Operasional", en: "Branch Office" }, val: "Jl. Letjen M.T. Haryono Kav. 10 GF A4/A, Jakarta Timur" }
      ]
    },
    npwp: {
      title: { id: "Surat Keterangan Terdaftar Wajib Pajak (NPWP)", en: "Corporate Tax Registration Certificate" },
      subtitle: { id: "NPWP Badan: 1000000010896416 | KPP Pratama Payakumbuh", en: "Tax ID: 1000000010896416 | Tax Office Payakumbuh" },
      desc: { 
        id: "Surat Keterangan Terdaftar (SKT) dari Direktorat Jenderal Pajak Kementerian Keuangan Republik Indonesia.",
        en: "Official tax registry credential issued by the Directorate General of Taxes, Ministry of Finance RI."
      },
      img: "assets/images/npwp.jpg",
      specs: [
        { label: { id: "Nomor SKT Pajak", en: "Tax Certificate No." }, val: "S-20631/SKT-WP/CT/KPP.2705/2026" },
        { label: { id: "Nomor Pokok Wajib Pajak", en: "Tax ID (NPWP)" }, val: "1000000010896416" },
        { label: { id: "Jenis Wajib Pajak", en: "Taxpayer Category" }, val: "Badan Hukum Perseroan Terbatas" },
        { label: { id: "KPP Terdaftar", en: "Tax District Office" }, val: "KPP Pratama Payakumbuh, Sumatera Barat" },
        { label: { id: "Terdaftar Sejak", en: "Registered Date" }, val: "24 Agustus 2026" }
      ]
    },
    dukungan: {
      title: { id: "Surat Dukungan Pasokan Tambang Resmi", en: "Official Mine Supply Support Letter" },
      subtitle: { id: "PT. Seluma Prima Coal - IUP OP No. 44/1/IUP/PMA/2016", en: "PT. Seluma Prima Coal - IUP OP No. 44/1/IUP/PMA/2016" },
      desc: { 
        id: "Komitmen jaminan alokasi pasokan batubara resmi sebesar 10.000 Metric Ton (MT) dari produsen tambang pemegang IUP OP seluas 1.116 Ha.",
        en: "Binding supply commitment letter allocating 10,000 Metric Tons of coal production from an active 1,116-hectare concession holder."
      },
      img: "assets/images/dukungan.jpg",
      specs: [
        { label: { id: "Nomor Surat", en: "Letter Reference" }, val: "119/SPC-MD/XI/2026" },
        { label: { id: "Pemberi Dukungan", en: "Mine Producer" }, val: "PT. Seluma Prima Coal (Gedung Menara Duta, Kuningan Jakarta)" },
        { label: { id: "Legalitas Tambang", en: "Mining Concession" }, val: "IUP OP No. 44/1/IUP/PMA/2016 (Luas 1.116 Hektar)" },
        { label: { id: "Volume Dukungan", en: "Allocated Volume" }, val: "10.000 MT (November - Desember 2026)" },
        { label: { id: "Penandatangan", en: "Signatory Authority" }, val: "Syaidil Imron, Kepala Teknik Tambang (KTT)" }
      ]
    }
  };

  // 2. Bilingual Translation Dictionary
  let currentLang = localStorage.getItem('nifara_lang') || 'id';

  const applyLanguage = (lang) => {
    currentLang = lang;
    localStorage.setItem('nifara_lang', lang);
    document.documentElement.lang = lang;

    document.querySelectorAll('.lang-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.lang === lang);
    });

    document.querySelectorAll('[data-i18n]').forEach(el => {
      const key = el.dataset.i18n;
      if (TRANSLATIONS[lang] && TRANSLATIONS[lang][key]) {
        el.innerHTML = TRANSLATIONS[lang][key];
      }
    });

    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
      const key = el.dataset.i18nPlaceholder;
      if (TRANSLATIONS[lang] && TRANSLATIONS[lang][key]) {
        el.setAttribute('placeholder', TRANSLATIONS[lang][key]);
      }
    });
  };

  // 3. Scroll Progress Indicator & Header Scroll Glass Effect
  const header = document.querySelector('.site-header');
  const scrollTopBtn = document.getElementById('scrollTopBtn');
  const scrollProgressBar = document.getElementById('scrollProgressBar');

  const onScroll = () => {
    const scrollY = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = docHeight > 0 ? (scrollY / docHeight) * 100 : 0;

    if (scrollProgressBar) {
      scrollProgressBar.style.width = `${progress}%`;
    }

    if (scrollY > 50) {
      header?.classList.add('scrolled');
      scrollTopBtn?.classList.add('visible');
    } else {
      header?.classList.remove('scrolled');
      scrollTopBtn?.classList.remove('visible');
    }
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  scrollTopBtn?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // 4. Mobile Navigation Drawer (Sleek Off-Canvas)
  const mobileToggle = document.getElementById('mobileToggle');
  const mobileDrawer = document.getElementById('mobileDrawer');
  const mobileBackdrop = document.getElementById('mobileBackdrop');
  const mobileDrawerClose = document.getElementById('mobileDrawerClose');

  const openMobileMenu = () => {
    mobileToggle?.classList.add('is-active');
    mobileDrawer?.classList.add('open');
    mobileBackdrop?.classList.add('open');
    document.body.style.overflow = 'hidden';
  };

  const closeMobileMenu = () => {
    mobileToggle?.classList.remove('is-active');
    mobileDrawer?.classList.remove('open');
    mobileBackdrop?.classList.remove('open');
    document.body.style.overflow = '';
  };

  mobileToggle?.addEventListener('click', () => {
    if (mobileDrawer?.classList.contains('open')) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  });

  mobileDrawerClose?.addEventListener('click', closeMobileMenu);
  mobileBackdrop?.addEventListener('click', closeMobileMenu);

  document.querySelectorAll('.mobile-drawer-links a, .mobile-drawer-footer a').forEach(link => {
    link.addEventListener('click', closeMobileMenu);
  });

  // 5. IntersectionObserver Scroll Reveals
  const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
  if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, {
      root: null,
      threshold: 0.15,
      rootMargin: '0px 0px -40px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));
  } else {
    revealElements.forEach(el => el.classList.add('is-visible'));
  }

  // 6. Interactive Animated Number Counters
  const countElements = document.querySelectorAll('[data-counter]');
  let counted = false;

  const runCounter = () => {
    countElements.forEach(el => {
      const target = parseFloat(el.dataset.counter);
      const prefix = el.dataset.counterPrefix || '';
      const suffix = el.dataset.counterSuffix || '';
      const decimals = parseInt(el.dataset.counterDecimals || '0');
      const duration = 1800;
      const startTime = performance.now();

      const updateCount = (currentTime) => {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        // Easing: easeOutExpo
        const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
        const currentVal = target * ease;

        const formatted = decimals > 0 
          ? currentVal.toFixed(decimals).replace('.', ',')
          : Math.floor(currentVal).toLocaleString('id-ID');

        el.textContent = `${prefix}${formatted}${suffix}`;

        if (progress < 1) {
          requestAnimationFrame(updateCount);
        } else {
          const finalFormatted = decimals > 0 
            ? target.toFixed(decimals).replace('.', ',')
            : target.toLocaleString('id-ID');
          el.textContent = `${prefix}${finalFormatted}${suffix}`;
        }
      };

      requestAnimationFrame(updateCount);
    });
  };

  const statsSection = document.querySelector('.hero-stats');
  if (statsSection && 'IntersectionObserver' in window) {
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !counted) {
          counted = true;
          runCounter();
        }
      });
    }, { threshold: 0.2 });
    statsObserver.observe(statsSection);
  } else {
    runCounter();
  }

  // 7. Interactive Coal Spec Matrix Tabs / Filters
  const filterPills = document.querySelectorAll('.spec-filter-pill');
  const specRows = document.querySelectorAll('.spec-table tbody tr');

  filterPills.forEach(pill => {
    pill.addEventListener('click', () => {
      filterPills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');

      const filter = pill.dataset.filter;
      specRows.forEach(row => {
        if (filter === 'all' || row.dataset.category === filter) {
          row.style.display = '';
          row.classList.add('active-highlight');
          setTimeout(() => row.classList.remove('active-highlight'), 600);
        } else {
          row.style.display = 'none';
        }
      });
    });
  });

  // 8. Live Interactive RFQ Estimator Calculator
  const rfqVolume = document.getElementById('volume');
  const rfqSpec = document.getElementById('spec');
  const rfqIncoterms = document.getElementById('incoterms');
  const rfqEstimatorBox = document.getElementById('rfqEstimator');
  const estimatorText = document.getElementById('estimatorText');

  const updateRFQEstimate = () => {
    const vol = parseInt(rfqVolume?.value || '0');
    const spec = rfqSpec?.value || '';
    const incoterm = rfqIncoterms?.value || 'FOB Barge';

    if (!vol) {
      if (rfqEstimatorBox) rfqEstimatorBox.style.display = 'none';
      return;
    }

    if (rfqEstimatorBox) rfqEstimatorBox.style.display = 'flex';

    let barges = Math.ceil(vol / 7500);
    let timeframe = vol <= 10000 ? "5 - 10 Hari Kerja" : (vol <= 30000 ? "10 - 20 Hari Kerja" : "Sesuai Jadwal MV / Kontrak");
    let coa = "Carsurin / Sucofindo / Surveyor Indonesia";

    let msg = "";
    if (currentLang === 'id') {
      msg = `Estimasi Kebutuhan: <strong>${barges}x Armada Tongkang 300ft</strong> (~${vol.toLocaleString('id-ID')} MT) | Mode: <strong>${incoterm}</strong> | Turnaround: <strong>${timeframe}</strong> | Laboratorium COA: <strong>${coa}</strong>`;
    } else {
      msg = `Estimated Allocation: <strong>${barges}x 300ft Barges</strong> (~${vol.toLocaleString('en-US')} MT) | Terms: <strong>${incoterm}</strong> | Lead Time: <strong>${timeframe}</strong> | Accredited COA: <strong>${coa}</strong>`;
    }

    if (estimatorText) estimatorText.innerHTML = msg;
  };

  rfqVolume?.addEventListener('change', updateRFQEstimate);
  rfqSpec?.addEventListener('change', updateRFQEstimate);
  rfqIncoterms?.addEventListener('change', updateRFQEstimate);

  // 9. Interactive RFQ Form Submission Handler (Multichannel Lead Routing)
  const rfqForm = document.getElementById('rfqForm');
  const inquiryModal = document.getElementById('inquiryModal');
  const inquiryModalClose = document.getElementById('inquiryModalClose');
  const inquirySummaryText = document.getElementById('inquirySummaryText');
  const inquirySendWhatsApp = document.getElementById('inquirySendWhatsApp');
  const inquirySendEmail = document.getElementById('inquirySendEmail');
  const inquiryCopyText = document.getElementById('inquiryCopyText');
  const toastNotice = document.getElementById('toastNotice');
  const toastNoticeMsg = document.getElementById('toastNoticeMsg');

  let activeInquiryText = '';

  const triggerToast = (msg) => {
    if (!toastNotice) return;
    if (toastNoticeMsg) toastNoticeMsg.textContent = msg;
    toastNotice.classList.add('show');
    setTimeout(() => toastNotice.classList.remove('show'), 3500);
  };

  const closeInquiryModal = () => {
    inquiryModal?.classList.remove('active');
    document.body.style.overflow = '';
  };

  inquiryModalClose?.addEventListener('click', closeInquiryModal);
  inquiryModal?.addEventListener('click', (e) => {
    if (e.target === inquiryModal) closeInquiryModal();
  });

  rfqForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(rfqForm);
    const data = Object.fromEntries(formData.entries());

    const summaryPlain = `PERMINTAAN PENAWARAN (INQUIRY / RFQ) - PT. NIFARA COAL TRADING\n` +
      `============================================================\n` +
      `Nama / PIC          : ${data.name}\n` +
      `Nama Perusahaan     : ${data.company || '-'}\n` +
      `Alamat Email        : ${data.email}\n` +
      `Nomor Kontak / WA   : ${data.phone}\n` +
      `Estimasi Kebutuhan  : ${parseInt(data.volume || '0').toLocaleString('id-ID')} MT\n` +
      `Spesifikasi Batubara: ${data.spec}\n` +
      `Syarat Penyerahan   : ${data.incoterms}\n` +
      `Pelabuhan / Tujuan  : ${data.destination}\n` +
      `Catatan Tambahan    : ${data.notes || '-'}\n` +
      `============================================================`;

    activeInquiryText = summaryPlain;
    if (inquirySummaryText) inquirySummaryText.textContent = summaryPlain;

    const waText = `*PERMINTAAN PENAWARAN BATUBARA (RFQ)*%0A%0A` +
      `*Nama / PIC:* ${encodeURIComponent(data.name)}%0A` +
      `*Perusahaan:* ${encodeURIComponent(data.company || '-')}%0A` +
      `*Email:* ${encodeURIComponent(data.email)}%0A` +
      `*No. Telepon / WA:* ${encodeURIComponent(data.phone)}%0A` +
      `*Estimasi Volume:* ${encodeURIComponent(data.volume)} MT%0A` +
      `*Spesifikasi Batubara:* ${encodeURIComponent(data.spec)}%0A` +
      `*Syarat Pengiriman (Incoterms):* ${encodeURIComponent(data.incoterms)}%0A` +
      `*Pelabuhan / Negara Tujuan:* ${encodeURIComponent(data.destination)}%0A` +
      `*Catatan Tambahan:* ${encodeURIComponent(data.notes || '-')}`;

    const waUrl = `https://wa.me/6281280093234?text=${waText}`;
    if (inquirySendWhatsApp) inquirySendWhatsApp.href = waUrl;

    const emailSubject = encodeURIComponent(`Permintaan Penawaran Pasokan Batubara - ${data.company || data.name}`);
    const emailBody = encodeURIComponent(summaryPlain);
    if (inquirySendEmail) inquirySendEmail.href = `mailto:nifaracoaltrading@gmail.com?subject=${emailSubject}&body=${emailBody}`;

    if (inquiryModal) {
      inquiryModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  });

  inquiryCopyText?.addEventListener('click', () => {
    if (!activeInquiryText) return;
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(activeInquiryText).then(() => {
        triggerToast(currentLang === 'id' ? 'Rincian penawaran disalin ke clipboard!' : 'Quotation details copied to clipboard!');
      });
    } else {
      triggerToast(currentLang === 'id' ? 'Rincian siap dikirim.' : 'Details ready to send.');
    }
  });

  // 10. Document Lightbox Modal System
  const docModal = document.getElementById('docModal');
  const modalClose = document.getElementById('modalClose');
  const modalImg = document.getElementById('modalImg');
  const modalTitle = document.getElementById('modalTitle');
  const modalSubtitle = document.getElementById('modalSubtitle');
  const modalDesc = document.getElementById('modalDesc');
  const modalSpecs = document.getElementById('modalSpecs');

  window.openDocModal = (docId) => {
    const doc = LEGAL_DOCS[docId];
    if (!doc) return;

    modalImg.src = doc.img;
    modalImg.alt = doc.title[currentLang];
    modalTitle.textContent = doc.title[currentLang];
    modalSubtitle.textContent = doc.subtitle[currentLang];
    modalDesc.textContent = doc.desc[currentLang];

    modalSpecs.innerHTML = '';
    doc.specs.forEach(spec => {
      const li = document.createElement('li');
      li.innerHTML = `<span class="lbl">${spec.label[currentLang]}:</span><span class="val">${spec.val}</span>`;
      modalSpecs.appendChild(li);
    });

    docModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  };

  const closeDocModal = () => {
    docModal?.classList.remove('active');
    document.body.style.overflow = '';
  };

  modalClose?.addEventListener('click', closeDocModal);
  docModal?.addEventListener('click', (e) => {
    if (e.target === docModal) closeDocModal();
  });

  // Escape key closes modals & drawer
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeDocModal();
      closeInquiryModal();
      closeMobileMenu();
    }
  });

  document.querySelectorAll('[data-doc-id]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      openDocModal(btn.dataset.docId);
    });
  });

  // 11. Interactive FAQ Accordion
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const trigger = item.querySelector('.faq-trigger');
    trigger?.addEventListener('click', () => {
      const isActive = item.classList.contains('active');
      faqItems.forEach(other => {
        other.classList.remove('active');
        other.querySelector('.faq-trigger')?.setAttribute('aria-expanded', 'false');
      });
      if (!isActive) {
        item.classList.add('active');
        trigger.setAttribute('aria-expanded', 'true');
      }
    });
  });

  // 12. Scrollspy Active Navigation Tracking
  const sections = document.querySelectorAll('section[id], header[id]');
  const navLinks = document.querySelectorAll('.nav-links .nav-link, .mobile-drawer-links a');

  const onScrollspy = () => {
    const scrollPosition = window.scrollY + 160;

    sections.forEach(sec => {
      const top = sec.offsetTop;
      const height = sec.offsetHeight;
      const id = sec.getAttribute('id');

      if (scrollPosition >= top && scrollPosition < top + height) {
        navLinks.forEach(link => {
          if (link.getAttribute('href') === `#${id}`) {
            link.classList.add('active');
          } else {
            link.classList.remove('active');
          }
        });
      }
    });
  };

  window.addEventListener('scroll', onScrollspy, { passive: true });

  // 13. Language Switcher Buttons
  document.querySelectorAll('.lang-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      applyLanguage(btn.dataset.lang);
      updateRFQEstimate();
    });
  });

  // Initialize
  applyLanguage(currentLang);
});

// Translation Data Dictionary
const TRANSLATIONS = {
  id: {
    nav_home: "Beranda",
    nav_about: "Tentang Kami",
    nav_leadership: "Manajemen",
    nav_legality: "Legalitas",
    nav_products: "Produk & Pasokan",
    nav_track_record: "Kemitraan",
    nav_news: "Berita",
    nav_contact: "Kontak",
    btn_rfq: "Minta Penawaran",

    hero_badge: "Eksportir & Pedagang Batubara Berizin Resmi",
    hero_title: "Mitra Terpercaya Solusi Energi & <span class='gold-text'>Perdagangan Batubara</span> Berkualitas",
    hero_subhead: "PT. Nifara Coal Trading menghadirkan kepastian pasokan batubara berkualitas tinggi dengan legalitas terverifikasi pemerintah, rantai pasok terintegrasi dari hulu ke hilir, serta komitmen kemitraan jangka panjang untuk pasar nasional dan internasional.",
    hero_cta_primary: "Ajukan Permintaan Pasokan",
    hero_cta_secondary: "Unduh E-Company Profile (PDF)",
    stat_vol_lbl: "Dukungan Pasokan Tambang",
    stat_concession_lbl: "Wilayah Konsesi IUP OP",
    stat_license_lbl: "Izin Angkut & Jual Batubara",
    stat_market_lbl: "Jangkauan Pasar Ekspor",

    about_eyebrow: "Mengenal Perusahaan",
    about_title: "Pilar Strategis Perdagangan Komoditas <span class='highlight'>Energi Nasional</span>",
    about_desc1: "PT. Nifara Coal Trading didirikan pada tahun 2026 di Payakumbuh, Sumatera Barat, sebagai respons atas lonjakan kebutuhan energi primer yang andal di pasar domestik dan kawasan regional Asia.",
    about_desc2: "Sebagai entitas berbadan hukum resmi yang memegang Izin Usaha Pengangkutan dan Penjualan Batubara, kami membangun ekosistem perdagangan yang transparan, tepat waktu, dan berstandar internasional mulai dari penambangan, logistik tongkang pelabuhan, hingga serah terima kepada pengguna akhir.",
    about_h1_title: "Legalitas Terverifikasi",
    about_h1_desc: "Memiliki NIB, SK Menkumham, dan Izin Sektoral Pengangkutan & Penjualan resmi.",
    about_h2_title: "Pasokan Terjamin",
    about_h2_desc: "Didukung langsung oleh produsen tambang pemegang IUP Operasi Produksi aktif.",
    about_badge_title: "Terdaftar Resmi",
    about_badge_desc: "OSS RBA No. 3108260031993",

    vm_vision_title: "Visi Perusahaan",
    vm_vision_text: "Menjadi perusahaan pengangkutan dan penjualan batubara independen terkemuka di Indonesia, menyediakan batubara berkualitas tinggi untuk pasar domestik maupun internasional, serta membangun kemitraan jangka panjang yang tepercaya dengan para pelanggan kami.",
    vm_mission_title: "Misi Strategis",
    vm_m1: "Memenuhi kebutuhan energi yang tumbuh pesat di Indonesia, khususnya dalam pengembangan pembangkit listrik dan sektor industri yang merupakan pilar krusial pembangunan sosial-ekonomi.",
    vm_m2: "Menciptakan lapangan kerja, memberdayakan talenta lokal, serta memajukan pendapatan masyarakat di daerah sentra pertambangan batubara.",
    vm_m3: "Mempraktikkan standar tata kelola kepatuhan hukum, integritas transaksi B2B yang tinggi, dan transparansi spesifikasi mutu komoditas.",

    lead_eyebrow: "Struktur Organisasi",
    lead_title: "Dipimpin oleh <span class='highlight'>Manajemen Berdedikasi</span> & Berintegritas",
    lead_desc: "Kepemimpinan PT. Nifara Coal Trading didukung oleh perpaduan visi strategis dan komitmen tata kelola korporat yang kokoh guna menjamin keamanan setiap transaksi bernilai tinggi.",
    role_comm: "Komisaris Utama",
    role_dir: "Direktur Utama",
    bio_comm: "Memegang peranan pengawasan strategis dan tata kelola perusahaan dengan kepemilikan 95% saham perseroan. Mengarahkan kebijakan makro investasi, perluasan pasar global, serta kepatuhan regulasi lingkungan dan keberlanjutan bisnis energi.",
    bio_dir: "Memimpin pelaksanaan operasional perdagangan, negosiasi pasokan tambang, kemitraan logistik tongkang, hingga distribusi ke end-user. Berpengalaman dalam menavigasi dinamika pasar komoditas mineral dan mengutamakan kepuasan klien B2B.",

    legal_eyebrow: "Transparansi & Kepatuhan",
    legal_title: "Legalitas & Perizinan <span class='highlight'>Terverifikasi Resmi</span>",
    legal_desc: "Seluruh instrumen hukum, akta pendirian, izin pengangkutan batubara, dan surat keterangan perpajakan kami terbuka dan dapat diverifikasi langsung pada basis data kementerian berkenaan.",
    legal_banner_text: "<strong>Komitmen Transparansi B2B:</strong> PT. Nifara Coal Trading beroperasi secara legal sesuai regulasi UU Minerba & OSS Berbasis Risiko Republik Indonesia.",

    prod_eyebrow: "Spesifikasi & Kapasitas",
    prod_title: "Portofolio Produk Batubara & <span class='highlight'>Rantai Pasok Handal</span>",
    prod_desc: "Kami menyalurkan batubara termal berkualitas dengan parameter kalori yang dapat disesuaikan untuk kebutuhan pembangkit listrik tenaga uap (PLTU), pabrik semen, peleburan smelter, dan industri manufaktur berat.",
    supply_eyebrow: "Alur Distribusi Hulu ke Hilir",
    supply_s1_title: "1. Sumber Tambang (Pit)",
    supply_s1_desc: "Batubara ditambang dari konsesi resmi IUP OP (PT. Seluma Prima Coal) dengan kontrol kualitas ketat sejak stripping hingga crushing.",
    supply_s2_title: "2. Hauling & Stockpile",
    supply_s2_desc: "Pengangkutan darat armada dump truck tertutup menuju dermaga/jetty dengan fasilitas blending dan stockpile teratur.",
    supply_s3_title: "3. Barging & Transhipment",
    supply_s3_desc: "Pemuatan ke tongkang (barge 300ft) dan transhipment ke Mother Vessel (MV) di anchorage point pelabuhan muat.",
    supply_s4_title: "4. Konsumen Akhir (Factory/PLTU)",
    supply_s4_desc: "Pengiriman tepat waktu dengan verifikasi Certificate of Sampling and Analysis (COA) dari surveyor independen terakreditasi.",

    track_eyebrow: "Dukungan Operasional",
    track_title: "Mitra Strategis & <span class='highlight'>Jaminan Alokasi Tambang</span>",
    track_desc: "Kemampuan suplai kami didukung oleh perjanjian pasokan tambang resmi yang mengikat secara hukum, menjamin kesinambungan volume pengiriman klien tanpa hambatan kuota.",

    rfq_eyebrow: "Mulai Kemitraan",
    rfq_title: "Formulir Permintaan <span class='highlight'>Penawaran Pasokan (RFQ)</span>",
    rfq_desc: "Silakan isi detail spesifikasi volume dan kebutuhan batubara Anda. Tim komersial kami akan merespons dalam waktu 1x24 jam dengan proposal penawaran harga terbaik.",

    news_eyebrow: "Wawasan & Pembaruan",
    news_title: "Berita & Publikasi <span class='highlight'>Agenda Perusahaan</span>",
    news_desc: "Informasi terkini mengenai dinamika pasar batubara, operasional pengapalan, dan kegiatan CSR PT. Nifara Coal Trading.",

    faq_eyebrow: "Pusat Informasi",
    faq_title: "Pertanyaan yang <span class='highlight'>Sering Diajukan</span>",
    faq_desc: "Panduan teknis dan informasi tata kelola perdagangan batubara untuk mempermudah proses due diligence tim procurement Anda.",
    faq_q1: "Berapa volume pemesanan minimal (Minimum Order Quantity / MOQ)?",
    faq_a1: "Untuk pengiriman tongkang domestik (FOB Barge), kuota minimal adalah 1 armada tongkang 300 feet (sekitar 7.500 – 8.000 MT). Untuk pengapalan ekspor Mother Vessel (FOB MV atau CIF), alokasi pesanan berkisar antara 30.000 hingga 55.000 MT per shipment.",
    faq_q2: "Lembaga surveyor independen mana yang menerbitkan Certificate of Sampling and Analysis (COA)?",
    faq_a2: "Setiap pengapalan disertai sertifikasi mutu resmi yang diterbitkan oleh laboratorium surveyor independen terakreditasi internasional seperti PT. Carsurin, PT. Sucofindo, atau PT. Surveyor Indonesia sesuai spesifikasi kontrak yang disepakati.",
    faq_q3: "Apa saja metode pembayaran (Payment Terms) yang dapat diterima?",
    faq_a3: "Kami menerima instrumen perbankan resmi yang lazim dalam perdagangan komoditas energi, antara lain Irrevocable Letter of Credit (L/C) at sight dari bank devisa terkemuka, SKBDN untuk transaksi domestik, serta skema termin bertahap (Cash Against Documents / Telegraphic Transfer) yang dituangkan dalam sales contract.",
    faq_q4: "Dari mana asal tambang batubara yang dipasok oleh PT. Nifara Coal Trading?",
    faq_a4: "Pasokan batubara kami berasal dari konsesi tambang resmi pemegang IUP Operasi Produksi aktif di wilayah Sumatera, didukung kemitraan terverifikasi dengan produsen seperti PT. Seluma Prima Coal (luas konsesi 1.116 Ha) dengan alokasi 10.000 MT/bulan serta tambang mitra terpercaya lainnya.",
    faq_q5: "Opsi penyerahan barang (Incoterms) apa saja yang dilayani?",
    faq_a5: "Kami melayani berbagai skema penyerahan komoditas sesuai kebutuhan logistik pembeli: Free on Board (FOB) Barge di pelabuhan muat, Free on Board (FOB) Mother Vessel di titik labuh transshipment, serta Cost, Insurance, and Freight (CIF) sampai ke pelabuhan bongkar tujuan pembeli di dalam maupun luar negeri.",

    footer_tagline: "Perusahaan Pengangkutan dan Penjualan Batubara Terpercaya di Indonesia. Menyediakan solusi pasokan energi andal untuk pasar domestik dan Asia.",
    footer_rights: "Hak Cipta Dilindungi Undang-Undang. PT. Nifara Coal Trading."
  },

  en: {
    nav_home: "Home",
    nav_about: "About Us",
    nav_leadership: "Management",
    nav_legality: "Compliance",
    nav_products: "Products & Supply",
    nav_track_record: "Partnership",
    nav_news: "News & Media",
    nav_contact: "Contact",
    btn_rfq: "Request Quotation",

    hero_badge: "Licensed Coal Transport & Trading Enterprise",
    hero_title: "Trusted Energy Partner for High-Grade <span class='gold-text'>Coal Supply & Trading</span>",
    hero_subhead: "PT. Nifara Coal Trading delivers consistent, high-grade coal supplies backed by verified government licenses, an integrated mine-to-port supply chain, and long-term partnership commitments across domestic and Asia-Pacific markets.",
    hero_cta_primary: "Request Supply Proposal",
    hero_cta_secondary: "Download E-Company Profile (PDF)",
    stat_vol_lbl: "Mine Support Allocation",
    stat_concession_lbl: "IUP OP Mining Area",
    stat_license_lbl: "Coal Transport & Sales Permit",
    stat_market_lbl: "Export Market Reach",

    about_eyebrow: "About Our Company",
    about_title: "Strategic Pillar in National <span class='highlight'>Energy Commodity Trading</span>",
    about_desc1: "PT. Nifara Coal Trading was founded in 2026 in Payakumbuh, West Sumatra, in response to growing industrial energy demands across Indonesia and Asian regional markets.",
    about_desc2: "As a fully accredited legal entity holding official Coal Transportation and Sales Licenses, we operate an integrated, transparent, and international-standard trading ecosystem from mine pits to barge logistics and end-user deliveries.",
    about_h1_title: "Fully Verified Legality",
    about_h1_desc: "Certified NIB, Ministry of Law approval, and specialized transport licenses.",
    about_h2_title: "Guaranteed Supply",
    about_h2_desc: "Direct supply support from active concession holders with operational mining permits.",
    about_badge_title: "Legally Registered",
    about_badge_desc: "OSS RBA No. 3108260031993",

    vm_vision_title: "Corporate Vision",
    vm_vision_text: "To become the leading independent coal transport and sales company in Indonesia, supplying high-quality coal to domestic and international markets, and building long-term, trusted partnerships with our customers.",
    vm_mission_title: "Strategic Missions",
    vm_m1: "To meet rapidly accelerating energy needs across Indonesia, supporting power generation and industrial facilities that form the backbone of socio-economic progress.",
    vm_m2: "To create employment, empower local community talents, and support regional economic growth across coal mining regions.",
    vm_m3: "To enforce rigorous regulatory compliance, professional B2B business integrity, and transparent product quality assurance.",

    lead_eyebrow: "Corporate Leadership",
    lead_title: "Driven by <span class='highlight'>Experienced & Ethical</span> Leadership",
    lead_desc: "Our board combines strategic stewardship and rigorous corporate governance to ensure every large-scale B2B commodity transaction is executed safely and transparently.",
    role_comm: "Commissioner",
    role_dir: "Managing Director",
    bio_comm: "Oversees strategic corporate governance and shareholder interests holding 95% company equity. Drives policy on capital investments, export market development, and long-term energy sustainability compliance.",
    bio_dir: "Leads day-to-day trading operations, mine supply procurement, barge logistics coordination, and direct relationship management with industrial end-users across Asia.",

    legal_eyebrow: "Compliance & Governance",
    legal_title: "Verified Licenses & <span class='highlight'>Official Credentials</span>",
    legal_desc: "Every legal deed, coal transport permit, ministerial ratification, and taxation credential is authenticated and directly verifiable with government registries.",
    legal_banner_text: "<strong>B2B Trust Assurance:</strong> PT. Nifara Coal Trading strictly adheres to Indonesian Mining Laws & Risk-Based OSS regulations.",

    prod_eyebrow: "Product Specifications",
    prod_title: "Thermal Coal Portfolio & <span class='highlight'>Supply Chain Control</span>",
    prod_desc: "We supply thermal coal tailored to fuel power stations, cement manufacturing plants, chemical smelters, and heavy production industries.",
    supply_eyebrow: "End-to-End Supply Chain",
    supply_s1_title: "1. Production Source (Pit)",
    supply_s1_desc: "High quality coal mined directly from active concession reserves (PT. Seluma Prima Coal) with strict quality screening.",
    supply_s2_title: "2. Hauling & Stockpile",
    supply_s2_desc: "Secured overland transport to jetty terminals with blending management and dry stockpiling.",
    supply_s3_title: "3. Barging & Transhipment",
    supply_s3_desc: "Loading on 300ft tug & barges with transhipment onto ocean-going bulk carriers (MV) at deep-water anchorages.",
    supply_s4_title: "4. End Consumers",
    supply_s4_desc: "Punctual delivery confirmed by Certificate of Sampling and Analysis (COA) from accredited independent surveyors.",

    track_eyebrow: "Operational Support",
    track_title: "Strategic Partnerships & <span class='highlight'>Guaranteed Mine Supply</span>",
    track_desc: "Our delivery commitments are grounded on legally verified mine supply allocations, providing corporate buyers total volume certainty.",

    rfq_eyebrow: "Get Started",
    rfq_title: "Request for <span class='highlight'>Quotation (RFQ)</span>",
    rfq_desc: "Submit your order volume, technical parameters, and delivery terms. Our commercial team will provide a thorough proposal within 24 hours.",

    news_eyebrow: "Industry Insights",
    news_title: "Company News & <span class='highlight'>Operational Updates</span>",
    news_desc: "Stay informed on market developments, logistics milestones, and community initiatives from PT. Nifara Coal Trading.",

    faq_eyebrow: "Knowledge Base",
    faq_title: "Frequently Asked <span class='highlight'>Questions</span>",
    faq_desc: "Technical guidance and trade governance details to assist your procurement and commercial due diligence.",
    faq_q1: "What is the Minimum Order Quantity (MOQ)?",
    faq_a1: "For domestic barge shipments (FOB Barge), the minimum allocation is 1 set of 300ft barge (~7,500 - 8,000 MT). For ocean vessel export shipments (FOB MV or CIF), order allocations typically range between 30,000 to 55,000 MT (Supramax/Panamax) per shipment.",
    faq_q2: "Which accredited inspection agency issues the Certificate of Sampling and Analysis (COA)?",
    faq_a2: "All dispatches include comprehensive quality certificates issued by internationally accredited independent testing bodies, such as PT. Carsurin, PT. Sucofindo, or PT. Surveyor Indonesia, strictly verified against contract specifications.",
    faq_q3: "What payment instruments and terms are accepted?",
    faq_a3: "We accommodate standard institutional commodity trade instruments, including Irrevocable Letter of Credit (L/C) at sight issued by prime international banks, SKBDN for domestic clients, and phased milestone terms (Cash Against Documents / T/T) under mutual sales contract agreements.",
    faq_q4: "Where do your coal supply concessions originate from?",
    faq_a4: "Our coal is supplied from active, legally certified IUP Operation Production concessions across Sumatra, strengthened by direct operational partnerships including PT. Seluma Prima Coal (1,116 Ha concession) with guaranteed 10,000 MT/month allocations and vetted partner mines.",
    faq_q5: "Which shipping terms (Incoterms) do you facilitate?",
    faq_a5: "We support diverse commercial delivery structures tailored to buyer logistical preferences: Free on Board (FOB) Barge at loading jetties, Free on Board (FOB) Mother Vessel at designated anchorage transshipment points, and Cost, Insurance, and Freight (CIF) to your designated destination discharge port globally.",

    footer_tagline: "Leading Independent Coal Transport & Sales Enterprise in Indonesia. Delivering reliable thermal energy commodities to domestic and Asian buyers.",
    footer_rights: "All Rights Reserved. PT. Nifara Coal Trading."
  }
};
