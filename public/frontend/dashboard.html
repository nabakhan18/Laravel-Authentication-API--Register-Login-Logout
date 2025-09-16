<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">
</head>
<body>
    <section class="container">
        <div class="login-container">
            <div class="form-container">
                <h1 class="opacity">Welcome 🎉</h1>
                <p>You are logged in successfully!</p>
                <button id="logoutBtn" class="opacity">Logout</button>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    document.getElementById('logoutBtn').addEventListener('click', async function() {
        let token = localStorage.getItem("token");

        if (!token) {
            alert("❌ No session found, please login again.");
            window.location.href = "{{ url('/login') }}";
            return;
        }

        try {
            await axios.post("{{ url('/api/logout') }}", {}, {
                headers: { Authorization: `Bearer ${token}` }
            });

            localStorage.removeItem("token");
            alert("✅ Logged out successfully!");
            window.location.href = "{{ url('/login') }}";
        } catch (error) {
            alert("❌ Logout failed. Please login again.");
            console.error(error.response?.data);
            localStorage.removeItem("token");
            window.location.href = "{{ url('/login') }}"; // ✅ Force redirect
        }
    });
    </script>
</body>
</html>
