<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include '../db.php';

$reports = $conn->query("SELECT * FROM reports ORDER BY created_at DESC");
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports</title>
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            background: #f4f7fa;
            color: #333;
            min-height: 100vh;
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
            font-weight: 700;
            border-left: 4px solid #14b8a6;
        }
        .logout-link {
            color: #ef4444; /* red */
            font-weight: 700;
        }

        /* Container */
        .container {
            margin-left: 270px; /* sidebar width + margin */
            padding: 40px 60px;
            width: 100%;
            max-width: 900px;
            background: #fff;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(20, 184, 166, 0.15);
        }

        h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #0f172a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #f4f7fa;
            color: #333;
            font-weight: 700;
        }

        tr:hover {
            background-color: #f0f0f0;
        }

        img {
            border-radius: 4px;
            max-width: 80px;
            height: auto;
            display: block;
        }

        .action-links a {
            margin-right: 10px;
            padding: 6px 10px;
            background-color: #14b8a6;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btns{
            display:flex;
            gap:10px;
        }
        .action-links a.delete {
            background-color: #ef4444;
        }
        .action-links a:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-header">
        <h2>IRP Reports</h2>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li><a href="../dashboard.php" class="<?php echo $currentPage == 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a></li>
            <li><a href="add_story.php" class="<?php echo $currentPage == 'add_story.php' ? 'active' : ''; ?>">Add Story</a></li>
            <li><a href="add_report.php" class="<?php echo $currentPage == 'add_report.php' ? 'active' : ''; ?>">Add Report</a></li>
            <li><a href="stories.php" class="<?php echo $currentPage == 'stories.php' ? 'active' : ''; ?>">View Stories</a></li>
            <li><a href="reports.php" class="active">View Reports</a></li>
            <li><a href="../actions/logout.php" class="logout-link">Logout</a></li>
        </ul>
    </nav>
</aside>

<div class="container">
    <h2>Reports</h2>
    <table>
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Description</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($report = $reports->fetch_assoc()) { ?>
            <tr>
                <td><img src="../uploads/<?php echo htmlspecialchars($report['thumbnail']); ?>" alt="Thumbnail"></td>
                <td><?php echo htmlspecialchars($report['title']); ?></td>
                <td><?php echo htmlspecialchars(substr($report['description'], 0, 100)); ?>...</td>
                <td><a href="<?php echo htmlspecialchars($report['link']); ?>" target="_blank" rel="noopener noreferrer">View</a></td>
                <td class="action-links">
                <div class="btns">
                    <a href="../pages/edit_report.php?id=<?php echo $report['id']; ?>">Edit</a>
                    <a href="../actions/delete_report.php?id=<?php echo $report['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this report?');">Delete</a>
                </div>
                    
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
