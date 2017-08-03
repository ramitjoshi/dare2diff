<?php
include("../setup.php");
include("phpequations.class.php");
$equations = new phpequations();
$k=0.24;
$i=0;
$j=0.10;
if(isset($_GET['water']))
{
	if($_GET['water']!="")
	{	
		$k=$_GET['water'];
		$k=$k/100; 
	}
} 

if(isset($_GET['csa']))
{
	if($_GET['csa']!="")
	{	
		$i=$_GET['csa'];
		$i=$i/100; 
	}
}   
if(isset($_GET['fume']))
{
	if($_GET['fume']!="")
	{	
		$j=$_GET['fume'];
		$j=$j/100; 
	}
}
 

$s=0.5; 
 

$result=$equations->solve("
0.5=(165.36*((1-a/196.56)- (a*$i/187.2) -((a*$j)/163.488) - ($k * a*(1+$i+$j)/62.4) - 0.02))/(165.36*((1-a/196.56)- (a*$i/187.2) -((a*$j)/163.488) - ($k * a*(1+$i+$j)/62.4) - 0.02) + a*(1+$i+$j))  
");		
	
echo $result['a'];
	
?>