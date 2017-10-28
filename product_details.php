<!--
    Document:		product_details.php
    Author: 		Aethylwyne
    Created: 		10/7/2017
    Last Modified: 	10/10/2017

    reminder: data-ng-app=""
-->

<!DOCTYPE html>
<html>
    <head>
        <title>eMarketplace Portal System</title>

        <?php
            include_once "./include/Header.php"
        ?>
    </head>
    <body>
        <?php
            include_once "./include/NavigationBar.php"
        ?>
        
        <?php
            // get method retrieves from database
            $id = $_GET["id"];
        
            $host = "localhost";
            $user = "root";
            $pwd = "";
            $sql_db = "deallocrafthouse";
            $conn = @mysqli_connect(
                $host,
                $user,
                $pwd,
                $sql_db
            );

            $offset = 0;
            $query = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $id");
            $product = mysqli_fetch_array($query);
        ?>
        
        <div class="content">
            <div class="container">
                
                <div class="well productdetail">
                    <img class="img-responsive" src="
                        <?php
                            $directory = "./assets/images/products/" . $product["product_id"];
                            $images = glob("$directory/*.{jpg,png,bmp}", GLOB_BRACE);

                            foreach($images as $image)
                            {
                                echo $image;
                                break;
                            }
                        ?>" alt="Picture of <?php echo $product["product_name"]; ?>" />
                    <div>
                        <h2><?php echo $product["product_name"]; ?></h2>
                        <p>
                            Reviews: 
                            <?php
                                if ($product["product_rating"] == 5) {
                                    for ($i = 0; $i < 5; $i++) {
                                        echo "<span class='glyphicon glyphicon-star'></span>";
                                    }
                                } else if ($product["product_rating"] >= 4) {
                                    for ($i = 0; $i < 4; $i++) {
                                        echo "<span class='glyphicon glyphicon-star'></span>";
                                    }
                                    echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                } else if ($product["product_rating"] >= 3) {
                                    for ($i = 0; $i < 3; $i++) {
                                        echo "<span class='glyphicon glyphicon-star'></span>";
                                    }
                                    echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                    echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                } else if ($product["product_rating"] >= 2) {
                                    echo "<span class='glyphicon glyphicon-star'></span>";
                                    echo "<span class='glyphicon glyphicon-star'></span>";
                                    for ($i = 0; $i < 3; $i++) {
                                        echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                    }
                                } else if ($product["product_rating"] >= 1) {
                                    echo "<span class='glyphicon glyphicon-star'></span>";
                                    for ($i = 0; $i < 4; $i++) {
                                        echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                    }
                                } else {
                                    for ($i = 0; $i < 5; $i++) {
                                        echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                    }
                                }
                                echo " " . $product["product_rating"];
                            ?>
                        </p>
                        <p><?php echo $product["product_desc"]; ?></p>
                        
                        <h3>Size & Colors</h3>
                        <p>Weight of Product: <?php echo $product["product_weight"]; ?>kg</p>
                        
                        <h3>Shipping & Policies</h3>
                        <p>
                            <?php echo $product["product_policy"]; ?>
                        </p>
                        
                        <h3>Price</h3>
                        <p><a class="btn btn-success" href="#">$<?php echo $product["product_price"]; ?> - <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a></p>
                        
                        <p>Tags: <em><?php echo $product["product_tag"]; ?></em></p>
                    </div>
                </div>
                
                <div class="well">
                    <div class="text-right">
                        <a class="btn btn-info">Write a Review</a>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Anonymous - 10/10/2017</h4>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Anonymous - 10/10/2017</h4>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <?php
            include_once "./include/Footer.php"
        ?>
    </body>
</html>