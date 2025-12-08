<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Story</title>
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
        .sidebar-nav ul li a:hover {
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
            color: #ef4444; /* red */
            font-weight: 700;
        }

        /* Container & form */
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
        .container h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #0f172a;
        }

        /* Form card */
        form.form-card {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #334155;
        }
        input[type="text"],
        input[type="file"],
        textarea {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1.8px solid #cbd5e1;
            margin-bottom: 25px;
            font-size: 16px;
            resize: vertical;
            transition: border-color 0.3s ease;
            font-family: inherit;
        }
        input[type="text"]:focus,
        input[type="file"]:focus,
        textarea:focus {
            border-color: #14b8a6;
            outline: none;
            box-shadow: 0 0 5px #14b8a6aa;
        }

        textarea {
            min-height: 100px;
        }

        button[type="submit"] {
            background-color: #14b8a6;
            color: white;
            border: none;
            padding: 15px;
            font-size: 18px;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            align-self: flex-start;
            width: 160px;
        }
        button[type="submit"]:hover {
            background-color: #0d9488;
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
            <h2>IRP Add Story</h2>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="../dashboard.php">Dashboard</a></li>
                <li><a href="add_story.php" class="active">Add Story</a></li>
                <li><a href="add_report.php">Add Report</a></li>
                <li><a href="./pages/stories.php">View Stories</a></li>
                <li><a href="./pages/reports.php">View Reports</a></li>
                <li><a href="../actions/logout.php" class="logout-link">Logout</a></li>
            </ul>
        </nav>
    </aside>

    <div class="container">
        <h2>Add New Story</h2>
        <form action="../actions/upload_story.php" method="POST" enctype="multipart/form-data" class="form-card">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required />

            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>

            <label for="content">Content</label>
            <textarea id="content" name="content" required></textarea>

            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*" required />

            <button type="submit">Upload Story</button>
        </form>
    </div>
</body>
</html>
