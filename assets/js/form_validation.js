/*
	Usage: Rules of different form field validations for the website
*/

/* if the length of userid is not between 5 and 12, validate as false*/
function validateUserId(value,data,name,form)
{
    var message = "";
    if(value === "")
        message = "* Required";
    else if (value.length < 5 || value.length >= 12 )
        message = "* Must be between 5 and 12 characters";

    if(message) {
        form.elements[name].define("invalidMessage", message);
        return false
    }
    return true;
}

/* if password is not alphanumeric format and number of digits is not between 8 and 12, validate as false*/
function validatePassword(value,data,name,form)
{
    var message = "";
    if(value === "")
        message = "* Required";
    else if (!value.match(/^(?=.*\d).{8,12}$/))
        message = "* Must be between 8 to 12 characters and include at least one numeric digit";

    if(message) {
        form.elements[name].define("invalidMessage", message);
        return false
    }
    return true;
}

/* if name contains any symbol, special or numeric character, validate as false*/
function validateName(value,data,name,form)
{
    var message = "";
    if(value === "")
        message = "* Required";
    else if (!value.match(/^[a-zA-Z ]+$/))
        message = "* Must be alphabets characters only";

    if(message) {
        form.elements[name].define("invalidMessage", message);
        return false
    }
    return true;
}

/* if phone number is not numeric and less than 6 digits value, validate as false*/
function validatePhone(value,data,name,form)
{
    var message = "";
    if(value === "")
        message = "* Required";
    else if (!value.match(/^[\d]+$/))
        message = "* Must be digits characters only";
    else if (value.length <= 6)
        message = "* Invalid phone number";

    if(message) {
        form.elements[name].define("invalidMessage", message);
        return false
    }
    return true;
}

/* if postcode contains non-numeric and invalid length value, validate as false */
function validatePostcode(value,data,name,form)
{
    var message = "";
    if(value === "")
        message = "* Required";
    else if (!value.match(/^[\d]+$/))
        message = "* Must be digits characters only";
    else if (value.length < 3)
        message = "* Invalid postcode";

    if(message) {
        form.elements[name].define("invalidMessage", message);
        return false
    }
    return true;
}

/* if weight and price is not in either integer or decimal values, validate as false */
function validateWeightPrice(value,data,name,form)
{
    var message = "";
    if(value === "")
        message = "* Required";
    else if (!value.match(/^[0-9]+([,.][0-9]+)?$/g))
        message = "* Invalid input";

    if(message) {
        form.elements[name].define("invalidMessage", message);
        return false
    }
    return true;
}

/* if stock quantity not either 0 or any positive integer, validate as false */
function validateStockQty(value,data,name,form)
{
    var message = "";
    if(value === "")
        message = "* Required";
    else if (!value.match(/^\d*$/))
        message = "* Invalid input";

    if(message) {
		if(name === 'product_stockQty')
        	form.elements[name].define("invalidMessage", message);
		return false
    }
    return true;
}

/* if both size and color field is empty and each variation are not consistent (i.e. some variation provides color and size but some only provide either size or color, validate as false */
function validateVariation(value,data,name,form,sizeColor_name)
{	
	var sizeColor_value = form.elements[sizeColor_name].getValue();
    if(value === "" && (!sizeColor_value || sizeColor_value === ""))
        return false;
	/*
	var var1_size = form.elements["size_1"].getValue();
	var var1_color = form.elements["color_1"].getValue();
	if((var1_size !== "" || !var1_color) && variation_number > 1)
	{
		var countFieldInput = 0;
		if((var1_size != "" && !var1_color) || (var1_size == "" && var1_color != ""))
			countFieldInput = 1;
		else if(var1_size && var1_color)
			countFieldInput = 2;
		console.log(countFieldInput)
		if(countFieldInput > 0)
			for(var i=2; i<=variation_number; i++)
			{
				var varSize = form.elements["size_"+i].getValue();
				var varColor = form.elements["color_"+i].getValue();
				//console.log(varColor)
				if(countFieldInput === 1 && varSize && varColor)
				{
					alert("Inconsistent_1");
					return false;
				}
				else if(countFieldInput === 2 && (varSize && !varColor || !varSize && varColor))
				{
					alert("Inconsistent_2");
					return false;
				}
			}
	}
	*/
    return true;
}

/* if both tags contain more than 5, validate as false */
function validateTags(value,data,name,form,sizeColor_name)
{	
    var message = "";
	
    if(value !== "" && value.split(" ").length > 5)
        message = "* Maximum 5 tags can be included";

    if(message) {
        form.elements[name].define("invalidMessage", message);
		return false
    }
	
    return true;
}