<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Create Order</h1>
    <form action="{{ route('orders.prepare') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="total" class="form-label">Total Amount</label>
            <input type="number" class="form-control" id="total" name="total" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
