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
$db = get_connection();
$cust_id=get_cust_job_detail($job_id,'cust_id');
get_header(); 

$check=check_job_closed($job_id);

?>
<?php //echo $_SESSION['user_id']; ?> 
<div class="main display_block">
        <?php get_sidebar(); ?>

        <div class="rt_sidebar pull-left customers_container job_detail">
            <div class="btns_cont">
                <div class="btns_top no_search pull-right">
                    <div class="btns_lft pull-right">
                        <a href="<?php echo SITE_URL; ?>?section=dashboard" class="custom">Dashboard</a>
                        <?php
						if($check==0)
						{	
						?>
							<a href="javascript:void(0);" onclick="close_job_form('<?php echo $_GET['id']; ?>','<?php echo $_SESSION['user_id']; ?>');" class="custom">Close Job</a> 
                        <?php
						}
						?>
						<a href="javascript:void(0);" class="custom" onclick="edit_job_form('<?php echo $job_id; ?>');">Edit Job</a>
                        <a href="<?php echo SITE_URL; ?>?section=new-piece&id=<?php echo $job_id; ?>" class="custom">New Piece</a> 
                         
                    </div>
                    <!--div class="btns_rt pull-right">
                        <!--
						<input type="text" placeholder="Search">
                        <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
					
                    </div--> 
                </div>
            </div> 
			<div id="fromToggle" class="collapsible-area" style="display:none"></div>
            <div class="close_mn display_block job_details">
				
				<div class="close_container">

                    <div class="inner_content">
                        <div class="inner_pdng">
                            <div class="permit_no permit_top clear">
                                <div class="permit_left pull-left">
                                    <h4><?php echo get_cust_job_detail($job_id,'name'); ?></h4>
                                    <p><?php echo get_cust_detail($cust_id,'company'); ?>, <?php echo get_cust_detail($cust_id,'work_add1'); ?></p> 
                                </div>
                                <div class="permit_left permit_right pull-right">
                                    <h5>PO #</h5>
                                    <p><?php echo get_cust_job_detail($job_id,'po'); ?></p>
                                </div>
                            </div>

                            <div class="permit_no permit_bottom clear">
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
										<?php $photo_3=get_cust_job_detail($job_id,'photo_3'); ?>
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
                                       

                                    </li>
                                </ul>

                            </div> 
							 <div class="cust-show-hide-mat"><a class="custom orange mat_sec" href="javascript:void(0);" onclick="show_job_mat(1)">Show Materials</a></div>
                 
							
						<div class="top_cont display_block portland_cont material_list" style="display:none;"> 	
							
							<?php 
								$material=get_cust_job_detail($job_id,'material'); 
								$materialArray=json_decode($material);
								$port=$materialArray->portland_concrete;
								$sand=$materialArray->sand;
								$pigments=$materialArray->pigments;
								$sealer=$materialArray->sealer;
							?>
							<div class="row"> 
								<input type="hidden" id="job_id" value="<?php echo $job_id; ?>" >
								<div class="col-sm-3 col_job">
									<h4>Portland Concrete</h4>
									<ul>
										<?php
										$sql_1="select * from material where category='1'";
										$statement = $db->prepare($sql_1);  	   
										$statement->execute();   
										$result_1=$statement->fetchAll();   
										foreach($result_1 as $row_1)
										{ 
										?>
										<li>
											<input class="mat_check" type="radio" name="portland_concrete" value="<?php echo $row_1['id']; ?>" <?php if($port==$row_1['id']) { echo 'checked'; } ?> onclick="ajax_mat_assign(<?php echo $row_1['id']; ?>)"><label><?php echo $row_1['descp']; ?></label>
										</li>	   
										<?php
										}
										?>
									</ul>
								</div>
								<div class="col-sm-3 col_job">
									<h4>Sand</h4>
									<ul>
										<?php
										$sql_1="select * from material where category='2'";
										$statement = $db->prepare($sql_1);  	   
										$statement->execute();   
										$result_1=$statement->fetchAll();   
										foreach($result_1 as $row_1)
										{ 
										?>
										<li>
											<input class="mat_check" type="radio" name="sand" value="<?php echo $row_1['id']; ?>" <?php if($sand==$row_1['id']) { echo 'checked'; } ?> onclick="ajax_mat_assign(<?php echo $row_1['id']; ?>)"><label><?php echo $row_1['descp']; ?></label>
										</li>	   
										<?php
										}
										?>
									</ul>
								</div>
								<div class="col-sm-3 col_job">
									<h4>Pigments</h4>
									<ul>
										<?php
										$sql_1="select * from material where category='3'";
										$statement = $db->prepare($sql_1);  	   
										$statement->execute();   
										$result_1=$statement->fetchAll();   
										foreach($result_1 as $row_1)
										{ 
										?>
										<li>
											<input class="mat_check" type="radio" name="pigments" value="<?php echo $row_1['id']; ?>" <?php if($pigments==$row_1['id']) { echo 'checked'; } ?> onclick="ajax_mat_assign(<?php echo $row_1['id']; ?>)"><label><?php echo $row_1['descp']; ?></label>
										</li>	   
										<?php
										}
										?>
									</ul>
								</div>
								<div class="col-sm-3 col_job">
									<h4>Sealer</h4>
									<ul>
										<?php
										$sql_1="select * from material where category='4'";
										$statement = $db->prepare($sql_1);  	    
										$statement->execute();   
										$result_1=$statement->fetchAll();   
										foreach($result_1 as $row_1)
										{ 
										?>
										<li>
											<input class="mat_check" type="radio" name="sealer" value="<?php echo $row_1['id']; ?>" <?php if($sealer==$row_1['id']) { echo 'checked'; } ?> onclick="ajax_mat_assign(<?php echo $row_1['id']; ?>)"><label><?php echo $row_1['descp']; ?></label> 
										</li>	   
										<?php
										}
										?>
									</ul>
								</div>
								
							</div>
						</div>       
						<?php
						$sql_1="select * from job_piece where job_id='".$job_id."'";
						$statement = $db->prepare($sql_1);  	   
						$statement->execute();   
						$count=$statement->rowCount(); 
						if($count > 0)
						{	
						?>
						<div class="close_lst">
							<ul>
								<?php
								$result=$statement->fetchAll(); 
								foreach($result as $row)
								{
									$status=$row['status'];
								?>
								<li class="piece_<?php echo $row['id']; ?>">
									<div class="image_clos">
										<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
										<div class="content_img">
											<h5><?php echo $row['piece_name']; ?></h5>
											<div class="btn_cntnt">
												<?php
												if($status==1)
												{
												?>
												<a class="custom bg_trans" href="javascript:void(0);" onclick="lock_unlock('<?php echo $row['id']; ?>','0');">Lock</a>
												<?php 
												}
												else
												{
												?>
												<a class="custom bg_trans" href="javascript:void(0);" onclick="lock_unlock('<?php echo $row['id']; ?>','1');">Un Lock</a>
												<?php	
												}	 
												?>
											</div>  
										</div>
										
									</div>
									<div class="imag_info">
										<?php
										if($status==1)
										{
										?>
										<a href="<?php echo SITE_URL; ?>?section=edit-piece&id=<?php echo $job_id; ?>&pr_id=<?php echo $row['id']; ?>" class="img_btn">Edit</a>
										<?php
										}
										else
										{
										?>	
										<a href="<?php echo SITE_URL; ?>?section=view-piece&id=<?php echo $job_id; ?>&pr_id=<?php echo $row['id']; ?>" class="img_btn">View</a>
										<?php
										}	
										?>
										<a href="javascript:void(0);" class="img_btn" onclick="del_piece('<?php echo $row['id']; ?>');">Delete</a>
										<a href="<?php echo SITE_URL; ?>piece_report.php?job_id=<?php echo $job_id; ?>&piece_id=<?php echo $row['id']; ?>" target="_blank" class="img_btn">Print</a> 
									</div>  
								</li> 
								<?php
								}
								?>
							</ul>

						</div>
						<?php
						}
						?>
						</div>
                    </div>
                </div>
				
			</div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/customer.js"></script>		
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>		
<?php get_footer(); ?>