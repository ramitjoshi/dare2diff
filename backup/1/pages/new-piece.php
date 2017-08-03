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
				
				<input type="hidden" id="a" value="<?php echo $homepage; ?>" />
				<input type="hidden" id="i" value="<?php echo $i; ?>" />
				<input type="hidden" id="j" value="<?php echo $j; ?>" />
				<input type="hidden" id="k" value="<?php echo $water; ?>" />
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
                        <div class="table_piece inline_width" style="display:none;">
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
                                       
                                        <th style="width: 21.33%;">Cubic Sq Ft + 5%</th>
                                        <th style="width: 34.33%;"><input type="text" name="cubic_sq_ft_int" value="<?php echo $cubic_sq_int; ?>" readonly ></th>
										 <th style="width: 22%;">&nbsp;</th>
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
													<span class="def_portland_concrete" style="display:none;"></span>  
													<span class="def_input_<?php echo $row_1['id']; ?>" style="display:none;"></span>  
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
									<?php
									$arr=array(119,121);
									
									$sql="select * from material_category where status='1' and id=121";
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
										$cat_id=$row['id'];
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
									<?php
									$arr=array(119,121);
									
									$sql="select * from material_category where status='1' and id=119";
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
										$cat_id=$row['id'];
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
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" u="2" name="sand"  readonly>
													<span class="cost_txt price_<?php echo $row_1['id']; ?> price_sand " style="display:none;"><?php echo $row_1['price']; ?></span>  
													<span class="def_sand" style="display:none;"></span>  
													<span class="def_input_<?php echo $row_1['id']; ?>" style="display:none;"></span> 
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
												<input type="text" name="water_weight" readonly > 
												<span class="side_value">&nbsp;</span>
											</div>
											<div class="weight_text">
                                              
											   <input type="text" class="weight_txt" value="<?php echo $water; ?>" name="water" onkeyup="cal_water();">
												<span class="def_water" style="display:none;"><?php echo $water; ?></span>
												<span class="side_value">%</span>
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
									
									$sql="select * from material_category where status='1' and id not in(119,121)";
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
										$cat_id=$row['id'];
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
													<input class="input_<?php echo $row['id']; ?> weight_txt <?php echo $class_name; ?>" name="tot_weight[]" type="text"  u="<?php echo $row['id']; ?>" readonly> 
												<?php
												}
												?> 
												
												
												<span class="price_<?php echo $row['id']; ?>" style="display:none;"><?php echo $row['price']; ?></span> 
												<span class="def_price_<?php echo $row['id']; ?>" style="display:none;"><?php echo $price; ?></span> 
												<span class="def_input_<?php echo $row['id']; ?>" style="display:none;"><?php echo $price; ?></span>  
												<span class="def_<?php echo $class_name; ?>" style="display:none;">0</span>  
												 
											</div>    
											<div class="weight_text">
											
													<input class="<?php echo $class_name; ?>" type="text" u="<?php echo $row['id']; ?>" name="<?php echo $class_name; ?>_per" onkeyup="cal_weight_cat('<?php echo $row['id']; ?>','<?php echo $class_name; ?>');">  
													<span class="side_value">%</span>
												
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
										<td><b>AIR</b></td>
										<td> 
										   <div class="weight_value asd_value " tabindex="1">
											<input  readonly type="text"> 
												
											</div>    
											<div class="weight_text">
												<input  type="text" value="2">
												<span class="side_value">%</span>
											</div>			
										</td>
										<td>
											<div class="input_cost"> 
												<span class="dollar">$</span><span class="total_cost">0</span>
												
											</div> 
										</td>
										<td>
										<div class="input_cost">
										&nbsp;
										</div> 
										</td>
									</tr>
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
					<?php
					$sql="select SUM(`total_weight`) 'total_weight',SUM(`total_cost`) 'total_cost' from job_piece_component where job_id='".$_GET['id']."' and piece_id='".$_GET['pr_id']."' ";
					$statement = $db->prepare($sql); 	
					$statement->execute();   
					$result=$statement->fetchAll(); 
					foreach($result as $row)
					{
						$total_weight_s=$row['total_weight'];
						$total_cost_s=$row['total_cost'];
					}
					
					if($total_weight_s=="")
					{
						$total_weight_s=0;
					}
					if($total_cost_s=="")
					{
						$total_cost_s=0;
					}	
					?>
					<table class="table" style="text-align:center">
						<tbody>
							<tr>
								<td>
									<div class="col_strng"> <strong>Total Weight: &nbsp;</strong><span class="weight_span_1"><?php echo $total_weight_s; ?></span></div>
									<div class="col_strng">  <strong>Cost:</strong> $<span class="cost_span_1"><?php echo $total_cost_s; ?></span></div>
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
	
	
	var water=jQuery('#k').val();
	var i=jQuery('#i').val();
	var j=jQuery('#j').val();
	
	var tot_water=parseFloat(a)+parseFloat(i)+parseFloat(j);
	var water_weight=parseFloat(parseFloat(water)*parseFloat(tot_water)/100);
	water_weight = water_weight.toFixed(2);  
	jQuery('input[name=water_weight]').val(water_weight);
	
	 
	init();
	
	
	
}); 
</script>
<?php get_footer(); ?>