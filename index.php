<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Scraper</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; }
        .images { margin-top: 20px; }
        .images img { max-width: 100%; height: auto; margin-bottom: 10px; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Web Scraper</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="url">Enter URL:</label>
                <input type="text" id="url" name="url" required>
            </div>
            <button type="submit">Scrape Images</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require 'scrape.php';
            $url = $_POST['url'];
            $images = scrapeImages($url);

            if (isset($images['error'])) {
                echo '<p class="error">' . htmlspecialchars($images['error']) . '</p>';
            } elseif (!empty($images)) {
                echo '<div class="images">';
                foreach ($images as $image) {
                    echo '<img src="' . htmlspecialchars($image) . '" alt="Image">';
                }
                echo '</div>';
            } else {
                echo '<p>No images found.</p>';
            }
        }
        ?>
    </div>
</body>
</html>