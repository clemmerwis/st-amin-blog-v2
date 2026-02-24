<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order #{{ $order->id }}</title>
</head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; color: #333;">

    <h2 style="border-bottom: 2px solid #333; padding-bottom: 10px;">New Order #{{ $order->id }}</h2>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 8px 0; font-weight: bold; width: 160px;">Post Title:</td>
            <td style="padding: 8px 0;">{{ $order->post->title }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Amount:</td>
            <td style="padding: 8px 0;">${{ number_format($order->amount / 100, 2) }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Order Date:</td>
            <td style="padding: 8px 0;">{{ $order->created_at->format('F j, Y g:i A') }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Order ID:</td>
            <td style="padding: 8px 0;">{{ $order->id }}</td>
        </tr>
    </table>

    <h3 style="border-bottom: 1px solid #ccc; padding-bottom: 8px;">Customer Details</h3>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 8px 0; font-weight: bold; width: 160px;">Name:</td>
            <td style="padding: 8px 0;">{{ $order->customer_name ?? 'Not provided' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Email:</td>
            <td style="padding: 8px 0;">{{ $order->customer_email ?? 'Not provided' }}</td>
        </tr>
    </table>

    <h3 style="border-bottom: 1px solid #ccc; padding-bottom: 8px;">Shipping Address</h3>

    @if($order->shipping_address)
        <p style="margin: 0; line-height: 1.6;">
            {{ $order->shipping_address['line1'] ?? 'Not provided' }}<br>
            @if(!empty($order->shipping_address['line2']))
                {{ $order->shipping_address['line2'] }}<br>
            @endif
            {{ $order->shipping_address['city'] ?? '' }}@if(!empty($order->shipping_address['city']) && !empty($order->shipping_address['state'])), @endif{{ $order->shipping_address['state'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}<br>
            {{ $order->shipping_address['country'] ?? '' }}
        </p>
    @else
        <p style="margin: 0;">Not provided</p>
    @endif

</body>
</html>
