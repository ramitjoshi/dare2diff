<?php 
if(!isset($_SESSION['user_id']))
{
?>
<script>window.location.href="<?php echo SITE_URL; ?>?section=login";</script>
<?php
die;
}
?>	
<?php 
$db = get_connection();
get_header(); ?> 
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
                    <?php
					if($user_role=="admin")
					{
					?>		
						<a href="javascript:void(0);" class="custom" onclick="show_vendor_form();">New Vendor</a> 
                    <?php
					} 
					?>
					
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
					$sql="select * from vendor";
					$statement = $db->prepare($sql); 	
					$statement->execute();  
					$count_staff=$statement->rowCount();   
					$result=$statement->fetchAll();   
					if($count_staff==0)
					{	
					?>
						<div class="alert alert-danger">No vendor found</div>
					<?php
					}
					else
					{	
					?>
                    <table class="table <?php if($user_role=="staff") { echo 'cstm-mobile'; } ?>" id="vendor-table">
                        <thead> 
                            <tr> 
                                <th style="width: 35px;"></th>
                                <th style="width: 196px;">Name</th>
                                <th style="width: 376px;">Email Address</th>
                                <th style="width: 245px;" class="<?php if($user_role=="staff") { echo 'telephone'; } ?>">Telephone</th>
                                <th style="text-align: center; width: 101px;"></th>
                                <th style="text-align: center; width: 101px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							foreach($result as $row)
							{ 
							?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $row['name']; ?></td>
                                <td><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td style="text-align: right;padding-right: 7px;">
								<?php
								if($user_role=="admin")
								{
								?>
								<a href="javascript:void(0);" class="custom edit_cstm custom_table" onclick="edit_user_vendor('<?php echo $row['id']; ?>')">Edit</a>
								<?php 
								}
								?>
								</td>
								<td style="text-align: right;padding-right: 12px;"><a href="javascript:void(0);" class="custom edit_cstm custom_table" onclick="get_vendor_info('<?php echo $row['id']; ?>')">View</a></td>
								
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
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/vendor.js"></script> 
<script>
jQuery(document).ready(function()
{
	jQuery(document).ready(function() { 
		jQuery('#vendor-table').DataTable();
		
		var search=jQuery('.dataTables_filter').find('input');
		jQuery('#search-box').empty().append(search);
		jQuery('#search-box').find('input').attr('placeholder','Search');
		jQuery('.dataTables_filter').remove();
	});  
	
}); 
</script> 
<?php get_footer(); ?>