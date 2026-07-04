<!DOCTYPE html>
<html>
<head>
    <title>Add Service</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<div class="service-form-container">

    <h3 class="service-form-title">Add Service</h3>

    <form method="POST" action="{{ route('services.store') }}" class="service-form">
        @csrf

        <input type="hidden" name="garage_id" value="{{ auth()->user()->garage->id }}">

        <input type="text" name="service_name" placeholder="Service Name" required>
        <input type="number" name="price" placeholder="Price" required>

        <button type="submit">Add</button>
    </form>

</div>

</body>
</html>
