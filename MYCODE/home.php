<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="home4.css"/>
    <link rel="stylesheet" href="header1.css"/>

    <link rel="stylesheet" href="../../bootstrap/assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/carousel/carousel.css">
      <script
      src="../../bootstrap/assets/dist/js/bootstrap.bundle.min.js"
      class="astro-vvvwv3sm"
    ></script>
   

</head>

<body>
    <header><img src="../IMAGE/logo.png" alt="LOGO">
    </header>
        <nav>
            <div class="nav">
            <a href="home.php" id="active-nav">HOME</a>
            <a href="admin.php">ADMIN</a>
            <a href="contact.html">CONTACT US</a>
            </div>

            <div class="search-bar">
                <form action="" method="">
                    <input type="search" id="search-input" placeholder="Search...">
                    <button type="submit">Search</button>
            
                </form>
            </div>
            <div class="cart-profile">
                  <img src="../IMAGE/user.png" id="profile"/>
                 <img src="../IMAGE/white-cart.png" id="cart"/>
                 <span class="cart-item-count"></span>
           </div>
           
        </nav>

        <!-- cart -->
       
  <div class="cart">
      <h2 class="cart-title"> Your Cart</h2>
    <div class="cart-content">
      <!-- <div class="cart-box">
         <img src="../IMAGE/product4.jpg" class="cart-img" alt="">
        <div class="cart-detail">
          <h2 class="cart-product-title">crayola</h2>
          <span class="cart-price">₱0</span>
         <div class="cart-quantity">
            <button id=="decrement">-</button>
            <span class="number">1</span>
            <button id="increment">+</button>
          </div>
        </div>
        <p class="cart-remove">x</p>
      </div> -->
    </div>
    <div class="total">
      <div class="total-title">Total</div>
      <div class="total-price">₱0</div>
    </div>
   <button class="btn-buy">Buy now</button>
    <p id="cart-close">X</p>
  </div>
 
    <main>
        <section>
<!-- carousel -->
            <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
           <img src="../IMAGE/imagee.jpg" alt="" class="carousel-img">
          
          </div>
          <div class="carousel-item">
           
            <img src="../IMAGE/image2.jpg" alt="" class="carousel-img">
           
          </div> 
          <div class="carousel-item">
           
             <img src="../IMAGE/image3.jpg" alt="" class="carousel-img">
             
           
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
  

         </section> 


               
<!-- product card -->
        <section>
          <!-- php -->
          <?php
          include "db.php";

          $sql = "SELECT * FROM product";
          $result = $conn->query($sql);

          ?>

             <div class="grid">

             <?php
             if ($result->num_rows > 0){
               while ($products = $result->fetch_assoc()){
             
             ?>
         <div class="product">
           <!-- product_id -->
           <div class="product_id" hidden>
                <label for="id"><?php echo $products["product_id"]; ?></label>
             </div>

            <!-- img holder -->
                <div class="product-img-holder">
                <!-- <img src="showimage.php?id=<?php echo $products['product_id']; ?>" alt="product-1" class="product-image"> -->

                <img src="../IMAGE/<?php echo $products['product_image']; ?>" alt="" class="product-image">

                  <!-- <img src="<?php echo $products['product_image']; ?>" alt="<?php echo $products['product_image']; ?>"class="product-image"> -->
                </div>
                
                <!-- name label -->
                 <div class="label-box">
                    <h4 class="product-name">
                    <?php echo $products['product_name']; ?></h4>

                 </div>

                 <!-- price label -->
                 <div class="label-box">
                    <strong class="price"> ₱<?php echo number_format($products['price'], 2); ?></strong> 
                    
                 </div>

                 <!-- stock label -->
                 <div class="label-box">
                    <strong class="stocks" data-stock="<?php echo $products['stocks']; ?>">Stocks Available:  <?php echo $products['stocks']; ?></strong>
                   
                 </div>

                
                 <!-- button -->
                <div class="buttons">
                 
                    <!-- <button class="add" onclick="addtocart(<?php echo $products['product_id']; ?>)">Add to Cart</button> -->


                     <?php
                  if($products['stocks'] == 0){
                  ?> 
                   <button class="add" style="background-color:gray;"  disabled>Add to Cart</button>

                    <button class="buy" style="background-color:gray;" disabled>Buy now</button>

                   


                    <?php
                  }
                  else{
                    ?>
                    <button class="add">Add to Cart</button>
                    
                      <button class="buy" onclick="window.location.href='buynow.php?id=<?php echo $products['product_id']; ?>'">Buy now</button>
                      <?php

                  }
                    ?>
                </div>
                </div>
                <?php
               }
              } else { 
                echo "<p>No products available.</p>";
              }
              $conn->close();
                ?>

               </div>
            </section>



        <section>
            
            
        </section>
    </main>

    <footer>
        <div class="footer-area">
            <img src="../IMAGE/logo.png" alt="" >
        </div>
        <div class="footer-area">
            Shienna beroy 12-babbage
        </div>
        
    </footer>
    <script src="cart4.js">

    </script>
</body>
</html>