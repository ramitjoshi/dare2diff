<?php
$cust_id=get_cust_job_detail($job_id,'cust_id');
$from_date=get_cust_job_detail($job_id,'from_date');
$from_date=date('F j, Y', strtotime($from_date));
$to_date=get_cust_job_detail($job_id,'to_date');
$to_date=date('F j, Y', strtotime($to_date));
?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/js/job.js"></script>
<div class="new_custmer clear"><h4 class="close_title pull-left">CLOSE JOB</h4>
	<a class="close_new pull-right" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>
	
</div>

	
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
		<textarea name="close_notes" id="close_note"></textarea>
	</div>
	
	<div class="close_lst">
		<ul>
			<li>
				<div class="image_clos 1">
					<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
					<div class="content_img">
						
						<div class="btn_cntnt file_custom">
							
							<input type="file" name="file_1" value="Upload" class="filestyle" onchange="readURL(this,1);"> 
						</div>
					</div> 
				</div>
				<div class="imag_info">
					<input type="text" name="caption_1" placeholder="Caption" class="filestyle">
				</div>
			</li>
			<li>
				<div class="image_clos 2">
					<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
					<div class="content_img">
						
						<div class="btn_cntnt file_custom">
							<input type="file" name="file_2" value="Upload" class="filestyle" onchange="readURL(this,2);"> 
						</div>
					</div>
				</div>
				<div class="imag_info">
					<input type="text" name="caption_2" placeholder="Caption">
				</div>
			</li> 
			<li>
				<div class="image_clos 3">
					<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
					<div class="content_img"> 
						
						<div class="btn_cntnt file_custom">
							<input type="file" name="file_3" value="Upload" class="filestyle" onchange="readURL(this,3);">  
						</div> 
					</div>
				</div>
				<div class="imag_info">
					<input type="text" name="caption_3" placeholder="Caption">
				</div>
			</li> 
		</ul>
	</div>
	<div class="closed_by_usr" style="border-top:none;">
		<div class="pull-right">
			<span>Created by <b> <?php echo get_user_detail($_SESSION['user_id'],'first_name'); ?> <?php echo get_user_detail($_SESSION['user_id'],'last_name'); ?></b></span>
			<button name="submit" class="custom" type="submit">Create Job</button>
			<img src="assets/images/loader-11.gif" id="cust_job_loader"style="display:none;" />
		</div> 
	</div>
</form>

</div>
</div>