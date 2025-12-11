<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include './db.php';

// Fetch counts
$stories_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM stories"))['total'];
$reports_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reports"))['total'];

// Fetch recent stories
$recent_stories = mysqli_query($conn, "SELECT title, created_at FROM stories ORDER BY created_at DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IRP Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
/* Reset & base */
* {
    box-sizing: border-box;
}
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f7fa;
    color: #333;
    min-height: 100vh;
    display: flex;
    transition: background-color 0.3s, color 0.3s;
}

/* Sidebar */
.sidebar {
    width: 250px;
    background-color: #1e293b; /* dark slate */
    color: #fff;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    padding: 30px 20px;
    box-shadow: 2px 0 8px rgba(0,0,0,0.15);
    display: flex;
    flex-direction: column;
    transition: background-color 0.3s;
}
.sidebar-header h2 {
    font-weight: 700;
    font-size: 24px;
    margin-bottom: 40px;
    color: #14b8a6; /* teal */
    text-align: center;
    letter-spacing: 1px;
}
.sidebar-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    flex-grow: 1;
}
.sidebar-nav ul li {
    margin-bottom: 15px;
}
.sidebar-nav ul li a {
    text-decoration: none;
    color: #cbd5e1; /* light slate */
    padding: 10px 15px;
    display: block;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    font-weight: 600;
}
.sidebar-nav ul li a:hover,
.sidebar-nav ul li a.active {
    background-color: #14b8a6;
    color: #fff;
}
.logout-link {
    color: #ef4444; /* red */
    font-weight: 700;
}

/* Main Content */
.main-content {
    margin-left: 250px;
    padding: 30px 40px;
    flex: 1;
    transition: background-color 0.3s, color 0.3s;
}

/* Top Bar */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    margin-bottom: 30px;
    transition: background-color 0.3s, color 0.3s;
}
.topbar h1 {
    margin: 0;
    font-weight: 700;
    font-size: 24px;
}
#darkModeToggle {
    background-color: #00bfa6;
    color: white;
    border: none;
    padding: 10px 16px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
#darkModeToggle:hover {
    background-color: #00a18c;
}

/* Cards */
.dashboard-cards {
    display: flex;
    gap: 20px;
    margin-bottom: 40px;
}
.card {
    flex: 1;
    background: #f0f0f0;
    padding: 30px 20px;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    text-align: center;
    transition: background-color 0.3s, color 0.3s;
}
.card h2 {
    margin: 0 0 10px;
    font-size: 48px;
    color: #14b8a6;
}
.card p {
    margin: 0;
    font-weight: 600;
    font-size: 18px;
    color: #333;
}

/* Chart Container */
.charts-container {
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: background-color 0.3s, color 0.3s;
}
.charts-container h3 {
    margin-top: 0;
    margin-bottom: 20px;
    font-weight: 700;
    color: #0f172a;
}

/* Recent Activity */
.recent-activity {
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: background-color 0.3s, color 0.3s;
}
.recent-activity h3 {
    margin-top: 0;
    margin-bottom: 20px;
    font-weight: 700;
    color: #0f172a;
}
.recent-activity ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.recent-activity ul li {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
    font-size: 16px;
    transition: border-color 0.3s;
}
.recent-activity ul li:last-child {
    border-bottom: none;
}

/* Links & Buttons */
.action-links a {
    color: #007bff;
    text-decoration: none;
    font-weight: 600;
}
.action-links a:hover {
    text-decoration: underline;
}


/* Images */
img {
    border-radius: 6px;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding: 20px;
    }
    .main-content {
        margin-left: 0;
        padding: 20px;
    }
    .dashboard-cards {
        flex-direction: column;
    }
}



</style>
<body>
    <?php include './components/sidebar.php'; ?>

    <div class="main-content">
        <header class="topbar">
            <h1>Welcome, <?= $_SESSION['username'] ?> 👋</h1>
            
        </header>

        <section class="dashboard-cards">
            <div class="card">
                <h2><?= $stories_count ?></h2>
                <p>Stories</p>
            </div>
            <div class="card">
                <h2><?= $reports_count ?></h2>
                <p>Reports</p>
            </div>
        </section>

        <section class="charts-container">
            <h3>Story Uploads Over Time</h3>
            <canvas id="storiesChart" height="100"></canvas>
        </section>

        <section class="recent-activity">
            <h3>Recent Stories</h3>
            <ul>
                <?php while($row = mysqli_fetch_assoc($recent_stories)): ?>
                    <li>
                        <strong><?= htmlspecialchars($row['title']) ?></strong>
                        <span><?= date('M d, Y', strtotime($row['created_at'])) ?></span>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>
    </div>

    <script>
    const ctx = document.getElementById('storiesChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Stories',
                data: [3, 7, 5, 9], // Example static data
                backgroundColor: '#3498db'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Dark mode toggle
    const toggle = document.getElementById("darkModeToggle");
    toggle.onclick = () => {
        document.body.classList.toggle("dark");
    };
    </script>
</body>
</html>
