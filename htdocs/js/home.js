/*=======================================================================
 * home.js
 *  
 * JavaScript file for the views in user.
 * 
 * This file handles registration  form submits and validates
 * them before sending input to the back-end.
 *=======================================================================
 */

function loginFormSubmit() {
	var username = document.forms["loginForm"]["username"].value.trim();
	var pass = document.forms["loginForm"]["password_hash"].value.trim();

	//Validation checks
	if(username != "" && pass != ""){ //All data is filled in
		document.forms["loginForm"].submit();
		
	} else {
		alert("Please fill in all text boxes.");
		event.preventDefault();
	}
}

//Validates registration entry data and registers user in database
function register_userFormSubmit() {
	var username = document.forms["register_userForm"]["username"].value.trim();
	var pass = document.forms["register_userForm"]["password_hash"].value.trim();
	var passValidate = document.forms["register_userForm"]["password_confirm"].value.trim();

	//Validation checks
	if(username != "" && pass != "" && passValidate != ""){
		
		if(pass !== passValidate){
				alert("Passwords do not match.");
				event.preventDefault();
		} else { //All data is valid
			document.forms["register_userForm"].submit();
			
		}
	} else {
		alert("Please fill in all text boxes.");
		event.preventDefault();
	}
}
function ViewMessageInfoForm(){
	document.getElementById('viewMsg').onclick = function() { 
   display(this,'ViewMsgForm');
 }
   function display(chckbox, id) {
   var viewMsg = document.getElementById(id);
   if (chckbox.checked ) {
     delivery.style.display = 'none';
   } else {
     delivery.style.display = 'block';
   }
 } 
}
/*Checks to see if an email is in a correct format
function validateEmail(email) {
	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
		return (true);
	} else {
		return (false);
	}
}
*/


