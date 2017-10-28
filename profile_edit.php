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
                    $.getJSON("assets/json/countries.json", function(json){
                        countries = json;
                    });

                    var profile_edit = [
                        {
                            rows:[
                                { template:"Account Information", type:"section"},
                                { view:"text", label:"E-mail", name:"email" },
                                { view:"text", label:"User ID", name:"userid" }
                            ]
                        },
                        {
                            rows:[
                                { template:"Change Password", type:"section"},
                                { view:"text", type:"password", label:"Old Password", name:"oldpassword", required:true, invalidMessage:"* Password must between 6 and 10 characters" },
                                { view:"text", type:"password", label:"New Password", name:"password", required:true, invalidMessage:"* Password must between 6 and 10 characters" },
                                { view:"text", type:"password", label:"Confirm New Password", name:"matchPassword", required:true, invalidMessage:"* Password does not match" }
                            ]
                        },
                        {
                            rows:[
                                { template:"Checkout Information", type:"section" },
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
                                        { view: "text", label: "Contact number", id:"phone_code", name: "phone_code", required:true, width:250, placeholder:"Phone code", readonly:true, bottomLabel:""},
                                        { view: "text", label: "", name: "phone_number", required:true, width:300, placeholder:"Phone number", bottomLabel:"" }
                                    ]
                                },
                                { view:"text", label:"Shipping Address", name:"shipping_address", required:true, invalidMessage:"* Required" },
                                { view:"text", label:"Postcode", name:"postcode", width: 300, invalidMessage:"Must contains number only", required:true }
                            ]
                        },
                        { margin: 5,
                            cols: [
                                {},
                                { view:"button", label:"Save", align:"center", click:"submit", type: "form" },
                                { view:"button", label:"Cancel", align:"center", click:"submit", type: "danger" },
                                {}
                            ]
                        }
                    ];

                    webix.ui({
                        container:"profile_edit",
                        rows:[
                            {
                                view:"form",
                                id:"profile_edit",
                                elements: profile_edit,
                                elementsConfig:{
                                    labelAlign:"right",
                                    labelWidth: 140
                                },
                                rules:{
                                    "oldpassword"       : webix.rules.isNotEmpty,
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
                </script>
                
            </div>
        </div>
		
        <?php
            include_once "./include/Footer.php"
        ?>
    </body>
</html>