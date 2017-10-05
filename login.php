<HTML !DOCTYPE>
	<?php
            include_once "./Header.php"
    ?>
	
			
		<!-- Form validation Javascript -->
   	 	<script src="assets/js/form_validation.js"></script>
	
	<style>
		.facebook_button{
			background-color:#3b5998;
			border:none;
			color:white;
			padding:10px;
			border-radius:4px;
		}
		
		.google_button{
			background-color:#db3236;
			border:none;
			color:white;
			padding:10px;
			border-radius:4px;
			margin-left:50px;
		}
	</style>
	
	<body>
		
		<?php
            include_once "./NavigationBar.php"
        ?>
		
		<div class="content">
			<div class="container">
				<div class="row">

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
		</div>
	
	
		<script>
			login_form = new webix.ui({
				container:"login_form_container",
				id:"loginForm",
				view:"form",
				borderless:true,
				elements:[
					{
						rows:[
							{view:"text",placeholder:"Email",name:"login_email",id:"login_email",required:true,invalidMessage:"* Invalid Email"},
							{view:"text",placeholder:"Password",name:"login_password",id:"login_password",required:true,invalidMessage:"* Password must between 6 and 10 characters"},
							{cols:
							 [
								{view:"label",label:"<a href='www.facebook.com'> Forgot Password? </a>	"},
								{view:"label",label:"<a href='www.facebook.com'> New User? </a>	",css:{"text-align":"right"}},
							 ]
							},
							{view:"button",id:"login_button",name:"login_button",value:"Login",width:100,align:"center",
								click:function(){
									if($$("loginForm").validate()){
											webix.ajax().post("login_process.php", $$("loginForm").getValues(),
											function(text, data){
												alert(text);					
												if(text == "Login Success")	
													window.location.replace("index.php");
											});
									}else{
										webix.message("Something went wrong");
									}
								}
							}
						]
					},
				/*	{rows:[
						{template:"Alternate login",type:"section"},
						{cols:[
							{view:"button",type:"iconButton",icon:"facebook",label:"Facebook Login",align:"right",css:"facebook_button"},
							{view:"button",type:"iconButton",icon:"google",label:"Google Login",align:"center"}
							]
						}
					]}*/
				],
			rules:{
				"login_email": webix.rules.isEmail,
				"login_password":function(value,data,name){return
				validatePassword(value,data,name,this) }
			},
					elementsConfig:{
							labelAlign:"right",
							labelWidth: 140,
							width:600
						},
		})

		</script>
		
		<?php
            include_once "./Footer.php"
        ?>
	</body>
</HTML>