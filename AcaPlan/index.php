<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IRP - WSU</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
</head>
<style>
    .latest-section {
        padding: 4rem 1.5rem;
        background-color: var(--bg-secondary);
        color: var(--text);
        text-align: center;
    }


    .latest-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        text-align: left;
    }

    .latest-item {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;

        /* Add this: */

    }

    .latest-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        margin-bottom: 0.75rem;
        border-radius: 4px;
        display: block;
    }

    .latest-content {
        padding: 1rem 1.5rem 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .latest-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #0d3b66;
        margin-bottom: 0.5rem;
        text-transform: none;
    }

    .latest-desc {
        font-size: 1rem;
        color: var(--text);
        opacity: 0.75;
        line-height: 1.4;
        margin: 0;
    }

    .latest-btn {
        margin-top: 1rem;
        display: inline-block;
        padding: 0.5rem 1.25rem;
        background-color: #0d3b66;
        color: #fff;
        border-radius: var(--radius);
        font-size: 0.95rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.3s ease;
        align-self: flex-start;
    }

    .latest-btn:hover {
        background-color: var(--primary-dark);
        color: #fff;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .latest-grid {
            grid-template-columns: 1fr;
        }

        .latest-img {
            height: 200px;
        }
    }
</style>

<body>
<!-- Page Loader -->
<div id="loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
  <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500 border-solid"></div>
</div>

   <section>
        <script src="../js/load-nav.js"></script>
        <!-- nav.html -->
        <header class="header">
            <!-- First Row - Logo and Search -->
            <div class="header-top">
                <div class="header-container">
                    <div class="logo-container centered-logo">
                        <img src="assets/img/logo.png" alt="WSU LOGO" class="logo-img" />
                    </div>
                    <div class="search-container">
                        <form class="search-form" id="searchForm">
                            <input type="text" class="search-input" id="searchInput" placeholder="Search..."
                                aria-label="Search" />
                            <button type="submit" class="search-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </form>
                        <div class="search-results" id="searchResults"></div>
                    </div>
                </div>
            </div>

            <!-- Second Row - Centered Navigation -->
            <div class="header-bottom">
                <!-- Hamburger Button for Mobile -->
                <button class="hamburger" id="hamburger" aria-label="Toggle navigation" aria-expanded="false"
                    aria-controls="sidebar">
                    <span class="hamburger-icon">&#9776;</span>
                    <span class="hamburger-label">Menu</span>
                </button>

                <!-- Sidebar Navigation -->
                <nav class="navbar" id="sidebar" aria-label="Mobile Navigation">
                    <!-- Sidebar Search for Mobile -->
                    <div class="sidebar-search-container">
                        <form class="sidebar-search-form" id="sidebarSearchForm">
                            <input type="text" class="sidebar-search-input" placeholder="Search..."
                                aria-label="Search" />

                        </form>
                    </div>
                     <ul class="nav-links">
        <li><a href="index.php" class="nav-link">Home</a></li>
        <li><a href="../assets/about.php" class="nav-link">About Us</a></li>
        <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle">
                Core Functions
                <svg class="dropdown-icon" viewBox="0 0 24 24" width="16" height="16">
                    <path fill="currentColor" d="M7 10l5 5 5-5z" />
                </svg>
            </a>
            <ul class="dropdown-menu">
                <li><a href="../assets/insti_efficiency.php" class="dropdown-link">Institutional Efficiency</a></li>
                <li><a href="../assets/stu.php" class="dropdown-link">Student Tracking - Institutional
                        Research</a></li>
                <li><a href="../assets/hemis.php" class="dropdown-link">HEMIS</a></li>
                <li><a href="../assets/abi.php" class="dropdown-link">Analytics & Business Intelligence</a>
                </li>

            </ul>
        </li>
        <li><a href="../assets/news.php" class="nav-link">News</a></li>
        <li><a href="../assets/team.php" class="nav-link">Meet Our Team</a></li>
        <li><a href="../assets/contact.php" onclick="contact()" class="nav-link">Contact Us</a></li>
    </ul>
                </nav>
            </div>
        </header>
    </section>
    <!-- Hero Section -->
    <section class="hero-section" style="background: linear-gradient(to top, #1d1919bb 23%, #0a0e12a0 95%), 
            url('assets/img/hero.png') no-repeat center center/cover; color: white; text-align: center; height: 100%;">
        <div class="hero-content">

            <h2>Institutional Research and Planning</h2>
            <p>
                Empowering WSU with data, insights, and strategy for student success and institutional excellence.
            </p>
            <div class="hero-buttons">
                <a href="../assets/about.html" class="btn btn-primary">Learn More</a>
                <a href="../assets/contact.html" class="btn btn-secondary">Contact Us</a>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">Who We Are</h2>

            <div class="about-grid">
                <div class="about-image">
                    <img src="assets/img/louis.png" alt="Institutional Research & Planning at WSU">
                </div>
                <div class="about-content">
                    <h3>Institutional Research & Planning at WSU</h3>

                    <p style="text-align: justify;">
                        The Institutional Research and Planning (IRP) unit plays a pivotal role in ensuring
                        evidence-based
                        decision-making across Walter Sisulu University. Through the integration of strategic data, IRP
                        supports
                        academic planning, performance measurement, and institutional effectiveness.
                    </p>

                    <p style="text-align: justify;">
                        Core activities include the coordination of university-wide surveys, longitudinal performance
                        studies,
                        programme reviews, and KPI tracking aligned to the institutional strategic plan. These research
                        outputs
                        inform senior leadership, faculties, and support departments on key academic and operational
                        trends.
                    </p>

                    <p style="text-align: justify;">
                        The IRP unit also collaborates with other directorates to deliver insight reports that support
                        academic
                        excellence, student success, and operational sustainability.
                    </p>

                    <p style="text-align: justify;">
                        Recent projects include the <strong>Graduate Destination Survey 2024</strong> and the
                        <strong>Curriculum
                            Effectiveness Analysis Report</strong>, both of which contributed to critical
                        recommendations
                        adopted by the university Senate.
                    </p>

                    <p>
                        <strong>For more information:</strong>
                        <a href="assets/reports/irp-overview-2024.pdf" target="_blank" rel="noopener noreferrer"
                            class="download-link">
                            Download the IRP Unit Overview (PDF)
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="news-events-container">
        <!-- News Section -->
        <div class="news-section">
            <h2 class="section-title">Latest News</h2>
            <div class="news-cards">
                <div class="news-card">
                    <img src="../STU/pictures/stu-roa.png" alt="News 1" class="news-image" />
                    <div class="news-content">
                        <h3 class="news-title">New Tech Innovation Announced</h3>
                        <p class="news-description">WSU launches an advanced AI model to assist students and lecturers
                            with automated learning tools.</p>
                        <a href="#" class="read-more">Read More →</a>
                    </div>
                </div>

                <div class="news-card">
                    <img src="../STU/pictures/olvia.png" alt="News 2" class="news-image" />
                    <div class="news-content">
                        <h3 class="news-title">Student Expo 2025 Highlights</h3>
                        <p class="news-description">Explore the best student projects that stole the spotlight during
                            this year’s Innovation Expo.</p>
                        <a href="#" class="read-more">Read More →</a>
                    </div>
                </div>

                <div class="news-card">
                    <img src="../STU/pictures/vc.png" alt="News 3" class="news-image" />
                    <div class="news-content">
                        <h3 class="news-title">WSU Ranked Top 5</h3>
                        <p class="news-description">Walter Sisulu University is now ranked among the top 5 institutions
                            in SA for emerging technologies.</p>
                        <a href="#" class="read-more">Read More →</a>
                    </div>
                </div>
            </div>
            <button class="view-more-btn">View More News</button>
        </div>
        <!-- Events Section -->
        <aside class="events-section">
            <h2 class="section-title">Upcoming Events</h2>
            <ul class="event-list">
                <li><strong>25 Aug:</strong> Career Expo</li>
                <li><strong>01 Sep:</strong> Hackathon Opens</li>
                <li><strong>10 Sep:</strong> Graduation Ceremony</li>
                <li><strong>15 Oct:</strong> Industry Networking Day</li>
            </ul>
        </aside>
    </section>

    <section id="latest-reports" class="latest-section">
        <div class="container">
            <h2 class="section-title">Latest Reports & Dashboards</h2>
            <div class="latest-grid">
                <article class="latest-item">
                    <img src="assets/img/follow-up.png" alt="Report 1" class="latest-img" />
                    <div class="latest-content">
                        <h3 class="latest-title">2024 Student At Risk</h3>
                        <p class="latest-desc" style="text-align: justify;">Comprehensive analysis of graduate outcomes
                            and employment trends. Identifying and supporting at-risk students remains a core focus of
                            our institution’s efforts to foster
                            equity, inclusion, and academic achievement</p>
                        <a href="reports/Student at Risk Survey V3-FINAL.pdf" class="latest-btn"
                            target="_blank">View</a>
                    </div>
                </article>

                <article class="latest-item">
                    <img src="assets/img/stop-out.png" alt="Dashboard 1" class="latest-img" />
                    <div class="latest-content">
                        <h3 class="latest-title">Stop Out Survey</h3>
                        <p class="latest-desc" style="text-align: justify;">Understanding the reasons behind student
                            stop-outs is essential for developing
                            effective strategies to improve retention, re-engagement, and overall student success.</p>
                        <a href="reports/Stop-out Survey. V3-FINAL.pdf class=" class="latest-btn"
                            target="_blank">View</a>
                    </div>
                </article>

                <article class="latest-item">
                    <img src="assets/img/graduation.png" alt="Report 2" class="latest-img" />
                    <div class="latest-content">
                        <h3 class="latest-title">Graduate Destination Survey</h3>
                        <p class="latest-desc" style="text-align: justify;">Class of 2024 – Summer Graduations. This
                            report provides valuable insights into our graduates' career trajectories and further study
                            pursuits,
                            offering a comprehensive overview of their transition from higher education into the
                            professional world.</p>
                        <a href="reports/Graduate Destination Survey V4-FINAL.pdf" class="latest-btn"
                            target="_blank">View</a>
                    </div>
                </article>

                <article class="latest-item">
                    <img src="assets/img/postgrad.png" alt="Report 2" class="latest-img" />
                    <div class="latest-content">
                        <h3 class="latest-title">Postgraduate Experience Survey 2024</h3>
                        <p class="latest-desc" style="text-align: justify;">This report marks a significant step in our
                            ongoing efforts to enhance postgraduate education,
                            ensuring our students receive the highest support, resources, and academic and professional
                            growth
                            opportunities.</p>
                        <a href="reports/Post Graduate Survey V3-FINAL.pdf" class="latest-btn" target="_blank">View</a>
                    </div>
                </article>

                <article class="latest-item">
                    <img src="assets/img/undergrad.png" alt="Report 2" class="latest-img" />
                    <div class="latest-content">
                        <h3 class="latest-title">Undergraduate Experience Survey 2024</h3>
                        <p class="latest-desc" style="text-align: justify;"> first Undergraduate Experience Survey 2024
                            Report a milestone
                            in our commitment to understanding and enhancing the student journey at WSU. This inaugural
                            survey marks a significant step forward in our efforts to listen, learn, and respond to the
                            needs of our
                            undergraduate community</p>
                        <a href="reports/Undergraduate Survey Report (V5).pdf" class="latest-btn"
                            target="_blank">View</a>
                    </div>
                </article>

                <article class="latest-item">
                    <img src="assets/img/Employment.png" alt="Report 2" class="latest-img" />
                    <div class="latest-content">
                        <h3 class="latest-title">Employment Assessment Report 2024</h3>
                        <p class="latest-desc">Insights into employment rates and skills demand across sectors.</p>
                        <a href="reports/Employability Assessment Report Final-WSU-FINAL-June-2025.pdf"
                            class="latest-btn" target="_blank">View</a>
                    </div>
                </article>
                <!-- Add more reports/dashboards as needed -->
            </div>
        </div>
    </section>

    

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="index.php" class="footer-logo">
                        Institutional
                        <span>Intelligence</span>
                    </a>
                    <p class="footer-description">Empowering WSU with data-driven insights for institutional excellence.
                    </p>
                </div>

                <div class="footer-links">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul>
                        <li><a href="assets/team.php">Meet Our Team</a></li>
                        <li><a href="assets/news.php">Our Reports</a></li>
                        <li><a href="assets/news.php">News & Blog</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4 class="footer-title">Units</h4>
                    <ul>
                        <li><a href="assets/insti_efficiency.php">Institutional Efficiency</a></li>
                        <li><a href="assets/stu.php">Student Tracking - IR</a></li>
                        <li><a href="assets/hemis.php">HEMIS</a></li>
                        <li><a href="assets/abi.php">Analytics & Business Intelligence</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4 class="footer-title">Contact Us</h4>
                    <ul>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>R102, Potsdam, East London, 5200</span>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <a href="tel:+27722002639">+27 (0)47 502 2849</a>
                        </li>
                        <li>
                            <i class="far fa-clock"></i>
                            <span>Monday - Friday, 08 am - 16:00 pm</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:irp@wsu.ac.za">irp@wsu.ac.za</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="copyright">
                    &copy; 2025 Institutional Research & Planning, Walter Sisulu University. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>