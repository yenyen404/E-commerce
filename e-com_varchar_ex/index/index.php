
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Mark Otto, Jacob Thornton, and Bootstrap contributors"
    />
    <meta name="generator" content="Astro v5.13.2" />
    <title> HOME</title>
    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/carousel/"
    />
    <script src="../assets/js/color-modes.js"></script>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="../carousel/carousel.css" rel="stylesheet" />
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="../modals/modals.css">

    
  <body class="body">
   
    <header data-bs-theme="dark">
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">MY PRODUCT</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#">About</a></li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Contact</a>
              </li>
            </ul>
            <!-- <form class="d-flex" role="search"></form> -->
           
          </div>
        </div>
      </nav>
    </header>

    <div class="check-out-container">
      <h2 class=""></h2>
    </div>

  
    <main>


    <!-- product -->
    
      <div class="container marketing">     
        
        <?php 
          include "db.php";

          $sql = "SELECT * FROM product";
          $result = $conn->query($sql);
        ?>

        <div class="row">
          
        <?php
        if ($result->num_rows > 0){
          while ($product = 
          $result->fetch_assoc()){
        

        ?>
          <div class="col-lg-4">

           <!-- product id -->
            <input type="hidden" value="<?php echo $product["product_id"]?>" class="input-product" id="product_id">

            <!-- product image -->
            <img src="../ASSESSMENT/<?php echo $product["product_image"]; ?>" alt="" class="product-image">

            <!-- product name -->
            <h2 class="fw-normal" for="product-name"><?php echo $product["product_name"]; ?></h2>
            
            <!-- <input type="text" value="<?php echo $product["product_name"]; ?>" name="product_name" class="input-product" readonly hidden></h2> -->

            <p class="product-info">

            <!-- product price -->
            <strong>Price: ₱</strong><?php echo number_format($product["price"], 2);?><br>

            <!-- <input type="hidden" value="<?php echo $product["price"];?>" name="price" class="input-product" readonly><br> -->

            <!-- product stocks -->
            <strong>Stocks available:</strong> <?php echo $product["stocks"];?> 
                 <input type="hidden" value="<?php echo $product["stocks"];?>" id="stocks"
                 class="input-product" readonly>
          </p>

          
          <!-- buyButton -->
           <?php
           if($product['stocks'] == 0){
             
           ?>
           
            <p>
           <a class="btn btn-secondary" href="#" style="
           background-color:rgba(0, 0, 0, 0.364);
           border:none;
           pointer-events:none;
          
           " id="buy-btn">NO STOCKS AVAILABLE</a>
            </p>

            <?php
           }else{

           ?>
             <p>
           <a class="btn btn-secondary" href="#" onclick="buyBtn(<?php echo $product['product_id']; ?>,'<?php echo $product['product_image'];?>','<?php echo addslashes($product['product_name']);?>', <?php echo $product['price'];?>, <?php echo $product['stocks'];?>)" id="buy-btn">BUY NOW</a>
            </p>
           <?php 
           }
           ?>
          </div>      

                <?php 
          }
        } else {
          echo"<p>No products available.</p>";
        }
       $conn->close();
          
              ?>
          </div>  
        </div>
 

       
        <hr class="featurette-divider" />
        <!-- /END THE FEATURETTES -->
         
      </div>
  
      <!-- FOOTER -->
      <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>
          &copy; 2017–2025 Company, Inc. &middot;
          <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
        </p>
      </footer>
    </main>

 <!-- modal -->

    <dialog id="modal">
    
        <div class="modal-content">
      <form action="order.php" method="post">
           <h2 class="modal-title">CHECK OUT</h2>

          <div class="mBox">
          
          <!-- modal id -->
            <input type="hidden"  id="mId" name="product_id" value="">
            
            <!-- modal image -->
            <img src="" alt="" id="mImage">

            <div class="modal-detail">

            <!-- modal name -->
              <h2 id="mName"></h2>
              
              <input type="hidden"  id="mNameInput" name="product_name" value="">

              <!-- modal price -->
              <label for="">Price: ₱</label>
              <span id="mPrice"></span>

              <input type="hidden"  id="mPriceInput" name="price" value="" >

              <!-- modal stock -->
               <p hidden>
              <label for="">stock: </label><input type="hidden" id="mStocks" value="" >
              </p>

              
              <!-- modal quantity -->
              <p for="">Quantity:</p> 
              <input type="number" min="1" value="" name="quantity" id="quantity">

              <input type="hidden" name="total_order" id="quantityHidden">

               <!-- total price -->
              <p for="" class="total-label">Total: ₱<input type="number" 
              id="mTotal" value="" name="total_price" readonly></p>
              
      
            </div>
          </div>
    

        <!-- check out button -->
 
        <input type="submit" id="btn-checkOut" name="check-out" value="Check Out">
          
      </div>

      <!-- exit modal button -->
      <button id="modal-close" onclick="closeModal()">X</button>
    </form>
      </dialog> 


     <script>
     let price = 0;
         
     function buyBtn(id, image, name, productPrice, stock){
      price = parseFloat(productPrice);

      document.getElementById('mId').value = id;
      document.getElementById('mName').innerText = name;
      document.getElementById('mImage').src = "../ASSESSMENT/" + image;
      document.getElementById('mPrice').innerText = price.toFixed(2);
      document.getElementById('mTotal').value = price.toFixed(2);
      document.getElementById('quantity').value = 1;
      document.getElementById('mStocks').value = stock;

      // input modal
      document.getElementById('mNameInput').value = name;
      document.getElementById('mPriceInput').value = price;
      document.getElementById('quantityHidden').value = 1;



      
      document.getElementById('modal').showModal();
     }

     function closeModal(){
      document.getElementById('modal').close();
     }

     document.getElementById('quantity').addEventListener("input", function(){
        const quantity = parseFloat(this.value) || 0;
        const total = price * quantity;
        document.getElementById('quantityHidden').value = quantity;

        document.getElementById('mTotal').value = total.toFixed(2);

       

     });

 

     
     </script>
    
    <script
      src="../assets/dist/js/bootstrap.bundle.min.js"
      class="astro-vvvwv3sm"
    ></script>
    
  </body>
</html>
