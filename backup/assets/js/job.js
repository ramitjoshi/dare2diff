jQuery(document).ready(function(){		jQuery(".datepicker" ).datepicker({        dateFormat: 'mm/dd/yy'    });		jQuery('.filestyle').filestyle({buttonText: ' Upload'});		var i=1;	jQuery('.asd_value').each(function()	{		jQuery(this).attr('tabindex',i);	i++;	});						jQuery('#add_job').validate({				rules: {			cust_name: {				required: true			},			po_num: {				required: true			},			from_date: {				required: true			},			to_date: {				required: true			},			job_name: {				required: true			},			permit: { 				required: true			}											},					submitHandler: function(form) {						var cust_id=jQuery('#cust_id').val();			if(cust_id=="")			{				toastr.error("Please select customer from the list");				return false;				}							jQuery('#cust_job_loader').show();			jQuery(form).ajaxSubmit({				type: "POST",				data: jQuery(form).serialize(),				url: 'modules/job-handler.php', 				success: function(data) 				{															jQuery('#cust_job_loader').hide();										if(data==11)   					{						toastr.error("Only doc,docx,pdf file accept"); 					}					else if(data==0)  					{						toastr.error("Please check Dates"); 					}					else 					{ 						toastr.success("Job added successfully"); 						location.reload(); 					}	   									}			});		}			});		jQuery('#edit_job').validate({				rules: {			cust_name: {				required: true			},			po_num: {				required: true			},			from_date: {				required: true			},			to_date: {				required: true			},			job_name: {				required: true			}											},					submitHandler: function(form) {						jQuery('#cust_job_loader').show();			jQuery(form).ajaxSubmit({				type: "POST",				data: jQuery(form).serialize(),				url: 'modules/job-handler.php',  				success: function(data) 				{															if(data==0)					{						jQuery('#cust_job_loader').hide();						toastr.error("Please check your date");  											}					else if(data==11)					{						jQuery('#cust_job_loader').hide();						toastr.error("jpg,png,jpeg,gif"); 											}  					else					{								jQuery('#cust_job_loader').hide();						toastr.success("Job updated successfully"); 						location.reload();  					}  				}			});		}			});			jQuery('#job_material').validate({				submitHandler: function(form) {						jQuery('#cust_job_loader').show();			jQuery(form).ajaxSubmit({				type: "POST",				data: jQuery(form).serialize(),				url: 'modules/job-handler.php',  				success: function(data) 				{										jQuery('#cust_job_loader').hide();					if(data==1)					{						toastr.success("Material Added"); 						location.reload();  					}					} 			});		}	});		jQuery('#job_piece').validate({				rules: {			piece_name: {				required: true			},			height: {				required: true			}, 			width: {				required: true			}, 			cubic_sq_ft: {				required: true			},			cubic_sq_ft_int: {				required: true			}		},					submitHandler: function(form) {						var check=jQuery('input[name=recipe]:checked').length;			if(check==0)			{				alert('Please select component');				return false;			}			var job_id=jQuery('input[name=job_id]').val();			jQuery('#cust_job_loader').show();			jQuery(form).ajaxSubmit({				type: "POST",				data: jQuery(form).serialize(),				url: 'modules/job-handler.php',  				success: function(data) 				{										jQuery('#cust_job_loader').hide();					toastr.success("Componnet added in the piece"); 					window.location.href="index.php?section=new-piece&id="+job_id+"&pr_id="+data;				}   			}); 		}			});		jQuery('#edit_peice_comp').validate({				rules: {			piece_name: {				required: true			},			height: {				required: true			}, 			width: {				required: true			}, 			cubic_sq_ft: {				required: true			},			cubic_sq_ft_int: {				required: true			}		},					submitHandler: function(form) {			var job_id=jQuery('input[name=job_id]').val();			jQuery('#cust_job_loader').show();			jQuery(form).ajaxSubmit({				type: "POST",				data: jQuery(form).serialize(),				url: 'modules/job-handler.php',  				success: function(data) 				{										if(data==1)					{							jQuery('#cust_job_loader').hide();						toastr.success("Changes Saved"); 						location.reload();					}				}   			}); 		}			});			jQuery('#add_peice_comp').validate({				rules: {			piece_name: {				required: true			},			height: {				required: true			}, 			width: {				required: true			}, 			cubic_sq_ft: {				required: true			},			cubic_sq_ft_int: {				required: true			}		},					submitHandler: function(form) {			var job_id=jQuery('input[name=job_id]').val();			jQuery('#cust_job_loader').show();			jQuery(form).ajaxSubmit({				type: "POST",				data: jQuery(form).serialize(),				url: 'modules/job-handler.php',  				success: function(data) 				{															if(data==1)					{							jQuery('#cust_job_loader').hide();						toastr.success("New Component has been added"); 						location.reload(); 					}				}   			}); 		}			});			jQuery('#edit_piece').validate({				rules: {			piece_name: {				required: true			}		},					submitHandler: function(form) {			jQuery('#cust_job_loader').show();			jQuery(form).ajaxSubmit({				type: "POST",				data: jQuery(form).serialize(),				url: 'modules/job-handler.php',   				success: function(data) 				{										if(data==1)					{							jQuery('#cust_job_loader').hide();						toastr.success("Changes Saved"); 						jQuery('#fromToggle').slideUp();					}				}   			}); 		}			});	});function show_job_form() {	jQuery('#fromToggle').slideUp();	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';	jQuery('#fromToggle').slideDown();	jQuery('#fromToggle').empty().append(loader); 		jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "action=ShowJobForm", 	success:function(result)	{		jQuery('#fromToggle').empty().append(result); 	},	error:function(e){ 		console.log(e);	}		});  }function edit_job_form(job_id){		jQuery('#fromToggle').slideUp();	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';	jQuery('#fromToggle').slideDown();	jQuery('#fromToggle').empty().append(loader); 		jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "job_id="+job_id+"&action=EditJobForm", 	success:function(result)	{		jQuery('#fromToggle').empty().append(result); 	},	error:function(e){ 		console.log(e);	}		});  }function add_material_form(job_id){		jQuery('#fromToggle').slideUp();	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';	jQuery('#fromToggle').slideDown();	jQuery('#fromToggle').empty().append(loader); 		jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "job_id="+job_id+"&action=ShowMaterialForm", 	success:function(result)	{		jQuery('#fromToggle').empty().append(result); 	},	error:function(e){ 		console.log(e);	}		});  }function get_customer(){	var loader='<li><div class="list-load"><img src="assets/images/loader-11.gif"/></div><li>';	jQuery('.filter').show();	jQuery('.filter').empty().append(loader); 	var cust=jQuery('input[name=cust_name]').val(); 	if(cust!='')	{			jQuery.ajax({type: "POST",		url: "modules/job-handler.php",		data: "cust="+cust+"&action=getCustomer", 		success:function(result)		{			jQuery('.filter').empty().append(result);		},		error:function(e){			console.log(e);		}			}); 	}	else	{		jQuery('.filter').hide(); 	}	}function set_name(id,name){	jQuery('#cust_id').empty().val(id);	jQuery('input[name=cust_name]').val(name);	jQuery('.filter').empty().hide();}function show_job_pic(e){	if(jQuery('.show_job_photo').hasClass('open')) 	{ 		jQuery('.show_job_photo').empty().append('Show Job Photos');		jQuery('.show_job_photo').removeClass('open');		jQuery('.show_job_photo').attr('onclick','show_job_pic(1);');	}	else	{ 		jQuery('.show_job_photo').empty().append('Hide Job Photos'); 		jQuery('.show_job_photo').addClass('open');		jQuery('.show_job_photo').attr('onclick','show_job_pic(0);');	}	if(e==1)	{		jQuery('.job_images').show();	}		else	{		jQuery('.job_images').hide(); 	}		}function show_job_mat(e){	if(jQuery('.mat_sec').hasClass('open'))   	{ 		jQuery('.mat_sec').empty().append('Show Materials');		jQuery('.mat_sec').removeClass('open');		jQuery('.mat_sec').attr('onclick','show_job_mat(1);');	}	else	{		jQuery('.mat_sec').empty().append('Hide Materials'); 		jQuery('.mat_sec').addClass('open'); 		jQuery('.mat_sec').attr('onclick','show_job_mat(0);');	}	if(e==1)	{		jQuery('.material_list').show();	}		else	{		jQuery('.material_list').hide();  	}		}function show_material_piece(e){	jQuery('.table_piece').hide(); 	var value=jQuery(e).val();	var label=jQuery(e).next('label').html();	jQuery('.piece_name').empty().append(label); 	jQuery('.table_piece').show();}function cal_cost(row_id){	var input=jQuery('.input_'+row_id).val();	if(input!="")	{			var price=jQuery('.price_'+row_id).html();		var total=input  * price;		jQuery('.cost_'+row_id).html(total);  		jQuery('.cost_text_box_'+row_id).val(total);   				var main_cat=jQuery('.input_'+row_id).attr('u');		var sg=jQuery('.main_cat_'+main_cat).html();		if(sg!=0)		{			var cal_sg=parseFloat(parseFloat(input)/62.4/parseFloat(sg));		cal_sg= cal_sg.toFixed(2);  		jQuery('.sg_cal_'+row_id).html(cal_sg);		}		else		{			jQuery('.sg_cal_'+row_id).html(0); 		}				 		var count_ad=0;		jQuery('.weight_txt').each(function()		{			var value=jQuery(this).val();			if(value=="")			{				value=0;			}				count_ad=parseFloat(count_ad) + parseFloat(value); 		}); 				jQuery('#total_weight').val(count_ad); 		jQuery('.weight_span').empty().append(count_ad);						var count_total=0;		jQuery('.total_cost').each(function()		{			var value=jQuery(this).html();			if(value=="")			{				value=0;			}				count_total=parseFloat(count_total) + parseFloat(value); 		}); 		jQuery('#total_cost_1').val(count_total); 				jQuery('.cost_span').empty().append(count_total);				var tot_sg="";		jQuery.each(jQuery(".tot_sg_cal"), function() {		tot_sg += (tot_sg?',':'') + jQuery(this).html(); 		});				jQuery('input[name=tot_abs_vol]').val(tot_sg);  	}	}function cal_sq_ft(){	var thick=jQuery('input[name=thick]').val();	var height=jQuery('input[name=height]').val();	var width=jQuery('input[name=width]').val();	if(thick=="" || height=="" || width=="")	{		alert('Fill Required Fields');		return false;	}		var value= parseFloat((parseFloat(thick) * parseFloat(height) * parseFloat(width))/1728);	var value= value.toFixed(2); 	var per= (parseFloat(value) * 0.05); 	var act_vale= parseFloat(value) + parseFloat(per);	var act_vale= act_vale.toFixed(2); 	jQuery('input[name=cubic_sq_ft]').val(value);	jQuery('input[name=cubic_sq_ft_int]').val(act_vale);} function cal_cubic_fig(){	var thick=jQuery('input[name=thick]').val();	var height=jQuery('input[name=height]').val();	var width=jQuery('input[name=width]').val();	if(height!="" && width!="" && thick!="") 	{		var thick=jQuery('input[name=thick]').val();		var height=jQuery('input[name=height]').val();		var width=jQuery('input[name=width]').val(); 				var value= parseFloat((parseFloat(thick) * parseFloat(height) * parseFloat(width))/1728);		value= value.toFixed(3);  		var per= parseFloat((parseFloat(value) * 5)/100); 				var act_vale= parseFloat(value) + parseFloat(per);		act_vale= act_vale.toFixed(3);   		jQuery('input[name=cubic_sq_ft]').val(value); 		jQuery('input[name=cubic_sq_ft_int]').val(act_vale);	}	else	{		jQuery('input[name=cubic_sq_ft]').val('');		jQuery('input[name=cubic_sq_ft_int]').val('');	}			} function add_component(job_id,piece_id,comp_id){		jQuery('#fromToggle').slideUp();	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';	jQuery('#fromToggle').slideDown();	jQuery('#fromToggle').empty().append(loader); 	jQuery('html, body').animate({        scrollTop: jQuery('.main').offset().top    }, 500); 	jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "job_id="+job_id+"&piece_id="+piece_id+"&comp_id="+comp_id+"&action=AddComponentShow", 	success:function(result)	{		jQuery('#fromToggle').empty().append(result); 	},	error:function(e){		console.log(e);	}		}); }function edit_component(job_id,piece_id,comp_id){		jQuery('#fromToggle').slideUp();	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';	jQuery('#fromToggle').slideDown();	jQuery('#fromToggle').empty().append(loader); 		jQuery('html, body').animate({        scrollTop: jQuery('.main').offset().top    }, 500); 			jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "job_id="+job_id+"&piece_id="+piece_id+"&comp_id="+comp_id+"&action=EditComponentShow", 	success:function(result)	{		jQuery('#fromToggle').empty().append(result); 	},	error:function(e){		console.log(e);	}		}); }function view_component(job_id,piece_id,comp_id){		jQuery('#fromToggle').slideUp();	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';	jQuery('#fromToggle').slideDown();	jQuery('#fromToggle').empty().append(loader); 		jQuery('html, body').animate({        scrollTop: jQuery('.main').offset().top    }, 500); 		 	jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "job_id="+job_id+"&piece_id="+piece_id+"&comp_id="+comp_id+"&action=ViewComponentShow", 	success:function(result)	{		jQuery('#fromToggle').empty().append(result); 	},	error:function(e){		console.log(e);	}		}); }function edit_piecee(peice_id){	jQuery('#fromToggle').slideUp();	var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';	jQuery('#fromToggle').slideDown();	jQuery('#fromToggle').empty().append(loader); 		jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "peice_id="+peice_id+"&action=EditPieceShow",   	success:function(result)	{		jQuery('#fromToggle').empty().append(result); 	},	error:function(e){  		console.log(e);	}		}); }function readURL(input,q)  { 	if (input.files && input.files[0]) {		var reader = new FileReader();		reader.onload = function (e) {   					jQuery('.'+q).find("img").hide();		jQuery('.'+q).css('background-image', "url('"+e.target.result+"')");		jQuery('.'+q).css('background-position', 'center');		jQuery('.'+q).css('background-repeat', 'no-repeat');					};		reader.readAsDataURL(input.files[0]);			}	}function delete_comp(comp_id){	if (confirm('Are you sure?')) { 		jQuery('#fromToggle').slideUp();		var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';		jQuery('#fromToggle').slideDown();		jQuery('#fromToggle').empty().append(loader); 				jQuery.ajax({type: "POST",		url: "modules/job-handler.php",		data: "comp_id="+comp_id+"&action=DeleteComponent",   		success:function(result)		{			if(result==1)			{				toastr.success("Component has been deleted"); 				location.reload();   			}			},		error:function(e){  			console.log(e);		}			}); 	}}function del_piece(piece_id){	if (confirm('Are you sure?')) { 		var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';		jQuery('.piece_'+piece_id).empty().append(loader); 				jQuery.ajax({type: "POST",		url: "modules/job-handler.php",		data: "piece_id="+piece_id+"&action=DeletePiece",   		success:function(result)		{			if(result==1)			{				jQuery('.piece_'+piece_id).remove();				toastr.success("Piece and related information has been deleted"); 							}			},		error:function(e){  			console.log(e);		}			}); 	}}function ajax_mat_assign(e){	var job_id=jQuery('#job_id').val();	var mat_id="";	jQuery.each(jQuery("input[name='mat_id[]']:checked"), function() {	mat_id += (mat_id?',':'') + jQuery(this).val();	});			var loader='<img src="assets/images/loader-11.gif" class="loader-ani" />';	jQuery('.material_list').addClass('not_click_mn');			jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "job_id="+job_id+"&mat_id="+mat_id+"&action=AssignMaterial",   	success:function(result)	{				if(result==1)		{				jQuery('.material_list').removeClass('not_click_mn');			toastr.success("Changes in material have been saved");      		} 	},	error:function(e){  		console.log(e);	}		}); 		}function lock_unlock(peice_id,status){	jQuery.ajax({type: "POST",	url: "modules/job-handler.php",	data: "peice_id="+peice_id+"&status="+status+"&action=LockUnlockPiece",   	success:function(result)  	{ 				toastr.success("Changes have been saved");  		location.reload();		},	error:function(e){  		console.log(e);	}		});}