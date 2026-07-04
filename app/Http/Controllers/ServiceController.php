<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Garage;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // show add service form
    public function create()
    {
        return view('services.create');
    }

    // store service
    public function store(Request $request)
    {
        $request->validate([
            'garage_id' => 'required',
            'service_name' => 'required',
            'price' => 'required|numeric',
        ]);

        Service::create([
            'garage_id' => $request->garage_id,
            'service_name' => $request->service_name,
            'price' => $request->price,
        ]);

        return redirect()->back();
    }

   
public function show(Garage $garage)
{
    $garage->load('services');
    return view('services.show', compact('garage'));
}
public function destroy(Service $service)
{
    if (auth()->id() !== $service->garage->user_id) {
        abort(403);
    }

    $service->delete();

    return redirect()->back()->with('success', 'Service deleted');
}

}
