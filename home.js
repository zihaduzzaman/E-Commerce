document.addEventListener("DOMContentLoaded", function () {
  const toggleCartBtn = document.getElementById("cartToggle");
  const cartSection = document.getElementById("cartSection");
  const closeCartBtn = document.getElementById("closeBtn");
  const checkoutBtn = document.getElementById("checkoutBtn");
  const cartFooter = document.getElementById("buttn");

  let cart = [];
  
  const addToCartButtons = document.querySelectorAll('#view, #cartnow, #orderButton');
  const cartList = document.getElementById('listcart');
  const totalElement = document.getElementById('total');

  toggleCartBtn.addEventListener("click", function(e) {
    e.preventDefault();
    e.stopPropagation();
    cartSection.classList.toggle("active");
  });

  closeCartBtn.addEventListener("click", function(e) {
    e.preventDefault();
    e.stopPropagation();
    cartSection.classList.remove("active");
  });

  document.addEventListener("click", function(e) {
    if (!cartSection.contains(e.target) && e.target !== toggleCartBtn) {
      cartSection.classList.remove("active");
    }
  });

  addToCartButtons.forEach(button => {
    button.addEventListener('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      
      const productCard = this.closest('.product-card, .leftt-product-card, .rightt-product-card');
      
      if (productCard) {
        const productName = productCard.querySelector('h5').textContent;
        const productPriceText = productCard.querySelector('.current-price').textContent;
        const productPrice = parseFloat(productPriceText.replace(/[^\d.]/g, ''));
        const productImage = productCard.querySelector('img').src;
        
        const existingProduct = cart.find(item => item.name === productName);
        
        if (existingProduct) {
          existingProduct.quantity += 1;
        } else {
          cart.push({
            name: productName,
            price: productPrice,
            image: productImage,
            quantity: 1
          });
        }
        
        updateCartDisplay();
        cartSection.classList.add("active");
        updateCartCount();
        cartSection.scrollTop = cartSection.scrollHeight;
      }
    });
  });

  function updateCartDisplay() {
    cartList.innerHTML = '';
    let total = 0;

    cart.forEach((product, index) => {
      const productTotal = product.price * product.quantity;
      total += productTotal;

      const productElement = document.createElement('div');
      productElement.className = 'item';
      productElement.style.display = 'flex';
      productElement.style.alignItems = 'center';
      productElement.style.justifyContent = 'space-between';
      productElement.style.gap = '10px';
      productElement.style.borderBottom = '1px solid #ddd';
      productElement.style.padding = '10px 0';

      productElement.innerHTML = `
        <div style="flex: 0 0 80px; padding: 4px 7px;">
          <img src="${product.image}" alt="${product.name}" style="width: 110px; height: 100px; object-fit: cover; border-radius: 6px;">
        </div>

        <div style="flex-grow: 1;">
          <h4 style="margin: 0; font-size: 18px; color: #008fff;">${product.name}</h4>
          <p style="margin: 4px 0 0; font-size: 14px; color: black;">৳${product.price.toFixed(2)}</p>
        </div>

        <div style="min-width: 40px; text-align: right;">
          <button class="delete-btn" data-index="${index}" style="background: none; border: none; color: red; font-size: 18px; cursor: pointer;">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      `;

      cartList.appendChild(productElement);
    });

    totalElement.textContent = `৳${total.toFixed(2)}`;

    if (cart.length > 0) {
      cartFooter.style.position = 'sticky';
      cartFooter.style.bottom = '0';
      cartFooter.style.background = '#fff';
      cartFooter.style.padding = '15px 0';
      cartFooter.style.borderTop = '1px solid #eee';
    } else {
      cartFooter.style = '';
      cartSection.classList.remove("active");
    }

    addCartItemEventListeners();
  }

  function updateCartCount() {
    const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
    document.querySelector('.nav-itemm span').textContent = cartCount;
  }

  function addCartItemEventListeners() {
    document.querySelectorAll('.delete-btn').forEach(button => {
      button.addEventListener('click', function() {
        const index = parseInt(this.getAttribute('data-index'));
        cart.splice(index, 1);
        updateCartDisplay();
        updateCartCount();
      });
    });
  }

  checkoutBtn.addEventListener('click', function(e) {
    e.preventDefault();
    if (cart.length > 0) {
      // Cart data to localStorage for next page
      localStorage.setItem('checkoutItems', JSON.stringify(cart));
      window.location.href = 'index.php'; // Checkout পেজে নিয়ে যাবে
    } else {
      alert('Your cart is empty!');
    }
  });
});
