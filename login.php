<?php
	session_start();
	if(isset($_SESSION["login_user"])){
		header("location:index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>		
        <title>Deallo Craft House - Login</title>
		
		<?php
				include_once "./include/Header.php"
		?>

		<!-- Form validation Javascript -->
	</head>
	
	<body>
		
		<?php
            include_once "./include/NavigationBar.php"
        ?>
		
        <div class="container">
            <h1 class="page-header" style='margin-bottom:0px;'>Login</h1>
            <div id="login_form_container"></div>
            <p style='font-size:20px; border-bottom:1px solid #eee; margin-bottom:12px;'> Login With</p>
            
            <button class="facebook_button"> <i class="fa fa-facebook-official"></i> Facebook Login</button>
            <button class="google_button"> <i class="fa fa-google"></i> Google Login</button>
            <br/><br/>
        </div>
	
	
		<script type="text/javascript" charset="utf-8">
			
			var loginFormContent =
            [{
                rows:[
                    { view:"text",label:"Email",name:"email",required:true,invalidMessage:"* Invalid Email" },
                    { view:"text",label:"Password",type:"password",name:"password",required:true,invalidMessage:"* Password must between 6 and 10 characters" },
                    { 
                        cols:[
                            { width:130 },
                            { view:"label", label:"<a href='update_password.php'> Forgot Password? </a>"}
                        ]
                    },
                    {
                        cols:[
                            { width:130 },
                            {
                                view:"button",
                                id:"login_button",
                                template:"<a class='btn btn-success' onClick='login()' style='margin-right:10px'>Login</a> <a href='signup.php'> Not registered yet? </a>"
                            },
                            { width:10 },
                            { view:"label",label:""}
                        ]
                        
                    }
                ]
            }];
			
			login_form = new webix.ui({
				container:"login_form_container",
                id:"formContent",
				rows:[
					{
						id:"loginForm",
						view:"form",
						borderless:true,
						elementsConfig:{
							labelWidth:130,
							width:600
						},
						elements: loginFormContent,
						rules:{
							"email"      : webix.rules.isEmail,
							"password"   : function(value,data,name){ return validatePassword(value,data,name,this) },
						},

					}
                ]
            });
            
            function login(){                
                if($$("loginForm").validate()){
                    webix.ajax().post("process/login_process.php", $$("loginForm").getValues(),
                    function(text, data){
                        alert(text);					
                        if(text == "Login Success")	
                            window.location.replace("index.php");
                    });
                }
            }
		</script>
		
		<?php
            include_once "./include/Footer.php"
        ?>
	</body>
</html>