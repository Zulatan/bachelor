<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Bookings</title>
</head>
<body>
    <h1>Customer Bookings</h1>

    @foreach($bookings as $booking)
        <p>{{ $booking->bookingTime }}</p>
    @endforeach
</body>
</html>
