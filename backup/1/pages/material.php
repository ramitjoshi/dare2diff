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
                <div class="btns_top no_search pull-right"> 
                    <div class="btns_lft pull-right">
                        <a href="javascript:void(0);" class="custom" onclick="<?php echo SITE_URL; ?>">Dashboard</a>
						<a href="javascript:void(0);" class="custom" onclick="show_material_form();">New Material</a>
						
                    </div>
                    <!--div class="btns_rt pull-right">
                        <!--
						<input type="text" placeholder="Search">
                        <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
					
                    </div--> 
                </div>
            </div> 
			<div id="fromToggle" class="collapsible-area" style="display:none"></div>
            <div class="close_mn display_block create_piece">
            <div class="edit_table staff">
				<div class="material_cont">
					<h2>MATERIAL</h2>
					
					<div class="table_piece">
						<?php
						$sql="select * from material";
						$statement = $db->prepare($sql); 	
						$statement->execute();   
						$result=$statement->fetchAll();   
						$count=$statement->rowCount();   
						if($count > 0)
						{	
						?>
						<table>
							<thead>
								<tr>
									<th style="width: 29.33%;">Description</th>
									<th style="width: 34.33%;">Vendor</th>
									<th style="width: 26.33%;">Category</th>
									<th style="width: 24.33%;">Measurement</th>
									<th style="width: 17.33%;">Price</th>
									<th style="width: 19.33%;">&nbsp;</th>
								</tr>

							</thead>
							<tbody>
								<?php
								foreach($result as $row)
								{
									$vendor_id=$row['vendor'];
									$mat_cat_id=$row['category'];
									$price=$row['price'];									if($price=="")									{										$price=0;									}	
									$price=number_format($price, 2, '.', '');
								?>
								<tr>
									<td><?php echo $row['descp']; ?></td>
									<td><?php echo get_vendor_info($vendor_id,'name'); ?></td>
									<td><?php echo get_material_cat_info($mat_cat_id,'name'); ?></td>
									<td><?php echo $row['weight']; ?></td> 
									<td>$<?php echo $price; ?></td>
								
									<td><a class="custom bg" href="javascript:void(0);" onclick="edit_material_form('<?php echo $row['id']; ?>')">Edit</a></td>
								</tr> 
								<?php
								}
								?>
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="material_cont mat_cat_list">
					<h2>MATERIAL CATEGORIES</h2> 
						<?php
						}
						?>
						<?php
						$sql="select * from material_category where status='1'";
						$statement = $db->prepare($sql); 	
						$statement->execute();   
						$result=$statement->fetchAll();   
						$count=$statement->rowCount();   
						if($count > 0)
						{	
						?>
						<table>
							<thead>
								<tr>
									<th style="width: 18.33%;">Description</th>
									<th style="width: 21.33%;">Vendor</th>
									<th style="width: 23.33%;">Category</th>
									<th style="width: 24.33%;">Measurement</th>
									<th style="width: 25.33%;">Price</th>
									<th style="width: 24.33%;">&nbsp;</th>
								</tr>

							</thead>
							<tbody>
								<?php
								foreach($result as $row)
								{
									 
									$mat_cat_id=$row['id'];
									$price=$row['price'];
									$price=number_format($price, 2, '.', '');
								?>
								<tr>
									<td> - </td>
									<td> - </td>
									<td><?php echo $row['name']; ?></td>
									<td> - </td>
									<td>$<?php echo $price; ?></td> 
								
									<td><a class="custom bg" href="javascript:void(0);" onclick="show_editmaterial_form('<?php echo $row['id']; ?>')">Edit</a></td>
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
    </div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/material.js"></script>	 	
<?php get_footer(); ?>