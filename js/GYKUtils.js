var NAME_REGEX=/^[a-zA-Z]+((\s)+[a-zA-Z]+)*$/;
var PHONE_REGEX=/^\d{10,11}$/;
var EMAIL_REGEX=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var DATE_REGEX=/^(0[0-9]|1[0,1,2])-([0,1,2][0-9]|3[0,1])-\d{4}$/;
var CAL_DATE_REGEX=/^(0[0-9]|1[0,1,2])\/([0,1,2][0-9]|3[0,1])\/(\d{4})$/;  

function redirectToHostPagination(domain, page, fromPage){
	
	var region = document.getElementById("region").value;
	var category=document.getElementById("category").value;
	var capacity=document.getElementById("capacity").value;
	
	if(fromPage=='FILTER_SEARCH')	
		location.href=domain+"venues"+"/"+region+"/"+category+"/"+capacity+"/"+page;
	
	if(fromPage=='1')
		location.href=domain+"wedding-venues-in-chhatarpur/"+page;
	
	if(fromPage=='2')
		location.href=domain+"wedding-venues-in-mundka/"+page;
	
	if(fromPage=='3')
		location.href=domain+"wedding-venues-in-gt-karnal-road/"+page;
	
	if(fromPage=='4')
		location.href=domain+"wedding-venues-in-NH8-Pushpanjali/"+page;
	
	if(fromPage=='5')
		location.href=domain+"wedding-venues-in-Vaishali-Vasundhara/"+page;
	
	if(fromPage=='0')
		location.href=domain+"wedding-venues-in-delhi-NCR/"+page;

	
	return false;
}

function redirectToHost(domain){

	var region = document.getElementById("region").value;
	var category=document.getElementById("category").value;
	var capacity=document.getElementById("capacity").value;
	location.href=domain+"venues"+"/"+region+"/"+category+"/"+capacity;
	 
	return false;
}

var errors = [];

function submitContactUsForm(){
  
  if(isValidContactUsForm()){
    
    document.contactform.action='contact-confirmation';
    document.contactform.submit;
  }else{
 		var msg="";
	    msg+="Please complete the following Information:";
		msg+="<ul>";
		
	  	for (var i = 0; i<errors.length; i++) {
 			
  			msg += '<li>'+ errors[i]+'</li>';
		}
		
		msg+="</ul>"
		msg+="</div>";
		
		//alert(msg);
		document.getElementById('errorMessages').innerHTML="<div style='display: block;' class='errorMsg'>"+msg+"</div>";
		document.getElementById('blankBlock').innerHTML="<div style='display: block;' class='blankErrorMsg'>"+msg+"</div><br>";
		errors = [];
		return false; 
  }
} 

function isValidContactUsForm(){
	
	//var name = document.contactform.name.value;
	var email = document.contactform.email.value;
	var contactNumber = document.contactform.contact_num.value;
	//var confirmCode = document.contactform.confirm_code.value;
	
	/*
	if (!NAME_REGEX.test(name) || name=='Enter Your Name') {
		errors[errors.length] = "Please enter your name.";
	}
	*/
 	
 	if (!EMAIL_REGEX.test(email)) {
 		errors[errors.length] = "Please enter a valid email address.";
 	}
 	
 	if (!PHONE_REGEX.test(contactNumber)) {
 		errors[errors.length] = "Please enter a valid contact number.";
 	}
 	
 	//if (confirmCode.trim()=='') {
 	//	errors[errors.length] = "Please enter the confirmation code.";
 	//}
 	
 
	if (errors.length > 0) {
	     
	  return false;
	}else{
		
		var response='Correct Captcha';//isValidCaptcha(confirmCode);
		 //todo
		if(response!='Correct Captcha'){
			
			errors[errors.length]=response;
			return false;
		}
		
	}
	
  return true;
}

function initiateRequest(){

	if (window.XMLHttpRequest)
		return new XMLHttpRequest();
	else if (window.ActiveXObject)
		return new ActiveXObject("Microsoft.XMLHTTP");
}

function isValidCaptcha(captchaCode){
	
	var xmlhttp;
	xmlhttp = initiateRequest();
	var response='';
	xmlhttp.onreadystatechange=function(){
	   
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
	    	response=xmlhttp.responseText;
	    	//alert(xmlhttp.responseText);
	    }
	}
	xmlhttp.open("GET","../view/samplecode.php?confirm_code="+captchaCode,false);
	xmlhttp.send();

	return response;
}

var venueBookErrors = [];

function submitVenueBookingForm(){

	if(isValidVenueBookingForm()){
    
    document.bookVenueForm.action='/booking-confirmation';
    document.bookVenueForm.submit;
  }else{
 		var msg="<div style='display: block;' class='errorMsg'>";
	    msg+="Please complete the following Information:";
		msg+="<ul>";
		
	  	for (var i = 0; i<venueBookErrors.length; i++) {
 			
  			msg += '<li>'+ venueBookErrors[i]+'</li>';
		}
		
		msg+="</ul>"
		msg+="</div>";
		
		//alert(msg);
		document.getElementById('errorMessages').innerHTML=msg;
		venueBookErrors = [];
		return false; 
  }

}

function isValidVenueBookingForm(){

	//var name = document.bookVenueForm.name.value;
	var email = document.bookVenueForm.email.value;
	var contactNumber = document.bookVenueForm.contactNumber.value;
	//var date = document.bookVenueForm.date.value;
	//var confirmCode = document.bookVenueForm.confirm_code.value;
	
	//alert(name);
	//alert(email);
	//alert(date);
	//alert(confirmCode);
	
	/*
	if (!NAME_REGEX.test(name) || name=='Enter Your Name') {
		venueBookErrors[venueBookErrors.length] = "Please enter your name.";
	}
	*/
 	
 	if (!EMAIL_REGEX.test(email)) {
 		venueBookErrors[venueBookErrors.length] = "Please enter a valid email address.";
 	}
 	
 	if (!PHONE_REGEX.test(contactNumber)) {
 		venueBookErrors[venueBookErrors.length] = "Please enter a valid contact number.";
 	}
 	/*
 	if (!CAL_DATE_REGEX.test(date)) {
 		venueBookErrors[venueBookErrors.length] = "Please enter a valid date.";
 	}
 	*/
 	/*
 	if (confirmCode.trim()=='') {
 		venueBookErrors[venueBookErrors.length] = "Please enter the confirmation code.";
 	}
 	*/
 	
 
	if (venueBookErrors.length > 0) {
	     
	  return false;
	}else{
		
		var response='Correct Captcha';//isValidCaptcha(confirmCode);
		
		if(response!='Correct Captcha'){
			
			venueBookErrors[venueBookErrors.length]=response;
			return false;
		}
		
	}
	
  return true;
}

var bookNowErrors = [];

function submitBookNowSForm(){

	if(isValidBookNowForm()){
    
    document.bookNowForm.action='/booking-confirmation';
    document.bookNowForm.submit;
  }else{
 		var msg="";
	    msg+="Please complete the following Information:";
		msg+="<ul>";
		
	  	for (var i = 0; i<bookNowErrors.length; i++) {
 			
  			msg += '<li>'+ bookNowErrors[i]+'</li>';
		}
		
		msg+="</ul>"
		msg+="</div>";
		
		//alert(msg);
		document.getElementById('errorMessages').innerHTML="<div style='display: block;' class='errorMsg'>"+msg+"</div>";
		document.getElementById('blankBlock').innerHTML="<div style='display: block;' class='blankErrorMsg'>"+msg+"</div><br>";
		bookNowErrors = [];
		return false; 
  }

}

function isValidBookNowForm(){

	//var name = document.bookNowForm.name.value;
	var email = document.bookNowForm.email.value;
	var contactNumber = document.bookNowForm.contactNumber.value;
	//var date = document.bookNowForm.date.value;
	//var confirmCode = document.bookNowForm.confirm_code.value;
	
	/*
	if (!NAME_REGEX.test(name) || name=='Enter Your Name') {
		bookNowErrors[bookNowErrors.length] = "Please enter your name.";
	}
	*/
 	
 	if (!EMAIL_REGEX.test(email)) {
 		bookNowErrors[bookNowErrors.length] = "Please enter a valid email address.";
 	}
 	
 	if (!PHONE_REGEX.test(contactNumber)) {
 		bookNowErrors[bookNowErrors.length] = "Please enter a valid contact number.";
 	}
 	
 	/*
 	if (!CAL_DATE_REGEX.test(date)) {
 		bookNowErrors[bookNowErrors.length] = "Please enter a valid date.";
 	}
 	*/
 	/*
 	if (confirmCode.trim()=='') {
 		bookNowErrors[bookNowErrors.length] = "Please enter the confirmation code.";
 	}
 	*/
 	
 
	if (bookNowErrors.length > 0) {
	     
	  return false;
	}else{
		
		var response='Correct Captcha';//isValidCaptcha(confirmCode);
		
		if(response!='Correct Captcha'){
			
			bookNowErrors[bookNowErrors.length]=response;
			return false;
		}
		
	}
	
  return true;
}





