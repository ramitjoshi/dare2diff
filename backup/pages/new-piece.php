<?php 
if(!isset($_SESSION['user_id']))
{
?>
<script>window.location.href="<?php echo SITE_URL; ?>?section=login";</script>
<?php
die;
}
if(!isset($_GET['id']))
{
?>
<script>window.location.href="<?php echo SITE_URL; ?>?section=login";</script>
<?php	
die;
}

	
$job_id=$_GET['id'];
$piece_id=$_GET['pr_id']; 
$db = get_connection();
$cust_id=get_cust_job_detail($job_id,'cust_id');

$tot_abs_vol=get_job_components_info($piece_id,'tot_abs_vol'); 

get_header(); 
?>
<?php //echo $_SESSION['user_id']; ?> 
<div class="main display_block">
        <?php get_sidebar(); ?>

        <div class="rt_sidebar pull-left customers_container">
            <div class="btns_cont">
                <div class="btns_top pull-right">
                    <div class="btns_lft pull-right">
                        
						<a href="<?php echo SITE_URL; ?>?section=job-detail&id=<?php echo $job_id; ?>" class="custom">Back</a>
                        <a href="<?php echo SITE_URL; ?>?section=dashboard" class="custom">Dashboard</a> 
                       
                    </div>
                    <!--div class="btns_rt pull-right">
                        <!--
						<input type="text" placeholder="Search">
                        <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
						
                    </div--> 
                </div>
            </div> 
			<div id="fromToggle" class="collapsible-area" style="display:none"></div>
            <div class="close_mn display_block new_piece">
				
				<div class="close_container">

                    <div class="inner_content">
                        <div class="inner_pdng">
                            <div class="permit_no clear permit_top">
                                <div class="permit_left pull-left">
                                    <h4><?php echo get_cust_job_detail($job_id,'name'); ?></h4>
                                    <p><?php echo get_cust_detail($cust_id,'company'); ?>, <?php echo get_cust_detail($cust_id,'work_add1'); ?></p> 
                                </div>
                                <div class="permit_left pull-right permit_right">
                                    <h5>PO #</h5>
                                    <p><?php echo get_cust_job_detail($job_id,'po'); ?></p>
                                </div>
                            </div>

                            <div class="permit_no clear permit_bottom">
                                <div class="permit_left pull-left">
                                    <h4>Job Notes</h4>
                                    <p><?php echo get_cust_job_detail($job_id,'job_notes'); ?></p>
                                </div>
                                <div class="permit_left pull-right">
                                    <a class="custom orange show_job_photo" href="javascript:void(0);" onclick="show_job_pic(1);">Show Job Photos</a>
                                </div>
                            </div>

                            <div class="close_lst job_images" style="display:none;">
                                <ul>
                                    <li>
										<?php $photo_1=get_cust_job_detail($job_id,'photo_1'); ?>
                                        <div class="image_clos">
                                            <?php
											if($photo_1!="")
											{
											?>
												<img src="<?php echo SITE_URL; ?>job_image/thumb.php?src=<?php echo $photo_1; ?>&w=320&h=250">
											<?php	
											}
											else
											{
											?>
												<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
											<?php	
											}		
											?>
											
                                            <div class="content_img">

                                                <h5><?php echo get_cust_job_detail($job_id,'photo_1_caption'); ?></h5>
                                                <div class="btn_cntnt">
                                                    <!--<a class="custom bg_trans" href="">Polish &amp; Fill</a>-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--
										<div class="imag_info">
                                            <a href="#" class="img_btn">Edit</a>
                                            <a href="#" class="img_btn">Print</a>
                                        </div>
										-->

                                    </li>
                                    <li>
										<?php $photo_2=get_cust_job_detail($job_id,'photo_2'); ?>
                                        <div class="image_clos">
                                            <?php
											if($photo_2!="")
											{
											?>
												<img src="<?php echo SITE_URL; ?>job_image/thumb.php?src=<?php echo $photo_2; ?>&w=320&h=250">
											<?php	
											}
											else
											{
											?>
												<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
											<?php	
											}		
											?>
											
                                            <div class="content_img">

                                                <h5><?php echo get_cust_job_detail($job_id,'photo_2_caption'); ?></h5>
                                                <div class="btn_cntnt">
                                                    <!--<a class="custom bg_trans" href="">Polish &amp; Fill</a>-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--
										<div class="imag_info">
                                            <a href="#" class="img_btn">Edit</a>
                                            <a href="#" class="img_btn">Print</a>
                                        </div>
										-->

                                    </li>
                                    <li>
										<?php $photo_1=get_cust_job_detail($job_id,'photo_3'); ?>
                                        <div class="image_clos">
                                            <?php
											if($photo_3!="")
											{
											?>
												<img src="<?php echo SITE_URL; ?>job_image/thumb.php?src=<?php echo $photo_3; ?>&w=320&h=250">
											<?php	
											}
											else
											{
											?>
												<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
											<?php	
											}		
											?>
											
                                            <div class="content_img">

                                                <h5><?php echo get_cust_job_detail($job_id,'photo_3_caption'); ?></h5>
                                                <div class="btn_cntnt">
                                                    <!--<a class="custom bg_trans" href="">Polish &amp; Fill</a>-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--
										<div class="imag_info">
                                            <a href="#" class="img_btn">Edit</a>
                                            <a href="#" class="img_btn">Print</a>
                                        </div>
										-->

                                    </li>
                                </ul>

                            </div> 
                        </div>
						<div class="form">
						<form name="job_peice" id="job_piece" action="" method="post">	
						<input type="hidden" name="action" value="AddPiece">	
						<input type="hidden" name="job_id" value="<?php echo $job_id; ?>">	
						<input type="hidden" name="tot_abs_vol" value="0"> 	
                        <div class="free_piece_radio"> 
                            <div class="inner_pdng">
                                <input type="text" name="piece_name" placeholder="New Piece" value="<?php if(isset($_GET['pr_id'])){ echo get_peice_info($_GET['pr_id'],'piece_name'); }  ?>" <?php if(isset($_GET['pr_id'])){ echo 'readonly';  }  ?>>
								<div class="title_radio"> 
                                    <h5>Recipe Components</h5>
                                </div> 
                                <div class="select_radio">
                                    <ul>
                                        <?php
										if($_GET['pr_id'])
										{
											$sql="select distinct component from job_piece_component where job_id='".$job_id."' and piece_id='".$_GET['pr_id']."'";
											$statement = $db->prepare($sql); 	
											$statement->execute();   
											$result=$statement->fetchAll(); 
											foreach($result as $row)
											{
												$piece_array[]=$row['component'];
											}
											
											$sql="select * from recipe_components";
											$statement = $db->prepare($sql); 	
											$statement->execute();   
											$count=$statement->rowCount();  
											$result=$statement->fetchAll(); 
											if($count > 0)
											{	
												foreach($result as $row)
												{
												?>
												<li <?php if(!empty($piece_array)){ if(in_array($row['id'], $piece_array)) { echo 'style="display:none;"'; } } ?>>
													<input type="radio" name="recipe" value="<?php echo $row['id']; ?>" onclick="show_material_piece(this);"> 
													<label><?php echo $row['name']; ?></label>
												</li> 
												<?php
												}
											} 
										}	
										else
										{
											$sql="select * from recipe_components";
											$statement = $db->prepare($sql); 	
											$statement->execute();   
											$count=$statement->rowCount();  
											$result=$statement->fetchAll(); 
											if($count > 0)
											{	
												foreach($result as $row)
												{
												?>
												<li>
													<input type="radio" name="recipe" value="<?php echo $row['id']; ?>" onclick="show_material_piece(this);"> 
													<label><?php echo $row['name']; ?></label>
												</li> 
												<?php
												}
											}
										}	
										
										?>
                                    </ul>
                                </div>
                            </div>
                        </div>
						<?php
						$material=get_cust_job_detail($job_id,'material');
						$matArray=unserialize($material); 
						
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
                        <div class="table_piece inline_width" style="display:none;">
                            <table>
                                <thead>
                                
									<tr>
                                        
                                        <th style="width: 20%;">Thickness</th>
                                        <th style="width: 20%;"><input type="text" value="0.75" name="thick" onkeyup="cal_cubic_fig();" value="<?php echo $thick; ?>"></th> 
										<th style="width: 20%;"><span class="piece_name" style="display:none;">Self-Consolidating Face Coat</span></th> 
										<th>&nbsp;</th>
										
										   
                                    </tr>
									<tr>
                                        
                                        <th style="width: 20%;">Length</th>
                                        <th style="width:20%;"><input type="text" name="height" onkeyup="cal_cubic_fig();" value="<?php echo $length; ?>" ></th> 
										<th style="width: 20%;">&nbsp;</th> 
										<th>&nbsp;</th>
                                    </tr>
									<tr>
                                       
                                        <th style="width: 20%;">Width</th>
                                        <th style="width: 20%;"><input type="text" name="width" onkeyup="cal_cubic_fig();" value="<?php echo $width; ?>"></th>  
										 <th style="width:20%;">&nbsp;</th> 
										 <th>&nbsp;</th>
                                    </tr>
									<tr>
                                       
                                        <th style="width: 21.33%;">Cubic Sq Ft</th>
                                        <th style="width: 34.33%;"><input type="text"  name="cubic_sq_ft" value="<?php echo $cubic_sq; ?>" readonly></th>
										 <th style="width: 22%;">&nbsp;</th> 
										 <th>&nbsp;</th>
                                    </tr>
									<tr>
                                       
                                        <th style="width: 21.33%;">Cubic Sq Ft + 5%</th>
                                        <th style="width: 34.33%;"><input type="text" name="cubic_sq_ft_int" value="<?php echo $cubic_sq_int; ?>" readonly ></th>
										 <th style="width: 22%;">&nbsp;</th>
										 <th>&nbsp;</th>
								 
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
											if($cat_id==3)
											{	
											?>
											<div class="weight_value asd_value ">
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
														<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
													<?php  
													if($cat_id==3)
													{ ?><span id="water_value_span" style="display:none;"><?php echo trim($row_1['water']); } ?></span>
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
												<input class="input_<?php echo $row['id']; ?> weight_txt" name="tot_weight[]" onkeyup="cal_cost('<?php echo $row['id']; ?>');" type="text" u="<?php echo $row['id']; ?>"> 
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
										<?php
										$sql="select SUM(total_weight) 'total_weight' from job_piece_component where job_id='".$job_id."' and piece_id='".$_GET['pr_id']."'";
										$statement = $db->prepare($sql);  	   
										$statement->execute(); 
										$result=$statement->fetchAll(); 
										foreach($result as $row)
										{
											$toto_wgt=$row['total_weight'];
										}
										
										$sql="select SUM(total_cost) 'total_cost' from job_piece_component where job_id='".$job_id."' and piece_id='".$_GET['pr_id']."'";
										$statement = $db->prepare($sql);   	   
										$statement->execute(); 
										$result=$statement->fetchAll(); 
										foreach($result as $row)
										{
											$toto_cost=$row['total_cost'];
										}		
										
										if($toto_wgt=="")
										{
											$toto_wgt=0;
										}
										
										if($toto_cost=="")
										{
											$toto_cost=0;
										}
										?>
                                        <td colspan="3" align="center">
                                            <button class="custom orange" type="submit" name="submit"><i class="fa fa-plus" aria-hidden="true"></i> Add Component</button>
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
                                                             <strong>Total Weight </strong><span class="weight_span"><?php echo $toto_wgt; ?></span>
                                                        </td>
                                                        <td style="width: 50%;color:#2d2d2d;">
                                                           <strong>Cost </strong> $<span class="cost_span"><?php echo $toto_cost; ?></span>
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
			</div>
			
			<?php
			if(isset($_GET['pr_id'])){
			?>
			<div class="close_mn display_block new_piece">
				<div class="close_container">
				<div class="inner_content">
				<div class="inner_pdng">
				<div class="edit_table vndr_cnt customrs_cont comp_cst">
				<h4 class="title_main">Active Components</h4>
					<div class="responisve_table comp_table">
					<table class="table">
						<thead>
							<tr>
								<th style="width: 3%;"></th>
								<th style="width: 19%;">Piece Name</th>
								<th style="width: 19%;">Recipe Components</th>
								<th style="text-align: center; width: 10%;"></th>
							</tr> 
						</thead>
						<tbody>
							<?php
							$sql="select * from job_piece_component where job_id='".$_GET['id']."' and piece_id='".$_GET['pr_id']."' ";
							$statement = $db->prepare($sql); 	
							$statement->execute();   
							$result=$statement->fetchAll(); 
							foreach($result as $row)
							{
							?>
							<tr>
								<td></td>
								<td><?php if(isset($_GET['pr_id'])){ echo get_peice_info($_GET['pr_id'],'piece_name'); }  ?></td> 
								<td><?php echo get_recipe_components_info($row['component'],'name'); ?></td> 
								<td><a class="custom edit_cstm" href="<?php echo SITE_URL; ?>?section=view-component&id=<?php echo $row['id']; ?>">View</a></td>
							</tr> 
							<?php
							}
							?>
						</tbody>
					</table>
					<table class="table">
						<tbody>
							<tr>
								<td>
									 <strong>Total Weight: &nbsp;</strong><span class="weight_span"><?php echo $toto_wgt; ?></span>
								</td>
								<td style="color:#2d2d2d;">
								   <strong>Cost:</strong> $<span class="cost_span"><?php echo $toto_cost; ?></span>
								</td> 
							</tr>

						</tbody>
					</table>
					</div>
				</div>
				</div>
				</div>
				</div>
			</div>
			<?php } ?>
        </div>
    </div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>	
<script>

jQuery(document).ready(function()
{
	var value=jQuery('#water_value_span').html(); 
	jQuery('#water_value').val(value);  
	
	
});

</script>	
<?php get_footer(); ?>