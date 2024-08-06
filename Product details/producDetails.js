// image gallery
var ProductImg = document.getElementById("ProductImg");
var SmallImg = document.getElementsByClassName("small-img");

SmallImg[0].onclick = function () {
  ProductImg.src = SmallImg[0].src;
};
SmallImg[1].onclick = function () {
  ProductImg.src = SmallImg[1].src;
};
SmallImg[2].onclick = function () {
  ProductImg.src = SmallImg[2].src;
};
SmallImg[3].onclick = function () {
  ProductImg.src = SmallImg[3].src;
};

// quntity button
document.addEventListener("DOMContentLoaded", function () {
  const totalPriceElem = document.querySelector("[data-total-price]");
  const qtyElem = document.querySelector("[data-qty]");
  const qtyMinusBtn = document.querySelector("[data-qty-minus]");
  const qtyPlusBtn = document.querySelector("[data-qty-plus]");

  // Set the product default quantity and price
  let qty = 1;
  const productPrice = 15.0; // Updated new price

  const updateTotalPrice = () => {
    const totalPrice = (qty * productPrice).toFixed(2);
    totalPriceElem.textContent = `$${totalPrice}`;
  };

  qtyPlusBtn.addEventListener("click", () => {
    qty++;
    qtyElem.textContent = qty;
    updateTotalPrice();
  });

  qtyMinusBtn.addEventListener("click", () => {
    if (qty > 1) {
      qty--;
      qtyElem.textContent = qty;
      updateTotalPrice();
    }
  });

  // Initial call to set the price
  updateTotalPrice();
});
