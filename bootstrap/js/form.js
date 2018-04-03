
var fullname = document.forms['myform']['fname'];
var name_error = document.getElementById('error_fname');

fullname.addEventListener('blur', fnameVerify, true);

function Validate()
{

    if (fullname.value == "") {
    fullname.style.border = "1px solid red";
    document.getElementById('fname').style.color = "red";
    name_error.textContent = "Username is required";
    fullname.focus();
    return false;
  }
}

function fnameVerify() {
  if (fullname.value != "") {
   fullname.style.border = "1px solid #5e6e66";
   document.getElementById('fname').style.color = "#5e6e66";
   name_error.innerHTML = "";
   return true;
}
}


