
(function () {
  /* Language: Indonesian is the default. Strings that differ are written as [id, en]. */
  var lang = "id";
  try { var saved = localStorage.getItem("nct-lang"); if (saved === "en" || saved === "id") lang = saved; } catch (e) {}
  function tx(v) { return Array.isArray(v) ? v[lang === "en" ? 1 : 0] : v; }
  var UI = {
    copy: ["Salin", "Copy"],
    copyPrefix: ["Salin ", "Copy "],
    copied: ["Tersalin", "Copied"],
    failed: ["Gagal, tekan Ctrl+C", "Failed, press Ctrl+C"],
    needNote: ["Tulis kebutuhan Anda agar kami bisa menanggapi.", "Write your needs so we can respond."],
    docCopy: ["Salinan dokumen: ", "Copy of document: "],
    dear: ["Yth. PT. Nifara Coal Trading,", "Dear PT. Nifara Coal Trading,"],
    regards: ["Hormat saya,", "Sincerely,"],
    nameFallback: ["(nama)", "(name)"],
    subject: ["Inquiry Kebutuhan Batubara - PT. Nifara Coal Trading", "Coal Supply Inquiry - PT. Nifara Coal Trading"],
    idTitle: ["Identitas perusahaan", "Company identity"]
  };
  function u(k) { return tx(UI[k]); }

  var DOCS = [
    { id: "akta", img: "img/akta.jpg",
      title: ["Akta pendirian perseroan", "Deed of company establishment"],
      short: ["Nomor 08, 21 Agustus 2026", "No. 08, 21 August 2026"],
      desc: ["Salinan akta pendirian perseroan terbatas PT. Nifara Coal Trading yang dibuat di hadapan notaris.", "Copy of the deed of establishment of PT. Nifara Coal Trading, a limited liability company, executed before a notary."],
      specs: [
        [["Nomor akta", "Deed number"], "08.-"],
        [["Tanggal", "Date"], ["21 Agustus 2026", "21 August 2026"]],
        [["Notaris", "Notary"], "Echo Pratama, S.H., M.Kn."],
        [["SK Notaris", "Notary Decree"], "AHU-02670.AH.02.01 Tahun 2023"],
        [["Kedudukan notaris", "Notary's domicile"], ["Kabupaten Sijunjung, Sumatera Barat", "Sijunjung Regency, West Sumatra"]]
      ] },
    { id: "sk", img: "img/pengesahan.jpg",
      title: ["Pengesahan badan hukum", "Legal entity approval"],
      short: ["SK AHU-0068094.AH.01.01.Tahun 2026", "Decree AHU-0068094.AH.01.01.Tahun 2026"],
      desc: ["Keputusan Menteri Hukum Republik Indonesia tentang pengesahan pendirian badan hukum perseroan terbatas PT Nifara Coal Trading.", "Decree of the Minister of Law of the Republic of Indonesia approving the establishment of PT Nifara Coal Trading as a limited liability company."],
      specs: [
        [["Nomor keputusan", "Decree number"], "AHU-0068094.AH.01.01.Tahun 2026"],
        [["Nomor pendaftaran", "Registration number"], "4026082413105839"],
        [["Ditetapkan", "Issued"], ["Jakarta, 24 Agustus 2026", "Jakarta, 24 August 2026"]],
        [["Berkedudukan di", "Domiciled in"], ["Kota Payakumbuh", "Payakumbuh City"]],
        [["Jenis perseroan", "Company type"], ["Swasta nasional", "National private"]],
        [["Daftar perseroan", "Company register"], "AHU-0211918.AH.01.11.Tahun 2026"]
      ] },
    { id: "modal", img: "img/lampiran.jpg",
      title: ["Modal dan susunan saham", "Capital and shareholding"],
      short: ["Modal dasar Rp 1.000.000.000", "Authorized capital Rp 1,000,000,000"],
      desc: ["Lampiran keputusan pengesahan yang memuat modal perseroan dan susunan pemegang saham, komisaris, dan direksi.", "Attachment to the approval decree listing the company's capital, its shareholders, the commissioner, and the director."],
      specs: [
        [["Modal dasar", "Authorized capital"], ["Rp 1.000.000.000", "Rp 1,000,000,000"]],
        [["Modal ditempatkan", "Issued capital"], ["Rp 1.000.000.000", "Rp 1,000,000,000"]],
        [["Rizki Abdian Putra (Direktur)", "Rizki Abdian Putra (Director)"], ["50 lembar (5%), Rp 50.000.000", "50 shares (5%), Rp 50,000,000"]],
        [["Niha Meisya Maharani (Komisaris)", "Niha Meisya Maharani (Commissioner)"], ["950 lembar (95%), Rp 950.000.000", "950 shares (95%), Rp 950,000,000"]]
      ] },
    { id: "nib", img: "img/nib.jpg",
      title: ["Nomor Induk Berusaha", "Business Identification Number"],
      short: "NIB 3108260031993",
      desc: ["Perizinan berusaha berbasis risiko yang diterbitkan pemerintah sebagai identitas pelaku usaha.", "Risk-based business license issued by the government as the identity of the business actor."],
      specs: [
        ["NIB", "3108260031993"],
        [["Diterbitkan", "Issued"], ["Jakarta, 31 Agustus 2026", "Jakarta, 31 August 2026"]],
        ["NPWP", "1000000010896416"],
        [["Status penanaman modal", "Investment status"], ["PMDN", "PMDN (domestic investment)"]],
        [["Skala usaha", "Business scale"], ["Usaha mikro", "Micro enterprise"]]
      ] },
    { id: "izin", img: "img/izin.jpg",
      title: ["Izin pengangkutan dan penjualan batubara", "Coal transport and sales license"],
      short: ["Izin 31082600319930002", "License 31082600319930002"],
      desc: ["Izin yang memberi kami kewenangan untuk mengangkut dan menjual batubara. Statusnya telah memenuhi persyaratan.", "The license that authorizes us to transport and sell coal. Its status is that requirements have been fulfilled."],
      specs: [
        [["Nomor izin", "License number"], "31082600319930002"],
        [["Diterbitkan", "Issued"], ["6 November 2026", "6 November 2026"]],
        ["KBLI", ["46710, Perdagangan besar bahan bakar padat, cair, dan gas beserta produk terkait", "46710, Wholesale of solid, liquid, and gaseous fuels and related products"]],
        [["Lokasi usaha", "Business location"], ["Jl. Letjen M.T. Haryono Kav. 10 GF A4/A, Bidara Cina, Jatinegara, Jakarta Timur 13330", "Jl. Letjen M.T. Haryono Kav. 10 GF A4/A, Bidara Cina, Jatinegara, East Jakarta 13330"]],
        [["Masa berlaku", "Validity period"], ["5 (lima) tahun", "5 (five) years"]],
        ["Status", ["Telah memenuhi persyaratan", "Requirements fulfilled"]]
      ] },
    { id: "npwp", img: "img/npwp.jpg",
      title: ["Surat keterangan wajib pajak", "Taxpayer registration certificate"],
      short: ["Terdaftar sejak 24 Agustus 2026", "Registered since 24 August 2026"],
      desc: ["Surat keterangan terdaftar dari Direktorat Jenderal Pajak untuk wajib pajak badan.", "Registration certificate from the Directorate General of Taxes for a corporate taxpayer."],
      specs: [
        [["Nomor surat", "Certificate number"], "S-20631/SKT-WP-CT/KPP.2705/2026"],
        ["NPWP", "1000000010896416"],
        [["Jenis wajib pajak", "Taxpayer type"], ["Badan", "Corporate"]],
        [["Terdaftar sejak", "Registered since"], ["24 Agustus 2026", "24 August 2026"]],
        [["Kantor pelayanan", "Tax office"], "KPP Pratama Payakumbuh"]
      ] },
    { id: "dukungan", img: "img/dukungan.jpg",
      title: ["Surat dukungan tambang", "Mine supply support letter"],
      short: ["10.000 MT, November dan Desember 2026", "10,000 MT, November and December 2026"],
      desc: ["Pernyataan dukungan pasokan batubara dari PT Seluma Prima Coal, pemegang IUP Operasi Produksi, kepada PT. Nifara Coal Trading.", "Coal supply support statement from PT Seluma Prima Coal, holder of a Production Operation IUP, to PT. Nifara Coal Trading."],
      specs: [
        [["Nomor surat", "Letter number"], "119/SPC-MD/XI/2026"],
        [["Pemasok", "Supplier"], "PT Seluma Prima Coal"],
        ["Volume", ["10.000 MT", "10,000 MT"]],
        [["Periode", "Period"], ["November dan Desember 2026", "November and December 2026"]],
        ["IUP OP", ["44/1/IUP/PMA/2016, 13 Desember 2016, seluas 1.116 hektar", "44/1/IUP/PMA/2016, 13 December 2016, covering 1,116 hectares"]],
        [["Penandatangan", "Signed by"], ["Syaidil Imron, Kepala Teknik Tambang", "Syaidil Imron, Head of Mining Engineering"]],
        [["Tanggal surat", "Letter date"], ["Jambi, 11 November 2026", "Jambi, 11 November 2026"]]
      ] }
  ];

  var STEPS = [
    { title: ["Sumber produksi", "Production source"],
      desc: ["Pasokan batubara kami didukung oleh PT Seluma Prima Coal, pemegang Izin Usaha Pertambangan Operasi Produksi (IUP OP). Komitmen pasokan resmi tertuang dalam surat perjanjian pasokan jangka panjang.", "Our coal supply is secured by PT Seluma Prima Coal, an official Production Operation Mining License (IUP OP) holder, backed by documented formal supply agreements."],
      specs: [
        [["Pemasok", "Supplier"], "PT Seluma Prima Coal"],
        [["Volume dukungan", "Supported volume"], ["10.000 MT", "10,000 MT"]],
        [["Periode", "Period"], ["November dan Desember 2026", "November and December 2026"]],
        ["IUP OP", ["44/1/IUP/PMA/2016, 13 Desember 2016", "44/1/IUP/PMA/2016, 13 December 2016"]],
        [["Luas wilayah", "Area"], ["1.116 hektar", "1,116 hectares"]],
        [["Surat dukungan", "Support letter"], ["No. 119/SPC-MD/XI/2026, Jambi, 11 November 2026", "No. 119/SPC-MD/XI/2026, Jambi, 11 November 2026"]]
      ],
      doc: "dukungan", docLabel: ["Lihat surat dukungan", "View support letter"] },
    { title: ["Pengangkutan dan penjualan", "Transport and sales"],
      desc: ["Kami memegang izin resmi pengangkutan dan penjualan komoditas batubara berbasis risiko (KBLI 46710), didukung koordinasi logistik darat-laut dan kepatuhan inspeksi mutu.", "We hold official risk-based coal transport and trading licenses (KBLI 46710), supported by integrated inland-maritime logistics and strict quality inspection compliance."],
      specs: [
        [["Nomor izin", "License number"], "31082600319930002"],
        [["Diterbitkan", "Issued"], ["6 November 2026", "6 November 2026"]],
        [["Klasifikasi usaha", "Business classification"], ["KBLI 46710, Perdagangan besar bahan bakar padat, cair, dan gas beserta produk terkait", "KBLI 46710, Wholesale of solid, liquid, and gaseous fuels and related products"]],
        [["Lokasi usaha", "Business location"], ["Jl. Letjen M.T. Haryono Kav. 10 GF A4/A, Bidara Cina, Jatinegara, Jakarta Timur 13330", "Jl. Letjen M.T. Haryono Kav. 10 GF A4/A, Bidara Cina, Jatinegara, East Jakarta 13330"]],
        ["Status", ["Telah memenuhi persyaratan", "Requirements fulfilled"]]
      ],
      doc: "izin", docLabel: ["Lihat izin usaha", "View business license"] },
    { title: ["Konsumen akhir", "End consumers"],
      desc: ["Memenuhi kebutuhan energi off-taker industri strategis, mencakup pembangkit listrik tenaga uap (PLTU), industri semen, smelter mineral, dan pabrik manufaktur di Indonesia dan Asia.", "Meeting the critical energy demands of strategic industrial off-takers, including coal-fired power plants (PLTU), cement manufacturers, mineral smelters, and heavy industries across Indonesia and Asia."],
      specs: [
        [["Pasar utama", "Main market"], ["Indonesia dan Pasar Regional Asia", "Indonesia and Regional Asian Markets"]],
        [["Sektor yang dilayani", "Sectors served"], ["Pembangkit Listrik (PLTU), Smelter, Semen, & Industri", "Power Generation (PLTU), Smelters, Cement, & Heavy Industry"]],
        [["Jaminan komitmen", "Commitment guarantee"], ["Kesesuaian Kalori (GAR), Legalitas Penuh, & Ketepatan Pengiriman", "Calorific Spec (GAR) Compliance, Full Legality, & Timely Delivery"]]
      ],
      link: "#visi", linkLabel: ["Baca visi dan misi", "Read our vision and mission"] }
  ];

  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  function el(tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text != null) e.textContent = text; return e; }

  /* Header */
  var header = $(".site-header");
  function onScroll() { header.classList.toggle("scrolled", window.scrollY > 8); }
  window.addEventListener("scroll", onScroll, { passive: true }); onScroll();

  /* Brand logo click: smoothly returns to top / hero section */
  var brandLogo = $(".brand");
  if (brandLogo) {
    brandLogo.addEventListener("click", function (e) {
      var path = window.location.pathname;
      var isHome = path.endsWith("index.php") ||
                   path.endsWith("index.html") ||
                   path.endsWith("/") ||
                   path === "";
      if (isHome) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
        if (window.history && window.history.pushState) {
          window.history.pushState(null, null, window.location.pathname + window.location.search);
        }
      }
    });
  }

  /* Navigation: a native popover when the links do not fit, an inline row when they do. */
  var inner = $("#headerInner"), menu = $("#site-menu"), menuBtn = $("#menuBtn");
  var hasPopover = Object.hasOwn(HTMLElement.prototype, "popover");
  function layoutNav() {
    header.classList.add("is-measuring");
    menu.removeAttribute("popover");
    menu.hidden = false;
    header.classList.add("is-wide");
    if (inner.scrollWidth > inner.clientWidth) {
      header.classList.remove("is-wide");
      if (hasPopover) { menu.setAttribute("popover", "auto"); }
      else { menu.hidden = true; menuBtn.setAttribute("aria-expanded", "false"); }
    }
    header.classList.remove("is-measuring");
  }
  if (!hasPopover) {
    menuBtn.setAttribute("aria-expanded", "false");
    menuBtn.addEventListener("click", function () {
      var open = menu.hidden;
      menu.hidden = !open;
      menuBtn.setAttribute("aria-expanded", String(open));
    });
  }
  menu.addEventListener("click", function (e) {
    if (!e.target.closest("a")) return;
    if (menu.hasAttribute("popover")) { try { menu.hidePopover(); } catch (err) {} }
    else if (!header.classList.contains("is-wide")) { menu.hidden = true; menuBtn.setAttribute("aria-expanded", "false"); }
  });
  layoutNav();
  if ("ResizeObserver" in window) new ResizeObserver(layoutNav).observe(inner);
  else window.addEventListener("resize", layoutNav);
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(layoutNav);

  /* Scroll spy */
  var links = $$(".site-menu a.link");
  var map = {};
  links.forEach(function (a) { map[a.getAttribute("href").slice(1)] = a; });
  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting && map[en.target.id]) {
          links.forEach(function (a) { a.removeAttribute("aria-current"); });
          map[en.target.id].setAttribute("aria-current", "location");
        }
      });
    }, { rootMargin: "-45% 0px -50% 0px" });
    Object.keys(map).forEach(function (id) { var s = document.getElementById(id); if (s) io.observe(s); });
  }

  /* Copy buttons: command="--copy" plus a status bubble right after each button. */
  var copyTimers = new WeakMap();
  function report(button, ok) {
    var tip = button.nextElementSibling;
    clearTimeout(copyTimers.get(button));
    button.removeAttribute("data-copied");
    button.removeAttribute("data-failed");
    tip.textContent = "";
    void button.offsetWidth;
    button.setAttribute(ok ? "data-copied" : "data-failed", "");
    requestAnimationFrame(function () { tip.textContent = ok ? u("copied") : u("failed"); });
    copyTimers.set(button, setTimeout(function () {
      button.removeAttribute("data-copied");
      button.removeAttribute("data-failed");
      tip.textContent = "";
    }, 2400));
  }
  function selectText(target) {
    if (target.select) { target.select(); return; }
    var r = document.createRange(); r.selectNodeContents(target);
    var sel = window.getSelection(); sel.removeAllRanges(); sel.addRange(r);
  }
  async function copy(button, target) {
    var text = target.matches("input, textarea") ? target.value : target.innerText.trim();
    if (!text) return;
    try {
      await navigator.clipboard.writeText(text);
      report(button, true);
    } catch (err) {
      /* The page can run in a frame that refuses clipboard access: select the text and try the older call once. */
      selectText(target);
      var ok = false;
      try { ok = document.execCommand("copy"); } catch (err2) {}
      report(button, ok);
    }
  }
  document.addEventListener("command", function (e) {
    if (e.command === "--copy") copy(e.source, e.target);
  }, true);
  if (!("CommandEvent" in window)) {
    document.addEventListener("click", function (e) {
      var b = e.target.closest('button[command="--copy"]');
      if (!b) return;
      var t = document.getElementById(b.getAttribute("commandfor"));
      if (t) copy(b, t);
    });
  }

  /* Value chain */
  var tabs = $$(".stop"), route = $("#route"), panel = $("#panel");
  var current = 0;
  function renderStep(i, focus) {
    if (!route || !panel) return;
    current = i;
    var s = STEPS[i];
    tabs.forEach(function (t, k) {
      t.setAttribute("aria-selected", String(k === i));
      t.tabIndex = k === i ? 0 : -1;
      t.classList.toggle("passed", k < i);
    });
    route.style.setProperty("--k", i);
    panel.setAttribute("aria-labelledby", "tab-" + i);
    $("#p-title").textContent = tx(s.title);
    $("#p-desc").textContent = tx(s.desc);
    var sp = $("#p-specs"); sp.textContent = "";
    s.specs.forEach(function (r) { var d = el("div"); d.appendChild(el("dt", null, tx(r[0]))); d.appendChild(el("dd", null, tx(r[1]))); sp.appendChild(d); });
    var ac = $("#p-actions"); ac.textContent = "";
    var arrowSvg = '<svg class="btn-arrow-circle" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="11 8 15 12 11 16"/></svg>';
    if (s.doc) {
      var b = el("button", "btn btn-panel");
      b.type = "button";
      b.innerHTML = '<span>' + tx(s.docLabel) + '</span>' + arrowSvg;
      b.addEventListener("click", function () { openDoc(s.doc); });
      ac.appendChild(b);
    }
    if (s.link) {
      var a = el("a", "btn btn-panel");
      a.href = s.link;
      a.innerHTML = '<span>' + tx(s.linkLabel) + '</span>' + arrowSvg;
      ac.appendChild(a);
    }
    if (focus) tabs[i].focus();
  }
  tabs.forEach(function (t) {
    t.addEventListener("click", function () { renderStep(+t.getAttribute("data-i")); });
    t.addEventListener("keydown", function (e) {
      var n = null;
      if (e.key === "ArrowRight") n = (current + 1) % 3;
      else if (e.key === "ArrowLeft") n = (current + 2) % 3;
      else if (e.key === "Home") n = 0;
      else if (e.key === "End") n = 2;
      if (n !== null) { e.preventDefault(); renderStep(n, true); }
    });
  });

  /* Documents */
  var grid = $("#docs");
  function renderDocs() {
    if (!grid) return;
    grid.textContent = "";
    DOCS.forEach(function (d, idx) {
      var li = el("li");
      var b = el("button", "doc"); b.type = "button"; b.setAttribute("data-doc", d.id);
      var th = el("div", "thumb");
      var im = el("img"); im.src = d.img.replace("img/", "img/t-"); im.alt = tx(d.title); im.width = 480; im.height = 552; im.loading = "lazy";
      th.appendChild(im);

      var num = el("span", "doc-index-badge", "0" + (idx + 1));
      th.appendChild(num);

      var ov = el("div", "doc-hover-overlay");
      ov.innerHTML = '<span class="doc-hover-btn"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg><span>' + tx(["Buka Dokumen", "View Document"]) + '</span></span>';
      th.appendChild(ov);

      var m = el("div", "meta");
      var titleEl = el("b", "doc-card-title", tx(d.title));
      var shortEl = el("span", "doc-card-num", tx(d.short));
      m.appendChild(titleEl);
      m.appendChild(shortEl);

      b.appendChild(th); b.appendChild(m);
      b.addEventListener("click", function () { openDoc(d.id); });
      li.appendChild(b); grid.appendChild(li);
    });

    var idc = el("div", "idcard");
    var idcHeader = el("div", "idcard-header");
    idcHeader.innerHTML = '<div class="idcard-seal" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg></div><div class="idcard-headings"><span class="idcard-kicker">' + tx(["KREDENSIAL RESMI", "OFFICIAL CREDENTIALS"]) + '</span><h3 class="idcard-title">' + u("idTitle") + '</h3></div>';
    idc.appendChild(idcHeader);

    var idl = el("dl", "idcard-dl");
    [[["Nama badan usaha", "Legal entity name"], "PT. Nifara Coal Trading", null, false],
     ["NIB", "3108260031993", "id-nib", true],
     ["NPWP", "1000000010896416", "id-npwp", true],
     [["Berkedudukan di", "Domiciled in"], ["Kota Payakumbuh, Sumatera Barat", "Payakumbuh City, West Sumatra"], null, false]].forEach(function (r) {
      var isNum = r[3];
      var w = el("div", "idcard-item" + (isNum ? " is-num" : " is-text"));
      w.appendChild(el("dt", null, tx(r[0])));
      var dd = el("dd");
      var sp = el("span", isNum ? "idcard-value is-num" : "idcard-value is-text", tx(r[1]));
      if (r[2]) sp.id = r[2];
      dd.appendChild(sp);
      if (r[2]) {
        var box = el("span", "copy");
        var c = el("button", "copy-btn", u("copy")); c.type = "button";
        c.setAttribute("command", "--copy"); c.setAttribute("commandfor", r[2]); c.setAttribute("aria-label", u("copyPrefix") + tx(r[0]));
        var tip = el("span", "tip"); tip.setAttribute("role", "status");
        box.appendChild(c); box.appendChild(tip); dd.appendChild(box);
      }
      w.appendChild(dd); idl.appendChild(w);
    });
    idc.appendChild(idl);

    var idcFooter = el("div", "idcard-footer");
    idcFooter.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg><span>' + tx(["Terverifikasi Kemenkumham & OSS RI", "Verified by Kemenkumham & OSS RI"]) + '</span>';
    idc.appendChild(idcFooter);

    var idli = el("li"); idli.appendChild(idc); grid.appendChild(idli);
  }

  var viewer = $("#viewer"), vIndex = 0;
  function idxOf(id) { for (var i = 0; i < DOCS.length; i++) if (DOCS[i].id === id) return i; return 0; }
  function fillViewer(i) {
    if (!viewer) return;
    vIndex = (i + DOCS.length) % DOCS.length;
    var d = DOCS[vIndex];
    var img = $("#v-img");
    if (!img) return;
    var docTitle = tx(d.title);
    img.alt = (u("docCopy") || "Salinan dokumen: ") + docTitle;
    img.title = docTitle;
    img.onerror = function () {
      this.onerror = null;
      this.src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400'%3E%3Crect width='100%25' height='100%25' fill='%23021a2d'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%2394a3b8' font-family='sans-serif' font-size='16'%3E" + encodeURIComponent(docTitle) + "%3C/text%3E%3C/svg%3E";
    };
    img.src = d.img;
    var viewerImg = $(".viewer-img");
    if (viewerImg) viewerImg.scrollTop = 0;
    $("#v-title").textContent = docTitle;
    $("#v-desc").textContent = tx(d.desc);

    var counterEl = $("#v-counter");
    if (counterEl) counterEl.textContent = (vIndex + 1 < 10 ? "0" : "") + (vIndex + 1) + " / " + (DOCS.length < 10 ? "0" : "") + DOCS.length;

    var shortTagEl = $("#v-short-tag");
    if (shortTagEl) shortTagEl.textContent = tx(d.short);

    var fullLinkEl = $("#v-full-link");
    if (fullLinkEl) fullLinkEl.href = d.img;

    var sp = $("#v-specs");
    if (sp) {
      sp.textContent = "";
      d.specs.forEach(function (r) {
        var x = el("div");
        x.appendChild(el("dt", null, tx(r[0])));
        x.appendChild(el("dd", null, tx(r[1])));
        sp.appendChild(x);
      });
    }

    var dotsContainer = $("#v-dots");
    if (dotsContainer) {
      dotsContainer.textContent = "";
      DOCS.forEach(function (_, idx) {
        var dot = el("span", "v-dot" + (idx === vIndex ? " active" : ""));
        dot.setAttribute("role", "button");
        dot.setAttribute("tabindex", "0");
        dot.setAttribute("aria-label", (lang === "en" ? "Go to document " : "Buka dokumen ") + (idx + 1));
        dot.addEventListener("click", function () { fillViewer(idx); });
        dot.addEventListener("keydown", function (e) { if (e.key === "Enter" || e.key === " ") { e.preventDefault(); fillViewer(idx); } });
        dotsContainer.appendChild(dot);
      });
    }
  }
  function openDoc(id) {
    if (!viewer) return;
    fillViewer(idxOf(id));
    if (!viewer.open) viewer.showModal();
  }
  var vPrev = $("#vPrev");
  var vNext = $("#vNext");
  if (vPrev) vPrev.addEventListener("click", function () { fillViewer(vIndex - 1); });
  if (vNext) vNext.addEventListener("click", function () { fillViewer(vIndex + 1); });
  /* closedby="any" handles clicking outside. Older browsers get the same behaviour from this check. */
  if (viewer) {
    if (!("closedBy" in HTMLDialogElement.prototype)) {
      viewer.addEventListener("click", function (e) {
        if (e.target !== viewer) return;
        var r = viewer.getBoundingClientRect();
        if (e.clientX < r.left || e.clientX > r.right || e.clientY < r.top || e.clientY > r.bottom) viewer.close();
      });
    }
    viewer.addEventListener("keydown", function (e) {
      if (e.key === "ArrowLeft") { e.preventDefault(); fillViewer(vIndex - 1); }
      if (e.key === "ArrowRight") { e.preventDefault(); fillViewer(vIndex + 1); }
    });
  }

  /* Contact: compose a message with multi-provider direct links (Gmail, Outlook, Default Mail, Copy). */
  var form = $("#msgForm"), result = $("#result"), resultText = $("#resultText"),
      mailLink = $("#mailLink"), gmailLink = $("#gmailLink"), outlookLink = $("#outlookLink"),
      noteField = $("#f-note");

  function buildMessage() {
    var name = $("#f-name").value.trim(), co = $("#f-co").value.trim(), note = noteField.value.trim();
    var lines = [u("dear"), "", note, "", u("regards"), name || u("nameFallback")];
    if (co) lines.push(co);
    var text = lines.join("\n");
    resultText.value = text;

    var targetEmail = "nifaracoaltrading@gmail.com";
    var subject = u("subject");

    // 1. Default desktop / system mailto link
    if (mailLink) {
      mailLink.href = "mailto:" + targetEmail + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(text);
    }
    // 2. Direct Gmail Web compose link
    var gmailUrl = "https://mail.google.com/mail/?view=cm&fs=1&to=" + targetEmail + "&su=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(text);
    if (gmailLink) {
      gmailLink.href = gmailUrl;
    }
    // 3. Direct Outlook Web compose link
    var outlookUrl = "https://outlook.live.com/mail/0/deeplink/compose?to=" + targetEmail + "&subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(text);
    if (outlookLink) {
      outlookLink.href = outlookUrl;
    }

    return { text: text, subject: subject, gmailUrl: gmailUrl };
  }

  if (noteField && form) {
    noteField.addEventListener("invalid", function () { noteField.setCustomValidity(u("needNote")); });
    noteField.addEventListener("input", function () { noteField.setCustomValidity(""); });

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      if (!noteField.value.trim()) { noteField.setCustomValidity(u("needNote")); noteField.reportValidity(); return; }
      var data = buildMessage();
      if (result) result.hidden = false;

      // Directly open Gmail Web compose in a new tab (exactly like WhatsApp Web)
      try {
        window.open(data.gmailUrl, "_blank", "noopener,noreferrer");
      } catch (err) {
        console.warn("Direct window.open prevented:", err);
      }

      if (result) result.scrollIntoView({ behavior: "smooth", block: "nearest" });
    });
  }

  /* Language switch */
  var langBtns = $$(".lang button");
  function applyStatic() {
    $$("[data-en]").forEach(function (n) {
      if (!n.hasAttribute("data-id")) {
        n.setAttribute("data-id", n.innerHTML.indexOf("<") !== -1 ? n.innerHTML.trim() : n.textContent.trim());
      }
      var targetVal = lang === "en" ? n.getAttribute("data-en") : n.getAttribute("data-id");
      if (targetVal && targetVal.indexOf("<") !== -1) {
        n.innerHTML = targetVal;
      } else {
        n.textContent = targetVal;
      }
    });
    ["alt", "aria-label", "title", "placeholder"].forEach(function (a) {
      $$("[data-en-" + a + "]").forEach(function (n) {
        var k = "data-id-" + a;
        if (!n.hasAttribute(k)) n.setAttribute(k, n.getAttribute(a) || "");
        n.setAttribute(a, lang === "en" ? n.getAttribute("data-en-" + a) : n.getAttribute(k));
      });
    });
  }
  var isSwitchingLang = false;
  function updateLangContent(next) {
    lang = next;
    document.documentElement.lang = lang;
    langBtns.forEach(function (b) { b.setAttribute("aria-pressed", String(b.getAttribute("data-lang") === lang)); });
    applyStatic();
    renderStep(current);
    renderDocs();
    if (viewer && viewer.open) fillViewer(vIndex);
    if (result && !result.hidden) buildMessage();
    if (noteField && noteField.validity && noteField.validity.customError) noteField.setCustomValidity(u("needNote"));
    layoutNav();
  }

  function setLang(next, persist) {
    if (!persist) {
      updateLangContent(next);
      return;
    }
    if (isSwitchingLang) return;
    isSwitchingLang = true;

    // Phase 1: Rapid hardware-accelerated opacity dissolve (100ms)
    document.body.classList.add("is-lang-switching");

    setTimeout(function () {
      // Phase 2: Instant DOM text swap while content is invisible (opacity 0.05)
      updateLangContent(next);
      try { localStorage.setItem("nct-lang", lang); } catch (e) {}

      // Force layout calculation before releasing the class
      void document.body.offsetHeight;

      requestAnimationFrame(function () {
        // Phase 3: Smooth spring fade-in & settle (220ms)
        document.body.classList.remove("is-lang-switching");
        setTimeout(function () {
          isSwitchingLang = false;
        }, 220);
      });
    }, 110);
  }
  langBtns.forEach(function (b) {
    b.addEventListener("click", function () { var n = b.getAttribute("data-lang"); if (n !== lang) setLang(n, true); });
  });

  setLang(lang, false);
})();




/* ==========================================================================
   Framer Motion Engine & Micro-Interactions Controller
   ========================================================================== */
(function initFramerMicroInteractions() {
  // 1. Scroll-Linked Spring Progress Bar
  const progressBar = document.getElementById("motionScrollProgress");
  const scrollTopBtn = document.getElementById("motionScrollTop");

  function updateScrollMotion() {
    const scrollY = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = docHeight > 0 ? (scrollY / docHeight) * 100 : 0;
    if (progressBar) progressBar.style.width = progress + "%";

    if (scrollTopBtn) {
      if (scrollY > 320) {
        scrollTopBtn.classList.add("visible");
      } else {
        scrollTopBtn.classList.remove("visible");
      }
    }
  }
  window.addEventListener("scroll", updateScrollMotion, { passive: true });
  updateScrollMotion();

  if (scrollTopBtn) {
    scrollTopBtn.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // 2. Refined Gentle Magnetic Feedback (Restricted to Floating Action Buttons)
  const magneticTargets = document.querySelectorAll(".float-btn");
  magneticTargets.forEach((btn) => {
    btn.addEventListener("mousemove", (e) => {
      const rect = btn.getBoundingClientRect();
      const x = (e.clientX - rect.left - rect.width / 2) * 0.15;
      const y = (e.clientY - rect.top - rect.height / 2) * 0.15;
      btn.style.transform = `translate3d(${x.toFixed(1)}px, ${y.toFixed(1)}px, 0)`;
    });

    btn.addEventListener("mouseleave", () => {
      btn.style.transform = "translate3d(0, 0, 0)";
    });
  });

  // 3. Ambient Cursor Spotlight on Cards (Solid & Stable, Zero 3D Tilt / Wobble)
  const cards = document.querySelectorAll(".person, .doc, .idcard, .panel, .about .figure, .about-card, .vm-card, .leader-card, .letter-card, .news-card, .reach-item, form.msg");
  cards.forEach((card) => {
    card.classList.add("tilt-card");

    card.addEventListener("mousemove", (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      card.style.setProperty("--mouse-x", `${x}px`);
      card.style.setProperty("--mouse-y", `${y}px`);
    });
  });

  // 4. Staggered Spring Reveals on Scroll (Framer Motion InView)
  const revealTargets = document.querySelectorAll("h2.title, .lead, .about, .route, .panel, .vm-card, .leader-card, .letter-card, .leaders, .docs, .contact, .map-card, .facts > div");
  revealTargets.forEach((el, index) => {
    el.classList.add("motion-reveal");
  });

  if (window.Motion && window.Motion.inView) {
    revealTargets.forEach((el) => {
      window.Motion.inView(el, () => {
        el.classList.add("is-inview");
      }, { amount: 0.15 });
    });
  } else if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-inview");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    revealTargets.forEach((el) => observer.observe(el));
  } else {
    revealTargets.forEach((el) => el.classList.add("is-inview"));
  }

  // 5. Animated Number Counter Micro-Interaction
  const statElements = document.querySelectorAll(".facts dd");
  let statsTriggered = false;

  function runNumberCounters() {
    statElements.forEach((el) => {
      const text = el.textContent.trim();
      const match = text.match(/\d+([.,]\d{3})*/);
      if (!match) return;

      const matchedStr = match[0];
      const hasSeparator = matchedStr.includes(".") || matchedStr.includes(",");
      const isYear = /^\d{4}$/.test(matchedStr) && parseInt(matchedStr, 10) >= 1900 && parseInt(matchedStr, 10) <= 2100;
      const useLocale = hasSeparator && !isYear;

      const rawNum = matchedStr.replace(/[.,]/g, "");
      const targetVal = parseInt(rawNum, 10);
      if (isNaN(targetVal)) return;

      const prefix = text.slice(0, match.index);
      const suffix = text.slice(match.index + matchedStr.length);

      const duration = 1600;
      const start = performance.now();

      function formatNum(n) {
        if (!useLocale) return String(n);
        const activeLang = document.documentElement.lang === "en" ? "en-US" : "id-ID";
        return n.toLocaleString(activeLang);
      }

      function update(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const ease = 1 - Math.pow(1 - progress, 4); // easeOutQuart
        const currentVal = Math.floor(targetVal * ease);

        el.textContent = `${prefix}${formatNum(currentVal)}${suffix}`;
        if (progress < 1) {
          requestAnimationFrame(update);
        } else {
          el.textContent = `${prefix}${formatNum(targetVal)}${suffix}`;
        }
      }
      requestAnimationFrame(update);
    });
  }

  const factsContainer = document.querySelector(".facts");
  if (factsContainer && "IntersectionObserver" in window) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting && !statsTriggered) {
          statsTriggered = true;
          runNumberCounters();
        }
      });
    }, { threshold: 0.2 });
    obs.observe(factsContainer);
  } else {
    runNumberCounters();
  }

  // 6. Interactive Click Ripple Wave
  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn, .copy-btn, .menu-btn, .stop, .doc, .float-btn, .map-tab-btn");
    if (!btn) return;

    const rect = btn.getBoundingClientRect();
    const circle = document.createElement("span");
    circle.classList.add("ripple-circle");

    const diameter = Math.max(rect.width, rect.height);
    const radius = diameter / 2;

    circle.style.width = circle.style.height = `${diameter}px`;
    circle.style.left = `${e.clientX - rect.left - radius}px`;
    circle.style.top = `${e.clientY - rect.top - radius}px`;

    btn.appendChild(circle);
    setTimeout(() => circle.remove(), 600);
  });

  // 7. Interactive Office Location Map Switcher
  const mapTabPayakumbuh = document.getElementById("mapTabPayakumbuh");
  const mapTabJakarta = document.getElementById("mapTabJakarta");
  const mapPanePayakumbuh = document.getElementById("mapPanePayakumbuh");
  const mapPaneJakarta = document.getElementById("mapPaneJakarta");

  if (mapTabPayakumbuh && mapTabJakarta && mapPanePayakumbuh && mapPaneJakarta) {
    function activateMapTab(target) {
      const isPayakumbuh = target === "payakumbuh";

      mapTabPayakumbuh.classList.toggle("active", isPayakumbuh);
      mapTabPayakumbuh.setAttribute("aria-selected", String(isPayakumbuh));
      mapPanePayakumbuh.classList.toggle("active", isPayakumbuh);
      mapPanePayakumbuh.hidden = !isPayakumbuh;

      mapTabJakarta.classList.toggle("active", !isPayakumbuh);
      mapTabJakarta.setAttribute("aria-selected", String(!isPayakumbuh));
      mapPaneJakarta.classList.toggle("active", !isPayakumbuh);
      mapPaneJakarta.hidden = isPayakumbuh;
    }

    mapTabPayakumbuh.addEventListener("click", () => activateMapTab("payakumbuh"));
    mapTabJakarta.addEventListener("click", () => activateMapTab("jakarta"));

    [mapTabPayakumbuh, mapTabJakarta].forEach((tab) => {
      tab.addEventListener("keydown", (e) => {
        if (e.key === "ArrowRight" || e.key === "ArrowLeft") {
          e.preventDefault();
          if (tab === mapTabPayakumbuh) {
            activateMapTab("jakarta");
            mapTabJakarta.focus();
          } else {
            activateMapTab("payakumbuh");
            mapTabPayakumbuh.focus();
          }
        }
      });
    });
  }
})();

