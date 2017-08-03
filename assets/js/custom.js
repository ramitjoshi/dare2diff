jQuery(document).ready(function()
{
	jQuery('.rt_sidebar').find('table').wrap('<div class="responisve_table"></div>');
	
	jQuery('#signin').validate({
		
		rules: {
			username: {
				required: true
			},
			password: { 
				required: true
			}
			
		},
		
		submitHandler: function(form) {
			jQuery('#signin_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'handler.php', 
				success: function(data) 
				{
					jQuery('#signin_loader').hide();
					if(data==1)  
					{	
						toastr.success("Login Successfull"); 
						window.location.href="index.php?section=dashboard";  	
					} 
					else if(data==2)   
					{	
						toastr.error("Your username or password is incorrect"); 
						
					}
					else if(data==0)   
					{
						toastr.error("Your username or password is incorrect");  
					}	
				} 
			}); 
		}
		
	});
	
	
});

	
 