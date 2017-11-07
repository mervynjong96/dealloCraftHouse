<!DOCTYPE HTML>
	<head>
		
		<title> eMarketplace Portal System Forgot Password</title>
		
		<?php
				include_once "include/Header.php"
		?>


		<!-- Form validation Javascript -->
		<script src="assets/js/form_validation.js"></script>
	</head>
	
	<body>
		
		<?php
            include_once "include/NavigationBar.php"
        ?>
		
		<div class="content">
			<div class="container">
		

				<h2> Forgot Password </h2>

				<div id="update_password_container"> </div>

			
			</div>
		</div>
	
	
		<script type="text/javascript" charset="utf-8">
			
			var updatePasswordContent =[
							{
								rows:[
									{view:"text",label:"Email",name:"email",id:"email",required:true,invalidMessage:"* Invalid Email",labelWidth: 180,
							width:600,validate:webix.rules.isEmail},
									{view:"text",label:"New Password",type:"password",name:"newPassword",required:true,invalidMessage:"* Password must between 6 and 10 characters",labelWidth: 180,
							width:600},
									{ view:"text", type:"password", label:"Confirm New Password", name:"confirmPassword", required:true, invalidMessage:"* Password does not match" ,labelWidth: 180,
							width:600},
									{cols:[
										{view:"text",label:"Verificiation code",type:"text",name:"verification_code",required:true,invalidMessage:"* You are required to enter verification code",labelWidth: 180,
							width:600,validate:webix.rules.isNumber},
										{view:"button",value:"Send verification code", width:170,
										 	click:function(){
												if($$("email").validate() && $$("verification_code").validate()){
													webix.ajax().post("process/verification_number_process.php",$$("updatePasswordForm").getValues(),
															function(text,data){
													
															alert (text);
													})
												}
											}
										}
									]},
									{view:"button",id:"update_button",name:"update_button",value:"Submit",width:100,align:"center",	click:function(){
										
											if($$("updatePasswordForm").validate()){
				
												webix.ajax().post("process/update_password_process.php", $$("updatePasswordForm").getValues(),
													function(text, data){
														alert(text);					
														if(text == "Your password has been changed successfully")	
															window.location.replace("login.php");
													});
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
						rules:{
							"newPassword"          : function(value,data,name){ return validatePassword(value,data,name,this) },
							"confirmPassword"     : function(value){ return this.getValues().newPassword === value },
							"verification_code" : webix.rules.isNumber
						},

					}
			]
		});
			
		webix.extend($$("updatePasswordForm"),webix.ProgressBar);	
		
		</script>
		
		<?php
            include_once "include/Footer.php"
        ?>
	</body>
</HTML>