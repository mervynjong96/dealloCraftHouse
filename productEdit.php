<!DOCTYPE html>
<html>
    <head>
        <title><?php echo (!isset($_GET["id"]) ? "Add My Product" : "Edit My Product") ?></title>

        <?php
            include_once "./include/Header.php";
        ?>
		
		<!-- Form validation Javascript -->
   	 	<script src="assets/js/form_validation.js"></script>
		<style>
			.invalidMsg{
				color:red;
			}
		</style>
    </head>
    <body>
        <?php
            include_once "./include/NavigationBar.php";
            require "process/db_conn.php";
        ?>
        
        <div class="content">
            <div class="container">
				<h1 class="page-header" style='margin-bottom:0px;'>
                    <?php echo (!isset($_GET["id"]) ? "Add My Product" : "Edit My Product") ?>                   
                </h1>
				<div id="productRegisterForm"></div>
            </div>
        </div>		
		
		<script type="text/javascript" charset="utf-8">	
			
            /* The following is the predefined template used for preview upload images*/
            var uploadTemp = function(data){
                var preview = "";

                if(!data.order || data.order.length === 0)
                {
                    preview = "<img src='"+"assets/images/uploadsample.png' height=200 width=200/>";
                    preview += "<br/>";
                    preview += "<span style='display:inline-block; width:200px; text-align:center'>No image selected</span> ";
                }

                var suffix = ["","a","b","c","d","e"];
                var removeLink = "";
                if (data.each)
                {
                    data.each(function(obj){
                        preview += "<img id='" + obj.id + "' ";
                        /* if the image is read from file picker */
                        if(obj.status == 'client')
                        {
                            var image = document.getElementById(obj.id);
                            var reader  = new FileReader();

                            reader.onloadend = function (e) {
                                $("#"+obj.id).attr('src',e.target.result);
                            }

                            reader.readAsDataURL(obj.file);
                        }
                        /* if the image is read from server */
                        else
                        {
                            var filetype = "." + obj.name.split(".")[1];
                            preview += "src='assets/images/products/"+<?php echo (isset($_GET["id"]) ? $_GET["id"] : "1") ?> +"/"+suffix[obj.id]+filetype+"' ";
                        }
                        preview     += "height=200 width=200/> ";
                        removeLink  += "<a href='javasript:;' onClick='removeImage("+ obj.id +","+ '"' +obj.name + '"' +")' style='display:inline-block; width:200px; text-align:center'>[ - Remove ]</a> ";
                    });
                    //Concatenate images with hyperlink of removal
                    preview += "<br/>" + removeLink;
                }
                return preview;
            }
            
			var productRegisterForm = [
				{					
					id:"formContent",
					rows:[
                        { view:"label", id:"invMsg", css:"invalidMsg", label:"* Some field(s) did not input properly, please fix the mistake by following the instruction message to those input field(s)", hidden:true },
						{ template:"Product Images", type:"section" },
						{ 
							cols:[
								{
									view: "uploader",
									width:140,
									value: 'Upload Image(s)', 
									autosend: false,
									id:"product_images",
									name:"product_images",
									inputName:"product_images",
									accept:"image/png, image/jpeg, image/jpg",
									link:"uploadTemplate", 
									upload:"process/upload_images.php",
									on:{								
										"onBeforeFileAdd":function(item){
											var type = item.type.toLowerCase();
											var itemsizeMB = item.size/1024;
											
											// Detect and avoid unsupported image input
											if (type != "jpg" && type != "jpeg" && type != "png"){
												alert("File format of " + item.name + " is not supported");
												return false;
											}
											
											// Detect and avoid image file with more than 3MB file size
											if (itemsizeMB >= 3072){
												alert(item.name + " file size exceeded maximum 3MB limit");
												return false;
											}
											
											// Detect and avoid duplicate image file input
											var data = this.files.data.pull;
											var countData = this.files.data.order;
											if(countData.length > 0)
												for(var i=0; i<countData.length; i++)
													if(item.name === data[countData[i]].name)
														return false;
											
											if(this.files.data.order.length >= 5)
												return false;
										}
									}
								},
								{ width:10 },
								{ 
									view:"label", label:"* Minimum 1 image, maximum 5 images (JPG/JPEG/PNG) to be uploaded" 
								}
							]
							
						},
						{ view:"label", id:"noImgInvalidMsg", label:"<span style='color:red'>* No image chosen</span>", hidden:true },
						{
						 	view:"template", 							
							width:150,
							autoheight:true,
							id:"uploadTemplate",
							borderless:true,
							template:uploadTemp
						},
						{ template:"Product Details", type:"section" },
						{
							view:"combo",
							id:"categorySelect",
							width:400,
							label:"Category",
							name:"product_category",							
							required: true,
							invalidMessage:"* Required",
							suggest:{
								body:{
									data:[
										{ id:1, value:"Accessories & Clothing" },
										{ id:2, value:"Bedding/Room Décor" },
										{ id:3, value:"Craft Supplies" },
										{ id:4, value:"Jewelry" },
										{ id:5, value:"Soft Toys" },
										{ id:6, value:"Vintage Arts" },
										{ id:7, value:"Wedding Accessories" },
									],
									yCount:10
								}
							}
						},
						{ view:"text", width:600, label:"Name", name:"product_name", required:true, invalidMessage:"* Required" },
						{ view:"textarea", width:700, label:"Description", name:"product_desc", required:true, height:120, invalidMessage:"* Required" },
						{ view:"text", label:"Stock Quantity", id:"stockQuantity", name:"product_stockQty", width:280,invalidMessage:"* Invalid input", required:true, attributes:{ type:"number", min:"0" } },
						/*{ 
							id:"variations",
							rows:[
								//Row(s) of variation will be added programmatically here after clicking on button of adding/removing a variation
							]							
						},
						{ 
							id:"btnVariations", 
							cols:[
								{ width:140 },
								{ view:"label", id:"btnAddVariation", label:"<a href='javascript:;'>[+] Add a product variation</a>", click:"addVariation", width:250 },
								{ view:"label", id:"btnDelVariation", label:"<a href='javascript:;'>[-] Remove a product variation</a>", click:"delVariation", hidden:true, width:250 }
							]							
						},*/
						{ 
							cols:[
								{ view: "text", label:"Weight", name:"product_weight", width:280, placeholder:"0.00", required:true, invalidMessage:"* Invalid input", },
								{ view: "label", label:"kg" }
							]							
						},		
						{ view:"text", label:"Price", name:"product_price", width:280, placeholder:"0.00", required:true },
						{ view:"text", width:700, label:"Tag(s)", name:"product_tags", placeholder:"Separate by single whitespace (e.g. latest new cheap)" },
						{ view:"textarea", width:700, label:"Product Policy", name:"product_policy", height:100, placeholder:"Remarks for Warranty/Refund Issue/Any Clarifications", required:true, invalidMessage:"* Required" },
						/*
						{ template:"Shipping Details", type:"section" },				
						{ 
							cols:[
								//{ view: "label", label:"<strong>Shipping Method(s)</strong>", autowidth:true },
								{ 
									rows: [
										{ view: "label", label:"<strong>Shipping Method(s)</strong>", autowidth:true },
										{ view:"checkbox", labelRight:"Asian Express Worldwide", value:"aew", align:"left",name:"shippingMethod" },
										{ view:"checkbox", labelRight:"DHL Express", value:"dhl_express", name:"shippingMethod" },
										{ view:"checkbox", labelRight:"Dynamic Parcel Distribution (DPD)", value:"dpd", name:"shippingMethod" },
										{ view:"checkbox", labelRight:"FedEx", value:"fedex", name:"shippingMethod" },
										{ view:"checkbox", labelRight:"TNT", value:"tes", name:"shippingMethod" },
										{ view:"checkbox", labelRight:"United Parcel Service (UPS)", value:"tes", name:"shippingMethod" }
									]
								}
							]
						}
						*/	
					]
				},
				{
					cols:[
						{ width:140 },
						{ view:"button", template:"<button class='btn btn-success' id='submitBtn' onClick='submit()' style='width:70px'><?php echo (!isset($_GET["id"]) ? "Add" : "Update") ?></button> <button class='btn btn-danger' style='width:70px' href='javascript:;'>Cancel</button>", width:300 }
					]
				}
			];
			

			webix.ui({
				container:"productRegisterForm",
				rows:[
					{
						view:"form",
						id:"productRegisterForm",
						borderless:true,
						elements:productRegisterForm,
						elementsConfig:{
							labelAlign:"right",
							labelWidth: 140,
							width:1100
						},
						rules:{
							"product_category"  : webix.rules.isNotEmpty,
							"product_name"      : webix.rules.isNotEmpty,
							"product_desc"      : webix.rules.isNotEmpty,
							"product_stockQty"  : function(value,data,name){ return validateStockQty(value,data,name,this) },
							"product_weight"    : function(value,data,name){ return validateWeightPrice(value,data,name,this) },
							"product_price"     : function(value,data,name){ return validateWeightPrice(value,data,name,this) },
							"product_tags"      : function(value,data,name){ return validateTags(value,data,name,this) },
							"product_policy"    : webix.rules.isNotEmpty
						}
					}
				]
			});
            
            var removedImage = [];
			function removeImage(imageID, imageName)
			{
                // Detect only the server-side image(s) to be removed by user
                if(imageID <= 5)
                    removedImage.push(imageName);
				$$("product_images").files.data.remove(imageID);
			}			
			/*
			var variation_number = 0;
			var numVar = 0;
			function addVariation(){						
				variation_number++;
				
				var label = "Variation " + variation_number;
				var size_name = "size_" + variation_number;
				var color_name = "color_" + variation_number;
				var stock_name = "stockQty_" + variation_number;
				var newVariation = 
				{
					id: "var_"+variation_number,
					cols:[
						{ width:40 },
						{ view: "text", label:label, labelWidth:100, id:size_name, name:size_name, width:250, placeholder:"Size", validate:function(value,data,name){ return validateVariation(value,data,name,this,color_name) }},
						{ view: "colorpicker", width:170, id:color_name, name: color_name, placeholder:"Click to choose color", validate:function(value,data,name){ return validateVariation(value,data,name,this,size_name) }},
						{ view: "text", width:180, id:stock_name, name: stock_name, placeholder:"Stock Quantity", required:true, validate:function(value,data,name){ return validateStockQty(value,data,name,this,size_name) } }
					]
				};
				
				$$("stockQuantity").hide();
				$$("btnDelVariation").show();	
				
				numVar = $$("variations").q.length;
				if(numVar === 0){
					var notice = { 
						id:"notice", 
						cols:[
							{ width:140 },
							{ view:"label", label:"* One or both of the field (i.e Size/Color) must be filled along with stock quantity" }
						]
					};
					$$("variations").addView(notice);
				}
				
				if(numVar <= 6)
				{
					$$("variations").addView(newVariation);
					$$(size_name).focus();
				}
				
				if(variation_number == 6)
					$$("btnAddVariation").hide();
			}			
			
			function delVariation(){
				$$("btnAddVariation").show();
				    
				numVar = $$("variations").q.length;
				if(numVar !== 0)
				{
					var varNum = "var_" + variation_number;
					$$("variations").removeView(varNum);
					variation_number--;
				}
				
				if(variation_number	 == 0)
				{
					$$("variations").removeView("notice");
					$$("btnDelVariation").hide();
					$$("stockQuantity").show();
				}
			}	*/
            
            function uploadImages(action,countImgUpload,productID,countToUpload,serverData){                
				var imgUploader = $$("product_images");
                if(action === "add")
                {
                    // Upload images
                    imgUploader.define('formData',{ action: "add", countUpload:countImgUpload });
                    $$("product_images").send(function(response){
                        if(response.status == "server")
                            window.location = "index.php";                        
                    });
                }
                else if(action === "modify")
                {
                    // Upload images if there is new images picked by user through uploader
                    imgUploader.define('formData',{ id:productID, countUpload:countToUpload, serverData:serverData, action:"modify" });
                    $$("product_images").send(function(response){
                        console.log(response)
                        if(response.status == "server")
                            window.location = "index.php";
                    });
                }
                else if(action === "delete")
                {
                    webix.ajax().post("process/upload_images.php", { id:productID, serverData:serverData, action:"delete" }, 
                        function(text, data){   
                            if(text === "success")
                                window.location = "index.php";
                        })
                }
            }
                        
			function submit(){				
                $$("invMsg").hide();
                var productForm = $$("productRegisterForm");
				var imgUploader = $$("product_images");
                var imgFiles = imgUploader.files.data;
                var countImgUpload = imgFiles.order.length;
				var isFormValid = productForm.validate();
                
				if( countImgUpload > 0 && isFormValid )
				{   
                    <?php 
                        if(isset($_GET["id"])) { 
                            echo "var productID = ".$_GET['id'];
                    ?>					
                            // Standardized naming of different product image(s)					
                            var data = imgFiles.pull;
                            var serverData = [];    //store server-side images that is not removed from uploader list
                            var countToUpload = 0;
                            for(var key in data)
                            {  
                                var filename = data[key].name;
                                //if the image is identified as server-side resource
                                if(key <= 5)
                                    serverData.push(filename);
                                else
                                    countToUpload++;
                            }
                    
                            // If only server-side images to be removed but no new images added by user
                            if(countToUpload === 0 && removedImage.length > 0)
                                uploadImages("delete",0,productID,countToUpload,serverData);
                            // If only user add images but no server-side image to be removed
                            else if(countToUpload > 0)
                                uploadImages("modify",0,productID,countToUpload,serverData);
                    <?php
                            echo "imgUploader.define('formData',{ id:productID, countUpload:countToUpload, serverData:serverData });";
                            echo "productForm.setValues({id:".$_GET["id"]."},true)";
                        };
                    ?>
                    
					//productForm.setValues({ variation_number: variation_number },true)
					webix.ajax().post("process/productEdit_process.php", productForm.getValues(),
						function(text, data){
							if(text == "success")
                                <?php echo (!isset($_GET["id"]) ? "uploadImages('add',countImgUpload,0,0,'');" : "uploadImages('modify',0,productID,countToUpload,serverData);") ?>  
						});                   
				}
				else {
					if(countImgUpload === 0)
                        $$("noImgInvalidMsg").show();
					else
						$$("noImgInvalidMsg").hide();
                    
                    $$("invMsg").show();
                    window.location = "#";   //jump to top of page to let user sees the error message 
				}
			}
            
            <?php require "process/productEdit_getDetails.php"; ?>
		</script>
        <?php
            include_once "./include/Footer.php";
        ?>
    </body>
</html>