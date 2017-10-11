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
                
                <div class="row list-group">
                    <?php
                        include "./process/list_product.php"
                    ?>
                </div>
            </div>
        </div>
        
        <?php
            include_once "./include/Footer.php"
        ?>
    </body>
</html>