<!DOCTYPE html>
<html>
	<head>
        <title>eMarketplace Portal System</title>
        <?php include_once "./include/Header.php" ?>
	</head>
	
	<body>		
		<?php				
            if(session_id() == "")
                session_start();

            if(!isset($_SESSION["login_user"]))
                header("location:index.php");
		?>
		
		<?php include_once "./include/NavigationBar.php" ?>
		
        <div class="container">
            <h1 class="page-header">
                My Sales Products                
                <a href='productEdit.php' style='float:right;' id='btnAddProduct' class='btn btn-success'>
                    <span class="glyphicon glyphicon-plus"></span>
                    Add New Product
                </a>
            </h1>
            <?php include_once "process/list_seller_product.php" ?>
        </div>
        <br/><br/>
        <script>            
            function removeItem(itemID)
            {
				webix.confirm({
                    text:"Are you sure that you want to remove the item from your product list?<br/>The action cannot be undone once confirmed.", 
                    width:500,
                    type:"alert-error",
                    callback:function(result){
                        if(result){
                            webix.ajax().post("process/productDelete_process.php",{ product_id: itemID },
                            function(text,data){
                                console.log(text)
                                if(text === "success"){
                                    webix.alert({
                                        text:"The item has been removed from your product list successfully",
                                        width:450,
                                        callback: function(result){
                                            location.reload();
                                        }
                                    });
                                }
                            })
                        }
                    }
                });
            }
        </script>
		
		<?php include_once "./include/Footer.php" ?>				
	</body>
</html>
