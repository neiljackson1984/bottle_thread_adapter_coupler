include <MCAD/screw.scad>

femaleSleeveOuterDiameter=2;
femaleSleeveCavityDepth=0.8;
boreDiameter=0.8;
ceilingThickness=0.1;

femaleThreadMinorDiameter=1.7;
femaleThreadMajorDiameter=1.8;
femaleThreadPitch=0.2;
femaleThreadNumberOfStarts=1;

maleThreadMinorDiameter=1.3;
maleThreadMajorDiameter=1.4;
maleThreadPitch=0.14;
maleThreadNumberOfStarts=1;

maleSleeveOuterDiameter=1.3;
maleSleeveHeight=1;





$fn=110;



difference()
{
    union()
    {
        cylinder(r=femaleSleeveOuterDiameter/2, h=femaleSleeveCavityDepth+ceilingThickness);
        translate([0,0,femaleSleeveCavityDepth+ceilingThickness]) cylinder(r=maleThreadMinorDiameter/2, h=maleSleeveHeight);
    }
    union()
    {
        cylinder(r=femaleThreadMinorDiameter/2, h=femaleSleeveCavityDepth);
        cylinder(r=boreDiameter/2, h=femaleSleeveCavityDepth + ceilingThickness + maleSleeveHeight);
    }
}
