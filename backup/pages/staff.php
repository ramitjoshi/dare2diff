<?php 
$db = get_connection();
get_header(); ?> 
 <div class="main display_block">
        <?php get_sidebar(); ?>

        <div class="rt_sidebar pull-left">
            <div class="btns_cont">
                <div class="btns_top pull-right">
                    <div class="btns_lft pull-left">
                        <a href="<?php echo SITE_URL; ?>?section=dashboard" class="custom">Dashboard</a>
                        <a href="javascript:void(0);" class="custom" onclick="show_staff_form();">New Staff Member</a>
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
					$sql="select * from users where id!=1 order by first_name asc";   
					$statement = $db->prepare($sql); 	
					$statement->execute();  
					$count_staff=$statement->rowCount();   
					$result=$statement->fetchAll();   
					if($count_staff==0)
					{	
					?>
					<div class="alert alert-danger">No staff found</div>
					<?php
					}
					else
					{	
					?>
                    <table class="table" id="staff-table">
                        <thead>
                            <tr>
                                <th style="width: 35px;"></th>
                                <th style="width: 196px;">First Name</th>
                                <th style="width: 253px;">Last Name</th>
                                <th style="width: 376px;">Email Address</th>
                                <th style="width: 245px;">Role</th>
                                <th style="text-align: center; width: 101px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							foreach($result as $row)
							{
							?>
							<tr>
                                <td></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['role']; ?></td> 
                                <td><a class="custom edit_cstm" href="javascript:void(0);" onclick="edit_user_staff('<?php echo $row['id']; ?>');">Edit</a></td>
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
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/staff.js"></script>
<script>
jQuery(document).ready(function()
{
	jQuery(document).ready(function() {
		jQuery('#staff-table').DataTable();
		
		var search=jQuery('.dataTables_filter').find('input');
		jQuery('#search-box').empty().append(search);
		jQuery('#search-box').find('input').attr('placeholder','Search');
		jQuery('.dataTables_filter').remove();
	}); 
	
});
</script>	 
<?php get_footer(); ?>