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
 <div class="main display_block">
        <?php get_sidebar(); ?>

        <div class="rt_sidebar pull-left">
            <div class="btns_cont">
                <div class="btns_top pull-right no_search">
                    <div class="btns_lft pull-left">
                        <a href="<?php echo SITE_URL; ?>?section=dashboard" class="custom">Dashboard</a>
                        <a href="javascript:void(0);" class="custom" onclick="show_customer_form();">New Customer</a>
                    </div>
                    <div class="btns_rt pull-right" id="search-box">
                        <input type="text" placeholder="Search">
                       
                    </div>
                </div>
            </div>
			
			<div id="fromToggle" class="collapsible-area" style="display:none"></div>
			
            <div class="close_mn display_block">
				<div class="edit_table staff">
					<?php
					$sql="select * from customer";   
					$statement = $db->prepare($sql); 	
					$statement->execute();  
					$count_cust=$statement->rowCount();   
					$result=$statement->fetchAll();   
					if($count_cust==0)
					{	
					?>
					<div class="alert alert-danger">No customer found</div>
					<?php
					} 
					else
					{	
					?>
                    <table class="table" id="customer-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Company Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Telephone</th>
                                <th style="text-align: center;"></th>
                                <th style="text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							foreach($result as $row)
							{
								$company=$row['company'];
								$name=$row['first_name'].' '.$row['last_name'];
								if($row['work_phone']!="") 
								{
									$phone=$row['work_phone'];
								}	
								else if($row['home_phone']!="")
								{
									$phone=$row['home_phone'];
								}	
								else
								{
									$phone=$row['mobile_phone'];
								}
								
								if($company!='')
								{
									$asd=$company;
								}
								else
								{
									$asd=$name;
								}		
								
								
							?>
							<tr>
                                <td></td>
                                <td><?php echo $asd; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></td>
                               <td><?php echo $phone; ?></td>
                                <td><a class="custom edit_cstm" href="javascript:void(0);" onclick="edit_user_customer('<?php echo $row['id']; ?>');">Edit</a></td>
                                <td><a href="javascript:void(0);" class="custom edit_cstm custom_table" onclick="get_cust_info('<?php echo $row['id']; ?>')">View</a></td> 
                            </tr>  
							<?php
							}
							?>
                        </tbody>
                    </table>
					<?php
					}
					?>
                </div>


            </div>
        </div>
    </div>  
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/customer.js"></script>	
<script>
jQuery(document).ready(function()
{
	jQuery(document).ready(function() { 
		jQuery('#customer-table-1').DataTable();
		
		var search=jQuery('.dataTables_filter').find('input');
		jQuery('#search-box').empty().append(search);
		jQuery('#search-box').find('input').attr('placeholder','Search');
		jQuery('.dataTables_filter').remove();
	}); 
	
}); 
</script>	 
<?php get_footer(); ?>