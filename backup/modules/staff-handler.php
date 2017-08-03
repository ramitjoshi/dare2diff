<?php
require_once  '../setup.php';
$action=$_REQUEST['action'];

//get requested action
if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
   $action = $_REQUEST['action'];
   call_user_func($action);
}


function AddStaff()
{
	$db = get_connection();
	unset($_REQUEST['action']);
	$fname=mysql_real_escape_string($_REQUEST['fname']);
	$lname=mysql_real_escape_string($_REQUEST['lname']);
	$email=$_REQUEST['email'];
	$role=$_REQUEST['role'];
	$username=mysql_real_escape_string($_REQUEST['username']);
	$user_pass=mysql_real_escape_string($_REQUEST['user_pass']);
	$user_pass=md5($_REQUEST['user_pass']);
	$phone=mysql_real_escape_string($_REQUEST['phone']);
	$count=user_exist($username); 
	if($count==0)  
	{

		$date=date("Y-m-d H:i:s");
		$insert="insert into users (username,password,role,first_name,last_name,email,phone,status,last_logged_in,created) values ('".$username."','".$user_pass."','".$role."','".$fname."','".$lname."','".$email."','".$phone."','1','0000-00-00','".$date."')"; 
		$statement = $db->prepare($insert);   	
		$statement->execute();  
		echo "1"; 
	}
	else
	{
		echo "0";
	}
 
}

function ShowStaffForm()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/staff.js"></script>  
<div class="new_custmer">
<a href="javascript:void(0);" onclick="jQuery('#fromToggle').slideUp();jQuery('#fromToggle').empty();" class="close_new"><i class="fa fa-times" aria-hidden="true"></i></a>
<h4 class="close_title">ADD STAFF</h4></div>
<div class="close_container custmr_edt_cnt">
	<form name="add_staff" id="add_staff" action="" method="post" class="new_cstmr">
		<div class="cstm-wid top_inpt">
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
				<li>
					<input type="text" name="phone" placeholder="Phone">
				</li>
			
				
				<li>
					<input type="text" name="username" placeholder="Username">
				</li>
				<li>
					<input type="password" name="user_pass" placeholder="Password">
				</li>
			</ul>
			<div class="radio_btn">
			
					<input type="radio" name="role" value="admin"><label>Admin</label>
					<input type="radio" name="role" value="staff" checked><label>Staff</label>
				
			</div>
		</div>
		<div class="btn_deit">
			<button type="submit" class="custom edit_cstm">Save</button>
			<img src="assets/images/loader-11.gif" id="addSaff_loader" style="display:none;" />
		</div>  
		<input type="hidden" name="action" value="AddStaff">
	</form>
	<div class="result"></div>
</div>
<?php	
}
function EditStaffForm()
{
	$db = get_connection();
	unset($_REQUEST['action']);
	$user_id=$_REQUEST['user_id'];
	$role=get_user_detail($user_id,'role'); 
	$status=get_user_detail($user_id,'status');  
	
?> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/staff.js"></script> 
<div class="new_custmer"> 
<a href="javascript:void(0);" onclick="jQuery('#fromToggle').slideUp();jQuery('#fromToggle').empty();" class="close_new"><i class="fa fa-times" aria-hidden="true"></i></a>
<a href="javascript:void(0)" onclick="delete_staff('<?php echo $user_id; ?>')" id="<?php echo $user_id; ?>" class="staff-del pull-right delete_cust"> <i aria-hidden="true" class="fa fa-trash-o"></i> </a>
<h4 class="close_title">EDIT STAFF</h4>
</div>
<div class="close_container custmr_edt_cnt">
	<form name="edit_staff" id="edit_staff" action="" method="post" class="new_cstmr">
		<input type="hidden" name="staff_id" value="<?php echo $user_id; ?>" />
		<input type="hidden" name="action" value="EditStaff"> 
		<div class="cstm-wid top_inpt">  
			<ul> 
				<li>
					<input type="text" name="fname" placeholder="First Name" value="<?php echo get_user_detail($user_id,'first_name'); ?>">
				</li>
				<li>
					<input type="text" name="lname" placeholder="Last Name" value="<?php echo get_user_detail($user_id,'last_name'); ?>">
				</li>
				<li>
					<input type="text" name="email" placeholder="Email address" value="<?php echo get_user_detail($user_id,'email'); ?>"> 
				</li>
				<li>
					<input type="text" name="phone" placeholder="Phone" value="<?php echo get_user_detail($user_id,'phone'); ?>">  
				</li>
				
				<li class="radio_li">
				<div class="radio_btn">
					<input type="radio" name="role" value="admin" <?php if($role=="admin") { echo 'checked'; } ?>><label>Admin</label>
					<input type="radio" name="role" value="staff" <?php if($role=="staff") { echo 'checked'; } ?>><label>Staff</label>
					
			</div>
				
				</li>
				
			</ul>
	
		</div>
		<div class="btn_deit">
			<?php
			if($status==1)
			{
			?>	
				<a href="javascript:void(0);" class="custom edit_cstm" onclick="freeze_user('0','<?php echo $user_id; ?>');">Freeze</a>
			<?php
			}
			else
			{		
			?>
				<a href="javascript:void(0);" class="custom edit_cstm" onclick="freeze_user('1','<?php echo $user_id; ?>');">UnFreeze</a>
			<?php
			}
			?>
			<button type="submit" class="custom edit_cstm">Save</button>
			<img src="assets/images/loader-11.gif" id="addSaff_loader" style="display:none;" />
		</div>  
		
	</form>
	
</div>
<?php	
}

function EditStaff()
{
	$db = get_connection();
	unset($_REQUEST['action']);
	$staff_id=$_REQUEST['staff_id'];
	$fname=mysql_real_escape_string($_REQUEST['fname']);
	$lname=mysql_real_escape_string($_REQUEST['lname']);
	$email=$_REQUEST['email'];
	$phone=mysql_real_escape_string($_REQUEST['phone']);
	$role=$_REQUEST['role'];

	$update="update users set role='".$role."',first_name='".$fname."',last_name='".$lname."',email='".$email."',phone='".$phone."' where id='".$staff_id."'"; 
	$statement = $db->prepare($update);   	
	$statement->execute();    
}

function DeleteStaff()
{
	$db = get_connection();
	unset($_REQUEST['action']);
	$staff_id=$_REQUEST['user_id'];	
	$update="delete from users where id='".$staff_id."'"; 
	$statement = $db->prepare($update);   	
	$statement->execute();     
}

function FreezeUser()
{
	$db = get_connection();
	unset($_REQUEST['action']);
	$user_id=$_REQUEST['user_id'];
	$status=$_REQUEST['status'];
	$sql="update users set status='".$status."' where id='".$user_id."'";
	$statement = $db->prepare($sql);   	
	$statement->execute();     
	echo $status;
}


?>	
	