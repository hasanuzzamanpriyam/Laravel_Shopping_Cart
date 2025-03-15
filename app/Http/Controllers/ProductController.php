<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $products = [
        ['id' => 1, 'name' => 'Laptop', 'price' => 1200, 'description' => 'Powerful laptop with 16GB RAM'],
        ['id' => 2, 'name' => 'Smartphone', 'price' => 800, 'description' => 'Latest smartphone with OLED display'],
        ['id' => 3, 'name' => 'Headphones', 'price' => 150, 'description' => 'Noise-canceling headphones'],
    ];

    $search = $request->query('search');
    if ($search) {
        $products = array_filter($products, function ($product) use ($search) {
            return stripos($product['name'], $search) !== false;
        });
    }

    $cart = session()->get('cart', []);
    $total = $this->calculateTotal($cart);

    return view('products.List', compact('products', 'cart', 'total', 'search'));
}

    public function addToCart(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = ['name' => $name, 'price' => $price, 'quantity' => 1];
        }

        session()->put('cart', $cart);
        $total = $this->calculateTotal($cart);

        return response()->json(['cart' => $cart, 'total' => $total]);
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        $total = $this->calculateTotal($cart);

        return response()->json(['cart' => $cart, 'total' => $total]);
    }

    private function calculateTotal($cart)
    {
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        $itemCount = array_reduce($cart, fn($sum, $item) => $sum + $item['quantity'], 0);

        if ($itemCount >= 3) {
            $discount = $total * 0.10;
            $total -= $discount;
        }

        return round($total, 2);
    }
}
