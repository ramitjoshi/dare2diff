<?php 
if(isset($_SESSION['user_id']))
{
?>
	<script>window.location.href="<?php echo SITE_URL; ?>?section=dashboard";</script>
<?php
die;
}
$db = get_connection();
?>
<?php get_header(); ?>
 
    <div class="login">
        <div class="login_middle">
            <div class="logo text-center">
                <a href="">
                    <div class="img_logo">
                        <img alt="logo" src="<?php echo SITE_URL; ?>assets/images/logo.jpg">
                    </div>
                    <div class="img_content">
                        <h4>Dare 2 Be Different</h4>
                    </div>
                </a>
            </div>
            <form name="signin" id="signin" action="" method="post">
                <input type="hidden" name="action" value="LoginUser"> 
				<ul>
                    <li><input type="text" placeholder="Username" name="username"></li>
                    <li><input type="password" placeholder="Password" name="password"></li>
                    <li>
                        <div class="rem_cont clear">
                            
							<div class="rem_lft">
                                <input type="checkbox">
                                <label>Remember me</label>
                            </div>
							
                            <div class="rem_rt">
                                <a href="#">Forgot password</a>
                            </div>
                        </div>
                    </li> 
                    <li>
                        <button type="submit" class="submit" name="submit">SIGN IN</button>
						<img src="<?php echo SITE_URL; ?>assets/images/loader-11.gif" id="signin_loader" style="display:none;">
                    </li>
                    <!--
					<li>
                        Don’t have an account? <a class="sign_up" href="#">Sign up</a>
                    </li>
					-->
                </ul>



            </form>
        </div>
    </div>
<?php get_footer(); ?>