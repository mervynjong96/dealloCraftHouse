<!--
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <ul>
                    <li><a href="#"><img src="./assets/images/sample.png" alt="Deallo Craft Logo" /></a></li>
                </ul>
                <p>Deallo Craft House is a company assisting local entreprenuers sell their handicrafts.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <h3>Site Map</h3>
                <ul>
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/products.php">Products</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                <h3>Mailing List</h3>
                <p>Enter your email address below to subscribe to our mailing list!</p>
                <ul>
                    <li>
                        <form>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Email Address">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <span class="glyphicon glyphicon-send"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
-->
<div class="footer-bottom navbar-fixed-bottom">
    <div class="container">
        <p class="pull-left">Copyright 2017 &copy; Deallo Craft House</p>
        <ul class="nav nav-pills pull-right">
            <li><i class="fa fa-cc-visa"></i></li>
            <li><i class="fa fa-cc-mastercard"></i></li>
            <li><i class="fa fa-cc-paypal"></i></li>
        </ul>
    </div>
</div>

<!-- The following code must put at last section to ensure apply the following CSS after the form rendered by Webix JS -->
<style>
    /* All Webix form CSS except dropdown icon */
    .formCSS *:not(.fa-angle-down){
        font-family: sans-serif;
    }
</style>
<script>
    /* All Webix form must attach with id:formContent to overwrite the CSS of Webix form elements content */
    if($$("formContent"))
        webix.html.addCss( $$("formContent").$view, "formCSS");
</script>
