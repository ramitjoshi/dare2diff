<?php
require_once  '../setup.php';
$action=$_REQUEST['action'];

//get requested action
if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
   $action = $_REQUEST['action'];
   call_user_func($action);
}


function AddCustomer()
{ 
	$db = get_connection();
	unset($_REQUEST['action']);
	
	$company=mysql_real_escape_string($_REQUEST['company']);
	$fname=mysql_real_escape_string($_REQUEST['fname']);
	$lname=mysql_real_escape_string($_REQUEST['lname']);
	$email=mysql_real_escape_string($_REQUEST['email']);
	$work_phone=mysql_real_escape_string($_REQUEST['work_phone']);
	$home_phone=mysql_real_escape_string($_REQUEST['home_phone']);
	$mobile_phone=mysql_real_escape_string($_REQUEST['mobile_phone']);

	$work_name=mysql_real_escape_string($_REQUEST['work_name']);
	$work_add1=mysql_real_escape_string($_REQUEST['work_add1']);
	$work_add2=mysql_real_escape_string($_REQUEST['work_add2']);
	$work_city=mysql_real_escape_string($_REQUEST['work_city']);
	$work_prov=mysql_real_escape_string($_REQUEST['work_prov']);
	$work_post_code=mysql_real_escape_string($_REQUEST['work_post_code']);

	$home_name=mysql_real_escape_string($_REQUEST['home_name']);
	$home_add1=mysql_real_escape_string($_REQUEST['home_add1']);
	$home_add2=mysql_real_escape_string($_REQUEST['home_add2']);
	$home_city=mysql_real_escape_string($_REQUEST['home_city']);
	$home_prov=mysql_real_escape_string($_REQUEST['home_prov']);
	$home_post_code=mysql_real_escape_string($_REQUEST['home_post_code']);

	$note=mysql_real_escape_string($_REQUEST['note']);

	$sql="INSERT INTO customer (company,first_name ,last_name ,email ,work_phone ,home_phone ,mobile_phone ,work_name ,work_add1 ,work_add2 ,work_city ,work_prov ,work_post_code ,home_name ,home_add1 ,home_add2 ,home_city ,home_prov ,home_post_code ,note) VALUES ('".$company."','".$fname."','".$lname."','".$email."','".$work_phone."','".$home_phone."','".$mobile_phone."','".$work_name."','".$work_add1."','".$work_add2."','".$work_city."','".$work_prov."','".$work_post_code."','".$home_name."','".$home_add1."','".$home_add2."','".$home_city."','".$home_prov."','".$home_post_code."',  '".$note."')";
	$statement = $db->prepare($sql);   	
	$statement->execute();   
	echo "1";
	
	
	
}

function ShowCustomerForm()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/customer.js"></script>   
<div class="new_custmer">
<a class="close_new" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>  
<h4 class="close_title">NEW CUSTOMER</h4>
</div>
<div class="close_container custmr_edt_cnt bg_grey new_strctre">
<form name="add_customer" id="add_customer" action="" method="post"> 
	<input type="hidden" name="action" value="AddCustomer">	

	<div class="cstm-wid top_inpt">
	<ul class="cmpny_nm">
			<li>
				<input type="text" name="company" placeholder="Company">
			</li> 
			
		</ul>
		<ul>
			<li>
				<input type="text" name="fname" placeholder="First Name">
			</li>
			<li>
				<input type="text" name="lname" placeholder="Last Name">
			</li>
			<li>
				<input type="text" name="email" placeholder="Email address">
			</li>
		</ul>
	</div>

	<div class="cstm-wid btm_inpt">
		<div class="col-1">
			<h4></h4>
			<ul>

				<li>
					<input type="text" name="work_phone" placeholder="Work Phone No">
				</li>
				<li>
					<input type="text" name="home_phone" placeholder="Home Phone No">
				</li>
				<li>
					<input type="text" name="mobile_phone" placeholder="Mobile Phone No">
				</li>
				<li>
					<textarea name="note" placeholder="Notes"></textarea>
				</li>

			</ul>
		</div>
		<div class="col-1">
			<h4> Work</h4>
			<ul>
				<!--
				<li>
					<input type="text" placeholder="First Name" name="work_name">
				</li>
				-->
				<li>
					<input type="text" placeholder="Address" name="work_add1">
				</li>
				
				<li>
					<input type="text" placeholder="Address 2" name="work_add2"> 
				</li>
				<li>
					<input type="text" placeholder="City" name="work_city">
				</li>
				<li>
					<input type="text" placeholder="Province" name="work_prov">
				</li>
				<li>
					<input type="text" placeholder="Postal Code" name="work_post_code">
				</li>
			</ul>
		</div>
		<div class="col-1">
			<h4> Home</h4>
			<ul>
				<!--
				<li>
					<input type="text" placeholder="First Name" name="home_name">
				</li>
				-->
				<li>
					<input type="text" placeholder="Address" name="home_add1">
				</li>
				
				<li>
					<input type="text" placeholder="Address 2" name="home_add2"> 
				</li>
				<li>
					<input type="text" placeholder="City" name="home_city">
				</li>
				<li>
					<input type="text" placeholder="Province" name="home_prov">
				</li>
				<li>
					<input type="text" placeholder="Postal Code" name="home_post_code">
				</li>
			</ul>
		</div>
		
	</div>
	<div class="btn_deit bg-transparent">
		
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
	$sql="select * from customer where id='".$id."'";
	$statement = $db->prepare($sql); 	
	$statement->execute();   
	$result=$statement->fetchAll();   
	foreach($result as $row)
	{
?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/customer.js"></script>  
<div class="new_custmer">
<a class="close_new" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a> 
<a class="cust-del pull-right delete_cust" id="<?php echo $id; ?>" u="<?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?>" href="javascript:void(0)" onclick="delete_user(this);"> <i class="fa fa-trash-o"></i></a>
<h4 class="close_title">EDIT CUSTOMER</h4>
</div>
<div class="close_container custmr_edt_cnt bg_grey new_strctre">
<form name="edit_customer" id="edit_customer" action="" method="post">
	<input type="hidden" name="action" value="EditCustomer">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="cstm-wid top_inpt"> 
		<div class=" customrs_cont">
            <ul class="cmpny_nm">
			<li>
				<input type="text" name="company" placeholder="Company" value="<?php echo stripslashes($row['company']); ?>">
			</li>
			</ul>
			<ul>
			<li>
				<input type="text" name="fname" placeholder="First Name" value="<?php echo stripslashes($row['first_name']); ?>">
			</li>
			<li>

				<input type="text" name="lname" placeholder="Last Name" value="<?php echo stripslashes($row['last_name']); ?>">
			</li>
			<li>

				<input type="text" name="email" placeholder="Email address" value="<?php echo stripslashes($row['email']); ?>">
			</li>
			</ul>
		</div>

	<div class="cstm-wid btm_inpt">
		<div class="col-1">
			<h4></h4>
			<ul>

				<li>
					<input type="text" name="work_phone" placeholder="Work Phone No" value="<?php echo stripslashes($row['work_phone']); ?>">
				</li>
				<li>
					<input type="text" name="home_phone" placeholder="Home Phone No" value="<?php echo stripslashes($row['home_phone']); ?>">
				</li>
				<li>
					<input type="text" name="mobile_phone" placeholder="Mobile Phone No" value="<?php echo stripslashes($row['mobile_phone']); ?>">
				</li>
				<li>
				<textarea name="note" placeholder="Notes"><?php echo stripslashes($row['note']); ?></textarea>
				</li>
			</ul>
		</div>
		<div class="col-1">
			<h4> Work</h4>
			<ul>
				<!--
				<li>
					<input type="text" placeholder="First Name" name="work_name" value="<?php echo stripslashes($row['work_name']); ?>">
				</li>
				-->
				<li>
					<input type="text" placeholder="Address" name="work_add1" value="<?php echo stripslashes($row['work_add1']); ?>">
				</li>

				<li>
					<input type="text" placeholder="Address 2" name="work_add2" value="<?php echo stripslashes($row['work_add2']); ?>">
				</li>
				<li>
					<input type="text" placeholder="City" name="work_city" value="<?php echo stripslashes($row['work_city']); ?>">
				</li>
				<li>
					<input type="text" placeholder="Province" name="work_prov" value="<?php echo stripslashes($row['work_prov']); ?>">
				</li>
				<li>
					<input type="text" placeholder="Postal Code" name="work_post_code" value="<?php echo stripslashes($row['work_post_code']); ?>">
				</li>
			</ul>
		</div>
		<div class="col-1">
			<h4> Home</h4>
			<ul>
				<!--
				<li>
					<input type="text" placeholder="First Name" name="home_name" value="<?php echo stripslashes($row['home_name']); ?>">
				</li>
				-->
				<li>
					<input type="text" placeholder="Address" name="home_add1" value="<?php echo stripslashes($row['home_add1']); ?>">
				</li>

				<li>
					<input type="text" placeholder="Address 2" name="home_add2" value="<?php echo stripslashes($row['home_add2']); ?>">
				</li>
				<li>
					<input type="text" placeholder="City" name="home_city" value="<?php echo stripslashes($row['home_city']); ?>">
				</li>
				<li>
					<input type="text" placeholder="Province" name="home_prov" value="<?php echo stripslashes($row['home_prov']); ?>">
				</li>
				<li>
					<input type="text" placeholder="Postal Code" name="home_post_code" value="<?php echo stripslashes($row['home_post_code']); ?>">
				</li>
			</ul>
		</div>

	</div>
	<div class="btn_deit bg-transparent">

		<button type="submit" class="custom edit_cstm" name="submit">Save</button>
		<img id="edit_cust_loader" src="assets/images/loader-11.gif" style="display:none;" />
	</div> 
</form>
</div>
<?php	
}
}

function EditCustomer()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
	$id=$_REQUEST['id'];
	
	$company=mysql_real_escape_string($_REQUEST['company']);
	$fname=mysql_real_escape_string($_REQUEST['fname']);
	$lname=mysql_real_escape_string($_REQUEST['lname']);
	$email=mysql_real_escape_string($_REQUEST['email']);
	$work_phone=mysql_real_escape_string($_REQUEST['work_phone']);
	$home_phone=mysql_real_escape_string($_REQUEST['home_phone']);
	$mobile_phone=mysql_real_escape_string($_REQUEST['mobile_phone']);

	$work_name=mysql_real_escape_string($_REQUEST['work_name']);
	$work_add1=mysql_real_escape_string($_REQUEST['work_add1']);
	$work_add2=mysql_real_escape_string($_REQUEST['work_add2']);
	$work_city=mysql_real_escape_string($_REQUEST['work_city']);
	$work_prov=mysql_real_escape_string($_REQUEST['work_prov']);
	$work_post_code=mysql_real_escape_string($_REQUEST['work_post_code']);

	$home_name=mysql_real_escape_string($_REQUEST['home_name']);
	$home_add1=mysql_real_escape_string($_REQUEST['home_add1']);
	$home_add2=mysql_real_escape_string($_REQUEST['home_add2']);
	$home_city=mysql_real_escape_string($_REQUEST['home_city']);
	$home_prov=mysql_real_escape_string($_REQUEST['home_prov']);
	$home_post_code=mysql_real_escape_string($_REQUEST['home_post_code']);

	$note=$_REQUEST['note'];

	$sql="UPDATE customer SET  company='".$company."',first_name =  '".$fname."',last_name = '".$lname."',email =  '".$email."',work_phone =  '".$work_phone."',home_phone =  '".$home_phone."',mobile_phone ='".$mobile_phone."',work_name =  '".$work_name."',work_add1 ='".$work_add1."',work_add2 = '".$work_add2."',work_city ='".$work_city."',work_prov = '".$work_prov."',work_post_code = '".$work_post_code."',home_name =  '".$home_name."',home_add1 ='".$home_add1."',home_add2 = '".$home_add2."',home_city =  '".$home_city."',home_prov = '".$home_prov."',home_post_code = '".$home_post_code."',note =  '".$note."' WHERE id ='".$id."'";
	
	$statement = $db->prepare($sql); 	
	$statement->execute();   
	
	echo "1";
}


function DeleteCustomer()
{
	$db = get_connection();
	unset($_REQUEST['action']);
	$staff_id=$_REQUEST['user_id'];	
	$update="delete from customer where id='".$staff_id."'"; 
	$statement = $db->prepare($update);   	
	$statement->execute();       
}


function GetCustomerInfo()
{
$db = get_connection();
unset($_REQUEST['action']);
$user_id=$_REQUEST['user_id'];	
$sql="select * from customer where id='".$user_id."'";
$statement = $db->prepare($sql);   	
$statement->execute();       
$result=$statement->fetchAll();        
foreach($result as $row)
{ 
?>
<div class="new_custmer">
<a class="close_new" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a> 
<h4 class="close_title">CUSTOMER</h4>
</div>
<div class="close_container custmr_edt_cnt">
<div class="customers_container view_cstmr">
	<div class="close_mn display_block">
	<div class="cstm-wid top_inpt edit_table vndr_cnt">
	<div class="responsive-table">
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
			<table class="table brdr brdr_none margin_non not-responsive">
				<tbody>
					<tr>
						<td style="width: 3%;"></td>
						<td style="width: 18%;"><?php echo $row['first_name']; ?></td>
						<td style="width: 19%;"><?php echo $row['last_name']; ?></td>
						<td style="width: 35%;"><?php echo $row['email']; ?></td>
						<td style="width: 15%;"><?php echo $row['mobile_phone']; ?></td>
						<td style=" width: 10%;"></td>

					</tr>

					<tr>
						<td colspan="6" class="internal-table ">
							<table class="table not-responsive">
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

										<td style="width: 20%;"><strong>Cottage  </strong>

										</td>

										<td style="width: 30%;"><strong>Notes </strong>
											<span><?php echo $row['note']; ?></span></td>
										<td style=" width: 10%;"><a class="custom" href="<?php echo SITE_URL; ?>?section=customer-history&id=<?php echo $user_id; ?>">More</a></td>
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

<?php
}
}

?>	
	