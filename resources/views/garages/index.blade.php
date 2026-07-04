<!DOCTYPE html>
<html>
<head>
    <title>Garage Finder</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<!-- HEADER -->
<div class="header">

    <!-- LEFT: LOGO + NAME -->
    <div class="logo-wrapper">
        <img src="{{ asset('garages/carlogo.png') }}" alt="LM Garage Finder Logo" class="site-logo">
        <h2 class="logo">LM Garage Finder</h2>
    </div>

    <!-- RIGHT: SEARCH + AUTH -->
    <div class="header-right">

        <form method="GET" action="" class="search-form">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search garages"
            >
            <button type="submit">Search</button>
        </form>

        <div class="auth-buttons">
            @auth
                <a href="{{ route('profile') }}" class="profile-btn">Profile</a>
            @else
                <a href="{{ route('login') }}" class="profile-btn">Login</a>
                <a href="{{ route('register') }}" class="profile-btn outline">Register</a>
            @endauth
        </div>

    </div>
</div>

<!-- GARAGE LIST -->
<div class="garage-grid">

    @forelse($garages as $garage)
        <div class="garage-card">

            @if($garage->image)
                <img src="{{ asset($garage->image) }}" alt="Garage">
            @else
                <img src="https://via.placeholder.com/400x200?text=Garage">
            @endif

            <div class="garage-body">
                <h3>{{ $garage->name }}</h3>
                <p class="location">📍 {{ $garage->location }}</p>
                <p class="desc">{{ Str::limit($garage->description, 80) }}</p>

                <a href="{{ route('services.show', $garage->id) }}" class="view-btn">
                    View services
                </a>
            </div>

        </div>
    @empty
        <p class="empty">No garages available</p>
    @endforelse

</div>

</body>
</html>
