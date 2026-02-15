<!DOCTYPE html>
<html>
<head>
    <title>Mini App Init</title>
    <meta charset="UTF-8">
<script src="https://telegram.org/js/telegram-web-app.js?59"></script>

</head>
<body>
    <h1>Initializing Mini App...</h1>

    <script>
        const tg = window.Telegram?.WebApp;
        if (!tg) alert("Not running inside Telegram Web App!");

        // Immediately send initData to server
        fetch("{{ route('miniapp.init') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ initData: tg.initData })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'ok') {
                // Redirect user to main Mini App view
                window.location.href = "{{ route('miniapp.main') }}";
            } else {
                alert("Failed to initialize Mini App");
            }
        });
    </script>
</body>
</html>