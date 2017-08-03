<?php
require_once  'config/constants.php';
require_once   'config/functions.php';
$db = get_connection();
$job_id=$_GET['job_id'];
$piece_id=$_GET['piece_id'];
$cust_id=get_cust_job_detail($job_id,'cust_id');



$toto_wgt=0;
$toto_cost=0;


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
        <img alt="" src="http://dare2bdifferent.pro/assets/images/logo.png">
    </div>
    <div classs="permit_cont" style="border-left:1px solid #9a9797; border-right:1px solid #9a9797;  border-top:1px solid #9a9797; border-bottom:1px solid #9a9797;  margin-top:20px;">
    <div class="permit_no clear permit_top">
        <div class="permit_left pull-left">
            <h4>Adams Job</h4>
            <p>1783408 Ontario Inc, c/o Dave Hernen, Huntsville Truck Repair</p>
        </div>
        <div class="pull-right permit_right">
            <h5>PO #</h5>
            <p>1005</p>
        </div>
    </div>
    <div class="permit_no clear permit_bottom">
        <div class="permit_left pull-left">
            <h4>Job Notes</h4>
            <p>Test</p>
        </div>
        <div class="permit_right pull-right">
           <div class="total_permit" style="width:100%;">
					<span class="pull-left">Total:</span>
					<span class="pull-left"> 20.44$</span>
		   </div>
		    <div class="total_permit" style="width:100%;">
					<span class="pull-left">Total:</span>
					<span class="pull-left"> 20.44$</span>
		   </div>
        </div>
    </div>
    </div>

<div class="title_radioo" style="float:left;width:100%;margin-top:20px;margin-bottom:0;">
    <h5 style="margin:0;padding:0;">Recipe Components: </h5>
</div>

<div class="free_cont" style="border-left:1px solid #9a9797; border-right:1px solid #9a9797;  border-top:1px solid #9a9797; border-bottom:1px solid #9a9797;  margin-top:10px;"> 
        <div class="free_piece_radio" style="margin-top:0px; clear:both; background-color: #eee; padding-top:10px; padding-bottom:10px;">

            <div class="select_radio">
              <ul style="margin:0;padding:0;width:100%;">
                    <li class="col_select" style="list-style-type:none;">1) Self-Consolidating Face Coat</li>
               </ul> 
         
        </div>
    </div>

    <div class="table_piece" style="display: inline-block; font-size: 13px; margin-top:10px;padding-top:20px;">
        <div class="responisve_table">
            <table style="font-size:13px;">
                <thead>

                    <tr>

                        <th >Thickness</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>


                    </tr>
                    <tr>

                        <th>Length</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>

                        <th>Width</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>

                        <th>Cubic Sq Ft</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th>Cubic Sq Ft + 5%</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td><b>Portland Concrete</b> </td>
                        <td>
                          
                            <div class="weight_text">
                                Weight </div>
                        </td>
                        <td>
                            <div class="input_cost">
                                Cost
                            </div>
                        </td>
                    </tr>
                    <tr class="inner-tab">
                        <td><span class="pdng_span">White<span></span></span>
                        </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="1">
                             <input type="text" value="100"> lb
                                
                            </div>
                         
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span><span class="total_cost cost_2">0.00</span>
                         </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Sand</b> </td>
                        <td>
                            <div class="weight_value">
                                &nbsp;
                            </div>
                          
                        </td>
                        <td>
                            <div class="input_cost">

                            </div>
                        </td>

                    </tr>

                    <tr class="inner-tab">
                        <td><span class="pdng_span">White Lightning<span></span></span>
                        </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="2">
                                 <input type="text" value="100"> lb
                               
                            </div>
                          
                        </td>
                        <td>
                            <div class="input_cost">
                                             <span class="dollar">$</span>
                                               <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Pigments</b> <span style="float:right;">Water</span> </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="3">
                                <input class="input_3 valid" type="text"> %
                            </div>
                           
                        </td>
                        <td>
                            <div class="input_cost">
                                     <span class="dollar">$</span>
                                       <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr class="inner-tab">
                        <td><span class="pdng_span">Black<span></span></span>
                        </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="4">
                                <input type="text" class="weight_txt input_8"> g
                             
                            </div>
                            
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">
                               
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td><b>Sealer</b> </td>
                        <td>
                            <div class="weight_value">
                                &nbsp;
                            </div>
                            <div class="weight_text">
                            </div>
                        </td>
                        <td>
                            <div class="input_cost">

                            </div>
                        </td>
                    </tr>
                    <tr class="inner-tab">
                        <td><span class="pdng_span">Stamp Shield<span></span></span>
                        </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="5">
                                 <input type="text" value="100">lb
                              
                            </div>
                           
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">

                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td><b>GFRC Admix</b></td>
                        <td>
                            <div class="weight_value asd_value " tabindex="6">
                               <input type="text" value="100">
                              

                            </div>

                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Glass Fibre</b></td>
                        <td>
                            <div class="weight_value asd_value " tabindex="7">
                                <input class="weight_txt input_102" name="tot_weight[]" type="text"> g
                                
                            </div>
                           
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Silica Fume</b></td>
                        <td>
                            <div class="weight_value asd_value" >
                                <input type="text" value="100">
                                <span class="price_103">22</span>

                            </div>
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Plasticizer</b></td>
                        <td>
                            <div class="weight_value asd_value " tabindex="9">
                                <input type="text" value="100">

                            </div>
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                

                    <tr>
                        <td><strong>Total</strong></td>
                        <td>
                            <div class="weight_value">
                                &nbsp;
                            </div>
                            <div class="weight_text">
                                &nbsp;
                            </div>
                        </td>
                        <td>
                            <div class="input_cost">
                                &nbsp;
                            </div>
                        </td>

                    </tr>

                 
                    <tr>
                        <td colspan="3">
                            <div class="responisve_table">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: right; width: 50%;color:#2d2d2d;">
                                                <strong>Total Weight:</strong><span class="weight_span">368</span>
                                            </td>
                                            <td style="width: 50%;color:#2d2d2d;">
                                                <strong>Cost:</strong> $<span class="cost_span">7125</span>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>

                        </td>

                    </tr>


                </tbody>

            </table>
        </div>
		</div>
		</div>
        <div class="free_cont" style="border-left:1px solid #9a9797; border-right:1px solid #9a9797;  border-top:1px solid #9a9797; border-bottom:1px solid #9a9797;  margin-top:10px;"> 
        <div class="free_piece_radio" style="margin-top:0px; clear:both; background-color: #eee; padding-top:10px; padding-bottom:10px;">

            <div class="select_radio">
              <ul style="margin:0;padding:0;width:100%;">
                    <li class="col_select" style="list-style-type:none;">2) Self-Consolidating Face Coat</li>
               </ul> 
         
        </div>
    </div>

    <div class="table_piece" style="display: inline-block; font-size: 13px; margin-top:10px;padding-top:20px;">
        <div class="responisve_table">
            <table style="font-size:13px;">
                <thead>

                    <tr>

                        <th >Thickness</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>


                    </tr>
                    <tr>

                        <th>Length</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>

                        <th>Width</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>

                        <th>Cubic Sq Ft</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th>Cubic Sq Ft + 5%</th>
                        <th> <input type="text" value="100"></th>
                        <th>&nbsp;</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td><b>Portland Concrete</b> </td>
                        <td>
                          
                            <div class="weight_text">
                                Weight </div>
                        </td>
                        <td>
                            <div class="input_cost">
                                Cost
                            </div>
                        </td>
                    </tr>
                    <tr class="inner-tab">
                        <td><span class="pdng_span">White<span></span></span>
                        </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="1">
                             <input type="text" value="100"> lb
                                
                            </div>
                         
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span><span class="total_cost cost_2">0.00</span>
                         </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Sand</b> </td>
                        <td>
                            <div class="weight_value">
                                &nbsp;
                            </div>
                          
                        </td>
                        <td>
                            <div class="input_cost">

                            </div>
                        </td>

                    </tr>

                    <tr class="inner-tab">
                        <td><span class="pdng_span">White Lightning<span></span></span>
                        </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="2">
                                 <input type="text" value="100"> lb
                               
                            </div>
                          
                        </td>
                        <td>
                            <div class="input_cost">
                                             <span class="dollar">$</span>
                                               <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Pigments</b> <span style="float:right;">Water</span> </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="3">
                                <input class="input_3 valid" type="text"> %
                            </div>
                           
                        </td>
                        <td>
                            <div class="input_cost">
                                     <span class="dollar">$</span>
                                       <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr class="inner-tab">
                        <td><span class="pdng_span">Black<span></span></span>
                        </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="4">
                                <input type="text" class="weight_txt input_8"> g
                             
                            </div>
                            
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">
                               
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td><b>Sealer</b> </td>
                        <td>
                            <div class="weight_value">
                                &nbsp;
                            </div>
                            <div class="weight_text">
                            </div>
                        </td>
                        <td>
                            <div class="input_cost">

                            </div>
                        </td>
                    </tr>
                    <tr class="inner-tab">
                        <td><span class="pdng_span">Stamp Shield<span></span></span>
                        </td>
                        <td>
                            <div class="weight_value asd_value " tabindex="5">
                                 <input type="text" value="100">lb
                              
                            </div>
                           
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">

                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td><b>GFRC Admix</b></td>
                        <td>
                            <div class="weight_value asd_value " tabindex="6">
                               <input type="text" value="100">
                              

                            </div>

                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Glass Fibre</b></td>
                        <td>
                            <div class="weight_value asd_value " tabindex="7">
                                <input class="weight_txt input_102" name="tot_weight[]" type="text"> g
                                
                            </div>
                           
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Silica Fume</b></td>
                        <td>
                            <div class="weight_value asd_value" >
                                <input type="text" value="100">
                                <span class="price_103">22</span>

                            </div>
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Plasticizer</b></td>
                        <td>
                            <div class="weight_value asd_value " tabindex="9">
                                <input type="text" value="100">

                            </div>
                        </td>
                        <td>
                            <div class="input_cost">
                                <span class="dollar">$</span>
                                 <input type="text" value="100">
                            </div>
                        </td>
                    </tr>
                

                    <tr>
                        <td><strong>Total</strong></td>
                        <td>
                            <div class="weight_value">
                                &nbsp;
                            </div>
                            <div class="weight_text">
                                &nbsp;
                            </div>
                        </td>
                        <td>
                            <div class="input_cost">
                                &nbsp;
                            </div>
                        </td>

                    </tr>

                 
                    <tr>
                        <td colspan="3">
                            <div class="responisve_table">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: right; width: 50%;color:#2d2d2d;">
                                                <strong>Total Weight:</strong><span class="weight_span">368</span>
                                            </td>
                                            <td style="width: 50%;color:#2d2d2d;">
                                                <strong>Cost:</strong> $<span class="cost_span">7125</span>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>

                        </td>

                    </tr>


                </tbody>

            </table>
        </div>
		</div>
		</div>
    </div>
    </div>
    
    ';

$html .='</body></html>';

echo $html;
die;



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
 
$mpdf->Output('asd.pdf','D');
exit;


?>
