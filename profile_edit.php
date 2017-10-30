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
                    
                    <?php
                        require "process/db_conn.php";
        
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
                    
                    var countries = [];
                    $.getJSON("assets/json/countries.json", function(json){
                        countries = json;
                    });

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
                                    , value: "<?php 
                                    $countriesJSON = json_decode(file_get_contents('assets/json/countries.json'),true);
                                    for($x=0; $x<count($countriesJSON); $x++){
                                        if($countriesJSON[$x]["dialling_code"] == substr($_SESSION["user_contact"],3)){
                                            echo $countriesJSON[$x]["value"];
                                        }
                                    }
                                    ?>"
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
                                { view:"text", type:"password", label:"New Password", name:"password", invalidMessage:"* Password must between 6 and 10 characters" },
                                { view:"text", type:"password", label:"Confirm New Password", name:"matchPassword", invalidMessage:"* Password does not match" }
                            ]
                        },
                        { 
                            rows: [
                                { template:"Confirmation", type:"section" },
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
                                                                return "<?php echo $_SESSION["login_password"]; ?>" === value
                                                            } else {
                                                                return true;
                                                            }
                                                        },
                                    "password"          : function(value,data,name){
                                                            if($$("oldpassword").getValue() != "") {
                                                                return validatePassword(value,data,name,this);
                                                            } else {
                                                                return true;
                                                            }
                                                        },
                                    "matchPassword"     : function(value){ return this.getValues().password === value },
                                    "fname"             : function(value,data,name){ return validateName(value,data,name,this) },
                                    "lname"             : function(value,data,name){ return validateName(value,data,name,this) },
                                    "gender"            : webix.rules.isChecked,
                                    "phone_number"      : function(value,data,name){ return validatePhone(value,data,name,this) },
                                    "shipping_address"  : webix.rules.isNotEmpty,
                                    "postcode"          : function(value,data,name){ return validatePostcode(value,data,name,this) }
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
                        var profile_edit = $$("profile_edit");
                        if(profile_edit.validate())	{
                            /*
                            webix.ajax().post("process/signup_process.php", profile_edit.getValues(),
                                function(text, data){
                                    alert(text);					
                                    if(text == "Profile Saved Successfully!")	
                                        window.location.replace("profile.php");
                                });
                            */
                            alert("Profile Saved Successfully!");
                        }
                    }
                    
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