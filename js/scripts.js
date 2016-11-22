////////////////////////////////////////////////////////////////////////
// Javascript for drop down boxes from navigation menu
////////////////////////////////////////////////////////////////////////

$(document).on('click', function(e) {
    var elem = $(e.target).closest('#login-trigger'),
        box  = $(e.target).closest('#login-content');
    
	// checks if the trigger has been clicked
    if (elem.length) {
        e.preventDefault();
        $('#login-content').toggle(); //toggle the visibility of the box
    }else if (!box.length){
        $('#login-content').hide(); //the box is hidden again if the user clicks outside of it
    }
});

// Same as above but for search box instead
$(document).on('click', function(e) {
    var elem = $(e.target).closest('#search-trigger'),
        box  = $(e.target).closest('#search-content');
    
    if (elem.length) {
        e.preventDefault();
        $('#search-content').toggle(); 
    }else if (!box.length){
        $('#search-content').hide(); 
    }
});



////////////////////////////////////////////////////////////////////////
// Function for validating form input
////////////////////////////////////////////////////////////////////////


function validateForm(form) {
	var reason = "";
  reason += validateUsername(form.username);
  reason += validatePassword(form.pwd1);
  reason += validateEmail(form.email);
  reason += matchingPasswords(form.pwd1, form.pwd2);
      
  if (reason != "") {
      text = "<p>Some fields need correction:\n" + reason + "</p>";
      document.getElementById('error').innerHTML += text;
      return false;

  }

  return true;
    console.log("true");
}

function validateUsername(field) {
	var error = "";
    var illegalChars = /\W/; // allow letters, numbers, and underscores
	
    if (field.value == "") {
        field.style.background = 'Red'; 
        error = "You didn't enter a username.\n";
    } else if ((field.value.length < 5) || (field.value.length > 15)) {
        field.style.background = 'Red'; 
        error = "The username has to be between 5 and 15 characters.\n";
    } else {
        field.style.background = 'White';
    } 
    return error;
}

function validatePassword(field) {
    var error = "";
 
    if (field.value == "") {
        error = "You didn't enter a password.\n";
        field.style.background = 'Red';
    } else if ((field.value.length < 8)) {
        error = "Your password has to be at least 8 characters long. \n";
        field.style.background = 'Red';
    } else if (!((field.value.search(/(a-z)+/)) && (field.value.search(/(0-9)+/)))) {
        error = "The password must contain both numbers and letters.\n";
        field.style.background = 'Red';
    } else {
        field.style.background = 'White';
    }
   return error;
}

function trim(s)
{
  return s.replace(/^\s+|\s+$/, '');
} 

function validateEmail(field) {
    var error="";
    var tfield = trim(field.value);  					// value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
    
    if (field.value == "") {
        field.style.background = 'Red';
        error = "You didn't enter an email address.\n";
    } else if (!emailFilter.test(tfield)) {              //test email for illegal characters
        field.style.background = 'Red';
        error = "Please enter a valid email address.\n";
    } else if (field.value.match(illegalChars)) {
        field.style.background = 'Red';
        error = "The email address contains illegal characters.\n";
    } else {
        field.style.background = 'White';
    }
    return error;
}

function validateDOB(field) {
    var error = "";	
	var validformat = /^\d{2}\/\d{2}\/\d{4}$/ ; //Basic check for format validity
	
	var monthfield = field.value.split("/")[0]
	var dayfield = field.value.split("/")[1]
	var yearfield = field.value.split("/")[2]
	var dayobj = new Date(yearfield, monthfield-1, dayfield) //turn in to a Date object to make sure it's a valid date
	
	if (field.value == "") {
		error = "You didn't enter a date of birth.\n";
		field.style.background = 'Red';
		
	} else if (!validformat.test(field.value)) {
		error = "Your date of birth has to be of the form DD\/MM\/YYYY. \n";
		field.style.background = 'Red';	
		
	} else if ((dayobj.getMonth()+1 != monthfield) || (dayobj.getDate() != dayfield) || (dayobj.getFullYear() != yearfield)) {
		error = "Invalid day, month, or year range.\n";
		field.style.background = 'Red';
			
	} else {
		field.style.background = 'White';
	}
	
	return error;
}

function matchingPasswords(field1, field2) {
    var error = "";

	if (field1.value != field2.value) {
		error = "The passwords does not match";
		field1.style.background = "Red";
		field2.style.background = "Red";
	} else {
		field1.style.background = 'White';
		field2.style.background = 'White';		
	}
	
	return error;
}