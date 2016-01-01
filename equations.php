<?php

{//official thread specifications
	{ //lower Thread
		$lowerThreadA1= 45;
		$lowerThreadA2= 10;
		$lowerThreadC= 0.99;
		$lowerThreadE= 29.44;
		$lowerThreadIMin= 20.09;
		$lowerThreadP= 4.24;
		$lowerThreadR1= 0.25;
		$lowerThreadR2= 0.75;
		$lowerThreadR3= 0.75;
		$lowerThreadT= 31.83;

		$lowerThreadB= ( $lowerThreadT - $lowerThreadE ) / 2;
	}

	{ //upper thread
		$upperThreadA1= 45;
		$upperThreadA2= 10;
		$upperThreadC= 0.99;
		$upperThreadE= 24.99;
		$upperThreadH= 27.48;
		$upperThreadIMin= 15.60;
		$upperThreadP= 4.24;
		$upperThreadR1= 0.25;
		$upperThreadR2= 0.75;
		$upperThreadR3= 0.75;
		$upperThreadS= 1.17;
		$upperThreadT= 27.38;
		$upperThreadMinimumRequiredFullTurns= 2;

		$upperThreadB= ( $upperThreadT - $upperThreadE ) / 2;
	}
}

$lowerWallThickness= 4;
$upperWallThickness= 4.2;
$ceilingThickness= 4.5; //chose arbitrarily
$ceilingExtentZ = 15;

$femaleThreadOffset= 0.35;
$lowerMinorDiameter= $lowerThreadE + 2 * $femaleThreadOffset;
$lowerMajorDiameter = $lowerThreadT + 2 * $femaleThreadOffset;
$lowerBarrelDiameter = $lowerMajorDiameter + 2 * $lowerWallThickness;
$lowerBoreDepth= 9.3; //eyeballed and meaasured
$lowerSealingLedgeWidth = ($lowerMajorDiameter - $lowerMinorDiameter)/2 + 2;


$upperMinorDiameter = $upperThreadE;
$upperMajorDiameter = $upperThreadT;
$upperBoreDiameter= $upperMinorDiameter - 2*$upperWallThickness;
$upperNippleExtentZ= $upperThreadH;

$upperThreadGuaranteedFullyThreadedExtentZ= ( $upperThreadMinimumRequiredFullTurns + 1 ) * $upperThreadP;

?>