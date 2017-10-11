<?php
    include_once "description_filter.php";

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
    $products = mysqli_query($conn, "SELECT * FROM products LIMIT $offset, 12");
?>

<?php
    if (!empty($products)) {
?>
    <?php 
        foreach($products as $products) { 
    ?>
        <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
            <div class="list-productpicture">
                <a href="product_details.php">
                    <img class="list-group-image productimg" src="./<?php echo $products["product_image"]; ?>" alt="Picture of <?php echo $products["product_name"]; ?>" />
                </a>
            </div>
            <div class="list-productdetails">
                <a href="product_details.php">
                    <h4 class="list-group-item-heading"><?php echo $products["product_name"]; ?></h4>
                </a>

                <p class="list-group-item-text" height="20px"><?php echo substrwords($products["product_desc"],100); ?></p>

                <div class="row">
                    <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <h4>$<?php echo $products["product_price"]; ?></h4>
                    </div>
                    <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <a class="btn btn-primary" href="product_details.php" value="<?php echo $products["product_id"]; ?>"><span class="glyphicon glyphicon-info-sign"></span> View</a>
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