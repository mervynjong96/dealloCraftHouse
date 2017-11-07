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

            if(!isset($_SESSION["login_user"]))
                header("location:index.php");
		?>
		<?php include_once "./include/NavigationBar.php" ?>
		
        <div class="content container">             
            <div id='checkoutContainer'>          
                <h1 class="page-header">Checkout</h1> 
                <?php include_once "process/list_checkout.php" ?>
            </div>
            
            <div id="loading" style="text-align:center">
                <img src="assets/images/payment_loadng.gif" style="width:100px; height:100px;"/>
                <p>Processing payment... Please wait for a while...</p>
            </div>  
            
            <div class='row' id="paymentSuccess">
                <div style="float:left;">
                    <img src="assets/images/paymentSuccess_tick.png" style="width:40px; height:40px;"/>
                </div>                        
                <div class='col-sm-9 col-xs-9 col-md-9 col-lg-9'>                        
                    <h4>Payment Accepted</h4>
                    <p>You have paid <strong>$<span id="paidAmount"></span></strong> successfully.</p>
                    <p><strong>Paid At:</strong> <span id="paidDatetime"></span></p>
                    <p><strong>Ship To:</strong> <span id="confirmed_ShippingAddress"></span></p>
                    <p><a href="javascript:;">Click here</a> to view current transaction details</p>
                    <hr/>
                    <h4>What do you want to do next?</h4>
                    <ul>
                        <li>Check your previous transaction records? <a href="javascript:;">View my transaction history</a></li>
                        <li>Still have item in shopping cart awaits for checkout? <a href="cart_view.php">View my Shopping Cart</a></li>
                        <li>Back to <a href="index.php">Home Page</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
		<script>
            $('#loading').hide();
            $('#paymentSuccess').hide();
            $("#paidAmount").text($('#totalAmount').text());
            $("#confirmed_ShippingAddress").text($('#shippingAddress').text());
            
            $('#btnPay').click(function()
            {       
                $('#loading').show();
                $('#checkoutContainer').hide();
                
                webix.ajax().post('process/checkoutPay.php', { checkoutItem : <?php echo json_encode($checkout); ?> }, function (text, data) {
                    console.log(text);
                    var response = text.split(" ");
                    if(response[0] === "success")                
                        setTimeout(function(){                            
                            $("#paidDatetime").text(response[1] + " "+ response[2] + " " + response [3]);
                            $('#paymentSuccess').show();
                            $('#loading').hide();
                        }, 3000);                        
                });
            });
        </script>
		<?php include_once "./include/Footer.php" ?>				
	</body>
</html>
