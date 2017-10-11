<!DOCTYPE html>
	<head>
		
		<title> eMarketplace Portal System Forgot Password</title>
		
		<?php
				include_once "./include/Header.php"
		?>


		<!-- Form validation Javascript -->
		<script src="assets/js/form_validation.js"></script>
	</head>
	
	<body>
		
		<?php
            include_once "./include/NavigationBar.php"
        ?>
		
		<div class="content">
			<div class="container">
		

				<h1> Forgot Password </h1>

				<div id="update_password_container"> </div>

			
			</div>
		</div>
	
	
		<script type="text/javascript" charset="utf-8">
			
			var updatePasswordContent =[
							{
								rows:[
									{view:"text",label:"Email",name:"email",required:true,invalidMessage:"* Invalid Email",labelWidth:200},
									{view:"text",label:"Old Password",type:"password",name:"oldPassword",required:true,invalidMessage:"* Password must between 6 and 10 characters",labelWidth:200},
									{view:"text",label:"New Password",type:"password",name:"newPassword",required:true,invalidMessage:"* Password must between 6 and 10 characters",labelWidth:200},
									
									{ view:"text", type:"password", label:"Confirm New Password", name:"confirmPassword", required:true, invalidMessage:"* Password does not match",labelWidth:200 },
									{view:"button",id:"update_button",name:"update_button",value:"Submit",width:100,align:"center",	click:function(){

											if($$("updatePasswordForm").validate()){
												
												$$("updatePasswordForm").disable();
												$$("update_button").disable();
												
												$$("updatePasswordForm").showProgress({
															type:"icon",
															delay:2000,
															hide:true
														});
												
												
												setTimeout(function(){
												webix.ajax().post("process/update_password_process.php", $$("updatePasswordForm").getValues(),
													function(text, data){
														console.log("run");	
														
														alert(text);					
														$$("updatePasswordForm").enable();
														$$("update_button").enable();
														
														if(text == "Your password has been updated")	
															window.location.replace("login.php");
													},2000);
												})
												

											}
										}
									}
								]
							}
						];
			
			 webix.ui({
				container:"update_password_container",
				rows:[
					{
						id:"updatePasswordForm",
						view:"form",
						borderless:true,
						elements: updatePasswordContent,
						elementsConfig:{
							labelAlign:"right",
							labelWidth: 140,
							width:600
						},
						rules:{
							"email": webix.rules.isEmail,
							"oldPassword"          : function(value,data,name){ return validatePassword(value,data,name,this) },
							"newPassword"          : function(value,data,name){ return validatePassword(value,data,name,this) },
							"confirmPassword"     : function(value){ return this.getValues().newPassword === value }
						},

					}
			]
		});
		
		webix.extend($$("updatePasswordForm"),webix.ProgressBar);
		
		</script>
		
		<?php
            include_once "./include/Footer.php"
        ?>
	</body>
</HTML>