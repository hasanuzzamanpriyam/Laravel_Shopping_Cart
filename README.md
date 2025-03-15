# Laravel Shopping Cart

This is a simple Laravel-based shopping cart application that includes product listing, a search feature, and a session-based shopping cart with a dynamic discount system.

## Features
- **Product Listing**: Displays a list of hardcoded products.
- **Search Functionality**: Allows users to filter products by name.
- **Shopping Cart**: Users can add/remove products to a session-based cart.
- **Dynamic Discount**: If 3 or more products are in the cart, a 10% discount is applied.
- **Bootstrap Styling**: The UI is styled using Bootstrap for a modern look.

## Installation
### 1. Clone the Repository
```bash
git clone https://github.com/your-repo/laravel-shopping-cart.git
cd laravel-shopping-cart
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Set Up Environment
Copy the `.env.example` file and rename it to `.env`:
```bash
cp .env.example .env
```
Then generate the application key:
```bash
php artisan key:generate
```

### 4. Serve the Application
```bash
php artisan serve
```
The application will be available at: `http://127.0.0.1:8000/products`

## Usage
- **Search Products**: Enter a keyword in the search bar to filter products.
- **Add Products to Cart**: Click "Add to Cart" to store products in session.
- **Remove Products**: Click "Remove" to delete items from the cart.
- **Discount System**: If you add 3 or more items, a 10% discount is applied dynamically.

## Routes
| Method | URI        | Description |
|--------|------------|-------------|
| GET    | /products  | Display the product listing |
| POST   | /cart/add  | Add a product to the cart |
| POST   | /cart/remove | Remove a product from the cart |

## Troubleshooting
### 1. 404 Error on `/products`
- Ensure the route exists by running:
```bash
php artisan route:list
```
- Try clearing the cache:
```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### 2. Search Not Working
- Ensure the search form is pointing to `route('products.index')` in the Blade file.
- Check `CartController.php` for correct query filtering logic.

## License
This project is open-source and available under the MIT License.

