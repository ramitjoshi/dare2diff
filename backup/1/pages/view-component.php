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

$db = get_connection(); 	
$pc_comp_id=$_GET['id'];


 



get_header(); 


$job_id=get_job_components_info($pc_comp_id,'job_id'); 

$piece_id=get_job_components_info($pc_comp_id,'piece_id'); 
$thick=get_job_components_info($pc_comp_id,'thick'); 
$length=get_job_components_info($pc_comp_id,'length'); 
$width=get_job_components_info($pc_comp_id,'width'); 
$cubic_sq=get_job_components_info($pc_comp_id,'cubic_sq'); 
$cubic_sq_int=get_job_components_info($pc_comp_id,'cubic_sq_int'); 
$weight=get_job_components_info($pc_comp_id,'weight'); 
$cost_json=get_job_components_info($pc_comp_id,'cost'); 
$ab_val_json=get_job_components_info($pc_comp_id,'ab_val'); 
$total_weight=get_job_components_info($pc_comp_id,'total_weight'); 
$total_cost=get_job_components_info($pc_comp_id,'total_cost'); 
$tot_abs_vol=get_job_components_info($pc_comp_id,'tot_abs_vol'); 
 

$cust_id=get_cust_job_detail($job_id,'cust_id');
$material=get_cust_job_detail($job_id,'material');
$mat=json_decode($material);


$water=get_job_components_info($pc_comp_id,'water');  
$csa_per=get_job_components_info($pc_comp_id,'csa_per'); 
$fume_per=get_job_components_info($pc_comp_id,'fume_per'); 

$path=SITE_URL .'math/example.php?water='.$water.'&csa='.$csa_per.'&fume='.$fume_per;
 
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
                        
						<a href="<?php echo SITE_URL; ?>?section=new-piece&id=<?php echo $job_id; ?>&pr_id=<?php echo $piece_id; ?>" class="custom">Back</a>
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
            <input type="hidden" id="a" value="<?php echo $homepage; ?>" />
            <input type="hidden" id="i" value="<?php echo $csa_per; ?>" />
            <input type="hidden" id="j" value="<?php echo $fume_per; ?>" />
            <input type="hidden" id="k" value="<?php echo $water; ?>" />
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
						<form name="edit_peice_comp" id="edit_peice_comp" action="" method="post">	
						<input type="hidden" name="action" value="EditPieceComp">	 
						<input type="hidden" name="job_id" value="<?php echo $job_id; ?>">	
						<input type="hidden" name="piece_id" value="<?php echo $piece_id; ?>">	
						<input type="hidden" name="pc_comp_id" value="<?php echo $pc_comp_id; ?>">	
						<input type="hidden" name="tot_abs_vol" value="<?php echo $tot_abs_vol; ?>"> 
                        <div class="free_piece_radio">   
                            <div class="inner_pdng">
								<h5><?php echo get_peice_info($piece_id,'piece_name'); ?></h5>
                                <div class="title_radio">  
                                    <h5>Recipe Components</h5>
                                </div> 
                                <div class="select_radio">
                                    <?php
									$comp_id=get_job_components_info($pc_comp_id,'component')
									?>
									<ul>
                                        <li><?php echo get_recipe_components_info($comp_id,'name');  ?></li>
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
						
						$weightArray=json_decode($weight);
						$ArrayWeight=$weightArray->weight; 
						
						$costArray=json_decode($cost_json);
						$Arraycost=$costArray->cost; 
						
						$ab_valArray=json_decode($ab_val_json);
						$Arrayab_val=$ab_valArray->ab_vol; 
						
						
						?>
                        <div class="table_piece inline_width">
                            <table>
                                <thead>
									<tr> 
                                        
                                        <th style="width: 25%;">Thickness</th>
                                        <th style="width: 29%;">
										<input type="text" value="<?php echo get_job_components_info($pc_comp_id,'thick'); ?>" name="thick" onkeyup="cal_cubic_fig();" disabled></th>
										<th style="width: 20%;"><span class="piece_name" style="display:none;">Self-Consolidating Face Coat</span></th> 
										
										   
                                    </tr>
									<tr>
                                        
                                        <th style="width: 25%;">Length</th>
                                        <th style="width: 229%;"><input type="text" name="height" onkeyup="cal_cubic_fig();" value="<?php echo get_job_components_info($pc_comp_id,'length'); ?>" disabled></th> 
										<th style="width: 20%;">&nbsp;</th> 
                                    </tr>
									<tr>
                                       
                                        <th style="width: 25%;">Width</th>
                                        <th style="width: 29%;"><input type="text" name="width" onkeyup="cal_cubic_fig();" value="<?php echo get_job_components_info($pc_comp_id,'width'); ?>" disabled></th>  
										 <th style="width: 20%;">&nbsp;</th> 
                                    </tr>
									<tr> 
                                       
                                        <th style="width: 25%;">Cubic Sq Ft</th>
                                        <th style="width: 29%;"><input type="text"  name="cubic_sq_ft" value="<?php echo get_job_components_info($pc_comp_id,'cubic_sq'); ?>" disabled></th>
										 <th style="width: 20%;">&nbsp;</th> 
                                    </tr>
									<tr>
                                       
                                        <th style="width: 25%;">Cubic Sq Ft + 5%</th>
                                        <th style="width: 29%;"><input type="text" name="cubic_sq_ft_int" value="<?php echo get_job_components_info($pc_comp_id,'cubic_sq_int'); ?>" disabled ></th>
										 <th style="width: 20%;">&nbsp;</th> 
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
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" u="1" name="portland_concrete"  value="<?php echo $ArrayWeight[0]; ?>" onkeyup="cal_a(<?php echo $row_1['id']; ?>);">  
													<span class="cost_txt price_<?php echo $row_1['id']; ?> price_portland_concrete" style="display:none;"><?php echo $row_1['price']; ?></span>  
													<span class="def_portland_concrete" style="display:none;"><?php echo $ArrayWeight[0]; ?></span>  
													<span class="def_input_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo $ArrayWeight[0]; ?></span>  
												</div>  
												<div class="weight_text">
												   <?php echo $row_1['weight']; ?>
												</div> 
											</td> 
											<td>
												<div class="input_cost">
													<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?> cost_portland_concrete"><?php echo number_format($Arraycost[0], 2, '.', ''); ?></span>    
													<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
												</div>
											</td>
											<td>
												<div class="input_cost">
													<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal ab_portland_concrete"><?php echo number_format($Arrayab_val[0], 2, '.', ''); ?></span> 
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
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" u="2" name="sand" value="<?php echo number_format($ArrayWeight[1], 2, '.', ''); ?>" readonly> 
													<span class="cost_txt price_<?php echo $row_1['id']; ?> price_sand " style="display:none;"><?php echo $row_1['price']; ?></span>  
													<span class="def_sand" style="display:none;"><?php echo number_format($ArrayWeight[1], 2, '.', ''); ?></span>  
													<span class="def_input_<?php echo $row_1['id']; ?>" style="display:none;"><?php echo number_format($ArrayWeight[1], 2, '.', ''); ?></span> 
												</div>  
												<div class="weight_text">
												   <?php echo $row_1['weight']; ?>
												</div> 
											</td> 
											<td>
												<div class="input_cost">
													<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?> cost_sand"><?php echo number_format($Arraycost[1], 2, '.', ''); ?></span> 
													<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
												</div>
											</td>
											<td>
												<div class="input_cost">
													<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal ab_sand"><?php echo number_format($Arrayab_val[1], 2, '.', ''); ?></span>
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
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" onkeyup="cal_cost('<?php echo $row_1['id']; ?>');" u="3" name="pigments" value="<?php echo number_format($ArrayWeight[2], 2, '.', ''); ?>">
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
													<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?>"><?php echo number_format($Arraycost[2], 2, '.', ''); ?></span> 
													<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
												</div>
											</td> 
											<td>
											<div class="input_cost">
												<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal"><?php echo number_format($Arrayab_val[2], 2, '.', ''); ?></span>
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
													<input type="text" class="weight_txt input_<?php echo $row_1['id']; ?>" onkeyup="cal_cost('<?php echo $row_1['id']; ?>');" u="4" name="sealer" value="<?php echo number_format($ArrayWeight[3], 2, '.', ''); ?>"> 
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
													<span class="dollar">$</span><span class="total_cost cost_<?php echo $row_1['id']; ?>"><?php echo number_format($Arraycost[3], 2, '.', ''); ?></span>
													<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row_1['id']; ?>" value="0" style="display:none;">
												</div>
											</td>
											<td> 
												<div class="input_cost">
													<span class="sg_cal_<?php echo $row_1['id']; ?> tot_sg_cal"><?php echo number_format($Arrayab_val[3], 2, '.', ''); ?></span>
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
									$a=4;
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
										
										if($row['id']==119)
										{
											$value=$fume_per;
										}	
										else if($row['id']==121)
										{
											$value=$csa_per;
										}
										
									?>
									<tr> 
                                        <td><b><?php echo $row['name']; ?></b></td>
                                        <td>
                                           <div class="weight_value asd_value " tabindex="<?php echo $i; ?>">
												<?php
												if (in_array($row['id'], $arr)) { 
												?>
													<input class="input_<?php echo $row['id']; ?> weight_txt" name="<?php echo $class_name; ?>_weight" type="text" u="<?php echo $row['id']; ?>" value="<?php echo number_format($ArrayWeight[$a], 2, '.', ''); ?>" readonly >  
													<span class="side_value">lb</span>	
												<?php
												}
												else
												{	
												?>
													<input class="input_<?php echo $row['id']; ?> weight_txt <?php echo $class_name; ?>" name="tot_weight[]" onkeyup="cal_cost('<?php echo $row['id']; ?>');" type="text" u="<?php echo $row['id']; ?>" value="<?php echo number_format($ArrayWeight[$a], 2, '.', ''); ?>">  
												<?php
												}
												?>
												<span class="price_<?php echo $row['id']; ?>" style="display:none;"><?php echo $row['price']; ?></span> 
												<span class="def_price_<?php echo $row['id']; ?>" style="display:none;"><?php echo $price; ?></span> 
												<span class="def_input_<?php echo $row['id']; ?>" style="display:none;"><?php echo $price; ?></span> 
												<span class="def_<?php echo $class_name; ?>" style="display:none;"><?php echo $value; ?></span>
											</div>  
											<div class="weight_text">
											<?php
												if (in_array($row['id'], $arr)) 
												{ 
													if($row['id']==119)
													{
														$value=$fume_per;
													}	
													else if($row['id']==121)
													{
														$value=$csa_per;
													}	
												
												?>
													<input class="<?php echo $class_name; ?>" type="text" u="<?php echo $row['id']; ?>" name="<?php echo $class_name; ?>_per" value="<?php echo $value; ?>"> 
													<span class="side_value">%</span>	
												<?php 
												}  
												?>
											</div>	
										</td>
                                        <td>
                                            <div class="input_cost"> 
												<span class="dollar">$</span><span class="total_cost cost_<?php echo $row['id']; ?>"><?php echo number_format($Arraycost[$a], 2, '.', ''); ?></span>
												<input type="text" name="tot_cost[]" class="cost_text_box_<?php echo $row['id']; ?>" value="0" style="display:none;">  
											</div> 
                                        </td>
										<td>
										<div class="input_cost">
										<span class="sg_cal_<?php echo $row['id']; ?> tot_sg_cal"><?php echo number_format($Arrayab_val[$a], 2, '.', ''); ?></span>
										<span class="main_cat_<?php echo $row['id']; ?>" style="display:none;"><?php echo $sg; ?></span>  
										</div> 
										</td>
									</tr>
									<?php 
									$i++; 
									$a++; 
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
										$weightArray=json_decode($weight);
										$ArrayWeight=$weightArray->weight; 
										
										$costArray=json_decode($cost_json);
										$Arraycost=$costArray->cost; 
										
										$ab_valArray=json_decode($ab_val_json);
										$Arrayab_val=$ab_valArray->ab_vol; 
										
										$tot_weight=0;
										foreach($ArrayWeight as $val)
										{
											$tot_weight_str .=number_format($val, 2, '.', '').",";
											$tot_weight=$tot_weight+$val;
										}
										
										$tot_weight_str=substr($tot_weight_str,0,-1);
										
										$tot_cost=0;
										foreach($Arraycost as $val)
										{
											$tot_cost_str .=number_format($val, 2, '.', '').",";
											$tot_cost=$tot_cost+$val;
										}
										
										$tot_cost_str=substr($tot_cost_str,0,-1);
										
										$tot_ab_val=0;
										foreach($Arrayab_val as $val)
										{
											$tot_ab_val_str .=number_format($val, 2, '.', '').",";
											$tot_ab_val=$tot_ab_val+$val;
										} 
										
										$tot_ab_val_str=substr($tot_ab_val_str,0,-1);
										
										?>
                                        <td colspan="4" align="center">
                                            <button class="custom orange" type="submit" name="submit"><i class="fa fa-plus" aria-hidden="true"></i> Save Component</button>
											<img src="<?php echo SITE_URL; ?>assets/images/loader-11.gif" id="cust_job_loader" style="display:none;">
											<input type="hidden" id="total_weight" name="total_weight_1" value="0">
											<input type="hidden" id="total_cost_1" name="total_cost_1" value="0"> 
											
											<input type="hidden" id="new_tot_weight" name="new_tot_weight" value="<?php echo $tot_weight_str; ?>"> 
											<input type="hidden" id="new_tot_cost" name="new_tot_cost" value="<?php echo $tot_cost_str; ?>">  
											<input type="hidden" id="new_tot_ab_val" name="new_tot_ab_val" value="<?php echo $tot_ab_val_str; ?>"> 
											
											<input type="hidden" id="new_total_weight" name="new_total_weight" value="<?php echo $tot_weight; ?>"> 
											<input type="hidden" id="new_total_cost" name="new_total_cost" value="<?php echo $tot_cost; ?>"> 
											<input type="hidden" id="new_total_ab_val" name="new_total_ab_val" value="<?php echo $tot_ab_val; ?>">   
										</td>   

                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table>
												<tbody>
                                                    <tr>
                                                        <td style="text-align: right; width: 50%;color:#2d2d2d;">
                                                             <strong>Total Weight </strong><span class="weight_span"><?php echo $tot_weight; ?></span>
                                                        </td>
                                                        <td style="width: 50%;color:#2d2d2d;">
                                                           <strong>Cost </strong> $<span class="cost_span"><?php echo $tot_cost; ?></span>
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
        </div>
    </div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>	

<?php get_footer(); ?>