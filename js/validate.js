

//---------REGISTRATION Validation-------------------------------------------------------------- 

function allalphabetic(the_string)
  {
    var letters = /^[a-zA-Z ]+$/;
  if (the_string.match(letters))
  {
    return true;
  }
    else
  {
    return false;
  }
 }

function validate_firstname(the_string) {
    //var letters  = '/[a-z\s]/i';
    if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 40)) {
    return true;
  }
    else
  {
    return false;
  }
 }


 
function validate_lastname(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 40)) {
  return true;
}
  else
{
  return false;
}
}


function validate_uname(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 15)) {
  return true;
}
  else
{
  return false;
}
}

function validate_pass(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length >= 8) && (the_string.length <= 12)) {
  return true;
}
  else
{
  return false;
}
}

function validate_email(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (the_string.length <= 50)) {
  return true;
   } else if (the_string.indexOf("@") == -1 || the_string.indexOf(".") == -1) {
    return false;
  
 } else {  
  return false;
}
}

function validate_age(the_string)
//var letters  = '/[0-9]/';
  {
    if ((the_string > 0 && the_string <= 150) && (!isNaN(the_string)))
   {
     return true;
   }
     else
   {
     return false;
   }
  }

  function validate_address(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (the_string.length < 80)) {
  return true;
}
  else
{
  return false;
}
}

function validate_zip(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (the_string.length < 10)) {
  return true;
}
  else
{
  return false;
}
}


function validate_state_country(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 15)) {
  return true;
}
  else
{
  return false;
}
}


// -------------------------CONTACT------------------------------------------ 
function submitreg() {
            var form = document.feedbackform;


  if (!validate_firstname(form.firstname.value) || (form.firstname.value == "")) {
    document.getElementById("error_message1").innerHTML = 'First name missing. Alphabetic, numeric, space only max 30 characters';
   // document.getElementById("error_message1").innerHTML.onblur() ="";
    form.firstname.focus();    
    return false;
    

  } 
  
  if (!validate_lastname(form.lastname.value) || (form.lastname.value == "")) {
    document.getElementById("error_message2").innerHTML = 'Last name missing. Alphabetic, numeric, space only max 40 characters';
    form.lastname.focus();    
    return false;

  }

           if (!validate_email(form.email.value) || (form.email.value == "")) {
                document.getElementById('error_message3').innerHTML = "Enter email!.";
                //alert("Search something.");
                form.email.focus();
                return false;
            } 
        

         if (form.subject.value == "") {
                document.getElementById('error_message4').innerHTML = "Enter Subject!.";
                //alert("Search something.");
                form.subject.focus();
                return false;
            } 

            if (form.message.value == "") {
                document.getElementById('error_message5').innerHTML = "Enter Subject!.";
                //alert("Search something.");
                form.subject.focus();
                return false;
            } 


        }


// -------------------------SEARCH------------------------------------------
        function submitreg2() {
            var form = document.srch;
            if (form.search.value == "") {
                document.getElementById('info').innerHTML = "Search something.";
                //alert("Search something.");
                form.search.focus();
                return false;
            } 
        }

         function disppearSrch() { 
  document.getElementById('info').innerHTML = '';
        }



  // -------------------------SUBSCRIBE------------------------------------------
        function submitreg3() {
            var form = document.subscribe;
            if (form.email.value == "") {
                document.getElementById('err').innerHTML = "Enter email.";
                //alert("Search something.");
                form.email.focus();
                return false;
            } 
        }
    

        function disppearSub() { 
  document.getElementById('err').innerHTML = '';
        }



// -------------------------REGISTRATION---------------------------------------- 
function submit_reg() {
 
  var form = document.reg;

  if (!validate_firstname(form.firstname.value) || (form.firstname.value == "")) {
    document.getElementById("error_message1").innerHTML = 'First name missing. Alphabetic, numeric, space only max 30 characters';
   // document.getElementById("error_message1").innerHTML.onblur() ="";
    form.firstname.focus();    
    return false;
    

  } 
  
  if (!validate_lastname(form.lastname.value) || (form.lastname.value == "")) {
    document.getElementById("error_message2").innerHTML = 'Last name missing. Alphabetic, numeric, space only max 40 characters';
    form.lastname.focus();    
    return false;

  }
  
  if (!validate_uname(form.uname.value) || (form.uname.value == "")) {
    document.getElementById("error_message3").innerHTML = 'Username missing. Alphabetic, numeric, max 15 characters';
    form.uname.focus();    
    return false;

  }

   if (!validate_pass(form.upass.value) || (form.upass.value == "")) {
    document.getElementById("error_message5").innerHTML = 'Password missing. 8 to 12 chars, one upper, one lower, one number, one special';
    form.upass.focus();    
    return false;

  } 
  
  if (!validate_pass(form.upass2.value) || (form.upass2.value == "")) {
    document.getElementById("error_message6").innerHTML = 'Confirm password';
    form.upass2.focus();    
    return false;

  } 
  
  if (!validate_email(form.uemail.value) || (form.uemail.value == "")) {
    document.getElementById("error_message4").innerHTML = 'Enter valid email!';
    form.uemail.focus();    
    return false;

  } 
  

  if (!validate_address(form.street.value) || (form.street.value == "")) {
    document.getElementById("error_message7").innerHTML = 'Enter street address.';
    form.street.focus();    
    return false;


  } 

  if (!validate_zip(form.zcode_pcode.value) || (form.zcode_pcode.value == "")) {
    document.getElementById("error_message8").innerHTML = 'Enter Zip code.';
    form.zcode_pcode.focus();    
    return false;


  } 

  if (!validate_state_country(form.state.value) || (form.state.value == "")) {
    document.getElementById("error_message9").innerHTML = 'Enter state.';
    form.state.focus();    
    return false;


  } 

  if (!validate_state_country(form.country.value) || (form.country.value == "")) {
    document.getElementById("error_message10").innerHTML = 'Enter country.';
    form.country.focus();    
    return false;


  } 


  if (document.getElementById('upass').value ==
        document.getElementById('upass2').value) {
        document.getElementById('error_message6').style.color = 'green';
        document.getElementById('error_message6').innerHTML = 'Passwords match';
    } else {
        document.getElementById('error_message6').style.color = 'red';
        document.getElementById('error_message6').innerHTML = 'Passwords do not match';
        return false;
    } 
   
    return true;
  
  
}





// -------------------------REGISTRATION---------------------------------------- 
function updateDetails() {
 
  var form = document.update_details;

  if (!validate_firstname(form.firstname.value) || (form.firstname.value == "")) {
    document.getElementById("error_message4").innerHTML = 'First name missing. Alphabetic, numeric, space only max 30 characters';
   // document.getElementById("error_message1").innerHTML.onblur() ="";
    form.firstname.focus();    
    return false;
    

  } 
  
  if (!validate_lastname(form.lastname.value) || (form.lastname.value == "")) {
    document.getElementById("error_message5").innerHTML = 'Last name missing. Alphabetic, numeric, space only max 40 characters';
    form.lastname.focus();    
    return false;

  }
  
  if (!validate_uname(form.uname.value) || (form.uname.value == "")) {
    document.getElementById("error_message6").innerHTML = 'Username missing. Alphabetic, numeric, max 15 characters';
    form.uname.focus();    
    return false;

  }

  
  if (!validate_email(form.uemail.value) || (form.uemail.value == "")) {
    document.getElementById("error_msg_email").innerHTML = 'Enter valid email!';
    form.uemail.focus();    
    return false;

  } 
  

  if (!validate_address(form.street.value) || (form.street.value == "")) {
    document.getElementById("error_message7").innerHTML = 'Enter street address.';
    form.street.focus();    
    return false;


  } 

  if (!validate_zip(form.zcode_pcode.value) || (form.zcode_pcode.value == "")) {
    document.getElementById("error_message8").innerHTML = 'Enter Zip code.';
    form.zcode_pcode.focus();    
    return false;


  } 

  if (!validate_state_country(form.state.value) || (form.state.value == "")) {
    document.getElementById("error_message9").innerHTML = 'Enter state.';
    form.state.focus();    
    return false;


  } 

  if (!validate_state_country(form.country.value) || (form.country.value == "")) {
    document.getElementById("error_message10").innerHTML = 'Enter country.';
    form.country.focus();    
    return false;


  } 

   
    return true;
  
  
}





//-----------CLEAR error message-------------------------------------


function disappear() { 
  document.getElementById('error_message1').innerHTML = '';
  document.getElementById('error_message2').innerHTML = '';
  document.getElementById('error_message3').innerHTML = '';
  document.getElementById('error_message4').innerHTML = '';
  document.getElementById('error_message5').innerHTML = '';
  document.getElementById('error_message6').innerHTML = '';
  document.getElementById('error_message7').innerHTML = '';
  document.getElementById('error_message8').innerHTML = '';
  document.getElementById('error_message9').innerHTML = '';
  document.getElementById('error_message10').innerHTML = '';
  document.getElementById('error_message11').innerHTML = '';
  document.getElementById('error_message12').innerHTML = '';
  document.getElementById('error_msg_email').innerHTML = '';
  }



//-----------------CHECK USER-----------------------------------

  function checkUser(uname)
{
if (uname.value == '') {
 document.getElementById('error_message3').innerHTML = ''
 return
}

params = "uname=" +uname.value
request = new ajaxRequest()
request.open("POST", "./admin/includes/checkuser.php", true)
request.setRequestHeader("Content-type",
"application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{
 if (this.readyState == 4)
   if (this.status == 200)
    if (this.responseText != null)
    document.getElementById('error_message3').innerHTML = this.responseText
     }
    request.send(params)
   }

  function ajaxRequest() {
try { var request = new XMLHttpRequest() }
 catch(e1) {
try { request = new ActiveXObject("Msxml2.XMLHTTP") }
 catch(e2) {
try { request = new ActiveXObject("Microsoft.XMLHTTP") }
 catch(e3) {
 request = false
} 
} 
}
return request
}




//-----------------EDIT CHECK USER-----------------------------------

  function editCheckUser(uname)
{
if (uname.value == '') {
 document.getElementById('error_message6').innerHTML = ''
 return
}

params = "uname=" +uname.value
request = new ajaxRequest()
request.open("POST", "./admin/includes/checkuser.php", true)
request.setRequestHeader("Content-type",
"application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{
 if (this.readyState == 4)
   if (this.status == 200)
    if (this.responseText != null)
    document.getElementById('error_message6').innerHTML = this.responseText
     }
    request.send(params)
   }

  function ajaxRequest() {
try { var request = new XMLHttpRequest() }
 catch(e1) {
try { request = new ActiveXObject("Msxml2.XMLHTTP") }
 catch(e2) {
try { request = new ActiveXObject("Microsoft.XMLHTTP") }
 catch(e3) {
 request = false
} 
} 
}
return request
}


//-----------------CHECK EMAIL---------------------------------

  function checkEmail(uemail)
{
if (uemail.value == '') {
 document.getElementById('error_message4').innerHTML = ''
 return
}

params = "uemail=" +uemail.value
request = new ajaxRequest()
request.open("POST", "./admin/includes/checkemail.php", true)
request.setRequestHeader("Content-type",
"application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{
 if (this.readyState == 4)
   if (this.status == 200)
    if (this.responseText != null)
    document.getElementById('error_message4').innerHTML = this.responseText
     }
    request.send(params)
   }

  function ajaxRequest() {
try { var request = new XMLHttpRequest() }
 catch(e1) {
try { request = new ActiveXObject("Msxml2.XMLHTTP") }
 catch(e2) {
try { request = new ActiveXObject("Microsoft.XMLHTTP") }
 catch(e3) {
 request = false
} 
} 
}
return request
}



//-----------------EDIT CHECK EMAIL---------------------------------

  function editCheckEmail(uemail)
{
if (uemail.value == '') {
 document.getElementById('error_msg_email').innerHTML = ''
 return
}

params = "uemail=" +uemail.value
request = new ajaxRequest()
request.open("POST", "./admin/includes/checkemail.php", true)
request.setRequestHeader("Content-type",
"application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{
 if (this.readyState == 4)
   if (this.status == 200)
    if (this.responseText != null)
    document.getElementById('error_msg_email').innerHTML = this.responseText
     }
    request.send(params)
  }

  function ajaxRequest() {
try { var request = new XMLHttpRequest() }
 catch(e1) {
try { request = new ActiveXObject("Msxml2.XMLHTTP") }
 catch(e2) {
try { request = new ActiveXObject("Microsoft.XMLHTTP") }
 catch(e3) {
 request = false
} 
} 
}
return request
}





//-----------------CHECK LOGIN EMAILUSER-----------------------------

  function checkEmailUser(emailusername)
{
if (emailusername.value == '') {
 document.getElementById('wrong_id').innerHTML = ''
 return
}

params = "emailusername=" +emailusername.value
request = new ajaxRequest()
request.open("POST", "./admin/login.php", true)
request.setRequestHeader("Content-type",
"application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{
 if (this.readyState == 4)
   if (this.status == 200)
    if (this.responseText != null)
    document.getElementById('wrong_id').innerHTML = this.responseText
     }
    request.send(params)
   }

  function ajaxRequest() {
try { var request = new XMLHttpRequest() }
 catch(e1) {
try { request = new ActiveXObject("Msxml2.XMLHTTP") }
 catch(e2) {
try { request = new ActiveXObject("Microsoft.XMLHTTP") }
 catch(e3) {
 request = false
} 
} 
}
return request
}




//-----------------CHECK LOGIN PASS-----------------------------

  function checkPass(password)
{
if (password.value == '') {
 document.getElementById('wrong_id').innerHTML = ''
 return
}

params = "password=" +password.value
request = new ajaxRequest()
request.open("POST", "./admin/login.php", true)
request.setRequestHeader("Content-type",
"application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{
 if (this.readyState == 4)
   if (this.status == 200)
    if (this.responseText != null)
    document.getElementById('wrong_id').innerHTML = this.responseText
     }
    request.send(params)
   }

  function ajaxRequest() {
try { var request = new XMLHttpRequest() }
 catch(e1) {
try { request = new ActiveXObject("Msxml2.XMLHTTP") }
 catch(e2) {
try { request = new ActiveXObject("Microsoft.XMLHTTP") }
 catch(e3) {
 request = false
} 
} 
}
return request
}


function sortDataFullCat() {
          
        var sortOption = document.getElementById("sortOptionFullCat").value;
        
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
               document.getElementById('catFullProducts').innerHTML = this.responseText;
               // console.log("value sent php successful");
              }
          };
          xhttp.open("GET", "./sort_full?sortOption=" + sortOption, true);
          xhttp.send();
          return xhttp;
  }

  function sortDataCategory() {
          
        var sortOption = document.getElementById("sortOption").value;
        
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
               document.getElementById('catFullProducts').innerHTML = this.responseText;
               // console.log("value sent php successful");
              }
          };
          xhttp.open("GET", "./sort?sortOption=" + sortOption, true);
          xhttp.send();
          return xhttp;
  }

      



//---------SUBMIT LOGIN---------------------------------------
   function submitLogin() {
            var form = document.login;
            if (form.emailusername.value == "") {
                //alert("Enter email or username.");
                document.getElementById('error_message1').innerHTML = 'Enter email.';
                form.emailusername.focus(); 
                return false;
            } else if (form.password.value == "") {
                //alert("Enter Password.");
                document.getElementById('error_message2').innerHTML = 'Enter Password.';
                form.password.focus(); 
                return false;
            }
        }


        //---------SUBMIT LOGIN 2-----------------------------
   function submitLogin2() {
            var form = document.login2;
            if (form.emailusername.value == "") {
                //alert("Enter email or username.");
                document.getElementById('error_message11').innerHTML = 'Enter email.';
                 form.emailusername.focus(); 
                return false;
            } else if (form.password.value == "") {
                //alert("Enter Password.");
                document.getElementById('error_message12').innerHTML = 'Enter Password.';
                 form.password.focus(); 
                return false;
            }
        }



//-----------CHECK PASSWORD----------------------------
function checkPassword() {

  var form = document.change_pass;


  if (!validate_pass(form.upass.value) || (form.upass.value == "")) {
    document.getElementById("error_message1").innerHTML = 'Password missing. 8 to 12 chars, one upper, one lower, one number, one special';
    form.upass.focus();    
    return false;

  } 

  if (!validate_pass(form.upass1.value) || (form.upass1.value == "")) {
    document.getElementById("error_message2").innerHTML = 'Enter New password';
    form.upass1.focus();    
    return false;

  } 

  if (!validate_pass(form.upass2.value) || (form.upass2.value == "")) {
    document.getElementById("error_message3").innerHTML = 'Confirm password';
    form.upass2.focus();    
    return false;

  } 
  



  if (document.getElementById('upass1').value ==
        document.getElementById('upass2').value) {
        document.getElementById('error_message3').style.color = 'green';
        document.getElementById('error_message3').innerHTML = 'Passwords match';
    } else {
        document.getElementById('error_message3').style.color = 'red';
        document.getElementById('error_message3').innerHTML = 'Passwords do not match';
        return false;
    } 
   
    return true;
}




//-----------------------------------------------------

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
    window.onload = func;
    } else {
    window.onload = function() {
    oldonload();
    func();
    }
    }
    }

   // addLoadEvent(checkUser);


  