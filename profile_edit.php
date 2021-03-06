<!--
    Document:		profile_edit.php
    Author: 		Aethylwyne
    Created: 		10/27/2017
    Last Modified: 	10/28/2017
-->

<!DOCTYPE html>
<html>
    <head>
        <title>eMarketplace Portal System</title>

        <?php
            include_once "./include/Header.php"
        ?>
        
        <script src="assets/js/form_validation.js"></script>
    </head>
    <body>
        <?php
            include_once "./include/NavigationBar.php"
        ?>
        
        <div class="content">
            <div class="container">
                <h2>Profile Information</h2>
                
                <div id="profile_edit"></div>
                
                <script type="text/javascript" charset="utf-8">
                    $.ajaxSetup({
                        async: false
                    });
                    
                    var countries = [];
                    $.getJSON("assets/json/countries.json",function(json){
                        countries = json;
                    });
                    
                    <?php
						//Retrieve information from database and pre-filled the form
                        require "process/db_conn.php";
                        $sql_table = "account";
                        $query = "SELECT * FROM $sql_table WHERE userid = '$_SESSION[login_user]' AND email =  '$_SESSION[login_email]'";
                        $result = mysqli_query($conn, $query);
                        $result_info = mysqli_fetch_assoc($result);
                        $_SESSION["login_password"] = $result_info["password"];
        
                        // retrieves user's account data
                        $sql_table2 = "userinfo";
                        $query2 = "SELECT * FROM $sql_table2 WHERE userid = '$_SESSION[login_user]'";
                        $result2 = mysqli_query($conn, $query2);
                        $result_info2 = mysqli_fetch_assoc($result2);
        
                        $_SESSION["user_name"] = $result_info2["name"];
                        $name = explode(" ",$_SESSION["user_name"]); 
                        $lname = array_pop($name);
                        $fname = implode(" ", $name);
                        $_SESSION["user_gender"] = $result_info2["gender"];
                        $_SESSION["user_country"] = $result_info2["country"];
                        $_SESSION["user_contact"] = $result_info2["contact_number"];
                        $_SESSION["user_address"] = $result_info2["shipping_address"];
                        $_SESSION["user_postcode"] = $result_info2["postcode"];
                    ?>
                    
                    var profile_edit = [
                        {
                            rows:[
                                { template:"Account Information", type:"section"},
                                { view:"text", label:"E-mail", name:"email", readonly: true, value: "<?php echo $_SESSION["login_email"]; ?>" },
                                { view:"text", label:"User ID", name:"userid", readonly: true, value: "<?php echo $_SESSION["login_user"]; ?>" }
                            ]
                        },
                        {
                            rows:[
                                { template:"Checkout Information", type:"section" },
                                { view:"text", label:"First Name", name:"fname", value: "<?php echo $fname; ?>" },
                                { view:"text", label:"Last Name", name:"lname", value: "<?php echo $lname; ?>" },
                                { view:"radio", label:"Gender", name:"gender", bottomPadding:25, invalidMessage:"* Required", value:"<?php echo $_SESSION["user_gender"]; ?>" , options:[
                                        { id:"m", value:"Male" },
                                        { id:"fm", value:"Female" }
                                    ]
                                },
                                {
                                    view:"combo",
                                    id:"countriesSelect",
                                    label:"Country",
                                    name:"country_code",
                                    invalidMessage:"* Required",
                                    suggest:{
                                        body:{
                                            data:countries,
                                            yCount:10
                                        }
                                    }
                                    , value: "<?php echo $_SESSION["user_country"]; ?>"
                                },
                                {
                                    height:60,
                                    cols:[
                                        { view: "text", label: "Contact number", id:"phone_code", name: "phone_code", width:300, placeholder:"Ext. Code", readonly:true, bottomLabel:"", value: "<?php echo substr($_SESSION["user_contact"],0,3); ?>"},
                                        { view: "text", label: "", name: "phone_number", width:300, placeholder:"Phone number", bottomLabel:"", value: "<?php echo substr($_SESSION["user_contact"],3); ?>" }
                                    ]
                                },
                                { view:"text", label:"Shipping Address", name:"shipping_address", invalidMessage:"* Required", value: "<?php echo $_SESSION["user_address"]; ?>" },
                                { view:"text", label:"Postcode", name:"postcode", width: 300, invalidMessage:"Must contains number only", value: "<?php echo $_SESSION["user_postcode"]; ?>" }
                            ]
                        },
                        {
                            rows:[
                                { template:"Change Password", type:"section"},
                                { view:"text", type:"password", label:"Current Password", id:"oldpassword", name:"oldpassword", invalidMessage:"* Password does not match your current password" },
                                { view:"text", type:"password", label:"New Password", id:"password", name:"password", invalidMessage:"* Password must between 6 and 10 characters" },
                                { view:"text", type:"password", label:"Confirm New Password", name:"matchPassword", invalidMessage:"* Password does not match" }
                            ]
                        },
                        { 
                            rows: [
                                { template:"Confirmation", type:"section" },
                                { cols:[
                                        { view:"text", label:"Verification code", type:"text", name:"verification_code", invalidMessage:"* Invalid Verification Code" },
                                        { view:"button", value:"Send verification code", width: 250,
                                            click:function(){
                                                webix.ajax().post("process/verification_number_process.php", $$("profile_edit").getValues(),
                                                        function(text,data){
                                                        alert (text);
                                                })
                                            }
                                        }
                                    ]
                                },
                                {
                                    margin: 5,
                                    cols: [
                                        {},
                                        { view:"button", label:"Save", align:"center", click:"submit", type: "form" },
                                        { view:"button", label:"Cancel", align:"center", click:"cancel", type: "danger" },
                                        {}
                                    ]
                                }
                            ]
                        }
                    ];

                    webix.ui({
                        container:"profile_edit",
                        id: "formContent",
                        rows:[
                            {
                                view:"form",
                                id:"profile_edit",
                                elements: profile_edit,
                                elementsConfig:{
                                    labelAlign:"left",
                                    labelWidth: 200
                                },
                                width: 750,
                                rules:{
                                    "oldpassword"       : function(value){
                                                            if($$("oldpassword").getValue() != "") {
                                                                return "<?php echo $_SESSION["login_password"]; ?>" === value;
                                                            } else {
                                                                if($$("password").getValue() != "") {
                                                                    return "<?php echo $_SESSION["login_password"]; ?>" === value;
                                                                } else {
                                                                    return true;
                                                                }
                                                            }
                                                        },
                                    "password"          : function(value,data,name){
                                                            if($$("oldpassword").getValue() != "") {
                                                                return validatePassword(value,data,name,this);
                                                            } else {
                                                                if($$("password").getValue() != "") {
                                                                    return validatePassword(value,data,name,this);
                                                                } else {
                                                                    return true;
                                                                }
                                                            }
                                                        },
									//form validations
                                    "matchPassword"     : function(value){ return this.getValues().password === value },
                                    "fname"             : function(value,data,name){ return validateName(value,data,name,this) },
                                    "lname"             : function(value,data,name){ return validateName(value,data,name,this) },
                                    "gender"            : webix.rules.isChecked,
                                    "phone_number"      : function(value,data,name){ return validatePhone(value,data,name,this) },
                                    "shipping_address"  : webix.rules.isNotEmpty,
                                    "postcode"          : function(value,data,name){ return validatePostcode(value,data,name,this) },
                                    "verification_code" : webix.rules.isNumber
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
					
					
					/* Submit update account information form through ajax
					expected result: Profile Saved Successfully!
					display and redirect user back to profile.php once receives the expected result */
                    function submit(){
                        var profile_edit = $$("profile_edit");
                        if(profile_edit.validate())	{
                            webix.ajax().post("process/update_profile_process.php", $$("profile_edit").getValues(),
                                function(text, data){
                                    alert(text);					
                                    if(text == "Profile Saved Successfully!")	
                                        window.location.replace("profile.php");
                                });
                        }
                    }
                    
					//Redirect user to profile.php once the cancel button is pressed
                    function cancel(){
                        window.location.replace("profile.php");
                    }
                </script>
                
            </div>
        </div>
		
        <?php
            include_once "./include/Footer.php"
        ?>
    </body>
</html>