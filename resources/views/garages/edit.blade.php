<!DOCTYPE html>
<html>
<head>
    <title>Edit Garage</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<div class="garage-form-container">

    <h3 class="garage-form-title">Edit Garage</h3>

    <form method="POST"
          action="{{ route('garages.update', $garage->id) }}"
          enctype="multipart/form-data"
          class="garage-form">

        @csrf
        @method('PUT')

        <label>Garage Name</label>
        <input type="text" name="name"
               value="{{ $garage->name }}" required>

        <label>Location</label>
        <input type="text" name="location"
               value="{{ $garage->location }}" required>

        <label>Description</label>
        <textarea name="description" rows="4" required>{{ $garage->description }}</textarea>

        <label>Update Image (optional)</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Update Garage</button>
    </form>

</div>

</body>
</html>
