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
                <h1>Products</h1>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                            <div class="list-group">
                                <a href="#" class="list-group-item">Category 1</a>
                                <a href="#" class="list-group-item">Category 2</a>
                                <a href="#" class="list-group-item">Category 3</a>
                            </div>
                        </div>
                    </div>

                    <div class="row list-group col-lg-9 col-md-9 col-sm-8 col-xs-12 well">
                        <?php
                            include "./process/list_product.php"
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