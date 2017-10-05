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