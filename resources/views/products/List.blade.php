<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Product Listing</h1>


    <form method="GET" action="{{ url('/') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search products...">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>


    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text text-success fw-bold">${{ $product['price'] }}</p>
                        <p class="card-text">{{ $product['description'] }}</p>
                        <button onclick="addToCart({{ $product['id'] }}, '{{ $product['name'] }}', {{ $product['price'] }})"
                                class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <h2 class="mt-5">Shopping Cart</h2>
    <div class="card">
        <div class="card-body">
            <ul id="cart-items" class="list-group">
                @foreach($cart as $id => $item)
                    <li data-id="{{ $id }}" class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item['name'] }} - ${{ $item['price'] }} x {{ $item['quantity'] }}
                        <button onclick="removeFromCart({{ $id }})" class="btn btn-danger btn-sm">Remove</button>
                    </li>
                @endforeach
            </ul>
            <p class="mt-3"><strong>Total:</strong> $<span id="cart-total">{{ $total }}</span></p>
            <p id="discount-message" class="text-danger fw-bold" style="display: {{ count($cart) >= 3 ? 'block' : 'none' }}">
                🎉 10% Discount Applied!
            </p>
        </div>
    </div>
</div>

<script>
    async function addToCart(id, name, price) {
        const response = await fetch('/cart/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ id, name, price })
        });

        const data = await response.json();
        updateCart(data.cart, data.total);
    }

    async function removeFromCart(id) {
        const response = await fetch('/cart/remove', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ id })
        });

        const data = await response.json();
        updateCart(data.cart, data.total);
    }

    function updateCart(cart, total) {
        const cartItems = document.getElementById('cart-items');
        cartItems.innerHTML = '';

        let itemCount = 0;
        Object.keys(cart).forEach(id => {
            const item = cart[id];
            cartItems.innerHTML += `
                <li data-id="${id}" class="list-group-item d-flex justify-content-between align-items-center">
                    ${item.name} - $${item.price} x ${item.quantity}
                    <button onclick="removeFromCart(${id})" class="btn btn-danger btn-sm">Remove</button>
                </li>
            `;
            itemCount += item.quantity;
        });

        document.getElementById('cart-total').innerText = total;
        document.getElementById('discount-message').style.display = itemCount >= 3 ? 'block' : 'none';
    }
</script>

</body>
</html>
