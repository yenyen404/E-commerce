<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta
    name="author"
    content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
  <meta name="generator" content="Astro v5.13.2" />
  <title>Home</title>
  <link href="https://db.onlinewebfonts.com/c/8b65bc1a4ff631af619923cb725a246f?family=Nofret+Light" rel="stylesheet">

  <link
    rel="canonical"
    href="https://getbootstrap.com/docs/5.3/examples/carousel/" />
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="../carousel/carousel.css" rel="stylesheet" />
  <link rel="stylesheet" href="../modals/modals.css">
  <link rel="stylesheet" href="index.css">

<body>
  <header data-bs-theme="dark">
    <nav id="nav" class="navbar navbar-expand-md  fixed-top">
      <div class="container-fluid">
        <div class="logo">
          <img src="faber-castell-logo.png" class="navbar-brand" alt="">
        </div>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">


          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="Product.php">Product</a></li>
            <li class="nav-item">
              <a class="nav-link" href="About.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contact.html">Contact Us</a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>

  <main>
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"></button>
        <button
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="carousel1.png" alt="">
        </div>
        <div class="carousel-item">
          <img src="carousel2.png" alt="">
        </div>
        <div class="carousel-item">
          <img src="carousel.png" alt="">

        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#myCarousel"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#myCarousel"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- Marketing messaging and featurettes
  ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <h2>Product Features</h2>
      <hr>

      <?php
      include "db.php";

      $sql = "SELECT * FROM product";
      $result = $conn->query($sql);
      ?>
      <div class="row">

        <?php
        if ($result->num_rows > 0) {
          while ($product = $result->fetch_assoc()) {

        ?>

            <div class="col-lg-4">

              <!-- product id -->
              <input type="hidden" value="<?php echo $product["product_id"]; ?>" id="product_id">

              <!-- img -->
              <img src="img.php?product_id=<?php echo $product["product_id"]; ?>" class="product-image" alt="">

              <!-- product name -->
              <h2 class="fw-normal"><?php echo $product["product_name"]; ?></h2>

              <p class="product-info">
                <strong>Price: </strong>₱<?php echo $product["price"]; ?>
                <br>
                <strong>Stocks Available: </strong><?php echo $product["stocks"]; ?>
              </p>

              <?php
              if ($product['stocks'] == 0) {


              ?>
                <p>
                  <a class="btn btn-secondary"
                    id="buy-btn" style="
             background-color:gray;
             pointer-events:none;
             color:white;
             ">Unavailable Stocks </a>
                </p>

              <?php
              } else {


              ?>
                <p>
                  <a class="btn btn-secondary"
                    onclick="buyBtn(<?php echo $product['product_id']; ?>,'img.php?product_id=<?php echo $product['product_id']; ?>','<?php echo addslashes($product['product_name']); ?>', <?php echo $product['price']; ?>, <?php echo $product['stocks']; ?>)" id="buy-btn">Buy Now</a>
                </p>
              <?php
              }
              ?>
            </div>


        <?php
          }
        } else {
          echo "<p>No Product Available.</p>";
        }
        ?>
      </div>

    </div>
    <hr>
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

  <!-- modal -->
  <dialog id="modal">

    <div class="modal-content">
      <form action="orders.php" method="post">
        <h2 class="modal-title">CHECK OUT</h2>

        <div class="mBox">

          <!-- modal id -->
          <input type="hidden" id="mId" name="product_id" value="">

          <!-- modal image -->
          <img src="" alt="" id="mImage">

          <div class="modal-details">
            <!-- modal name -->
            <h2 id="mName"></h2>

            <input type="hidden" id="mNameInput" name="product_name" value="">

            <!-- modal price -->
            <label for="">Price: ₱</label>
            <span id="mPrice"></span>

            <input type="hidden" id="mPriceInput" name="price" value="">

            <!-- modal stock -->
            <p hidden>
              <label for="">Stock: </label>
              <input type="hidden" id="mStocks" value="">
            </p>

            <!-- modal quantity -->
            <p>Quantity:</p>
            <input type="number" min="1" value="" name="quantity" id="quantity">

            <input type="hidden" name="total_order" id="quantityHidden">

            <!-- total price -->
            <p class="total-label">Total: ₱<input type="number" id="mTotal" value="" name="total_price" readonly></p>

            <div class="user-info">
              <p style="text-align:center;">CUSTOMER INFORMATION:</p>
              <!-- user -->

              <!-- name -->
              <p class="total-label">Name: <input style="  width: 70%;" type="text" id="mUserName" value="" name="user_name" required></p>

              <!-- number -->
              <p class="total-label">Number: <input style="  width: 64%;" type="number" id="mUserNum" value="" name="user_number" required></p>

              <!-- address -->
              <p class="total-label">Address: <input style="  width: 65%;" type="text" id="mUserAddress" value="" name="user_address" required></p>
            </div>
          </div>


        </div>


        <!-- check out button -->
        <dv class="check-out">
          <input type="submit" id="btn-checkOut" name="check-out" value="Check Out">
    </div>
    </div>
    </form>
    <!-- exit -->
    <button id="modal-close" onclick="closeModal()">X</button>

  </dialog>

  <script>
    let price = 0;

    function buyBtn(id, image, name, productPrice, stock) {
      price = parseFloat(productPrice);

      document.getElementById('mId').value = id;
      document.getElementById('mName').innerText = name;
      document.getElementById('mImage').src = "../WEBSITE/" + image;
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

    function closeModal() {
      document.getElementById('modal').close();
    }

    document.getElementById('quantity').addEventListener("input", function() {
      const quantity = parseFloat(this.value) || 0;
      const total = price * quantity;
      document.getElementById('quantityHidden').value = quantity;
      document.getElementById('mTotal').value = total.toFixed(2);


    });
  </script>


  <script
    src="../assets/dist/js/bootstrap.bundle.min.js"
    class="astro-vvvwv3sm"></script>
</body>

</html>