<!DOCTYPE html>
<html>
<head>
    <title>Orders Report</title>
</head>

<body>

<h2>Orders Report</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">

    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Product</th>
        <th>Total</th>
        <th>Status</th>
    </tr>

    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->customer_name }}</td>
            <td>{{ $order->product->name ?? 'Deleted' }}</td>
            <td>${{ $order->total_price }}</td>
            <td>{{ $order->status }}</td>
        </tr>
    @endforeach

</table>

</body>
</html>