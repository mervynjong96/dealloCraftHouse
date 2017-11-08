<!--
    Document:		profile.php
    Author: 		Aethylwyne
    Created: 		10/16/2017
    Last Modified: 	10/18/2017

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
                <div class="profiledirectory">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h2>Welcome, <?php echo $_SESSION["login_user"]; ?>!</h2>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <a href="profile_edit.php">
                                <img src="./assets/images/profile.png" alt="" />
                                <p>Profile Information</p>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <a href="transaction_history.php">
                                <img src="./assets/images/history.png" alt="" />
                                <p>Transaction History</p>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <a href="productManage.php">
                                <img src="./assets/images/sell.png" alt="" />
                                <p>My Sales Product</p>
                            </a>
                        </div>
                       <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <a href="#">
                                <img src="./assets/images/analysis.png" alt="" />
                                <p>Sales Analysis</p>
                            </a>
                        </div> -->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
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