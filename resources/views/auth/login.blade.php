<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('/style.css') }}">
</head>
<body>

<div class="container">
    <div class="card">
        <h2 style="text-align:center;">Login</h2>
@if ($errors->any())
    <div class="error-box">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p style="text-align:center;">
            Don’t have an account?
            <a href="{{ url('/register') }}" style="color:#38bdf8;">Register</a>
        </p>
    </div>
</div>

</body>
</html>
