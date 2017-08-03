jQuery(document).ready(function()
{
	// Add Customer
	jQuery('#add_customer').validate({
		
		rules: {
			fname: {
				required: true
			},
			lname: {
				required: true
			},
			email: {
				email: true
			},
			
			
		},
			
		submitHandler: function(form) {
			
			jQuery('#cust_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/customer-handler.php', 
				success: function(data) 
				{					
					jQuery('#cust_loader').hide();
					if(data==1)
					{
						toastr.success("Customer Added"); 
						jQuery('#fromToggle').slideUp();
						jQuery('#add_customer').trigger('reset');
					}	
					 
				}
			});
		}
		
	});
	
	jQuery('#edit_customer').validate({

		rules: {
			fname: { 
				required: true
			},
			lname: {
				required: true
			},


		},

		submitHandler: function(form) {
			jQuery('.edit_result').empty();
			jQuery('.edit_result').show();
			jQuery('#edit_cust_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/customer-handler.php', 
				success: function(data) 
				{
					jQuery('#edit_cust_loader').hide();
					
					
					if(data==1)
					{
						toastr.success("Changes Saved"); 
						jQuery('#fromToggle').slideUp();
					}

				}
			});
		}

	});
	
	
	
	
});
function show_customer_form()
{
	
	jQuery('#fromToggle').slideUp();
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/customer-handler.php",
	data: "action=ShowCustomerForm", 
	success:function(result)
	{
		jQuery('#fromToggle').empty().append(result); 
	},
	error:function(e){ 
		console.log(e);
	}	
	});  
	
}

function edit_user_customer(id)
{
	
	var id=id;		
	jQuery('#fromToggle').slideUp();
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/customer-handler.php",
	data: "id="+id+"&action=CustomerEditShow", 
	success:function(result){
		jQuery("html, body").animate({
			scrollTop: jQuery('.rt_sidebar').offset().top 
		}, 1000); 
		jQuery('#fromToggle').empty().append(result);  
	},
	error:function(e){
		console.log(e);
	}	
	}); 
	
	
}


function delete_user(e)
{
	var id=jQuery(e).attr('id');
	var name=jQuery(e).attr('u');
	if (confirm('Are you sure?? You want to delete '+ name))  
	{
		jQuery('#fromToggle').slideUp();    
		var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
		jQuery('#fromToggle').slideDown();
		jQuery('#fromToggle').empty().append(loader); 
		jQuery.ajax({type: "POST",
		url: "modules/customer-handler.php", 
		data: "user_id="+id+"&action=DeleteCustomer",  
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

function get_cust_info(user_id)
{
	jQuery('#fromToggle').slideUp();    
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/customer-handler.php", 
	data: "user_id="+user_id+"&action=GetCustomerInfo",  
	success:function(result)
	{
		jQuery("html, body").animate({
			scrollTop: jQuery('.rt_sidebar').offset().top 
		}, 1000); 
		jQuery('#fromToggle').empty().append(result);  
	},   
	error:function(e){ 
		console.log(e); 
	}	
	});
}