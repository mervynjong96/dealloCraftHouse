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
        
        <meta name="author" content="Aethylwyne"/>
        <meta name="description" content="eMarketplace Online Web Portal"/>
        <meta name="keywords" content="eMarketplace, Deallo Craft House"/>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <!-- Bootstrap -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Webix -->
        <link href="assets/webix/codebase/webix.css" rel="stylesheet" />
        
        <!-- JQuery - required for Bootstrap's JavaScript plugins) -->
        <script src="assets/bootstrap/js/jquery.min.js"></script>
        <!-- All Bootstrap plug-ins file -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- All Webix plug-ins file -->
        <script src="assets/webix/codebase/webix.js"></script>
        
        <!-- Custom Scripts -->
        <link href="assets/css/style.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">eMarketplace Portal System</a>
                </div>
                <div class="navbar-collapse collapse" id="myNavbar">

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> [0] Checkout</a></li>
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>

                    <!-- Its not possible to change the width without using 1% for Bootstrap 3.3.7 -->
                    <form class="navbar-form">
                        <div class="form-group" style="display:inline;">
                            <div class="input-group" style="display:table;">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn" style="width:1%;">
                                    <button class="btn btn-default" type="submit">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </nav>
        
        <!-- Use this to center Brand Name instead
        <div id="navigation">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        <a class="navbar-brand" href="#">eMarketplace Portal System</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">Products</a></li>
                            <li><a href="#">Login</a></li>
                        </ul>
                        <form class="navbar-form navbar-right">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        -->
        
        <div class="content">
            <div class="container">
                <br/>
                <h1>CONTENT CONTENT CONTENT</h1>
                <br/>
                <br/>
                <p>SAMPLETEXT SAMPLETEXT</p>
                <br/>
                <br/>
                <p>SAMPLE SAMPLE SAMPLE</p><br/>
                <h1>CONTENT CONTENT CONTENT</h1>
                <br/>
                <br/>
                <p>SAMPLETEXT SAMPLETEXT</p>
                <br/>
                <br/>
                <p>SAMPLE SAMPLE SAMPLE</p><br/>
                <h1>CONTENT CONTENT CONTENT</h1>
                <br/>
                <br/>
                <p>SAMPLETEXT SAMPLETEXT</p>
                <br/>
                <br/>
                <p>SAMPLE SAMPLE SAMPLE</p><br/>
                <h1>CONTENT CONTENT CONTENT</h1>
                <br/>
                <br/>
                <p>SAMPLETEXT SAMPLETEXT</p>
                <br/>
                <br/>
                <p>SAMPLE SAMPLE SAMPLE</p>
            </div>
        </div>
                
        <footer>
            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <ul>
                                <li><a href="#"><img src="assets/images/steampic.png" alt="Deallo Craft Logo" /></a></li>
                            </ul>
                            <p>Deallo Craft House is a company assisting local entreprenuers sell their handicrafts.</p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <h3>Site Map</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Products</a></li>
                                <li><a href="#">Login & Sign Up</a></li>
                                <li><a href="#">About Us</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                            <h3>Mailing List</h3>
                            <p>Enter your email address below to subscribe to our mailing list!</p>
                            <ul>
                                <li>
                                    <form>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Email Address">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit">
                                                        <span class="glyphicon glyphicon-send"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <p class="pull-left">Copyright 2017 © eMarketplace Portal System</p>
                    <ul class="nav nav-pills pull-right">
                        <li><i class="fa fa-cc-visa"></i></li>
                        <li><i class="fa fa-cc-mastercard"></i></li>
                        <li><i class="fa fa-cc-paypal"></i></li>
                    </ul>
                </div>
            </div>
        </footer>
        
    </body>
</html>