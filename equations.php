<?php

// {//official thread specifications
	// { //lower Thread
		// $lowerThreadA1= 45;
		// $lowerThreadA2= 10;
		// $lowerThreadC= 0.99;
		// $lowerThreadE= 29.44;
		// $lowerThreadIMin= 20.09;
		// $lowerThreadP= 4.24;
		// $lowerThreadR1= 0.25;
		// $lowerThreadR2= 0.75;
		// $lowerThreadR3= 0.75;
		// $lowerThreadT= 31.83;

		// $lowerThreadB= ( $lowerThreadT - $lowerThreadE ) / 2;
	// }

	// { //upper thread
		// $upperThreadA1= 45;
		// $upperThreadA2= 10;
		// $upperThreadC= 0.99;
		// $upperThreadE= 24.99;
		// $upperThreadH= 27.48;
		// $upperThreadIMin= 15.60;
		// $upperThreadP= 4.24;
		// $upperThreadR1= 0.25;
		// $upperThreadR2= 0.75;
		// $upperThreadR3= 0.75;
		// $upperThreadS= 1.17;
		// $upperThreadT= 27.38;
		// $upperThreadMinimumRequiredFullTurns= 2;

		// $upperThreadB= ( $upperThreadT - $upperThreadE ) / 2;
	// }
// }


{//official thread specifications
	class threadSpec extends propContainer
	{
		protected function get_b() {return ($this->t - $this->e)/2;}
		protected function get_a() {return ($this->c + $this->b*(tan($this->a1*pi()/180)+tan($this->a2*pi()/180)));}
	}

	$threadSpecs = 
		[
			"M33SP415" => 
				new threadSpec(
					[
						"a1" => 45,
						"a2" => 10,
						"c" => 0.99,
						"e" => 29.44,
						"h"=> 32.36, 
						"iMin" => 20.09,
						"p" => 25.4/6, //4.24,
						"r1" => 0.25,
						"r2" => 0.75,
						"r3" => 0.75,
						"s"=> 1.17, 
						"t" => 31.83,
						
						//"b" => (31.83 - 29.44)/2, // (t-e)/2
						"minimumRequiredFullTurns" => 2 //confirm this
					]
				),
				
			"M28SP415" => 
				new threadSpec(
					[
						"a1"=> 45,
						"a2"=> 10,
						"c"=> 0.99,
						"h"=> 27.48,
						"e"=> 24.99,
						"iMin"=> 15.60,
						"p"=> 25.4/6,
						"r1"=> 0.25,
						"r2"=> 0.75,
						"r3"=> 0.75,
						"s"=> 1.17,
						"t"=> 27.38,
						//"b"=> (27.38-24.99)/2, // (t-e)/2
						"minimumRequiredFullTurns"=> 2
					]
				),	
				
			"PCF38P4" => 
				new threadSpec(
					[
						"a1"=> 30.0,
						"a2"=> 10.0,
						"c"=> 0.060*25.4  -  (37.06-34.67)/2*( tan(30*pi()/180)+tan(10*pi()/180) ),
						"h"=> 16.81,
						"e"=> 34.67,
						"iMin"=> 29.72,
						"p"=> 25.4/6,
						"r1"=> 0.25,
						"r2"=> 0.64,
						"r3"=> 0.64,
						"s"=> 2.36,
						"t"=> 37.06,
						"minimumRequiredFullTurns"=> 1
					]
				)	
		];
}



//$bottleType = "softsoap";
$bottleType = "riteAid";

switch($bottleType)
{	
	case "softsoap":
		$lowerThread = $threadSpecs["M33SP415"]; //for Softsoap-brand soap
		$bottleBoreDiameter = 25.35; //the diameter of the opening in the liquid hand soap bottle, measured with calipers.
		$lowerBoreDepth= 9.3; //eyeballed and meaasured
	break;
	
	case "riteAid":
		$lowerThread = $threadSpecs["PCF38P4"];  //for rite-aid brand soap
		$bottleBoreDiameter = 31.1; //the diameter of the opening in the liquid hand soap bottle, measured with calipers.
		$lowerBoreDepth= 9.3; //eyeballed and meaasured (same as softsoap bottle)
	break;
		
	default :
	
	break;

}

$upperThread = $threadSpecs["M28SP415"];


$lowerWallThickness= 3;
$upperWallThickness= 3;
$ceilingThickness= 3; //chose arbitrarily


$femaleThreadOffset= 0.35;
$lowerMinorDiameter= $lowerThread->e + 2 * $femaleThreadOffset;
$lowerMajorDiameter = $lowerThread->t + 2 * $femaleThreadOffset;
$lowerBarrelDiameter = $lowerMajorDiameter + 2 * $lowerWallThickness;

$lowerSealingLedgeWidth = ($lowerMajorDiameter - $bottleBoreDiameter)/2 - 0.5 ;//($lowerMajorDiameter - $lowerMinorDiameter)/2 + 2;


$upperMinorDiameter = $upperThread->e;
$upperMajorDiameter = $upperThread->t;
$upperBoreDiameter= $upperMinorDiameter - 2*$upperWallThickness;

$upperNippleExtentZ= 21.5-3.8; //$upperThreadH;

$upperThreadGuaranteedFullyThreadedExtentZ= ( $upperThread->minimumRequiredFullTurns + 1 ) * $upperThread->p;

$transitionTaperAngle = 38 * pi()/180;

$ceilingExtentZ = 
	   ($lowerMajorDiameter - $upperMinorDiameter)/2  *  tan($transitionTaperAngle)
	+  $ceilingThickness * (1/cos($transitionTaperAngle));

	
$gripNubExtentRadial=2.2;
$gripNubWidth=2.5;
$gripNubBaseFilletRadius=min(0.2,$gripNubExtentRadial/2);
$gripNubOuterFilletRadius=min($gripNubWidth/2, $gripNubExtentRadial-$gripNubBaseFilletRadius);

$gripNubsMaximumAllowedCircumferentialInterval = 16; //calibrated to be a bit bigger than the width of the human finger.

$numberOfGripNubs= ceil($lowerBarrelDiameter * pi() / $gripNubsMaximumAllowedCircumferentialInterval );

?>