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
$initialNames = "something" ; //we declare $initalNames here so that array_keys($GLOBALS) below, will contain "initialNames"
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
	/*
		//DOES NOT WORK IN PHP VERSION < 5.6.0 :
		$variablesToExport = 
			array_filter
			(
				$GLOBALS,
				function($variableName){return !in_array($variableName, $initialNames  )  ;},
				ARRAY_FILTER_USE_KEY
			);
	*/
	
	$variableNamesToExport = array_diff(array_keys($GLOBALS), $initialNames );
	$variablesToExport = [];
	foreach ($variableNamesToExport as $name)
	{
		$variablesToExport[$name] = $GLOBALS[$name];
	}
	
	
	toSldWorksEquationSyntax($variablesToExport);
	
}
	
/*

This function takes an object,
scans it at all levels to produce (i.e. echo to stdout), for each primitive submember, 
a line of output.  (Perhaps it should also/alternatively return a string containing those lines of text, but that is a bit more complicated because we would have to use static variables in the function to accumulate the string (this function will work by recursion)).
Example 1:

$x = new stdClass;
$x->a = 13;
$x->b = 127;
$x->c = -34.25;

Then, 
	objectToSldWorksEquationSyntax($x, "foo")
echoes the following lines of text:
"foo.a" = 13
"foo.b" = 127
"foo.c" = -34.25


Example 2:

$y = new stdClass;
$y->alabama = 78;
$y->arkansas = 15;
$y->ohio = 88;

$x = new stdClass;
$x->a = 13;
$x->b = 127;
$x->c = -34.25;
$x->bar = $y;

Then, 
	objectToSldWorksEquationSyntax($x, "foo")
evalulates to the string containing the following lines of text:
"foo.a" = 13
"foo.b" = 127
"foo.c" = -34.25
"foo.bar.alabama" = 78
"foo.bar.arkansas" = 15
"foo.bar.ohio" = 88

//Slight change of plans... we will do this with associative arrays, not objects.


*/

function toSldWorksEquationSyntax($value, $name="")
{
	if ( is_numeric($value) )
	{
		echo "\"$name\" = " . number_format($value, 15,".","") . "\n";
	}
	elseif( is_string($value) ) 
	{
		echo "\"$name\" = \"". $value ."\"\n";
	}
	elseif( is_array($value) )
	{
		$prefix = ($name === "" ? "" : $name . "."); //taking an empty string as a default name allows us to use this function to export an array of globals, without any prefix.
		$keys = array_keys($value);
		sort($keys);
		//fwrite(STDERR, "found within $name : \n" . print_r($keys,true). "\n");
		foreach($keys as $key)
		{
			toSldWorksEquationSyntax($value[$key], $prefix . $key);
		}
	}
}

?>