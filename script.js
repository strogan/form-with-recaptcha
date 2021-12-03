jQuery(document).ready(function($) {


	//E-mail Ajax Send
	

	
	 grecaptcha.ready(function() {	     
	   /*CODE HERE*/  grecaptcha.execute('PUBLIC CODE HERE', {action: 'contact'}).then(function(token) {
	         
	   /*  Form start  */      
	   $("form").submit(function() { //Change
	   
	   
	 /* If recaptcha is not needed remove this 2 lines */  
	var recaptchaResponse = document.getElementById('recaptchaResponse');
        recaptchaResponse.value = token;
		   
		   
	    /* Ajax form submit. Used ajax so page doesn't reload after submitting, has link to mail.php, so they need to in 1 folder. There is alert function,
	    can add redirect instead of it. And after 1 sec form will clear submitted values
	    */
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", // Can Change to mail-smtp.php
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
