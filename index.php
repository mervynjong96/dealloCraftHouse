<!--
    Document:		index.php
    Author: 		Aethylwyne
    Created: 		10/2/2017
    Last Modified: 	10/4/2017

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
                <div>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="./assets/images/sample.png" alt="banner1" class="bannerimg" />
                                <div class="carousel-caption">
                                    <h3>Promotion 1</h3>
                                    <p>Promo caption</p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="./assets/images/sample.png" alt="banner2" class="bannerimg" />
                                <div class="carousel-caption">
                                    <h3>Editor Promo 1</h3>
                                    <p>Promo caption</p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="./assets/images/sample.png" alt="banner3" class="bannerimg" />
                                <div class="carousel-caption">
                                    <h3>Promotion 2</h3>
                                    <p>Promo caption</p>
                                </div>
                            </div>
                        </div>

                      <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Prev</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            
                <h1 class="page-header">New &amp; Fresh</h1>
                <div class="row list-group">
                    <?php
                        include_once "./process/list_product.php";
                        list_product(1,0);
                    ?>
                </div>
                
                <h1 class="page-header">Editor's Choice</h1>
                <div class="row list-group">
                    <?php
                        list_product(2,0);
                    ?>
                </div>
                
                <h1 class="page-header">Just For You!</h1>
                <div class="row list-group">
                    <?php
                        list_product(1,0);
                    ?>
                </div>
                
                <h1 class="page-header">Meet-ups</h1>
                <div class="row list-group">
                    <?php
                        list_product(1,0);
                    ?>
                </div>
                
                <h1 class="page-header">Community Tastemakers</h1>
                <div class="row list-group">
                    <?php
                        list_product(1,0);
                    ?>
                </div>
            </div>
        </div>
		
        <?php
            include_once "./include/Footer.php"
        ?>
    </body>
</html>