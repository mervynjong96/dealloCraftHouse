<?php
function list_product($list) {
    
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

    if ($list == 1) {
        // sort by new products
        $products = mysqli_query($conn, "SELECT * FROM products ORDER BY product_date_created DESC LIMIT 4");       
    } else if ($list == 2) {
        // sort by editor's pick
        $products = mysqli_query($conn, "SELECT * FROM products ORDER BY product_quantity_sold DESC LIMIT 4");
    } else {
        $offset = 0;
        $products = mysqli_query($conn, "SELECT * FROM products LIMIT $offset, 12");
    }

    if (!empty($products)) {
        foreach($products as $products) { 
?>
            <div class="item product col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="list-productpicture">
                    <a href="product_details.php?id=<?php echo $products["product_id"]; ?>">
                        <!--
                            <img class="list-group-image productimg" src="./assets/images/products/<?php echo $products["product_id"]; ?>" alt="Picture of <?php echo $products["product_name"]; ?>" />
                        -->
                        <img class="list-group-image productimg" src="
                        <?php
                            $directory = "./assets/images/products/" . $products["product_id"];
                            $images = glob("$directory/*.{jpg,png,bmp}", GLOB_BRACE);

                            foreach($images as $image)
                            {
                                echo $image;
                                break;
                            }
                        ?>" alt="Picture of <?php echo $products["product_name"]; ?>" />
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
    } else {
        echo "<p>Nothing to see here! For now...</p>";
    }
}
?>

