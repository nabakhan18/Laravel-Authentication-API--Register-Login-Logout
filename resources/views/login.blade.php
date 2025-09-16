<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">
</head>
<body>
<section class="container">
    <div class="login-container">
        <div class="circle circle-one"></div>

        <div class="form-container">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                 alt="illustration" class="illustration" />
            <h1 class="opacity">LOGIN</h1>

            <form id="loginForm">
                <input type="email" id="email" placeholder="EMAIL" required />
                <input type="password" id="password" placeholder="PASSWORD" required />
                <button type="submit" class="opacity">LOGIN</button>
            </form>

            <div class="register-forget opacity">
                <a href="{{ url('/register') }}">REGISTER</a>
                
            </div>
        </div>

        <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
</section>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    try {
        let response = await axios.post("{{ url('/api/login') }}", {
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        });
        localStorage.setItem("token", response.data.token);
        window.location.href = "{{ url('/dashboard') }}";
    } catch (error) {
        alert("❌ Invalid credentials");
    }
});
</script>
</body>
</html>
