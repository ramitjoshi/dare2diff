					<?php $pc_comp_id=$pc_cmp_id; ?>
					<?php
					$material=get_cust_job_detail($job_id,'material');
					$mat=json_decode($material);

					$pigments_id=$mat->pigments;
					$water=get_material_info($pigments_id,'water');
					$i=0;
					$j=0;
					 

					$path=SITE_URL .'math/example.php?water='.$water.'&csa='.$i.'&fume='.$j;  
					 
					$url = $path;
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_TIMEOUT, 5);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$data = curl_exec($ch);
					curl_close($ch);
					$homepage=$data; 
					$homepage = number_format($homepage, 2, '.', '');
					?>
					
					<div class="close_mn display_block new_piece">		
					<div class="new_custmer">
					
					<a class="close_new" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>
					<h4 class="close_title">ADD COMPONENT</h4>
					</div> 		
					<div class="inner_content"> 
					<input type="hidden" id="a" value="<?php echo $homepage; ?>" />
					<input type="hidden" id="i" value="<?php echo $i; ?>" />
					<input type="hidden" id="j" value="<?php echo $j; ?>" />
					<input type="hidden" id="k" value="<?php echo $water; ?>" />
					<div class="form">
						<form name="add_peice_comp" id="add_peice_comp" action="" method="post">	
						<input name="action" value="AddPieceComp" type="hidden">	  
						<input name="job_id" value="<?php echo $job_id; ?>" type="hidden">	
						<input name="piece_id" value="<?php echo $piece_id; ?>" type="hidden">	
						<input name="comp_id" value="<?php echo $comp_id; ?>" type="hidden">	
						
                        <div class="free_piece_radio">  
                            <div class="inner_pdng">
                                
								<div class="title_radio">  
                                    <h5>Piece Name</h5>
									<p><?php echo get_peice_info($piece_id,'piece_name'); ?> </p>
                                </div> 
								<div class="title_radio"> 
                                    <h5>Recipe Components</h5>
									<p><?php echo get_recipe_components_info($comp_id,'name');  ?></p>
                                </div> 
                                
                            </div>
                        </div>
						<?php
						$material=get_cust_job_detail($job_id,'material'); 
						$materialArray=json_decode($material);
						$port=$materialArray->portland_concrete;
						$sand=$materialArray->sand;
						$pigments=$materialArray->pigments;
						$sealer=$materialArray->sealer;
						
						$thick=get_job_peice_dimension($job_id,$piece_id,'thick');
						$length=get_job_peice_dimension($job_id,$piece_id,'length');
						$width=get_job_peice_dimension($job_id,$piece_id,'width');
						$cubic_sq=get_job_peice_dimension($job_id,$piece_id,'cubic_sq');
						$cubic_sq_int=get_job_peice_dimension($job_id,$piece_id,'cubic_sq_int');
						if($thick=="")
						{
							$thick=0.75; 
						} 
						?>
                        <div class="table_piece inline_width">
                            <table>
                                <thead>
                                
									<tr>
                                        
                                        <th style="width: 25%;">Thickness</th>
                                        <th style="width: 29%;"><input type="text" value="0.75" name="thick" onkeyup="cal_cubic_fig();" value="<?php echo $thick; ?>"></th> 
										<th style="width: 20%;"><span class="piece_name" style="display:none;">Self-Consolidating Face Coat</span></th> 
										<th>&nbsp;</th>
										
										   
                                    </tr>
									<tr>
                                        
                                        <th style="width: 25%;">Length</th>
                                        <th style="width:29%;"><input type="text" name="height" onkeyup="cal_cubic_fig();" value="<?php echo $length; ?>" ></th> 
										<th style="width: 20%;">&nbsp;</th> 
										<th>&nbsp;</th>
                                    </tr>
									<tr>
                                       
                                        <th style="width: 25%;">Width</th>
                                        <th style="width: 29%;"><input type="text" name="width" onkeyup="cal_cubic_fig();" value="<?php echo $width; ?>"></th>  
										 <th style="width:20%;">&nbsp;</th> 
										 <th>&nbsp;</th>
                                    </tr>
									<tr>
                                       
                                        <th style="width: 25%;">Cubic Sq Ft</th>
                                        <th style="width: 29%;"><input type="text"  name="cubic_sq_ft" value="<?php echo $cubic_sq; ?>" readonly></th>
										 <th style="width: 20%;">&nbsp;</th> 
										 <th>&nbsp;</th>
                                    </tr>
									<tr>
                                       
                                        <th style="width: 25%;">Cubic Sq Ft + 5%</th>
                                        <th style="width: 29%;"><input type="text" name="cubic_sq_ft_int" value="<?php echo $cubic_sq_int; ?>" readonly ></th>
										 <th style="width: 20%;">&nbsp;</th>
										 <th>&nbsp;</th>
								  
                                    </tr> 

                                </thead>
                                <tbody>
                                    
									<tr>
                                        <td><b>Portland Concrete</b></td>
                                        <td>
                                            <div class="weight_value">
                                                &nbsp;
                                            </div>
                                            <div class="weight_text">
                                                Weight
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input_cost">
                                                Cost
                                            </div>
                                        </td>
										<td>
                                            <div class="input_cost">
                                               Abs Vol
                                            </div>
                                        </td>
                                    </tr>
									<?php
									$sg=get_material_cat_info(1,'sg');
									if($sg=="")
									{
										$sg=0;
									}
									$sql_1="select * from material where category='1'";
									$statement = $db->prepare($sql_1);  	   
									$statement->execute();   
									$result_1=$statement->fetchAll();   
									foreach($result_1 as $row_1)
									{
										
										if($port==$row_1['id'])
										{		
										?>
										<tr class="inner-tab">
											<td><span class="pdng_span"><?php echo $row_1['descp']; ?></span></td>
											<td>
												<div class="weight_value">
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" u="1" name="portland_concrete" onkeyup="cal_a(<?php echo $row_1['id']; ?>);">  
													<span class="cost_txt price_<?php echo $row_1['id']; ?> price_portland_concrete" style="display:none;"><?php echo $row_1['price']; ?></span>  
													<span class="def_portland_concrete" style="display:none;"><?php echo $homepage; ?></span>  
													<span class="def_input_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo $homepage; ?></span>  
												</div>  
												<div class="weight_text">
												   <?php echo $row_1['weight']; ?>
												</div> 
											</td> 
											<td>
												<div class="input_cost">
													<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?> cost_portland_concrete">0.00</span>
													<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
												</div>
											</td>
											<td>
												<div class="input_cost">
													<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal ab_portland_concrete">0</span>
													<span class="main_cat_1" style="display:none;"><?php echo $sg; ?></span>
												</div>   
											</td>
										</tr>
										<?php
										}
									}
									?>
									<tr>
                                        <td><b>Sand</b></td>
                                        <td>
                                            <div class="weight_value">
                                                &nbsp;
                                            </div>
                                            <div class="weight_text">
                                                 &nbsp;
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input_cost">
                                                 &nbsp;
                                            </div>
                                        </td>
										<td>
                                            <div class="input_cost">
                                               &nbsp;
                                            </div>
                                        </td>
                                    </tr>
									<?php
									$sg=get_material_cat_info(2,'sg');
									if($sg=="")
									{
										$sg=0;
									}
									$sql_1="select * from material where category='2'";
									$statement = $db->prepare($sql_1);  	   
									$statement->execute();   
									$result_1=$statement->fetchAll();   
									foreach($result_1 as $row_1)
									{
										if($sand==$row_1['id'])
										{		 
										?>
										<tr class="inner-tab"> 
											<td><span class="pdng_span"><?php echo $row_1['descp']; ?></span></td>
											<td>
												<div class="weight_value">
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" u="2" name="sand" readonly>  
													<span class="cost_txt price_<?php echo $row_1['id']; ?> price_sand " style="display:none;"><?php echo $row_1['price']; ?></span>  
													<span class="def_sand" style="display:none;"><?php echo $homepage; ?></span>  
													<span class="def_input_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo $homepage; ?></span>  
												</div>   
												<div class="weight_text">
												   <?php echo $row_1['weight']; ?>
												</div>  
											</td> 
											<td>
												<div class="input_cost">
													<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?> cost_sand">0.00</span>
													<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
												</div>
											</td>
											<td>
												<div class="input_cost">
													<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal ab_sand">0</span>
													<span class="main_cat_2" style="display:none;"><?php echo $sg; ?></span>
												</div>  
											</td>
										</tr>
										<?php
										}
									}
									?>
									<tr>
										
                                        <td><b>Pigments</b><span style="float:right;">Water</span></td>
                                        <td>
                                            <div class="weight_value asd_value weight_pigments" tabindex="2">
												<input type="text" value="<?php echo $water; ?>" name="water" onkeyup="cal_water();">
												<span class="def_water" style="display:none;"><?php echo $water; ?></span>
											</div>
											<div class="weight_text">
                                               % <img src="<?php echo SITE_URL; ?>assets/images/loader-11.gif" id="water_loader" style="display:none;">
                                            </div>
										</td> 
                                        <td>
                                            <div class="input_cost">
                                                 &nbsp;
                                            </div>
                                        </td>
										<td>
                                            <div class="input_cost">
                                               &nbsp;
                                            </div>
                                        </td>
										
                                    </tr>
									<?php
									$sg=get_material_cat_info(3,'sg'); 
									
									if($sg=="")
									{
										$sg=0;
									}
									$sql_1="select * from material where category='3'";
									$statement = $db->prepare($sql_1);  	   
									$statement->execute();   
									$result_1=$statement->fetchAll();   
									foreach($result_1 as $row_1)
									{
										if($pigments==$row_1['id'])
										{		 
										?>
										<tr class="inner-tab"> 
											<td><span class="pdng_span"><?php echo $row_1['descp']; ?></span></td>
											<td>
												<div class="weight_value">
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" onkeyup="cal_cost('<?php echo $row_1['id']; ?>');" u="3" name="pigments">
													<span class="cost_txt price_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo $row_1['price']; ?></span>
													<span class="def_pigments" style="display:none;"><?php echo $row_1['price']; ?></span>	
													<span class="def_input_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo $row_1['price']; ?></span> 		
												</div> 
												<div class="weight_text">
												   <?php echo $row_1['weight']; ?>
												</div> 
											</td> 
											<td>
												<div class="input_cost">
													<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?>">0.00</span>
													<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
												</div>
											</td>
											<td>
											<div class="input_cost">
												<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal">0</span>
												<span class="main_cat_3" style="display:none;"><?php echo $sg; ?></span>
											</div>  
											</td>
										</tr>
										<?php
										}
									}
									?>
									<tr>
                                        <td><b>Sealer</b></td>
                                        <td>
                                            <div class="weight_value">
                                                &nbsp;
                                            </div>
                                            <div class="weight_text">
                                                 &nbsp;
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input_cost">
                                                 &nbsp;
                                            </div>
                                        </td>
										<td>
                                            <div class="input_cost">
                                               &nbsp;
                                            </div>
                                        </td>
                                    </tr>
									<?php
									$sg=get_material_cat_info(4,'sg'); 
									if($sg=="")
									{
										$sg=0;
									}
									$sql_1="select * from material where category='4'";
									$statement = $db->prepare($sql_1);   	   
									$statement->execute();   
									$result_1=$statement->fetchAll();   
									foreach($result_1 as $row_1)
									{
										if($sealer==$row_1['id'])
										{		 
										?>
										<tr class="inner-tab"> 
											<td><span class="pdng_span"><?php echo $row_1['descp']; ?></span></td>
											<td>
												<div class="weight_value">
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" onkeyup="cal_cost('<?php echo $row_1['id']; ?>');" u="4" name="sealer"> 
													<span class="cost_txt price_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo $row_1['price']; ?></span> 
													<span class="def_sealer" style="display:none;"><?php echo $row_1['price']; ?></span>
													<span class="def_input_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo $row_1['price']; ?></span>  		
												</div>    
												<div class="weight_text">
												   <?php echo $row_1['weight']; ?>
												</div> 
											</td> 
											<td>
												<div class="input_cost">
													<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?>">0.00</span>
													<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
												</div>
											</td>
											<td> 
												<div class="input_cost">
													<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal">0</span>
													<span class="main_cat_4" style="display:none;"><?php echo $sg; ?></span>
												</div>   
											</td>
										</tr>
										<?php
										}
									}
									?>
									<?php
									$arr=array(119,121);
									$sql="select * from material_category where status='1'";
									$statement = $db->prepare($sql);  	   
									$statement->execute();  
									$result=$statement->fetchAll(); 
									$i=101;
									foreach($result as $row)
									{   
										$sg=$row['sg'];
										if($sg=="")
										{
											$sg=0;
										}	
										$cat_name=$row['name'];
										$class_name=str_replace(' ','_',$cat_name);
										$class_name=strtolower($class_name); 
										
										$price=$row['price'];
										
									?>
									<tr> 
                                        <td><b><?php echo $row['name']; ?></b></td>
                                        <td>
                                           <div class="weight_value asd_value " tabindex="<?php echo $i; ?>">
												<?php
												if (in_array($row['id'], $arr)) { 
												?>
													<input class="input_<?php echo $row['id']; ?> weight_txt" name="<?php echo $class_name; ?>_weight" type="text" u="<?php echo $row['id']; ?>" readonly>  
													<span class="side_value">lb</span>	
												<?php 
												} 
												else
												{	
												?>
													<input class="input_<?php echo $row['id']; ?> weight_txt <?php echo $class_name; ?>" name="tot_weight[]" type="text" onkeyup="cal_cost('<?php echo $row['id']; ?>');" u="<?php echo $row['id']; ?>"> 
												<?php
												}
												?>
												<span class="price_<?php echo $row['id']; ?>" style="display:none;"><?php echo $row['price']; ?></span> 
												<span class="def_price_<?php echo $row['id']; ?>" style="display:none;"><?php echo $price; ?></span> 
												<span class="def_input_<?php echo $row['id']; ?>" style="display:none;"><?php echo $price; ?></span> 
												<span class="def_<?php echo $class_name; ?>" style="display:none;">0</span>
											</div>   
											<div class="weight_text">
											<?php
												if (in_array($row['id'], $arr)) { 
												?>
													<input class="<?php echo $class_name; ?>" type="text" u="<?php echo $row['id']; ?>" name="<?php echo $class_name; ?>_per"> 
													<span class="side_value">%</span>	
												<?php   
												}  
												?>
										</div>		
										</td>
                                        <td>
                                            <div class="input_cost"> 
												<span class="dollar">$</span><span class="total_cost cost_<?php echo $row['id']; ?>">0</span>
												<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row['id']; ?>" value="0" style="display:none;"> 
											</div> 
                                        </td>
										<td>
										<div class="input_cost">
										<span class="sg_cal_<?php echo $row['id']; ?> tot_sg_cal">0</span>
										<span class="main_cat_<?php echo $row['id']; ?>" style="display:none;"><?php echo $sg; ?></span> 
										</div> 
										</td>
									</tr>
									<?php 
									$i++; 
									}
									?> 

                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td> 
                                            <div class="weight_value">
                                                &nbsp; 
                                            </div>
                                            <div class="weight_text"> 
                                                &nbsp;
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input_cost">
                                                &nbsp;
                                            </div> 
                                        </td>

                                    </tr> 

                                    <tr>
										
                                        <td colspan="4" align="center">
                                            <button class="custom orange" type="submit" name="submit"><i class="fa fa-plus" aria-hidden="true"></i> Add Component</button>
											<img src="<?php echo SITE_URL; ?>assets/images/loader-11.gif" id="cust_job_loader" style="display:none;">
											<input type="hidden" id="total_weight" name="total_weight_1" value="0">
											<input type="hidden" id="total_cost_1" name="total_cost_1" value="0"> 
											
											<input type="hidden" id="new_tot_weight" name="new_tot_weight" value="0"> 
											<input type="hidden" id="new_tot_cost" name="new_tot_cost" value="0"> 
											<input type="hidden" id="new_tot_ab_val" name="new_tot_ab_val" value="0"> 
											
											<input type="hidden" id="new_total_weight" name="new_total_weight" value="0"> 
											<input type="hidden" id="new_total_cost" name="new_total_cost" value="0"> 
											<input type="hidden" id="new_total_ab_val" name="new_total_ab_val" value="0"> 
										</td>  

                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table>
												<tbody>
                                                    <tr>
                                                        <td style="text-align: right; width: 50%;color:#2d2d2d;">
                                                             <strong>Total Weight </strong><span class="weight_span">0</span>
                                                        </td>
                                                        <td style="width: 50%;color:#2d2d2d;">
                                                           <strong>Cost </strong> $<span class="cost_span">0</span>
                                                        </td>  
                                                    </tr>

                                                </tbody>

                                            </table>

                                        </td>

                                    </tr>


                                </tbody>

                            </table>
                        </div>
						</form>
						
                    </div>       
					</div>         
					</div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>	
<script>
jQuery(document).ready(function()
{
	var a=jQuery('#a').val();
	jQuery('input[name=portland_concrete]').val(a);
	jQuery('input[name=sand]').val(a);
	
	jQuery('.def_portland_concrete').html(a);
	jQuery('.def_sand').html(a); 
	
	jQuery('.def_portland_concrete').next('span').html(a);
	jQuery('.def_sand').next('span').html(a); 
	
	
	
	
	var port_price=jQuery('.price_portland_concrete').html();
	var port_cost=parseFloat(a) * parseFloat(port_price);
	port_cost=port_cost.toFixed(2);
	
	var main_cat_1=jQuery('.main_cat_1').html();
	var ab_val=parseFloat(parseFloat(a)/62.4/parseFloat(main_cat_1));
	ab_val=ab_val.toFixed(2);
	
	jQuery('.cost_portland_concrete').html(port_cost); 
	jQuery('.ab_portland_concrete').html(ab_val); 
	 
	
	var sand_price=jQuery('.price_sand').html();
	var sand_cost=parseFloat(a) * parseFloat(sand_price);
	sand_cost=sand_cost.toFixed(2); 
	
	var main_cat_2=jQuery('.main_cat_2').html();
	var ab_val=parseFloat(parseFloat(a)/62.4/parseFloat(main_cat_2)); 
	ab_val=ab_val.toFixed(2); 
	
	jQuery('.cost_sand').html(sand_cost);  
	jQuery('.ab_sand').html(ab_val); 
	
	init();
	
	jQuery('.csa').keyup(function() 
	{ 
		var csa_val=jQuery(this).val(); 
		var silica_fume=jQuery('.silica_fume').val(); 
		
		if(silica_fume=="") 
		{
			silica_fume=0; 
		}  
		
		if(csa_val!="")
		{	
			var sand=jQuery('.def_sand').html();  
			var new_sand=parseFloat(csa_val) + parseFloat(sand) + parseFloat(silica_fume);
			
			jQuery('input[name=sand]').val(new_sand); 
			
			cal_sand_value();  
			init();   
		}
		else
		{
			
			var csa_val=jQuery(this).val(); 
			var silica_fume=jQuery('.silica_fume').val();
			var sand=jQuery('.def_sand').html();
			
			if(csa_val=="")  
			{
				csa_val=0;
			}	
			
			if(silica_fume=="")
			{
				silica_fume=0;
			}	 
			
			var new_sand=parseFloat(csa_val) + parseFloat(sand) + parseFloat(silica_fume);
			
			jQuery('input[name=sand]').val(new_sand); 
			
			
			jQuery('.csa').val('');   
			
			cal_sand_value();   
			init();  
		}	
	});
	
	
	jQuery('.silica_fume').keyup(function() 
	{ 
		var silica_fume=jQuery(this).val(); 
		var csa=jQuery('.csa').val(); 
		
		if(csa=="") 
		{
			csa=0; 
		}  
		
		if(silica_fume!="")
		{	
			var sand=jQuery('.def_sand').html();   
			var new_sand=parseFloat(silica_fume) + parseFloat(sand) + parseFloat(csa); 
			
			jQuery('input[name=sand]').val(new_sand); 
			
			cal_sand_value();   
			init();   
		}
		else
		{
			
			var silica_fume=jQuery(this).val(); 
			var csa=jQuery('.csa').val();
			var sand=jQuery('.def_sand').html();
			
			if(silica_fume=="")   
			{
				silica_fume=0;
			}	
			
			if(csa=="") 
			{
				csa=0;
			}	 
			
			var new_sand=parseFloat(silica_fume) + parseFloat(sand) + parseFloat(csa);
			
			jQuery('input[name=sand]').val(new_sand);  
			
			jQuery('.silica_fume').val('');  
			
			
			cal_sand_value();   
			init();  
		}	
	});
	
	
	
}); 
</script>					