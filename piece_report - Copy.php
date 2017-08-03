<?php
require_once  'config/constants.php';
require_once   'config/functions.php';
$db = get_connection();
$job_id=$_GET['job_id'];
$piece_id=$_GET['piece_id'];
$cust_id=get_cust_job_detail($job_id,'cust_id');


$sql="select SUM(total_weight) 'total_weight' from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."'";
$statement = $db->prepare($sql);  	   
$statement->execute(); 
$result=$statement->fetchAll(); 
foreach($result as $row)
{
	$toto_wgt=$row['total_weight'];
}

$sql="select SUM(total_cost) 'total_cost' from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."'";
$statement = $db->prepare($sql);   	   
$statement->execute(); 
$result=$statement->fetchAll(); 
foreach($result as $row)
{
	$toto_cost=$row['total_cost'];
}		

if($toto_wgt=="")
{
	$toto_wgt=0;
}

if($toto_cost=="")
{
	$toto_cost=0;
}


$sql="select * from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."' ";
$statement = $db->prepare($sql); 	
$statement->execute();   
$result=$statement->fetchAll(); 
foreach($result as $row)
{ 
	$activeArray[]=$row['component'];
}


$material=get_cust_job_detail($job_id,'material');
$matArray=unserialize($material);  


$html = '
<head>
<style>
@import "https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i";
.logo {
    width: 100%;
    text-align: center;
    float: left;
    margin-bottom:20px;
}

img{
 width: 70px;
 margin:auto;
}

body{

font-size:13px;
}

.inner_padd{
	background-color:#fff;
	padding-left: 10px;
	padding-right: 10px;
	padding-top: 10px;
	padding-bottom: 10px;
	border-top:2px solid #df5436;
	border-bottom:2px solid #df5436;
	border-left:2px solid #df5436;
	border-right:2px solid #df5436;
}

.pull-left {
    float: left;
}

.pull-right {
    float: right;
}

.permit_left{
		width:80%
}

.permit_right{
	width:20%
}

.permit_left h4, .permit_right h4, .total_permit{
margin-bottom:5px;
    line-height:25px;
}
.permit_no{
	font-size:13px;
    float:left;
    width:100%;
    background-color: #eee;
    padding:10px;
    
    
}

h1,h2,h3,h4,h5{
	margin:0;
	padding:0;

	
	}
	p{
    margin:0;
    padding:0;
    
    }
    
    .permit_top{
  
    }
    .permit_bottom{
    margin-top:3px;
    }
    
    li.col_select{
    font-size:13px;
    display:inline-block
    width:auto;

    }
    
.title_radio,.select_radio  {
float:left;
    }
    
 .title_radio h5{
 font-size:14px;
 }
    .title_radio{
    width:27%;
    }
    .select_radio {
    width:73%;
    }
 .free_piece_radio{
    float:left;
    width:100%;
    }
    th,td{
    text-align:left;
    vertical-align:middle;
    padding:10px;
    }
    
    .permit_cont{

    
    }
.input{
border-left: 1px solid #000;
border-right: 1px solid #000;
border-top: 1px solid #000;
border-bottom: 1px solid #000;
border-radius:5px;
padding-top:10px;
padding-bottom:10px;
padding-left:10px;
padding-right:10px;

width:200px;
height:100px;
float:left;
}
input{
text-align:center;
height:50px;
font-size:16px;

}
</style>
</head>
<body style="font-family: Open Sans, sans-serif;font-size:20px;" >
<div class="inner_padd">
    <div class="logo" style="text-align:center;width:100%;">
        <img alt="" src="'.SITE_URL .'assets/images/logo.png">
    </div>
    <div classs="permit_cont" style="border-left:1px solid #9a9797; border-right:1px solid #9a9797;  border-top:1px solid #9a9797; border-bottom:1px solid #9a9797;  margin-top:20px;">
    <div class="permit_no clear permit_top">
        <div class="permit_left pull-left">
            <h4>'.get_cust_job_detail($job_id,'name').'</h4>
            <p>'.get_cust_detail($cust_id,'company').', '.get_cust_detail($cust_id,'work_add1').'</p>
        </div>
        <div class="pull-right permit_right">
            <h5>PO #</h5>
            <p>'.get_cust_job_detail($job_id,'po').'</p>
        </div>
    </div>
    <div class="permit_no clear permit_bottom">
        <div class="permit_left pull-left">
            <h4>Job Notes</h4>
            <p>'.get_cust_job_detail($job_id,'job_notes').'</p>
        </div>
        <div class="permit_right pull-right">
           <div class="total_permit" style="width:100%;">
					<span class="pull-left">Total Weight:</span>
					<span class="pull-left">'.$toto_wgt.'</span>
		   </div>
		    <div class="total_permit" style="width:100%;">
					<span class="pull-left">Total Cost:</span>
					<span class="pull-left">$'.$toto_cost.'</span>
		   </div>
        </div>
    </div>
    </div>

<div class="title_radioo" style="float:left;width:100%;margin-top:20px;margin-bottom:0;">
    <h5 style="margin:0;padding:0;">Piece Name: </h5> '. get_peice_info($piece_id,'piece_name').'
</div>
	
<div class="title_radioo" style="float:left;width:100%;margin-top:20px;margin-bottom:0;">
    <h5 style="margin:0;padding:0;">Recipe Components: </h5>
</div>';
	
	$sql="select * from recipe_components ";
	$statement = $db->prepare($sql); 	
	$statement->execute();   
	$result=$statement->fetchAll(); 
	foreach($result as $row)
	{
	if (in_array($row['id'], $activeArray)) 
	{
		$sql_11="select * from job_piece_component where job_id='".$job_id."' and piece_id='".$piece_id."' and component='".$row['id']."'";
		$statement_11 = $db->prepare($sql_11);	
		$statement_11->execute();  
		$result_11=$statement_11->fetchAll(); 
		foreach($result_11 as $row_11) 
		{
			$pc_comp_id=$row_11['id'];
		}		

		
		$weight=get_job_components_info($pc_comp_id,'weight');
		$cost=get_job_components_info($pc_comp_id,'cost');
		$tot_abs_vol=get_job_components_info($pc_comp_id,'tot_abs_vol');
		$weight=unserialize($weight);
		$cost=unserialize($cost);
		
		if(!empty($tot_abs_vol))
		{	
			$tot_abs_vol_arr=explode(',',$tot_abs_vol);
		}
		else
		{
			$tot_abs_vol_arr=0; 
		}	
		
		
	
	$html .='<div class="free_cont" style="border-left:1px solid #9a9797; border-right:1px solid #9a9797;  border-top:1px solid #9a9797; border-bottom:1px solid #9a9797;  margin-top:10px;"> 
        <div class="free_piece_radio" style="margin-top:0px; clear:both; background-color: #eee; padding-top:10px; padding-bottom:10px;">

            <div class="select_radio">
              <ul style="margin:0;padding:0;width:100%;">
                    <li class="col_select" style="list-style-type:none;">'.$row['name'].'</li>
               </ul> 
         
        </div>
    </div>

    <div class="table_piece" style="display: inline-block; font-size: 13px; margin-top:10px;padding-top:20px;">
        <div class="responisve_table">
            <table style="font-size:13px;">
                <thead>

                    <tr>

                        <th >Thickness</th>
                        <th> <input type="text" value="'.get_job_components_info($pc_comp_id,'thick').'"></th>
                        <th>&nbsp;</th>


                    </tr>
                    <tr>

                        <th>Length</th>
                        <th> <input type="text" value="'.get_job_components_info($pc_comp_id,'length').'"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>

                        <th>Width</th>
                        <th> <input type="text" value="'.get_job_components_info($pc_comp_id,'width').'"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>

                        <th>Cubic Sq Ft</th>
                        <th> <input type="text" value="'.get_job_components_info($pc_comp_id,'cubic_sq').'"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th>Cubic Sq Ft + 5%</th>
                        <th> <input type="text" value="'.get_job_components_info($pc_comp_id,'cubic_sq_int').'"></th>
                        <th>&nbsp;</th>
                    </tr>

                </thead>
                <tbody>';
                    $i=1;
					$b=-1; 
					$sql="select * from material_category where status='0'";
					$statement = $db->prepare($sql);  	   
					$statement->execute();   
					$result=$statement->fetchAll();   
					foreach($result as $row)
					{
						$cat_id=$row['id'];
						$cat_name=$row['name'];
						if($i==1)
						{
							$weight_txt="Weight";
						}
						else
						{
							$weight_txt="";
						}
						if($i==1)
						{
							$cost_txt="Cost";
						}
						else
						{
							$cost_txt="";
						}

						if($i==1)
						{
							$abs_vol="Abs Vol";
						}
						else
						{
							$abs_vol="";
						}
						
						$html .='<tr>
							<td><b>'.$cat_name.'</b> </td>
							<td>
								<div class="weight_text">'.$weight_txt.'</div>
							</td>
							<td>
								<div class="input_cost">'.$cost_txt.'</div>
							</td>
							<td>
								<div class="input_cost">'.$abs_vol.'</div>
							</td>
						</tr>';
                    
						$sql_1="select * from material where category='".$cat_id."'";
						$statement_1 = $db->prepare($sql_1);  	   
						$statement_1->execute();   
						$result_1=$statement_1->fetchAll();   
						 
						foreach($result_1 as $row_1)
						{ 
							if(!empty($matArray)) 
							{ 
								if(in_array($row_1['id'], $matArray)) 
								{ 
									$html .='
									<tr class="inner-tab '.$b++.'">
											<td><span class="pdng_span">'.$row_1['descp'].'<span></span></span>
											</td>
											<td>
												<div class="weight_value asd_value " tabindex="1">
												 <input type="text" value="'.$weight[$b].'"> lb
													
												</div> 
											</td>
											<td>
												<div class="input_cost">
													<span class="dollar">$</span><span class="total_cost cost_2">'.$cost[$b].'</span> 
											 </div>
											<td>
												<div class="input_cost">
													<span class="dollar"></span><span class="total_cost cost_2">'.$tot_abs_vol_arr[$b].'</span> 
											 </div> 
											</td>
									</tr>';	
								}
							
							}			
						
						
						}
					
					
					$i++; 
					} 
					$c=$b+1; 
					$sql="select * from material_category where status='1'";
					$statement = $db->prepare($sql);  	   
					$statement->execute();  
					$result=$statement->fetchAll(); 
					foreach($result as $row)   
					{   
					$html .='<tr> 
						<td><b>'.$row['name'].'</b> </td>
						<td>
							<div class="weight_text"> <input type="text" value="'.$weight[$c].'"> lb</div>
						</td>   
						<td>  
							<div class="input_cost">'.$cost[$c].'</div>
						</td>  
						<td>  
							<div class="input_cost">'.$tot_abs_vol_arr[$c].'</div>
						</td> 
					</tr>';
					$c++;
					}
					
                $html .='</tbody>

            </table>
        </div>
		</div>';
	}
	}
		$html .='</div>
       

    
	</div>
    </div>
    </div>
    
    ';

$html .='</body></html>';

//echo $html;
//die; 

 

//==============================================================
//==============================================================
//==============================================================
include("pdf/mpdf.php");

$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13);  

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

// LOAD a stylesheet
//$stylesheet = file_get_contents('mpdfstyletables.css');
//$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);
$filename=date('Y-m-d'); 
$mpdf->Output($filename.'.pdf','D');
exit;


?>
