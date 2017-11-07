<!--
    Document:		products.php
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
        
        <div class="content">
            <div class="container">
                <br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                            <div class="list-group">
                                <a href="products.php?filter=1" class="list-group-item">Accessories &amp; Clothing</a>
                                <a href="products.php?filter=2" class="list-group-item">Bedding/Room Décor</a>
                                <a href="products.php?filter=3" class="list-group-item">Craft Supplies</a>
                                <a href="products.php?filter=4" class="list-group-item">Jewelry</a>
                                <a href="products.php?filter=5" class="list-group-item">Soft Toys</a>
                                <a href="products.php?filter=6" class="list-group-item">Vintage Arts</a>
                                <a href="products.php?filter=7" class="list-group-item">Wedding Accessories</a>
                            </div>
                        </div>
                    </div>

                    <div class="row list-group col-lg-9 col-md-9 col-sm-8 col-xs-12 well">
                        <?php
                            include_once "./process/list_product.php";
                            if (empty($_GET["filter"])){
                                list_product(0,0);
                            } else {
                                list_product(0,$_GET["filter"]);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            include_once "./include/Footer.php"
        ?>
    </body>
</html>