<?php
	session_start();
	if(isset($_SESSION["login_user"])){
		header("location:index.php");
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Deallo Craft House - Register</title>

        <?php include_once "./include/Header.php" ?>		
    </head>
    <body>
        <?php include_once "./include/NavigationBar.php" ?>
	
        <div class="content">
            <div class="container">
                <h2 class="page-header" style='margin-bottom:0px;'>Sign Up</h2>
                    <div id="registerForm"></div>
            </div>	
        </div>
		
		<script type="text/javascript" charset="utf-8">
			$.ajaxSetup({
				async: false
			});

			var countries = [];
			$.getJSON("assets/json/countries.json",function(json){
				countries = json;
			});

			var registerFormContent = [
				{
					rows:[
						{ template:"Account Authentication Info", type:"section"},
						{ view:"text", label:"E-mail", name:"email", required:true, invalidMessage:"* Invalid email" },
						{ view:"text", label:"User ID", name:"userid", required:true },
						{ view:"text", type:"password", label:"Password", name:"password", required:true, invalidMessage:"* Password must between 6 and 10 characters" },
						{ view:"text", type:"password", label:"Confirm Password", name:"matchPassword", required:true, invalidMessage:"* Password does not match" }
					]
				},
				{
					rows:[
						{ template:"Customer Info", type:"section" },
						{ view:"text", label:"First Name", name:"fname", required:true },
						{ view:"text", label:"Last Name", name:"lname", required:true },
						{ view:"radio", label:"Gender", name:"gender", required:true, bottomPadding:25, invalidMessage:"* Required", options:[
								{ id:"m", value:"Male" },
								{ id:"fm", value:"Female" }
							]
						},
						{
							view:"combo",
							id:"countriesSelect",
							label:"Country",
							name:"country_code",
							required: true,
							invalidMessage:"* Required",
							suggest:{
								body:{
									data:countries,
									yCount:10
								}
							}
						},
						{
							height:60,
							cols:[
								{ view: "text", label: "Contact number", id:"phone_code", name: "phone_code", required:true, width:280, placeholder:"Country Code", readonly:true, bottomLabel:""},
								{ view: "text", label: "", name: "phone_number", required:true, width:300, placeholder:"Phone number", bottomLabel:"" }
							]
						},
						{ view:"text", label:"Shipping Address", name:"shipping_address", required:true, invalidMessage:"* Required" },
						{ view:"text", label:"Postcode", name:"postcode", width: 300, invalidMessage:"Must contains number only", required:true },
						{ view:"checkbox", labelRight:"I have read and agree to the Terms and Conditions & Privacy Policy", name:"acceptRules", invalidMessage:"You must accept the rules to use our service" }
					]
				},
                {
                    cols:[
                        { width:160 },
				        {
                            view:"button",
                            template:"<a class='btn btn-success' style='margin-right:10px;' onClick='submit()'>Register</a> <a href='login.php'>Registered already?</a>"
                        }
                    ]
                }            
			];

			webix.ui({
				container:"registerForm",
                id:"formContent",
				rows:[
					{
						view:"form",
						id:"registerForm",
						borderless:true,
						elements:registerFormContent,
						elementsConfig:{
							labelAlign:"right",
							labelWidth: 160,
							width:600
						},
						rules:{
							"email"             : webix.rules.isEmail,
							"userid"            : function(value,data,name){ return validateUserId(value,data,name,this) },
							"password"          : function(value,data,name){ return validatePassword(value,data,name,this) },
							"matchPassword"     : function(value){ return this.getValues().password === value },
							"fname"             : function(value,data,name){ return validateName(value,data,name,this) },
							"lname"             : function(value,data,name){ return validateName(value,data,name,this) },
							"gender"            : webix.rules.isChecked,
							"phone_number"      : function(value,data,name){ return validatePhone(value,data,name,this) },
							"shipping_address"  : webix.rules.isNotEmpty,
							"postcode"          : function(value,data,name){ return validatePostcode(value,data,name,this) },
							"acceptRules"       : webix.rules.isChecked
						}
					}
				]
			});

			$$("countriesSelect").attachEvent("onChange",function(){
				var selectedCountry = $$("countriesSelect");
				var phoneCode = countries.find(function(obj){
					return obj.id === selectedCountry.getValue();
				});

				$$("phone_code").setValue(phoneCode.dialling_code);
			});

			function submit(){                         
                var registerForm = $$("registerForm");
                if(registerForm.validate())	{
                    webix.ajax().post("process/signup_process.php", registerForm.getValues(),
                    function(text, data){
                        alert(text);					
                        if(text == "Registration Success")	
                            window.location.replace("login.php");
                    });
                }
			}
		</script>	
        
        <?php
            include_once "./include/Footer.php"
        ?>
    </body>
</html>