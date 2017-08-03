<?php
require_once  'setup.php';
$action=$_REQUEST['action'];

//get requested action
if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
   $action = $_REQUEST['action'];
   call_user_func($action);
}



function LoginUser()
{
	
	$db = get_connection();
	unset($_REQUEST['action']);
	$username=$_REQUEST['username'];
	$password=md5($_REQUEST['password']);   
	$count=user_exist($username);
	if($count==1) 
	{ 
		$sql="select id from users where username='".$username."' and password='".$password."'";   
		$statement = $db->prepare($sql); 	
		$statement->execute();  
		$countt=$statement->rowCount();   
		$result=$statement->fetchAll();     
		if($countt > 0)
		{
			foreach($result as $row)  
			{
				$user_id=$row['id'];
			}
			$_SESSION['user_id']=$user_id;
			echo "1";	
		}
		else
		{
			echo "0"; 
		}		
	}
	else
	{
		echo "2";
	} 	
	
}
?>