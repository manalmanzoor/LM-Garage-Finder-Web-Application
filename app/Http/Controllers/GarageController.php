<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GarageController extends Controller
{
    // show all garages (HOME PAGE)
public function index(Request $request)
{
    $query = Garage::query();

    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('location', 'like', '%' . $request->search . '%');
    }

    $garages = $query->latest()->get();

    return view('garages.index', compact('garages'));
}



    // show create garage form
    public function create()
    {
        // prevent user from creating multiple garages
        if (auth()->user()->garage) {
            return redirect()->back();
        }

        return view('garages.create');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'location' => 'required',
        'description' => 'required',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();

    // 🔥 directory already exists
    $image->move(public_path('uploads/garages'), $imageName);

    Garage::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'location' => $request->location,
        'description' => $request->description,
        'image' => 'uploads/garages/' . $imageName,
    ]);

    $garages = Garage::latest()->get();
   
    return view('garages.index', compact('garages'))
        ->with('success', 'Garage created successfully');
}







    // show single garage with services
    public function show(Garage $garage)
    {
        return view('garages.show', compact('garage'));
    }


    // show edit form
public function edit(Garage $garage)
{
    // only owner can edit
    if ($garage->user_id !== auth()->id()) {
        abort(403);
    }

    return view('garages.edit', compact('garage'));
}

// update garage
public function update(Request $request, Garage $garage)
{
    if ($garage->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'name' => 'required',
        'location' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // update image if new uploaded
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $targetDir = public_path('uploads/garages');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $image->move($targetDir, $imageName);

        $garage->image = 'uploads/garages/' . $imageName;
    }

    $garage->update([
        'name' => $request->name,
        'location' => $request->location,
        'description' => $request->description,
    ]);

    return redirect()
        ->route('garages.show', $garage->id)
        ->with('success', 'Garage updated successfully');
}





public function destroy(Garage $garage)
{
    if (auth()->id() !== $garage->user_id) {
        abort(403);
    }

    if ($garage->image) {
        $path = public_path($garage->image);
        if (file_exists($path)) {
            @unlink($path);
        }
    }

    $garage->delete();

    $garages = Garage::latest()->get();

    return view('garages.index', compact('garages'))
        ->with('success', 'Garage deleted successfully.');
}


}   