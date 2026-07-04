<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('/style.css') }}">
</head>
<body>

<div class="container">
    <div class="card">
        <h2 style="text-align:center;">Register</h2>
@if ($errors->any())
    <div class="error-box">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <label>Name</label>
            <input type="text" name="name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>

        <p style="text-align:center;">
            Already have an account?
            <a href="{{ url('/login') }}" style="color:#38bdf8;">Login</a>
        </p>
    </div>
</div>

</body>
</html>
