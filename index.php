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
                                <img src="./assets/images/steampic.png" alt="banner1" class="bannerimg" />
                                <div class="carousel-caption">
                                    <h3>Promotion 1</h3>
                                    <p>Promo caption</p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="./assets/images/steampic.png" alt="banner2" class="bannerimg" />
                                <div class="carousel-caption">
                                    <h3>Editor Promo 1</h3>
                                    <p>Promo caption</p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="./assets/images/steampic.png" alt="banner3" class="bannerimg" />
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
            
                <h1>New &amp; Fresh</h1>
                <div class="row list-group">
                    <!-- Item 1 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 1" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 2" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 3" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 4" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h1>Editor's Choice</h1>
                <div class="row list-group">
                    <!-- Item 1 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 1" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 2" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 3" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 4" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h1>Just For You!</h1>
                <div class="row list-group">
                    <!-- Item 1 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 1" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 2" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 3" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 4" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h1>Meet-ups</h1>
                <div class="row list-group">
                    <!-- Item 1 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 1" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 2" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 3" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 4" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h1>Community Tastemakers</h1>
                <div class="row list-group">
                    <!-- Item 1 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 1" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 2" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 3" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="item product col-lg-3 col-md-3 col-sm-5 col-xs-8">
                        <div class="list-productpicture">
                            <a href="#">
                                <img class="list-group-image productimg" src="./assets/images/steampic.png" alt="Item 4" />
                            </a>
                        </div>
                        <div class="list-productdetails">
                            <a href="#">
                                <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                            </a>
                            
                            <p class="list-group-item-text">Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                            <div class="row">
                                <div class="item product col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h4>$10000.00</h4>
                                </div>
                                <div class="item product col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>
                                </div>
                            </div>
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