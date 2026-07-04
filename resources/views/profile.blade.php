<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<div class="profile-container">

    <h3 class="profile-title">User Profile</h3>

    <!-- User Info -->
    <div class="profile-info">
        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    </div>

    <hr>

    <!-- Garage Logic -->
    @if(auth()->user()->garage)
        <h4 class="section-title">Garage Management</h4>

        <a href="{{ route('garages.show', auth()->user()->garage->id) }}" class="btn-primary">
            My Garage
        </a>

        <a href="{{ route('services.create') }}" class="btn-outline">
            Add Service
        </a>
    @else
        <h4 class="warning-text">You don’t have a garage yet</h4>

        <a href="{{ route('garages.create') }}" class="btn-primary">
            Create Your Garage
        </a>
    @endif

    

    <!-- Bookings -->
    <a href="{{ route('bookings.index') }}" class="btn-secondary">
        My Bookings
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="btn-danger">Logout</button>
    </form>

</div>

</body>
</html>
