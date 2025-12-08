<?php
if (!isset($_SESSION)) session_start();
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>IRP Dashboard</h2>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li><a href="../dashboard.php">Dashboard</a></li>
            <li><a href="./pages/add_story.php">Add Story</a></li>
            <li><a href="./pages/add_report.php">Add Report</a></li>
            <li><a href="./pages/stories.php">View Stories</a></li>
            <li><a href="./pages/reports.php">View Reports</a></li>
            <li><a href="./actions/logoutD.php" class="logout-link">Logout</a></li>
        </ul>
    </nav>
</aside>
