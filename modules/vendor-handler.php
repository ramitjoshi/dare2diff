<?php
require_once  '../setup.php';
$action=$_REQUEST['action'];

//get requested action
if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
   $action = $_REQUEST['action'];
   call_user_func($action);
}


function AddVendor()
{ 
	$db = get_connection(); 
	unset($_REQUEST['action']);
	$name=mysql_real_escape_string($_REQUEST['name']);
	$email=$_REQUEST['email'];
	$phone=mysql_real_escape_string($_REQUEST['phone']);
	$address=mysql_real_escape_string($_REQUEST['address']);
	$city=mysql_real_escape_string($_REQUEST['city']);
	$prov=mysql_real_escape_string($_REQUEST['prov']);
	$post_code=mysql_real_escape_string($_REQUEST['post_code']);

	$check_email="select id from vendor where email='".$email."'";
	$statement = $db->prepare($check_email); 	
	$statement->execute();   
	$count=$statement->rowCount();  
	
	if($count > 0)
	{
		echo "0";
		die; 
	}
	else
	{
		$sql="INSERT INTO vendor (name,email,phone,address,city,prov,post_code) VALUES ('".$name."','".$email."','".$phone."','".$address."','".$city."','".$prov."','".$post_code."')";
		$statement = $db->prepare($sql); 	
		$statement->execute();  
		echo "1"; 
	}
	
	
	
}
 
function ShowVendorForm()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/vendor.js"></script>   
<div class="new_custmer">
<a class="close_new" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a> 
<h4 class="close_title">NEW VENDOR</h4>
</div>
<div class="close_container custmr_edt_cnt">
<form name="add_vendor" id="add_vendor" action="" method="post"> 
	<input type="hidden" name="action" value="AddVendor">	

	<div class="cstm-wid top_inpt"> 
		
		<ul>
			<li>
				<input type="text" name="name" placeholder="Name">
			</li>
			
			<li>
				<input type="text" name="email" placeholder="Email address">
			</li>
			<li>
				<input type="text" name="phone" placeholder="Phone No">
			</li>
		</ul>
	</div>

	<div class="cstm-wid top_inpt"> 
		
		<ul>
			<li>
				<input type="text" name="address" placeholder="Address">
			</li>
			
			<li>
				<input type="text" name="city" placeholder="City">
			</li>
			
		</ul>
	</div>
	<div class="cstm-wid top_inpt"> 	
		<ul>
			<li>
				<input type="text" name="prov" placeholder="Province">
			</li>
			<li>
				<input type="text" name="post_code" placeholder="Postal Code">
			</li>
		</ul>
	</div>
	<div class="btn_deit">
		
		<button type="submit" class="custom edit_cstm" name="submit">Save</button>
		<img id="cust_loader" src="assets/images/loader-11.gif" style="display:none;" />
	</div>
</form>
<div class="result"></div> 
</div> 
<?php	
}

function CustomerEditShow()
{
$db = get_connection(); 
unset($_REQUEST['action']);
$id=$_REQUEST['id'];
$sql="select * from vendor where id='".$id."'";
$statement = $db->prepare($sql); 	
$statement->execute();  
$count_staff=$statement->rowCount();   
$result=$statement->fetchAll();   
foreach($result as $row)
{ 
?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/vendor.js"></script> 
<div class="new_custmer">
<a class="close_new" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>
<a class="cust-del pull-right delete_cust" id="<?php echo $id; ?>" u="<?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?>" href="javascript:void(0)" onclick="delete_vendor(this);"> <i class="fa fa-trash-o"></i></a>
<h4 class="close_title">EDIT VENDOR</h4> 
</div> 
<div class="close_container custmr_edt_cnt">
<form name="edit_vendor" id="edit_vendor" action="" method="post">
	<input type="hidden" name="action" value="EditVendor">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="cstm-wid top_inpt">

			<ul>
				<li>
					<input type="text" name="name" placeholder="Name" value="<?php echo stripslashes($row['name']); ?>">
				</li>

				<li>
					<input type="text" name="email" placeholder="Email addres" value="<?php echo stripslashes($row['email']); ?>">
				</li>
				<li>
					<input type="text" name="phone" placeholder="Phone No" value="<?php echo stripslashes($row['phone']); ?>">
				</li>
			</ul>
		</div>

		<div class="cstm-wid top_inpt">

			<ul>
				<li>
					<input type="text" name="address" placeholder="Address" value="<?php echo stripslashes($row['address']); ?>">
				</li>

				<li>
					<input type="text" name="city" placeholder="City" value="<?php echo stripslashes($row['city']); ?>">
				</li>
			</ul>
		</div>
		<div class="cstm-wid top_inpt">
			<ul>
				<li>
					<input type="text" name="prov" placeholder="Province" value="<?php echo stripslashes($row['prov']); ?>">
				</li>
				<li>
					<input type="text" name="post_code" placeholder="Postal Code" value="<?php echo stripslashes($row['post_code']); ?>">
				</li>
			</ul>
		</div>
	<div class="btn_deit">

		<button type="submit" class="custom edit_cstm" name="submit">Save</button>
		<img id="edit_cust_loader" src="assets/images/loader-11.gif" style="display:none;" />
	</div>
</form>
</div>
<?php
}
}

function EditVendor()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
	
	$id=$_REQUEST['id']; 
	$name=mysql_real_escape_string($_REQUEST['name']);
	$email=mysql_real_escape_string($_REQUEST['email']);
	$phone=mysql_real_escape_string($_REQUEST['phone']);
	$address=mysql_real_escape_string($_REQUEST['address']);
	$city=mysql_real_escape_string($_REQUEST['city']);
	$prov=mysql_real_escape_string($_REQUEST['prov']);
	$post_code=mysql_real_escape_string($_REQUEST['post_code']);

  
	$sql="UPDATE vendor SET  name='".$name."',email =  '".$email."',phone = '".$phone."',address =  '".$address."',city =  '".$city."',prov =  '".$prov."',post_code ='".$post_code."' WHERE id ='".$id."'";
	$statement = $db->prepare($sql); 	
	$statement->execute(); 
	echo "1";
}


function DeleteVendor()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
	$user_id=$_REQUEST['user_id']; 
	$sql="Delete from vendor WHERE id ='".$user_id."'";
	$statement = $db->prepare($sql); 	
	$statement->execute();  
	echo "1"; 
}

function GetVendorInfo()
{
$db = get_connection(); 
unset($_REQUEST['action']);
$id=$_REQUEST['user_id'];
$sql="select * from vendor where id='".$id."'";
$statement = $db->prepare($sql); 	
$statement->execute();   
$result=$statement->fetchAll();  
foreach($result as $row)
{  
?>
<div class="new_custmer">
<a class="close_new" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>
<h4 class="close_title">VENDOR</h4>
</div>
<div class="close_container custmr_edt_cnt">
<div class="customers_container view_cstmr">
<div class="close_mn display_block">
<div class="cstm-wid top_inpt edit_table vndr_cnt "><div class="responsive-table">
<table class="table border-sep">
	<thead>
		<tr>
			<th style="width: 3%;"></th>
			<th style="width: 18%;">Name</th>
			<th style="width: 35%;">Email Address</th>
			<th style="width: 15%;">Telephone</th>
			<th style="text-align: center; width: 10%;"></th>
		</tr>
	</thead>
	<tbody>
	<td colspan="6" class="internal-table">
		<table class="table brdr brdr_none margin_non not-responsive">
			<tbody>
				<tr>
					<td style="width: 3%;"></td>
					<td style="width: 18%;"><?php echo $row['name']; ?></td>
					<td style="width: 35%;"><?php echo $row['email']; ?></td>
					<td style="width: 15%;"><?php echo $row['phone']; ?></td>
					<td style=" width: 10%;"></td>

				</tr>

				<tr>
					<td colspan="6" class="internal-table">
						<table class="table not-responsive">
							<tbody>
								<tr class="vrtcl_top">
									<td style="width: 3%;"></td>

									<td style="width: 19%;">

										<span><?php echo $row['address']; ?></span>
										<span><?php echo $row['city']; ?></span>
										<span><?php echo $row['prov']; ?></span>
										<span><?php echo $row['post_code']; ?></span>

										</td>

									<td style="width: 20%;">&nbsp;</td>

									<td style="width: 30%;"><strong>&nbsp;</strong>
										<span>&nbsp;</span></td>
									<td style=" width: 10%;">

									<a class="custom" href="<?php echo SITE_URL; ?>?section=vendor-history&id=<?php echo $id; ?>">More</a>

									</td>
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

</div>
</div>
</div>
</div>
</div>
<?php	
}
}
?>	
	