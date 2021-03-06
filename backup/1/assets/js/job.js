jQuery(document).ready(function() {
    jQuery(".datepicker").datepicker({
        dateFormat: 'mm/dd/yy'
    });
    jQuery('.filestyle').filestyle({
        buttonText: ' Upload'
    });
    var i = 1;
    jQuery('.asd_value').each(function() {
        jQuery(this).attr('tabindex', i);
        i++;
    });
    jQuery('input[name=portland_concrete]').click(function() {
        var asd = jQuery(this).val();
        jQuery('#port').val(asd);
    });
    jQuery('input[name=sand]').click(function() {
        var asd = jQuery(this).val();
        jQuery('#sand').val(asd);
    });
    jQuery('input[name=pigments]').click(function() {
        var asd = jQuery(this).val();
        jQuery('#pigment').val(asd);
    });
    jQuery('input[name=sealer]').click(function() {
        var asd = jQuery(this).val();
        jQuery('#sealer').val(asd);
    });
    jQuery('#add_job').validate({
        rules: {
            cust_name: {
                required: true
            },
            po_num: {
                required: true
            },
            from_date: {
                required: true
            },
            to_date: {
                required: true
            },
            job_name: {
                required: true
            },
            permit: {
                required: true
            }
        },
        submitHandler: function(form) {
            var cust_id = jQuery('#cust_id').val();
            if (cust_id == "") {
                toastr.error("Please select customer from the list");
                return false;
            }
            if (jQuery('#port').val() == 0) {
                toastr.error("Select Portland Concrete material");
                return false;
            }
            if (jQuery('#sand').val() == 0) {
                toastr.error("Select Sand material");
                return false;
            }
            if (jQuery('#pigment').val() == 0) {
                toastr.error("Select Pigments material");
                return false;
            }
            if (jQuery('#sealer').val() == 0) {
                toastr.error("Select Sealer material");
                return false;
            }
            jQuery('#cust_job_loader').show();
            jQuery(form).ajaxSubmit({
                type: "POST",
                data: jQuery(form).serialize(),
                url: 'modules/job-handler.php',
                success: function(data) {
                    jQuery('#cust_job_loader').hide();
                    if (data == 11) {
                        toastr.error("Only doc,docx,pdf file accept");
                    } else if (data == 0) {
                        toastr.error("Please check Dates");
                    } else {
                        toastr.success("Job added successfully");
                        location.reload();
                    }
                }
            });
        }
    });
    jQuery('#edit_job').validate({
        rules: {
            cust_name: {
                required: true
            },
            po_num: {
                required: true
            },
            from_date: {
                required: true
            },
            to_date: {
                required: true
            },
            job_name: {
                required: true
            }
        },
        submitHandler: function(form) {
            jQuery('#cust_job_loader').show();
            jQuery(form).ajaxSubmit({
                type: "POST",
                data: jQuery(form).serialize(),
                url: 'modules/job-handler.php',
                success: function(data) {
                    if (data == 0) {
                        jQuery('#cust_job_loader').hide();
                        toastr.error("Please check your date");
                    } else if (data == 11) {
                        jQuery('#cust_job_loader').hide();
                        toastr.error("jpg,png,jpeg,gif");
                    } else {
                        jQuery('#cust_job_loader').hide();
                        toastr.success("Job updated successfully");
                        location.reload();
                    }
                }
            });
        }
    });
    jQuery('#job_material').validate({
        submitHandler: function(form) {
            jQuery('#cust_job_loader').show();
            jQuery(form).ajaxSubmit({
                type: "POST",
                data: jQuery(form).serialize(),
                url: 'modules/job-handler.php',
                success: function(data) {
                    jQuery('#cust_job_loader').hide();
                    if (data == 1) {
                        toastr.success("Material Added");
                        location.reload();
                    }
                }
            });
        }
    });
    jQuery('#job_piece').validate({
        rules: {
            piece_name: {
                required: true
            },
            height: {
                required: true
            },
            width: {
                required: true
            },
            cubic_sq_ft: {
                required: true
            },
            cubic_sq_ft_int: {
                required: true
            }
        },
        submitHandler: function(form) {
            var check = jQuery('input[name=recipe]:checked').length;
            var asd = 0;
            if (check == 0) {
                alert('Please select component');
                return false;
            }
            jQuery('.weight_txt').each(function() {
                var check = jQuery(this).val();
                if (check == "") {
                    asd = 1;
                }
            });
            if (asd == 1) {
                alert('Fill all weight options');
                return false;
            }
            var job_id = jQuery('input[name=job_id]').val();
            jQuery('#cust_job_loader').show();
            jQuery(form).ajaxSubmit({
                type: "POST",
                data: jQuery(form).serialize(),
                url: 'modules/job-handler.php',
                success: function(data) {
                    jQuery('#cust_job_loader').hide();
                    toastr.success("Componnet added in the piece");
                    window.location.href = "index.php?section=new-piece&id=" + job_id + "&pr_id=" + data;
                }
            });
        }
    });
    jQuery('#edit_peice_comp').validate({
        rules: {
            piece_name: {
                required: true
            },
            height: {
                required: true
            },
            width: {
                required: true
            },
            cubic_sq_ft: {
                required: true
            },
            cubic_sq_ft_int: {
                required: true
            }
        },
        submitHandler: function(form) {
            var asd = 0;
            jQuery('.weight_txt').each(function() {
                var check = jQuery(this).val();
                if (check == "") {
                    asd = 1;
                }
            });
            if (asd == 1) {
                alert('Fill all weight options');
                return false;
            }
            var job_id = jQuery('input[name=job_id]').val();
            jQuery('#cust_job_loader').show();
            jQuery(form).ajaxSubmit({
                type: "POST",
                data: jQuery(form).serialize(),
                url: 'modules/job-handler.php',
                success: function(data) {
                    if (data == 1) {
                        jQuery('#cust_job_loader').hide();
                        toastr.success("Changes Saved");
                        location.reload();
                    }
                }
            });
        }
    });
    jQuery('#add_peice_comp').validate({
        rules: {
            piece_name: {
                required: true
            },
            height: {
                required: true
            },
            width: {
                required: true
            },
            cubic_sq_ft: {
                required: true
            },
            cubic_sq_ft_int: {
                required: true
            }
        },
        submitHandler: function(form) {
            var asd = 0;
            jQuery('.weight_txt').each(function() {
                var check = jQuery(this).val();
                if (check == "") {
                    asd = 1;
                }
            });
            if (asd == 1) {
                alert('Fill all weight options');
                return false;
            }
            var job_id = jQuery('input[name=job_id]').val();
            jQuery('#cust_job_loader').show();
            jQuery(form).ajaxSubmit({
                type: "POST",
                data: jQuery(form).serialize(),
                url: 'modules/job-handler.php',
                success: function(data) {
                    if (data == 1) {
                        jQuery('#cust_job_loader').hide();
                        toastr.success("New Component has been added");
                        location.reload();
                    }
                }
            });
        }
    });
    jQuery('#edit_piece').validate({
        rules: {
            piece_name: {
                required: true
            }
        },
        submitHandler: function(form) {
            jQuery('#cust_job_loader').show();
            jQuery(form).ajaxSubmit({
                type: "POST",
                data: jQuery(form).serialize(),
                url: 'modules/job-handler.php',
                success: function(data) {
                    if (data == 1) {
                        jQuery('#cust_job_loader').hide();
                        toastr.success("Changes Saved");
                        jQuery('#fromToggle').slideUp();
                    }
                }
            });
        }
    });
    jQuery('#close_job').validate({
        rules: {
            pr_num: {
                required: true
            },
            close_notes: {
                required: true
            }
        },
        submitHandler: function(form) {
            jQuery('#cust_job_loader').show();
            jQuery(form).ajaxSubmit({
                type: "POST",
                data: jQuery(form).serialize(),
                url: 'modules/job-handler.php',
                success: function(data) {
                    jQuery('#cust_job_loader').hide();
                    if (data == 11) {
                        toastr.error("Only doc,docx,pdf file accept");
                    } else if (data == 0) {
                        toastr.error("Please check Dates");
                    } else {
                        toastr.success("Job added successfully");
                        location.reload();
                    }
                }
            });
        }
    });
    jQuery('.csa').keyup(function() {
        jQuery('.csa').attr('readonly', true);
        jQuery('.form').addClass('not_click_mn');
        var csa_val = jQuery(this).val();
        if (csa_val == "") {
            var csa_val = jQuery('.def_csa').html();
            jQuery('.csa').val(csa_val);
        }
        var fume = jQuery('#j').val();
        jQuery('#i').val(csa_val);
        var water = jQuery('input[name=water]').val();
        jQuery.ajax({
            type: "POST",
            url: "modules/job-handler.php",
            data: "csa=" + csa_val + "&water=" + water + "&fume=" + fume + "&action=CalCsa",
            success: function(result) {
                jQuery('.csa').removeAttr('readonly');
                jQuery('.form').removeClass('not_click_mn');
                if (result == 0) {
                    toastr.error("Check Input");
                } else {
                    result = jQuery.trim(result);
                    jQuery('#a').val(result);
                    var a = jQuery('#a').val();
                    jQuery('input[name=portland_concrete]').val(a);
                    jQuery('input[name=sand]').val(a);
                    var port_price = jQuery('.price_portland_concrete').html();
                    var port_cost = parseFloat(a) * parseFloat(port_price);
                    port_cost = port_cost.toFixed(2);
                    var main_cat_1 = jQuery('.main_cat_1').html();
                    var ab_val = parseFloat(parseFloat(a) / 62.4 / parseFloat(main_cat_1));
                    ab_val = ab_val.toFixed(2);
                    jQuery('.cost_portland_concrete').html(port_cost);
                    jQuery('.ab_portland_concrete').html(ab_val);
                    var weight = parseFloat((parseFloat(csa_val) * parseFloat(a))) / 100;
                    weight = weight.toFixed(2);
                    var fume_weight = parseFloat((parseFloat(fume) * parseFloat(a))) / 100;
                    fume_weight = fume_weight.toFixed(2);
                    var sand_cost = parseFloat(a) + parseFloat(weight) + parseFloat(fume_weight);
                    sand_cost = sand_cost.toFixed(2);
                    jQuery('input[name=sand]').val(sand_cost);
                    var sand_price = jQuery('.price_sand').html();
                    var sand_costt = parseFloat(sand_cost) * parseFloat(sand_price);
                    sand_costt = sand_costt.toFixed(2);
                    var main_cat_2 = jQuery('.main_cat_2').html();
                    var ab_val = parseFloat(parseFloat(sand_cost) / 62.4 / parseFloat(main_cat_2));
                    ab_val = ab_val.toFixed(2);
                    jQuery('.cost_sand').html(sand_costt);
                    jQuery('.ab_sand').html(ab_val);
                    var row_id = jQuery('.csa').attr('u');
                    jQuery('.input_' + row_id).val(weight);
                    cal_cost_special(weight, row_id);
                    
                    
                    calculate_water_weight();
                	
                
                    
                    
                    init();
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    });
    jQuery('.silica_fume').keyup(function() {
        jQuery('.silica_fume').attr('readonly', true);
        jQuery('.form').addClass('not_click_mn');
        var silica_fume = jQuery(this).val();
        if (silica_fume == "") {
            silica_fume = jQuery('.def_silica_fume').html();
            jQuery('.silica_fume').val(silica_fume);
        }
        jQuery('#j').val(silica_fume);
        var csa_val = jQuery('#i').val();
        var water = jQuery('input[name=water]').val();
        jQuery.ajax({
            type: "POST",
            url: "modules/job-handler.php",
            data: "csa=" + csa_val + "&water=" + water + "&fume=" + silica_fume + "&action=CalCsa",
            success: function(result) {
                jQuery('.silica_fume').removeAttr('readonly');
                jQuery('.form').removeClass('not_click_mn');
                if (result == 0) {
                    toastr.error("Check Input");
                } else {
                    result = jQuery.trim(result);
                    jQuery('#a').val(result);
                    var a = jQuery('#a').val();
                    jQuery('input[name=portland_concrete]').val(a);
                    jQuery('input[name=sand]').val(a);
                    var port_price = jQuery('.price_portland_concrete').html();
                    var port_cost = parseFloat(a) * parseFloat(port_price);
                    port_cost = port_cost.toFixed(2);
                    var main_cat_1 = jQuery('.main_cat_1').html();
                    var ab_val = parseFloat(parseFloat(a) / 62.4 / parseFloat(main_cat_1));
                    ab_val = ab_val.toFixed(2);
                    jQuery('.cost_portland_concrete').html(port_cost);
                    jQuery('.ab_portland_concrete').html(ab_val);
                    var weight = parseFloat((parseFloat(silica_fume) * parseFloat(a))) / 100;
                    weight = weight.toFixed(2);
                    var csa_weight = parseFloat((parseFloat(csa_val) * parseFloat(a))) / 100;
                    csa_weight = csa_weight.toFixed(2);
                    var sand_cost = parseFloat(a) + parseFloat(weight) + parseFloat(csa_weight);
                    sand_cost = sand_cost.toFixed(2);
                    jQuery('input[name=sand]').val(sand_cost);
                    var sand_price = jQuery('.price_sand').html();
                    var sand_costt = parseFloat(sand_cost) * parseFloat(sand_price);
                    sand_costt = sand_costt.toFixed(2);
                    var main_cat_2 = jQuery('.main_cat_2').html();
                    var ab_val = parseFloat(parseFloat(sand_cost) / 62.4 / parseFloat(main_cat_2));
                    ab_val = ab_val.toFixed(2);
                    jQuery('.cost_sand').html(sand_costt);
                    jQuery('.ab_sand').html(ab_val);
                    var row_id = jQuery('.silica_fume').attr('u');
                    jQuery('.input_' + row_id).val(weight);
                    cal_cost_special(weight, row_id);
                    
                  calculate_water_weight();
                	
                
                    
                    
                    init();
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    });
});

function cal_water() {
    var water = jQuery('input[name=water]').val();
    jQuery('input[name=water]').attr('readonly', true);
    jQuery('.form').addClass('not_click_mn');
    if (water == "") {
        water = jQuery('.def_water').html();
        jQuery('input[name=water]').val(water);
    }
    jQuery('#k').val(water);
    var csa = jQuery('#i').val();
    var fume = jQuery('#j').val();
    
	
	jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "water=" + water + "&csa=" + csa + "&fume=" + fume + "&action=CalWater",
        success: function(result) {
            jQuery('input[name=water]').removeAttr('readonly');
            jQuery('.form').removeClass('not_click_mn');
            if (result == 0) {
                toastr.error("Check Input");
            } else {
                result = jQuery.trim(result);
                jQuery('#a').val(result);
                var a = jQuery('#a').val();
                jQuery('input[name=portland_concrete]').val(a);
                var fume_per = jQuery('input[name=silica_fume_per]').val();
                var csa_per = jQuery('input[name=csa_per]').val();
                if (fume_per == "") {
                    fume_per = 0;
                }
                if (csa_per == "") {
                    csa_per = 0;
                }
                var port_price = jQuery('.price_portland_concrete').html();
                var port_cost = parseFloat(a) * parseFloat(port_price);
                port_cost = port_cost.toFixed(2);
                var main_cat_1 = jQuery('.main_cat_1').html();
                var ab_val = parseFloat(parseFloat(a) / 62.4 / parseFloat(main_cat_1));
                ab_val = ab_val.toFixed(2);
                jQuery('.cost_portland_concrete').html(port_cost);
                jQuery('.ab_portland_concrete').html(ab_val);
                var fume_weight = parseFloat(parseFloat(a) * parseFloat(fume_per)) / 100;
                var csa_weight = parseFloat(parseFloat(a) * parseFloat(csa_per)) / 100;
                fume_weight = fume_weight.toFixed(2);
                csa_weight = csa_weight.toFixed(2);
                jQuery('input[name=silica_fume_weight]').val(fume_weight);
                jQuery('input[name=csa_weight]').val(csa_weight);
                var sand_cost = parseFloat(a) + parseFloat(csa_weight) + parseFloat(fume_weight);
                sand_cost = sand_cost.toFixed(2);
                jQuery('input[name=sand]').val(sand_cost);
                var sand_cost = jQuery('input[name=sand]').val();
                var sand_price = jQuery('.price_sand').html();
                var sand_costt = parseFloat(sand_cost) * parseFloat(sand_price);
                sand_costt = sand_costt.toFixed(2);
                var main_cat_2 = jQuery('.main_cat_2').html();
                var ab_val = parseFloat(parseFloat(sand_cost) / 62.4 / parseFloat(main_cat_2));
                ab_val = ab_val.toFixed(2);
                jQuery('.cost_sand').html(sand_costt);
                jQuery('.ab_sand').html(ab_val);
                var row_id = jQuery('input[name=silica_fume_weight]').attr('u');
                jQuery('.input_' + row_id).val(fume_weight);
                cal_cost_special(fume_weight, row_id);
                var row_id = jQuery('input[name=csa_weight]').attr('u');
                jQuery('.input_' + row_id).val(csa_weight);
                cal_cost_special(csa_weight, row_id);
				
		        calculate_water_weight();
		    	
		    	
		    	
                init();
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function init() {
    var tot_weight = 0;
    var tot_cost = 0;
    var tot_sg = 0;
    bedroom = "";
    jQuery.each(jQuery('.weight_txt'), function() {
        var weight = jQuery(this).val();;
        if (weight == "") {
            weight = 0;
        }
        tot_weight = parseFloat(tot_weight) + parseFloat(weight);
        weight = jQuery.trim(weight);
        bedroom += (bedroom ? ',' : '') + weight;
    });
    bedroom_1 = "";
    jQuery.each(jQuery('.total_cost'), function() {
        var cost = jQuery(this).html();
        if (cost == "") {
            cost = 0;
        }
        tot_cost = parseFloat(tot_cost) + parseFloat(cost);
        cost = jQuery.trim(cost);
        bedroom_1 += (bedroom_1 ? ',' : '') + cost;
    });
    bedroom_2 = "";
    jQuery.each(jQuery('.tot_sg_cal'), function() {
        var sg_cal = jQuery(this).html();
        if (sg_cal == "") {
            sg_cal = 0;
        }
        tot_sg = parseFloat(tot_sg) + parseFloat(sg_cal);
        sg_cal = jQuery.trim(sg_cal);
        bedroom_2 += (bedroom_2 ? ',' : '') + sg_cal;
    });
    jQuery('#new_tot_weight').val(bedroom);
    jQuery('#new_tot_cost').val(bedroom_1);
    jQuery('#new_tot_ab_val').val(bedroom_2);
    tot_weight = tot_weight.toFixed(2);
    tot_cost = tot_cost.toFixed(2);
    tot_sg = tot_sg.toFixed(2);
    jQuery('.weight_span').html(tot_weight);
    jQuery('.cost_span').html(tot_cost);
    jQuery('#new_total_weight').val(tot_weight);
    jQuery('#new_total_cost').val(tot_cost);
    jQuery('#new_total_ab_val').val(tot_sg);
}

function cal_port_con_value() {
    var a = jQuery('input[name=portland_concrete]').val();
    var port_price = jQuery('.price_portland_concrete').html();
    var port_cost = parseFloat(a) * parseFloat(port_price);
    port_cost = port_cost.toFixed(2);
    var main_cat_1 = jQuery('.main_cat_1').html();
    var ab_val = parseFloat(a) * parseFloat(main_cat_1);
    ab_val = ab_val.toFixed(2);
    jQuery('.cost_portland_concrete').html(port_cost);
    jQuery('.ab_portland_concrete').html(ab_val);
}

function cal_sand_value() {
    var a = jQuery('input[name=sand]').val();
    var sand_price = jQuery('.price_sand').html();
    var sand_cost = parseFloat(a) * parseFloat(sand_price);
    sand_cost = sand_cost.toFixed(2);
    var main_cat_2 = jQuery('.main_cat_2').html();
    var ab_val = parseFloat(a) * parseFloat(main_cat_2);
    ab_val = ab_val.toFixed(2);
    jQuery('.cost_sand').html(sand_cost);
    jQuery('.ab_sand').html(ab_val);
}

function show_job_form() {
    jQuery('#fromToggle').slideUp();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('#fromToggle').slideDown();
    jQuery('#fromToggle').empty().append(loader);
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "action=ShowJobForm",
        success: function(result) {
            jQuery('#fromToggle').empty().append(result);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function edit_job_form(job_id) {
    jQuery('#fromToggle').slideUp();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('#fromToggle').slideDown();
    jQuery('#fromToggle').empty().append(loader);
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "job_id=" + job_id + "&action=EditJobForm",
        success: function(result) {
            jQuery('#fromToggle').empty().append(result);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function add_material_form(job_id) {
    jQuery('#fromToggle').slideUp();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('#fromToggle').slideDown();
    jQuery('#fromToggle').empty().append(loader);
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "job_id=" + job_id + "&action=ShowMaterialForm",
        success: function(result) {
            jQuery('#fromToggle').empty().append(result);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function get_customer() {
    var loader = '<li><div class="list-load"><img src="assets/images/loader-11.gif"/></div><li>';
    jQuery('.filter').show();
    jQuery('.filter').empty().append(loader);
    var cust = jQuery('input[name=cust_name]').val();
    if (cust != '') {
        jQuery.ajax({
            type: "POST",
            url: "modules/job-handler.php",
            data: "cust=" + cust + "&action=getCustomer",
            success: function(result) {
                jQuery('.filter').empty().append(result);
            },
            error: function(e) {
                console.log(e);
            }
        });
    } else {
        jQuery('.filter').hide();
    }
}

function set_name(id, name) {
    jQuery('#cust_id').empty().val(id);
    jQuery('input[name=cust_name]').val(name);
    jQuery('.filter').empty().hide();
}

function show_job_pic(e) {
    if (jQuery('.show_job_photo').hasClass('open')) {
        jQuery('.show_job_photo').empty().append('Show Job Photos');
        jQuery('.show_job_photo').removeClass('open');
        jQuery('.show_job_photo').attr('onclick', 'show_job_pic(1);');
    } else {
        jQuery('.show_job_photo').empty().append('Hide Job Photos');
        jQuery('.show_job_photo').addClass('open');
        jQuery('.show_job_photo').attr('onclick', 'show_job_pic(0);');
    }
    if (e == 1) {
        jQuery('.job_images').show();
    } else {
        jQuery('.job_images').hide();
    }
}

function show_job_mat(e) {
    if (jQuery('.mat_sec').hasClass('open')) {
        jQuery('.mat_sec').empty().append('Show Materials');
        jQuery('.mat_sec').removeClass('open');
        jQuery('.mat_sec').attr('onclick', 'show_job_mat(1);');
    } else {
        jQuery('.mat_sec').empty().append('Hide Materials');
        jQuery('.mat_sec').addClass('open');
        jQuery('.mat_sec').attr('onclick', 'show_job_mat(0);');
    }
    if (e == 1) {
        jQuery('.material_list').show();
    } else {
        jQuery('.material_list').hide();
    }
}

function show_material_piece(e) {
    jQuery('.table_piece').hide();
    var value = jQuery(e).val();
    var label = jQuery(e).next('label').html();
    jQuery('.piece_name').empty().append(label);
    jQuery('.table_piece').show();
}

function cal_cost(row_id) {
    jQuery('.form').addClass('not_click_mn');
    var weight = jQuery('.input_' + row_id).val();
    var a = jQuery('#a').val();
    if (weight != "") {
        var price = jQuery('.def_input_' + row_id).html();
        var total_cost = parseFloat(weight) * parseFloat(price);
        total_cost = total_cost.toFixed(2);
        jQuery('.cost_' + row_id).html(total_cost);
        var main_cat = jQuery('.input_' + row_id).attr('u');
        var sg = jQuery('.main_cat_' + main_cat).html();
        if (sg != 0) {
            var cal_sg = parseFloat(parseFloat(weight) / 62.4 / parseFloat(sg));
            cal_sg = cal_sg.toFixed(2);
            jQuery('.sg_cal_' + row_id).html(cal_sg);
        } else {
            jQuery('.sg_cal_' + row_id).html('0');
        }
        init();
    } else {
        jQuery('.input_' + row_id).val('');
        jQuery('.cost_' + row_id).html('0');
        jQuery('.sg_cal_' + row_id).html('0');
        init();
    }
    jQuery('.form').removeClass('not_click_mn');
}

function cal_cost_special(weight, row_id) {
    var weight = weight;
    var a = jQuery('#a').val();
    if (weight != "") {
        var price = jQuery('.def_input_' + row_id).html();
        var total_cost = parseFloat(weight) * parseFloat(price);
        total_cost = total_cost.toFixed(2);
        jQuery('.cost_' + row_id).html(total_cost);
        var main_cat = jQuery('.input_' + row_id).attr('u');
        var sg = jQuery('.main_cat_' + main_cat).html();
        if (sg != 0) {
            var cal_sg = parseFloat(parseFloat(weight) / 62.4 / parseFloat(sg));
            cal_sg = cal_sg.toFixed(2);
            jQuery('.sg_cal_' + row_id).html(cal_sg);
        } else {
            jQuery('.sg_cal_' + row_id).html('0');
        }
        init();
    } else {
        jQuery('.input_' + row_id).val('');
        jQuery('.cost_' + row_id).html('0');
        jQuery('.sg_cal_' + row_id).html('0');
        init();
    }
}

function cal_sq_ft() {
    var thick = jQuery('input[name=thick]').val();
    var height = jQuery('input[name=height]').val();
    var width = jQuery('input[name=width]').val();
    if (thick == "" || height == "" || width == "") {
        alert('Fill Required Fields');
        return false;
    }
    var value = parseFloat((parseFloat(thick) * parseFloat(height) * parseFloat(width)) / 1728);
    var value = value.toFixed(2);
    var per = (parseFloat(value) * 0.05);
    var act_vale = parseFloat(value) + parseFloat(per);
    var act_vale = act_vale.toFixed(2);
    jQuery('input[name=cubic_sq_ft]').val(value);
    jQuery('input[name=cubic_sq_ft_int]').val(act_vale);
}

function cal_cubic_fig() {
    var thick = jQuery('input[name=thick]').val();
    var height = jQuery('input[name=height]').val();
    var width = jQuery('input[name=width]').val();
    if (height != "" && width != "" && thick != "") {
        var thick = jQuery('input[name=thick]').val();
        var height = jQuery('input[name=height]').val();
        var width = jQuery('input[name=width]').val();
        var value = parseFloat((parseFloat(thick) * parseFloat(height) * parseFloat(width)) / 1728);
        value = value.toFixed(3);
        var per = parseFloat((parseFloat(value) * 5) / 100);
        var act_vale = parseFloat(value) + parseFloat(per);
        act_vale = act_vale.toFixed(3);
        jQuery('input[name=cubic_sq_ft]').val(value);
        jQuery('input[name=cubic_sq_ft_int]').val(act_vale);
    } else {
        jQuery('input[name=cubic_sq_ft]').val('');
        jQuery('input[name=cubic_sq_ft_int]').val('');
    }
}

function add_component(job_id, piece_id, comp_id) {
    jQuery('#fromToggle').slideUp();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('#fromToggle').slideDown();
    jQuery('#fromToggle').empty().append(loader);
    jQuery('html, body').animate({
        scrollTop: jQuery('.main').offset().top
    }, 500);
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "job_id=" + job_id + "&piece_id=" + piece_id + "&comp_id=" + comp_id + "&action=AddComponentShow",
        success: function(result) {
            jQuery('#fromToggle').empty().append(result);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function edit_component(job_id, piece_id, comp_id) {
    jQuery('#fromToggle').slideUp();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('#fromToggle').slideDown();
    jQuery('#fromToggle').empty().append(loader);
    jQuery('html, body').animate({
        scrollTop: jQuery('.main').offset().top
    }, 500);
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "job_id=" + job_id + "&piece_id=" + piece_id + "&comp_id=" + comp_id + "&action=EditComponentShow",
        success: function(result) {
            jQuery('#fromToggle').empty().append(result);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function view_component(job_id, piece_id, comp_id) {
    jQuery('#fromToggle').slideUp();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('#fromToggle').slideDown();
    jQuery('#fromToggle').empty().append(loader);
    jQuery('html, body').animate({
        scrollTop: jQuery('.main').offset().top
    }, 500);
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "job_id=" + job_id + "&piece_id=" + piece_id + "&comp_id=" + comp_id + "&action=ViewComponentShow",
        success: function(result) {
            jQuery('#fromToggle').empty().append(result);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function edit_piecee(peice_id) {
    jQuery('#fromToggle').slideUp();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('#fromToggle').slideDown();
    jQuery('#fromToggle').empty().append(loader);
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "peice_id=" + peice_id + "&action=EditPieceShow",
        success: function(result) {
            jQuery('#fromToggle').empty().append(result);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function readURL(input, q) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            jQuery('.' + q).find("img").hide();
            jQuery('.' + q).css('background-image', "url('" + e.target.result + "')");
            jQuery('.' + q).css('background-position', 'center');
            jQuery('.' + q).css('background-repeat', 'no-repeat');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function delete_comp(comp_id) {
    if (confirm('Are you sure?')) {
        jQuery('#fromToggle').slideUp();
        var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
        jQuery('#fromToggle').slideDown();
        jQuery('#fromToggle').empty().append(loader);
        jQuery.ajax({
            type: "POST",
            url: "modules/job-handler.php",
            data: "comp_id=" + comp_id + "&action=DeleteComponent",
            success: function(result) {
                if (result == 1) {
                    toastr.success("Component has been deleted");
                    location.reload();
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

function del_piece(piece_id) {
    if (confirm('Are you sure?')) {
        var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
        jQuery('.piece_' + piece_id).empty().append(loader);
        jQuery.ajax({
            type: "POST",
            url: "modules/job-handler.php",
            data: "piece_id=" + piece_id + "&action=DeletePiece",
            success: function(result) {
                if (result == 1) {
                    jQuery('.piece_' + piece_id).remove();
                    toastr.success("Piece and related information has been deleted");
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

function ajax_mat_assign(e) {
    var job_id = jQuery('#job_id').val();
    var port = jQuery('input[name=portland_concrete]:checked').val();
    var sand = jQuery('input[name=sand]:checked').val();
    var pigments = jQuery('input[name=pigments]:checked').val();
    var sealer = jQuery('input[name=sealer]:checked').val();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('.material_list').addClass('not_click_mn');
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "job_id=" + job_id + "&port=" + port + "&sand=" + sand + "&pigments=" + pigments + "&sealer=" + sealer + "&action=AssignMaterial",
        success: function(result) {
            if (result == 1) {
                jQuery('.material_list').removeClass('not_click_mn');
                toastr.success("Changes in material have been saved");
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function lock_unlock(peice_id, status) {
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "peice_id=" + peice_id + "&status=" + status + "&action=LockUnlockPiece",
        success: function(result) {
            toastr.success("Changes have been saved");
            location.reload();
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function default_set() {
    var port_weight = jQuery('.def_portland_concrete').html();
    var port_price = jQuery('.price_portland_concrete').html();
    jQuery('input[name=portland_concrete]').val(port_weight);
    var port_cost = parseFloat(port_weight) * parseFloat(port_price);
    port_cost = port_cost.toFixed(2);
    var main_cat_1 = jQuery('.main_cat_1').html();
    var ab_val = parseFloat(parseFloat(port_weight) / 62.4 / parseFloat(main_cat_1));
    ab_val = ab_val.toFixed(2);
    jQuery('.cost_portland_concrete').html(port_cost);
    jQuery('.ab_portland_concrete').html(ab_val);
    var sand_weight = jQuery('.def_sand').html();
    var sand_price = jQuery('.price_sand').html();
    jQuery('input[name=sand]').val(sand_weight);
    var sand_costt = parseFloat(sand_weight) * parseFloat(sand_price);
    sand_costt = sand_costt.toFixed(2);
    var main_cat_2 = jQuery('.main_cat_2').html();
    var ab_val = parseFloat(parseFloat(sand_weight) / 62.4 / parseFloat(main_cat_2));
    ab_val = ab_val.toFixed(2);
    jQuery('.cost_sand').html(sand_costt);
    jQuery('.ab_sand').html(ab_val);
    jQuery('#a').val(port_weight);
    var a = jQuery('#a').val();
    var def_fume = jQuery('.def_silica_fume').html();
    var weight = parseFloat((parseFloat(def_fume) * parseFloat(a))) / 100;
    weight = weight.toFixed(2);
    jQuery('input[name=silica_fume_per]').val(def_fume);
    var row_id = jQuery('.silica_fume').attr('u');
    jQuery('.input_' + row_id).val(weight);
    cal_cost_special(weight, row_id);
    var def_csa = jQuery('.def_csa').html();
    var weight = parseFloat((parseFloat(def_csa) * parseFloat(a))) / 100;
    jQuery('input[name=csa_per]').val(def_csa);
    var row_id = jQuery('.csa').attr('u');
    weight = weight.toFixed(2);
    jQuery('.input_' + row_id).val(weight);
    cal_cost_special(weight, row_id);
    var def_water = jQuery('.def_water').html();
    jQuery('#i').val(def_csa);
    jQuery('#j').val(def_fume);
    jQuery('#k').val(def_water);
    jQuery('input[name=water]').val(def_water);
}

function cal_a(row_id) {
    var a = jQuery('.input_' + row_id).val();
    if (a == "") {
        a = jQuery('.def_portland_concrete').html();
        jQuery('.input_' + row_id).val(a);
    }
    jQuery('#a').val(a);
    var fume_per = jQuery('input[name=silica_fume_per]').val();
    var csa_per = jQuery('input[name=csa_per]').val();
    if (fume_per == "") {
        fume_per = 0;
    }
    if (csa_per == "") {
        csa_per = 0;
    }
    var port_price = jQuery('.price_portland_concrete').html();
    var port_cost = parseFloat(a) * parseFloat(port_price);
    port_cost = port_cost.toFixed(2);
    var main_cat_1 = jQuery('.main_cat_1').html();
    var ab_val = parseFloat(parseFloat(a) / 62.4 / parseFloat(main_cat_1));
    ab_val = ab_val.toFixed(2);
    jQuery('.cost_portland_concrete').html(port_cost);
    jQuery('.ab_portland_concrete').html(ab_val);
    var fume_weight = parseFloat(parseFloat(a) * parseFloat(fume_per)) / 100;
    var csa_weight = parseFloat(parseFloat(a) * parseFloat(csa_per)) / 100;
    fume_weight = fume_weight.toFixed(2);
    csa_weight = csa_weight.toFixed(2);
    jQuery('input[name=silica_fume_weight]').val(fume_weight);
    jQuery('input[name=csa_weight]').val(csa_weight);
    var sand_cost = parseFloat(a) + parseFloat(csa_weight) + parseFloat(fume_weight);
    sand_cost = sand_cost.toFixed(2);
    jQuery('input[name=sand]').val(sand_cost);
    var sand_cost = jQuery('input[name=sand]').val();
    var sand_price = jQuery('.price_sand').html();
    var sand_costt = parseFloat(sand_cost) * parseFloat(sand_price);
    sand_costt = sand_costt.toFixed(2);
    var main_cat_2 = jQuery('.main_cat_2').html();
    var ab_val = parseFloat(parseFloat(sand_cost) / 62.4 / parseFloat(main_cat_2));
    ab_val = ab_val.toFixed(2);
    jQuery('.cost_sand').html(sand_costt);
    jQuery('.ab_sand').html(ab_val);
    var row_id = jQuery('input[name=silica_fume_weight]').attr('u');
    jQuery('.input_' + row_id).val(fume_weight);
    cal_cost_special(fume_weight, row_id);
    var row_id = jQuery('input[name=csa_weight]').attr('u');
    jQuery('.input_' + row_id).val(csa_weight);
    cal_cost_special(csa_weight, row_id);
    init();
}

function cal_weight_cat(row_id, cat_name) {
    var a = jQuery('#a').val();
    var value = jQuery('input[name=' + cat_name + '_per]').val();
    var weight = parseFloat((parseFloat(a) * parseFloat(value)) / 100);
    weight = weight.toFixed(2);
    jQuery('.input_' + row_id).val(weight);
    cal_cost_special(weight, row_id);
    init();
}

function close_job_form(job_id, user_id) {
    jQuery('#fromToggle').slideUp();
    var loader = '<img src="assets/images/loader-11.gif" class="loader-ani" />';
    jQuery('#fromToggle').slideDown();
    jQuery('#fromToggle').empty().append(loader);
    jQuery.ajax({
        type: "POST",
        url: "modules/job-handler.php",
        data: "job_id=" + job_id + "&user_id=" + user_id + "&action=ShowCloseForm",
        success: function(result) {
            jQuery('#fromToggle').empty().append(result);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function calculate_water_weight()
{
   	var water=jQuery('input[name=water]').val();
	var csa_weight=jQuery('input[name=csa_weight]').val();
	var silica_fume_weight=jQuery('input[name=silica_fume_weight]').val();
	var portland_concrete=jQuery('input[name=portland_concrete]').val();
	
	if(csa_weight=="")
	{
		csa_weight=0;
	}
	
	if(silica_fume_weight=="")
	{
		silica_fume_weight=0;
	}
	
	if(portland_concrete=="")
	{
		portland_concrete=0;
	}
	
	var tot_water=parseFloat(portland_concrete)+parseFloat(silica_fume_weight)+parseFloat(csa_weight);
	var water_weight=parseFloat(parseFloat(water)*parseFloat(tot_water)/100);
	water_weight = water_weight.toFixed(2);  
	jQuery('input[name=water_weight]').val(water_weight);	
}
