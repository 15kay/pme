/**
 * WSU PME Shared Components
 * Auto-generates header + footer for all pages based on URL context.
 */
(function () {
  const path = window.location.pathname;

  function getSection() {
    if (path.includes('/IRP/')) return 'IRP';
    if (path.includes('/QMD/')) return 'QMD';
    if (path.includes('/AcaPlan/')) return 'AcaPlan';
    return 'root';
  }

  function getBase() {
    const s = getSection();
    if (s === 'root') return path.includes('/assets/') ? '../' : './';
    if (path.includes('/assets/')) return '../../';
    return '../';
  }

  const section = getSection();
  const base = getBase();
  const currentFile = path.split('/').pop() || 'index.html';

  function isActive(file) {
    return currentFile === file ? ' active' : '';
  }

  function dropdownLinks() {
    const p = path.includes('/assets/') ? '' : 'assets/';
    if (section === 'IRP') return `
      <li><a href="${p}insti_efficiency.html" class="dropdown-link">Institutional Efficiency</a></li>
      <li><a href="${p}stu.html" class="dropdown-link">Student Tracking & IR</a></li>
      <li><a href="${p}hemis.html" class="dropdown-link">HEMIS</a></li>
      <li><a href="${p}abi.html" class="dropdown-link">Analytics & Business Intelligence</a></li>`;
    if (section === 'QMD') return `
      <li><a href="${p}quality-promo.html" class="dropdown-link">Quality Promotion & Capacity Development</a></li>
      <li><a href="${p}qual-enh.html" class="dropdown-link">Quality Enhancement & Monitoring</a></li>
      <li><a href="${p}qual-ass.html" class="dropdown-link">Quality Assurance</a></li>`;
    if (section === 'AcaPlan') return `
      <li><a href="${p}academic_activity.html" class="dropdown-link">Academic Activity Planning</a></li>
      <li><a href="${p}programme_development.html" class="dropdown-link">Programme Development & Accreditation</a></li>
      <li><a href="${p}university_liaison.html" class="dropdown-link">University Liaison</a></li>
      <li><a href="${p}strategic_advisory.html" class="dropdown-link">Strategic Advisory</a></li>
      <li><a href="${p}coordination_leadership.html" class="dropdown-link">Coordination & Leadership</a></li>`;
    return '';
  }

  function homeLink() {
    if (section === 'root') return path.includes('/assets/') ? '../index.html' : 'index.html';
    return path.includes('/assets/') ? '../index.html' : 'index.html';
  }

  function assetLink(file) {
    if (section === 'root') return path.includes('/assets/') ? file : `assets/${file}`;
    return path.includes('/assets/') ? file : `assets/${file}`;
  }

  const coreFunctionsNav = section !== 'root' ? `
    <li class="dropdown">
      <a href="#" class="nav-link">Core Functions
        <svg class="dropdown-icon" viewBox="0 0 24 24" width="14" height="14"><path fill="currentColor" d="M7 10l5 5 5-5z"/></svg>
      </a>
      <ul class="dropdown-menu">${dropdownLinks()}</ul>
    </li>` : `
    <li class="dropdown">
      <a href="${base}index.html#directorates" class="nav-link">Our Directorates
        <svg class="dropdown-icon" viewBox="0 0 24 24" width="14" height="14"><path fill="currentColor" d="M7 10l5 5 5-5z"/></svg>
      </a>
      <ul class="dropdown-menu">
        <li><a href="${base}IRP/index.html" class="dropdown-link"><i class="fas fa-chart-line" style="margin-right:0.5rem;color:#e99400;"></i>Institutional Research & Planning</a></li>
        <li><a href="${base}QMD/index-qmd.html" class="dropdown-link"><i class="fas fa-award" style="margin-right:0.5rem;color:#e99400;"></i>Quality Management Directorate</a></li>
        <li><a href="${base}AcaPlan/index.html" class="dropdown-link"><i class="fas fa-graduation-cap" style="margin-right:0.5rem;color:#e99400;"></i>Academic Planning</a></li>
      </ul>
    </li>`;

  const backToPME = section !== 'root' ? `
    <li><a href="${base}index.html" class="nav-link"><i class="fas fa-arrow-left"></i> PME Home</a></li>` : '';

  const sectionLabel = { IRP: 'Institutional Research & Planning', QMD: 'Quality Management Directorate', AcaPlan: 'Academic Planning', root: 'PME' }[section];

  const footerLinks = section === 'root' ? `
    <div class="footer-links">
      <h4 class="footer-title">Directorates</h4>
      <ul>
        <li><a href="${base}IRP/index.html">Institutional Research & Planning</a></li>
        <li><a href="${base}AcaPlan/index.html">Academic Planning</a></li>
        <li><a href="${base}QMD/index-qmd.html">Quality Management</a></li>
      </ul>
    </div>
    <div class="footer-links">
      <h4 class="footer-title">Quick Links</h4>
      <ul>
        <li><a href="${assetLink('about.html')}">About PME</a></li>
        <li><a href="${assetLink('contact.html')}">Contact Us</a></li>
      </ul>
    </div>` : `
    <div class="footer-links">
      <h4 class="footer-title">Quick Links</h4>
      <ul>
        <li><a href="${assetLink('about.html')}">About Us</a></li>
        <li><a href="${assetLink('team.html')}">Our Team</a></li>
        <li><a href="${assetLink('news.html')}">News</a></li>
        <li><a href="${assetLink('contact.html')}">Contact</a></li>
      </ul>
    </div>
    <div class="footer-links">
      <h4 class="footer-title">Core Functions</h4>
      <ul>${dropdownLinks()}</ul>
    </div>`;

  const header = `
  <header class="header">
    <div class="header-top">
      <div class="header-container">
        <div class="logo-container">
          <a href="${base}index.html">
            <img src="${base}assets/img/logo.png" alt="Walter Sisulu University" class="logo-img" />
          </a>
        </div>
        <div class="search-container">
          <form class="search-form">
            <input type="text" class="search-input" placeholder="Search..." aria-label="Search" />
            <button type="submit" class="search-button" aria-label="Search">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="header-bottom">
      <div class="header-container">
        <button class="hamburger" id="hamburger" aria-label="Toggle navigation" aria-expanded="false" aria-controls="sidebar">
          <span class="hamburger-icon">&#9776;</span>
          <span class="hamburger-label">Menu</span>
        </button>
        <nav class="navbar" id="sidebar" aria-label="Main Navigation">
          <div class="sidebar-search-container" style="padding:0 1rem;">
            <form class="sidebar-search-form">
              <input type="text" class="sidebar-search-input" placeholder="Search..." aria-label="Search" />
            </form>
          </div>
          <ul class="nav-links">
            ${backToPME}
            <li><a href="${homeLink()}" class="nav-link${isActive('index.html') || isActive('index-qmd.html') ? ' active' : ''}">Home</a></li>
            <li><a href="${assetLink('about.html')}" class="nav-link${isActive('about.html')}">About Us</a></li>
            ${coreFunctionsNav}
            <li><a href="${assetLink('news.html')}" class="nav-link${isActive('news.html')}">News</a></li>
            <li><a href="${assetLink('team.html')}" class="nav-link${isActive('team.html')}">Our Team</a></li>
            <li><a href="${assetLink('contact.html')}" class="nav-link${isActive('contact.html')}">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>`;

  const footer = `
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="${base}index.html">
            <img src="${base}assets/img/logo.png" alt="WSU" style="max-height:46px;width:auto;margin-bottom:1rem;filter:brightness(0) invert(1);" />
          </a>
          <p class="footer-description">${sectionLabel} — Walter Sisulu University. Driving institutional excellence through strategic oversight and evidence-based decision-making.</p>
        </div>
        ${footerLinks}
        <div class="footer-contact">
          <h4 class="footer-title">Contact</h4>
          <ul>
            <li><i class="fas fa-map-marker-alt"></i><span>R102, Potsdam, East London, 5200</span></li>
            <li><i class="fas fa-phone-alt"></i><a href="tel:+27475022849">+27 (0)47 502 2849</a></li>
            <li><i class="far fa-clock"></i><span>Mon–Fri, 08:00–16:00</span></li>
            <li><i class="fas fa-envelope"></i><a href="mailto:irp@wsu.ac.za">irp@wsu.ac.za</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 ${sectionLabel}, Walter Sisulu University. All rights reserved.</p>
      </div>
    </div>
  </footer>`;

  document.addEventListener('DOMContentLoaded', function () {
    // Inject header
    const headerEl = document.getElementById('pme-header');
    if (headerEl) headerEl.outerHTML = header;

    // Inject footer
    const footerEl = document.getElementById('pme-footer');
    if (footerEl) footerEl.outerHTML = footer;

    // Mobile hamburger
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    if (hamburger && sidebar) {
      hamburger.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        hamburger.setAttribute('aria-expanded', sidebar.classList.contains('show'));
      });
      window.addEventListener('click', (e) => {
        if (sidebar.classList.contains('show') && !sidebar.contains(e.target) && !hamburger.contains(e.target)) {
          sidebar.classList.remove('show');
          hamburger.setAttribute('aria-expanded', 'false');
        }
      });
    }
  });
})();
