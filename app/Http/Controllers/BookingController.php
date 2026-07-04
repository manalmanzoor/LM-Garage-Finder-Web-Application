<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
  use Carbon\Carbon;
class BookingController extends Controller
{
    /**
     * Ensure only logged-in users access bookings
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show BOTH:
     * - Bookings user made
     * - Orders user received (if owns garage)
     */
    public function index()
    {
        $userId = auth()->id();

        // Bookings MADE by user (customer)
        $myBookings = Booking::where('user_id', $userId)
            ->with('service.garage')
            ->latest()
            ->get();

        // Orders RECEIVED on user's garages (garage owner)
        $myOrders = Booking::whereHas('service.garage', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with('service.garage', 'user')
        ->latest()
        ->get();

        return view('bookings.index', compact('myBookings', 'myOrders'));
    }

    /**
     * Store a new booking (customer)
     */


public function store(Request $request)
{
    $request->validate([
        'services' => 'required|array|min:1',
        'booking_date' => 'required|date|after_or_equal:today',
        'booking_time' => 'required',
    ]);

    // Extra protection: time check for today
    if ($request->booking_date === now()->toDateString()) {
        if ($request->booking_time < now()->format('H:i')) {
            return back()->withErrors([
                'booking_time' => 'You cannot select a past time.'
            ])->withInput();
        }
    }

    foreach ($request->services as $serviceId) {
        Booking::create([
            'user_id' => auth()->id(),
            'service_id' => $serviceId,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
        ]);
    }

    return redirect()->back()->with(
        'success',
        'Your booking is confirmed on '
        . $request->booking_date
        . ' at '
        . $request->booking_time
    );
}
public function destroy(Booking $booking)
{
    // Only booking owner can delete
    if ($booking->user_id !== auth()->id()) {
        abort(403);
    }

    // Check 24-hour limit
    if ($booking->created_at->diffInHours(now()) > 24) {
        return back()->withErrors([
            'delete' => 'You can only cancel a booking within 24 hours.'
        ]);
    }

    $booking->delete();

    return back()->with('success', 'Booking cancelled successfully.');
}
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:accepted,rejected,pending', // validate allowed statuses
    ]);

    $booking = Booking::findOrFail($id);

    // Make sure we store the status as a string
    $booking->status = $request->status;
    $booking->save();

    return redirect()->back()->with('success', 'Booking status updated.');
}



}