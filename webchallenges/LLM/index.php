<?php
// Load the flag
$flag = trim(file_get_contents("flag.txt"));

// Function to handle user input
function processInput($input) {
    global $flag;

    $input = strtolower(trim($input));

    // If input contains "flag"
    if (strpos($input, 'flag') !== false) {
        if (preg_match('/^[!&?]{1}flag$/', $input)) {
            return "Here is your flag: $flag";
        } else {
            return "Oh, by the way, I have a flag. If you need it, ask me nicely with a single special character followed by the word 'flag'.";
        }
    }

    // Predefined responses
    $valid_responses = ['hello', 'hi', 'how are you'];
    if (in_array($input, $valid_responses)) {
        return ucfirst($input) . "! What can I do for you?";
    }

    // Default response
    return "I don't understand those things. Maybe try terms like 'hello', 'hi', or 'how are you'.";
}

// Process user input
$user_input = $_POST['input'] ?? '';
$response = processInput($user_input);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtificialIntelligence</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: lightblue;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        .typing {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            border-right: 2px solid #333;
            width: 0;
            animation: typing 4s steps(10, end), blink 0.5s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0;
            }
            to {
                width: 100%;
            }
        }

        @keyframes blink {
            from, to {
                border-color: transparent;
            }
            50% {
                border-color: #333;
            }
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background: #6c63ff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #5a52e8;
        }

        .response {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="typing" id="welcome"></div>
        <form method="POST">
            <input type="text" name="input" placeholder="Type something..." required>
            <input type="submit" value="Submit">
        </form>
        <div class="response">
            <?php if ($user_input): ?>
                <p><?php echo htmlspecialchars($response); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const text = "Welcome! to our chatbot";
        const typingElement = document.getElementById("welcome");

        let index = 0;
        function typeLetter() {
            if (index < text.length) {
                typingElement.textContent += text.charAt(index);
                index++;
                setTimeout(typeLetter, 150);
            }
        }

        typeLetter();
    </script>
</body>
</html>
