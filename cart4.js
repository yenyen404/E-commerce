
const cartIcon = document.querySelector("#cart"); //cart icon button
const cart = document.querySelector(".cart");
const cartClose = document.querySelector("#cart-close");


// para lumabas ung cart at maclose
cartIcon.addEventListener("click", () => cart.classList.add("active"));
cartClose.addEventListener("click", () => cart.classList.remove("active"));



// mga details ng product
 const cartContent = document.querySelector(".cart-content");//to store element added to the cart

function addToCart(productBox){
    const productImgSrc = productBox.querySelector(".product-image").src;
    const productTitle = productBox.querySelector(".product-name").textContent;
    const productPrice = productBox.querySelector(".price").textContent;
    const productId = productBox.querySelector(".product_id").textContent;
    const productStock = parseInt(
    productBox.querySelector(".stocks").dataset.stock
    );


// avoid duplicate
const cartId = cartContent.querySelectorAll(".cart-id");
for(let item of cartId){
    if(item.textContent === productId){
        alert("This item is already in the cart.");
        return;
    }
}

    // new div to store products
    const cartBox = document.createElement("div");
    cartBox.classList.add("cart-box");
    cartBox.innerHTML = `
         <img src="${productImgSrc}" class="cart-img" alt="">
        <div class="cart-detail">
        <label class="cart-id" hidden>${productId}</label>
        <label class="cart-stock" hidden>${productStock}</label>

          <h4 class="cart-product-title">${productTitle}</h4>
          <span class="cart-price">${productPrice}</span>

         <div class="cart-quantity">
            <button id="decrement">-</button>
            <span class="number">1</span>
            <button id="increment">+</button>
          </div>
        </div>
        <p class="cart-remove">x</p>
    `;
    cartContent.appendChild(cartBox);

    // to remove product in the cart
    cartBox.querySelector(".cart-remove").addEventListener("click", () => {
        cartBox.remove();

           updateCartCount(-1); //decease when the product is removed

        updateTotalPrice(); 
        // to update the cart total when it remove
    });

    // quantity decrement and increment
    cartBox.querySelector(".cart-quantity").addEventListener("click", e => {
        const numberElement = cartBox.querySelector(".number");
        const stock = parseInt(cartBox.querySelector(".cart-stock").textContent);
        let quantity = parseInt(numberElement.textContent);
       

        if(e.target.id === "decrement" && quantity > 1){
            quantity--;
            // decrementButton.style.color = "#999";
     
        }else if(e.target.id === "increment"){
            if(quantity < stock){
              quantity++;
            } else{
              alert("Not enough stock available.")
            }
        
        }
        
        numberElement.textContent = quantity;

           updateTotalPrice();
        //  update totalprice in the quantity
    });

    updateCartCount(1); //cartcount update

 updateTotalPrice(); 
// new product total price updated
};


// mag add ng product sa cart gamit ang addtocart
document.querySelectorAll(".add").forEach(button => {
    button.addEventListener("click", e => {
        const productBox = e.target.closest(".product");
         addToCart(productBox);
    });
});

// update price and total
const updateTotalPrice = () =>{
    const updateTotalPriceElement = document.querySelector(".total-price");
    const cartBoxes = cartContent.querySelectorAll(".cart-box");
    let total = 0;

    cartBoxes.forEach(cartBox => {
        const priceElement = cartBox.querySelector(".cart-price");
        const quantityElement = cartBox.querySelector(".number");

        const price = parseInt(priceElement.textContent.replace("₱" , "").replace(/,/g, ''));

        const quantity = parseInt(quantityElement.textContent);

        total += price * quantity;


    });
    updateTotalPriceElement.textContent = `₱${total.toLocaleString('en-US',{minimumFractionDigits: 2,maximumFractionDigits: 2})}`;
};

// buy now - clear cart and updated total
document.querySelector(".btn-buy").addEventListener('click', () =>{
    const cartBoxes = cartContent.querySelectorAll('.cart-box');

    
    if(cartBoxes.length === 0){
        alert("YOUR CART IS EMPTY. PLEASE ADD ITEMS TO YOUR CART FIRST.");
        return;
    }

    let cartData = [];

    cartBoxes.forEach(cartBox => {
      cartData.push({
        id: cartBox.querySelector(".cart-id").textContent,
        quantity: cartBox.querySelector(".number").textContent
      });
    });

      fetch("checkout.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(cartData)
      })
      .then(res => res.json())
      .then(data => {
        alert(data.message);
        if(data.success){
          location.reload();

             cartContent.innerHTML = '';  //remove all items
              cartItemCount = 0;
              updateCartCount(0);
              updateTotalPrice(); //reset total
            
        }
      })
       .catch(error => { 
        console.error('Error:', error);
        alert('Something went wrong. Please try again later.');
    });
});

   
  
        

            
   

let cartItemCount = 0;
const updateCartCount = change => {
    const cartItemCountBandge = document.querySelector(".cart-item-count");
    cartItemCount += change;
    if(cartItemCount > 0){
        cartItemCountBandge.style.visibility = "visible";
        cartItemCountBandge.style.transform = "scale(1)";
        cartItemCountBandge.style.transition = "0.1s";
        cartItemCountBandge.textContent = cartItemCount;
        

    }else{
        cartItemCountBandge.style.visibility = "hidden";
        cartItemCountBandge.textContent = "";
        cartItemCountBandge.style.transform = "scale(0)";
           cartItemCountBandge.style.transition = "0.3s";
    }
}