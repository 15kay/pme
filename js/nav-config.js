// Navigation Configuration for PME Project
class NavigationManager {
  constructor() {
    this.baseUrl = this.getBaseUrl();
    this.currentSection = this.getCurrentSection();
  }

  getBaseUrl() {
    const path = window.location.pathname;
    if (path.includes('/IRP/')) return '../../';
    if (path.includes('/QMD/')) return '../../';
    if (path.includes('/AcaPlan/')) return '../../';
    if (path.includes('/assets/')) return '../';
    return './';
  }

  getCurrentSection() {
    const path = window.location.pathname;
    if (path.includes('/IRP/')) return 'IRP';
    if (path.includes('/QMD/')) return 'QMD';
    if (path.includes('/AcaPlan/')) return 'AcaPlan';
    return 'root';
  }

  getNavLinks() {
    const base = this.baseUrl;
    const section = this.currentSection;
    
    return {
      home: section === 'root' ? 'index.html' : `${base}index.html`,
      about: section === 'root' ? 'assets/about.html' : 
             section === 'IRP' ? 'about.html' :
             section === 'QMD' ? 'about.html' :
             section === 'AcaPlan' ? 'about.html' : 'assets/about.html',
      
      // Core Functions - adjust based on section
      insti_efficiency: section === 'IRP' ? 'insti_efficiency.html' : 
                       section === 'QMD' ? '#' :
                       section === 'AcaPlan' ? '#' : 'assets/insti_efficiency.html',
      
      stu: section === 'IRP' ? 'stu.html' : 
           section === 'QMD' ? '#' :
           section === 'AcaPlan' ? '#' : 'assets/stu.html',
      
      hemis: section === 'IRP' ? 'hemis.html' : 
             section === 'QMD' ? '#' :
             section === 'AcaPlan' ? '#' : 'assets/hemis.html',
      
      // QMD specific links
      qual_ass: section === 'QMD' ? 'qual-ass.html' : `${base}QMD/assets/qual-ass.html`,
      qual_enh: section === 'QMD' ? 'qual-enh.html' : `${base}QMD/assets/qual-enh.html`,
      quality_promo: section === 'QMD' ? 'quality-promo.html' : `${base}QMD/assets/quality-promo.html`,
      
      // AcaPlan specific links
      academic_activity: section === 'AcaPlan' ? 'academic_activity.html' : `${base}AcaPlan/assets/academic_activity.html`,
      programme_development: section === 'AcaPlan' ? 'programme_development.html' : `${base}AcaPlan/assets/programme_development.html`,
      
      // Common pages
      news: section === 'root' ? 'assets/news.html' : 'news.html',
      team: section === 'root' ? 'assets/team.html' : 'team.html',
      contact: section === 'root' ? 'assets/contact.html' : 'contact.html',
      
      // Back to PME
      backToPME: base + 'index.html'
    };
  }

  generateNavigation() {
    const links = this.getNavLinks();
    const currentPage = window.location.pathname.split('/').pop();
    
    return `
      <header class="header">
        <!-- First Row - Logo and Search -->
        <div class="header-top">
          <div class="header-container">
            <div class="logo-container centered-logo">
              <img src="img/logo.png" alt="WSU LOGO" class="logo-img" />
            </div>
            <div class="search-container">
              <form class="search-form" id="searchForm">
                <input type="text" class="search-input" id="searchInput" placeholder="Search..." aria-label="Search" />
                <button type="submit" class="search-button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                  </svg>
                </button>
              </form>
              <div class="search-results" id="searchResults"></div>
            </div>
          </div>
        </div>
        
        <!-- NAVIGATION ROW 1 -->
        <div class="header-bottom1" style="background:#000;">
          <ul class="nav-lins">
            <li><a href="${links.backToPME}" class="nav-link"><i class="fas fa-home"></i>Back to PME</a></li>
          </ul>
        </div>

        <!-- Second Row - Centered Navigation -->
        <div class="header-bottom">
          <button class="hamburger" id="hamburger" aria-label="Toggle navigation" aria-expanded="false" aria-controls="sidebar">
            <span class="hamburger-icon">&#9776;</span>
            <span class="hamburger-label">Menu</span>
          </button>

          <nav class="navbar" id="sidebar" aria-label="Mobile Navigation">
            <div class="sidebar-search-container">
              <form class="sidebar-search-form" id="sidebarSearchForm">
                <input type="text" class="sidebar-search-input" placeholder="Search..." aria-label="Search" />
              </form>
            </div>

            <ul class="nav-links">
              <li><a href="${links.home}" class="nav-link ${currentPage === 'index.html' ? 'active' : ''}">Home</a></li>
              <li><a href="${links.about}" class="nav-link ${currentPage === 'about.html' ? 'active' : ''}">About Us</a></li>
              
              ${this.generateDropdownMenu(links, currentPage)}
              
              <li><a href="${links.news}" class="nav-link ${currentPage === 'news.html' ? 'active' : ''}">News</a></li>
              <li><a href="${links.team}" class="nav-link ${currentPage === 'team.html' ? 'active' : ''}">Meet Our Team</a></li>
              <li><a href="${links.contact}" class="nav-link ${currentPage === 'contact.html' ? 'active' : ''}" onclick="contact()">Contact Us</a></li>
            </ul>
          </nav>
        </div>
      </header>
    `;
  }

  generateDropdownMenu(links, currentPage) {
    if (this.currentSection === 'IRP') {
      return `
        <li class="dropdown">
          <a href="#" class="nav-link dropdown-toggle">
            Core Functions
            <svg class="dropdown-icon" viewBox="0 0 24 24" width="16" height="16">
              <path fill="currentColor" d="M7 10l5 5 5-5z" />
            </svg>
          </a>
          <ul class="dropdown-menu">
            <li><a href="${links.insti_efficiency}" class="dropdown-link">Institutional Efficiency</a></li>
            <li><a href="${links.stu}" class="dropdown-link">Student Tracking - Institutional Research</a></li>
            <li><a href="${links.hemis}" class="dropdown-link">HEMIS</a></li>
            <li><a href="abi.html" class="dropdown-link">Analytics & Business Intelligence</a></li>
          </ul>
        </li>
      `;
    } else if (this.currentSection === 'QMD') {
      return `
        <li class="dropdown">
          <a href="#" class="nav-link dropdown-toggle">
            Core Functions
            <svg class="dropdown-icon" viewBox="0 0 24 24" width="16" height="16">
              <path fill="currentColor" d="M7 10l5 5 5-5z" />
            </svg>
          </a>
          <ul class="dropdown-menu">
            <li><a href="${links.qual_ass}" class="dropdown-link">Quality Assurance</a></li>
            <li><a href="${links.qual_enh}" class="dropdown-link">Quality Enhancement</a></li>
            <li><a href="${links.quality_promo}" class="dropdown-link">Quality Promotion</a></li>
          </ul>
        </li>
      `;
    } else if (this.currentSection === 'AcaPlan') {
      return `
        <li class="dropdown">
          <a href="#" class="nav-link dropdown-toggle">
            Core Functions
            <svg class="dropdown-icon" viewBox="0 0 24 24" width="16" height="16">
              <path fill="currentColor" d="M7 10l5 5 5-5z" />
            </svg>
          </a>
          <ul class="dropdown-menu">
            <li><a href="${links.academic_activity}" class="dropdown-link">Academic Activity</a></li>
            <li><a href="${links.programme_development}" class="dropdown-link">Programme Development</a></li>
            <li><a href="coordination_leadership.html" class="dropdown-link">Coordination & Leadership</a></li>
            <li><a href="strategic_advisory.html" class="dropdown-link">Strategic Advisory</a></li>
            <li><a href="university_liaison.html" class="dropdown-link">University Liaison</a></li>
          </ul>
        </li>
      `;
    }
    return '';
  }

  init() {
    document.addEventListener('DOMContentLoaded', () => {
      const navContainer = document.querySelector('.nav-container, section:first-child');
      if (navContainer) {
        navContainer.innerHTML = this.generateNavigation();
        this.initializeEventListeners();
      }
    });
  }

  initializeEventListeners() {
    // Mobile Menu Toggle
    const hamburger = document.getElementById("hamburger");
    const sidebar = document.getElementById("sidebar");

    hamburger?.addEventListener("click", () => {
      sidebar?.classList.toggle("show");
      hamburger.classList.toggle("active");
      const expanded = hamburger.getAttribute("aria-expanded") === "true";
      hamburger.setAttribute("aria-expanded", String(!expanded));
    });

    // Close menu when clicking outside
    window.addEventListener("click", (e) => {
      if (
        sidebar?.classList.contains("show") &&
        !sidebar.contains(e.target) &&
        !hamburger.contains(e.target)
      ) {
        sidebar.classList.remove("show");
        hamburger.classList.remove("active");
        hamburger.setAttribute("aria-expanded", "false");
      }
    });
  }
}

// Initialize navigation
const navManager = new NavigationManager();
navManager.init();