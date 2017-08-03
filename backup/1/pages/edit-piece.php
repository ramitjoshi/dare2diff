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

get_header(); 
?>

<?php
$sql="select SUM(total_weight) 'total_weight' from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."'";
$statement = $db->prepare($sql);  	   
$statement->execute(); 
$result=$statement->fetchAll(); 
foreach($result as $row)
{
	$toto_wgt=$row['total_weight'];
}

$sql="select SUM(total_cost) 'total_cost' from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."'";
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


<?php //echo $_SESSION['user_id']; ?> 
<div class="main display_block">
        <?php get_sidebar(); ?>

        <div class="rt_sidebar pull-left customers_container">
            <div class="btns_cont">
                <div class="btns_top pull-right">
                    <div class="btns_lft pull-right">
                        
						<a href="<?php echo SITE_URL; ?>?section=job-detail&id=<?php echo $job_id; ?>" class="custom">Back</a>
						<a href="<?php echo SITE_URL; ?>?section=dashboard" class="custom">Dashboard</a> 
						<a href="javascript:void(0);" onclick="edit_piecee('<?php echo $piece_id; ?>');" class="custom">Edit Piece</a>  
                       
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
                                    <h5>Total Cost</h5>
                                    <p>$<?php echo number_format($toto_cost, 2, '.', '');; ?></p>
                                </div>
								<div class="permit_left pull-right permit_right">
                                    <h5>Total Weight</h5>
                                    <p><?php echo $toto_wgt; ?></p>
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
								<div class="permit_left pull-left">
                                    <h4>Piece</h4>
                                    <p><?php echo get_peice_info($piece_id,'piece_name'); ?></p> 
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
						
                    </div>
                </div>
			</div>
			
			
			<div class="close_mn display_block">
				<div class="close_container">
				<div class="inner_content">
				<div class="inner_pdng">
				<div class="edit_table vndr_cnt customrs_cont comp_cst">
				<h4 class="title_main">Active Components</h4>
					<div class="responisve_table comp_table">
					<?php
					$sql="select * from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."' ";
					$statement = $db->prepare($sql); 	
					$statement->execute();   
					$result=$statement->fetchAll(); 
					foreach($result as $row)
					{ 
						$activeArray[]=$row['component'];
					}
					
					
					
					?>
					
					<table class="table">
						<thead>
							<tr>
								
								<th style="width: 19%;">Recipe Components</th>
								<th style="text-align: center; width: 10%;"></th>
							</tr> 
						</thead>
						<tbody>
							<?php
							$sql="select * from recipe_components ";
							$statement = $db->prepare($sql); 	
							$statement->execute();   
							$result=$statement->fetchAll(); 
							foreach($result as $row)
							{ 
							?>
							<tr>
								
								<td><?php echo $row['name']; ?></td>  
								<td align="right">
								<?php
								if (in_array($row['id'], $activeArray)) {
								?>
								<a class="custom edit_cstm" href="javascript:void(0);" onclick="edit_component('<?php echo $job_id ?>','<?php echo $piece_id; ?>','<?php echo $row['id']; ?>');">Edit</a>
								
								<?php
								}
								else
								{
								?>
								<a class="custom edit_cstm" href="javascript:void(0);" onclick="add_component('<?php echo $job_id ?>','<?php echo $piece_id; ?>','<?php echo $row['id']; ?>');">Add</a>
								<?php	
								}
								?>	
								</td>
							</tr> 
							<?php
							}
							?>
						</tbody>
					</table>
					
					</div>
				</div>
				</div>
				</div>
				</div>
			</div>
			
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