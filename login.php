<HTML !DOCTYPE>
	<?php
            include_once "./Header.php"
    ?>
	
			
	<!-- Form validation Javascript -->
   	<script src="assets/js/form_validation.js"></script>
	
	<body>
		
		<?php
            include_once "./NavigationBar.php"
        ?>
		
		<div class="content">
			<div class="container">
		

						<h1> Login </h1>

						<div id="login_form_container"> </div>

						<form>
							<fieldset class="form-group">
								<legend> Login With</legend>
								<button class="facebook_button"> <i class="fa fa-facebook-official"></i> Facebook Login</button>
								<button class="google_button"> <i class="fa fa-google"></i> Google Login</button>
			
							</fieldset>
						</form>

			
			</div>
		</div>
	
	
		<script type="text/javascript" charset="utf-8">
			
			var loginFormContent =[
							{
								rows:[
									{view:"text",label:"Email",name:"email",required:true,invalidMessage:"* Invalid Email",labelWidth: 140,width:600},
									{view:"text",label:"Password",type:"password",name:"password",required:true,invalidMessage:"* Password must between 6 and 10 characters",labelWidth: 140,width:600},
									
									{cols:
									 [
										{view:"label",label:"<a href='#'> Forgot Password? </a>	"},
										{view:"label",label:"<a href='#'> New User? </a>	",css:{"text-align":"center"},
											 click:function(){
												 window.location.href="signup.php";
												}
										},
									 ]
									},
									{view:"button",id:"login_button",name:"login_button",value:"Login",width:100,
										click:function(){
											if($$("loginForm").validate()){
													webix.ajax().post("login_process.php", $$("loginForm").getValues(),
													function(text, data){
														alert(text);					
														if(text == "Login Success")	
															window.location.replace("index.php");
													});
											}
										}
									}
								]
							}
						];
			
			login_form = new webix.ui({
				container:"login_form_container",
				rows:[
					{
						id:"loginForm",
						view:"form",
						borderless:true,
						elements: loginFormContent,
						rules:{
							"email": webix.rules.isEmail,
							"password"          : function(value,data,name){ return validatePassword(value,data,name,this) },
						},

					}
			]
		});

		</script>
		
		<?php
            include_once "./Footer.php"
        ?>
	</body>
</HTML>