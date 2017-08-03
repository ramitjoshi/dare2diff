<?php
if(isset($_GET['section']))
{
	$section=$_GET['section'];
}

$user_id=$_SESSION['user_id'];
	
?>
<div class="lft_sidebar pull-left">
	
	<div class="logo text-center">
		<a href="">
			<div class="img_logo">
				<img src="<?php echo SITE_URL; ?>assets/images/logo.png" alt="logo">
			</div>
			<!--div class="img_content">
				<h4>Dare 2 Be Different</h4>
			</div-->
		</a> 
	</div>
	<div class="responisve-menu">
		<div class="click-menu">
	<span class="menu-icon">
			<i class="fa fa-bars" aria-hidden="true"></i>
	</span>	
	<span class="menu-cross">
			<i class="fa fa-times" aria-hidden="true"></i>	
	</span>	
</div>
</div>
	<div class="user-info">
		<h4>Welcome <span><?php echo get_user_detail($user_id,'first_name'); ?></span> <span><?php echo get_user_detail($user_id,'last_name'); ?></span></h4>
		<!--<h4>You are login as <span><?php echo get_user_detail($user_id,'role'); ?></span></h4>-->
	</div> 
	<nav> 
		<ul>
			<li class="<?php if($section=="dashboard") { echo 'active'; } ?>"><a href="<?php echo SITE_URL; ?>?section=dashboard">Dashboard</a></li>
			<li class="<?php if($section=="customer") { echo 'active'; } ?>"><a href="<?php echo SITE_URL; ?>?section=customer">Customers</a></li>
			<li class="<?php if($section=="material") { echo 'active'; } ?>"><a href="<?php echo SITE_URL; ?>?section=material">Materials</a></li> 
			<li class="<?php if($section=="staff") { echo 'active'; } ?>"><a href="<?php echo SITE_URL; ?>?section=staff">Staff</a></li> 
			<li class="<?php if($section=="vendor") { echo 'active'; } ?>"><a href="<?php echo SITE_URL; ?>?section=vendors">Vendors</a></li> 
			<li><a href="<?php echo SITE_URL; ?>logout.php">Logout</a></li>
		</ul>    
	</nav>

</div>