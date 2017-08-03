<?php
$section=$_GET['section'];
?>
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav">
	<li class="<?php if($section=="home") { echo 'active'; } ?>"><a href="<?php echo SITE_URL; ?>">Home</a></li>
	<li><a href="javascript:void(0);" class="<?php if($section=="home") { echo 'active'; } ?>">How it works</a></li>
	<li><a href="javascript:void(0);">Pricing</a></li>  
	<li><a href="javascript:void(0);">Faq</a></li>
	<li class="<?php if($section=="contact-us") { echo 'active'; } ?>"><a href="<?php echo SITE_URL; ?>?section=contact-us">Contact</a></li> 
</ul> 
<ul class="nav navbar-nav navbar-right">
	
	<?php
	if(!isset($_SESSION['user_id']))
	{
	?>
		<li><a href="<?php echo SITE_URL; ?>?section=sign-in"><i class="fa fa-lock" aria-hidden="true"></i> Sign In</a></li> 
		<li><a href="<?php echo SITE_URL; ?>?section=sign-up"><i class="fa fa-user-o" aria-hidden="true"></i> Sign Up</a></li>
	<?php	 
	}
	else
	{
	?>
		<li><a href="<?php echo SITE_URL; ?>logout.php"><i class="fa fa-lock" aria-hidden="true"></i>Logout</a></li> 
		<li><a href="<?php echo SITE_URL; ?>?section=my-account">My Account</a></li> 
	<?php
	}	 
	?>
	
</ul>
</div>