<?php 
if(!isset($_SESSION['user_id']))
{
?>
<script>window.location.href="<?php echo SITE_URL; ?>?section=login";</script>
<?php
die;
}
$db = get_connection();
get_header(); ?>
<?php //echo $_SESSION['user_id']; ?> 
<div class="main display_block">
        <?php get_sidebar(); ?>

        <div class="rt_sidebar pull-left customers_container">
            <div class="btns_cont">
                <div class="btns_top pull-right no_search">
                    <div class="btns_lft pull-right">
                         <a href="javascript:void(0);" class="custom" onclick="<?php echo SITE_URL; ?>">Dashboard</a>
						<a href="javascript:void(0);" class="custom" onclick="show_job_form();">New Job</a>
                       
                    </div>
                    <!--div class="btns_rt pull-right">
                        <!--
						<input type="text" placeholder="Search">
                        <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
						
                    </div--> 
                </div>
            </div> 
			<div id="fromToggle" class="collapsible-area" style="display:none"></div>
            <div class="close_mn display_block">
				
				<div class="edit_table vndr_cnt customrs_cont">
				<h4 class="title_main">Active Jobs</h4>
                    <?php
					$job_open="select * from customer_job where status='1' ORDER BY id DESC";
					$statement = $db->prepare($job_open); 	
					$statement->execute();    
					$result=$statement->fetchAll();   
					$count_opn_job=$statement->rowCount();   
					if($count_opn_job > 0)
					{	
					?>
					<table class="table">
                        <thead>
                            <tr>
                               
                                <th style="width: 19%;">Job Name</th>
                                <th style="width: 19%;">Customer Name</th>
                                <th style="width: 13%;">Days Left</th>
                                <th style="width: 15%;">Active Step</th>
                                <th style="text-align: center; width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							foreach($result as $row)
							{
								$date1 = date("Y-m-d");
								$date2 = $row['to_date'];
								if($date1 < $date2)
								{
									if($date1 > $date2){
										$days_left=0;
									}
									else{	
										$date1Timestamp = strtotime($date1);
										$date2Timestamp = strtotime($date2);
										$difference = $date2Timestamp - $date1Timestamp;
										$days_left= floor($difference/86400);						
									}
								}else{
									$days_left='0';
								}
							?>
							<tr>
                               
                                <td><?php echo get_cust_job_detail($row['id'],'name'); ?></td>
                                <td><?php echo get_cust_detail($row['cust_id'],'company'); ?></td> 
                                <td><?php echo $days_left; ?> Days</td>
                                <td>Step</td>  
                                <td><a class="custom edit_cstm" href="<?php echo SITE_URL; ?>?section=job-detail&id=<?php echo $row['id']; ?>">View</a></td>
                            </tr>
							<?php
							}
							?>
						</tbody>
                    </table>
					<?php
					}
					else{ 
					?>
						<div class="alert alert-danger">No record found</div>
					<?php
					}	
					?>
				</div>
			</div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/customer.js"></script>		
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>		
<?php get_footer(); ?>