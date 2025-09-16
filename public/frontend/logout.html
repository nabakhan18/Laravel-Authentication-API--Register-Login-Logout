<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/logout.css') }}">
</head>
<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <h1 class="opacity">LOGOUT</h1>
                <p class="opacity">Are you sure you want to logout?</p>

                <form id="logoutForm">
                    <button type="submit" class="opacity">LOGOUT</button>
                </form>

                <div class="register-forget opacity">
                    <a href="{{ url('/dashboard') }}">CANCEL</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    document.getElementById('logoutForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        let token = localStorage.getItem('token');
        if (!token) {
            alert("❌ No session found.");
            window.location.href = "{{ url('/login') }}";
            return;
        }

        try {
            await axios.post("{{ url('/api/logout') }}", {}, {
                headers: { Authorization: `Bearer ${token}` }
            });

            localStorage.removeItem('token');
            alert("✅ You have been logged out!");
            window.location.href = "{{ url('/login') }}";
        } catch (error) {
            console.error(error.response?.data);
            localStorage.removeItem('token');
            window.location.href = "{{ url('/login') }}";
        }
    });
    </script>
</body>
</html>
