<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send JSON Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        input[type="text"], input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            max-width: 500px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        #clearBtn {
            background-color: #dc3545; /* Different color for clear button */
        }
        #loginSection {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #mainSection {
            display: none; /* Hide main section initially */
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>

    <div id="loginSection">
        <h1>Dialog Temi Rebot</h1>
        <input type="text" id="username" placeholder="Username" required />
        <input type="password" id="password" placeholder="Password" required />
        <button id="loginBtn">Login</button>
    </div>

    <div id="mainSection">
        <h1>Dialog Temi Welcome Messaging</h1>
        <input type="text" id="message" placeholder="Enter your message here" required />
        <div>
            <button id="sendBtn">Send</button>
            <button id="clearBtn">Clear</button> <!-- Clear button -->
        </div>
    </div>

    <script>
        const correctUsername = 'asoke'; // Set your username
        const correctPassword = 'asoke'; // Set your password

        document.getElementById('loginBtn').addEventListener('click', function() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Check if the username and password are correct
            if (username === correctUsername && password === correctPassword) {
                document.getElementById('loginSection').style.display = 'none'; // Hide login section
                document.getElementById('mainSection').style.display = 'flex'; // Show main section
            } else {
                alert('Invalid username or password. Please try again.');
            }
        });

        document.getElementById('sendBtn').addEventListener('click', function() {
            const message = document.getElementById('message').value;

            // Check if the message is not empty
            if (message.trim() === '') {
                alert('Please enter a message before sending.');
                return;
            }

            // Create a JSON object to send
            const data = { message: message };

            // Send the POST request to the specified URL
            fetch('http://18.119.41.100:1880/dtemi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Expect a JSON response
            })
            .then(data => {
                console.log('Response:', data); // Log the response for debugging
                alert('Message sent successfully: ' + data.message);
                document.getElementById('message').value = ''; // Clear the input
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Failed to send message.');
            });
        });

        // Clear button functionality
        document.getElementById('clearBtn').addEventListener('click', function() {
            document.getElementById('message').value = ''; // Clear the input
        });
    </script>

</body>
</html>
