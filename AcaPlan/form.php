<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit News Article</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .form-container {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        .note {
            font-size: 12px;
            color: #888;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Submit a News Article</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <!-- Title -->
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Enter news headline" required>

            <!-- Description -->
            <label for="description">Short Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Enter a brief summary" required></textarea>

            <!-- Content -->
            <label for="content">Full Content</label>
            <textarea name="content" id="content" rows="6" placeholder="Write the full news article here..." required></textarea>

            <!-- Image -->
            <label for="image">Upload Image</label>
            <input type="file" name="image" id="image" accept="image/*" required>
            <p class="note">Accepted formats: JPG, PNG. Max size: 2MB.</p>

            <!-- Submit -->
            <button type="submit">Publish News</button>
        </form>
    </div>
</body>
</html>
