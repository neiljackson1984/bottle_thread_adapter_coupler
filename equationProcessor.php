<?php 
/*
On the command line, run
php equationProcessor.php equations.php > equations.txt 
to generate the equations file for solidworks.
This php script 'include's the file named by the first argument.
Then it echos all newly defined numeric variables in the solidworks equations file format.
-Neil Jackson
2015-03-29
*/



//PREAMBLE CODE
{ //PREAMBLE CODE TO NOTE ANY PRE-EXISITING VARIBALE NAMES
$initialNames = array();
$initialNames = array_keys($GLOBALS);
}

//User definitions go here:
	
	
if ($argc < 2)
{
	echo "error. You must pass this script at least one argument, which the script will interpret as the name of a php file to be 'include'ed.\n";
	exit(1);
}
else
{
	include $argv[1];
}




{ //POSTAMBLE CODE TO ECHO GLOBAL VARIABLES IN SOLIDWORKS EQUATION FORMAT
$namesOfVariablesToBeExported = 
	array_filter
	(
		array_diff(array_keys($GLOBALS),$initialNames),
		//function($x){return  is_numeric($GLOBALS[$x])  ;}
		function($x){return  is_numeric($GLOBALS[$x]) || is_string($GLOBALS[$x])   ;}
		//function($x){return  is_numeric($GLOBALS[$x]) || $GLOBALS[$x]=="suppressed" || $GLOBALS[$x]=="unsuppressed"   ;}
	);

sort($namesOfVariablesToBeExported);
	
foreach($namesOfVariablesToBeExported as $name)
{

		if( is_string($GLOBALS[$name]) ) 
		{
			echo "\"$name\" = \"". $GLOBALS[$name] ."\"\n";
		}
		else
		{
			echo "\"$name\" = " . number_format($GLOBALS[$name], 15,".","") . "\n";
		}
}
}
	



?>