<!DOCTYPE html>
<html>
<head>
    <title>{{ $garage->name }}</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<div class="garage-details">

    <h2 class="garage-title">{{ $garage->name }}</h2>
    <p class="garage-desc">{{ $garage->description }}</p>

    @auth
        @if(auth()->id() === $garage->user_id)
            <div class="garage-actions">
                <a href="{{ route('garages.edit', $garage->id) }}" class="edit-garage-btn">
                    ✏️ Edit Garage
                </a>

                <form action="{{ route('garages.destroy', $garage->id) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete-btn">Delete Garage</button>
                </form>
            </div>
        @endif
    @endauth

    <h3 class="services-title">Services</h3>

    @foreach($garage->services as $service)
        <div class="service-card">

            <div class="service-info">
                <strong>{{ $service->service_name }}</strong>
                <p>Rs {{ $service->price }}</p>
            </div>

            @auth
                @if(auth()->id() === $garage->user_id)
                    <!-- OWNER: delete service -->
                    <form action="{{ route('services.destroy', $service->id) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this service?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete-btn">
                            🗑 Delete Service
                        </button>
                    </form>
                @else
                    <!-- OTHER USER: can book -->
             <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
    @csrf

                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <input type="date" name="booking_date" required>
                        <input type="time" name="booking_time" required>

                        <button type="submit">Book</button>
                    </form>
                @endif
            @else
                <!-- GUEST -->
                <p class="login-note">
                    <a href="{{ route('login') }}">Login</a> to book this service
                </p>
            @endauth

        </div>
    @endforeach

</div>

</body>
</html>
