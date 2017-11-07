<!--
    Document:		transaction_history.php
    Author: 		Aethylwyne
    Created: 		11/5/2017
    Last Modified: 	11/7/2017

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
                <h3>Transaction History</h3>
                
                <div id="history"></div>
                
                <br/>
                <a class='btn btn-primary' href="profile.php">Return to Profile</a>
            </div>
        </div>
        
        <?php
            require "process/db_conn.php";

            $query = "SELECT user_transactions.transaction_id, user_transactions.date_paid, user_transactions.total_amount, transaction_products.product_id, products.product_name, transaction_products.quantity, transaction_products.price FROM user_transactions LEFT JOIN transaction_products ON user_transactions.transaction_id = transaction_products.transaction_id LEFT JOIN products ON transaction_products.product_id = products.product_id WHERE user_transactions.userid = '$_SESSION[login_user]' ORDER BY user_transactions.transaction_id DESC";
            $result = mysqli_query($conn, $query);
            $rows = array();
            while($i = mysqli_fetch_assoc($result)) {
                $rows[] = $i;
            }
        ?>
        <script>
            var transdata = <?php echo json_encode($rows) ?>;
            
            webix.ready ( function() {
                
                grid = webix.ui({
                    id: "transactions",
                    container: "history",
                    view: "datatable",
                    columns: [
                        { id:"transaction_id", header:"Transaction ID", width: 125 },
                        { id:"date_paid", header:"Date of Purchase", width: 175, format:webix.Date.dateToStr("%H:%i - %m/%d/%Y") },
                        { id:"product_id", header:"Product ID", width: 100 },
                        { id:"product_name", header:"Product Purchased", width: 400 },
                        { id:"quantity", header:"Quantity", width: 100 },
                        { id:"price", header:"Price", width: 100, format:function(value){ 
                            value = "RM " + value;
                            return value; } },
                        { id:"total_amount", header:"Total Cost", width: 100, /* format:webix.i18n.priceFormat */ format:function(value){ 
                            value = "RM " + value;
                            return value; }
                        }
                    ],
                    autowidth: true,
                    height: 500,
                    on:{
                        onBeforeLoad:function(){
                            this.showOverlay("Loading...");
                        },
                        onAfterLoad:function(){
                            if (!this.count())
                                this.showOverlay("Sorry, you have no past transactions!");
                            else
                                this.hideOverlay();
                        }
                    }
                });
                $$("transactions").parse(transdata);
            });
        </script>
		
        <?php
            include_once "./include/Footer.php"
        ?>
    </body>
</html>