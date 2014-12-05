jQuery(document).ready(function() {
var url = document.URL;
$('#url').val(url);
$('.bs-error-register-modal-lg').modal('show');
    
$("#form-register").validate({
	rules:{
		name:{
			required:true,
			minlength:6,
			remote:{
				url:"check/check-username",
				type:"POST"
			}
		},
		password:{
			required:true,
			minlength:6
		},
		password_confirmation:{
		    required:true,
			equalTo:"#password"
		},
		email:{
			required:true,
			email:true,
			remote:{
				url:"check/check-email",
				type:"POST"
			}
		}
	},
	messages:{
		name:{
			required:"Please fill out username field",
			minlength:"Username must be at least 6 characters",
			remote:"This username has already been taken"
		},
		password:{
			required:"Please fill out password field",
			minlength:"Password must be at least 6 characters",
		},
		password_confirmation:{
		    required:"Please fill out re-password field",
			equalTo:"Confirm password is incorrect"
		},
		email:{
			required:"Please fill out email address field",
			email:"This is an invalid email format",
			remote:"This email has already been taken"
		}
	}
})
});