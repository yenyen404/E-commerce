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
    <title>Carousel Template · Bootstrap v5.3</title>
    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/carousel/"
    />
    <script src="../assets/js/color-modes.js"></script>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="../carousel/carousel.css" rel="stylesheet" />
    <link rel="stylesheet" href="index.css">

    
  <body>
   
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
            <form class="d-flex" role="search">
           
          </div>
        </div>
      </nav>
    </header>

    <div class="check-out-container">
      <h2 class=""></h2>
    </div>


    <main>

      <!-- Marketing messaging and featurettes
  ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->
      <div class="container marketing">
        <!-- Three columns of text below the carousel -->
         
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

            <img src="../ASSESSMENT/<?php echo $product["product_image"]; ?>" alt="" class="product-image">

            <h2 class="fw-normal" for="product-name"><?php echo $product["product_name"]; ?></h2>

            <p class="product-info">

            <strong>Price: ₱</strong><?php echo number_format($product["price"], 2);?><br>

            <strong>Stocks available:</strong> <?php echo $product["stocks"];?>
          </p>

          
            <p>
              <?php  
          if($product["stocks"] == 0){

          ?>
              <a class="btn btn-secondary" href="#" style="background-color:gray;">BUY NOW</a>
             
               <?php  
          }
          else{
          ?>

           <a class="btn btn-secondary" href="#" onclick="window.location.href='buynow.php?id=<?php echo $product['product_id']; ?>'" >BUY NOW</a>

           <?php
          }
          ?>
            </p>
          </div>
         <?php 
          }
        } else {
          echo"<p>No products available.</p>";
        }
        $conn->close();
              
              ?>
          </div>
          <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
       
        <hr class="featurette-divider" />
        <!-- /END THE FEATURETTES -->
      </div>
      <!-- /.container -->
      <!-- FOOTER -->
      <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>
          &copy; 2017–2025 Company, Inc. &middot;
          <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
        </p>
      </footer>
    </main>
    <script
      src="../assets/dist/js/bootstrap.bundle.min.js"
      class="astro-vvvwv3sm"
    ></script>
  </body>
</html>
