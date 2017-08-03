					<?php $pc_comp_id=$pc_cmp_id; ?>
					
					
					<div class="close_mn display_block new_piece">		
					<div class="new_custmer">
					
					<a class="close_new" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>
					<h4 class="close_title">ADD COMPONENT</h4>
					</div> 		
					<div class="inner_content"> 
					 
					<div class="form">
						<form name="add_peice_comp" id="add_peice_comp" action="" method="post">	
						<input name="action" value="AddPieceComp" type="hidden">	  
						<input name="job_id" value="<?php echo $job_id; ?>" type="hidden">	
						<input name="piece_id" value="<?php echo $piece_id; ?>" type="hidden">	
						<input name="comp_id" value="<?php echo $comp_id; ?>" type="hidden">	
						<input type="hidden" name="tot_abs_vol" value="0"> 	
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
						$matArray=unserialize($material); 
						?>
                        <div class="table_piece inline_width">
                            <table>
                                <thead>
                                
									<tr>
                                        
                                        <th style="width: 20%;">Thickness</th>
                                        <th style="width: 20%;">
										<input type="text" value="0.75" name="thick" onkeyup="cal_cubic_fig();"></th>
										<th style="width: 20%;"><span class="piece_name" style="display:none;">Self-Consolidating Face Coat</span></th> 
										
										   
                                    </tr>
									<tr>
                                        
                                        <th style="width: 20%;">Length</th>
                                        <th style="width: 20%;"><input type="text" name="height" onkeyup="cal_cubic_fig();" value="<?php echo get_job_components_info($pc_comp_id,'length'); ?>"></th> 
										<th style="width: 20%;">&nbsp;</th> 
                                    </tr>
									<tr>
                                       
                                        <th style="width: 20%;">Width</th>
                                        <th style="width: 20%;"><input type="text" name="width" onkeyup="cal_cubic_fig();" value="<?php echo get_job_components_info($pc_comp_id,'width'); ?>"></th>  
										 <th style="width: 20%;">&nbsp;</th> 
                                    </tr>
									<tr>
                                       
                                        <th style="width: 21.33%;">Cubic Sq Ft</th>
                                        <th style="width: 34.33%;"><input type="text"  name="cubic_sq_ft" value="<?php echo get_job_components_info($pc_comp_id,'cubic_sq'); ?>" readonly></th>
										 <th style="width: 22%;">&nbsp;</th> 
                                    </tr>
									<tr>
                                       
                                        <th style="width: 21.33%;">Cubic Sq Ft + 5%</th>
                                        <th style="width: 34.33%;"><input type="text" name="cubic_sq_ft_int" value="<?php echo get_job_components_info($pc_comp_id,'cubic_sq_int'); ?>" readonly ></th>
										 <th style="width: 22%;">&nbsp;</th> 
                                    </tr> 

                                </thead>
                                <tbody>
                                    
									<?php 
									
									
									
									$i=1;
									$sql="select * from material_category where status='0'";
									$statement = $db->prepare($sql);  	   
									$statement->execute();   
									$result=$statement->fetchAll();   
									foreach($result as $row)
									{
										$cat_id=$row['id'];
										$cat_name=$row['name'];
										$sg=$row['sg'];
										if($sg=="")
										{
											$sg=0;
										}	
									?>	
                                    <tr>
                                        <td><b><?php echo $cat_name; ?></b> <?php if($cat_id==3) { ?><span style="float:right;">Water</span> <?php } ?></td>
                                        <td>
                                            <?php
											if($cat_id!=3)
											{	
											?>
											<div class="weight_value">
                                                &nbsp;
                                            </div>
											<?php
											}
											else
											{	
											?>
											<div class="weight_value asd_value weight_pigments">
												<input class="input_<?php echo $cat_id; ?>" type="text" id="water_value">
											</div>
											<?php
											}
											?>
											<?php if($cat_id!=3) { ?>
                                            <div class="weight_text">
                                                <?php if($i==1) { echo 'Weight'; } ?>
                                            </div>
											<?php } else { ?>
											<div class="weight_text">
                                               %
                                            </div>
											<?php } ?>
                                        </td>
                                        <td>
                                            <div class="input_cost">
                                                 <?php if($i==1) { echo 'Cost'; } ?> 
                                            </div>
                                        </td>
										<td>
                                            <div class="input_cost">
                                               <?php if($i==1) { echo 'Abs Vol'; } ?> 
                                            </div>
                                        </td>
                                    </tr> 
										<?php
										$a=1;
										$sql_1="select * from material where category='".$cat_id."'";
										$statement = $db->prepare($sql_1);  	   
										$statement->execute();   
										$result_1=$statement->fetchAll();   
										foreach($result_1 as $row_1)
										{ 
										?>
											<?php 
											if(!empty($matArray)) 
											{ 
												if(in_array($row_1['id'], $matArray)) 
												{ 
												?>
											<tr class="inner-tab"> 
												<td><span class="pdng_span"><?php echo $row_1['descp']; ?><span></td>
												<td>
													<div class="weight_value asd_value <?php if(!empty($matArray)){ if(!in_array($row_1['id'], $matArray)) { echo 'disabled'; } } ?>">
														<input type="text" <?php if(!empty($matArray)){ if(!in_array($row_1['id'], $matArray)) { echo 'disabled'; } } ?> class="weight_txt input_<?php echo $row_1['id']; ?>" onkeyup="cal_cost('<?php echo $row_1['id']; ?>');" name="tot_weight[]" u="<?php echo $cat_id; ?>" > 
														<span class="cost_txt price_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo $row_1['price']; ?></span> 
													</div> 
													<div class="weight_text"> 
														<?php echo $row_1['weight']; ?>
													</div> 
												</td>
												<td> 
													<div class="input_cost"> 
														<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?>">0.00</span>
														<input type="text" name="tot_cost[]" class="cost_text_box cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
													<?php  
													if($cat_id==3)
													{ ?><span id="water_value_span" style="display:block;"><?php echo trim($row_1['water']); } ?></span>
													</div> 
												</td>
												<td>
												<div class="input_cost">
													<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal">0</span>
													<span class="main_cat_<?php echo $cat_id; ?>" style="display:none;"><?php echo $sg; ?></span>
												</div>  
												</td>
											</tr>
											<?php
												}
											}
										?>	
										<?php 
										}
									$i++;
									}
									?>
									<?php
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
									
									?>    
									<tr> 
                                        <td><b><?php echo $row['name']; ?></b></td>
                                        <td>
                                           <div class="weight_value asd_value " tabindex="<?php echo $i; ?>">
												<input class="input_<?php echo $row['id']; ?> weight_txt" name="tot_weight[]" onkeyup="cal_cost('<?php echo $row['id']; ?>');" type="text"  u="<?php echo $row['id']; ?>">
												<span class="price_<?php echo $row['id']; ?>" style="display:none;"><?php echo $row['price']; ?></span> 
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
										
                                        <td colspan="3" align="center">
                                            <button class="custom orange" type="submit" name="submit"><i class="fa fa-plus" aria-hidden="true"></i> Save Component</button>
											<img src="<?php echo SITE_URL; ?>assets/images/loader-11.gif" id="cust_job_loader" style="display:none;">
											<input type="hidden" id="total_weight" name="total_weight_1" value="0">
											<input type="hidden" id="total_cost_1" name="total_cost_1" value="0">
											
											  
                                        </td> 

                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: right; width: 50%;color:#2d2d2d;">
                                                             <strong>Total Weight </strong> <span class="weight_span"> 0</span>
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
						
                    </div>                    </div>                    </div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>	
<script>

jQuery(document).ready(function()
{
	
	var value=jQuery('#water_value_span').html(); 
	jQuery('#water_value').val(value);  
	
});

</script>					