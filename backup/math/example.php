<?php
 include("../setup.php");
 include("phpequations.class.php");
 $equations = new phpequations();

 $i=0;
 $j=0.10;
 $k=0.24;
 $s=0.5; 
 

$result=$equations->solve("
0.5=(165.36*((1-a/196.56)- (a*$i/187.2) -((a*$j)/163.488) - ($k * a*(1+$i+$j)/62.4) - 0.02))/(165.36*((1-a/196.56)- (a*$i/187.2) -((a*$j)/163.488) - ($k * a*(1+$i+$j)/62.4) - 0.02) + a*(1+$i+$j))  
");		
	
echo $result['a'];
	
?>