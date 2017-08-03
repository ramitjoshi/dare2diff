<?php
$user_id=$_SESSION['user_id'];
?>
<header>
	<ul class="top-links">
		<li class="user-name"><a href="javascript:void(0);"><?php echo get_user_detail($user_id,'email'); ?></a></li>
		<li><a href="<?php echo SITE_URL; ?>/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
	</ul>  
</header> 