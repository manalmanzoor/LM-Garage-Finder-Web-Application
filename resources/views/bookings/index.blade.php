<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        table.display {
            width: 100%;
            border-collapse: collapse;
        }

        table.display th,
        table.display td {
            padding: 10px;
            text-align: center;
        }

        table.display th {
            background-color: #f2f2f2;
        }

        .delete-btn,
        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            margin: 2px;
        }

        .delete-btn {
            background-color: #ff4d4f;
        }

        .action-btn.accept {
            background-color: #4CAF50;
        }

        .action-btn.reject {
            background-color: #f44336;
        }

        .status-span {
            font-weight: bold;
        }

        .status-pending {
            color: orange;
        }

        .status-accepted {
            color: green;
        }

        .status-rejected {
            color: red;
        }

        .empty {
            text-align: center;
            font-style: italic;
            color: gray;
            margin: 15px 0;
        }

        .success-message {
            background: #d1e7dd;
            color: #0f5132;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        .error-message {
            background: #f8d7da;
            color: #842029;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="bookings-container">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    {{-- DELETE ERROR --}}
    @if($errors->has('delete'))
        <div class="error-message">
            {{ $errors->first('delete') }}
        </div>
    @endif

    {{-- ========================= --}}
    {{-- MY BOOKINGS (CUSTOMER) --}}
    {{-- ========================= --}}
    <h2 class="page-title">My Bookings</h2>

    @if($myBookings->isEmpty())
        <p class="empty">You have not made any bookings yet</p>
    @else
        <table id="myBookingsTable" class="display">
            <thead>
                <tr>
                    <th>Garage</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($myBookings as $booking)
                    <tr>
                        <td>{{ $booking->service->garage->name }}</td>
                        <td>{{ $booking->service->service_name }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->booking_time }}</td>

                        <td>
                            <span class="status-span status-{{ $booking->status }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        <td>
                            @if($booking->status === 'pending')
                                @php
                                    $canDelete = $booking->created_at->diffInHours(now()) <= 24;
                                @endphp

                                @if($canDelete)
                                    <form method="POST"
                                          action="{{ route('bookings.destroy', $booking->id) }}"
                                          onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-btn">Cancel</button>
                                    </form>
                                @else
                                    <span>Not Cancelable</span>
                                @endif
                            @else
                                <span>—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- ========================= --}}
    {{-- ORDERS RECEIVED (GARAGE OWNER) --}}
    {{-- ========================= --}}
    <h2 class="page-title">Orders Received</h2>

    @if($myOrders->isEmpty())
        <p class="empty">No orders received yet</p>
    @else
        <table id="myOrdersTable" class="display">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Garage</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($myOrders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->service->garage->name }}</td>
                        <td>{{ $order->service->service_name }}</td>
                        <td>{{ $order->booking_date }}</td>
                        <td>{{ $order->booking_time }}</td>

                        <td>
                            <span class="status-span status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td>
                            @if($order->status === 'pending')
                                <form method="POST"
                                      action="{{ route('orders.updateStatus', $order->id) }}">
                                    @csrf
                                    <button name="status" value="accepted" class="action-btn accept">
                                        Accept
                                    </button>
                                    <button name="status" value="rejected" class="action-btn reject">
                                        Reject
                                    </button>
                                </form>
                            @else
                                <span>—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

{{-- SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myBookingsTable').DataTable({
            pageLength: 5,
            lengthChange: false,
            searching: true
        });

        $('#myOrdersTable').DataTable({
            pageLength: 5,
            lengthChange: false,
            searching: true
        });
    });
</script>

</body>
</html>
