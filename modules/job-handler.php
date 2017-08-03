<?php
require_once  '../setup.php'; 
$action=$_REQUEST['action'];

//get requested action
if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
   $action = $_REQUEST['action'];
   call_user_func($action);
}



 
function ShowJobForm()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>   
<div class="new_custmer clear"><h4 class="close_title pull-left">NEW JOB</h4>
	<a class="close_new pull-right" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>
	
</div>
<div class="inner_content">
	<div class="inner_pdng">
	<?php
	$sql_count="select temp_po from customer_job order by id desc limit 0,1";
	$statement = $db->prepare($sql_count); 	
	$statement->execute();   
	$count=$statement->rowCount();  
	$result=$statement->fetchAll();  
	$po=0;
	if($count==0)
	{
		$po=1000;
	}	
	else
	{
		foreach($result as $row)
		{
			$po=$row['temp_po'];
		}	
		$po=$po+1;
	}
		
	?>
	<form name="add_job" id="add_job" action="" method="post" class="new_job"> 
		<input type="hidden" name="cust_id" id="cust_id"> 
		<input type="hidden" name="temp_po" value="<?php echo $po; ?>">
		<input type="hidden" name="job_insert_by" value="<?php echo $_SESSION['user_id']; ?>">
		<input type="hidden" name="action" value="addcustomerJob">
		
		<input type="hidden" id="port" name="port_txt" value="0">
		<input type="hidden" id="sand" name="sand_txt" value="0">
		<input type="hidden" id="pigment" name="pigment_txt" value="0">
		<input type="hidden" id="sealer" name="sealer_txt" value="0"> 
		 
		<div class="top_cont display_block">	 	
		<div class="btm_cont display_block">			
			<input type="text" placeholder="Name the Job" name="job_name"> 		
		</div>
			<div class="po_cont pull-left">
				<ul>
					<li class="pull-left search_filter">
						<input type="text" name="cust_name" placeholder="Customer Name" onkeyup="get_customer();">
						
						<ul class="filter" style="display:none;"></ul>
					</li>
					<li class="pull-right">
						<input type="text" name="po_num" placeholder="PO Number" value="<?php echo $po; ?>">
					</li>
				</ul>

			</div>

			<div class="dte_cont pull-right">
				<?php 
				$today=date('Y-m-d');
				?>
				<table>
					<tbody>
						<tr>
							<td style="width: 49px; padding: 0px 5% 0px 0px;">From</td>
							<td style="width: 126px; position: relative;" class="padding-input">
								<input type="text" placeholder="<?php echo date('m/d/Y', strtotime($today)); ?>" name="from_date" class="datepicker" value="<?php echo date('m/d/Y', strtotime($today)); ?>" readonly>
								<div class="calndr_icns">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</div>
							</td>
							<td style="width: 49px; padding: 0px 5% 0px 0px;">To</td>
							<td style="width: 126px; position: relative;" class="padding-input">
								<input type="text" placeholder="<?php echo date('m/d/Y', strtotime($today)); ?>" name="to_date" class="datepicker" value="<?php echo date('m/d/Y', strtotime($today)); ?>">
								<div class="calndr_icns">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</div>
							</td>

						</tr>

					</tbody>
				</table>

			</div>
		</div>
	
		
		<div class="btm_cont display_block">
			<textarea  placeholder="Job Notes" name="job_notes"></textarea> 
		</div>
		<div class="close_lst">
			<ul>
				<li>
					<div class="image_clos 1">
						<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
						<div class="content_img">
							
							<div class="btn_cntnt file_custom">
								
								<input type="file" name="file_1" value="Upload" class="filestyle" onchange="readURL(this,1);"> 
							</div>
						</div> 
					</div>
					<div class="imag_info">
						<input type="text" name="caption_1" placeholder="Caption" class="filestyle">
					</div>
				</li>
				<li>
					<div class="image_clos 2">
						<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
						<div class="content_img">
							
							<div class="btn_cntnt file_custom">
								<input type="file" name="file_2" value="Upload" class="filestyle" onchange="readURL(this,2);"> 
							</div>
						</div>
					</div>
					<div class="imag_info">
						<input type="text" name="caption_2" placeholder="Caption">
					</div>
				</li> 
				<li>
					<div class="image_clos 3">
						<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
						<div class="content_img"> 
							
							<div class="btn_cntnt file_custom">
								<input type="file" name="file_3" value="Upload" class="filestyle" onchange="readURL(this,3);">  
							</div> 
						</div>
					</div>
					<div class="imag_info">
						<input type="text" name="caption_3" placeholder="Caption">
					</div>
				</li>
			</ul>
		</div>
		
		<!--<center><a class="custom orange mat_sec" href="javascript:void(0);" onclick="show_job_mat(1)">Show Materials</a></center>-->
		
		<div class="top_cont display_block portland_cont material_list" style="display:block;"> 	 	 
			<div class="row"> 
				<?php 
				$sql="select * from material_category where status='0'";
				$statement = $db->prepare($sql);  	   
				$statement->execute();   
				$result=$statement->fetchAll();   
				foreach($result as $row)
				{
					$cat_id=$row['id'];
					$cat_name=$row['name'];
					$small_cat_name=str_replace(' ','_',$row['name']);
					$small_cat_name=strtolower($small_cat_name);
					
				?>	
				<div class="col-sm-3 col_job">
					<h4><?php echo $cat_name; ?></h4>
					<ul>
						<?php
						$sql_1="select * from material where category='".$cat_id."'";
						$statement = $db->prepare($sql_1);  	   
						$statement->execute();   
						$result_1=$statement->fetchAll();   
						foreach($result_1 as $row_1)
						{ 
						?>
						<li>
							<input type="radio" name="<?php echo $small_cat_name; ?>" value="<?php echo $row_1['id']; ?>"><label><?php echo $row_1['descp']; ?></label> 
						</li>	 
						<?php
						}
						?>
					</ul>
				</div>
				<?php
				}
				?>
			</div>
		</div>

		
		<div class="closed_by_usr" style="border-top:none;">
			<div class="pull-right">
				<span>Created by <b> <?php echo get_user_detail($_SESSION['user_id'],'first_name'); ?> <?php echo get_user_detail($_SESSION['user_id'],'last_name'); ?></b></span>
				<button name="submit" class="custom" type="submit">Create Job</button>
				<img src="assets/images/loader-11.gif" id="cust_job_loader"style="display:none;" />
			</div> 
		</div>
	</form>
	<div class="result_job"></div>
	</div>
</div>
<?php	
}  


function addcustomerJob()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$temp_po=mysql_real_escape_string($_REQUEST['temp_po']); 
	$cust_id=mysql_real_escape_string($_REQUEST['cust_id']);
	$job_name=mysql_real_escape_string($_REQUEST['job_name']);
	$po=mysql_real_escape_string($_REQUEST['po_num']);
	$from_date=date('Y-m-d', strtotime($_REQUEST['from_date']));
	$to_date=date('Y-m-d', strtotime($_REQUEST['to_date']));
	$job_insert_by=$_REQUEST['job_insert_by'];
	$job_name=mysql_real_escape_string($_REQUEST['job_name']);
	
	$finalimage_1_caption=mysql_real_escape_string($_REQUEST['caption_1']);
	$finalimage_2_caption=mysql_real_escape_string($_REQUEST['caption_2']);
	$finalimage_3_caption=mysql_real_escape_string($_REQUEST['caption_3']);

	$job_notes=$_REQUEST['job_notes']; 
	
	$portland_concrete=$_REQUEST['port_txt']; 
	$sand=$_REQUEST['sand_txt']; 
	$pigments=$_REQUEST['pigment_txt']; 
	$sealer=$_REQUEST['sealer_txt'];   

	$cr_date=date("Y-m-d H:i:s");  
	$cr_datee=date("YmdHis");

	
	$MaterialArray = array('portland_concrete' => $portland_concrete, 'sand' => $sand, 'pigments' => $pigments,'sealer'=>$sealer);
    $Material=json_encode($MaterialArray); 
	
	
	
	$arr=array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF');
	$file_1=$_FILES['file_1']['name'];
	$file_2=$_FILES['file_2']['name'];
	$file_3=$_FILES['file_3']['name'];
	
	
	if($file_1!='')
	{
		$image=$cr_datee.$file_1;

		$finalimage_1=str_replace(' ','-',$image);

		$path=ABSPATH.'job_image/'.$finalimage_1; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_1"]["tmp_name"],$path);
		}
		else 
		{
			echo "11";
			die;
		}
	} 
	else
	{
		$finalimage_1='';
	}
	
	if($file_2!='')
	{
		$image=$cr_datee.$file_2;

		$finalimage_2=str_replace(' ','-',$image);

		$path=ABSPATH.'job_image/'.$finalimage_2; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_2"]["tmp_name"],$path);
		}
		else 
		{
			echo "11";
			die;
		}
	} 
	else
	{
		$finalimage_2='';
	}
	
	if($file_3!='')
	{
		$image=$cr_datee.$file_3;

		$finalimage_3=str_replace(' ','-',$image);

		$path=ABSPATH.'job_image/'.$finalimage_3; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_3"]["tmp_name"],$path);
		}
		else 
		{
			echo "11";
			die;
		}
	} 
	else
	{
		$finalimage_3='';
	}

	if($to_date < $from_date)
	{
		echo "0";
		die;
	} 
	else
	{
		$sql="INSERT INTO  customer_job (name,cust_id,po,from_date,to_date,status,vendor_id ,cr_date,job_insert_by,temp_po,closing_date,job_notes,photo_1,photo_1_caption,photo_2,photo_2_caption,photo_3,photo_3_caption,material) VALUES ('".$job_name."','".$cust_id."','".$po."','".$from_date."','".$to_date."','1','0','".$cr_date."','".$job_insert_by."','".$temp_po."','0000-00-00','".$job_notes."','".$finalimage_1."','".$finalimage_1_caption."','".$finalimage_2."','".$finalimage_2_caption."','".$finalimage_3."','".$finalimage_3_caption."','".$Material."')"; 
		 
		
		$statement = $db->prepare($sql);  	 
		$statement->execute();   
		
				
		$sql_get="select id from customer_job where temp_po='".$temp_po."'";
		$statement = $db->prepare($sql_get); 	
		$statement->execute();    
		$result=$statement->fetchAll();   
		foreach($result as $row)
		{ 
			echo $id=$row['id'];
		} 
		 
		/*
		
		if(!empty($id))
		{
			$ins="insert into job_last_updated (job_id,status,last_updated,last_email_sent) values ('".$id."','1','".$cr_date."','".$cr_date."')"; 
			$statement = $db->prepare($ins); 	
			$statement->execute();   
			echo $id;
		} 
		
		*/
	}

} 


function getCustomer()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
	$cust_name=$_REQUEST['cust'];
	$sql="SELECT * FROM  `customer` WHERE (company like '%".$cust_name."%') or (CONCAT(first_name,' ',last_name ) LIKE  '%".$cust_name."%')";
	$statement = $db->prepare($sql); 	
	$statement->execute();    
	$result=$statement->fetchAll();  
	foreach($result as $row)
	{
		$id=$row['id'];
		$company=$row['company'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		if($company!='')
		{
			$asd=$company;
		}
		else
		{
			$asd=$first_name.' '.$last_name;
		}


	?>
		<li><a href="javascript:void(0);" onclick="set_name('<?php echo $id; ?>','<?php echo $asd; ?>');"><?php echo $asd; ?></a></li> 
	<?php
	} 

}

function EditJobForm()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);
	$job_id=$_REQUEST['job_id'];
?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>   
<div class="new_custmer clear"><h4 class="close_title pull-left">EDIT JOB</h4>
	<a class="close_new pull-right" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i></a>
	
</div>
<div class="inner_content">
	<div class="inner_pdng">
	<?php
	$sql_count="select temp_po from customer_job order by id desc limit 0,1";
	$statement = $db->prepare($sql_count); 	
	$statement->execute();   
	$count=$statement->rowCount();  
	$result=$statement->fetchAll();  
	$po=0;
	if($count==0)
	{
		$po=1000;
	}	
	else
	{
		foreach($result as $row)
		{
			$po=$row['temp_po'];
		}	
		$po=$po+1;
	}
	$cust_id=get_cust_job_detail($job_id,'cust_id');	
	
	$from_date=get_cust_job_detail($job_id,'from_date');
	$from_date=date('m/d/Y', strtotime($from_date)); 
	
	$to_date=get_cust_job_detail($job_id,'to_date');
	$to_date=date('m/d/Y', strtotime($to_date));  
	
	?>
	<form name="edit_job" id="edit_job" action="" method="post" class="new_job"> 
		<input type="hidden" name="job_id" id="job_id" value="<?php echo $job_id; ?>">  
		<input type="hidden" name="cust_id" id="cust_id" value="<?php echo get_cust_job_detail($job_id,'cust_id'); ?>"> 
		<input type="hidden" name="temp_po" value="<?php echo $po; ?>">
		<input type="hidden" name="job_insert_by" value="<?php echo $_SESSION['user_id']; ?>">
		<input type="hidden" name="action" value="editcustomerJob">
		<div class="top_cont display_block">	 	
		<div class="btm_cont display_block">			
			<input type="text" placeholder="Name the Job" name="job_name" value="<?php echo get_cust_job_detail($job_id,'name'); ?>"> 		
		</div> 
			<div class="po_cont pull-left">
				<ul>
					<li class="pull-left search_filter">
						<input type="text" name="cust_name" placeholder="Customer Name" onkeyup="get_customer();" value="<?php echo get_cust_detail($cust_id,'company'); ?>"> 
						
						<ul class="filter" style="display:none;"></ul>
					</li>
					<li class="pull-right">
						<input type="text" name="po_num" placeholder="PO Number" value="<?php echo get_cust_job_detail($job_id,'po'); ?>">   
					</li>
				</ul>

			</div>

			<div class="dte_cont pull-right">
				<?php 
				$today=date('Y-m-d');
				?>
				<table>
					<tbody>
						<tr>
							<td style="width: 49px; padding: 0px 5% 0px 0px;">From</td>
							<td class="padding-input" style="width: 126px; position: relative;">
								<input type="text" readonly value="<?php echo $from_date; ?>" class="datepicker" name="from_date" placeholder="<?php echo $from_date; ?>">
								<div class="calndr_icns"> 
									<i aria-hidden="true" class="fa fa-calendar"></i>
								</div>
							</td>
							<td style="width: 49px; padding: 0px 5% 0px 0px;">To</td>
							<td class="padding-input" style="width: 126px; position: relative;">
								<input type="text" value="<?php echo $to_date; ?>" class="datepicker" name="to_date" placeholder="<?php echo $to_date; ?>"> 
								<div class="calndr_icns"> 
									<i aria-hidden="true" class="fa fa-calendar"></i>
								</div>
							</td>
						</tr> 

					</tbody>
				</table>

			</div>
		</div>
	
		
		<div class="btm_cont display_block">
			<textarea  placeholder="Job Notes" name="job_notes"><?php echo get_cust_job_detail($job_id,'job_notes'); ?></textarea> 
		</div>
		<div class="close_lst">
			<ul>
				<li>
					<div class="image_clos 1">
						
						<?php 
						$photo_1=get_cust_job_detail($job_id,'photo_1'); 
						if($photo_1!="")
						{	
						?>
							<img src="<?php echo SITE_URL; ?>job_image/thumb.php?src=<?php echo $photo_1; ?>&w=320&h=250">
						<?php
						}
						else
						{
						?>	
							<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
						<?php
						}
						?>	
						
						<div class="content_img">
							
							<div class="btn_cntnt file_custom">
								
								<input type="file" name="file_1" value="Upload" class="filestyle" onchange="readURL(this,1);"> 
							</div>
						</div> 
					</div>
					<div class="imag_info">
						<input type="text" name="caption_1" placeholder="Caption" class="filestyle" value="<?php echo get_cust_job_detail($job_id,'photo_1_caption');  ?>">
					</div>
				</li>
				<li>
					<div class="image_clos 2">
						
						<?php 
						$photo_2=get_cust_job_detail($job_id,'photo_2'); 
						if($photo_1!="")
						{	
						?>
							<img src="<?php echo SITE_URL; ?>job_image/thumb.php?src=<?php echo $photo_2; ?>&w=320&h=250">
						<?php
						}
						else
						{
						?>	
							<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
						<?php
						}
						?>	
						
						<div class="content_img">
							
							<div class="btn_cntnt file_custom">
								
								<input type="file" name="file_2" value="Upload" class="filestyle" onchange="readURL(this,2);"> 
							</div>
						</div> 
					</div>
					<div class="imag_info">
						<input type="text" name="caption_2" placeholder="Caption" class="filestyle" value="<?php echo get_cust_job_detail($job_id,'photo_2_caption');  ?>"> 
					</div>
				</li>
				<li>
					<div class="image_clos 3">
						
						<?php 
						$photo_3=get_cust_job_detail($job_id,'photo_3'); 
						if($photo_3!="") 
						{	
						?>
							<img src="<?php echo SITE_URL; ?>job_image/thumb.php?src=<?php echo $photo_3; ?>&w=320&h=250">
						<?php
						}
						else
						{
						?>	
							<img alt="" src="<?php echo SITE_URL; ?>assets/images/upload_bg.jpg">
						<?php
						} 
						?>	
						
						<div class="content_img">
							
							<div class="btn_cntnt file_custom">
								<input type="file" name="file_3" value="Upload" class="filestyle" onchange="readURL(this,3);"> 
							</div>   
						</div> 
					</div>
					<div class="imag_info">
						<input type="text" name="caption_3" placeholder="Caption" class="filestyle" value="<?php echo get_cust_job_detail($job_id,'photo_3_caption');  ?>">  
					</div>
				</li> 
			</ul>
		</div> 
		<div class="top_cont display_block portland_cont material_list"> 	 	 
			<?php 
				$material=get_cust_job_detail($job_id,'material'); 
				$materialArray=json_decode($material);
				$port=$materialArray->portland_concrete;
				$sand=$materialArray->sand;
				$pigments=$materialArray->pigments;
				$sealer=$materialArray->sealer;
			?> 
			<div class="row"> 
				<input type="hidden" id="job_id" value="<?php echo $job_id; ?>" >
				<div class="col-sm-3 col_job">
					<h4>Portland Concrete</h4> 
					<ul>
						<?php
						$sql_1="select * from material where category='1'";
						$statement = $db->prepare($sql_1);  	   
						$statement->execute();   
						$result_1=$statement->fetchAll();   
						foreach($result_1 as $row_1)
						{ 
						?>
						<li>
							<input class="mat_check" type="radio" name="portland_concrete" value="<?php echo $row_1['id']; ?>" <?php if($port==$row_1['id']) { echo 'checked'; } ?>><label><?php echo $row_1['descp']; ?></label>
						</li>	   
						<?php
						}
						?>
					</ul>
				</div>
				<div class="col-sm-3 col_job"> 
					<h4>Sand</h4>
					<ul>
						<?php
						$sql_1="select * from material where category='2'";
						$statement = $db->prepare($sql_1);  	   
						$statement->execute();   
						$result_1=$statement->fetchAll();   
						foreach($result_1 as $row_1)
						{ 
						?>
						<li>
							<input class="mat_check" type="radio" name="sand" value="<?php echo $row_1['id']; ?>" <?php if($sand==$row_1['id']) { echo 'checked'; } ?>><label><?php echo $row_1['descp']; ?></label>
						</li>	   
						<?php
						}
						?>
					</ul>
				</div>
				<div class="col-sm-3 col_job"> 
					<h4>Pigments</h4>
					<ul>
						<?php
						$sql_1="select * from material where category='3'";
						$statement = $db->prepare($sql_1);  	   
						$statement->execute();   
						$result_1=$statement->fetchAll();   
						foreach($result_1 as $row_1)
						{ 
						?>
						<li>
							<input class="mat_check" type="radio" name="pigments" value="<?php echo $row_1['id']; ?>" <?php if($pigments==$row_1['id']) { echo 'checked'; } ?>><label><?php echo $row_1['descp']; ?></label>
						</li>	   
						<?php
						}
						?>
					</ul>
				</div>
				<div class="col-sm-3 col_job">
					<h4>Sealer</h4>
					<ul>
						<?php
						$sql_1="select * from material where category='4'";
						$statement = $db->prepare($sql_1);  	    
						$statement->execute();   
						$result_1=$statement->fetchAll();   
						foreach($result_1 as $row_1)
						{ 
						?>
						<li>
							<input class="mat_check" type="radio" name="sealer" value="<?php echo $row_1['id']; ?>" <?php if($sealer==$row_1['id']) { echo 'checked'; } ?> ><label><?php echo $row_1['descp']; ?></label> 
						</li>	   
						<?php
						}
						?>
					</ul>
				</div>
				
			</div>
		</div>
		<div class="closed_by_usr">
			<div class="pull-right">
				<span>Created by <b> <?php echo get_user_detail($_SESSION['user_id'],'first_name'); ?> <?php echo get_user_detail($_SESSION['user_id'],'last_name'); ?></b></span>
				<button name="submit" class="custom" type="submit">Save Job</button>
				<img src="assets/images/loader-11.gif" id="cust_job_loader"style="display:none;" />
			</div> 
		</div>
	</form>
	<div class="result_job"></div>
	</div>
</div>
<?php	
}

function editcustomerJob()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$temp_po=mysql_real_escape_string($_REQUEST['temp_po']);
	$cust_id=mysql_real_escape_string($_REQUEST['cust_id']);
	$job_name=mysql_real_escape_string($_REQUEST['job_name']);
	$po=mysql_real_escape_string($_REQUEST['po_num']);
	$from_date=date('Y-m-d', strtotime($_REQUEST['from_date']));
	$to_date=date('Y-m-d', strtotime($_REQUEST['to_date']));
	$job_insert_by=$_REQUEST['job_insert_by'];
	$job_name=mysql_real_escape_string($_REQUEST['job_name']);
	
	$finalimage_1_caption=mysql_real_escape_string($_REQUEST['caption_1']);
	$finalimage_2_caption=mysql_real_escape_string($_REQUEST['caption_2']);
	$finalimage_3_caption=mysql_real_escape_string($_REQUEST['caption_3']);

	$job_notes=$_REQUEST['job_notes']; 
	
	$portland_concrete=$_REQUEST['portland_concrete']; 
	$sand=$_REQUEST['sand']; 
	$pigments=$_REQUEST['pigments']; 
	$sealer=$_REQUEST['sealer'];     

	$cr_date=date("Y-m-d H:i:s");  
	$cr_datee=date("YmdHis");

	
	$MaterialArray = array('portland_concrete' => $portland_concrete, 'sand' => $sand, 'pigments' => $pigments,'sealer'=>$sealer);
    $Material=json_encode($MaterialArray); 


	$arr=array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF');
	$file_1=$_FILES['file_1']['name'];
	$file_2=$_FILES['file_2']['name'];
	$file_3=$_FILES['file_3']['name'];
	
	if($to_date < $from_date)
	{
		echo "0";
		die;
	} 
	
	if($file_1!='')
	{
		$image=$cr_datee.$file_1;

		$finalimage_1=str_replace(' ','-',$image);

		$path=ABSPATH.'job_image/'.$finalimage_1; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_1"]["tmp_name"],$path);
		
		 	$sql="update customer_job set name='".$job_name."',po='".$po."',from_date='".$from_date."',to_date='".$to_date."',job_insert_by='".$job_insert_by."',photo_1='".$finalimage_1."',photo_1_caption='".$finalimage_1_caption."',photo_2_caption='".$finalimage_2_caption."',photo_3_caption='".$finalimage_3_caption."' where id='".$job_id."'";
		
		}
		else 
		{
			echo "11";
			die;
		}
	} 
	else if($file_2!='')
	{
		$image=$cr_datee.$file_2;

		$finalimage_2=str_replace(' ','-',$image);

		$path=ABSPATH.'job_image/'.$finalimage_2; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_2"]["tmp_name"],$path);
			$sql="update customer_job set name='".$job_name."',po='".$po."',from_date='".$from_date."',to_date='".$to_date."',job_insert_by='".$job_insert_by."',photo_2='".$finalimage_2."',photo_1_caption='".$finalimage_1_caption."',photo_2_caption='".$finalimage_2_caption."',photo_3_caption='".$finalimage_3_caption."' where id='".$job_id."'";
		} 
		else 
		{
			echo "11";
			die;
		}
	} 
	else if($file_3!='')
	{
		$image=$cr_datee.$file_3;

		$finalimage_3=str_replace(' ','-',$image);

		$path=ABSPATH.'job_image/'.$finalimage_3; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_3"]["tmp_name"],$path);
			$sql="update customer_job set name='".$job_name."',po='".$po."',from_date='".$from_date."',to_date='".$to_date."',job_insert_by='".$job_insert_by."',photo_3='".$finalimage_3."',photo_1_caption='".$finalimage_1_caption."',photo_2_caption='".$finalimage_2_caption."',photo_3_caption='".$finalimage_3_caption."' where id='".$job_id."'";
		}
		else  
		{
			echo "11";
			die;
		}
	} 
	else
	{
		$sql="update customer_job set name='".$job_name."',po='".$po."',from_date='".$from_date."',to_date='".$to_date."',job_insert_by='".$job_insert_by."',photo_1_caption='".$finalimage_1_caption."',photo_2_caption='".$finalimage_2_caption."',photo_3_caption='".$finalimage_3_caption."' where id='".$job_id."'";
		
	}
	$statement = $db->prepare($sql);  	   
	$statement->execute();   
	
	
	
	$sql="update customer_job set material='".$Material."' where id='".$job_id."'";
	$statement = $db->prepare($sql); 	 
	$statement->execute();  
	
	
	
	echo "1"; 
}


 
function AddJobMaterial()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$job_id=$_REQUEST['job_id'];
	$concrete=$_REQUEST['con'];
	$sand=$_REQUEST['sand'];
	$pigment=$_REQUEST['pigment'];
	$sealer=$_REQUEST['sealer'];
	
	if(!empty($concrete))
	{	
		$concreteArray=array_filter($concrete);
		$concrete=serialize($concreteArray); 
	}
	if(!empty($sand))
	{	
		$sandArray=array_filter($sand);
		$sand=serialize($sandArray); 
	}
	if(!empty($pigment))
	{	
		$pigmentArray=array_filter($pigment);
		$pigment=serialize($pigmentArray); 
	}
	if(!empty($sealer))
	{	
		$sealerArray=array_filter($sealer);
		$sealer=serialize($sealerArray); 
	} 
	
	
	$sql="insert into job_material (job_id,concrete,sand,pigments,sealer) values ('".$job_id."','".$concrete."','".$sand."','".$pigment."','".$sealer."')";
	$statement = $db->prepare($sql);  	   
	$statement->execute();   
	echo "1";
} 



function AddPiece()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$cr_date=date("Y-m-d H:i:s");  
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$piece_name=mysql_real_escape_string($_REQUEST['piece_name']);
	$recipe=mysql_real_escape_string($_REQUEST['recipe']);
	
	$thick=mysql_real_escape_string($_REQUEST['thick']);
	$length=mysql_real_escape_string($_REQUEST['height']);
	$width=mysql_real_escape_string($_REQUEST['width']);
	$cubic_sq_ft=mysql_real_escape_string($_REQUEST['cubic_sq_ft']);
	$cubic_sq_ft_int=mysql_real_escape_string($_REQUEST['cubic_sq_ft_int']);
	$tot_abs_vol=mysql_real_escape_string($_REQUEST['tot_abs_vol']);
	
	$water=mysql_real_escape_string($_REQUEST['water']);
	
	$csa_per=mysql_real_escape_string($_REQUEST['csa_per']);
	$silica_fume_per=mysql_real_escape_string($_REQUEST['silica_fume_per']);
	
	
	$weight=$_REQUEST['new_tot_weight'];
	$cost=$_REQUEST['new_tot_cost'];
	$ab_vol=$_REQUEST['new_tot_ab_val'];
	$per=$_REQUEST['new_tot_per'];
	
	$weightArray=explode(',',$weight);
	$costArray=explode(',',$cost);
	$ab_volArray=explode(',',$ab_vol);
	$perArray=explode(',',$per);
	
	$array = array('weight' => $weightArray);
    $json_weight=json_encode($array); 
	
	$array_1 = array('cost' => $costArray);
	$json_cost=json_encode($array_1); 
	
	$array_2 = array('ab_vol' => $ab_volArray);
	$json_ab_val=json_encode($array_2); 
	
	$array_3 = array('per' => $perArray);
	$json_per=json_encode($array_3);  
	 
	
	
	$total_weight=$_REQUEST['new_total_weight'];
	$total_cost=$_REQUEST['new_total_cost'];
	$total_ab_val=$_REQUEST['new_total_ab_val'];  
	
	$count=check_job_piece($job_id,$piece_name);
	if($count==0)
	{
		$sql="insert into job_piece (job_id,piece_name,status) values ('".$job_id."','".$piece_name."','1')";
		$statement = $db->prepare($sql);    	    
		$statement->execute();     
	}	
	 
	$piece_id=get_peice_name_info($piece_name,'id');  
	
	$sql="insert into job_piece_component (job_id,piece_id,component,thick,length,width,cubic_sq,cubic_sq_int,water,weight,cost,ab_val,percentage,total_weight,total_cost,tot_abs_vol,csa_per,fume_per,cr_date,status) values ('".$job_id."','".$piece_id."','".$recipe."','".$thick."','".$length."','".$width."','".$cubic_sq_ft."','".$cubic_sq_ft_int."','".$water."','".$json_weight."','".$json_cost."','".$json_ab_val."','".$json_per."','".$total_weight."','".$total_cost."','".$total_ab_val."','".$csa_per."','".$silica_fume_per."','".$cr_date."','1')";   
	$statement = $db->prepare($sql);    	      
	$statement->execute();    
	echo $piece_id;   
	 
} 

function EditPieceComp()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$cr_date=date("Y-m-d H:i:s");  
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$piece_id=mysql_real_escape_string($_REQUEST['piece_id']);
	$pc_comp_id=mysql_real_escape_string($_REQUEST['pc_comp_id']);
	 
	 
	$thick=mysql_real_escape_string($_REQUEST['thick']);
	$length=mysql_real_escape_string($_REQUEST['height']);
	$width=mysql_real_escape_string($_REQUEST['width']);
	$cubic_sq_ft=mysql_real_escape_string($_REQUEST['cubic_sq_ft']);
	$cubic_sq_ft_int=mysql_real_escape_string($_REQUEST['cubic_sq_ft_int']);
	$tot_abs_vol=mysql_real_escape_string($_REQUEST['tot_abs_vol']); 
	
	$water=mysql_real_escape_string($_REQUEST['water']);
	
	
	$weight=$_REQUEST['new_tot_weight'];
	$cost=$_REQUEST['new_tot_cost'];
	$ab_vol=$_REQUEST['new_tot_ab_val'];
	$per=$_REQUEST['new_tot_per'];  
	 
	$weightArray=explode(',',$weight);
	$costArray=explode(',',$cost);
	$ab_volArray=explode(',',$ab_vol);
	$perArray=explode(',',$per);
	
	$array = array('weight' => $weightArray);
    $json_weight=json_encode($array); 
	
	$array_1 = array('cost' => $costArray);
	$json_cost=json_encode($array_1); 
	
	$array_2 = array('ab_vol' => $ab_volArray);
	$json_ab_val=json_encode($array_2);  
	
	$array_3 = array('per' => $perArray);
	$json_per=json_encode($array_3);  
	 
	
	
	$total_weight=$_REQUEST['new_total_weight'];
	$total_cost=$_REQUEST['new_total_cost'];
	$total_ab_val=$_REQUEST['new_total_ab_val'];  
	$silica_fume=$_REQUEST['silica_fume_per'];  
	$csa_per=$_REQUEST['csa_per'];  
	
	
	
	$sql="update job_piece_component set weight='".$json_weight."',cost='".$json_cost."',ab_val='".$json_ab_val."',total_weight='".$total_weight."',total_cost='".$total_cost."',tot_abs_vol='".$total_ab_val."',water='".$water."',csa_per='".$csa_per."',fume_per='".$silica_fume."',percentage='".$json_per."' where id='".$pc_comp_id."'"; 
	$statement = $db->prepare($sql);   	      
	$statement->execute();       
	
	echo "1"; 
	 
}


function EditComponentShow() 
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$cr_date=date("Y-m-d H:i:s");  
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$piece_id=mysql_real_escape_string($_REQUEST['piece_id']);
	$comp_id=mysql_real_escape_string($_REQUEST['comp_id']);
	
	$sql="select * from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."' and component='".$comp_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		$pc_cmp_id=$row['id'];
	}	 
	
	include('edit-component.php');
}

function ViewComponentShow() 
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$cr_date=date("Y-m-d H:i:s");  
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$piece_id=mysql_real_escape_string($_REQUEST['piece_id']);
	$comp_id=mysql_real_escape_string($_REQUEST['comp_id']);
	
	$sql="select * from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."' and component='".$comp_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		$pc_cmp_id=$row['id'];
	}	 
	
	include('view-component.php'); 
}

function AddComponentShow() 
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$cr_date=date("Y-m-d H:i:s");  
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$piece_id=mysql_real_escape_string($_REQUEST['piece_id']);
	$comp_id=mysql_real_escape_string($_REQUEST['comp_id']);
	
	$sql="select * from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."' and component='".$comp_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
		$pc_cmp_id=$row['id'];
	}	 
	
	include('add-component.php'); 
}


function EditPieceShow()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$peice_id=mysql_real_escape_string($_REQUEST['peice_id']);
?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/job.js"></script>   
<div class="new_custmer clear">
<h4 class="close_title pull-left">EDIT PIECE</h4>
	<a class="close_new pull-right" onclick="jQuery('#fromToggle').slideUp();" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-times"></i>
	</a>
</div> 
<div class="inner_content">
	<div class="inner_pdng">
		<form name="edit_piece" id="edit_piece" action="" method="post" class="new_job"> 
		<input name="peice_id" id="peice_id" type="hidden" value="<?php echo $peice_id; ?>"> 
		<input name="action" value="EditPiece" type="hidden">
		<div class="top_cont display_block">	 	
		<div class="btm_cont display_block"> 			
			<input placeholder="Name the Piece" name="piece_name" type="text" value="<?php echo get_peice_info($peice_id,'piece_name'); ?>">  		
		</div>
		</div>
		
		<div class="closed_by_usr" style="border-top:none;">
			<div class="pull-right">
				<button name="submit" class="custom" type="submit">Save</button>
				<img src="assets/images/loader-11.gif" id="cust_job_loader" style="display:none;">
			</div> 
		</div> 
	</form>
	<div class="result_job"></div>
	</div>
</div>
<?php	
}

function EditPiece()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$peice_id=mysql_real_escape_string($_REQUEST['peice_id']);
	$piece_name=mysql_real_escape_string($_REQUEST['piece_name']);
	
	$sql="update job_piece set piece_name='".$piece_name."' where id='".$peice_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  
	echo "1";
}

function DeleteComponent()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$pc_comp_id=mysql_real_escape_string($_REQUEST['comp_id']);
		
	$sql="delete from job_piece_component where id='".$pc_comp_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();   
	echo "1";
}


function AddPieceComp() 
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$cr_date=date("Y-m-d H:i:s");   
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$piece_id=mysql_real_escape_string($_REQUEST['piece_id']);
	$recipe=mysql_real_escape_string($_REQUEST['comp_id']);
	
	$thick=mysql_real_escape_string($_REQUEST['thick']);
	$length=mysql_real_escape_string($_REQUEST['height']);
	$width=mysql_real_escape_string($_REQUEST['width']);
	$cubic_sq_ft=mysql_real_escape_string($_REQUEST['cubic_sq_ft']);
	$cubic_sq_ft_int=mysql_real_escape_string($_REQUEST['cubic_sq_ft_int']);
	
	$csa_per=mysql_real_escape_string($_REQUEST['csa_per']);
	$silica_fume_per=mysql_real_escape_string($_REQUEST['silica_fume_per']);
	
	$water=mysql_real_escape_string($_REQUEST['water']);
	
	 
	$weight=$_REQUEST['new_tot_weight'];
	$cost=$_REQUEST['new_tot_cost'];
	$ab_vol=$_REQUEST['new_tot_ab_val'];
	$per=$_REQUEST['new_tot_per'];
	
	$weightArray=explode(',',$weight);
	$costArray=explode(',',$cost);
	$ab_volArray=explode(',',$ab_vol);
	$perArray=explode(',',$per); 
	
	$array = array('weight' => $weightArray);
    $json_weight=json_encode($array); 
	
	$array_1 = array('cost' => $costArray);
	$json_cost=json_encode($array_1); 
	
	$array_2 = array('ab_vol' => $ab_volArray);
	$json_ab_val=json_encode($array_2);  
	 
	
	$array_3 = array('per' => $perArray);
	$json_per=json_encode($array_3);   
	
	$total_weight=$_REQUEST['new_total_weight'];
	$total_cost=$_REQUEST['new_total_cost'];
	$total_ab_val=$_REQUEST['new_total_ab_val'];  
	
	
	 
	
	$sql="insert into job_piece_component (job_id,piece_id,component,thick,length,width,cubic_sq,cubic_sq_int,water,weight,cost,ab_val,percentage,total_weight,total_cost,tot_abs_vol,csa_per,fume_per,cr_date,status) values ('".$job_id."','".$piece_id."','".$recipe."','".$thick."','".$length."','".$width."','".$cubic_sq_ft."','".$cubic_sq_ft_int."','".$water."','".$json_weight."','".$json_cost."','".$json_ab_val."','".$json_per."','".$total_weight."','".$total_cost."','".$total_ab_val."','".$csa_per."','".$silica_fume_per."','".$cr_date."','1')";   
	 
	
	$statement = $db->prepare($sql);   	    
	$statement->execute();    
		
	
	echo "1";  
	 
} 

function DeletePiece()
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$piece_id=mysql_real_escape_string($_REQUEST['piece_id']);
		
	$sql="delete from job_piece where id='".$piece_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  

	$sql="delete from job_piece_component where piece_id='".$piece_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  	
	
	echo "1";  
}


function AssignMaterial() 
{
	$db = get_connection(); 
	unset($_REQUEST['action']); 
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$portland_concrete=mysql_real_escape_string($_REQUEST['port']);
	$sand=mysql_real_escape_string($_REQUEST['sand']);
	$pigments=mysql_real_escape_string($_REQUEST['pigments']);
	$sealer=mysql_real_escape_string($_REQUEST['sealer']);
	
	$matArray = array('portland_concrete' => $portland_concrete, 'sand' => $sand, 'pigments' => $pigments,'sealer'=>$sealer);
    $material=json_encode($matArray); 
	 
	$sql="update customer_job set material='".$material."' where id='".$job_id."'";
	$statement = $db->prepare($sql);	
	$statement->execute();  	
	echo "1"; 
}

function LockUnlockPiece() 
{
	$db = get_connection(); 
	unset($_REQUEST['action']);   
	$piece_id=mysql_real_escape_string($_REQUEST['peice_id']);
	$status=mysql_real_escape_string($_REQUEST['status']);
	
	$sql="update job_piece set status='".$status."' where id='".$piece_id."'";
	
	$statement = $db->prepare($sql);   	 
	$statement->execute();   	
	echo "1"; 
}


function CalWater()
{
	unset($_REQUEST['action']); 
	include("phpequations.class.php");
	$water=$_REQUEST['water'];
	$csa=$_REQUEST['csa'];
	$fume=$_REQUEST['fume'];
	$path=SITE_URL .'math/example.php?water='.$water.'&csa='.$csa.'&fume='.$fume;
 								
	$url = $path;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	$strlen=strlen($data);
	
	if($strlen > 1) 
	{
		echo number_format($data, 2, '.', '');
	} 
	else 
	{
		echo 0; 
	}	
}

function CalCsa()
{
	unset($_REQUEST['action']);  
	include("phpequations.class.php");
	$water=$_REQUEST['water'];
	$csa=$_REQUEST['csa'];
	$fume=$_REQUEST['fume'];
	$path=SITE_URL .'math/example.php?water='.$water."&csa=".$csa.'&fume='.$fume;
	  
	$url = $path;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch); 
	$strlen=strlen($data);
	
	if($strlen > 1) 
	{
		echo number_format($data, 2, '.', '');
	} 
	else 
	{
		echo 0; 
	}		
}
function Calsilicafume()
{
	unset($_REQUEST['action']);  
	include("phpequations.class.php");
	$water=$_REQUEST['water'];
	$fume=$_REQUEST['fume'];
	$csa=$_REQUEST['csa']; 
	$path=SITE_URL .'math/example.php?water='.$water."&fume=".$fume.'&csa='.$csa; 
	 
	$url = $path; 
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);  
	$strlen=strlen($data);
	
	if($strlen > 1) 
	{
		echo number_format($data, 2, '.', '');
	} 
	else 
	{
		echo 0; 
	}		
}

function ShowCloseForm()
{
	$db = get_connection(); 
	unset($_REQUEST['action']);   
	$user_id=mysql_real_escape_string($_REQUEST['user_id']);
	$job_id=mysql_real_escape_string($_REQUEST['job_id']); 
	include('close_job.php'); 
}

function CloseJob()
{
	$today = date("Y-m-d H:i:s");
	$db = get_connection(); 
	unset($_REQUEST['action']);   
	$user_id=mysql_real_escape_string($_REQUEST['user_id']);
	$job_id=mysql_real_escape_string($_REQUEST['job_id']);
	$pr_num=mysql_real_escape_string($_REQUEST['pr_num']);
	$close_notes=mysql_real_escape_string($_REQUEST['close_notes']);
	
	$caption_1=mysql_real_escape_string($_REQUEST['caption_1']);
	$caption_2=mysql_real_escape_string($_REQUEST['caption_2']);
	$caption_3=mysql_real_escape_string($_REQUEST['caption_3']);
	
	$arr=array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF');
	$file_1=$_FILES['file_1']['name'];
	$file_2=$_FILES['file_2']['name'];
	$file_3=$_FILES['file_3']['name'];
	
	
	if($file_1!='')
	{
		$image=$cr_datee.$file_1;

		$finalimage_1=str_replace(' ','-',$image);

		$path=ABSPATH.'close_job/'.$finalimage_1; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_1"]["tmp_name"],$path);
		}
		else 
		{
			echo "11";
			die;
		}
	} 
	else
	{
		$finalimage_1='';
	}
	
	if($file_2!='')
	{
		$image=$cr_datee.$file_2;

		$finalimage_2=str_replace(' ','-',$image);

		$path=ABSPATH.'close_job/'.$finalimage_2; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_2"]["tmp_name"],$path);
		}
		else 
		{
			echo "11";
			die;
		}
	} 
	else
	{
		$finalimage_2='';
	}
	
	if($file_3!='')
	{
		$image=$cr_datee.$file_3;

		$finalimage_3=str_replace(' ','-',$image);

		$path=ABSPATH.'close_job/'.$finalimage_3; 
		
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		if (in_array($ext, $arr)) {
			move_uploaded_file($_FILES["file_3"]["tmp_name"],$path);
		}
		else 
		{
			echo "11";
			die;
		}
	} 
	else
	{
		$finalimage_3='';
	}
	
	$sql="insert into close_job (job_id,pr_num,close_notes,photo_1,caption_1,photo_2,caption_2,photo_3,caption_3,close_by,cr_date,status) values('".$job_id."','".$pr_num."','".$close_notes."','".$finalimage_1."','".$caption_1."','".$finalimage_2."','".$caption_2."','".$finalimage_3."','".$caption_3."','".$user_id."','".$today."','1')";
	
	$statement = $db->prepare($sql);   	 
	$statement->execute();

	$sql="update customer_job set closing_notes='1' where id='".$job_id."'";
   	$statement = $db->prepare($sql);     	 
	$statement->execute();
	echo "1"; 
	
}
 
?>	
	