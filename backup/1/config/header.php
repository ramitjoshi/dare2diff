<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Dare 2 Be Different</title>
    <link rel="icon" href="<?php echo SITE_URL; ?>assets/images/favicon.png" sizes="16x16">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/style.css">
	<link href="<?php echo SITE_URL; ?>assets/css/toastr.css" rel="stylesheet">  
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
	</script>
		<script type="text/javascript" language="javascript" src="<?php echo SITE_URL; ?>assets/js/boot_filestyle.js">
	</script>
	<script type="text/javascript" language="javascript" src="<?php echo SITE_URL; ?>assets/js/bootstrap-select.js">
	</script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
	 jQuery('.filestyle').filestyle({
				buttonText: ' Upload'
			});
			
			jQuery(document).ready(function()
	{
			
		var windowWidth = jQuery(window).width();
		if(windowWidth<=767){
		jQuery('.responisve-menu').click(function(){
			jQuery('nav').slideToggle();
			jQuery('.responisve-menu').toggleClass('cross-respon');
			
		}); 
		}
			
	});
	
			
	</script>
</head> 

<body class="<?php if(!isset($_SESSION['user_id'])) { ?> login_det <?php } ?>">