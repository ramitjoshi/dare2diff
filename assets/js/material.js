jQuery(document).ready(function()
{
	
	jQuery("input[name=price]").keypress(function (e) {
		 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
		 {
			return false;
		 }
	}); 
	
	
	jQuery('#add_material').validate({
		
		rules: {
			vendor: {
				required: true
			},
			mat_cat: {
				required: true
			},
			descp: {
				required: true
			},
			price: {
				required: true
			}   
		},
			
		submitHandler: function(form) {
			
			jQuery('#cust_job_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/material-handler.php', 
				success: function(data) 
				{					
					 
					jQuery('#cust_job_loader').hide();
					
					if(data==1)
					{
						toastr.success("Material Added"); 
						location.reload();
					}	
					
				}
			});
		}
		
	});
	
	jQuery('#edit_material').validate({
		
		rules: {
			vendor: { 
				required: true
			},
			mat_cat: {
				required: true
			},
			descp: {
				required: true
			},
			price: {
				required: true
			}   
		},
			
		submitHandler: function(form) {
			
			jQuery('#cust_job_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/material-handler.php', 
				success: function(data) 
				{					
					 
					jQuery('#cust_job_loader').hide();
										
					if(data==1) 
					{
						toastr.success("Material Added"); 
						location.reload();
					}	
					
				}
			});
		}
		
	});
	
	
	jQuery('#cat_price').validate({
		
		rules: {
			"price[]": { 
				required: true
			}
		},
			
		submitHandler: function(form) {
			
			jQuery('#cust_job_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: 'modules/material-handler.php', 
				success: function(data) 
				{					
					 
					jQuery('#cust_job_loader').hide();
					toastr.success("Prices have been updated"); 
					location.reload();	 			
					
				}
			});
		}
		
	});
	
});	

function show_material_form()
{
	jQuery('#fromToggle').slideUp();
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery.ajax({type: "POST",
	url: "modules/material-handler.php",
	data: "action=ShowMaterialForm", 
	success:function(result)
	{
		
		jQuery('#fromToggle').empty().append(result); 
	},
	error:function(e){ 
		console.log(e);
	}	
	});  
} 


function show_editmaterial_form(cat_id) 
{
	jQuery('#fromToggle').slideUp();
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	
	jQuery("html, body").animate({
        scrollTop: jQuery('.main').offset().top 
    }, 500); 
	
	jQuery.ajax({type: "POST",
	url: "modules/material-handler.php",
	data: "cat_id="+cat_id+"&action=CatPriceForm",   
	success:function(result)
	{
		jQuery('#fromToggle').empty().append(result); 
	},
	error:function(e){ 
		console.log(e);
	}	
	}); 
}

function edit_material_form(mat_id)
{
	jQuery('#fromToggle').slideUp();
	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';
	jQuery('#fromToggle').slideDown();
	jQuery('#fromToggle').empty().append(loader); 
	jQuery('html, body').animate({
        scrollTop: jQuery('.main').offset().top
    }, 500); 
	jQuery.ajax({type: "POST",
	url: "modules/material-handler.php", 
	data: "mat_id="+mat_id+"&action=EditMaterialForm", 
	success:function(result)  
	{
		
		jQuery('#fromToggle').empty().append(result); 
	},
	error:function(e){ 
		console.log(e);
	}	
	});  
}
function check_water() 
{	
	var cat=jQuery('select[name=mat_cat]').val();	
	if(cat>=5)
	{
		jQuery('input[name=water]').attr('disabled',true);    
		jQuery('input[name=descp]').attr('disabled',true);        
	}	
	else if(cat==3)	 
	{		 
		jQuery('input[name=water]').removeAttr('disabled');
		jQuery('input[name=descp]').removeAttr('disabled');
	}	
	else
	{	
		jQuery('input[name=water]').attr('disabled',true);  
		jQuery('input[name=descp]').removeAttr('disabled');	
	} 	
	
	
	
	
}