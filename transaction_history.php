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

            $sql_table = "transactions";
            $query = "SELECT * FROM $sql_table WHERE userid='$_SESSION[login_user]'";
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
                        { id:"transaction_id", header:"Transaction ID", width: 150 },
                        { id:"transaction_date", header:"Date of Purchase", width: 175, format:webix.Date.dateToStr("%H:%i - %m/%d/%Y") },
                        { id:"transaction_products_bought", header:"Products Purchased", width: 500 },
                        { id:"transaction_total_cost", header:"Total Cost", width: 150, /* format:webix.i18n.priceFormat */ format:function(value){ 
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