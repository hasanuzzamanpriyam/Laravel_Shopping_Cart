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
git clone https://github.com/hasanuzzamanpriyam/Laravel_Shopping_Cart.git
cd laravel-shopping-cart
```


### 2. Generate the application key (If Needed):
```bash
php artisan key:generate
```

### 3. Serve the Application
```bash
php artisan serve
```
The application will be available at: `http://127.0.0.1:8000/`

## Usage
- **Search Products**: Enter a keyword in the search bar to filter products.
- **Add Products to Cart**: Click "Add to Cart" to store products in session.
- **Remove Products**: Click "Remove" to delete items from the cart.
- **Discount System**: If you add 3 or more items, a 10% discount is applied dynamically.


## License
This project is open-source and available under the MIT License.

