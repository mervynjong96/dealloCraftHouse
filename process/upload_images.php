<?php
    /* Used to get the existing product images at server-side */
    function getDirFiles($dir){
        $files = [];
        // Open a directory, and read its contents
        if (is_dir($dir)){
          if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
                if($file !== "." && $file !== "..")     //exclude './..' directory
                    $files[] = $file;   //get image name
            }
            closedir($dh);
          }
        }
        return $files;
    }

    /* Files upload implementations */
    if(session_id() === "")
	   session_start();

    $result["status"] = "fail";
    
    /* Unauthorized access to this page if forbidden */
    if(isset($_POST["action"]))
       $action = $_POST["action"];
    else
        header("location:../index.php");

    /* Product id is get by session if adding a new product, else, it is modify product*/
    if(isset($_POST["id"]))
        $product_id = $_POST["id"];
    else if(isset($_SESSION["product_id"]))
        $product_id = $_SESSION["product_id"];

    $suffix = ["a","b","c","d","e"];
    if(isset($_POST["countUpload"]))
        $totalUpload = $_POST["countUpload"];

    if( isset($product_id) && $product_id != "" && isset($action) )
    {
        if(!isset($_SESSION["uploadedCount"]))
        {
            $_SESSION["uploadedCount"] = 0;
            $_SESSION["suffixUsed"] = 0;            
        }
        
        // Arrange the product images of server-side folder first
        if($action !== "add" && !isset($_SESSION["deleted"]))
        {
            $_SESSION["deleted"] = 1;   // avoid calling this scope of function when next round image upload come in
            $toStoreData = [];          // store the image that client wish to keep in server

            $dir = "../assets/images/products/$product_id/";
            if($_POST["serverData"] !== "")
            {
                $toStoreData = $_POST["serverData"];
                $toStoreData = trim($toStoreData,"[]");
                $toStoreData = explode(",",$toStoreData);
                
                for($i=0; $i<count($toStoreData); $i++)
                {
                    $file = trim($toStoreData[$i],'"');
                    $file = explode(".",$file);
                    $name = $file[0][strlen((string)$product_id)];  //get files name
                    $type = $file[1];                               //get file type
                    $toStoreData[$i] = $name.".".$type;
                }
            }            
            
            // Delete unwanted file by client and rename reamining file (if exists)
            $serverData = getDirFiles($dir);    // Get the current directory files
            if(count($serverData) > 0)
            {
                // Delete unwanted image by client at server-side
                $toDelete = array_diff($serverData, $toStoreData);
                // Unknown bugs here if the number of image to be deleted is 1, hence, conditional is made here
                if(count($toDelete) === 1)
                    unlink ($dir.$toDelete[0]);
                else if(count($toDelete) > 1)
                    foreach($toDelete as $fileToDel)
                        unlink ("$dir$fileToDel");
                
                $_SESSION["status"] = json_encode($toDelete);
                $_SESSION["status2"] = json_encode($serverData);
                $_SESSION["status3"] = json_encode($toStoreData);
                // Get the current directory files
                $serverData = getDirFiles($dir);    
                if(count($serverData) > 0)
                {
                    // Rename remaining file in server side
                    for($i=0; $i<count($serverData); $i++)
                    {
                        $newFileName = $suffix[$i] . "." . explode(".",$serverData[$i])[1];
                        rename("$dir$serverData[$i]","$dir$newFileName");
                        $_SESSION["suffixUsed"]++;
                    }
                }
            }
        }
        
        if($action !== "delete")
        {            
            $count = &$_SESSION["uploadedCount"];
            if( $count < $totalUpload )
            {
                if(isset($_FILES['product_images']))
                { 
                    $file = $_FILES['product_images'];
                    $realpath = '../assets/images/products/'.$product_id.'/';

                    // Create new folder if the directory does not exists
                    if (!file_exists($realpath))
                        mkdir($realpath, 0755, true);
                    
                    // Rename and move uploaded file to the specified product folder
                    $newFileName = $suffix[$_SESSION["suffixUsed"]++] . "." . explode(".",$file["name"])[1];
                    move_uploaded_file($file["tmp_name"], $realpath.$newFileName);

                    // Move to next suffix
                    $count++;
                    // Return "server" status to indicate file uploads success
                    $result["status"] = "server";
                }
                else
                {
                    // Return "server" status to indicate file uploads failed
                    $result["status"] = "fail";
                }        
            }

            if( $count == $totalUpload )
            {
                if(isset($_SESSION["product_id"]))
                    unset($_SESSION["product_id"]);
                unset($_SESSION["deleted"]);
                unset($_SESSION["suffixUsed"]);
                unset($_SESSION["uploadedCount"]);  
                unset($count);          
            } 
        }       
    }

    if($action == "add" || $action == "modify")
        echo json_encode($result);
    else
        echo "success";
?>