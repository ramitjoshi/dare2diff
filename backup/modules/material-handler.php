<?php
require_once  '../setup.php'; 
$action=$_REQUEST['action'];

//get requested action
if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
   $action = $_REQUEST['action'];
   call_user_func($action);
}



 
function ShowMaterialForm()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/material.js"></script>   
<div class="new_custmer clear"><h4 class="close_title pull-left">NEW MATERIAL</h4>
	<a class="close_new pull-right" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>
</div>
<div class="inner_content">
	<div class="inner_pdng">
		<div class="material_option">
			
				<form name="add_material" class="water_width" id="add_material" action="" method="post">
				<input type="hidden" name="action" value="AddMaterial">								
				<div class="mat_cat"> 
					<select name="vendor">
						<option value="">Vendor</option>
						<?php
						$sql="select * from vendor order by name asc";
						$statement = $db->prepare($sql);	
						$statement->execute(); 
						$result=$statement->fetchAll(); 
						foreach($result as $row)
						{
						?>
							<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="cat_cat">
					<select name="mat_cat" onchange="check_water();">
						<option value="">Category</option>
						<?php
						$sql="select * from material_category";
						$statement = $db->prepare($sql);	
						$statement->execute(); 
						$result=$statement->fetchAll(); 
						foreach($result as $row)
						{
						?>
							<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="text_mat water-sec">
					<input type="text" name="water" placeholder="Water" disabled  > 
				</div>
				<div class="text_mat desc">
					<input type="text" name="descp" placeholder="Description" >
				</div>					
				<div class="text_mat">					
				<input type="text" name="price" placeholder="Price" >				
				</div>
				<div class="radio_cont">
				<div class="radio_mat">			
				<ul>					
				<li>							
				<input type="radio" name="weight" value="lb" checked>				
				<label>lb</label>   
				</li>					
				<li>			
				<input type="radio" name="weight" value="g">						
				<label>g</label> 		
				</li>					
				<li>		
				<input type="radio" name="weight" value="ml">					
				<label>ml</label> 			
				</li>									
				</ul>		
				</div>
				<div class="save_btn">
					<button type="submit" name="submit" class="custom orange">Save</button>
					<img src="<?php SITE_URL;?>assets/images/loader-11.gif" id="cust_job_loader" style="display:none;"/>
				</div> 				</div> 
				</form>
	
		</div>		
	</div>
</div>
<?php	
}  

function AddMaterial()
{ 
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$cr_date=date("Y-m-d H:i:s");  
	$vendor=mysql_real_escape_string($_REQUEST['vendor']);  
	$mat_cat=mysql_real_escape_string($_REQUEST['mat_cat']);
	$descp=mysql_real_escape_string(trim($_REQUEST['descp']));
	$weight=mysql_real_escape_string(trim($_REQUEST['weight']));
	$price=mysql_real_escape_string(trim($_REQUEST['price']));  
	$water=mysql_real_escape_string(trim($_REQUEST['water']));  
	
	$sql="insert into material (vendor,category,weight,water,descp,price,cr_date,status) values ('".$vendor."','".$mat_cat."','".$weight."','".$water."','".$descp."','".$price."','".$cr_date."','1')"; 
	$statement = $db->prepare($sql); 	
	$statement->execute();    
	echo "1";
}

function EditMaterialForm()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
	$mat_id=$_REQUEST['mat_id'];
	$vendor_id=get_material_info($mat_id,'vendor');
	$cat_id=get_material_info($mat_id,'category');
	$weight=get_material_info($mat_id,'weight');
	$descp=get_material_info($mat_id,'descp');
	$price=get_material_info($mat_id,'price');
	$water=get_material_info($mat_id,'water');
?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/material.js"></script>   
<div class="new_custmer clear"><h4 class="close_title pull-left">EDIT MATERIAL</h4>
	<a class="close_new pull-right" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a> 
</div>
<div class="inner_content"> 
	<div class="inner_pdng">
		<div class="material_option">
	
				<form name="edit_material" id="add_material" action="" method="post">
				<input type="hidden" name="mat_id" value="<?php echo $mat_id; ?>">
				<input type="hidden" name="action" value="EditMaterial">
				<div class="mat_cat">  
					<select name="vendor">
						<option value="">Vendor</option>
						<?php
						$sql="select * from vendor order by name asc";
						$statement = $db->prepare($sql);	
						$statement->execute(); 
						$result=$statement->fetchAll(); 
						foreach($result as $row)
						{
						?>
							<option value="<?php echo $row['id']; ?>" <?php if($vendor_id==$row['id']) { echo 'selected'; } ?>><?php echo $row['name']; ?></option>
						<?php 
						}
						?>
					</select> 
				</div>
				<div class="cat_cat">
					<p><?php echo get_material_cat_info($cat_id,'name'); ?></p>
					
				</div>
				 
				<div class="text_mat water-sec">	
					<input type="text" name="water" placeholder="Water" value="<?php echo $water; ?>" <?php if($water=="") { echo 'disabled'; } ?> >
				</div>   
				
				<div class="text_mat desc">
					<input type="text" name="descp" placeholder="description" value="<?php echo $descp; ?>" <?php if($descp=="") { echo 'disabled'; } ?> >
				</div>
				
				<div class="text_mat"> 
				<input type="text" name="price" placeholder="Price" value="<?php echo $price; ?>" > </div>
				<div class="radio_cont">
				   <div class="radio_mat">
					  <ul>
						 <li>							
						 <input type="radio" name="weight" value="lb" <?php if($weight=="lb") { echo "checked"; } ?>><label>lb</label>   						
						 </li>
						 <li>							
						 <input type="radio" name="weight" value="g" <?php if($weight=="g") { echo "checked"; } ?>><label>g</label> 						
						 </li>
						 <li>						
						 <input type="radio" name="weight" value="ml" <?php if($weight=="ml") { echo "checked"; } ?>><label>ml</label> 						
						 </li>
					  </ul>
				   </div>
				   <div class="save_btn"> <button type="submit" name="submit" class="custom orange">Save</button> <img src="<?php SITE_URL;?>assets/images/loader-11.gif" id="cust_job_loader" style="display:none;"/> </div>
				</div>
				</form>
			
		</div>		
	</div>
</div>
<?php	
}




function EditMaterial()
{ 
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$cr_date=date("Y-m-d H:i:s");  
	$mat_id=$_REQUEST['mat_id'];  
	$vendor=mysql_real_escape_string($_REQUEST['vendor']);  
	$mat_cat=mysql_real_escape_string($_REQUEST['mat_cat']);
	$descp=mysql_real_escape_string(trim($_REQUEST['descp']));
	$weight=mysql_real_escape_string(trim($_REQUEST['weight']));
	$price=mysql_real_escape_string(trim($_REQUEST['price']));  
	$water=mysql_real_escape_string(trim($_REQUEST['water']));  
	
	$sql="update material set vendor='".$vendor."',category='".$mat_cat."',weight='".$weight."',water='".$water."',descp='".$descp."',price='".$price."' where id='".$mat_id."'"; 
	$statement = $db->prepare($sql); 	
	$statement->execute();    
	echo "1"; 
}


function CatPriceForm()
{
	$db = get_connection();  
	unset($_REQUEST['action']);
	$cat_id=$_REQUEST['cat_id'];
?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/material.js"></script>   
<div class="new_custmer clear"><h4 class="close_title pull-left">EDIT PRICE</h4>
	<a class="close_new pull-right" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a> 
</div>
<div class="inner_content"> 
	<div class="inner_pdng"> 
		<div class="material_option clear">
			<form name="cat_price" id="cat_price" action="" method="post">
				<input type="hidden" name="action" value="EditCarPrice">
				<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
				<?php
				$sql="select * from material_category where id='".$cat_id."'";
				$statement = $db->prepare($sql); 	
				$statement->execute();  
				$result=$statement->fetchAll();  	
				foreach($result as $row)
				{ 
				?> 
				<div class="col_new"> 
				<div class="cat_tble">
					<p><?php echo get_material_cat_info($row['id'],'name'); ?></p>
				</div> 
				<div class="cat_right">	
					<input type="text" name="price" placeholder="Price" value="<?php echo $row['price']; ?>" >
				</div>  
				</div>  
				<?php
				}
				?>
				<div class="save_btn pull-right"> 
					<button type="submit" name="submit" class="custom orange">Save</button> <img src="<?php SITE_URL;?>assets/images/loader-11.gif" id="cust_job_loader" style="display:none;"/> 
				</div>
				</div>
			</form>
		</div>		
	</div>
</div>
<?php	
}

function EditCarPrice()
{
	$db = get_connection();  
	unset($_REQUEST['action']);
	$price_var=$_REQUEST['price'];
	$cat_id=$_REQUEST['cat_id'];
	
	$sql="update material_category set price='".$price_var."' where status='1' and id='".$cat_id."'";
	$statement = $db->prepare($sql); 	
	$statement->execute();    
	echo "1"; 
}

?>	
	