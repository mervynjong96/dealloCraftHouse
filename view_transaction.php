<!DOCTYPE html>
<html>
	<head>
        <title>eMarketplace Portal System</title>
        <?php include_once "./include/Header.php" ?>
	</head>
	
	<body>		
		<?php				
            if(!isset($_SESSION))
                session_start();
        
            if(!isset($_SESSION["login_user"]) || !isset($_GET["id"]) )
                header("location:index.php");
		?>
		<?php include_once "./include/NavigationBar.php" ?>
		
        <div class="content container">           
            <h1 class="page-header">Transaction History</h1> 
                <?php include_once "process/transaction_details.php" ?>
        </div>
		<?php include_once "./include/Footer.php" ?>				
	</body>
</html>
