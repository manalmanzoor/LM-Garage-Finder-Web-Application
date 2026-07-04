<!DOCTYPE html>
<html>
<head>
    <title>Create Garage</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<div class="garage-form-container">

    <h3 class="garage-form-title">Create Your Garage</h3>

    <form method="POST"
          action="{{ route('garages.store') }}"
          enctype="multipart/form-data"
          class="garage-form">

        @csrf

        <label>Garage Name</label>
        <input type="text" name="name" placeholder="Enter garage name" required>

        <label>Location</label>
        <input type="text" name="location" placeholder="Enter location" required>

        <label>Description</label>
        <textarea name="description" placeholder="Describe your garage" rows="4" required></textarea>

        <label>Garage Image</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">Create Garage</button>
    </form>
 


</div>

</body>
</html>
