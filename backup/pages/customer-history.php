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
<?php $cust_id=$_GET['id']; ?>
<?php 
$user_role=get_user_detail($_SESSION['user_id'],'role');  
?> 
 <div class="main display_block">
        <?php get_sidebar(); ?>

        <div class="rt_sidebar pull-left">
            <div class="btns_cont">
                <div class="btns_top pull-right">
                    <div class="btns_lft pull-left">
                        <a href="<?php echo SITE_URL; ?>?section=dashboard" class="custom">Dashboard</a>
                        <a href="javascript:void(0);" class="custom" onclick="edit_user_customer('<?php echo $cust_id; ?>');">Edit Customer</a>
                    </div>
                    <div class="btns_rt pull-right" id="search-box">
                        <input type="text" placeholder="Search">
                       
                    </div>
                </div>
            </div>
			
			<div id="fromToggle" class="collapsible-area" style="display:none"></div>
			<div class="close_container custmr_edt_cnt cstmr_histry">
<div class="customers_container view_cstmr">
            <div class="close_mn display_block">
				<div class="cstm-wid top_inpt edit_table vndr_cnt">
				<?php
				$sql="select * from customer where id='".$cust_id."'";
				$statement = $db->prepare($sql);   	
				$statement->execute();       
				$result=$statement->fetchAll();        
				foreach($result as $row)
				{	
				?>
				<table class="table">
					<thead> 
						<tr>
							<th style="width: 3%;"></th>
							<th style="width: 18%;">First Name</th>
							<th style="width: 19%;">Last Name</th>
							<th style="width: 35%;">Email Address</th>
							<th style="width: 15%;">Telephone</th>
							<th style="text-align: center; width: 10%;"></th>
						</tr>
					</thead>
					<tbody>
					<td colspan="6" class="internal-table">
						<table class="table brdr brdr_none margin_non">
							<tbody>
								<tr>
									<td style="width: 3%;"></td>
									<td style="width: 18%;"><?php echo $row['first_name']; ?></td>
									<td style="width: 19%;"><?php echo $row['last_name']; ?></td>
									<td style="width: 35%;"><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></td>
									<td style="width: 15%;"><?php echo $row['mobile_phone']; ?></td>
									<td style=" width: 10%;"></td>

								</tr>

								<tr>
									<td colspan="6" class="internal-table">
										<table class="table">
											<tbody>
												<tr class="vrtcl_top">
													<td style="width: 3%;"></td>
													<td style="width: 18%;">
														<strong>Telephone</strong>
														<span><?php echo $row['mobile_phone']; ?> </span>
														<span><?php echo $row['home_phone']; ?>  </span>
														<span><?php echo $row['work_phone']; ?> </span>
													</td>
													<td style="width: 19%;">
														<strong>Work or Home </strong>
														<!--<span><?php echo $row['work_name']; ?></span>-->
														<span><?php echo $row['work_add1']; ?></span>
														<span><?php echo $row['work_add2']; ?></span>
														<span><?php echo $row['work_city']; ?></span>
														<span><?php echo $row['work_prov']; ?></span>
														<span><?php echo $row['work_post_code']; ?></span>
													 
														
														<span><?php echo $row['home_add1']; ?></span>
														<span><?php echo $row['home_add2']; ?></span>
														<span><?php echo $row['home_city']; ?></span>
														<span><?php echo $row['home_prov']; ?></span>
														<span><?php echo $row['home_post_code']; ?></span>
														
														</td>
													
													<td style="width: 20%;"><strong>Cottage</strong>
													
												
													</td>
													
													<td style="width: 30%;"><strong>Notes </strong>
														<span><?php echo $row['note']; ?></span></td>
														<td style=" width: 10%;"></td>
													
												</tr>
											</tbody>
										</table>
									</td>
								</tr>

							</tbody>
						</table> 

					</td>
					
					</tbody>
				</table>
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
<script>
jQuery(document).ready(function()
{
	jQuery(document).ready(function() { 
		jQuery('#customer-table').DataTable();
		
		var search=jQuery('.dataTables_filter').find('input');
		jQuery('#search-box').empty().append(search);
		jQuery('#search-box').find('input').attr('placeholder','Search');
		jQuery('.dataTables_filter').remove();
	}); 
	
}); 
</script>	 
<?php get_footer(); ?>