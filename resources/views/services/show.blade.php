<!DOCTYPE html>
<html>
<head>
    <title>{{ $garage->name }} Services</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>
<body>

<div class="services-container">

   
    @if(session()->has('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <h2>{{ $garage->name }}</h2>
    <p>{{ $garage->description }}</p>

    @auth
        @if(auth()->id() !== $garage->user_id)


        <!-- BOOKING FORM FOR OTHER USERS -->
      <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
    @csrf
            @csrf

            <h3>Select Services</h3>

         <table id="servicesTable" class="display">
    <thead>
        <tr>
            <th>Select</th>
            <th>Service Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($garage->services as $service)
            <tr>
                <td>
                    <input type="checkbox" name="services[]" value="{{ $service->id }}">
                </td>
                <td>{{ $service->service_name }}</td>
                <td>Rs {{ $service->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>



            <div class="date-time">
<input type="date" name="booking_date" id="booking_date" required>

<input type="time" name="booking_time" id="booking_time" required>

            </div>

            <button type="submit">Book Now</button>
        </form>

        @else
            <!-- OWNER VIEW -->
            <p class="note">This is your garage. Customers will book from here.</p>
        @endif
    @else
        <p>
            <a href="{{ route('login') }}">Login</a> to book services
        </p>
    @endauth

</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#servicesTable').DataTable({
        paging: true,
        searching: true,
        info: false,
        lengthChange: false,
        ordering: false,
        pageLength: 4
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('bookingForm');
    const dateInput = document.getElementById('booking_date');
    const timeInput = document.getElementById('booking_time');

    // Block past dates
    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];
    dateInput.min = todayStr;

    form.addEventListener('submit', function (e) {

        const dateVal = dateInput.value;
        const timeVal = timeInput.value;

        if (!dateVal || !timeVal) return;

        // Create selected datetime
        const selectedDateTime = new Date(dateVal + 'T' + timeVal);
        const now = new Date();

        if (selectedDateTime < now) {
            e.preventDefault(); // 🚫 STOP SUBMIT

            alert(
                '❌ Invalid booking time\n\n' +
                'You selected a past date/time.\n' +
                'Current time: ' + now.toLocaleTimeString()
            );

            timeInput.value = '';
            timeInput.focus();
        }
    });
});
</script>




</body>
</html>
