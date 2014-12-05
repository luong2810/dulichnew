jQuery(document).ready(function() {
$("#form-editprofile").validate({
	rules:{
		name:{
			required:true,
			minlength:6,
			remote:{
				url:"check/check-edit-username",
				type:"POST"
			}
		},
		password:{
			minlength:6
		},
		re_password:{
			equalTo:"#password"
		},
		email:{
			required:true,
			email:true,
			remote:{
				url:"check/check-edit-email",
				type:"POST"
			}
		},
        zip:{
			minlength:5,
            maxlength:5
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
		re_password:{
		    required:"Please fill out re-password field",
			equalTo:"Confirm password is incorrect"
		},
		email:{
			required:"Please fill out email address field",
			email:"This is an invalid email format",
			remote:"This email has already been taken"
		},
        zip:{
			minlength:"Zip code must be 5 characters",
            maxlength:"Zip code must be 5 characters"
		}
	},
    submitHandler: function() {
        var data = [];
        data[0] = $('#email').val();
        data[1] = $('#name').val();
        data[2] = $('#password').val();
        data[3] = $('#re_password').val();
        data[4] = $('#txtPhone').val();
        data[5] = $('#zip').val();
        data[6] = $('#txtAddress').val();
        data[7]= $('#txtBankName').val();
        data[8] = $('#txtBankBranchName').val();
        data[9] = $('#txtBankAccount').val();
        data[10] = window.location.protocol + '//' + window.location.host;
        $('img.edit-loading').show(); 
        $.ajax({
                url: '/account',
                type: 'PUT',
                cache: false,
                contentType: 'application/x-www-form-urlencoded',
                dataType: 'json',
                data: {all:data},
                success: function(data){
                    data = data.changed;
                    var string = '';
                    count = 0;
                    console.log(data);
                    if (data['email']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'E-mail address';
                        $('#confirm_email').closest('.row').attr('class','row');
                        $('#confirm_email').html('Please check your new e-mail address to confirm email change.');
                        
                    }
                    if (data['name']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'Name';
                    }
                    if (data['password']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'Password';
                    }
                    if (data['phone_number']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'Phone number';
                    }
                    if (data['zip']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'Zip code';
                    }
                    if (data['address']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'Address';
                    }
                    if (data['bank_name']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'Bank Name';
                    }
                    if (data['bank_branch_name']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'Bank Branch Name';
                    }
                    if (data['bank_account_number']) {
                        if (count) {
                            string +=', ';
                        }
                        count ++;
                        string += 'Bank Account';
                    }
                    if (string) {
                        if (count > 1) {
                            string = 'Your ' + string + ' have been changed.';
                        } else {
                            string = 'Your ' + string + ' has been changed.';
                        }
                        $('#confirm').closest('.row').attr('class','row');
                        $('#confirm').html(string);
                    }
                    $('img.edit-loading').hide(); 
                }
            });  
    }
})
});
