<?php
 include("../setup.php");
 include("phpequations.class.php");
 $equations = new phpequations();
?>
<pre>

<h1>Examples for using phpEquations</h1>




<?php
 $i=0;
 $j=0.1; 
 $k=0.24; 
 $s=0.5;  
 
print_r($equations->solve("

 	0.5=(165.36 * (1-(a/196.56)-((a*$i)/187.2)-((a*$j)/163.488) - ($k*a*(1+$i+$j)/62.4)-0.02))/
		(165.36 * ( ( (1-a)/196.56 ) - ( (a * $i)/187.2 ) - ( (a*$j)/163.49 ) - ( ($k*a)(1+$i+$j)/62.4 ) - (0.02) ) + ((a) *(1+$i+$j)))  
	"));	  
	 
	
	
	
?>