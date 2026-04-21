function updateCart() {
  let tbody = document.getElementById("cart-body");
  tbody.innerHTML = "";

  let subtotal = 0;

  cart.forEach((item, index) => {
    let total = item.price * item.qty;
    subtotal += total;

    tbody.innerHTML += `
      <tr>
        <td><img src="${item.img}" width="60"></td>
        <td>${item.name}</td>
        <td>${item.price}</td>

        <td>
          <button onclick="changeQty(${index}, -1)">-</button>
          ${item.qty}
          <button onclick="changeQty(${index}, 1)">+</button>
        </td>

        <td>${total}</td>

        <td>
          <button onclick="removeItem(${index})">X</button>
        </td>
      </tr>
    `;
  });

  let tax = subtotal * 0.15;
  let final = subtotal + tax;

  document.getElementById("subtotal").textContent = subtotal.toFixed(2);
  document.getElementById("tax").textContent = tax.toFixed(2);
  document.getElementById("final").textContent = final.toFixed(2);
  document.getElementById("hiddenTotal").value = final.toFixed(2);

  document.getElementById("empty-msg").style.display =
    cart.length === 0 ? "block" : "none";
}

function changeQty(index, val) {
  cart[index].qty += val;

  if (cart[index].qty < 1) {
    cart.splice(index, 1);
  }

  updateCart();
}

function removeItem(index) {
  cart.splice(index, 1);
  updateCart();
}

updateCart();