jQuery(document).ready(function()
{
	jQuery("input[name=phone]").keypress(function (e) {		 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 		 {			return false;		 }	}); 			jQuery('input[name=post_code]').keyup(function () {				var yourInput = jQuery(this).val();		re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;		var isSplChar = re.test(yourInput);		if(isSplChar) 		{			var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');			jQuery(this).val(no_spl_char); 		}				});			jQuery('input[name=name]').keyup(function () { 				var yourInput = jQuery(this).val();		re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;		var isSplChar = re.test(yourInput);		if(isSplChar) 		{			var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');			jQuery(this).val(no_spl_char); 		}				});
	jQuery('#add_vendor').validate({
		
		rules: {
			fname: {
				required: true 
			},
			lname: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			
			
		},
			
		submitHandler: function(form) {
			jQuery('#cust_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/vendor-handler.php', 
				success: function(data)  
				{					
					jQuery('#cust_loader').hide();
					if(data==1) 
					{
						toastr.success("Vendor Added"); 
						location.reload();
					} 
					else 
					{  
						toastr.success("Email already exists"); 
					}	 
					
				}
			});
		}
		
	});
	
	jQuery('#edit_vendor').validate({

		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				email:true
			}


		},

		submitHandler: function(form) {
			
			jQuery('#edit_cust_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/vendor-handler.php',
				success: function(data)
				{ 
					jQuery('#edit_cust_loader').hide();					
					if(data==1)
					{ 
						
						toastr.success("Vendor Saved"); 
						location.reload();
					} 

				}
			});
		}

	});
	
	
	
	
});
function show_vendor_form()
{
	
	jQuery('#fromToggle').slideUp();
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/vendor-handler.php",
	data: "action=ShowVendorForm", 
	success:function(result)
	{
		jQuery('#fromToggle').empty().append(result); 
	},
	error:function(e){ 
		console.log(e);
	}	
	});  
	
}

function edit_user_vendor(id)
{
	
	var id=id;		 
	jQuery('#fromToggle').slideUp();
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/vendor-handler.php",
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


function delete_vendor(e)
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
		url: "modules/vendor-handler.php", 
		data: "user_id="+id+"&action=DeleteVendor",  
		success:function(result) 
		{
			toastr.success("Vendor Deleted"); 
			location.reload();   
		},   
		error:function(e){ 
			console.log(e); 
		}	
		});
	}	
}

function get_vendor_info(user_id)  
{ 
	jQuery('#fromToggle').slideUp();    
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/vendor-handler.php", 
	data: "user_id="+user_id+"&action=GetVendorInfo",  
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