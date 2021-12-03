Php and Javascript code to send emails from any form. You can add google recaptcha or connect to smtp server.

Required files are mail.php and script.js

Index.html has example of using this form on page.

Installation form with recaptcha
------------
Add this code to header with your public recaptcha token, dont add it if you won't use it.

<script src="https://www.google.com/recaptcha/api.js?render=PUBLIC-CODE"></script>

And add this form to any place you need.

<form>

		<!-- Hidden Required Fields -->
		<input type="hidden" name="project_name" value="Site Name">
		<input type="hidden" name="admin_email" value="admin@mail.com">
		<input type="hidden" name="form_subject" value="Form Subject">
		<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
		<!-- END Hidden Required Fields -->

		<input type="text" name="Name" placeholder="You name..." required><br>
		<input type="text" name="E-mail" placeholder="You E-mail..." required><br>
		<input type="text" name="Phone" placeholder="You phone..."><br>
		<button>Send</button>

	</form>
  
  
 Hidden fields are required, update site name, admin email and form subject. All other fields form will send automatically, you just need to update input name. It doesnt have limit of inputs.
 
 On mail.php need to add secret recaptcha token and email from where emails will code. Like this email admin@domain.com.
 script.js needs public key only. Paste all code, if you dont need recaptcha, paste code inside /*  Form start  */  except 2 lines
 
 
Installation form with smtp
------------
Same action, but need to use mail-smtp.php instead of mail.php file. Add your smtp server values in Server settings, update Recipients emails and thats it.
