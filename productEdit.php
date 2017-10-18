<!DOCTYPE html>
<html>
    <head>
        <title>eMarketplace Portal System</title>

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
        ?>
        
        <div class="content">
            <div class="container">
				<h1 class="page-header">Add My Product</h1>
				<div id="productRegisterForm"></div>
            </div>
        </div>		
		
		<script type="text/javascript" charset="utf-8">	
			
			var productRegisterForm = [
				{					
					id:"formContent",
					rows:[					
						{ 
							cols:[
								{
									view: "uploader",
									width:140,
									value: 'Upload Image(s)', 
									autosend: false,
									id:"imageUploader",
									inputName:"imageUploader",
									accept:"image/png, image/jpeg, image/jpg",
									link:"uploadTemplate", 
									upload:"process/upload_images.php",
									on:{								
										"onBeforeFileAdd":function(item){
											var type = item.type.toLowerCase();
											var itemsizeMB = item.size/1024;
											
											//Detect and avoid unsupported image input
											if (type != "jpg" && type != "jpeg" && type != "png"){
												alert("File format of " + item.name + " is not supported");
												return false;
											}
											
											//Detect and avoid image file with more than 3MB file size
											if (itemsizeMB >= 3072){
												alert(item.name + " file size exceeded maximum 3MB limit");
												return false;
											}
											
											//Detect and avoid duplicate image file input
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
							template:function(data){
								var preview = "";
								
								if(!data.order || data.order.length === 0)
								{
									preview = "<img src='"+"assets/images/products/sample.png' height=200 width=200/>";
									preview += "<br/>";
									preview += "<span style='display:inline-block; width:200px; text-align:center'>No image selected</span> ";
								}
								
								if (data.each)
								{
									data.each(function(obj){
										preview += "<img id='" + obj.id + "' height=200 width=200> ";
										var reader  = new FileReader();
										var image = document.getElementById(obj.id);

										reader.onloadend = function (e) {
											$("#"+obj.id).attr('src',e.target.result);
										}

										reader.readAsDataURL(obj.file);
									});
									preview += "<br/>";
									data.each(function(obj){ 
										preview += "<a href='javasript:;' onClick='removeImage("+ obj.id +")' style='display:inline-block; width:200px; text-align:center'>[ - Remove ]</a> ";
									});
								}
								return preview;
							}
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
						{ view:"text", label:"Stock Quantity", id:"stockQuantity", name:"product_stockQty", inputWidth:300 ,invalidMessage:"* Invalid input", required:true },
						{ 
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
						},
						{ 
							cols:[
								{ view: "text", label:"Weight", name:"product_weight", width:250, placeholder:"0.00", required:true, invalidMessage:"* Invalid input", },
								{ view: "label", label:"kg" }
							]							
						},		
						{ view:"text", label:"Price", name:"product_price", width:250, placeholder:"0.00", required:true },
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
						{ view:"button", template:"<a class='btn btn-success' onClick='submit()'><?php echo "Add"?></a> <a class='btn btn-danger' href='javascript:;'>Cancel</a>", width:300 }
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
			
			function removeImage(imageID)
			{
				$$("imageUploader").files.data.remove(imageID);
			}			
			
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
			}	
			
			function submit(){
				var productForm = $$("productRegisterForm");
				var countImgUpload = $$("imageUploader").files.data.order.length;
				var isFormValid = productForm.validate();				
				if(countImgUpload > 0 && isFormValid)
				{
					/* Standardized naming of different product image(s) */
					var data = $$("imageUploader").files.data.pull;
					var count = 0;
					var suffix = [];
					suffix[0] = 'a';
					suffix[1] = 'b';
					suffix[2] = 'c';
					suffix[3] = 'd';
					suffix[4] = 'e';
					for(var key in data)
					{
						var filename = data[key].name.split(".");
						data[key].name = suffix[count] + "." + filename[1];
						count++;
					}
					
					productForm.setValues({ variation_number: variation_number},true)
					webix.ajax().post("process/productEdit_process.php", productForm.getValues(),
						function(text, data){
							if(text == "success")
							{
								$$("imageUploader").send(function(response){
									if(response.status == "server")
									{
										alert("product registered success");
										location.reload();
									}
								})								
							}							
						});
					
				}
				else {
					if(countImgUpload === 0)
						$$("noImgInvalidMsg").show();
					else
						$$("noImgInvalidMsg").hide();
				}
			}
		</script>
		
        <?php
            include_once "./include/Footer.php";
        ?>
    </body>
</html>