<?php 
function get_connection()
{
	$hostname = 'localhost';
	
	$conn = mysql_connect("localhost",DBUSER,DBPWD) or die("could not connect to server");
	mysql_select_db(DB,$conn) or die("could not connect to database");
	
	try {
		$dbh = new PDO("mysql:host=$hostname;dbname=".DB, DBUSER, DBPWD);			
	}
	catch(PDOException $e)
	{
		echo $e->getMessage(); 
		die;
	}
	
	return $dbh;  
}


function get_header()
{
require_once   'config/header.php';	
}

function get_footer()
{
require_once   'config/footer.php';	
}



function get_sidebar()
{
	require_once 'config/sidebar.php';
}



function user_exist($username)
{
	$db = get_connection();
	$sql="select username from users where username='".$username."'";
	$statement = $db->prepare($sql);	
	$statement->execute(); 
	return $result = $statement->rowCount(); 
	
	
}

function user_email_exist($email)
{
	$db = get_connection();
	$sql="select * from users where email='".$email."'";
	$statement = $db->prepare($sql);	
	$statement->execute(); 
	return $result = $statement->rowCount();
}

function get_user_detail($user_id,$field)
{
	$db = get_connection();
	$sql="select ".$field." from users where id='".$user_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute(); 
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		return $row[$field];
	}	 
}

function get_cust_job_detail($job_id,$field)
{
	$db = get_connection();
	$sql="select ".$field." from customer_job where id='".$job_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute(); 
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		return $row[$field];
	}	 
}

function get_close_job_detail($job_id,$field)
{
	$db = get_connection();
	$sql="select ".$field." from close_job where job_id='".$job_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute(); 
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		return $row[$field];
	}	 
}


function get_cust_detail($user_id,$field)
{
	
	$db = get_connection();
	$sql="select ".$field." from customer where id='".$user_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		return $row[$field];
	}	
	
}

function check_job_closed($job_id)
{
	$db = get_connection();
	$sql="select a.*,b.* from customer_job as a
	inner join close_job as b
	on a.id=b.job_id where a.id='".$job_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	return $statement->rowCount(); 
}


function get_vendor_info($user_id,$field)
{
	$db = get_connection();
	$sql="select ".$field." from vendor where id='".$user_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		return $row[$field];
	}	 
}

function get_material_cat_info($cat_id,$field)
{
	$db = get_connection();
	$sql="select ".$field." from material_category where id='".$cat_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		return $row[$field];
	}	 
}

function get_material_info($mat_id,$field)
{
	$db = get_connection();
	$sql="select ".$field." from material where id='".$mat_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		return $row[$field]; 
	}	 
}

function get_peice_name_info($name,$field) 
{
	$db = get_connection();
	$sql="select ".$field." from job_piece where piece_name='".$name."'";
	$statement = $db->prepare($sql); 	
	$statement->execute();   
	$result=$statement->fetchAll();  
	foreach($result as $row)
	{
		return $row[$field]; 
	}	 
}

function get_peice_info($pr_id,$field) 
{
	$db = get_connection();
	$sql="select ".$field." from job_piece where id='".$pr_id."'";
	$statement = $db->prepare($sql); 	
	$statement->execute();   
	$result=$statement->fetchAll();  
	foreach($result as $row)
	{
		return $row[$field]; 
	}	 
}

function get_recipe_components_info($comp_id,$field) 
{
	$db = get_connection();
	$sql="select ".$field." from recipe_components where id='".$comp_id."'";
	$statement = $db->prepare($sql); 	
	$statement->execute();   
	$result=$statement->fetchAll();  
	foreach($result as $row)
	{
		return $row[$field];  
	}	 
}

function get_job_components_info($comp_id,$field) 
{
	$db = get_connection();
	$sql="select ".$field." from job_piece_component where id='".$comp_id."'";
	$statement = $db->prepare($sql); 	
	$statement->execute();   
	$result=$statement->fetchAll();  
	foreach($result as $row)
	{
		return $row[$field];  
	}	 
}


function get_job_peice_dimension($job_id,$piece_id,$field) 
{
	$db = get_connection();
	$sql="select ".$field." from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."'";
	$statement = $db->prepare($sql);  	
	$statement->execute();    
	$result=$statement->fetchAll();  
	foreach($result as $row)
	{
		return $row[$field];  
	}	 
}


function check_job_piece($job_id,$name)
{
	$db = get_connection();
	$sql="select * from job_piece where job_id='".$job_id."' and piece_name='".$name."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	$count=$statement->rowCount(); 
	$result=$statement->fetchAll(); 
	if($count > 0)
	{	
		foreach($result as $row)
		{
			return $row['id']; 
		}
	}
	else 
	{
		return 0;  
	}		
}


//load content
function load_content($section)
{
	if($section == 'login'){
		require_once   'pages/login.php'; 	
	} 
	else if($section == 'dashboard'){
		require_once   'pages/dashboard.php'; 	
	} 
	else if($section == 'staff'){
		require_once   'pages/staff.php'; 	
	} 
	else if($section == 'customer'){
		require_once   'pages/customer.php'; 	
	} 
	else if($section == 'customer-history'){
		require_once   'pages/customer-history.php'; 	
	} 
	else if($section == 'vendors'){
		require_once   'pages/vendor.php'; 	
	} 
	else if($section == 'vendor-history'){
		require_once   'pages/vendor-history.php'; 	
	} 
	else if($section == 'job-detail'){
		require_once   'pages/job-detail.php'; 	
	} 
	else if($section == 'new-piece'){
		require_once   'pages/new-piece.php'; 	
	} 
	else if($section == 'material'){
		require_once   'pages/material.php'; 	
	} 
	else if($section == 'view-component'){
		require_once   'pages/view-component.php'; 	
	} 
	else if($section == 'edit-piece'){
		require_once   'pages/edit-piece.php'; 	
	} 
	else if($section == 'view-piece'){
		require_once   'pages/view-piece.php'; 	
	} 
	else if($section == 'job-close'){
		require_once   'pages/job-close.php'; 	
	} 
	else    
	{  
	?>  
	<script>window.location.href="<?php echo SITE_URL; ?>";</script> 
	<?php	
	}	
   
}
?>