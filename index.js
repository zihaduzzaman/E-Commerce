// Initialize cart if not exists
if (!sessionStorage.getItem('cart')) {
    sessionStorage.setItem('cart', JSON.stringify([]));
}

// Add to cart functionality
document.querySelectorAll('#view').forEach(button => {
    button.addEventListener('click', function() {
        const productCard = this.closest('.leftt-product-card');
        const productName = productCard.querySelector('h5').textContent;
        const priceText = productCard.querySelector('.current-price').textContent;
        const price = parseFloat(priceText.replace('৳', ''));
        const image = productCard.querySelector('img').src;
        
        // Get current cart
        const cart = JSON.parse(sessionStorage.getItem('cart'));
        
        // Check if product already in cart
        const existingItem = cart.find(item => item.product_name === productName);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                product_name: productName,
                price: price,
                quantity: 1,
                image: image
            });
        }
        
        // Save to session storage
        sessionStorage.setItem('cart', JSON.stringify(cart));
        
        // Update cart UI
        updateCartUI();
        
        // Show success message
        alert(`${productName} কার্টে যোগ করা হয়েছে`);
    });
});

// Update cart UI
function updateCartUI() {
    const cart = JSON.parse(sessionStorage.getItem('cart'));
    const cartItemsContainer = document.querySelector('#listcart .item');
    const totalElement = document.getElementById('total');
    
    // Clear previous items
    cartItemsContainer.innerHTML = '';
    
    // Calculate total
    let total = 0;
    
    // Add items to cart UI
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <img src="${item.image}" alt="${item.product_name}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                    <div>
                        <h6>${item.product_name}</h6>
                        <p class="mb-0">৳ ${item.price} x ${item.quantity} = ৳ ${itemTotal.toFixed(2)}</p>
                    </div>
                </div>
                <button class="btn btn-sm btn-danger remove-item" data-index="${index}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        cartItemsContainer.appendChild(itemElement);
    });
    
    // Update total
    totalElement.textContent = total.toFixed(2);
    
    // Add event listeners to remove buttons
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            removeFromCart(index);
        });
    });
    
    // Update cart count in header
    updateCartCount();
}

// Remove item from cart
function removeFromCart(index) {
    const cart = JSON.parse(sessionStorage.getItem('cart'));
    cart.splice(index, 1);
    sessionStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI();
}

// Update cart count in header
function updateCartCount() {
    const cart = JSON.parse(sessionStorage.getItem('cart'));
    document.querySelector('#subheader .nav-itemm span').textContent = cart.length;
}

// Initialize cart UI when page loads
document.addEventListener('DOMContentLoaded', function() {
    updateCartUI();
    
    // Send cart data to index.php when checkout
    document.getElementById('checkoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        
        // Get cart data
        const cart = JSON.parse(sessionStorage.getItem('cart'));
        
        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'index.php';
        
        // Add cart data as hidden inputs
        cart.forEach((item, index) => {
            for (const key in item) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `cart[${index}][${key}]`;
                input.value = item[key];
                form.appendChild(input);
            }
        });
        
        // Submit the form
        document.body.appendChild(form);
        form.submit();
    });
});