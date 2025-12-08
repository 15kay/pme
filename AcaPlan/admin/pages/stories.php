<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include '../db.php';

$stories = $conn->query("SELECT * FROM stories ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stories</title>
    <link rel="stylesheet" href="../style.css">
    <style>
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
            background-color: #1e293b;
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
            color: #14b8a6;
            text-align: center;
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
            color: #cbd5e1;
            padding: 10px 15px;
            display: block;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .sidebar-nav ul li a:hover,
        .sidebar-nav ul li a.active {
            background-color: #14b8a6;
            color: #fff;
        }
        .sidebar-nav ul li a.active {
    background-color: #14b8a6; /* teal highlight */
    color: #fff;
    font-weight: 700;
    border-left: 4px solid #14b8a6;
}

        .logout-link {
            color: #ef4444;
            font-weight: 700;
        }

        /* Container */
        .container {
            margin-left: 270px;
            padding: 40px 60px;
            width: 100%;
            max-width: 1000px;
            background: #fff;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(20, 184, 166, 0.15);
        }

        .container h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #0f172a;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 0.75rem;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        img {
            border-radius: 6px;
        }

        /* Buttons */
        .btns{
            display:flex;
            gap:10px;
        }
        .btn-edit,
        .btn-delete {
            padding: 0.4rem 0.8rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-edit {
            background-color: #2e86de;
            color: white;
            margin-right: 0.5rem;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .container {
                margin-left: 0;
                margin-top: 20px;
                padding: 20px;
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-header">
        <h2>IRP Stories</h2>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li><a href="../dashboard.php">Dashboard</a></li>
            <li><a href="add_story.php">Add Story</a></li>
            <li><a href="add_report.php">Add Report</a></li>
            <li><a href="stories.php" class="active">View Stories</a></li>
            <li><a href="reports.php">View Reports</a></li>
            <li><a href="../actions/logout.php" class="logout-link">Logout</a></li>
        </ul>
    </nav>
</aside>

<div class="container">
    <h2>Stories</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Story</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($story = $stories->fetch_assoc()) { ?>
            <tr>
                <td>
                    <img src="../uploads/stories/<?php echo htmlspecialchars($story['image']); ?>" width="80" alt="Story Image">
                </td>
                <td><?php echo htmlspecialchars($story['title']); ?></td>
                <td><?php echo htmlspecialchars(substr($story['content'], 0, 100)); ?>...</td>
                <td><?php echo htmlspecialchars($story['created_at']); ?></td>
                <td>
                <div class="btns">
                    <a href="../actions/edit_story.php?id=<?php echo $story['id']; ?>" class="btn-edit">Edit</a>
                    
                    <a href="../actions/delete_story.php?id=<?php echo $story['id']; ?>" class="btn-delete" onclick="return confirm('Delete this story?')">Delete</a>
                </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
