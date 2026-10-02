<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Georgia', serif; background-color: #0b0b0b; color: #f5f5f0; margin: 0; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #121212; border: 1px solid #d4af37; padding: 40px; }
        .header { text-align: center; border-bottom: 1px solid rgba(212,175,55,0.3); padding-bottom: 20px; margin-bottom: 30px; }
        .title { color: #d4af37; font-size: 24px; text-transform: uppercase; letter-spacing: 2px; margin: 0; }
        .subtitle { color: #888; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px; }
        .item-table { width: 100%; border-collapse: collapse; margin: 25px 0; }
        .item-table th { text-align: left; color: #d4af37; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid rgba(212,175,55,0.2); padding-bottom: 10px; }
        .item-table td { padding: 12px 0; font-size: 13px; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .total-row { font-weight: bold; color: #d4af37; font-size: 15px; }
        .footer { text-align: center; margin-top: 30px; font-size: 11px; color: #666; text-transform: uppercase; letter-spacing: 1px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">AKAEGO LUXURY</h1>
            <p class="subtitle">Private Client Acquisition Receipt</p>
        </div>

        <p style="font-size: 14px;">Dear {{ $order->customer_name }},</p>
        <p style="font-size: 13px; color: #ccc; line-height: 1.6;">
            Thank you for your order. We have received your order details and our concierge team is preparing your private delivery.
        </p>

        <p style="font-size: 12px; color: #d4af37; margin-top: 20px;">
            <strong>Order Reference:</strong> {{ $order->order_number }}<br>
            <strong>Status:</strong> {{ ucfirst($order->status) }} ({{ ucfirst($order->payment_status) }})
        </p>

        <table class="item-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align: right;">₦{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="border-top: 1px solid rgba(212,175,55,0.3); padding-top: 15px;">
            <p style="display: flex; justify-content: space-between; font-size: 13px; margin: 5px 0;">
                <span>Subtotal:</span>
                <span style="float: right;">₦{{ number_format($order->subtotal, 2) }}</span>
            </p>
            <p style="display: flex; justify-content: space-between; font-size: 13px; margin: 5px 0;">
                <span>Delivery Fee:</span>
                <span style="float: right;">{{ $order->shipping_fee == 0 ? 'Free' : '₦' . number_format($order->shipping_fee, 2) }}</span>
            </p>
            <p class="total-row" style="display: flex; justify-content: space-between; margin-top: 10px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
                <span>Total:</span>
                <span style="float: right;">₦{{ number_format($order->total, 2) }}</span>
            </p>
        </div>

        <div class="footer">
            <p>AKAEGO LUXURY & BOUTIQUE &bull; PRIVATE CLIENT SERVICES</p>
        </div>
    </div>
</body>
</html>