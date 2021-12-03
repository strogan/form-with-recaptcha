jQuery(document).ready(function($) {


	//E-mail Ajax Send
	

	
	 grecaptcha.ready(function() {	     
	   /*CODE HERE*/  grecaptcha.execute('PUBLIC CODE HERE', {action: 'contact'}).then(function(token) {
	         
	   /*  Form start  */      
	   $("form").submit(function() { //Change
	   
	   
	 /* If recaptcha is not needed remove this 2 lines */  
	var recaptchaResponse = document.getElementById('recaptchaResponse');
        recaptchaResponse.value = token;
		   
		   
	    
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Thank you!");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
		
	    });
		
	
	
	/*  Form end  */
	     });		
	});
	


});
