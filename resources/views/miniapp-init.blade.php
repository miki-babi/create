<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mini App Init</title>

    <!-- Telegram Web App SDK -->
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body>
    <h1>Initializing Mini App...</h1>

    <script>
        const tg = window.Telegram?.WebApp;

        if (!tg) {
            console.error("Telegram WebApp object is not available");
        } else {
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
                    window.location.href = "{{ route('miniapp.main') }}";
                } else {
                    alert("Mini App init failed");
                }
            });
        }
    </script>
</body>
</html>