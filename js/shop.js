document.addEventListener('DOMContentLoaded', () => {
    fetch('../php/shop.php')
        .then(response => response.json())
        .then(products => {
            displayProducts(products);
        })
        .catch(error => console.error('Error loading products:', error));
});

function displayProducts(products) {
    const container = document.getElementById("productList");
    container.innerHTML = ""; 

    if (products.length === 0) {
        container.innerHTML = "<p style='text-align:center;'>No products found.</p>";
        return;
    }

    products.forEach(product => {
        container.innerHTML += `
            <div class="product" data-category="${product.category}">
                <img src="../images/${product.image_path}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p class="category">${product.category}</p>
                <p class="price">${product.price} SAR</p>
                <button class="btn-add-cart" onclick="addToCart('${product.name}', ${product.price})">Add to Cart</button>
            </div>
        `;
    });
}

function filterProducts(category) {
    const items = document.querySelectorAll('.product');
    items.forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        if (category === 'all' || itemCategory === category) {
            item.style.display = 'flex'; 
        } else {
            item.style.display = 'none'; 
        }
    });
}

function addToCart(name, price) {
    console.log("Added to cart: " + name);
    alert(name + " has been added to your cart!");
}