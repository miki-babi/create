<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Telegram User Info</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <h2>Welcome, Telegram User!</h2>
    <p><strong>First Name:</strong> <span id="firstName">Loading...</span></p>
    <p><strong>Username:</strong> <span id="username">Loading...</span></p>
    <p><strong>Telegram User ID:</strong> <span id="userId">Loading...</span></p>

    <script>
        window.addEventListener("load", () => {
            const tg = window.Telegram.WebApp;
            tg.expand();

            const user = tg.initDataUnsafe?.user || {};

            // Display on screen
            document.getElementById("firstName").innerText = user.first_name || 'N/A';
            document.getElementById("username").innerText = user.username || 'N/A';
            document.getElementById("userId").innerText = user.id || 'N/A';

            // Send to server immediately
            fetch("/miniapp/promoter-onboard", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content")
                    },
                    body: JSON.stringify(user),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        alert("No redirect provided");
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    alert("Failed to connect to server");
                });
        });
    </script>
</body>

</html>