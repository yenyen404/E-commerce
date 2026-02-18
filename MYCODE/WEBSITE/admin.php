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
    <title>Admin</title>
    <link href="https://db.onlinewebfonts.com/c/8b65bc1a4ff631af619923cb725a246f?family=Nofret+Light" rel="stylesheet">

    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/carousel/"
    />
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="../carousel/carousel.css" rel="stylesheet" />
        <link rel="stylesheet" href="../modals/modals.css">
     <link rel="stylesheet" href="index.css">
      <link href="admin.css" rel="stylesheet">
    
  <body>
    <header data-bs-theme="dark" >
      <nav id="nav" class="navbar navbar-expand-md  fixed-top">
        <div class="container-fluid">
            <div class="logo">
            <img src="faber-castell-logo.png" class="navbar-brand"  alt=""></div>

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
 
          </div>
        </div>
      </nav>
    </header>

    <main>
    
      <div class="container marketing">  
           <div class="container-lr">
            <section class="left">
                <div class="left-div">
                    <h4>INSERT PRODUCT</h4>
                    <hr>
                    <form action="admin-function.php" method="post" enctype="multipart/form-data" >
                        <table class="left-table">
                           
                            <tr> 
                                <!-- product id -->
                                <td><label>Product ID:</label><br><input type="number" name="product_id" id="product_id" placeholder="Product ID" class="input" required></td>
                            </tr>
                            <tr> 
                                <!-- image -->
                                <td><label>Insert Image:</label><br><input type="file" name="product_image" id="product_image" class="file-input"  accept="image/*"></td>
                            </tr>
                            <tr> 
                                <!-- name -->
                                <td><label>Product Name:</label><br><input type="text" name="product_name" id="product_name" placeholder="Product name" class="input" required></td>
                            </tr>
                            <tr> 
                                <!-- price -->
                                <td><label>Price:</label><br><input type="number" name="price" id="price" placeholder="price" class="input" required></td>
                            </tr>
                            <tr> 
                                <!-- stocks-->
                                <td><label>Stocks:</label><br><input type="number" name="stocks" id="stocks" placeholder="stocks" class="input" required></td>
                            </tr>
                            <tr>  
                                <!-- button  -->  
                            <td>                             
                            <input type="submit" name="add" value="ADD" class="input"> 
                            <br>
                            <input type="submit" name="edit" value="EDIT" class="input">
                            </td>

                            </tr>

                          
                        </table>
                    </form>
                </div>
            </section>
        <section>
            <div class="right-div">
                <table class="right-table">
                    <thead class="right-thead">
                        <tr>
                            <th class="tab">Product ID</th>
                            <th class="tab">Product Image</th>
                            <th class="tab">Product name</th>
                            <th class="tab">Price</th>
                            <th class="tab">Stocks</th>
                        </tr>
                    </thead>
                    <?php
                    include "db.php";

                    $sql = "SELECT * FROM product";
                    $result = $conn->query($sql);

                    ?>

                    <tbody class="right-tbody">
                        <?php
                        if($result->num_rows > 0){
                            while($product = $result->fetch_assoc()){
                        ?>

                        <tr>
                            <!-- product id -->
                            <td class="td"><?php echo $product['product_id'];?></td>

                            <!-- product image -->
                            <td class="td"> <img src="<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_image']; ?>" class="product-image"></td>

                            <td class="td"><?php echo $product['product_name'];?></td>

                            <td class="td" data-price="<?php echo $product['price'];?>">₱<?php echo number_format($product['price'], 2);?></td>

                             <td class="td"><?php echo $product['stocks'];?></td>

                        </tr>
                        <?php
                            }
                        }else{
                            echo"<tr><th colspan='5'>NO RECORD FOUND <tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        </div>
        
        <!-- fetch data from php and populate the table -->
         <script>
             fetch('product')
              .then(response => response.json())
              .then(data => {
         const tbody = document.querySelector("table tbody");
         tbody.innerHTML = ""; //clear existing rows
     

        data.forEach(product => {
        const row = document.createElement("tr");
        row.innerHTML = `
                        <td>${product.product_id}</td>
                        <td>${product.product_image}</td>
                        <td>${product.product_name}</td>
                        <td>${product.price}</td>
                        <td>${product.stocks}</td>
        `;
           tbody.appendChild(row);
        });
       
    })
    .catch(error => console.error("Error fetching data:", error));

    //table rows click to fill form
    document.addEventListener("DOMContentLoaded", function () {
        const rows = document.querySelectorAll(".right-table tbody tr");

        rows.forEach(row => {
            row.addEventListener("click", function () {
                const cells = row.querySelectorAll("td");

                //fill form field with row data
              document.getElementById("product_id").value = cells[0].textContent;
            //   document.getElementById("product_image").value = cells[1].textContent;
              document.getElementById("product_name").value = cells[2].textContent;
              document.getElementById("price").value = cells[3].dataset.price;
              document.getElementById("stocks").value = cells[4].textContent;
            });

        });

    });
         </script>
       
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




    <script
      src="../assets/dist/js/bootstrap.bundle.min.js"
      class="astro-vvvwv3sm"
    ></script>
  </body>
</html>




