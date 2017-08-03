<?php 
$db = get_connection();
get_header(); 

$job_id=$_GET['id'];

$cust_id=get_cust_job_detail($job_id,'cust_id');
$from_date=get_cust_job_detail($job_id,'from_date');
$from_date=date('F j, Y', strtotime($from_date));
$to_date=get_cust_job_detail($job_id,'to_date');
$to_date=date('F j, Y', strtotime($to_date));
?>
 <div class="main display_block">
        <?php get_sidebar(); ?>

        <div class="rt_sidebar pull-left">
            <div class="btns_cont">
                <div class="btns_top pull-right no_search">
                    <div class="btns_lft pull-left">
                        <a href="<?php echo SITE_URL; ?>" class="custom">Dashboard</a>
						<a href="javascript:void(0);" class="custom" onclick="show_job_form();">New Job</a>
						<a href="javascript:void(0);" class="custom" onclick="show_customer_form();">New Customer</a>
                    </div>
                   
                </div>
            </div>
			
			<div id="fromToggle" class="collapsible-area" style="display:none"></div>
			
            <div class="close_mn display_block">
				<div class="inner_content">
					<div class="title_head">
							<h5 class="pull-left"><?php echo get_cust_job_detail($job_id,'name'); ?></h5>
							<span class="date pull-right"><?php echo $from_date; ?> - <?php echo $to_date; ?></span>
					</div>
					<div class="inner_pdng"> 
						<form name="close_job" id="close_job" action="" method="post" class="new_job"> 
						<input type="hidden" name="job_id" value="<?php echo $job_id ?>">
						<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
						<input type="hidden" name="action" value="CloseJob">
						<div class="notifictn_no display_block">
							<div class="notfctn_info pull-left">
								<strong><?php echo get_cust_job_detail($job_id,'id'); ?></strong>
								<p><?php echo get_cust_detail($cust_id,'company'); ?>  - <?php echo get_cust_detail($cust_id,'work_add1'); ?>    </p>
							</div>
							<div class="ntfctn_btn pull-right">
								<input placeholder="Permit Notification Number" name="pr_num" type="text">
							</div>
						</div>	 
						
						<div class="closing_nts_cont">
							<h5>Closing Notes</h5>
							<textarea name="close_notes" id="close_note"><?php echo get_close_job_detail($job_id,'close_notes'); ?></textarea>
						</div>
						
						<div class="close_lst">
							<ul>
								<li>
									<?php $photo_1=get_close_job_detail($job_id,'photo_1'); ?>
									<div class="image_clos 1">
										<?php
										if($photo_1!="")
										{	
										?>
											<img src="<?php echo SITE_URL; ?>close_job/thumb.php?src=<?php echo $photo_1; ?>&w=320&h=250">
										<?php
										}
										else 
										{	
										?>
											<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
										<?php
										}
										?>
										
									</div>
									<div class="imag_info">
										<p><?php echo get_close_job_detail($job_id,'caption_1'); ?></p>
									</div>
								</li>
								<li>
									<?php $photo_2=get_close_job_detail($job_id,'photo_2'); ?>
									<div class="image_clos 1">
										<?php
										if($photo_2!="")
										{	
										?>
											<img src="<?php echo SITE_URL; ?>close_job/thumb.php?src=<?php echo $photo_2; ?>&w=320&h=250">
										<?php
										}
										else
										{	
										?>
											<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
										<?php
										}
										?>
										
									</div>
									<div class="imag_info">
										<p><?php echo get_close_job_detail($job_id,'caption_2'); ?></p>
									</div>
								</li>
								<li>
									<?php $photo_3=get_close_job_detail($job_id,'photo_3'); ?>
									<div class="image_clos 1">
										<?php
										if($photo_3!="")
										{	
										?>
											<img src="<?php echo SITE_URL; ?>close_job/thumb.php?src=<?php echo $photo_3; ?>&w=320&h=250"> 
										<?php
										}
										else
										{	
										?>
											<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
										<?php
										}
										?>
										
									</div>
									<div class="imag_info">
										<p><?php echo get_close_job_detail($job_id,'caption_3'); ?></p>
									</div>
								</li>
							</ul>
						</div>
						<!--
						<div class="closed_by_usr" style="border-top:none;">
							<div class="pull-right">
								<span>Created by <b> <?php echo get_user_detail($_SESSION['user_id'],'first_name'); ?> <?php echo get_user_detail($_SESSION['user_id'],'last_name'); ?></b></span>
								<button name="submit" class="custom" type="submit">Create Job</button>
								<img src="assets/images/loader-11.gif" id="cust_job_loader"style="display:none;" />
							</div> 
						</div>
						-->
					</form>

					</div>
					</div>


            </div>
        </div>
    </div> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/customer.js"></script>		
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>	
 
<?php get_footer(); ?>