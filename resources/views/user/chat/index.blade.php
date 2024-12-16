<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        #chat-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            height: 300px;
            width: 80%;
            max-width: 600px;
            overflow-y: scroll;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #chat-box p {
            margin: 5px 0;
            padding: 8px 12px;
            border-radius: 8px;
            max-width: 70%;
            word-wrap: break-word;
        }

        #chat-box p.own-message {
            background-color: #007bff;
            color: #fff;
            margin-left: auto;
            text-align: right;
            width: fit-content;
        }

        #chat-box p.other-message {
            background-color: #f1f1f1;
            color: #333;
            margin-right: auto;
            text-align: left;
            width: fit-content;
        }

        #chat-form {
            display: flex;
            justify-content: center;
            margin-top: 10px;
            width: 80%;
            max-width: 600px;
        }

        #message {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-right: 10px;
            font-size: 14px;
            outline: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #message:focus {
            border-color: #007bff;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2 class="m-0 p-0">{{ $namaKomunitas }}</h2>
    <h3 class="m-0 p-0">Group Chat</h3>
    <div id="chat-box">
        <!-- Messages will be appended here -->
    </div>
    <form id="chat-form">
        <input type="hidden" id="komunitas-id" value="{{ $komunitasID }}"> <!-- Example komunitas_id -->
        <input type="hidden" value="{{ Auth::user()->name }}" id="username" required>
        <input type="text" id="message" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>

    <script>
        const komunitasId = $('#komunitas-id').val();
        const currentUser = $('#username').val();

        // Fetch messages
        function fetchMessages() {
            $.get(`/chat/${komunitasId}`, function(messages) {
                $('#chat-box').html('');
                messages.forEach(function(message) {
                    const messageClass = message.username === currentUser ? 'own-message' : 'other-message';
                    $('#chat-box').append(`<p class="${messageClass}"><strong>${message.username}:</strong><br> ${message.message}</p>`);
                });
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            });
        }

        // Send a message
        $('#chat-form').on('submit', function(e) {
            e.preventDefault();

            const data = {
                komunitas_id: komunitasId,
                username: $('#username').val(),
                message: $('#message').val(),
                _token: '{{ csrf_token() }}'
            };

            $.post('/chat/send', data, function(response) {
                $('#message').val(''); // Clear the input
                fetchMessages(); // Refresh messages
            });
        });

        // Fetch messages every 2 seconds
        setInterval(fetchMessages, 2000);

        // Initial load
        fetchMessages();
    </script>
</body>
</html>
