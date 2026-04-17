let allProducts = []; // مصفوفة لتخزين المنتجات القادمة من قاعدة البيانات

// 1. جلب البيانات من الـ PHP عند تحميل الصفحة
fetch("shop.php")
    .then(res => res.json())
    .then(data => {
        allProducts = data; // تخزين البيانات
        displayProducts(allProducts); // عرض كل المنتجات في البداية
    })
    .catch(err => console.error("Error loading products:", err));

// 2. دالة عرض المنتجات في الصفحة
function displayProducts(list) {
    const container = document.getElementById("productList");
    container.innerHTML = ""; // تنظيف المكان قبل العرض

    if (list.length === 0) {
        container.innerHTML = "<p style='text-align:center; width:100%;'>No products found.</p>";
        return;
    }

    list.forEach(product => {
        // بناء "كارت" المنتج لكل عنصر في المصفوفة
        container.innerHTML += `
            <div class="product" data-category="${product.category}">
                <img src="images/${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p class="category">${product.category}</p>
                <p class="price">${product.price} SAR</p>
                <button class="btn-add-cart" onclick="addToCart('${product.name}', ${product.price})">Add to Cart</button>
            </div>
        `;
    });
}

// 3. دالة التصنيف (تعتمد على تصفية المصفوفة)
function filterProducts(category) {
    // 1. جلب كل صناديق المنتجات الموجودة في الصفحة
    const items = document.querySelectorAll('.product');

    items.forEach(item => {
        // 2. قراءة التصنيف من الـ data-category الخاص بكل صورة
        const itemCategory = item.getAttribute('data-category');

        // 3. المقارنة: إذا ضغطتِ All أو كان التصنيف يطابق نوع المنتج
        if (category === 'all' || itemCategory === category) {
            // إظهار المنتج
            item.style.display = 'flex'; 
        } else {
            // إخفاء المنتج
            item.style.display = 'none';
        }
    });
}

// دالة إضافة للسلة (لضمان عدم توقف الكود عند الضغط)
function addToCart(name, price) {
    console.log("Added to cart: " + name);
    alert(name + " has been added to your cart!");
}