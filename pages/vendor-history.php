<?php 
if(!isset($_SESSION['user_id']))
{
?>
<script>window.location.href="<?php echo SITE_URL; ?>?section=login";</script>
<?php
die;
}
?>	
<?php 
$db = get_connection();
get_header(); ?> 
<?php $vendor_id=$_GET['id']; ?>
<?php 
$user_role=get_user_detail($_SESSION['user_id'],'role');  
?>
 <div class="main display_block">
        <?php get_sidebar(); ?>
        <div class="rt_sidebar pull-left">
            <div class="btns_cont">
                <div class="btns_top pull-right">
                    <div class="btns_lft pull-left">
						<a href="<?php echo SITE_URL; ?>?section=dashboard" class="custom">Dashboard</a>
						<a href="javascript:void(0);" class="custom" onclick="show_vendor_form();">New Vendor</a> 
					</div>  
                    <div class="btns_rt pull-right" id="search-box">
                        <input type="text" placeholder="Search">
                    </div>
                </div>
            </div>
			<div id="fromToggle" class="collapsible-area" style="display:none"></div>
            <div class="close_mn display_block">
				<div class="edit_table staff vendor_tble">
					<table class="table">
					<tbody>
						<tr>
							<td colspan="5">
								<table class="table brdr">
									<tbody>
										<tr>
											<td style="width: 3%;"></td>
											<td style="width: 29%;"><?php echo get_vendor_info($vendor_id,'name'); ?></td>
											<td style="width: 29%;"><?php echo get_vendor_info($vendor_id,'email'); ?></td>
											<td style="width: 20%;"><?php echo get_vendor_info($vendor_id,'phone'); ?></td>
							 				<td style="width: 19%; text-align: right;" class="alignmnt">&nbsp;</td>
										</tr>
										<tr class="vertcal_top">
											<td></td>
											<td>
												<strong>Telephone</strong>
												<span><?php echo get_vendor_info($vendor_id,'phone'); ?></span>
											</td>
											<td>
												<strong>Adress</strong>
												<span><?php echo get_vendor_info($vendor_id,'address'); ?> <br> <?php echo get_vendor_info($vendor_id,'city'); ?> <?php echo get_vendor_info($vendor_id,'prov'); ?> <br> <?php echo get_vendor_info($vendor_id,'post_code'); ?></span></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/vendor.js"></script> 
<?php get_footer(); ?>