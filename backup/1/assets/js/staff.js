jQuery(document).ready(function()
{
	
	jQuery('#add_staff').validate({
		
		rules: {
			fname: {
				required: true
			},
			lname: {
				required: true
			},
			email: {
				
				email: true
			}
			
			
		},
			
		submitHandler: function(form) {
			
			jQuery('#addSaff_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/staff-handler.php', 
				success: function(data) 
				{					
					jQuery('#addSaff_loader').hide();
					if(data==0)
					{
						toastr.error("Username already exists"); 
					}	
					else if(data==2)
					{
						toastr.success("Email already exists"); 
					}	
					else
					{
						toastr.success("Staff has been added"); 
						jQuery('#add_staff').trigger('reset');						
						location.reload();
					}
						
					
					
				}
			});
		}
		
	});
	
	jQuery('#edit_staff').validate({ 
		
		rules: {
			fname: {
				required: true
			},
			lname: {
				required: true
			},
			email: { 
				
				required : true,
				email: true
			}
			 
		},
			 
		submitHandler: function(form) { 
			
			jQuery('#addSaff_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/staff-handler.php', 
				success: function(data)  
				{					
					jQuery('#addSaff_loader').hide();
					toastr.success("Changes Saved"); 
					location.reload();
				} 
			});
		}
		
	}); 
});

function show_staff_form()
{
	
	jQuery('#fromToggle').slideUp();
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/staff-handler.php",
	data: "action=ShowStaffForm", 
	success:function(result)
	{
		jQuery('#fromToggle').empty().append(result); 
	},
	error:function(e){ 
		console.log(e);
	}	
	}); 
	
}

function edit_user_staff(user_id) 
{
	
	jQuery('#fromToggle').slideUp();    
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	
	jQuery('#fromToggle').slideDown();
	 
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/staff-handler.php",
	data: "user_id="+user_id+"&action=EditStaffForm",  
	success:function(result)
	{
		jQuery('#fromToggle').empty().append(result); 
	}, 
	error:function(e){ 
		console.log(e); 
	}	
	}); 
	
}

function delete_staff(user_id)
{
	if (confirm('Are you sure??'))  
	{
		jQuery('#fromToggle').slideUp();    
		var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
		jQuery('#fromToggle').slideDown();
		jQuery('#fromToggle').empty().append(loader); 
		jQuery.ajax({type: "POST",
		url: "modules/staff-handler.php",
		data: "user_id="+user_id+"&action=DeleteStaff",  
		success:function(result)
		{
			location.reload();
		},  
		error:function(e){ 
			console.log(e); 
		}	
		});
	}	
}

function freeze_user(status,user_id)
{
	var status=status;
	var user_id=user_id;
	jQuery('#addSaff_loader').show();
	jQuery.ajax({type: "POST", 
	url: "modules/staff-handler.php", 
	data: "user_id="+user_id+"&status="+status+"&action=FreezeUser", 
	success:function(result) 
	{
		jQuery('#addSaff_loader').hide();
		if(result==0)
		{
			toastr.success("User has been frozen"); 
		}
		else
		{
			toastr.success("User has been unfrozen"); 
		}	
		jQuery('#fromToggle').slideUp(); 	
	},
	error:function(e)
	{
		console.log(e);
	}	
	}); 
}