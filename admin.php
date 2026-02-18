<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="admin2.css">
    <link rel="stylesheet" href="header1.css">

    <link rel="stylesheet" href="../bootstrap/assets/dist/css/bootstrap.min.css">


</head>

<body>
    <header><img src="../IMAGE/logo.png" alt="LOGO"></header>
    <nav>
        <div class="nav">
            <a href="home.php">HOME</a>
            <a href="admin.html" id="active-nav">ADMIN</a>
            <a href="" style="opacity: 0; cursor: default; pointer-events: none;">CONTACT US</a>
        </div>
        <!-- 
            <div class="search-bar">
                <form action="" method="">
                    <input type="search" id="search-input" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </div>
 -->
    </nav>
    <main>

        <div class="container">
            <section class="left">
                <div class="left-div">
                    <h2>Insert Product</h2>

                    <form action="admin-function.php" method="POST" enctype="multipart/form-data">
                        <table class="left-table">
                            <tr>
                                <td><label>Product ID:</label><br><input type="number" name="product_id" id="product_id"
                                        placeholder="Product ID" class="input" required></td>
                            </tr>
                            <tr>
                                <td><label>Insert Photo:</label><br>
                                    <input type="file" name="product_image" id="product_image" class="file-input"
                                        accept="image/*">

                            </tr>
                            <tr>
                                <td><label>Product Name:</label><br><input type="text" name="product_name"
                                        id="product_name" placeholder="Product Name" class="input" required></td>

                                </td>
                            </tr>
                            <tr>
                                <td><label>Price:</label><br><input type="text" name="price" id="price"
                                        placeholder="Price" class="input" required></td>
                            </tr>
                            <tr>
                                <td><label>Stocks:</label><br><input type="number" name="stocks" id="stocks"
                                        placeholder="Stocks" class="input" required></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="add" value="ADD" id=""><br>

                                    <input type="submit" name="edit" value="EDIT" class="input">

                                    <input type="submit" name="delete" value="DELETE"
                                        onclick="return confirm('Are you sure you want to delete this product?');">
                                </td>
                            </tr>


                    </form>
                    </table>
                </div>

            </section>
            <section>


                <div class="right-div">
                    <table class="right-table">
                        <thead class="right-thead">
                            <tr>
                                <th class="tab">Product ID</th>
                                <th class="tab">Product Image</th>
                                <th class="tab">Product Name</th>
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
                            if ($result->num_rows > 0) {
                                while ($products = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td class="td"><?php echo $products['product_id']; ?></td>

                                        <td class="td">
                                            <!-- <img src="showimage.php?id=<?php echo $products['product_id']; ?>" alt="product-1" class="product-image"> -->
                                            <!-- <img src="../IMAGE/<?php echo $products['product_image']; ?>" alt="product-1" class="product-image"> -->
                                            <img src="<?php echo $products['product_image']; ?>"
                                                alt="<?php echo $products['product_image']; ?>" class="product-image">
                                        </td>

                                        <td class="td"><?php echo $products['product_name']; ?></td>

                                        <td class="td" data-price="<?php echo $products['price']; ?>">
                                            ₱<?php echo number_format($products['price'], 2); ?></td>

                                        <td class="td"><?php echo $products['stocks']; ?></td>

                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>NO RECORD FOUND</td></tr>";
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


                    data.forEach(products => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                        <td>${products.product_id}</td>
                        <td>${products.product_image}</td>
                        <td>${products.product_name}</td>
                        <td>${products.price}</td>
                        <td>${products.stocks}</td>
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
    </main>

    <footer>
        <div class="footer-area">
            <img src="../IMAGE/logo.png" alt="">
        </div>
        <div class="footer-area">
            Shienna beroy 12-babbage
        </div>

    </footer>
</body>

</html>