<?php
    include_once "description_filter.php";
    require "db_conn.php";

    $products = mysqli_query($conn, "SELECT * FROM products ORDER BY product_date_created DESC LIMIT 4");
?>

<?php
    if (!empty($products)) {
?>
    <?php 
        foreach($products as $products) { 
    ?>
        <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
            <div class="list-productpicture">
                <a href="product_details.php?id=<?php echo $products["product_id"]; ?>">
                    <img class="list-group-image productimg" src="./<?php echo $products["product_image"]; ?>" alt="Picture of <?php echo $products["product_name"]; ?>" />
                </a>
            </div>
            <div class="list-productdetails">
                <a href="product_details.php?id=<?php echo $products["product_id"]; ?>">
                    <h4 class="list-group-item-heading"><?php echo $products["product_name"]; ?></h4>
                </a>
                
                <!--
                    <p class="list-group-item-text"><?php echo substrwords($products["product_desc"],100); ?></p>
                -->
                
                <div class="row">
                    <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <h4>$<?php echo $products["product_price"]; ?></h4>
                    </div>
                    <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <a class="btn btn-primary" href="product_details.php?id=<?php echo $products["product_id"]; ?>"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        }
    ?>
<?php
    }
?>	