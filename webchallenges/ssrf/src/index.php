<?php
// src/index.php

// Define the path to the internal flag file
$flagFilePath = "/var/www/html/internal/flag.txt";

// Function to fetch content from a given URL
function fetchContent($url) {
    global $flagFilePath;

    // Allowlist URLs that start with http://example.com
    $allowed_prefix = "http://example.com";
    $parsed_url = parse_url($url);

    // Check if the URL points to localhost or the internal IP addresses
    $is_localhost = in_array($parsed_url['host'], ['localhost', '127.0.0.1', '::1']);
    
    if ($is_localhost) {
        // If it's localhost, return the contents of the flag file
        return file_get_contents($flagFilePath);
    } elseif (strpos($url, $allowed_prefix) === 0) {
        // Otherwise, fetch the content if it matches the allowed prefix
        $content = @file_get_contents($url);
        return $content ? $content : "Error: Unable to fetch content.";
    } else {
        return "Error: Only URLs starting with {$allowed_prefix} are allowed.";
    }
}

// Handle the form submission
$result = "";
if (isset($_GET['url'])) {
    $result = fetchContent($_GET['url']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Due to security reason ,we have decided to keep everything inside</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #333;
        }
        input {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 15px;
            color: #555;
            background: #f7f7f7;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>SSRF Challenge</h1>
        <p>Fetch content from a URL. Only URLs starting with <code>http://</code> IPs are allowed.</p>
        <form method="GET" action="">
            <input type="text" name="url" placeholder="Enter a URL" required>
            <button type="submit">Fetch</button>
        </form>
        <?php if ($result): ?>
            <div class="result">
                <strong>Result:</strong>
                <pre><?php echo htmlspecialchars($result); ?></pre>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
sss