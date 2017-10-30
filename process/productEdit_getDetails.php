<?php /* Prefilling product details */
    if(isset($_GET["id"]))
    {
        $id = mysqli_real_escape_string($conn, $_GET["id"]);

        // Insert user authentication information into database
        $sql_table = "products";
        $query = "SELECT product_category, product_name, product_desc, product_stockQty, product_weight, product_price, product_tag, product_policy FROM $sql_table WHERE product_id = '$id' ";
        $result = mysqli_query($conn, $query);

        if( $result->num_rows > 0 )
        {
            $result_info = mysqli_fetch_assoc($result);

            /* Get product info and passed into a class object */
            $data = new stdClass();
            $data->product_category = $result_info['product_category'];
            $data->product_name = $result_info['product_name'];
            $data->product_desc = $result_info['product_desc'];
            $data->product_stockQty = $result_info['product_stockQty'];
            $data->product_weight = number_format($result_info['product_weight'], 2, '.', '');
            $data->product_price = number_format($result_info['product_price'], 2, '.', '');
            $data->product_tags = $result_info['product_tag'];
            $data->product_policy = $result_info['product_policy'];   

            /* Access product images from its folder */
            $product_id = $_GET["id"];
            $productImgFolder = "assets/images/products/";
            $images = scandir($productImgFolder.$product_id);                        
            $images = array_filter($images, function ($var) { return strlen($var) > 2; });  // remove "./.." directory, get images filenames only
            $images =  array_values($images);   //reindex array

            /* Prefilling image preview template to display uploaded image at server-side */
            $img = "";
            $removeLink = "";
            $name = "";       
            $digits = 6;
            for($i=0; $i<count($images); $i++)
            {                 
                $uniqueNum =  rand(pow(10, $digits-1), pow(10, $digits)-1);
                if($i>0 && $i<count($images))
                    $name .= ",";
                $filename = explode(".",$images[$i])[0];
                $filetype = explode(".",$images[$i])[1];
                $name .= "{ id:". ($i+1) . ", name:\"".$product_id.$filename.$uniqueNum.".".$filetype."\", status:\"server\" }";
                $img  .= "<img src='" . $productImgFolder.$product_id."/".$images[$i]."' width=200 height=200/> ";
                $removeLink .= "<a href='javasript:;' onClick='removeImage(".($i+1).",".'"+"\"'.$images[$i].'\""+"'.")' style='display:inline-block; width:200px; text-align:center'>[ - Remove ]</a> ";
            }
            $img .= "<br/>" . $removeLink; // break new line to insert the remove link under each generated preview images

            // Generate JS code to prefill product images and details into form
            echo "$$('productRegisterForm').parse(".json_encode($data).");"; 
            echo "$$('productRegisterForm').setValues(".json_encode($data).",'json');";       
            echo "$$('uploadTemplate').define('template',\"$img\");\n";
            echo "$$('uploadTemplate').refresh();";
            echo "$$('uploadTemplate').define('template',uploadTemp);";
            echo "$$('product_images').files.parse([$name]);";
            echo "document.getElementById('submitBtn').disabled = 1;";

            // Detect if form or uploaded is dirtied
            echo '$$("productRegisterForm").attachEvent("onChange", function(){
                    document.getElementById("submitBtn").disabled = 0;
                 });';
            echo '$$("uploadTemplate").attachEvent("onAfterRender", function(){
                    document.getElementById("submitBtn").disabled = 0;
                 });';
        }
        else
            echo "window.location = 'productEdit.php';";

        mysqli_close($conn);
    }
?>  